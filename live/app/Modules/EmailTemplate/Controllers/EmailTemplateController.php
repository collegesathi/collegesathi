<?php
namespace App\Modules\EmailTemplate\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\EmailTemplate\Models\EmailTemplate;
use App\Modules\EmailTemplate\Models\EmailAction;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Input,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;

/**
 * Emailtemplate Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/emailtemplates
 */

class EmailTemplateController extends BaseController {

    public $model   =   'EmailTemplate';

    public function __construct() {
        View::share('modelName',$this->model);
    }

    /**
     * Function for display list of all email templates
     *
     * @param null
     *
     * @return view page.
     */

    public function listTemplate(){

        $DB             =   EmailTemplate::query();
        $searchVariable =   array();
        $inputGet       =   Request::Input();


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
                    $searchVariable =   array_merge($searchVariable,array($fieldName => $fieldValue));
                }
            }
        }



        $sortBy     = (Request::get('sortBy')) ? Request::get('sortBy') : 'subject';
        $order      = (Request::get('order')) ? Request::get('order')   : 'ASC';
        $recordPerPagePagination            =   (Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page");

        $model      =   $DB->where('status', ACTIVE)->orderBy($sortBy, $order)->paginate((int)$recordPerPagePagination);

        return  View::make("EmailTemplate::index",compact('recordPerPagePagination', 'model','searchVariable','sortBy','order'));
    }// end listTemplate()

     /**
     * Function for display page for add email template
     *
     * @param null
     *
     * @return view page.
     */
    public function addTemplate(){
        $Action_options =   EmailAction::pluck('action','action');
        return  View::make("EmailTemplate::add",compact('Action_options' ));

    }// end addTemplate()

 /**
 * Function for display save email template
 *
 * @param null
 *
 * @return redirect page.
 */
    public function saveTemplate(){
        $validator = Validator::make(
            Request::all(),
            array(
                'name'          => 'required',
                'subject'       => 'required',
                'action'        => 'required',
                'body'          => 'required'
            )
        );
        if ($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)->withInput();
        }else{
			$obj            =   new EmailTemplate;
            $obj->name      =   ucfirst(Request::get('name'));
            $obj->subject   =   ucfirst(Request::get('subject'));
            $obj->action  	=   Request::get('action');
            $obj->body      =   Request::get('body');
            $obj->save();
			Session::flash('success',  trans("messages.$this->model.added_message"));
            return Redirect::route("EmailTemplate.index");
        }
    }//  end saveTemplate()

    /**
     * Function for display page for edit email template page
     *
     * @param $Id as id of email template
     *
     * @return view page.
     */
    public function editTemplate($modelId){
        $Action_options =   EmailAction::pluck('action','action')->toArray();
        $model          =   EmailTemplate::find($modelId);

        if (Request::Old() != null) {
            $model->name = Request::Old('name');
            $model->subject = Request::Old('subject');
            $model->body = Request::Old('body');
        }
        return  View::make("EmailTemplate::edit",compact('Action_options','model'));
    } // end editTemplate()

    /**
     * Function for update email template
     *
     * @param $Id as id of email template
     *
     * @return redirect page.
     */
    public function updateTemplate($Id=0){
        $validator = Validator::make(
            Request::all(),
            array(
                'name'          => 'required',
                'subject'       => 'required',
                'body'          => 'required'
            )
        );
        if ($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)->withInput();
        }else{

            $obj            =   EmailTemplate::find($Id);
            $obj->name      =   ucfirst(Request::get('name'));
            $obj->subject   =   ucfirst(Request::get('subject'));
            $obj->body      =   Request::get('body');
            $obj->save();

            Session::flash('success',  trans("messages.$this->model.updated_message"));
            return Redirect::route("EmailTemplate.index");
        }
    } // end updateTemplate()

     /**
     * Function for get all  defined constant  for email template
     *
     * @param null
     *
     * @return all  constant defined for template.
     */
    public function getConstant(){
        if(Request::ajax() && Request::Input()){
            $constantName   =   Request::Input('constant');
			$options    	= [];
			$options_array    	= [];
			if(isset($constantName) && $constantName != ''){
				$options =   EmailAction::where('action', '=', $constantName)->pluck('options','action');
				$options_array = explode(',',$options[$constantName]);
			}
			echo json_encode($options_array);
        }
        exit;
    }// end getConstant()

    /**
     * Function for delete multiple template
     *
     * @param null
     *
     * @return view page.
     */
    public function performMultipleAction(){
        if(Request::ajax()){
            $actionType = ((Input::get('type'))) ? Input::get('type') : '';
            if(!empty($actionType) && !empty(Input::get('ids'))){
                if($actionType  ==  'delete'){
                    EmailTemplate::whereIn('id', Input::get('ids'))->delete();
                    Session::flash('success', trans("messages.global.action_performed_message"));
                }
            }
        }
    }//end performMultipleAction()

}// end EmailtemplateController
