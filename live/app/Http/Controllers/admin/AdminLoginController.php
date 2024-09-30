<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseController;
use App\Modules\User\Models\User;
use App\Services\SendMailService;
use App\Modules\EmailTemplate\Models\EmailTemplate;
use App\Modules\EmailTemplate\Models\EmailAction;
use Auth, Config, Cookie, Hash, Redirect, Session, View, Validator, Request;

/**
 * AdminLogin Controller
 *
 * Add your methods in the class below
 *
 * This file will render views\admin\login
 */
class AdminLoginController extends BaseController {


	public function __construct() {
		// echo time();die;
	}


	/**
	 * Function for display admin  login page
	 *
	 * @param null
	 *
	 * @return view page.
	 */
	public function login(Request $request){
		if(Auth::check()){
			if(Auth::user()->user_role_id==SUPER_ADMIN_ID){
				return Redirect:: route('AdminDashBoard.index');
			}
		}
		if(Request::isMethod('post')){
			$userdata = array(
				'email' 			=> Request::get('email'),
				'password' 			=> Request::get('password'),
			);

			$remember 	= 	(!empty(Request::get('remember'))) ? true : false;
			if (Auth::attempt($userdata)){

               /* $subAdminRoles	=	AccessRoles::pluck('id','id')->toArray();*/
				$userRoleIds		=	array(SUPER_ADMIN_ROLE_ID,SUB_ADMIN_ROLE_ID);

				if(in_array(Auth::user()->user_role_id,$userRoleIds)){
					if(Auth::user()->active == ACTIVE){
						if($remember == true){
							$rememberData['email'] 			= $userdata['email'];
							$rememberData['password']		= bcrypt($userdata['password']);
							$rememberData['remember_me']	= $remember;
							setcookie('remember_admin',json_encode($rememberData), time() + (86400 * 30));
						}
						else {
							setcookie('remember_admin','', time() - (86400 - 30)	);
						}
						Session::flash('success',trans("messages.Login.success"));
						return Redirect:: route('AdminDashBoard.index');
					}
					else{
						Auth::logout();
						Session::flash('error',trans("messages.Login.inactive_account"));
						return Redirect::back() ->withInput();
					}
				}
				else{
					Auth::logout();
					Session::flash('error',trans("messages.Login.incorrect_credential"));
					return Redirect::back() ->withInput();
				}
			}
			else{
				Session::flash('error',trans("messages.Login.incorrect_credential"));
				return Redirect::back() ->withInput();
			}
		}
		else{
			return View::make('admin.Login.index');
		}
	}// end index()


	/**
	 * Function for logout admin users
	 *
	 * @param null
	 *
	 * @return rerirect page.
	*/
	public function logout(Request $request){
		if(Auth::check()){
			Session::flash('success',trans("messages.Login.logout"));
			if(Auth::user()->user_role_id==SUPER_ADMIN_ID){
				Auth::logout();
				return Redirect::route('AdminDashBoard.index');
			}
			else{
				Auth::logout();
				return Redirect::route('AdminDashBoard.index');
			}
		}
	}


	/**
	 * Function is used to display forget password page
	 *
	 * @param null
	 *
	 * @return view page.
	 */
	public function forgetPassword(){
		return View::make('admin.Login.forget_password');
	}// end forgetPassword()


	/**
	 * Function is used for reset password
	 *
	 * @param $validate_string as validator string
	 *
	 * @return view page.
	 */
	public function resetPassword($validate_string=null) {
        if ($validate_string != "" && $validate_string != null){
            $userDetail = User::where('active',1)->where('forgot_password_validate_string',$validate_string)->first();
            if (!empty($userDetail)) {
                return View::make('admin.Login.reset_password', compact('validate_string'));
            } 
			else {
                return Redirect::route('login')->with('error', trans('messages.Sorry, you are using wrong link.'));
            }
        }
		else {
            return Redirect::route('login')->with('error', trans('messages.Sorry, you are using wrong link.'));
        }
    }// end resetPassword()


	/**
	 * Function is used to send email for forgot password process
	 *
	 * @param null
	 *
	 * @return url.
	 */
	public function sendPassword(Request $request){
		$validator = Validator::make(
			Request::all(),array(
				'email' 			=> 'required|email',
            ),
            array(
                'email.required' => trans('messages.email.REQUIRED_ERROR'),
                'email.email' => trans('messages.email.VALID_EMAIL_ERROR'),
            )
		);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else{
			
			$email		=	Request::get('email');
			$userDetail	=	User::where('email',$email)->first();
			// pr($userDetail->toArray());die;

			if(!empty($userDetail)){
				if($userDetail->active == 1 ){
					
					if($userDetail->is_verified == 1 ){
						$forgot_password_validate_string	= 	md5($userDetail->email);
						

						User::where('email',$email)->update(array('forgot_password_validate_string'=>$forgot_password_validate_string));
						$settingsEmail = Config::get('Site.email');
                        $email = $userDetail->email;
                        $username = $userDetail->username;
                        $full_name = $userDetail->full_name;
                        $route_url = route('Admin.reset_password', $forgot_password_validate_string);
                        $varify_link = $route_url;

                        $emailActions = EmailAction::where('action', '=', 'forgot_password')->get()->toArray();
                        $emailTemplates = EmailTemplate::where('action', '=', 'forgot_password')->get(array('name', 'subject', 'action', 'body'))->toArray();
                        $cons = explode(',', $emailActions[0]['options']);
                        $constants = array();

                        foreach ($cons as $key => $val) {
                            $constants[] = '{' . $val . '}';
                        }
						
                        $subject = $emailTemplates[0]['subject'];
                        $rep_Array = array($full_name, $varify_link, $route_url);
                        $messageBody = str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

						$sendMail = new SendMailService;
						$mailSent = $sendMail->sendMail($email, $full_name, $subject, $messageBody, $settingsEmail);

						Session::flash('flash_notice', trans('messages.Login.password_send'));
                        return Redirect::route('login');
						
                    }
					else {
                        return Redirect::back()->with('error', trans('messages.Login.account_not_verify'));
                    }
                }
				else {
                    return Redirect::back()->with('error', trans('messages.Login.account_disable'));
                }
            }
			else {
                return Redirect::back()->with('error', trans('messages.Login.email'));
            }
        }
    }


	/**
	 * Function is used for save reset password
	 *
	 * @param $validate_string as validator string
	 *
	 * @return view page.
	 */
	public function resetPasswordSave(){
		$newPassword		=	Request::get('new_password');
		$validate_string	=	Request::get('validate_string');

		$messages = array(
			'new_password.required' 				=> trans('The new password field is required.'),
			'new_password_confirmation.required' 	=> trans('The confirm password field is required.'),
			'new_password.min' 						=> trans('The password must be at least 8 characters.'),
			'new_password_confirmation.min' 		=> trans('The confirm password must be at least 8 characters.'),
			'new_password.regex' 					=> trans('The new password must have be of minimum 8 characters and it should be combination of numeric, alphabet and special characters.'),
		);
		$validator = Validator::make(
			Request::all(),
			array(
				'new_password' 				=> 'required|regex:'.PASSWORD_REGX,
				'new_password_confirmation' => 'required|same:new_password',

			),$messages
		);

		if ($validator->fails()){
			return Redirect::back()->withErrors($validator)->withInput();
		}
		else{
			$userInfo = User::where('forgot_password_validate_string',$validate_string)->first();
			
			User::where('forgot_password_validate_string',$validate_string)
				->update(array(
						'password'							=>	Hash::make($newPassword),
						'forgot_password_validate_string'	=>	''
				));
				
			$settingsEmail 		= 	Config::get('Site.email');
			$action				= 	"reset_password";
			$emailActions		=	EmailAction::where('action','=','reset_password')->get()->toArray();
			$emailTemplates		=	EmailTemplate::where('action','=','reset_password')->get(array('name','subject','action','body'))->toArray();
			$cons 				= 	explode(',',$emailActions[0]['options']);
			$constants 			= 	array();
			
			foreach($cons as $key=>$val){
				$constants[] = '{'.$val.'}';
			}

			$subject 			=  $emailTemplates[0]['subject'];
			$rep_Array 			=  array($userInfo->full_name);
			$messageBody		=  str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

			$sendMail = new SendMailService;
			$mailSent = $sendMail->sendMail($userInfo->email, $userInfo->full_name, $subject, $messageBody, $settingsEmail);

			Session::flash('success', trans('messages.Login.reset_password'));
			return Redirect::route('login');
		}
	}// end resetPasswordSave()
}
