<?php
namespace App\Modules\Language\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\Language\Models\Language;
use App\Modules\Setting\Models\Setting;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;

/**
 * Language Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/language
 */ 
class LanguageController extends BaseController {

	 /**
	 * Function for display list of all languages
	 *
	 * @param null
	 *
	 * @return view page. 
	 */
	public $model	=	'Language';
	
	public function __construct() {
		
		View::share('modelName',$this->model);
	}
	
	public function listLanguage(){		
		
		### breadcrumbs Start ###
		#Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"),route('AdminDashBoard.index'));
		#Breadcrumb::addBreadcrumb(trans("messages.$this->model.breadcrumbs_module"),route($this->model.'.index'));
		#$breadcrumbs 	= 	Breadcrumb::generate();
		### breadcrumbs End ###
		
		 $DB = Language::query();
		 $searchVariable	=	array(); 
		 $inputGet			=	Request::all();
		 
		 if(Request::all() && isset($inputGet['display'])){
			 $search 		= true;
			 $searchData	= Request::all();
			 unset($searchData['display']);
			 unset($searchData['_token']);
			 
			if(isset($searchData['records_per_page'])){
				unset($searchData['records_per_page']);
			}
			if(isset($searchData['page'])){
				unset($searchData['page']);
			}
			
			 foreach($searchData as $field_name => $fieldValue){
				 if(!empty($fieldValue)){
					 $DB->where("$field_name",'like','%'.$fieldValue.'%');
					 $searchVariable	=	array_merge($searchVariable,array($field_name => $fieldValue));
				 }
			}
		}
		
		if(Request::get('records_per_page')!=''){
			$searchVariable	=	array_merge($searchVariable,array('records_per_page' => Request::get('records_per_page')));
		}

		$recordPerPagePagination			=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page"); 
		
		$default_lang	 =   Setting::where('key_value','default_language.language_code')->pluck('value')->toArray();
		$sortBy 		 = 	(Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
	    $order  		 = 	(Request::get('order')) ? Request::get('order')   : 'DESC';
	   
		$model 			 = 	$DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
		
		return  View::make("Language::index",compact('sortBy','order', 'model','searchVariable','default_lang'));
	}//end listLanguage()
	
	
	
	 /**
	 * Function for display add languages page
	 *
	 * @param null
	 *
	 * @return view page. 
	 */	
	public function addLanguage(){
		
		### breadcrumbs Start ###
		// Breadcrums   is  added   here dynamically
		#Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"),route('AdminDashBoard.index'));
		#Breadcrumb::addBreadcrumb(trans("messages.$this->model.breadcrumbs_module"),route($this->model.'.index'));;
		#Breadcrumb::addBreadcrumb(trans("messages.$this->model.breadcrumbs_add"),'');
		#$breadcrumbs 	= 	Breadcrumb::generate();
		
		### breadcrumbs End ###
		return  View::make("Language::add",compact());
	}//end addLanguage()
	

	 /**
	 * Function for save added languages
	 *
	 * @param null
	 *
	 * @return view page. 
	 */	
	public function saveLanguage(){
		$formData	=	Request::all();
			
			if(!empty($formData)){
				$validator = Validator::make(
					Request::all(),
					array(
						'title'				=> 'required',
						'languagecode' 		=> 'required|unique:languages,lang_code',
						'foldercode' 		=> 'required|unique:languages,folder_code',
						)
					);
			}
			
			if ($validator->fails()){
				 return Redirect::back()->withErrors($validator)->withInput();
			}else{
					Language::insert(
						array(
							'title' => Request::get('title'),
							'lang_code' => Request::get('languagecode'),
							'folder_code'=> Request::get('foldercode')
						)
					);
			Session::flash('success',  trans("messages.$this->model.added_message"));  
			return Redirect::route("$this->model.index");
			
		}
	}//end saveLanguage()



	/**
	 * Function for update active/inactive status
	 *
	 * @param $Id and $status 
	 *
	 * @return view page. 
	 */	
	public function updateLanguageStatus($modelId = 0,$modelStatus=0){
		Language::where('id', '=', $modelId)->update(array('is_active' => (int)$modelStatus));
		Session::flash('success', trans("messages.$this->model.status_updated_message")); 
		return Redirect::route("$this->model.index");
		
	}//end updateLanguageStatus()
	
	
	
	/**
	 * Function for delete language
	 *
	 * @param $Id as language id
	 *
	 * @return view page. 
	 */	
	public function deleteLanguage($modelId = 0){
		if($modelId){
			$model = Language::findorFail($modelId);
			$model->delete();
			Session::flash('success',trans("messages.$this->model.deleted_message")); 
		}
		return Redirect::route("$this->model.index");
	}//end deleteLanguage()
	
	
	
	/**
	 * Function for set defaultlanguage
	 *
	 * @param $language_id as language id
	 * $name as title
	 * $folder_code as folder code 
	 *
	 * @return view page. 
	 */	
	public function updateDefaultLanguage($language_id = 0, $name = 0,$folder_code=0){
		
		//delete existing record
		 $obj	 =  Setting::where('key_value','default_language.language_code')->delete();
		 $obj	 =  Setting::where('key_value','default_language.name')->delete();
	     $obj	 =  Setting::where('key_value','default_language.folder_code')->delete();
	    
	    //insert into settings table
	    
	    $languageDataArray = array(
			'0'=> array(
					'key_value'=>'default_language.language_code',
					'value'=>$language_id,
					'title'=>'Default language for front',
					'input_type'=>'text',
					'editable'=>'1',
					//'created_at'=>new \MongoDB\BSON\UTCDateTime()
				),
			'1'=>array(
					'key_value'=>'default_language.name',
					'value'=>$name,
					'title'=>'Default language name',
					'input_type'=>'text',
					'editable'=>'1',
					//'created_at'=>new \MongoDB\BSON\UTCDateTime()
				),
			'2'=>array(
					'key_value'=>'default_language.folder_code',
					'value'=>$folder_code,
					'title'=>'Default language folder code',
					'input_type'=>'text',
					'editable'=>'1',
					//'created_at'=>new \MongoDB\BSON\UTCDateTime()
				)
		);
	   
	   foreach($languageDataArray as $value){
			Setting::insert($value);
		} 
		//write into file
		$this->settingFileWrite();
		Session::put('language_id',$language_id);
		Session::flash('success',trans("messages.languages.language_mark_default_message")); 	
		return Redirect::route("$this->model.index");
	}//end updateDefaultLanguage()



	/**
	 * function for write file on update and create
	 *
	 *@param null
	 *
	 * @return void
	 */	
	public function settingFileWrite() {
		$DB		=	Setting::query();
		$list	=	$DB->orderBy('key_value','ASC')->get(array('key_value','value'))->toArray();
		
        $file = SETTING_FILE_PATH;
		$settingfile = '<?php ' . "\n";
		foreach($list as $value){
			$val		  =	 str_replace('"',"'",$value['value']);
			$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key_value'].'", "'.$val.'");' . "\n"; 
		}
		$bytes_written = File::put($file, $settingfile);
		if ($bytes_written === false)
		{
			die("Error writing to file");
		}
	}//end settingFileWrite()
	
	
	
	/**
	 * Function for delete,active,deactive user
	 *
	 * @param $userId as id of users
	 *
	 * @return redirect page. 
	 */
	public function performMultipleAction(){
		if(Request::ajax()){
			$actionType = ((Request::get('type'))) ? Request::get('type') : '';
		
			if(!empty($actionType) && !empty(Request::get('ids'))){
				
				if($actionType	==	'active'){
					Language::whereIn('id', Request::get('ids'))->update(array('is_active' => 1));
				}
				elseif($actionType	==	'inactive'){
					$currentLanguageId			=	Config::get('default_language.language_code'); 
					foreach(Request::get('ids') as $key => $val){
						if($val != $currentLanguageId){
							Language::where('id', $val)->update(array('is_active' => 0));
						}
					}
				}
				elseif($actionType	==	'delete'){
					$currentLanguageId			=	Config::get('default_language.language_code'); 
					foreach(Request::get('ids') as $key => $val){
						if($val != $currentLanguageId){
							Language::where('id', $val)->delete();
						}
					}
				}
				Session::flash('success', trans("messages.global.action_performed_message")); 
			}
		}
	}//end performMultipleAction()
	
}//end LanguageController
