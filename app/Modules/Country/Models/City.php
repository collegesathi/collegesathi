<?php
namespace App\Modules\Country\Models;

use Eloquent;

/**
 * City Model
 */
class City extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

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

    /**
     * Function for  bind State model
     *
     * @param null
     *
     * return query
     */
    public function stateName()
    {
        return $this->belongsTo('App\Modules\Country\Models\State', 'state_id')->select('id', 'state_name');
    }

} // end City class