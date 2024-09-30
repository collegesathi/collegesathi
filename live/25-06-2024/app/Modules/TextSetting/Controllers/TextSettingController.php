<?php

namespace App\Modules\TextSetting\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\TextSetting\Models\TextSetting;
use CustomHelper;
use App\Modules\Setting\Models\Setting;
use App\Modules\Language\Models\Language;
use Auth, Blade,Config, Cache, Cookie, DB, File, Hash, Input, Mail, mongoDate, Redirect, Request, Response, Session, URL, View, Validator;
/**
 * text Settings Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/textsetting
 */

class TextSettingController extends BaseController
{
	public $model	=	'TextSetting';
	
	public function __construct() {
		View::share('modelName',$this->model);
		
	}
	
    /**
     * function for list all settings
     *
     * @param  null
     * 
     * @return view page
     */
     
    public function textList($type)
    {        
        $DB = TextSetting::where('type',(int)$type);
        
        $searchVariable = array();
        $inputGet       = Request::all();
        
        if((Request::all() && isset($inputGet['display'])) || isset($inputGet['page'])){
            $searchData = Request::all();
            unset($searchData['display']);
            unset($searchData['_token']);
            unset($searchData['sortBy']);
            unset($searchData['order']);
            
            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if(isset($searchData['records_per_page'])){
				unset($searchData['records_per_page']);
			}
            foreach ($searchData as $fieldName => $fieldValue) {
                if (!empty($fieldValue)) {
					if ($fieldName == 'module') {
                        $DB->where("key_value", 'like', '%' . $fieldValue . '%');
                    } else {
						$DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }
                    $searchVariable = array_merge($searchVariable, array(
                        $fieldName => $fieldValue
                    ));
                }
            }
        }
        
        if(Request::get('records_per_page')!=''){
			$searchVariable	=	array_merge($searchVariable,array('records_per_page' => Request::get('records_per_page')));
		}
		
		$recordPerPagePagination			=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page"); 
       
        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
        $order  = (Request::get('order')) ? Request::get('order') : 'DESC';
        
        $model         = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
        $languageArray = language::pluck('title', 'id')->toArray();
        
       return  View::make("TextSetting::index", compact('sortBy', 'order', 'model', 'searchVariable', 'languageArray','type','recordPerPagePagination'));
    } // end textList()
    
    /**
     * function for display add text page  
     *
     * @param  null
     * 
     * @return view page
     */
    
    public function addText($type){
		$languages      =   CustomHelper::getLanguageArrayWithCode();
        $language_code  =   CustomHelper::getConfigValue('defaultLanguageCode');
		return  View::make("TextSetting::add",compact('language_code','languages','type')); 
    } // end addText()
    
    /**
     * function for save added text
     *
     * @param  null
     * 
     * @return view page
     */
    
    public function saveText($type) {
        $thisData = Request::all();
		$language_code 		  =   CustomHelper::getConfigValue('defaultLanguageCode');
		$dafaultLanguageArray = $thisData['data'][$language_code];
		if (!empty($thisData)) {
			
            $validator = Validator::make(array(
                'key' => Request::get('key'),
                'value' => $dafaultLanguageArray
            ), array(
                'key' 	=> 'required|unique_textsetting_key:'.$type,
                'value' => 'required'
            ), array(
				'key.unique_textsetting_key' 	=>	trans('messages.key.unique_textsetting_key'),
				'value.required' 	=>	trans('messages.value.required'),
			));
            
           
			
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            } else {
                $keyValue = Request::get('key');
                foreach ($thisData['data'] as $key => $val) {
					if ($val) {
                        $model              = new TextSetting;
                        $model->key_value   = trim($keyValue);
                        $model->language_id = $key;
                        $model->value       = $val;
                        $model->type        = ($type==1) ? 1 : 2; 
						$model->save();
                    }
                }
				$this->settingFileWrite($type);
			}
			Session::flash('success',  trans("messages.$this->model.added_message")); 
			return Redirect::route("$this->model.add",$type);
            
        }
    } //end saveText()
    
     /**
     * function for display edit text page 
     *
     * @param  $Id as text id 
     * 
     * @return view page
     */
    
    public function editText($type,$modelId = 0)
    {     
        $result = TextSetting::find($modelId);
		if (Request::old() != null) {
            $result->value = Request::old('value');
        }
        return View::make("TextSetting::edit", compact('result','type'));
        
    } //end editText()
    
    /**
     * function for update text
     *
     * @param $Id as text id
     * 
     * @return view page
     */
    
    public function updateText($type,$modelId = 0)
    {
        $thisData = Request::all();
        if (!empty($thisData)) {
            
            $validator = Validator::make(array(
                'value' => Request::get('value')
            ), array(
				'value' => 'required'
            ));
           
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else {
                $model        = TextSetting::find($modelId);
                $model->value = trim(Request::get('value'));
                $model->save();
				
				$this->settingFileWrite($type);
				
				Session::flash('success',  trans("messages.$this->model.updated_message")); 
				return Redirect::route("$this->model.index","$type");
			}
        }
    } //end updateText()
    
    /**
     * function for delete text
     *
     * @param $Id as text id
     * 
     * @return view page
     */
    
    public function deleteText($modelId = 0)
    {
		$model = Blog::findorFail($modelId);
		$model->delete();
		Session::flash('success',trans("messages.$this->model.deleted_message")); 
		return Redirect::route("$this->model.index");
    } //end deleteText()
    
    /**
     * Function for write file on create and update text  or message 
     *
     * @param null
     *
     * @return void. 
     */
    public function settingFileWrite($type = null){
        $list 		= TextSetting::where('type', '=',(int)$type)->get()->toArray();
		$languages 	= Language::where('is_active', '=', 1)->get(array(
            'id',
            'folder_code',
            'lang_code'
        ));
        
        foreach ($languages as $key => $val) {
            
            $currLangArray = '<?php return array(';
            
            foreach ($list as $listDetails) {
                if ($listDetails['language_id'] == $val->id || $listDetails['language_id'] == 0) {
                    $currLangArray .= '"' . $listDetails['key_value'] . '"=>"' . $listDetails['value'] . '",' . "\n";
                }
            }
            
            $currLangArray .= ');';
            
            if($type == 2){
				$file = ROOT . DS . 'resources' . DS . 'lang' . DS . $val->lang_code . DS . 'front_messages.php';
			}else{
				$file = ROOT . DS . 'resources' . DS . 'lang' . DS . $val->lang_code . DS . 'messages.php';
			}
            
            
            $bytes_written = File::put($file, $currLangArray);
            if ($bytes_written === false) {
                die("Error writing to file");
            }
        } 
    } //end settingFileWrite()
    
} //end TextSettingController class
