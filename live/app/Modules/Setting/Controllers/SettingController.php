<?php

/**
 * Settings Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/settings
 */
namespace App\Modules\Setting\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\Setting\Models\Setting;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator,Artisan;
use App\Services\SendMailService;

class SettingController extends BaseController {

	public $model	=	'Setting';

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
	public function listSetting(){
		$DB	=	Setting::query();
		$searchVariable	=	array();
		$inputGet		=	Request::all();
		if ($inputGet && isset($inputGet['display'])) {
			$searchData	=	Request::all();
			unset($searchData['display']);
			unset($searchData['_token']);
			unset($searchData['sortBy']);
            unset($searchData['order']);

			if(isset($searchData['records_per_page'])){
				unset($searchData['records_per_page']);
			}
			if(isset($searchData['page'])){
				unset($searchData['page']);
			}
			foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue)){
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
		}

		if(Request::get('records_per_page')!=''){
			$searchVariable	=	array_merge($searchVariable,array('records_per_page' => Request::get('records_per_page')));
		}

		$recordPerPagePagination	=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page");

		$sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
	    $order  = (Request::get('order')) ? Request::get('order')   : 'DESC';
		$model = $DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);

		return  View::make("Setting::index",compact( 'model','searchVariable','sortBy','order','recordPerPagePagination'));
	} // end listSetting()

	/**
	 * prefix function
	 *
	 * @param $prefix as prefix
	 *
	 * @return void
	 */
	public function prefix($prefix = null) {
		$result = Setting::where('key_value', 'like', $prefix.'%')->orderBy('weight', 'ASC')->get()->toArray();

		$oldval		=	false;
		$old_answer  = request()->old('Setting'); 
		if($old_answer){
			$oldval		=	true;
		} 
        return  View::make("Setting::prefix",compact( 'result','prefix','oldval','old_answer'));
	}// end prefix()

	/**
	 * update prefix function
	 *
	 * @param $prefix as prefix
	 *
	 * @return void
	 */

	public function updatePrefix($prefix = null){
		$allData	=	Request::all();
		$pastData	=	[];
		$validate 	= 	array( );
		$message 	= 	array( );

		if(!empty($allData)){
			foreach($allData['Setting'] as $key => $value){
				$key_value	=	str_replace($prefix.".","", $value['key_value']);
				if($value['type'] == 'checkbox'){
					$val	=	(isset($value['value'])) ? 1 : 0;
				}
				else{
					$val	=	(isset($value['value'])) ? $value['value'] : '';
				}
				$pastData[$key_value] = $val;
			}
		}

		if($prefix == 'Site'){
            $siteSettingKey = Config::get("SITE_SETTING_KEY");

            foreach($siteSettingKey as $siteSettingValidatiopnKey){
				$validate[$siteSettingValidatiopnKey] 				= 	'required';
				$message[$siteSettingValidatiopnKey.'.required']	=	'This field is required.';
			}
		}
		else {
			$validate = array();
			$message = array();
		}


		$validator = Validator::make( $pastData, $validate , $message );
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
        }
		else {
			if(!empty($allData)){
				if(!empty($allData['Setting'])){
					foreach($allData['Setting'] as $key => $value){
						if(!empty($value['id']) && !empty($value['key_value'])){

							if($value['type'] == 'checkbox'){
								$val	=	(isset($value['value'])) ? 1 : 0;
							}
							else{
								$val	=	(isset($value['value'])) ? $value['value'] : '';
							}
							if($value['type'] == 'select'){
								Setting::where('id', $value['id'])->update(array(
									'key_value'   	 		=>  $value['key_value'],
									'default_type' 			=>  $val
								));
							}
							else{
								Setting::where('id', $value['id'])->update(array(
									'key_value'   	 	=>  $value['key_value'],
									'value' 			=>  $val
								));
							}
						}
					}
				}
			}

			

			$this->settingFileWrite();
			Session::flash('success',  trans("messages.$this->model.updated_message"));
			return Redirect::route("$this->model.prefix_index",array($prefix));
		}
	}//updatePrefix()

	/**
	 * function add new settings view page
	 *
	 *@param null
	 * @return void
	 */
	public function addSetting(){
		return  View::make("Setting::add");
	}//end addSetting()

	/**
	 * function for save added new settings
	 *
	 *@param null
	 *
	 * @return void
	 */
	public function saveSetting(){
		$validator  = 	Validator::make(
			Request::all(),
			array(
				'title' 		=> 'required',
				'key' 			=> 'required',
				'value' 		=> 'required',
				'input_type' 	=> 'required'
			),
			array(
				'title.required' => trans('messages.settings.please_enter_title'),
				'key.required' => trans('messages.settings.please_enter_key'),
				'value.required' => trans('messages.settings.please_enter_value'),
            )
		);
		if ($validator->fails())
		{
			return Redirect::back()
				->withErrors($validator)->withInput();
		}else{

			$obj	 				= new Setting;
			$obj->title    			= Request::get('title');
			$obj->key_value   		= Request::get('key');
			$obj->value   			= Request::get('value');
			$obj->input_type   		= Request::get('input_type');
			$obj->editable  		= ACTIVE;
			$obj->save();
		}
		$this->settingFileWrite();
		Session::flash('success',  trans("messages.$this->model.added_message"));
		return Redirect::route("$this->model.index");
	}//end saveSetting()

	/**
	 * function edit settings view page
	 *
	 *@param $Id as Id
	 *
	 * @return void
	 */
	public function editSetting($modelId){
		$model			 = 	Setting::findorFail($modelId);
		return  View::make("Setting::edit",compact( 'model'));
	}//end editSetting()

	/**
	 * function for update setting
	 *
	 * @param $Id as Id
	 *
	 * @return void
	 */
	public function updateSetting($Id){

		$validator  = 	Validator::make(
			Request::all(),
			array(
				'title' 		=> 'required',
				'key' 			=> 'required',
				'value' 		=> 'required',
				'input_type' 	=> 'required'
			),
			array(
				'title.required' => trans('messages.settings.please_enter_title'),
				'key.required' => trans('messages.settings.please_enter_key'),
				'value.required' => trans('messages.settings.please_enter_value'),
            )
		);
		if ($validator->fails())
		{
			return Redirect::back()
				->withErrors($validator)->withInput();
		}else{
			$obj	 				=  Setting::find($Id);
			$obj->title    			= Request::get('title');
			$obj->key_value   		= Request::get('key');
			$obj->value   			= Request::get('value');
			$obj->input_type   		= Request::get('input_type');
			$obj->editable  		= ACTIVE;
			$obj->save();
		}
		$this->settingFileWrite();
		Session::flash('success',  trans("messages.$this->model.updated_message"));
		return Redirect::route("$this->model.index");
	}//end updateSetting()

	/**
	 * function for delete setting
	 *
	 * @param $Id as Id
	 *
	 * @return void
	 */
	public function deleteSetting($Id = 0){
		if($Id){
			$obj	=  Setting::find($Id);
			$obj->delete();
		Session::flash('success',trans("messages.$this->model.deleted_message"));
		$this->settingFileWrite();
		return Redirect::route("$this->model.index");
	}//end deleteSetting()
	}

	/**
	 * function for write file on update and create
	 *
	 *@param $Id as Id
	 *
	 * @return void
	 */
	public function settingFileWrite() {
		$DB		=	Setting::query();
		$list	=	$DB->orderBy('key_value','ASC')->get(array('key_value','value','default_type','input_type'))->toArray();

		$maintenance_mode_val = '';

        $file = SETTING_FILE_PATH;
		$settingfile = '<?php ' . "\n";
		foreach($list as $value){
			$val		  =	 str_replace('"',"'",$value['value']);

			if($value['input_type']=='select'){
			 $val		  =	 trim($value['default_type']);
			}

			if($value['key_value']=='Reading.records_per_page' || $value['key_value']=='Site.debug' || $value['key_value']=='Reading.record_front_per_page'){
				$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key_value'].'", \''.htmlentities($val).'\');' . "\n";
			}else{
				$settingfile .=  '$app->make('.'"config"'.')->set("'.$value['key_value'].'", \''.htmlentities($val).'\');' . "\n";
			}

			if($value['key_value']=='Site.maintenance_mode') {

				$maintenance_mode_val = $value['value'];
			}

		}
		$bytes_written = File::put($file, $settingfile);
		if ($bytes_written === false)
		{
			die("Error writing to file");
		}



		if(!empty($maintenance_mode_val)) {
			$this->sendEmailSiteDown();
		}

	}//end settingFileWrite()


	private function sendEmailSiteDown() {

		$action 	= 	"site_maintenance_mode_on";
		$to     	=  	Config::get('Site.admin_email');

		$pool 		= 	'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    	$hashString = 	substr(str_shuffle(str_repeat($pool, 5)), 0, 16);

		
		$maintenanceURL =  WEBSITE_URL.'maintenance-mode/'.$hashString;
		$skipURL  		=  WEBSITE_URL.$hashString;
		$upURL  		=  WEBSITE_URL.'site-live';

		$to_name    =  'Admin';

		$rep_Array 	= 	array($maintenanceURL, $skipURL, $upURL);
        
        $sendMail 	= 	new SendMailService;
        $sendMail->callSendMail($to, $to_name, $rep_Array, $action);

        //Artisan::call('down', ['--secret' => $hashString]);


	}


}//end SettingsController class
