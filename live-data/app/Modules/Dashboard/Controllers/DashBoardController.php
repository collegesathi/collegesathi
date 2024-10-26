<?php
namespace App\Modules\Dashboard\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\User\Models\User;
use App\Modules\Career\Models\ApplyJob;
use App\Modules\Scholarship\Models\ScholarshipRequest;
use App\Modules\Referral\Models\Referral;
use Illuminate\Support\Facades\Route;
use CustomHelper;
use Auth, Hash, Input, Redirect, Request, Session, View, Validator;

/**
 * AdminDashBoard Controller
 *
 * Add your methods in the class below
 *
 * This file will render views\admin\dashboard
 **/
class DashBoardController extends BaseController {


	/**
	 * Function for display admin dashboard
	 *
	 * @param null
	 *
	 * @return view page.
	 **/
	public function showdashboard(){ 
		$userRoleId		=	Auth::user()->user_role_id;
		$login_user_id	=	Auth::user()->id;
 
        $totalActiveCustomers 	= INACTIVE;   
        $totalActiveCustomers	= User::where('user_role_id', CUSTOMER_ROLE_ID)->where('is_deleted', NOT_DELETED)->where('active', ACTIVE)->count();

        $totalJobApplies 	= INACTIVE;   
		$totalJobApplies = ApplyJob::get()->count();

		$totalScholarshipRequests 	= INACTIVE;   
		$totalScholarshipRequests = ScholarshipRequest::get()->count();

		$totalReferrals 	= INACTIVE;   
		$totalReferrals = Referral::get()->count();

        return  View::make('Dashboard::dashboard',compact('userRoleId','totalActiveCustomers','totalJobApplies','totalScholarshipRequests','totalReferrals'));

	}// end showdashboard()



	 

	/**
		* Function for display admin account detail
		*
		* @param null
		*
		* @return view page.
	**/
	public function myaccount(){
		if(Auth::user()->user_role_id != SUB_ADMIN_ROLE_ID && Auth::user()->user_role_id != SUPER_ADMIN_ROLE_ID){
			Session::flash(ERROR, trans("messages.dispute_mgt.something_went_wrong_msg"));
			return  Redirect::route('AdminDashBoard.index');
		}

		$data = array();
		
		return  View::make('Dashboard::myaccount' , $data);


	}// end myaccount()


	/**
	 * Function for update admin account update
	 *
	 * @param null
	 *
	 * @return redirect page.
	 **/
	public function myaccountUpdate() {
		if(Auth::user()->user_role_id == SUB_ADMIN_ROLE_ID || Auth::user()->user_role_id == SUPER_ADMIN_ROLE_ID){

			$old_password		= Request::get('old_password');
			$password 			= Request::get('new_password');
			$confirm_password 	= Request::get('confirm_password');

			$message = array(
				'full_name.required' => trans('messages.full_name.REQUIRED_ERROR'),
				'new_password.min' => trans('The new password must be at least 8 characters'),
				'old_password.min' => trans('The old password must be at least 8 characters'),
				'new_password.required' => trans('messages.new_password.REQUIRED_ERROR'),
				'new_password.regex' => trans('messages.global.password_help_message'),
				'confirm_password.required' => trans('messages.confirm_password.REQUIRED_ERROR'),
				'confirm_password.min' => trans('The confirm password must be at least 8 characters.'),
				'confirm_password.same' => trans('messages.confirm_password.MATCH_ERROR'),
                'old_password.required' => trans('messages.old_password.REQUIRED_ERROR'),
                'old_password.regex' => trans('messages.global.password_help_message'),

			);

			$ValidationRule = array(
				'full_name' 	=> 'required',
				'email'		=> 'required',
				'image' 	=> 'mimes:' . IMAGE_EXTENSION
			);

			if ($old_password != '' || $password != '' || $confirm_password != '') {
				$rules = array(
					'old_password' 		=> 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
					'new_password' 		=> 'required|regex:'.PASSWORD_REGX,
					'confirm_password' 	=> 'required|same:new_password'
				);
				$ValidationRule = array_merge($ValidationRule, $rules);
			}

			$validator = Validator::make(Request::all(), $ValidationRule, $message);
			if (!empty($password)) {
				$password = Hash::make($password);
			}

			if ($validator->fails()) {
				return Redirect::route('Admin.account')
						->withErrors($validator)->withInput();
			}
			else {
				$user = User::find(Auth::user()->id);
				$old_password = strip_tags(Request::get('old_password'));
				$password = strip_tags(Request::get('new_password'));
				$confirm_password = strip_tags(Request::get('confirm_password'));
				$full_name = strip_tags(Request::get('full_name'));

				if (Request::hasFile('image')) {
					$extension = Input::file('image')->getClientOriginalExtension();
					$fileName  = time() . '-user-image.' . $extension;

					if (Input::file('image')->move(USER_PROFILE_IMAGE_ROOT_PATH, $fileName)) {
						$user->image = $fileName;
					}
					$image = User::where('id', Auth::user()->id)->pluck('image');
					@unlink(USER_PROFILE_IMAGE_ROOT_PATH . $image);
				}
				if ($old_password != '') {
					if (!Hash::check($old_password, $user->password)) {
						return Redirect::route('Admin.account')
								->with('error', trans("messages.Account.password_incorrect"));
					}
				}
				if (!empty($old_password) && !empty($password) && !empty($confirm_password)) {
					if (Hash::check($old_password, $user->password)) {
						$user->password = Hash::make($password);
						$user->full_name = $full_name;
						// save the new password
						if ($user->save()) {
							return Redirect::route('AdminDashBoard.index')
									->with('success', trans("messages.Account.update_profile"));
						}
					} else {
						return Redirect::route('AdminDashBoard.index')
								->with('error', trans("messages.Account.password_incorrect"));
					}
				} else {
					$user->full_name = $full_name;
					if ($user->save()) {
						return Redirect::route('AdminDashBoard.index')
								->with('success', trans("messages.Account.update_profile"));
					}
				}
			}
    	}
    	else{
    		Session::flash(ERROR, trans("messages.dispute_mgt.something_went_wrong_msg"));
			return  Redirect::route('AdminDashBoard.index');
    	}
    }


}
