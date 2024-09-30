<?php
namespace App\Modules\NewsletterSubscriber\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\NewsletterSubscriber\Models\NewsletterSubscriber;
use Config;
use CustomHelper;
use File;
use Redirect;
use Request;
use Response;
use Session;
use View;

/**
 * NewsletterSubscriber Controller
 *
 * Add your methods in the class below
 *
 * This file will render views from views/admin/usermgmt
 **/
class NewsletterSubscriberController extends BaseController
{

    public $model = 'NewsletterSubscriber';

    public function __construct()
    {
        View::share('modelName', $this->model);

    }

    /**
     * Function for display list of all blogs
     *
     * @param null
     *
     * @return view page.
     **/
    public function newsletterSubscriberlist()
    {

        $DB = NewsletterSubscriber::query();

        $searchVariable = array();
        $inputGet = Request::all();

        $date_range_picker = isset($inputGet['date_range_picker']) ? $inputGet['date_range_picker'] : '';

        if (Request::Input()) {
            $searchData = Request::Input();
            $searchVariable = Request::Input();

            if (isset($searchData['display'])) {
                unset($searchData['display']);
            }

            if (isset($searchData['_token'])) {
                unset($searchData['_token']);
            }

            if (isset($searchData['sortBy'])) {
                unset($searchData['sortBy']);
            }

            if (isset($searchData['order'])) {
                unset($searchData['order']);
            }

            if (isset($searchData['page'])) {
                unset($searchData['page']);
            }

            if (isset($searchData['download_csv'])) {
                unset($searchData['download_csv']);
            }

            if (isset($searchData['records_per_page'])) {
                unset($searchData['records_per_page']);
            }

            if (isset($searchData['date_range_picker'])) {
                unset($searchData['date_range_picker']);
            }


            if (isset($searchData['records_per_page'])) {
                $searchVariable = array_merge($searchVariable, array('records_per_page' => $searchData['records_per_page']));
                unset($searchData['records_per_page']);
            }



            $start_date = $end_date = '';
            foreach ($searchData as $fieldName => $fieldValue) {

                if (!empty(Request::get('start_date'))) {
                    $start_date = Request::get('start_date');
                }

                if (!empty(Request::get('end_date'))) {
                    $end_date = Request::get('end_date');
                }

                if (!empty($fieldValue)) {

                    if ($fieldName == 'user_start_date') {
                        if (!empty(Request::get('user_start_date'))) {
                            $start_date = Request::get('user_start_date');
                        }
                    } elseif ($fieldName == 'user_end_date') {
                        if (!empty(Request::get('user_end_date'))) {
                            $end_date = Request::get('user_end_date');
                        }
                    } elseif (isset($start_date) && !empty($start_date)) {
                        $monthStartDate = date("Y-m-d 00:00:00", strtotime($start_date));
                        $DB->where('created_at', '>=', $monthStartDate);
                    } elseif (isset($end_date) && !empty($end_date)) {
                        $monthEndDate = date("Y-m-d 23:59:59", strtotime($end_date));
                        $DB->where('created_at', '<=', $monthEndDate);
                    } elseif ($fieldName == 'email') {
                        if (!empty($fieldValue)) {
                            $DB->where('email','like', '%' . $fieldValue . '%' );
                        }
                    }

                    $searchVariable = array_merge($searchVariable, array($fieldName => $fieldValue));
                }

                if (!empty($start_date)) {
                    $DB->whereDate('created_at', '>=', $start_date);
                }

                if (!empty($end_date)) {
                    $DB->whereDate('created_at', '<=', $end_date);
                }
            }
        }

        if (Request::get('recordPerPage') != '') {
            $searchVariable = array_merge($searchVariable, array('recordPerPage' => Request::get('recordPerPage')));
        }

        $recordPerPage = (Request::get('recordPerPage') != '') ? Request::get('recordPerPage') : Config::get("Reading.recordPerPage");
        $sortBy = (Request::get('sortBy')) ? Request::get('sortBy') : 'created_at';
        $order = (Request::get('order')) ? Request::get('order') : 'DESC';

        $DB->orderBy($sortBy, $order);

        if (Request::get('download_csv') != '') {
            $model = $DB->get();
            $responseData = $this->downloadCSV($model);
            return Response::download($responseData['fileName'], $responseData['fileSuffix'], $responseData['headers']);

        } else {
            $model = $DB->paginate((int) $recordPerPage);

            return View::make("NewsletterSubscriber::index", compact('model', 'searchVariable',  'sortBy', 'order', 'recordPerPage', 'date_range_picker'));
        }

    } // end NewsletterSubscriberlist()

/**
 * Function for mark a NewsletterSubscriber as deleted
 * @param $userId as id of NewsletterSubscriber
 * @return redirect page.
 **/
    public function delete($userId = 0)
    {

        $obj = NewsletterSubscriber::findOrFail($userId);
        $obj->delete();

        Session::flash(SUCCESS, trans("messages.$this->model.deleted_message_newsletter"));

        return Redirect::route("$this->model.index");
    } // end deleteNewsletterSubscriber()

    /**
     * Function for download csv
     *
     * @param null
     *
     * @return dowmload csv.
     */
    public function downloadCSV($UserData = array())
    {
        $getNewUserData = array();
        if (isset($UserData) && !empty($UserData)) {
            $getNewUserData = $UserData->toArray();
        }

        /**This code are used for export the csv **/
        $filename = CSV_EXPORT_ROOT_PATH . "news_letter_subscribers.csv";
        $handle = fopen($filename, 'w+');

        $fieldArray = array('Email', 'Created');

        fputcsv($handle, $fieldArray);
        if (isset($getNewUserData) && !empty($getNewUserData)) {
            foreach ($getNewUserData as $row) {

                $valueArray = array($row['email'], CustomHelper::displayDate($row['created_at']));

                fputcsv($handle, $valueArray);
            }
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        $responseArray['fileName'] = $filename;
        $responseArray['headers'] = $headers;
        $responseArray['fileSuffix'] = "news_letter_subscribers.csv";
        return $responseArray;

    } // End downloadCSV()

} // end NewsletterSubscriberController class
