<?php 
namespace App\Modules\SurveQuestionAnswer\Models; 
use Eloquent;


/**
 * SurveAnswer Model
 */
 
class SurveyAnswer extends Eloquent   {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'servey_answers';



	public function getQuestionDetails()
    {
        return $this->belongsTo('App\Modules\SurveQuestionAnswer\Models\SurveQuestion', 'question_id','id');
    }
	
} // end SurveAnswer class
