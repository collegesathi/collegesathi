<?php
namespace App\Modules\Testimonial\Services;
use App\Modules\Testimonial\Models\Testimonial;
use Auth,ValidationHelper,CustomHelper,Validator,Config,Input,DB,Request;

/**
* Testimonial Service here
*
* Add your methods in the class below
*
*/

class TestimonialService {


	public function list($formData = array(), $attribute = array())
    {

        $DB = Testimonial::query();
        $searchVariable = array();
        $response = [];



        if ((Request::all() || isset($formData['display'])) || isset($formData['page'])) {
            $searchData = Request::all();
            unset($searchData['display']);
            unset($searchData['_token']);

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }
            $start_date = $end_date = '';

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'search') {
                        $DB->where("client_name", 'like', '%' . $fieldValue . '%');
                      }
                     elseif ($fieldName == 'created_at') {
                        if (!empty($formData('created_at'))) {
                            $start_date = $formData('created_at');
                        }
                    } elseif ($fieldName == 'updated_at') {
                        if (!empty($formData('updated_at'))) {
                            $end_date = $formData('updated_at');
                        }
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }

                }

                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }


        if (isset($formData['records_per_page']) && $formData['records_per_page'] != '') {
            $searchVariable = array_merge($searchVariable, array('records_per_page' => $formData['records_per_page']));
        }

        $sortBy = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
        $order = (isset($formData['order'])) ? $formData['order'] : 'DESC';
         $recordPerPage = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        // $result = $DB->where('is_active', ACTIVE)
        //     ->orderBy($sortBy, $order)
        //     ->paginate($recordPerPage);

		$result   = Testimonial::where(['is_active' => (int)ACTIVE])->get();


        $status = SUCCESS;


        $response['sort_by'] = $sortBy;
        $response['order'] = $order;
        $response['searchVariable'] = $searchVariable;
        $response['result'] = $result;
        $response['status'] = $status;

        $res = array('data' => $response);

        return $res;
    }







































/**
 * Function for get TestimonialDetail
 *
 * @param $formData,
 * @param @attribute
 *
 * @return redirect page. 
 * 
 * 
*/	
public function getTestimonialDetail($formData = array(),$attribute = array()){
	
	$DB 			= 	Testimonial::with('descriptionData');
	$searchVariable	=	array(); 
	$response		=	[];
	/** 
	* seacrching on the basis of username and email 
	**/		
	
	if ((Request::all() && isset($formData['display'])) || isset($formData['page']) ) {
		$searchData	=	Request::all();
		unset($searchData['display']);
		unset($searchData['_token']);
		
		if(isset($searchData['page'])){
			unset($searchData['page']);
		}
		if(isset($searchData['records_per_page'])){
			unset($searchData['records_per_page']);
		}
		$start_date	= $end_date	=	'';
		
		foreach($searchData as $fieldName => $fieldValue){
			$fieldValue	=	trim($fieldValue);		
			if($fieldValue != ''){
				if($fieldName == 'is_active' ){
					$DB->where('is_active',(int)$fieldValue);
				}
				
				else{
					$DB->where("$fieldName",'like','%'.$fieldValue.'%');
				}
			}

			$searchVariable	=array_merge($searchVariable,array($fieldName => $fieldValue));
		}
	}

	$sortBy 				= 	(isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
	$order  				= 	(isset($formData['order'])) ? $formData['order']   : 'DESC';
	$recordPerPage			=	(isset($formData['records_per_page']) &&  $formData['records_per_page'] !='') ? $formData['records_per_page']:Config::get("Reading.records_per_page"); 
	
			$result = $DB->where('is_active', '=', ACTIVE)
			->orderBy($sortBy, $order)
			->paginate($recordPerPage);
		
		$status = SUCCESS;

	$response['sort_by'] 			= 	$sortBy;
	$response['order'] 				= 	$order;
	$response['searchVariable'] 	= 	$searchVariable;
	$response['result'] 			= 	$result;

	$response['status'] 			= 	$status;
	
	$mobile	=	0;	
	if(isset($formData['mobil_req']) && $formData['mobil_req']){
		$mobile	=	1;
		
	}
	$res = array('data'=> $response,'mobile_req'=>$mobile);
	return $res;
}	







} // end BlogService class
