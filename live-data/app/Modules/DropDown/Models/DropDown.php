<?php
namespace App\Modules\DropDown\Models;
use Eloquent,Session;

/**
 * DropDown Model
*/

class DropDown extends Eloquent  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	*/

	protected $table = 'dropdown_managers';

	/**
	 * Function to get all faq that are belongs to faq category()
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function faq(){
        return $this->hasMany('App\Modules\Faq\Models\Faq','category_id')
			->select('id','category_id','is_active')
			->where('is_active',1)
			->with('description');
    } //end faq()



	/* Function to get all blogs that are belong to blog category
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function blogs(){
        return $this->hasMany('App\Modules\Blog\Models\Blog','category_id')
			->with('blogComments','user')->withCount(['blogComments as total_comments'=> function ($query) {}]);
    } //end blogs()



	/* Function to get all blogs that are belong to blog category
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function blogsWithoutUsersAndComments(){
        return $this->hasMany('App\Modules\Blog\Models\Blog','category_id')
				->withCount(['blogComments as total_comments'=> function ($query) {}]);
    } //end blogs()



    /* Function to get all forums that are belong to forum category
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function forums()
    {
        return $this->hasMany('App\Modules\Forum\Models\Forum','category_id')
			->with('forumComment','user')->withCount(['forumComment as total_comments'=> function ($query) {}]);
    } //end forums()



	/* Function to get all forums that are belong to forum category
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function forumsWithUser()
    {
        return $this->hasMany('App\Modules\Forum\Models\Forum','category_id')
				->with(['user'=>function($query){
						$query->select('id','full_name', 'image');
				}])
				->withCount(['forumComment as total_comments'=> function ($query) {}]);
    } //end forums()




	/**
     * Set the is_active attribute
     *
     * @param  string  $value
     * @return void
     */
	public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = (int)$value;
    }




    /* Function to get all blogs that are belong to blog category
	 *
	 * @param null
	 *
	 * @return query
	*/
 	public  function productService(){
        return $this->hasMany('App\Modules\ProductService\Models\ProductService','product_type')->where('is_active',(int)ACTIVE);
    } //end blogs()



	public  function getCoursesDetails(){
        return $this->hasMany('App\Modules\University\Models\Course','course_id')->where('active',ACTIVE)->with('getUniversityDetails');
    }



	public  function getCourseSpecificationDetails(){
        return $this->hasOne('App\Modules\University\Models\CourseSpecification','specification_id')->where('active',ACTIVE)->with('getUniversityDetails');
    }

	


	public  function getCoursesSpecificationsDropdown(){
        return $this->hasMany('App\Modules\DropDown\Models\DropDown','dropdown_id')->where('status',ACTIVE)->with('getCourseSpecificationDetails');
    }
	
	
	
	
	/*
		get specification masters by courseId
	*/
	public  function coursesSpecifications(){
        return $this->hasMany('App\Modules\DropDown\Models\DropDown','dropdown_id')->where('status',ACTIVE)->with('specificCourse');
    }
	
	
	/*
		get university-Courses by courseid with university details
	*/
	public  function universityCourses(){
        return $this->hasMany('App\Modules\University\Models\Course','course_id')->where('active',ACTIVE)->with('university');
    }
	
	
	/*
		get university course specifications
	*/
	public  function specificCourse(){
        return $this->hasMany('App\Modules\University\Models\CourseSpecification','specification_id')->where('active',ACTIVE)->with('university');
    }
	
	
	

}// end DropDown class
