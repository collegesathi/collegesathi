<?php
namespace App\Modules\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Eloquent;

/**
 * User Model
 */

class User extends Authenticatable
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    // protected $dates = ['deleted_at'];


	/**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


	/**
     * Set the is_active attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = (int) $value;
    }


    /**
     * Set the is_mobile_verified attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setIsMobileVerifiedAttribute($value)
    {
        $this->attributes['is_mobile_verified'] = (int) $value;
    }


    /**
     * Set the is_active attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setIsDeletedAttribute($value)
    {
        $this->attributes['is_deleted'] = (int) $value;
    }


    /**
     * Set the load_rate_card attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setIsVerifiedAttribute($value)
    {
        $this->attributes['is_verified'] = (int) $value;
    }
	

    /**
     * Set the block attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setBlockAttribute($value)
    {
        $this->attributes['block'] = (int) $value;
    }
	

    /**
     * Set the is_aproved attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setIsApprovedAttribute($value)
    {
        $this->attributes['is_approved'] = (int) $value;
    }
	

    /**
     * Set the full_name attribute
     *
     * @param  string  $value
     * @return void
     */
    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucwords($value);
    }


    /**
     * Function for  bind Userlogin model
     *
     * @param null
     *
     * return query
     */
    public function userLastLogin()
    {
        return $this->hasOne('App\Models\Userlogin', 'user_id', 'id')->orderBy('created_at', 'desc')->limit(1);
    } //end userLastLogin()


    /**
     * Function for  bind Country model
     *
     * @param null
     *
     * return query
     */
    public function countryName()
    {
        return $this->belongsTo('App\Modules\Country\Models\Country', 'country');
    }


    /**
     * Function for  bind state model
     *
     * @param null
     *
     * return query
     */
    public function stateName()
    {
        return $this->belongsTo('App\Modules\Country\Models\State', 'state');
    }
	

    /**
     * Function for  bind City model
     *
     * @param null
     *
     * return query
     */
    public function cityName()
    {
        return $this->belongsTo('App\Modules\Country\Models\City', 'city');
    }


    /**
     * Function for  bind Permission model
     *
     * @param null
     *
     * return query
     */
    public function permission()
    {
        return $this->hasOne('App\Modules\Permission\Models\Permission', 'user_id', 'id');
    } //end permission()


} // end User class
