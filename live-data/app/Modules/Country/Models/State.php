<?php
namespace App\Modules\Country\Models;

use Eloquent;

/**
 * State Model
 */
class State extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * Function for  bind Country model
     *
     * @param null
     *
     * return query
     */
    public function countryName()
    {
        return $this->belongsTo('App\Modules\Country\Models\Country', 'country_id')->select(['id', 'country_name']);
    }

} // end State class