<?php
namespace App\Modules\University\Models;
use Eloquent;


/**
 * University Model
 */

class CourseSpecification extends Eloquent   {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'university_course_specifications';



	public function courseSemesters()
    {
        return $this->hasMany('App\Modules\University\Models\Semester', 'specification_id', 'specification_id')->where('is_active',ACTIVE)->orderBy('semester', 'ASC');
    }


	public function courseFaqs()
    {
        return $this->hasMany('App\Modules\Faq\Models\Faq', 'course_id', 'id')->orderBy('faq_order', 'ASC')->where('is_active',ACTIVE);
    }


	public function getUniversityDetails()
    {
        return $this->belongsTo('App\Modules\University\Models\University', 'univercity_id','id')->where('is_active', ACTIVE)->select('title','image','id','slug');
    }
	
	public function university(){
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


    public function getCourseSpecificationDropdownDetails()
    {
        return $this->belongsTo('App\Modules\DropDown\Models\DropDown', 'specification_id')->where('status',ACTIVE);
    }

} // end University class
