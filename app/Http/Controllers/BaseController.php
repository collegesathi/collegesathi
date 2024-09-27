<?php
namespace App\Http\Controllers;
use Config, DB, Request, Session, View, App;
use App\Model\PushLog;
use Exception;

/**
 * Base Controller
 *
 * Add your methods in the class below
 *
 * This is the base controller called everytime on every request
 */
 
class BaseController extends Controller {
	
	public function __construct() {

		if(Request::segment(1) == 'admin'){
			App::setLocale('en');
		}
		
		/* For set meta data */
		if(Request::segment(1) != 'admin'){
			$seo_page_file_path = Request::segment(1);
			if($seo_page_file_path == 'pages'){
				$pagePath				= 	Request::segment(2);
				$seoData				=	DB::table('cms_pages')->select('meta_title','meta_description','meta_keywords')->where('slug',$pagePath)->first();
				
				if(!empty($seoData)){
					$title				=	$seoData->meta_title;
					$metaKeywords		=	$seoData->meta_keywords;
					$metaDescription	=	$seoData->meta_description;
				}else{
					$title				=	Config::get("Site.title");
					$metaKeywords		=	Config::get("Site.meta_keywords");
					$metaDescription	=	Config::get("Site.meta_description");
				}
			}
			else{
				$title				=	Config::get("Site.title");
				$metaKeywords		=	Config::get("Site.meta_keywords");
				$metaDescription	=	Config::get("Site.meta_description");				
			}
			
			View::share('pageTitle', $title);
			View::share('metaKeywords', $metaKeywords);
			View::share('metaDescription', $metaDescription);
			/* For set meta data */

			
		}
	}// end function __construct()
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return layout
	 */
	protected function setupLayout(){
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}//end setupLayout()
	
	 
	/** 
	 * Function to search result in database
	 *
	 * @param data  as form data array
	 *
	 * @return query string
	 */		
	public function search($data){
		unset($data['display']);
		unset($data['_token']);
		$ret	=	'';
		if(!empty($data )){
			foreach($data as $fieldName => $fieldValue){
				$ret	.=	"where('$fieldName', 'LIKE',  '%' . $fieldValue . '%')";
			}
			return $ret;
		}
	}//end search()
	  
	/**
     * Function to send push notification form website
     *
     * @param string $message           as message
     * @param string $device_id         as device_id
     * @param string $device_token      as device_token
     * @param string $device_type       as device_type
     * @param string $additional_data   as additional_data
     *
     * @return void
     */
    public function pushNotification($title='',$message='',$user_id=0,$device_id='',$device_token='',$device_type='',$additional_data = [],$badge = '') {		 
        $title   = htmlspecialchars_decode($title);
        $message = htmlspecialchars_decode($message);
        if(/*strtolower($device_type) == 'android' && */$device_token){ 
            if(Config::get('Push.fcm_key') == ''){
                Session::flash('flash_notice', 'Unable to Find Configuration Push.fcm_key for sending Message ('.$message.') to Device :: '.$device_token."    FILE ".__FILE__ . ' :: LINE #'. __LINE__ );
                return false;
            }
            try{ 
                $title   = (string) html_entity_decode($title);
                $message = (string) html_entity_decode($message);
                /* use FCM as Push Service provider
                 * Android app
                 * */

                 $payLoad = ['notification' => [
                                 'title'=>$title,
                                 'body'=>$message,
                                 'sound' => 'default'
                            ],
                            'data' => []
                            ];

                if($additional_data){
                    $payLoad['data'] = $additional_data;
                }
                $payLoad['data']['title'] = $title;
                $payLoad['data']['message'] = $message;

                if(!isset($payLoad['data']['type'])){
                    $payLoad['data']['type']    =   "booking";
                }
                // Sending Push Log
                $response = PushNotification::setService('fcm')
                            ->setMessage($payLoad)
                            ->setApiKey(Config::get('Push.fcm_key'))
                            ->setDevicesToken(is_array($device_token)?$device_token:[$device_token])
                            ->send()
                            ->getFeedback();

                if(is_array($device_token)){
                    foreach($user_id as $key => $uid){
                        // Adding Push Log
                        $pushLogModel = new PushLog;
                        $pushLogModel->user_id          = $uid;
                        $pushLogModel->title            = $title;
                        $pushLogModel->message          = $message;
                        $pushLogModel->device_id        = $device_id[$key];
                        $pushLogModel->device_token     = $device_token[$key];
                        $pushLogModel->device_type      = $device_type;
                        $pushLogModel->status           = $response->success;
                        $pushLogModel->additional_data  = json_encode($additional_data);
                        $pushLogModel->server_response  = json_encode($response);
                        $pushLogModel->save();
                    }
                }else{
                    // Adding Push Log
                    $pushLogModel = new PushLog;
                    $pushLogModel->user_id          = $user_id;
                    $pushLogModel->title            = $title;
                    $pushLogModel->message          = $message;
                    $pushLogModel->device_id        = $device_id;
                    $pushLogModel->device_token     = $device_token;
                    $pushLogModel->device_type      = $device_type;
                    $pushLogModel->status           = $response->success;
                    $pushLogModel->additional_data  = json_encode($additional_data);
                    $pushLogModel->server_response  = json_encode($response);
                    $pushLogModel->save();
                }
            }
            catch(PushException $e){ 
                Session::flash('flash_notice', "UNABLE TO SEND PUSH :: {$e->getMessage()} ".__FILE__ . ":: ".__LINE__);
            }
        }
    } //end pushNotification()
   

}
// end BaseController class
