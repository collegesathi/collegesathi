<?php
namespace App\Modules\Faq\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\Faq\Models\Faq;
use App\Modules\Faq\Models\FaqDescription;
use CustomHelper;
use Config,DB,File,Hash,Input,Redirect,Request,Session,URL,View,Validator,Route,ValidationHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
 
/**
 * Faqs Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/faq
 */
 
class FaqController extends BaseController {

	 /**
	 * Function for display list of all faq's
	 *
	 * @param null
	 *
	 * @return view page. 
	 */
	 
	public $model	=	'Faq';
	public $FaqModel   = 'Faq';
	
	
	public function __construct() {
		View::share('modelName',$this->model);
		View::share('FaqModel', $this->FaqModel);
	}
	
	
	/**
		* Function for display all Faq
		*
		* @param null
		*
		* @return view page.
	*/
	public function listFaq($uni_id = null, $course_id = null){
		$DB				=	Faq::query();
		$searchVariable	=	array(); 
		$inputGet		=	Request::Input();
		
	
		if(Request::Input() && isset($inputGet['display'])|| isset($inputGet['page'])){
			$searchData	=	Request::Input();
			unset($searchData['display']);
			unset($searchData['_token']);
			
			if(isset($searchData['page'])){
				unset($searchData['page']);
			}
			
			if(isset($searchData['records_per_page'])){
				unset($searchData['records_per_page']);
			}
			
			foreach($searchData as $fieldName => $fieldValue){
				$fieldValue	=	trim($fieldValue);
				if($fieldValue != ''){
					if($fieldName=='category_id'){
						$DB->where("category_id",$fieldValue);
					}elseif($fieldName == 'active' ){ 
						$DB->where('is_active',(int)$fieldValue);
					}else{
						$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
				}
				$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
			}
		}
		if(Request::get('records_per_page')!=''){
			$searchVariable	=	array_merge($searchVariable,array('records_per_page' => $inputGet['records_per_page'] ));
		}
		$sortBy 		= (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
	    $order 			= (Request::get('order')) ? Request::get('order')   : 'DESC';
		$recordPerPage	= (Request::get('records_per_page')!='') ? Request::get('records_per_page'):CustomHelper::getConfigValue("Reading.records_per_page");  
		$model 					=  $DB->where('uni_id',$uni_id)->where('course_id',$course_id)->orderBy($sortBy, $order)->paginate((int)$recordPerPage);

		$currentRoute = Route::currentRouteName();
        $universityFaq = false;
		$courseFaq = false;
        if($currentRoute == "UniversityFaq.index"){
            $universityFaq =true;
        } elseif($currentRoute == 'CourseFaq.index'){
			$courseFaq = true;
		}
		
		
		return  View::make("Faq::index",compact('recordPerPage','model','searchVariable','sortBy','order','universityFaq','uni_id','course_id','courseFaq'));
	}// end listFaq()
	
	
	
	 /**
	 * Function for display page for add faq
	 *
	 * @param null
	 *
	 * @return view page. 
	 */
	public function addFaq($uni_id = null, $course_id = null){
		$currentRoute = Route::currentRouteName();
        $universityFaq = false;
		$courseFaq = false;
        if($currentRoute == "UniversityFaq.add"){
            $universityFaq =true;
        } elseif($currentRoute == 'CourseFaq.add'){
			$courseFaq = true;
		}
		return  View::make("Faq::add",compact('universityFaq','uni_id','course_id','courseFaq'));
	}// end addFaq()
	
	 /**
	 * Function for save created faq
	 *
	 * @param null
	 *
	 * @return redirect page. 
	 */
	function saveFaq($uni_id = null, $course_id = null){
		$formData  = Request::all();
		$validator = Validator::make(
			array(
				'question' 			=> $formData['question'],
				'answer' 			=> $formData['answer'],
				'faq_order'			=> $formData['faq_order'],
			),
			array(
				'question' 			=> 'required|max:' . CMS_PAGE_NAME_LIMIT,
				'answer' 			=> 'required',
				'faq_order'         =>'required|integer|unique_faq:'.$uni_id . ',,' . $course_id,
			),
			array(
				'question.required'             =>  trans('messages.question.REQUIRED_ERROR'),  	
				'answer.required' 	       		=>  trans('messages.answer.REQUIRED_ERROR'), 	
				'faq_order.required'			=>  trans('messages.order.REQUIRED_ERROR'), 	
				'faq_order.integer'				=>	trans('messages.order.faq_order_integer_error'), 	
				'faq_order.unique_faq'     =>	trans('messages.order.order_unique_faq_error'),
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()
				->withErrors($validator)->withInput();
		}else{
			$model 					= new Faq;
			$model->uni_id = isset($formData['uni_id']) ? $formData['uni_id'] : null;
			$model->course_id = isset($formData['course_id']) ? $formData['course_id'] : null;
			$model->question 		= ucfirst($formData['question']);
			$model->answer   		= ucfirst($formData['answer'])	;
			$model->faq_order    	= $formData['faq_order'];
			$model->is_active       = ACTIVE;			
 			$model->save();
		}
		Session::flash('success',  trans("messages.$this->model.added_message")); 

		if($uni_id != null && $course_id == null){
			return Redirect::route("UniversityFaq.index",$uni_id);
		} elseif($uni_id != null && $course_id != null){
			return Redirect::route("CourseFaq.index",[$uni_id,$course_id]);
		}else{
			return Redirect::route("$this->model.index");
		}
		
	}// end saveFaq()
	
	 /**
	 * Function for display page for edit faq
	 *
	 * @param $Id as id of faq
	 *
	 * @return view page. 
	 */
	public function editFaq($modelId,$uni_id = null, $course_id = null){
		$result				=	Faq::findorFail($modelId);
		
		$currentRoute = Route::currentRouteName();
        $universityFaq = false;
		$courseFaq = false;
        if($currentRoute == "UniversityFaq.edit"){
            $universityFaq =true;
        } elseif($currentRoute == 'CourseFaq.edit'){
			$courseFaq = true;
		}
		return  View::make("Faq::edit",compact('result','universityFaq','uni_id','course_id','courseFaq'));
	}//editFaq()
	
	/**
	 * Function for update faq
	 *
	 * @param $Id as id of faq
	 *
	 * @return redirect page. 
	*/	
	function updateFaq($modelId,$uni_id = null,$course_id = null){
		$model 					= 	Faq:: findorFail($modelId);
		$thisData				=	Request::all();
		$validator = Validator::make(
			array(
				'question' 		=> $thisData['question'],
				'answer' 		=> $thisData['answer'],
				'faq_order'		=> $thisData['faq_order'],
			),
			array(
				'question' 		=> 'required|max:' . CMS_PAGE_NAME_LIMIT,
				'answer' 		=> 'required',
				'faq_order'         =>'required|integer|unique_faq:'.$uni_id.',' . $modelId . ',' . $course_id
			),
			array(
				'question.required'             =>  trans('messages.question.REQUIRED_ERROR'),  	
				'answer.required' 	       		=>  trans('messages.answer.REQUIRED_ERROR'), 	
				'faq_order.required'			=>  trans('messages.order.REQUIRED_ERROR'), 	
				'faq_order.integer'				=>	trans('messages.order.faq_order_integer_error'), 	
				'faq_order.unique_faq'         =>	trans('messages.order.order_unique_faq_error'),
			)
		);
		
		if ($validator->fails()){	
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			$model->question 		= ucfirst($thisData['question']);
			$model->answer   		= ucfirst($thisData['answer']);
			$model->faq_order 		= $thisData['faq_order'];
			$model->save();
			Session::flash('success',  trans("messages.$this->model.updated_message"));

			if(!$uni_id == null && $course_id == null){
				return Redirect::route("UniversityFaq.index",$uni_id);
            }elseif(!$uni_id == null && !$course_id == null){
				return Redirect::route("CourseFaq.index",[$uni_id,$course_id]);
            }else{
				return Redirect::route("$this->model.index");
			}
		}
	} // end updateFaq()
		
	/**
	 * Function for update faq status
	 *
	 * @param $modelId as id of faq
	 * @param $modelStatus as status of faq
	 *
	 * @return redirect page. 
	 */	
	public function updateFaqStatus($modelId = 0, $modelStatus = 0,$uni_id = null,$course_id = null){
		Faq::where('id', '=', $modelId)->update(array('is_active' => (int)$modelStatus));
		Session::flash('success', trans("messages.$this->model.status_updated_message")); 
		if(!$uni_id == null && $course_id == null){
			return Redirect::route("UniversityFaq.index",$uni_id);
		}elseif(!$uni_id == null && !$course_id == null){
			return Redirect::route("CourseFaq.index",[$uni_id,$course_id]);
		}else{
			return Redirect::route("$this->model.index");
		}
	}// end updateFaqStatus()
	
	/**
	 * Function for delete faq
	 *
	 * @param $modelId as id of faq
	 *
	 * @return redirect page. 
	 */	
	public function deleteFaq($modelId = 0,$uni_id = null,$course_id = null){
		if($modelId){
			Faq::where('id',$modelId)->delete();
			Session::flash('success',trans("messages.$this->model.deleted_message")); 
		}
		
		if(!$uni_id == null && $course_id == null){
			return Redirect::route("UniversityFaq.index",$uni_id);
		}elseif(!$uni_id == null && !$course_id == null){
			return Redirect::route("CourseFaq.index",[$uni_id,$course_id]);
		}else{
			return Redirect::route("$this->model.index");
		}
	} // end deleteFaq()
	
	
	/**
	 * Function for view faq
	 *
	 * @param $Id as id of faq
	 *
	 * @return redirect page. 
	*/	
	public function viewFaq($id,$uni_id = null,$course_id = null){

		$result	=	Faq::find($id);
		
		$currentRoute = Route::currentRouteName();
        $universityFaq = false;
		$courseFaq = false;
        if($currentRoute == "UniversityFaq.view"){
			$universityFaq =true;
        } elseif($currentRoute == 'CourseFaq.view'){
			$courseFaq = true;
		}
		
		return  View::make('Faq::view',compact('result','universityFaq','uni_id','course_id','courseFaq'));
	}//end viewFaq()   
	
	
		
	/**
	 * Function for delete,active,deactive faqs
	 *
	 * @param null
	 *
	 * @return redirect page. 
	 */
 		
	public function performMultipleAction(){
		if(Request::ajax()){
			
			$actionType = ((Request::get('type'))) ? Request::get('type') : '';
			if(!empty($actionType) && !empty(Request::get('ids'))){
				if($actionType	==	'active'){
					Faq::whereIn('id', Request::get('ids'))->update(array('is_active' => ACTIVE));
				}
				elseif($actionType	==	'inactive'){
					Faq::whereIn('id', Request::get('ids'))->update(array('is_active' => INACTIVE));
				}
				elseif($actionType	==	'delete'){
					FaqDescription::whereIn('parent_id',Request::get('ids'))->delete();
					Faq::whereIn('id', Request::get('ids'))->delete();
				}
				
				Session::flash('success', trans("messages.global.action_performed_message")); 
			}
		}
	}//end performMultipleAction()
	 
}// end FaqsController
