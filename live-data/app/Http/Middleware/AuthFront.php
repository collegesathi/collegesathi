<?php

namespace App\Http\Middleware;

use App\Modules\User\Models\User;
use Auth;
use Closure;
use Redirect;
use Route;

class AuthFront
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return Redirect::to('/');
        } 
		else {
            $allowUsersRoleIds = array(CUSTOMER_ROLE_SLUG);

            $currentRoute = Route::currentRouteName();

            $allow_urls = ['user.logout'];

            if (Auth::check() && (in_array(Auth::user()->user_role_slug, $allowUsersRoleIds))) {

                $user_id = Auth::user()->id;

                $userData = User::find($user_id);

                if (empty($userData)) {
                    Auth::logout();
                    return Redirect::route('home.index');
                }

                /**Check user is blocked */
                if (Auth::check() && $userData->block == BLOCK) {
                    Auth::logout();
                    return Redirect::route('home.index')->with('error', trans('messages.login.account_blocked'));
                }

                /**Check user is inactive */
                if (Auth::check() && $userData->active == INACTIVE) {
                    Auth::logout();
                    return Redirect::route('home.index')->with('error', trans('messages.login.account_deactive'));

                }
                /**Check user is delete */
                if (Auth::check() && $userData->is_deleted == IS_DELETE) {
                    Auth::logout();
                    return Redirect::route('home.index')->with('error', trans('messages.login.account_deleted'));

                }

                return $next($request);
            } 
			else {
                $allowUsersRoleIds = array(ADMIN_ROLE_SLUG);
                return Redirect::to('/' . ADMIN_ROUTE_PREFIX);
            }
        }
    }
}
