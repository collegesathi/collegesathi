<?php
namespace App\Modules\Home\Controllers\Front;

use App\Http\Controllers\BaseController;
use App\Modules\Country\Models\Country;
use  Auth, CustomHelper, View, Config, Session, Request,CURLFILE;
use App\Modules\Transactions\Models\Transaction;
use App\Modules\User\Services\UserService;
use App\Modules\User\Models\User;
use App\Modules\University\Models\Course;
use App\Modules\University\Models\University;
use Spatie\Sitemap\SitemapGenerator;

/**
 * HomeController class
 */
class HomeController extends BaseController
{

    public $model = 'Home';

    public function __construct(){
        View::share('modelName', $this->model);
    }


    /**
     * Function to display website home page
     *
     * @param null
     *
     * @return view page
     */
    public function index(){

        

		$metaTitle 				    = 	Config::get('Site.meta_title');
        $meta_description 		    = 	Config::get('Site.meta_description');
        $meta_keywords 			    = 	Config::get('Site.meta_keywords');
        $pageTitle 				    = 	Config::get('Site.title');


        $stateList 		= 	[];
        $cityList 		= 	[];

        $old_country 	= 	Request::old('country');
        $old_state 		=	Request::old('state');


        $universities = CustomHelper::getUniversities();

		if (!empty($old_country) && !empty($old_state)) {
            $countryId = Request::old('country');
            $stateId   = Request::old('state');
            list($stateList, $cityList) = CustomHelper::getStateCityList($countryId, $stateId);
        }

        $topPrograms = University::with('getSliders')->where('program', ACTIVE)->where('is_active',ACTIVE)->get();
        // pr($topPrograms->toArray());die;
        $specializationCourses = Course::with('getUniversityDetails')->where('specialization', ACTIVE)->where('active',ACTIVE)->get();

        return View::make('Home::front.index', compact('pageTitle', 'metaTitle', 'meta_description', 'meta_keywords','stateList','cityList','old_state','universities','topPrograms','specializationCourses'));
    } //end index()



    function generateSitemap(){
        SitemapGenerator::create(WEBSITE_URL)->writeToFile(base_path('sitemap.xml'));
    }


} // end HomeController class