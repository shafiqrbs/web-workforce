<?php


/*

  |--------------------------------------------------------------------------

  | Web Routes

  |--------------------------------------------------------------------------

  |

  | Here is where you can register web routes for your application. These

  | routes are loaded by the RouteServiceProvider within a group which

  | contains the "web" middleware group. Now create something great!

  |

 */

use Illuminate\Support\Facades\Route;

$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR . 'front_routes' . DIRECTORY_SEPARATOR;


Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    Session::put('locale', $locale);
    return redirect()->back();
})->name('language_switcher');




/* * ******** IndexController ************ */
Route::get('/digital-clock', function () {
    return date('h:i:s A');
})->name('digital_clock');
Route::get('/', 'IndexController@index')->name('index');
Route::get('/new', 'IndexController@indexNewRaju')->name('index.new');
Route::get('/construction/mode', 'IndexController@constructionMode')->name('construction_mode');

Route::get('new-index', 'IndexController@newIndex')->name('newindex');

Route::post('set-locale', 'IndexController@setLocale')->name('set.locale');

/* * ******** HomeController ************ */

Route::get('home', 'HomeController@index')->name('home');

/* * ******** TypeAheadController ******* */

Route::get('typeahead-currency_codes', 'TypeAheadController@typeAheadCurrencyCodes')->name('typeahead.currency_codes');

/* * ******** FaqController ******* */

Route::get('faq', 'FaqController@index')->name('faq');
Route::POST('contact/form', 'FaqController@contactForm')->name('contact_form');

/* * ******** CronController ******* */

Route::get('check-package-validity', 'CronController@checkPackageValidity');

/* * ******** Verification ******* */
Auth::routes(['verify' => true]);
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');

Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Route::get('company-email-verification/error', 'Company\Auth\RegisterController@getVerificationError')->name('company.email-verification.error');

Route::get('company-email-verification/check/{token}', 'Company\Auth\RegisterController@getVerification')->name('company.email-verification.check');

/* * ***************************** */

// Sociallite Start

// OAuth Routes

Route::get('login/jobseeker/{provider}', 'Auth\LoginController@redirectToProvider');

Route::get('login/jobseeker/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('login/employer/{provider}', 'Company\Auth\LoginController@redirectToProvider');

Route::get('login/employer/{provider}/callback', 'Company\Auth\LoginController@handleProviderCallback');

// Sociallite End

/* * ***************************** */

Route::post('tinymce-image_upload-front', 'TinyMceController@uploadImage')->name('tinymce.image_upload.front');



Route::get('cronjob/send-alerts', 'AlertCronController@index')->name('send-alerts');



Route::post('subscribe-newsletter', 'SubscriptionController@getSubscription')->name('subscribe.newsletter');





Route::get('search', 'GlobalSearchController@globalSearch')->name('global_search');







/* * ******** OrderController ************ */

include_once($real_path . 'order.php');
include_once($real_path . 'order_paypal.php');

/* * ******** CmsController ************ */

include_once($real_path . 'cms.php');

/* * ******** JobController ************ */

include_once($real_path . 'job.php');

/* * ******** ContactController ************ */

include_once($real_path . 'contact.php');

/* * ******** CompanyController ************ */

include_once($real_path . 'company.php');

/* * ******** AjaxController ************ */

include_once($real_path . 'ajax.php');

/* * ******** UserController ************ */

include_once($real_path . 'site_user.php');
include_once($real_path . 'jobseeker_search.php');


include_once($real_path . 'committee_member.php');
include_once($real_path . 'club.php');
include_once($real_path . 'event.php');
include_once($real_path . 'archive.php');
include_once($real_path . 'financial_partner.php');
include_once($real_path . 'athlete.php');
include_once($real_path . 'member_club.php');
include_once($real_path . 'news_and_notice.php');
include_once($real_path . 'gallery.php');
include_once($real_path . 'judges_jury.php');
include_once($real_path . 'arms.php');

/* * ******** User Auth ************ */

Auth::routes();

/* * ******** Company Auth ************ */

include_once($real_path . 'company_auth.php');

/* * ******** Admin Auth ************ */

include_once($real_path . 'admin_auth.php');



Route::get('blog', 'BlogController@index')->name('blogs');

Route::get('blog/search', 'BlogController@search')->name('blog-search');

Route::get('blog/{slug}', 'BlogController@details')->name('blog-detail');

Route::get('/blog/category/{blog}', 'BlogController@categories')->name('blog-category');

Route::get('/company-change-message-status', 'CompanyMessagesController@change_message_status')->name('company-change-message-status');
Route::get('/seeker-change-message-status', 'Job\SeekerSendController@change_message_status')->name('seeker-change-message-status');

Route::get('/sitemap', 'SitemapController@index');

Route::get('/sitemap/companies', 'SitemapController@companies');


Route::get('/clear-cache', function () {
  $exitCode = Artisan::call('config:clear');
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('config:cache');
  return 'DONE'; //Return anything
});


/** Job Seeker Registration
 * Render States
 */
Route::post('/cities', 'Custom\AjaxController@renderCities')->name('render_cities');
Route::get('/registration-preview/{id}', 'Auth\RegisterController@registrationPreview')->name('registration_preview');
Route::post('/registration-update/{id}', 'Auth\RegisterController@registrationUpdate')->name('registration_update');
Route::post('/registration-confirm/{id}', 'Auth\RegisterController@registrationConfirm')->name('register_confirm');
Route::get('/registration-confirmation/{id}', 'Auth\RegisterController@confirmationPage')->name('confirmation_page');
Route::get('/registration-cancel/{id}', 'Auth\RegisterController@registrationCancel')->name('register_cancel');
Route::get('/registration-edit/{id}', 'Auth\RegisterController@registrationEdit')->name('register_edit');


/**
 * Resume
 */
Route::get('manage-resume', 'Custom\ResumeController@index')->name('manage.resume');
Route::post('save-resume', 'Custom\ResumeController@save')->name('save.resume');
Route::get('jobseeker/resume/{id}', 'Custom\ResumeController@show')->name('show.resume');
Route::get('delete-resume/{id}', 'Custom\ResumeController@delete')->name('delete.resume');


/**
 * Upload video
 */

Route::get('video', 'UserController@videos')->name('list.video');
Route::get('upload-video', 'UserController@uploadVideo')->name('upload.video');
Route::post('save-video', 'UserController@saveVideo')->name('save.video');
Route::get('delete/video', 'UserController@deleteVideo')->name('delete.vid');
Route::get('approval/video', 'UserController@approvalVideo')->name('approval.video');
Route::get('submit/video', 'UserController@submitApprovalVideo')->name('video.submit.approval');


//Route::get('account/delete/reason', 'UserController@userAccountDeleteReason')->name('account.delete.reason');
//Route::post('delete/user/account', 'UserController@deleteAccount')->name('delete.account');
//Route::get('delete/confirmation', 'IndexController@deleteConfirmationMessage')->name('delete.confirm.message');
//Route::get('change/password', 'UserController@changePasswordPage')->name('pass.change.page');
//Route::post('update/password', 'UserController@changePassword')->name('pass.change');

Route::get('account/delete/reason', 'UserController@userAccountDeleteReason')->name('account.delete.reason');
Route::get('delete/user/account', 'UserController@deleteAccount')->name('delete.account');
Route::get('delete/confirmation', 'IndexController@deleteConfirmationMessage')->name('delete.confirm.message');
Route::get('change/password', 'UserController@changePasswordPage')->name('pass.change.page');
Route::post('update/password', 'UserController@changePassword')->name('pass.change');

/**
 * CUSTOM ROUTES
 */
Route::get('terms-of-use', 'Custom\CustomController@terms')->name('terms');
Route::get('privacy-policy', 'Custom\CustomController@privacy')->name('privacy');
//Route::get('faq', 'Custom\CustomController@faq')->name('faq');
Route::get('reviews/{status}', 'Custom\CustomController@review')->name('review');


/**
 * Admin
 */

//Route::get('admin/profile-video/approve/{id}', 'Custom\CustomController@approveProfileVideo')->name('approve.vid');
Route::get('admin/profile-video/decline/{id}', 'Custom\CustomController@declineProfileVideo')->name('approve.vid');
Route::get('admin/profile-video/delete/{id}', 'Custom\CustomController@deleteProfileVideo')->name('delete.profile.vid');
Route::get('fetch-user-videos', 'Admin\UserVideoController@fetchUserVideosData')->name('fetch.user.videos');


/**
 * Testimonial user
 */
Route::get('user/testimonial', 'Custom\CustomController@testimonialPage')->name('user.testimonial.page');
Route::get('user/testimonials', 'Custom\CustomController@testimonials')->name('user.testimonials');
Route::get('user/testimonials/delete', 'Custom\CustomController@deleteTestimonial')->name('user.testimonial.delete');
Route::post('user/testimonial/save', 'Custom\CustomController@testimonialSave')->name('save.user.review');


/**
 * Contact us
 */
Route::post('contact-us/process', 'Custom\CustomController@contactUsProcess')->name('contact_us_process');




//Rakib Code Start

/*
 * Employer
 */
Route::get('/employer-register', 'Employer\RegisterController@showRegistrationForm')->name('employer_register');
Route::post('/employer-register', 'Employer\RegisterController@register');

Route::get('/employer-registration-preview/{id}', 'Employer\RegisterController@registrationPreview')->name('employer_registration_preview');
Route::post('employer/registration-confirm/{id}', 'Employer\RegisterController@registrationConfirm')->name('employer_register_confirm');
Route::get('employer/packages/list/{id}', 'Employer\RegisterController@employeePackages')->name('employer_packages_list');

Route::get('/employer-registration-edit/{id}', 'Employer\RegisterController@registrationEdit')->name('employer_register_edit');
Route::post('/employer-registration-update/{id}', 'Employer\RegisterController@registrationUpdate')->name('employer_registration_update');

Route::post('/update-employer-profile', 'UserController@updateEmployerProfile')->name('update.employer.profile');

//Rakib Code End


Route::get('/employer-manage-access', 'Employer\SubAccountRegisterController@manageAccess')->name('manageAccess');
Route::post('/employer-manage-access', 'Employer\SubAccountRegisterController@addAccount')->name('create-user');
Route::get('/employer-manage-access/remove/{id}', 'Employer\SubAccountRegisterController@deleteSubAccount')->name('delete.sub.account');

Route::get('employer-save-search','Employer\JobSeekerSearchController@showSaveSearch')->name('saveSearch');
Route::get('saved-jobseeker-profile','Employer\JobSeekerSearchController@showSaveJobseekerProfile')->name('savedJobseekerPofile');

Route::get('public-profile/view/{id}', 'Custom\CustomController@publicProfileView')->name('public.profile.view');


//Ajax
Route::get('ajax/job/title/search', 'Custom\AjaxController@renderJobTitles')->name('render_job_titles_ajax');

Route::post('/checkemail','Employer\SubAccountRegisterController@checkEmail');
Route::post('/activeUser','Employer\SubAccountRegisterController@activeUser');

Route::get('about_us', [FrontendController::class, 'aboutus'])->name('about_us');
Route::get('case_story', [FrontendController::class, 'caseStory'])->name('case_story');
Route::get('news', [FrontendController::class, 'news'])->name('news');
Route::get('events', [FrontendController::class, 'event'])->name('event');
Route::get('resource', [FrontendController::class, 'resource'])->name('resource');
Route::get('achievement', [FrontendController::class, 'achievement'])->name('achievement');
Route::get('contact', [FrontendController::class, 'contact'])->name('contact');
