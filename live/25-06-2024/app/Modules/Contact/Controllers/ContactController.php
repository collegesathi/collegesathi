<?php
namespace App\Modules\Contact\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\Contact\Models\Contact;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;


/**
 * Contacts Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/contact
 */
class ContactController extends BaseController {

	public $model	=	'Contact';


	public function __construct() {
		View::share('modelName',$this->model);
	}

	
	/**
	 * Function for display list of  all contact
	 *
	 * @param null
	 *
	 * @return view page.
	 */
	public function listContact(){

		$DB = Contact::query();

		$searchVariable	=	array();
		$inputGet		=	Request::Input();


        if (Request::all()) {
            $searchData = Request::all();
            $searchVariable = Request::all();

            if (isset($searchData['display'])) {
                unset($searchData['display']);
            }

            if (isset($searchData['_token'])) {
                unset($searchData['_token']);
            }

            if (isset($searchData['sortBy'])) {
                unset($searchData['sortBy']);
            }

            if (isset($searchData['order'])) {
                unset($searchData['order']);
            }

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }

            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

            foreach($searchData as $fieldName => $fieldValue){
				if(!empty($fieldValue)){
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
				}
			}
        }



		$sortBy 	= 	(Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
	    $order  	= 	(Request::get('order')) ? Request::get('order')   : 'DESC';
		$recordPerPagePagination			=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page");

		$model 	= 	$DB->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);
		return  View::make("Contact::index",compact('recordPerPagePagination', 'model' ,'searchVariable','sortBy','order'));
	} // end listContact()


	/**
	 * Function for display contact detail
	 *
	 * @param $modelId as id of contact
	 *
	 * @return view page.
	 */
	public function viewContact($modelId = 0){
		 

		$model = Contact::findorFail($modelId);
		return  View::make("Contact::view", compact('model', 'modelId'));

	} // end viewContact()
	
	
	/**
	 * Function for display contact detail
	 *
	 * @param $modelId as id of contact
	 *
	 * @return view page.
	 */
	public function replyContact($modelId = 0){
		 
		$model = Contact::findorFail($modelId);
		return  View::make("Contact::reply", compact('model', 'modelId'));

	} // end replyContact()



	/**
	 * Function for delete contact
	 *
	 * @param $modelId as id
	 *
	 * @return redirect page.
	*/
	public function deleteContact($modelId = 0){
		if($modelId){
			$model = Contact::findorFail($modelId);
			/*$model->description()->delete();*/
			$model->delete();
			Session::flash('success',trans("messages.$this->model.deleted_message"));
		}
		return Redirect::route("$this->model.index");
	}// end deleteContact()



	/**
	 * Function to reply a user
	 *
	 * @param $modelId as id
	 *
	 * @return view page.
	*/
	public function replyToUser($Id){
		if(!empty(Request::all())){
			$validationRules	= array('message'	=> 'required');
			$validator = Validator::make(
						Request::all(),
						$validationRules
					);
			if($validator->fails()){
				 return Redirect::back()->withErrors($validator)->withInput();
			}else{
				$userData	=	Contact::where('id',$Id)->first();
				##### send email to user from admin,to inform user that your message has been received successfully #####

				$message	=	Request::get('message');
				$email		=	$userData->email;
				$name		=	$userData->name;
				$rep_Array 	=  	array($name,$message);
				$action		=	'reply_to_user';
				$this->callSendMail($email,$name,$rep_Array,$action);

				Session::flash('success','You have successfully replied to '. $name);
				return Redirect::route("$this->model.index");
			}

		}
	}//end replyToUser()

}// end ContactsController
