<?php
namespace App\Modules\University\Models;
use Eloquent;


/**
 * University Model
 */

class Course extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'university_courses';



	public function courseSemesters()
    {
        return $this->hasMany('App\Modules\University\Models\Semester', 'course_id', 'id')->where('is_active',ACTIVE)->where('specification_id',NULL)->orderBy('semester', 'ASC');
    }


	public function courseFaqs()
    {
        return $this->hasMany('App\Modules\Faq\Models\Faq', 'course_id', 'id')->orderBy('faq_order', 'ASC')->where('is_active',ACTIVE);
    }


	public function getUniversityDetails()
    {
        return $this->belongsTo('App\Modules\University\Models\University', 'univercity_id','id')->where('is_active', ACTIVE)->select('title','image','id','slug');
    }

    public function getCourseDropDownDetails()
    {
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown', 'course_id','id');
    }



    public function getAllUniversityDetails()
    {
        return $this->belongsTo('App\Modules\University\Models\University', 'univercity_id','id')->with('universityBadges','getUniversityPlacementPartners','getReviewRatingUniversities');
    }


    public function getCourseSpecificationDetails()
    {
        return $this->hasMany('App\Modules\DropDown\Models\DropDown', 'dropdown_id','course_id')->where('status',ACTIVE);
    }

    public function getCourseSpecifications()
    {
        return $this->hasMany('App\Modules\University\Models\CourseSpecification', 'university_course_id')->where('active',ACTIVE)->with('getCourseSpecificationDropdownDetails');
    }
	
	
	
	
	
	
	public function university(){
        return $this->belongsTo('App\Modules\University\Models\University', 'univercity_id','id')->where('is_active', ACTIVE)->select('title','image','id','slug');
    }
	
	
	
	

} // end University class
