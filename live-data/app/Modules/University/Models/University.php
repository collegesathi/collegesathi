<?php
namespace App\Modules\University\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;


/**
 * University Model
 */

class University extends Eloquent   {

    use SoftDeletes;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */

	protected $table = 'universities';


    protected $appends = [
        'review_count',
    ];

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
     * Function for  bind faqs model
     *
     * @param null
     *
     * return query
     */
    public function faqs()
    {
        return $this->hasMany('App\Modules\Faq\Models\Faq', 'uni_id', 'id')->orderBy('faq_order', 'ASC')->where('course_id', null)->where('is_active',ACTIVE);
    } //end userLastLogin()


 /**
     * Function for  bind blogs model
     *
     * @param null
     *
     * return query
     */
    public function blogs()
    {
        return $this->hasMany('App\Modules\Blog\Models\Blog', 'university_id', 'id')->orderBy('created_at', 'DESC')->where('is_active',ACTIVE);
    } //end userLastLogin()
    public function UniversityApplications(){
        return $this->hasMany('App\Modules\University\Models\UniversityApplication', 'uni_id', 'id');
    }


    public function universityPlacementPartners()
    {
        return $this->hasOne('App\Modules\University\Models\UniversityPlacementPartner', 'university_id', 'id');
    }


    public function universityBadges()
    {
        return $this->hasOne('App\Modules\University\Models\UniversityBadge', 'university_id', 'id');
    }


    public function universityCourses() 
    {
        return $this->hasMany('App\Modules\University\Models\Course', 'univercity_id', 'id')->where('active',ACTIVE)->orderByRaw('CASE WHEN display_order IS NULL THEN 1 ELSE 0 END, display_order ASC');
    }

    public function getSliders() 
    {
        return $this->hasMany('App\Modules\Slider\Models\Slider', 'uni_id', 'id')->where('is_active',ACTIVE);
    }



    public function getUniversityPlacementPartners()
    {
        return $this->hasOne('App\Modules\University\Models\UniversityPlacementPartner', 'university_id', 'id');
    }


    public function getReviewRatingUniversities(){
        return $this->hasMany('App\Modules\ReviewRating\Models\ReviewRating','university_id')->with('getUserDetails');
    }

    public function getReviewRatingUniversitiesPage(){
        return $this->hasMany('App\Modules\ReviewRating\Models\ReviewRating','university_id')->with('getUserDetails')->where('is_approved', ACTIVE)->limit(2)->orderBy('created_at', 'DESC');
    }

    public function getReviewCountAttribute()
    {
        return $this->getReviewRatingUniversities()->where('is_approved', ACTIVE)->count();
    }


    public function universityCourseEmiDetail() 
    {
        return $this->hasMany('App\Modules\University\Models\Course', 'univercity_id', 'id')->where('active',ACTIVE)->where('show_on_front',ACTIVE);
    }


    public function universityLoanPartners() 
    {
        return $this->hasMany('App\Modules\University\Models\UniversityLoanPartner', 'university_id', 'id')->where('status',ACTIVE)->orderBy('created_at','DESC');
    }
	
} // end University class
