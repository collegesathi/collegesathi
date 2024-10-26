<?php
use Illuminate\Support\Facades\App;

$environment = App::environment();

if ($environment == 'local') {

} else if ($environment == 'staging') {

} else if ($environment == 'production') {

}

/* Global constants for site */
define('FFMPEG_CONVERT_COMMAND', '/usr/bin/ffmpeg');
define("ADMIN_FOLDER", "admin/");
define('ADMIN_ROUTE_PREFIX', 'admin-system-manager');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', base_path());
define('APP_PATH', app_path());

if (!defined('ONTHEFLY_IMAGE_ROOT_PATH')) {
    define('ONTHEFLY_IMAGE_ROOT_PATH', 'uploads/');
}

define('WEBSITE_URL', url('/') . '/');
define('WEBSITE_JS_URL', WEBSITE_URL . 'js/');
define('WEBSITE_CSS_URL', WEBSITE_URL . 'css/');
define('WEBSITE_IMG_URL', WEBSITE_URL . 'images/');
define('WEBSITE_IMAGE_URL', WEBSITE_URL . 'images/');
define('IMPORTED_CSV_ROOT_PATH', WEBSITE_URL . 'csvfiles/');
define('WEBSITE_UPLOADS_ROOT_PATH', ROOT . DS . 'uploads' . DS);
define('WEBSITE_UPLOADS_URL', WEBSITE_URL . 'uploads/');

define('WEBSITE_ADMIN_URL', WEBSITE_URL . ADMIN_FOLDER);
define('WEBSITE_ADMIN_MAIL_URL', WEBSITE_URL . ADMIN_ROUTE_PREFIX);
define('WEBSITE_ADMIN_IMG_URL', WEBSITE_URL . 'images/' . ADMIN_FOLDER);
define('WEBSITE_ADMIN_JS_URL', WEBSITE_URL . 'js/' . ADMIN_FOLDER);
define('WEBSITE_ADMIN_FONT_URL', WEBSITE_ADMIN_URL . 'fonts/');
define('WEBSITE_ADMIN_CSS_URL', WEBSITE_URL . 'css/' . ADMIN_FOLDER);

if (!defined('WEBSITE_IMG_FILE_URL')) {
    define("WEBSITE_IMG_FILE_URL", WEBSITE_URL . 'image.php');
}

define('SETTING_FILE_PATH', APP_PATH . DS . 'settings.php');

define('CK_EDITOR_URL', WEBSITE_UPLOADS_URL . 'ckeditor_pic/');
define('CK_EDITOR_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'ckeditor_pic' . DS);

define('SLIDER_URL', WEBSITE_UPLOADS_URL . 'slider/');
define('SLIDER_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'slider' . DS);

define('USER_PROFILE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'user/');
define('USER_PROFILE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'user' . DS);

define('TESTIMONIAL_IMAGE_URL', WEBSITE_UPLOADS_URL . 'testimonial/');
define('TESTIMONIAL_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'testimonial' . DS);

define('BLOG_IMAGE_URL', WEBSITE_UPLOADS_URL . 'blog/');
define('BLOG_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'blog' . DS);

define('CMS_IMAGE_URL', WEBSITE_UPLOADS_URL . 'cms/');
define('CMS_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'cms' . DS);

define('CSV_EXPORT_URL', WEBSITE_UPLOADS_URL . 'csv_exports/');
define('CSV_EXPORT_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'csv_exports' . DS);

define('DROPDOWN_IMAGE_URL', WEBSITE_UPLOADS_URL . 'dropdown/');
define('DROPDOWN_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'dropdown' . DS);

define('VIDEO_IMAGE_URL', WEBSITE_UPLOADS_URL . 'video/');
define('VIDEO_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'video' . DS);

define('RESUME_URL', WEBSITE_UPLOADS_URL . 'resume/');
define('RESUME_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'resume' . DS);


/**  System document url path **/
if (!defined('SYSTEM_DOCUMENT_URL')) {
    define('SYSTEM_DOCUMENT_URL', WEBSITE_UPLOADS_URL . 'systemdocuments/');
}

/**  System document upload directory path **/
if (!defined('SYSTEM_DOCUMENTS_UPLOAD_DIRECTROY_PATH')) {
    define('SYSTEM_DOCUMENTS_UPLOAD_DIRECTROY_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'systemdocuments' . DS);
}

/**  System image url path **/
if (!defined('SYSTEM_IMAGE_URL')) {
    define('SYSTEM_IMAGE_URL', WEBSITE_UPLOADS_URL . 'system_images/');
}

/**  System image upload directory path **/
if (!defined('SYSTEM_IMAGE_UPLOAD_DIRECTROY_PATH')) {
    define('SYSTEM_IMAGE_UPLOAD_DIRECTROY_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'system_images' . DS);
}

define('CATEGORY_URL', WEBSITE_UPLOADS_URL . 'category/');
define('CATEGORY_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'category' . DS);

define('EXPERT_IMAGE_URL', WEBSITE_UPLOADS_URL . 'expert/');
define('EXPERT_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'expert' . DS);

define('UNIVERSITY_IMAGE_URL', WEBSITE_UPLOADS_URL . 'university/');
define('UNIVERSITY_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'university' . DS);

define('ADVERTISEMENT_IMAGE_URL', WEBSITE_UPLOADS_URL . 'advertisement/');
define('ADVERTISEMENT_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'advertisement' . DS);

define('COUNTRY_FLAG_URL', WEBSITE_UPLOADS_URL . 'country_images/');
define('COUNTRY_FLAG_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'country_images' . DS);

define('TEXT_ADMIN_ID', 1);
define('TEXT_FRONT_USER_ID', 2);

$config = array();

define('ALLOWED_TAGS_XSS', '<a><strong><b><p><br><i><font><img><h1><h2><h3><h4><h5><h6><span></div><em><table><ul><li><section><thead><tbody><tr><td><iframe>');

define('SUPER_ADMIN_ID', '1');
define('SUPER_ADMIN_ROLE_ID', '1');
define('SUPER_ADMIN_ROLE_SLUG', 'admin');

define('ADMIN_ID', '1');
define('ADMIN_ROLE_ID', '1');
define('ADMIN_ROLE_SLUG', 'admin');

define('SUB_ADMIN_ROLE_ID', '2');
define('SUB_ADMIN_ROLE_SLUG', 'subadmin');

define('CUSTOMER_ROLE_ID', '3');
define('CUSTOMER_ROLE_SLUG', 'customer');

define('PERMISSION_ALLOW', 1);
define('PARENT_ID', 0);

Config::set("Site.currencyCode", "₹");
Config::set('defaultLanguage', 'English');
Config::set('defaultLanguageCode', '1');
Config::set('default_language.message', 'All the fields in English language are mandatory.');

Config::set('input_type', array(
    'text' => 'Text',
    'textarea' => 'Textarea',
    'select' => 'Select',
    'checkbox' => 'Checkbox',
));

Config::set('prefix', array(
    '1' => 'Mrs.',
    '2' => 'Mr.',
    '3' => 'Ms.',
    '4' => 'Miss.',
));

Config::set('month', array(
    '1' => 'January',
    '2' => 'February',
    '3' => 'March',
    '4' => 'April',
    '5' => 'May',
    '6' => 'June',
    '7' => 'July',
    '8' => 'August',
    '9' => 'September',
    '10' => 'October',
    '11' => 'November',
    '12' => 'December',
));

/* Symbol Position */
Config::set('SYMBOL_POSITION', array(
    1 => "Before Value",
    2 => "After Value",
));
//////////////// extension

define('IMAGE_EXTENSION', 'jpeg,jpg,png,webp,svg');
define('PDF_EXTENSION', 'pdf');
define('CSV_EXTENSION', 'CSV');
define('DOC_EXTENSION', 'doc,xls');
define('IMAGE_INFO', '<div class="mws-form-message info">
	<a class="close pull-right" href="javascript:void(0);">&times;</a>
	<ul style="padding-left:12px">
		<li>Allowed file types are ' . IMAGE_EXTENSION . '</li>
		<li>Large files may take some time to upload so please be patient and do not hit reload or your back button</li>
	</ul>
</div>');

define('DOC_INFO', '<div class="mws-form-message info">
	<a class="close pull-right" href="javascript:void(0);">&times;</a>
	<ul style="padding-left:12px">
		<li>Allowed doc types are ' . DOC_EXTENSION . '</li>
		<li>Large files may take some time to upload so please be patient and do not hit reload or your back button</li>
	</ul>
</div>');

define('STATE_INFO', '<div class="mws-form-message info">
	<ul style="padding-left:12px">
		<li>If you will deactivate any state, all its corresponding cities will also get deactivated. </li>
		<li>If you will delete any state, all its corresponding cities will also get deleted.</li>
	</ul>
</div>');

define('COUNTRY_INFO', '<div class="mws-form-message info">
	<ul style="padding-left:12px">
		<li>If you will deactivate any country, all its corresponding states and cities will also get deactivated. </li>
		<li>If you will delete any country, all its corresponding  states and cities will also get deleted.</li>
	</ul>
</div>');

/**  Active Inactive global constant **/
define('ACTIVE', 1);
define('INACTIVE', 0);
define('REJECT', 2);

define('BLOCK', 1);
define('UNBLOCK', 0);

define('INCOMPLETE', 1);
define('COMPLETE', 3);

define('IS_DELETED', 1);
define('NOT_DELETED', 0);

define('IS_VERIFIED', 1);
define('NOT_VERIFIED', 0);
define('IS_MOBILE_VERIFIED', 1);

define('Yes', 1);
define('NO', 0);

define('UPLOADIMAGE', trans("messages.global.Upload_imageshead"));

define('DELETE_PREFIX', 'del' . time() . '-');

Config::set('GLOBAL_YES_NO', array(
    '0' => 'No',
    '1' => 'Yes',
));

define('DATE_OF_BIRTH_MIN_AGE', 0);
define('DATE_FORMAT', 'yyyy/mm/dd');
define('JS_DATE_FORMAT_FOR_DATE_SEARCH', 'YYYY-MM-DD');
define('DISPLAY_DATE_FORMAT_CALENDAR', 'd/m/Y');
define('JS_DATE_FORMAT', 'DD/MM/YYYY');
define('SHOW_DATE_FORMAT', 'd/m/Y');
define('DISPLAY_DATE_TIME_FORMAT', 'd/m/Y h:i A');

/*


define('START_DATE_FORMAT', 'Y-m-d 00:00:00');
define('END_DATE_FORMAT', 'Y-m-d 23:59:59');
define('DOB_DATE_FORMAT',     'd-m-Y');
define('DISPLAY_DATE_FORMAT', 'd/m/Y');
define('JS_HOURS_MINUTES_FORMAT',     'HH:mm');
define('JS_DATE_TIME_FORMAT',         'DD-MM-YYYY HH:mm');
define('PHP_CALENDAR_DATE_FORMAT', 'd-m-Y');
define('DISPLAY_CALENDAR_DATE_TIME_FORMAT', 'd-m-Y H:i');
define('DISPLAY_TIME_FORMAT', 'h:i A');
define('DISPLAY_HOURS_MINUTES_FORMAT', 'H:i');
define('DISPLAY_DATE_FORMAT', 'd/m/Y');
define('DISPLAY_CALENDAR_DATE_FORMAT', 'd-m-Y');
define('USER_MIN_DOB_DATE', '-18y');
define('HOURS_MINUTE_SECOND', 'H:i:s');
define('YEAR', 'Y');
define('MONTH_FORMAT', 'm');
define('YEAR_FORMAT', 'Y');
define('TODAY_DATE', date('Y-m-d 00:00:00'));
*/


define('PASSWORD_REGX', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/');
define('MOBILE_REGX', '/^([+]\d{2})?[0-9]{7,15}$/');

define('ERROR', 'error');
define('SUCCESS', 'success');

Config::set('GENDER', array(
    '1' => 'Male',
    '2' => 'Female',
    '3' => 'Others',
));

Config::set('GENDER_VALUE', array(
    'Male' => '1',
    'Female' => '2',
    'Others' => '3',
));

define('MALE', 1);
define('FEMALE', 2);
define('OTHERS', 3);

define('MESSAGE_LENGTH', 300);
define('TESTIMONIAL_MESSAGE_LENGTH', 300);
define('REQPENDING', 0);
define('REQAPPROVE', 1);
define('REQREJECT', 2);

define('PROFILE_PENDING', 0);
define('PROFILE_SUBMITTED', 1);
define('PROFILE_APPROVED', 2);
define('PROFILE_REJECTED', 3);

Config::set('PROFILE_APPROVE_REJECT_OPTIONS', array(
    PROFILE_APPROVED => 'Approve',
    PROFILE_REJECTED => 'Reject',
));

define('IS_DELETE', 1);
define('NOT_DELETE', 0);

Config::set('FORGOT_PASSWORD_OPTIONS', array(
    1 => 'By Email',
    2 => 'By Mobile Number',
));

/* DURATION TYPE */
Config::set('DURATION_TYPE', array(
    'hours' => "Hour(s)",
    'days' => "Day(s)",
    'months' => "Month(s)",
    'years' => "Year(s)",
));

/* DURATION TYPE */
Config::set('DURATION_TYPE_DROPDOWN', array(
    'days' => "Day(s)",
    'months' => "Month(s)",
    'years' => "Year(s)",
));

define('HOURS', 'Hour(s)');
Config::set('IS_PAID_OPTIONS', array(
    1 => "Paid",
    0 => "Free",
));

if (!defined('RESEND_OTP_TIME')) {
    define('RESEND_OTP_TIME', '+2 minutes');
}

if (!defined('FORGOT_OTP_TIME')) {
    define('FORGOT_OTP_TIME', '+2 minutes');
}

if (!defined('OTP_TIME')) {
    define('OTP_TIME', '+2 minutes');
}

Config::set('USAGE_LIMIT', array(
    1 => 'Only 1 time',
    2 => 'Multiple time',
));

define('ONLY_ONE_TIME_USEAGE_LIMIT', 1);
define('N_TIME_USEAGE_LIMIT', 2);

define('ADD_ACTION', 'add');
define('UPDATE_ACTION', 'update');
define('DELETE_ACTION', 'delete');
define('BLOCK_ACTION', 'block');
define('UNBLOCK_ACTION', 'unblock');
define('ACTIVE_ACTION', 'active');
define('DEACTIVE_ACTION', 'deactive');
define('VERIFY_ACTION', 'verify');
define('APPROVE_ACTION', 'approve');
define('REJECT_ACTION', 'reject');

Config::set('DEVICE_TYPES', array(
    'iphone' => 'iPhone',
    'android' => 'android',
));

Config::set('SITE_SETTING_KEY', array(
    'email',
    'title',
));

define('CMS_PAGE_NAME_LIMIT', 150);
define('CMS_PAGE_TITLE_LIMIT', 150);
define('CMS_PAGE_META_TITLE_LIMIT', 150);
define('CMS_PAGE_META_DESCRIPTION_LIMIT', 300);
define('CMS_PAGE_META_KEYWORDS_LIMIT', 150);

define('SLIDER_IMAGE_WIDTH', '500');
define('SLIDER_IMAGE_HEIGHT', '500');
define('BLOG_META_LENGTH', 160);

define('BLOG_PENDING', 0);
define('BLOG_APPROVED', 1);
define('BLOG_REJECTED', 2);

define('IMAGE_UPLOAD_FILE_MAX_SIZE', 2);

define('DROPDOWN_TYPES_FOR_ORDER', array('faq_categories'));

define('EMAIL_BROADCAST_NOTIFICATION_TYPE', 1);
define('PUSH_BROADCAST_NOTIFICATION_TYPE', 2);
define('WEB_BROADCAST_NOTIFICATION_TYPE', 3);

define('EMAIL_NOTIFICATION', 'email-notification');
define('PUSH_NOTIFICATION', 'push-notification');
define('WEB_NOTIFICATION','web-notification');

if (!defined('OTP_VALID_TIME')) {
    define('OTP_VALID_TIME', '+2 minutes');
}

define('OTP_CHARACTER_LIMIT', 4);
define('TEMP_MAIL_SEND_LIMIT', 5);
define('NOTIFICATION_DEFAULT_COUNT', 4);

define('I_PHONE_PUSH_NOTIFICATION_KEY_ID', "82FBB56236");
define('I_PHONE_PUSH_NOTIFICATION_TEAM_ID', "SFA9GUN7NY");
define('IS_KYC',0);

define('IMAGE_UPLOAD_FILE_MAX_SIZE_TWO', 2);
define('DROPDOWN_TYPES_FOR_DEGREE', array('degree','course','gender'));

Config::set('Site.fcm_key', 'AAAAjXDyLsU:APA91bHlmPe3FrqzI397I4HT5hEYHmXi-BqbzoXsJIaceQKRCE5T-O_L0CqbpLBto77PvN8e1PxveFzP4iQSyh4JowgdTBKtjf5WMS3vqrBud_e4RgNaW2y8BmEGo5P2OsYPMVnC_DTt');

Config::set('COURSE_TYPE', array(
    1 => 'UG course',
    2 =>  'PG course'
));

define('COUNTRY', 101);

define('HOME_PAGE_EXPERT_LIMIT', 4);
define('HOME_PAGE_BLOG_LIMIT', 4);
define('BLOG_LIST_DESCRIPTION_LENGTH', 135);
define('BLOG_DETAIL_DATE_FORMAT', "M d, Y");
define('FRONT_BLOG_PER_PAGE', 9);
define('FRONT_BLOG_LATEST_COUNT', 3);
define('TESTIMONIAL_HOME_PAGE_LIMIT', 5);


define('RESUME_EXTENSION', 'jpeg,jpg,png,pdf,doc');
define('USER_DOCUMENT_EXTENSION', 'jpeg,jpg,png,webp,pdf');

Config::set('DISPLAY_PAGE', array(
    1    => 'Home Page Top' ,
    2    => 'Home Page Middle',
    3    => 'Home Page Bottom',
));


define('COURSE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'course/');
define('COURSE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'course' . DS);


Config::set('CAMPUS_TYPE', array(
    '1' => 'Indian-Campus',
    '2' => 'International-Campus',
));
define('INDIAN_CAMPUS', 1);
define('INTERNATIONAL_CAMPUS', 2);

Config::set('JOB_TYPE', array(
    '1' => 'Permanent',
    '2' => 'Part Time',
    '3' => 'Work From Home',
));

define('APPLY_CAREER_CV_URL', WEBSITE_UPLOADS_URL . 'career_cv/');
define('APPLY_CAREER_CV_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'career_cv' . DS);
define('EXPORT_TYPE', 'export');
define('LIST_TYPE', 'list');
define('CAREER_PAGE_DEFAULT_LIMIT', 2);
define('CV_EXTENSION', 'pdf,doc,docx');

define('UNIVERSITY_LIST_PAGE_DEFAULT_LIMIT', 2);

Config::set('COURSE_CATEGORY_TYPE_DROPDOWN', array(
    1 => 'UG Courses',
    2 => 'PG Courses',
    3 => 'Skilling & Certificate',
    4 => 'Advanced Diploma',
));


define('REVIEW_RATING_MAX_LENGTH', 300);
define('REVIEW_MESSAGE_LENGTH', 300);


Config::set('RATING_LIST', array(
    '1' => '1',
    '2' => '2',
    '3' => '3',
    '4' => '4',
    '5' => '5',
));
 
define('SMS_API_ENABLE', true);
define('SMS_TEMPLATE_ID', '648c4d76d6fc0563463856e5');
define('SMS_AUTH_KEY', '398466AqfN6xUoBa648c4dafP1');

define('UNIVERSITY_CERTIFICATE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'university-certificates/');
define('UNIVERSITY_CERTIFICATE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'university-certificates' . DS);


define('COURSE_CERTIFICATE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'course-certificates/');
define('COURSE_CERTIFICATE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'course-certificates' . DS);


Config::set('SURVE_QUESTION_CATEGORY', array(
    1 => 'UG',
    2 => 'PG',
    3 => 'Executive Programs',
    4 => 'AI ML/Data Science',
    5 => 'Certifications',
    6 => 'Law (LL.M.)'
));


define('LOAN_PARTNER_IMAGE_URL', WEBSITE_UPLOADS_URL . 'loan_partners/');
define('LOAN_PARTNER_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'loan_partners' . DS);
