<?php
namespace App\Modules\User\Controllers\Front;
use Auth,Blade,Config,Cache,Cookie,DB,File,Hash,Mail,mongoDate,Redirect,Request,Response,Session,URL,View,Validator;
use App\Http\Controllers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite,Route;
use App\Modules\User\Models\User;
use Illuminate\Routing\Controller;
use CustomHelper;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /*use AuthenticatesAndRegistersUsers, ThrottlesLogins;*/

    /**
    * Create a new authentication controller instance.
    *
    * @return void
    */
    public function __construct(){
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    
    
    public function getSlug($title, $modelName,$limit = 30){
        $slug       =    substr(\Str::slug($title),0 ,$limit);
        $Model      =   "\App\Model\\$modelName";
        $slugCount  =  count($Model::where('slug', 'regexp', "/^{$slug}(-[0-9]*)?$/i")->get());
        return ($slugCount > 0) ? $slug."-".$slugCount : $slug;
    }//end getSlug()

    
    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return User
    */
    protected function create(array $data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    
    /**
    * Redirect the user to the facebook authentication page.
    *
    * @return Response
    */
    public function redirectToProvider($provider){
        
        switch ($provider) {
            case 'facebook':
                return Socialite::driver($provider)->fields(['first_name', 'last_name', 'email', 'gender', 'verified','birthday','address'])->redirect();
                break;
            case 'twitter':
                return Socialite::driver($provider)->redirect();
                break;
            case 'google':
                return Socialite::driver($provider)->redirect();
                break;
        }
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
		
		$errorFacebook	=	Request::get('error');
		$errorTwitter	=	Request::get('denied');
		if($errorFacebook!='' || $errorTwitter!=''){
			return Redirect::to('/');
		}
		
		$SocialUserRole	=	Session::get('SocialUserRole');	
        $user 			=	Socialite::driver($provider)->user();
		$socialField	=	''; 
		$first_name 	= 	'';
		$last_name 		= 	'';
		$email 			= 	'';
		switch ($provider) {
			case 'facebook':
				$name 			= explode(" ",$user->name,2);
				$first_name	    = isset($name[0]) ? $name[0] :'';
				$last_name		= isset($name[1]) ? $name[1] :'';
				$email 			= $user->email;
				$socialId 		= $user->id; 
				$profilePic		= $user->avatar; 
				$socialField	= 'fb_id'; 
			break;
			case 'google':
				$name 			= 	explode(" ",$user->name,2);
				$first_name		=	isset($name[0]) ? $name[0] :'';
				$last_name		=	isset($name[1]) ? $name[1] :'';
				$email 			= 	$user->email;
				$socialId 		= 	$user->id; 
				$profilePic 	= 	$user->avatar; 
				$socialField	=	'google_id'; 
			break;
		}
		if($email!=''){
			$userData	=	array();
			if($provider	==	'facebook'){
				$userData	=	User::where('email',$email)->orWhere('fb_id',$socialId)->first();
				
			}else if($provider == 'google'){
				$userData	=	User::where('email',$email)->orWhere('google_id',$socialId)->first();
			}
			if(!empty($userData)){
				$userExist	=	ACTIVE;
				if($userData->user_role_id == CUSTOMER_ROLE_ID){
					if($userData->block != BLOCK){
						if($userData->active == ACTIVE){
							if($userData->is_deleted != IS_DELETE){
									/*update social app_id*/
									if($provider == 'facebook'){
										$userData->fb_id =	$socialId;
									}else if($provider == 'google'){
										$userData->google_id =	$socialId;
									}
									$userData->save();
									/*update social app_id*/
									Auth::loginUsingId($userData->id);
									$message = trans("front_messages.Login.user_success",['user_name'=>ucfirst($userData['full_name'])]);
									Session::flash('flash_notice',$message);
									return Redirect:: route('User.Dashboard');
							}else{
								$message	=	trans("front_messages.login.account_deleted");
								return Redirect:: route('home.index')->with('error',$message);
							}
						}else{
							$message	=	trans("front_messages.login.account_deactive");
							return Redirect:: route('home.indexe')->with('error',$message);
						}
					}else{
						$message	=	trans("front_messages.login.account_blocked");
						return Redirect:: route('home.index')->with('error',$message);
					}
				}else{
					$message	=	trans("front_messages.social_login_not_allowed_to_non_customer_user");
					return Redirect:: route('home.index')->with('error',$message);
				}
			}else{

				
				$password              = CustomHelper::randomPassword(8);
				$fullName              = CustomHelper::getFullName($first_name, $last_name);
				$obj                   = new User ;
				if($provider == 'facebook'){
					$obj->fb_id =	$socialId;
				}else if($provider == 'google'){
					$obj->google_id =	$socialId;
				}
				$obj->user_role_id                  = CUSTOMER_ROLE_ID;
                $obj->user_role_slug                = CUSTOMER_ROLE_SLUG;
                $obj->password                      = Hash::make($password);
				$obj->full_name                     = $fullName;
                $obj->first_name                    = isset($first_name) ? $first_name : null;
                $obj->last_name                     = isset($last_name) ? $last_name : null;
				$obj->email                         = !empty($email) ? $email : '';
				$obj->image                         = !empty($profilePic) ? $profilePic : '';
				$obj->slug                          = CustomHelper::getSlug($fullName, 'slug', 'User');
				$obj->is_deleted                    = INACTIVE;
                $obj->block                         = UNBLOCK;
                $obj->active                        = ACTIVE;
                $validateString                     = isset($email) && !empty($email) ? CustomHelper::getValidateString($email) : "";
                $obj->validate_string               = $validateString;
				$obj->is_verified                   = ACTIVE;
                $obj->is_mobile_verified            = ACTIVE;
                $obj->mobile_verification_code_time = INACTIVE;
                $obj->resend_otp_time               = INACTIVE;
                $obj->mobile_verification_code      = '';
                $obj->is_approved                   = ACTIVE;
				$obj->save();
				Auth::loginUsingId($obj->id);
									
				$message = trans("front_messages.Login.user_success",['user_name'=>ucfirst($obj['full_name'])]);
				Session::flash('flash_notice',$message);
				return Redirect:: route('User.Dashboard');

			}
			
		}
	}//end handleProviderCallback()
    
}
