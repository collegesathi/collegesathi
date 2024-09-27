<?php
namespace App\Modules\Contact\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Contact\Models\Contact;
use App\Modules\Contact\Services\ContactService;
use App\Modules\University\Models\University;
use Auth,Session, Redirect, Request, View, Validator,CustomHelper;
use CURLFILE;


/**
	*  Controller
	*
	* Add your methods in the class below
	*
	* This file will render views from views/admin/usermgmt
**/
class ContactController extends BaseController {

	public $model			=	'Contact';
	public $customerModel	=	'Contact';

	public function __construct() {
		View::share('modelName',$this->model);
		View::share('customerModel',$this->customerModel);
	}


	public function add(){
		$data		=	(Auth::user());


		$stateList 		= 	[];
        $cityList 		= 	[];
  
		$dob 			= 	Request::old('dob');
        $old_country 	= 	Request::old('country');
        $old_state 		=	Request::old('state');



		if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId   = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }

        $universities = University::where('is_active',ACTIVE)->pluck('title', 'id')->toArray();

		return  View::make("Contact::front.add",compact('data','stateList','cityList','old_state','universities'));
	}


	/**
	* Function for save contact
	*
	* @param  null
	*
	* @return add . */
	public function save(){
		$formData   =   Request::all();
		if(!empty($formData)){
			$attribute	=   array( "from"=>"front","model"=>$this->model );
			$contact	=   new ContactService;
			$res		=   $contact->ContactValidateandSave($formData,$attribute,$this->model);
			if($res['data']['status'] == ERROR){
				if (isset($res['validator']) && !empty($res['validator'])) {
					$validator = $res['validator'];
					return Redirect::back()->withErrors($validator)->withInput();
				}
			}
			else{ 
				if($res['data']['status'] == 'success'){
					$redirect_url 	= route('Contact.add');
					Session::flash(SUCCESS, trans("messages.$this->model.added_message"));
					return Redirect::route('Contact.add');
				}
			}
        }
	}

}
