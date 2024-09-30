<?php
namespace App\Modules\News\Services;

use App\Modules\News\Models\News;

use App\Modules\User\Models\User;
use App\Services\SendMailService;
use Auth;
use Config;
use CustomHelper;
use DB;
use Request;
use ValidationHelper;
use Validator;

/**
 * Blog Service here
 *
 * Add your methods in the class below
 *
 */

class NewsService
{
    /**
     * Function for view News
     *
     * @param $formData,
     * @param @attribute
     *
     * @return redirect page.
     */
    public function list($formData = array(), $attribute = array())
    {

        $DB = News::query();
        $searchVariable = array();
        $response = [];



        if ((Request::all() || isset($formData['display'])) || isset($formData['page'])) {
            $searchData = Request::all();
            unset($searchData['display']);
            unset($searchData['_token']);

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }
            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }
            $start_date = $end_date = '';

            foreach ($searchData as $fieldName => $fieldValue) {
                $fieldValue = trim($fieldValue);
                if ($fieldValue != '') {
                    if ($fieldName == 'search') {
                        $DB->where("title", 'like', '%' . $fieldValue . '%');
                      }/*elseif ($fieldName == 'slug') {
                        $slug  =$fieldValue;
                        $DB->whereHas('categoryDetails', function($q) use ($slug){
                            $q->where('slug',$slug);
                        });
                      }*/
                     elseif ($fieldName == 'created_at') {
                        if (!empty($formData('created_at'))) {
                            $start_date = $formData('created_at');
                        }
                    } elseif ($fieldName == 'updated_at') {
                        if (!empty($formData('updated_at'))) {
                            $end_date = $formData('updated_at');
                        }
                    } else {
                        $DB->where("$fieldName", 'like', '%' . $fieldValue . '%');
                    }

                }

                $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
            }
        }


        if (isset($formData['records_per_page']) && $formData['records_per_page'] != '') {
            $searchVariable = array_merge($searchVariable, array('records_per_page' => $formData['records_per_page']));
        }

        $sortBy = (isset($formData['sortBy'])) ? $formData['sortBy'] : 'created_at';
        $order = (isset($formData['order'])) ? $formData['order'] : 'DESC';
        $recordPerPage = (isset($formData['records_per_page']) && $formData['records_per_page'] != '') ? $formData['records_per_page'] : Config::get("Reading.records_per_page");

        $slug = (isset($formData['slug'])) ? $formData['slug'] : null;
        if($slug){
            $DB->whereHas('categoryDetails', function($q) use ($slug){
                $q->where('slug',$slug);
            });
        }
        $result = $DB->where('is_active', ACTIVE)
            ->orderBy($sortBy, $order)
            ->paginate($recordPerPage);


        $status = SUCCESS;

        /*get recent news*/
        $recent_news      = News::where(['is_active' => ACTIVE])->orderby('created_at','DESC')->limit(RECENT_NEWS_LIMIT)->get();

        $response['sort_by'] = $sortBy;
        $response['order'] = $order;
        $response['searchVariable'] = $searchVariable;
        $response['result'] = $result;
        $response['recent_news'] = $recent_news;
        $response['status'] = $status;

        $res = array('data' => $response);

        return $res;
    }


    /**
     * Function for view News
     *
     * @param $formData,
     * @param @attribute
     *
     * @return redirect page.
     */
    public function viewNewsDetalis($formData = array(), $attribute = array())
    {

        $status = ERROR;
        $message = '';
        $response = array();
        $record = array();
        $recentblogs = array();
        $mobile = 0;

        if (!empty($formData['slug'])) {
            $slug = $formData['slug'];
            $recordPerPage = Config::get("Reading.records_per_page");
            $record = News::where('is_active', ACTIVE)->where('slug', $slug)->firstOrFail();

            /*get recent news*/
            $recent_news      = News::where(['is_active' => ACTIVE])->orderby('created_at','DESC')->limit(RECENT_NEWS_LIMIT)->get();
            $status = SUCCESS;
        }

        $response['status'] = $status;
        $response['record'] = $record;

        $response['recent_news'] = $recent_news;

        $res = array('data' => $response, 'mobile_req' => $mobile);

        return $res;

    } //end News()


} // end News class
