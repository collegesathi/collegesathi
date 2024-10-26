<?php
namespace App\Modules\Survey\Models;
use Eloquent;

/**
 * Survey Model
*/
class Survey extends Eloquent   {

	/**
	* The database table used by the model.
	*
	* @var string
	*/

	protected $table = 'survey_form';

/**
     * this function is used to get stateDetails
     *
     * @param null
     */
	public function stateDetails(){
        return $this->belongsTo('App\Modules\Country\Models\State','state','id')->select(['id','state_name']);
    }//end

	public function cityDetails(){
        return $this->belongsTo('App\Modules\Country\Models\City','city','id')->select(['id','city_name']);
    }//end



    public function getAllSurveyQuestionAnswer(){
        return $this->hasMany('App\Modules\Survey\Models\SurveyQuestionAnswer','survey_id','id');
    }

    public function getExpertName(){
        return $this->hasOne('App\Modules\Expert\Models\Expert','id','expert_id')->select(['id','name']);
    }//end
} // end Expert class
