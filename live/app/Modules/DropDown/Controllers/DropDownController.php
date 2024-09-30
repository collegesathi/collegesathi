<?php
namespace App\Modules\DropDown\Controllers;
use App\Http\Controllers\BaseController;
use App\Modules\DropDown\Models\DropDown;
use App\Modules\DropDown\Models\DropDownDescription;
use App\Modules\Blog\Models\Blog;
use App\Modules\Forum\Models\Forum;
use FieldsTypeCastingHelper;
use CustomHelper;
use mjanssen\BreadcrumbsBundle\Breadcrumbs as Breadcrumb;
use Config,DB,Input,Redirect,Request,Session,View,Validator;

/**
 * DropDownController Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/dropdown
 */
class DropDownController extends BaseController {

	public $model	=	'DropDown';

	public function __construct() {
		View::share('modelName',$this->model);
	}
  

	/**
		* Function for display all DropDown
		*
		* @param $type as category of dropdown
		*
		* @return view page.
	*/
	public function listDropDown($type='', $id = ''){
		### breadcrumbs Start ###
		// Breadcrums   is  added   here dynamically
		/* Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"),route('AdminDashBoard.index'));
		Breadcrumb::addBreadcrumb(trans("messages.$this->model.$type.breadcrumbs_module"),route("$this->model.index","$type"));
		$breadcrumbs 	= 	Breadcrumb::generate(); */
		### breadcrumbs End ###
		
		if($id == ''){
			$DB				=	DropDown::query()->where('dropdown_type',$type)->where('dropdown_id',NULL);
		} else{
			$DB				=	DropDown::query()->where('dropdown_type',$type)->where('dropdown_id',$id);
		}

		$searchVariable	=	array();
		$inputGet		=	Request::all();


        if (Request::Input()) {
            $searchData = Request::Input();
            $searchVariable = Request::Input();

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
				$fieldValue	=	trim($fieldValue);
				if($fieldValue != ''){
					if($fieldName == 'active' ){
						$DB->where('status',FieldsTypeCastingHelper::typeCastActiveField($fieldValue));
					}else{
						$DB->where("$fieldName",'like','%'.$fieldValue.'%');
					}
				}
				$searchVariable	=	array_merge($searchVariable,array($fieldName => $fieldValue));
			}
        }

		$sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'updated_at';
	    $order  = (Request::get('order')) ? Request::get('order')   : 'DESC';

		$recordPerPage	=	(Request::get('records_per_page')!='') ? Request::get('records_per_page'):Config::get("Reading.records_per_page");

		$model = $DB->orderBy($sortBy, $order)->paginate(FieldsTypeCastingHelper::typeCastPaginate($recordPerPage));

		return  View::make("DropDown::index",compact('recordPerPage','model','searchVariable','sortBy','order','type', 'id'));
	}// end listDropDown()


	/**
		* Function for display page  for add new DropDown
		*
		* @param $type as category of dropdown
		*
		* @return view page.
	*/
	public function addDropDown($type='', $id = ''){
		### breadcrumbs Start ###
		// Breadcrums   is  added   here dynamically
		/* Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"),route('AdminDashBoard.index'));
		Breadcrumb::addBreadcrumb(trans("messages.$this->model.$type.breadcrumbs_module"),route("$this->model.index","$type"));
		Breadcrumb::addBreadcrumb(trans("messages.$this->model.$type.breadcrumbs_add"),'');
		$breadcrumbs 	= 	Breadcrumb::generate(); */
		### breadcrumbs End ###

		$pageTitle = trans("messages.$this->model.$type.breadcrumbs_add");

		$languages      		=   CustomHelper::getLanguageArrayWithCode();
        $language_code  		=   CustomHelper::getConfigValue('defaultLanguageCode');

		return  View::make("DropDown::add",compact('type','languages','language_code', 'pageTitle','id'));
	} //end addDropDown()


	/**
		* Function for save added DropDown page
		*
		* @param null
		*
		* @return redirect page.
	*/
	function saveDropDown($type='', $id = ''){
		$thisData				=	Request::all();

		$language_code  		=   CustomHelper::getConfigValue('defaultLanguageCode');
		$dafaultLanguageArray	=	$thisData['data'][$language_code];


		$validation_fields 		= array( 'name' =>  $dafaultLanguageArray['name'], 'dropdown_type'	=>	$type);
		$validation_rules 		= array('name' 	=>	'required|max:'.CMS_PAGE_NAME_LIMIT.'|unique_dropdown:'.$type);


		$validation_messages['name.unique_dropdown'] 	= 	trans('messages.dropdown.unique_dropdown');
		$validation_messages['name.required' ] 			= 	trans('messages.dropdown.name.required_dropdown');
		$validation_messages['name.max' ] 				= 	trans('messages.name.MAX_KEYWORD_LENGTH_ERROR', ['max' => CMS_PAGE_NAME_LIMIT]);


		
		if($id == ''){
			if(in_array($type, DROPDOWN_TYPES_FOR_DEGREE) || $type == 'badges' || $type == 'placement_partners'){            
				$validation_fields['image'] = isset($thisData['image']) ? $thisData['image'] : '';
				$validation_messages['image.mimes']    = trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]);
				$validation_messages['image.required'] = trans('messages.image.required_error');
				$validation_messages['image.max']      = trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]);
				$validation_rules['image'] = 'required|mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024);
			}
		}

		if(in_array($type, ['course'])){
			$validation_fields['full_name']				= isset($dafaultLanguageArray['full_name']) ? $dafaultLanguageArray['full_name'] : '';
			$validation_rules['full_name'] 				=	'required';
			$validation_messages['full_name.required' ]	=	trans('messages.dropdown.full_name.required_dropdown');
		}
		


		$validator = Validator::make($validation_fields,	$validation_rules,  $validation_messages);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			// echo 2;die;
			$model = new DropDown;
			$model->slug    				= CustomHelper::getSlug($dafaultLanguageArray['name'] ,'slug', "$this->model");
			$model->name    				= ucwords($dafaultLanguageArray['name']);
			$model->full_name				= isset($dafaultLanguageArray['full_name']) ? ucwords($dafaultLanguageArray['full_name']) : "";
			$model->dropdown_type    		= $type;

			if($id != ''){
				$model->dropdown_id    		= $id;
			}

			if($id == ''){
				if(in_array($type,DROPDOWN_TYPES_FOR_DEGREE) || $type == 'badges' ||  $type == 'placement_partners'){
					if (isset($thisData['image']) && !empty($thisData['image'])) {
						$extension = $thisData['image']->getClientOriginalExtension();
						$fileName = time() . '-dropdown-image.' . $extension;
						if ($thisData['image']->move(DROPDOWN_IMAGE_ROOT_PATH, $fileName)) {
							$model->image = $fileName;
						}
					}
				}
			}

			$model->status	    			= ACTIVE;
			$model->save();
			$modelId				=	$model->id;

			foreach ($thisData['data'] as $language_id => $descriptionResult) {
				$modelDescription					=  new DropDownDescription();
				$modelDescription->language_id		=	$language_id;
				$modelDescription->parent_id		=	$modelId;
				$modelDescription->name				=	$descriptionResult['name'];
				$modelDescription->full_name		=	($descriptionResult['full_name']) ?? "";
				$modelDescription->save();
			}

			if($id == ''){
				Session::flash('success',  trans("messages.$this->model.$type.added_message"));
			return Redirect::route("$this->model.index",$type);
			} else{
				Session::flash('success',  trans("messages.$this->model.$type.specification_added_message"));
				return Redirect::route("$this->model.courseSpecifications",[$type,$id]);
			}
		}
	}//end saveDropDown()


	/**
		* Function for display page  for edit DropDown page
		*
		* @param $Id ad id of DropDown
		* @param $type as category of dropdown
		*
		* @return view page.
	*/
	public function editDropDown($Id,$type,$dropdown_id = ''){
		$dropdown				=	DropDown::find($Id);
		$modelDescriptions		=	DropDownDescription::where('parent_id','=',$Id)->get();
		### breadcrumbs Start ###
		/* Breadcrumb::addBreadcrumb(trans("messages.global.breadcrumbs_dashboard"),route('AdminDashBoard.index'));
		Breadcrumb::addBreadcrumb(trans("messages.$this->model.$type.breadcrumbs_module"),route("$this->model.index","$type"));
		Breadcrumb::addBreadcrumb(trans("messages.$this->model.$type.breadcrumbs_edit"),'');
		$breadcrumbs 	= 	Breadcrumb::generate(); */
		$pageTitle 		= 	trans("messages.$this->model.$type.breadcrumbs_edit");
		### breadcrumbs End ###

		if (Request::old() != null) {
			$dropdown->name  = Request::old('name');
			$dropdown->dropdown_description  = Request::old('dropdown_description');
		}

		$multiLanguage	=	array();
		$languages      =   CustomHelper::getLanguageArrayWithCode();
		$language_code  =   CustomHelper::getConfigValue('defaultLanguageCode');


		if(!empty($modelDescriptions)){
			foreach($modelDescriptions as $modelDescription) {
				if (Request::old() != null) {
					$multiLanguage[$modelDescription->language_id]['name']			=	'';
					$multiLanguage[$modelDescription->language_id]['full_name']		=	'';
					$multiLanguage[$modelDescription->language_id]['dropdown_description']		=	'';
				} else {
					$multiLanguage[$modelDescription->language_id]['name']			=	$modelDescription->name;
					$multiLanguage[$modelDescription->language_id]['full_name']		=	$modelDescription->full_name;
					$multiLanguage[$modelDescription->language_id]['dropdown_description']		=	$modelDescription->dropdown_description;
				}
			}
		}

 		return  View::make("DropDown::edit",array('model' => $dropdown,'type'=>$type, 'languages' => $languages, 'language_code' => $language_code, 'multiLanguage' => $multiLanguage, 'pageTitle' => $pageTitle, 'dropdown_id' => $dropdown_id ));
	}// end editDropDown()


	/**
		* Function for update DropDown
		*
		* @param $Id ad id of DropDown
		* @param $type as category of dropdown
		*
		* @return redirect page.
	*/
	function updateDropDown($modelId,$type='', $dropdown_id = ''){
		// pr($dropdown_id);die;
		$this_data				=	Request::all();
		$model 					= 	DropDown::find($modelId);

		$language_code  		=   CustomHelper::getConfigValue('defaultLanguageCode');
		$dafaultLanguageArray	=	$this_data['data'][$language_code];

		$validation_fields 		= array( 'name' =>  $dafaultLanguageArray['name']);

		$validation_rules 		= array('name' 	=>	'required|max:200|unique_dropdown:'.$type.','.$modelId);
		$validation_messages ['name.unique_dropdown']	= 	trans('messages.dropdown.unique_dropdown');
		$validation_messages ['name.required' ]	= 	trans('messages.dropdown.name.required_dropdown');

		if($dropdown_id == ''){
			if(in_array($type, DROPDOWN_TYPES_FOR_DEGREE) || $type == 'badges' ||  $type == 'placement_partners'){
			 if (isset($this_data['image']) && !empty($this_data['image'])) {
				$validation_fields['image'] = $this_data['image'];
				$validation_messages['image.mimes']    = trans('messages.image.VALID_IMAGE_ERROR', ['file_extension' => IMAGE_EXTENSION]);
				$validation_messages['image.max']      = trans('messages.image.INVALID_file_SIZE', ['file_size' => IMAGE_UPLOAD_FILE_MAX_SIZE_TWO]);
				$validation_rules['image'] = 'nullable|mimes:' . IMAGE_EXTENSION . '|max:' . (IMAGE_UPLOAD_FILE_MAX_SIZE_TWO * 1024);
			 }
			}
		}

		if(in_array($type, ['course'])){
			$validation_fields['full_name']				=	$dafaultLanguageArray['full_name'];
			$validation_rules['full_name'] 				=	'required';
			$validation_messages['full_name.required' ]	=	trans('messages.dropdown.full_name.required_dropdown');
		}

		$validator = Validator::make($validation_fields, $validation_rules,  $validation_messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else{
			$model->name		= ucwords($dafaultLanguageArray['name']);
			$model->full_name	= isset($dafaultLanguageArray['full_name']) ? ucwords($dafaultLanguageArray['full_name']) : "";

			if($dropdown_id == ''){
				if(in_array($type,DROPDOWN_TYPES_FOR_DEGREE) || $type == 'badges' ||  $type == 'placement_partners'){
					if (isset($this_data['image']) && !empty($this_data['image'])) {
						$extension = $this_data['image']->getClientOriginalExtension();
						$fileName = time() . '-dropdown-image.' . $extension;
	
						if ($this_data['image']->move(DROPDOWN_IMAGE_ROOT_PATH, $fileName)) {
							$old_image = $model->image;
							@unlink(DROPDOWN_IMAGE_ROOT_PATH . $old_image);
							$model->image = $fileName;
						}
					}
				}
			}

			$model->save();

			$modelId				=	$model->id;

			foreach ($this_data['data'] as $language_id => $descriptionResult) {
				$modelDescription					=  new DropDownDescription();
				$modelDescription->language_id		=	$language_id;
				$modelDescription->parent_id		=	$modelId;
				$modelDescription->name				=	$descriptionResult['name'];
				$modelDescription->full_name		=	($descriptionResult['full_name']) ?? "";
				$modelDescription->save();
			}


			

			if($dropdown_id == ''){
				Session::flash('success',  trans("messages.$this->model.$type.updated_message"));
				return Redirect::route("$this->model.index",$type);
			} else{
				Session::flash('success',  trans("messages.$this->model.$type.specification_updated_message"));
				return Redirect::route("$this->model.courseSpecifications",[$type,$dropdown_id]);
			}
		}
	}// end updateDropDown()


	/**
		* Function for update DropDown  status
		*
		* @param $Id as id of DropDown
		* @param $Status as status of DropDown
		* @param $type as category of dropdown
		*
		* @return redirect page.
	*/
	public function updateDropDownStatus($modelId = 0, $modelStatus = 0,$type= ''){
		DropDown::where('id', '=', $modelId)->update(array('status' => FieldsTypeCastingHelper::typeCastActiveField($modelStatus)));

		if($type == 'blog'){
			Blog::where('category_id', '=', $modelId)->update(array('is_active' => (int)$modelStatus));
		}

		if($type == 'forum'){
			Forum::where('category_id', '=', $modelId)->update(array('is_active' => (int)$modelStatus));
		}

		if($type == 'course'){
			DropDown::where('dropdown_id', '=', $modelId)->update(array('status' => FieldsTypeCastingHelper::typeCastActiveField($modelStatus)));
		}

		Session::flash('success', trans("messages.$this->model.status_updated_message"));
		return Redirect::back();
	}// end updateDropDownStatus()


	/**
		* Function for multiple delete
		*
		* @param $type as type of dropdown
		*
		* @return redirect page.
	*/
	public function performMultipleAction(){
		if(Request::ajax()){

			$actionType = ((Request::get('type'))) ? Request::get('type') : '';
			$dropdownType = ((Request::get('dropdown_type'))) ? Request::get('dropdown_type') : '';
			if(!empty($actionType) && !empty(Request::get('ids'))){
				if($actionType	==	'active'){
					DropDown::whereIn('id', Request::get('ids'))->update(array('status' => ACTIVE));
				}
				elseif($actionType	==	'inactive'){
					DropDown::whereIn('id', Request::get('ids'))->update(array('status' => INACTIVE));

					if($dropdownType == 'blog'){
						Blog::whereIn('category_id', Request::get('ids'))->update(array('is_active' => INACTIVE));
					}

					if($dropdownType == 'forum'){
						Forum::whereIn('category_id', Request::get('ids'))->update(array('is_active' => INACTIVE));
					}
				}
				Session::flash('success', trans("messages.global.action_performed_message"));
			}
		}
	}//end performMultipleAction()


}// end DropDownController
