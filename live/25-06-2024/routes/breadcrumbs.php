<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


###########  Breadcrumbs for Dashboard #############################
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('AdminDashBoard.index'));
});


###########  Breadcrumbs for AdminModules #############################
Breadcrumbs::for('admin-modules', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Admin Modules', route('AdminModules.index'));
});

Breadcrumbs::for('admin-modules-add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-modules');
	$trail->push('Add Admin Module');
});

Breadcrumbs::for('admin-modules-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-modules');
	$trail->push('Edit Admin Module');
});


###########  Breadcrumbs for Access Role #############################
Breadcrumbs::for('access-roles', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Access Roles', route('AccessRoles.index'));
});

Breadcrumbs::for('access-role-add', function (BreadcrumbTrail $trail) {
    $trail->parent('access-roles');
	$trail->push('Add Access Role');
});

Breadcrumbs::for('access-role-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('access-roles');
	$trail->push('Edit Access Role');
});


###########  Breadcrumbs for Access Role #############################
Breadcrumbs::for('admin-users', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Admin Users', route('Permission.index'));
});

Breadcrumbs::for('admin-user-add', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-users');
	$trail->push('Add Admin User');
});

Breadcrumbs::for('admin-user-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('admin-users');
	$trail->push('Edit Admin User');
});


###########  Breadcrumbs for customer #############################
Breadcrumbs::for('customer-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Customers', route('User.index'));
});

Breadcrumbs::for('customer-add', function (BreadcrumbTrail $trail) {
    $trail->parent('customer-list');
	$trail->push('Add Customer');
});

Breadcrumbs::for('customer-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('customer-list');
	$trail->push('Edit Customer');
});

Breadcrumbs::for('customer-view', function (BreadcrumbTrail $trail) {
    $trail->parent('customer-list');
	$trail->push('View Customer');
});


###########  Breadcrumbs for Email Logs #############################
Breadcrumbs::for('email-logs', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Email Logs');
});


###########  Breadcrumbs for Contact Enquiries #############################
Breadcrumbs::for('contact-enquiries', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Contact Enquiries');
});


###########  Breadcrumbs for Email Template #############################
Breadcrumbs::for('emailTemplate-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Email Templates', route('EmailTemplate.index'));
});

Breadcrumbs::for('emailTemplate-add', function (BreadcrumbTrail $trail) {
    $trail->parent('emailTemplate-list');
	$trail->push('Add Email Template');
});

Breadcrumbs::for('emailTemplate-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('emailTemplate-list');
	$trail->push('Edit Email Template');
});


###########  Breadcrumbs for TextSetting #############################
Breadcrumbs::for('TextSetting', function (BreadcrumbTrail $trail,  $textsettings) {
    $trail->parent('dashboard');
    $trail->push($textsettings['title'], route('TextSetting.index', $textsettings['type']));
});


###########  Breadcrumbs for Setting #############################
Breadcrumbs::for('setting-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Settings', route('Setting.index'));
});

Breadcrumbs::for('setting-add', function (BreadcrumbTrail $trail) {
    $trail->parent('setting-list');
	$trail->push('Add Setting');
});

Breadcrumbs::for('setting-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('setting-list');
	$trail->push('Edit Setting');
});

Breadcrumbs::for('settings-prefix', function (BreadcrumbTrail $trail,  $settings) {
    $trail->parent('dashboard');
    $trail->push($settings['title'], route('Setting.prefix_index', $settings['type']));
});


###########  Breadcrumbs for Countries #############################
Breadcrumbs::for('country-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Countries', route('Country.index'));
});

Breadcrumbs::for('country-add', function (BreadcrumbTrail $trail) {
    $trail->parent('country-list');
	$trail->push('Add Country');
});

Breadcrumbs::for('country-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('country-list');
	$trail->push('Edit Country');
});


Breadcrumbs::for('state-list', function (BreadcrumbTrail $trail, $countryData) {
    $trail->parent('dashboard');
	$trail->push('Country ( '.$countryData->country_name.' )', route('Country.index'));
	$trail->push('States', route('State.index', $countryData->id));
});

Breadcrumbs::for('state-add', function (BreadcrumbTrail $trail, $countryData) {
    $trail->parent('state-list', $countryData);
	$trail->push('Add State');
});

Breadcrumbs::for('state-edit', function (BreadcrumbTrail $trail, $countryData) {
    $trail->parent('state-list', $countryData);
	$trail->push('Edit State');
});


Breadcrumbs::for('city-list', function (BreadcrumbTrail $trail, $countryStateData) {
    $trail->parent('dashboard');
	$trail->push('Country ( '.$countryStateData->countryName->country_name.' )', route('Country.index'));
	$trail->push('States ( '.$countryStateData->state_name.' )', route('State.index', $countryStateData->countryName->id));
	$trail->push('Cities', route('City.index', $countryStateData->id));
});

Breadcrumbs::for('city-add', function (BreadcrumbTrail $trail, $countryStateData) {
    $trail->parent('city-list', $countryStateData);
	$trail->push('Add City');
});

Breadcrumbs::for('city-edit', function (BreadcrumbTrail $trail, $countryStateData) {
    $trail->parent('city-list', $countryStateData);
	$trail->push('Edit City');
});


###########  Breadcrumbs for Newsletter Subscribers #############################
Breadcrumbs::for('news-letter-subscribers', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Newsletter Subscribers');
});



###########  Breadcrumbs for Jobs #############################
Breadcrumbs::for('job-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Jobs', route('Job.index'));
});

Breadcrumbs::for('job-add', function (BreadcrumbTrail $trail) {
    $trail->parent('job-list');
	$trail->push('Add Job');
});

Breadcrumbs::for('job-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('job-list');
	$trail->push('Edit Job');
});

Breadcrumbs::for('job-view', function (BreadcrumbTrail $trail) {
    $trail->parent('job-list');
	$trail->push('View Job');
});



###########  Breadcrumbs for job Application #############################
Breadcrumbs::for('job-application-list', function (BreadcrumbTrail $trail, $job_id) {
    $trail->parent('dashboard');
	$trail->push('Job Applications', route('Job.jobApplications',$job_id));
});

Breadcrumbs::for('job-application-view', function (BreadcrumbTrail $trail) {
    $trail->parent('job-application-list');
	$trail->push('View Job Applications');
});





###########  Breadcrumbs for Blogs #############################
Breadcrumbs::for('blog-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Blogs', route('Blog.index'));
});

Breadcrumbs::for('blog-add', function (BreadcrumbTrail $trail) {
    $trail->parent('blog-list');
	$trail->push('Add Blog');
});

Breadcrumbs::for('blog-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('blog-list');
	$trail->push('Edit Blog');
});

Breadcrumbs::for('blog-view', function (BreadcrumbTrail $trail) {
    $trail->parent('blog-list');
	$trail->push('View Blog');
});


###########  Breadcrumbs for Block #############################
Breadcrumbs::for('block', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Block', route('Block.index'));
});

Breadcrumbs::for('block-add', function (BreadcrumbTrail $trail) {
    $trail->parent('block');
	$trail->push('Add Block');
});

Breadcrumbs::for('block-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('block');
	$trail->push('Edit Block');
});



###########  Breadcrumbs for CMS pages #############################
Breadcrumbs::for('cms-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('CMS Pages', route('Cms.index'));
});

Breadcrumbs::for('cms-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('cms-page-list');
	$trail->push('Add page');
});

Breadcrumbs::for('cms-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('cms-page-list');
	$trail->push('Edit page');
});

Breadcrumbs::for('cms-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('cms-page-list');
	$trail->push('View page');
});

###########  Breadcrumbs for Expert Module #############################
Breadcrumbs::for('expert-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Expert', route('Expert.index'));
});

Breadcrumbs::for('expert-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('expert-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('expert-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('expert-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('expert-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('expert-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Survey Module #############################
Breadcrumbs::for('survey-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Survey', route('Survey.index'));
});

Breadcrumbs::for('survey-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('survey-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for University Module #############################
Breadcrumbs::for('university-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('University', route('University.index'));
});

Breadcrumbs::for('university-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('university-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('university-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('university-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('university-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('university-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Testimonial Module #############################
Breadcrumbs::for('testimonial-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Testimonial', route('Testimonial.index'));
});

Breadcrumbs::for('testimonial-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('testimonial-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('testimonial-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('testimonial-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('testimonial-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('testimonial-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Faq Module #############################
Breadcrumbs::for('faq-page-list', function (BreadcrumbTrail $trail,$uni_id,$course_id) {
    $trail->parent('dashboard');
    $university_name = isset($uni_id) && !empty($uni_id) ? CustomHelper::getUniversiryNameById($uni_id) : '';
    $course_name = isset($course_id) && !empty($course_id) ? CustomHelper::universityCourseNameById($course_id) : '';
    if(isset($uni_id) && isset($course_id)){
        $trail->push("$university_name > $course_name", route('CourseFaq.index',[$uni_id,$course_id]));
    } elseif(isset($uni_id)&& !isset($course_id)){
        $trail->push("$university_name", route('UniversityFaq.index',$uni_id));
    } else{
        $trail->push('Faq', route('Faq.index'));
    }
});

Breadcrumbs::for('faq-page-add', function (BreadcrumbTrail $trail,$uni_id,$course_id) {
    $trail->parent('faq-page-list',$uni_id,$course_id);
	$trail->push('Add');
});

Breadcrumbs::for('faq-page-edit', function (BreadcrumbTrail $trail,$uni_id,$course_id) {
    $trail->parent('faq-page-list',$uni_id,$course_id);
	$trail->push('Edit');
});

Breadcrumbs::for('faq-page-view', function (BreadcrumbTrail $trail,$uni_id,$course_id) {
    $trail->parent('faq-page-list',$uni_id,$course_id);
	$trail->push('View');
});

###########  Breadcrumbs for Slider Module #############################
Breadcrumbs::for('slider-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Slider', route('Slider.index'));
});

Breadcrumbs::for('slider-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('slider-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('slider-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('slider-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('slider-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('slider-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Video Module #############################
Breadcrumbs::for('video-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Video', route('Video.index'));
});

Breadcrumbs::for('video-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('video-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('video-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('video-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('video-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('video-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Advertisement Module #############################
Breadcrumbs::for('advertisement-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Advertisement', route('Advertisement.index'));
});

Breadcrumbs::for('advertisement-page-add', function (BreadcrumbTrail $trail) {
    $trail->parent('advertisement-page-list');
	$trail->push('Add');
});

Breadcrumbs::for('advertisement-page-edit', function (BreadcrumbTrail $trail) {
    $trail->parent('advertisement-page-list');
	$trail->push('Edit');
});

Breadcrumbs::for('advertisement-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('advertisement-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for Review Module #############################
Breadcrumbs::for('review-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('Review', route('Review.index'));
});

Breadcrumbs::for('review-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('review-page-list');
	$trail->push('View');
});

###########  Breadcrumbs for University Application Module #############################
Breadcrumbs::for('university-application-page-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
	$trail->push('University Applications', route('UniversityApplication.applicationindex'));
});

Breadcrumbs::for('university-application-page-view', function (BreadcrumbTrail $trail) {
    $trail->parent('university-application-page-list');
	$trail->push('View');
});




Breadcrumbs::for('course', function (BreadcrumbTrail $trail,$univercityId) {
    $trail->parent('dashboard');
    $trail->push('Course',route('Course.listCourse',$univercityId));
});

Breadcrumbs::for('course_add', function (BreadcrumbTrail $trail,$univercityId) {
    $trail->parent('course',$univercityId);
    $trail->push('Add');
});

Breadcrumbs::for('course_edit', function (BreadcrumbTrail $trail,$univercityId) {
    $trail->parent('course',$univercityId);
    $trail->push('Edit');
});

Breadcrumbs::for('course_view', function (BreadcrumbTrail $trail,$univercityId) {
    $trail->parent('course',$univercityId);
    $trail->push('View');
});

Breadcrumbs::for('semester', function (BreadcrumbTrail $trail,$univercityId) {
    $trail->parent('course',$univercityId);
    $trail->push('Semesters');
});



Breadcrumbs::for('university-loan-partners', function (BreadcrumbTrail $trail,$universityName,$uni_id) {
    $trail->parent('dashboard');
    if(isset($universityName) && isset($uni_id)){
        $trail->push("$universityName > Loan Partners", route('University.loan_partners',$uni_id));
    }
});


Breadcrumbs::for('university-add-loan-partners', function (BreadcrumbTrail $trail,$universityName,$uni_id) {
    $trail->parent('university-loan-partners',$universityName,$uni_id);
	$trail->push('Add');
});