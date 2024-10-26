<?php 
namespace App\Modules\SurveQuestionAnswer\Models; 
use Eloquent;


/**
 * SurveQuestionAnswer Model
 */
 
class SurveQuestion extends Eloquent   {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
 
	protected $table = 'surve_questions';


	public function getAnswers(){
		return $this->hasMany('App\Modules\SurveQuestionAnswer\Models\SurveyAnswer','question_slug','slug');
	}


	public function getNextQuestion($degreeSelected)
    {
        return self::with('getAnswers')
            ->where('category_id', $degreeSelected)
            ->where('question_order', '>', $this->question_order)
            ->orderBy('question_order', 'asc')
            ->first();
    }

    public function getPreviousQuestion($degreeSelected)
    {
        return self::with('getAnswers')
            ->where('category_id', $degreeSelected)
            ->where('question_order', '<', $this->question_order)
            ->orderBy('question_order', 'desc')
            ->first();
    }


	// public function next(){
	// 	// get next user
	// 	return self::where('id', '>', $this->id)->orderBy('id','asc')->first();
	
	// }
	// public  function previous(){
	// 	// get previous  user
	// 	return self::where('id', '<', $this->id)->orderBy('id','desc')->first();
	
	// }
	
} // end Slider class
