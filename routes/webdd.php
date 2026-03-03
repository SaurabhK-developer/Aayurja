<?php
use App\Http\Controllers\RazorpayPaymentController;

Route::get('route-cache', 'CacheController@routeCache');
Route::get('route-clear', 'CacheController@routeClear'); 
Route::get('cache-clear', 'CacheController@cacheClear');
Route::get('view-clear', 'CacheController@viewClear');
 Route::get('/clear-cache', function() {

    $exitCode = Artisan::call('config:clear');

    $exitCode = Artisan::call('cache:clear');

    $exitCode = Artisan::call('view:clear');

    $exitCode = Artisan::call('route:clear');

    // return what you want

});

Route::post('razorpay-payment', [RazorpayPaymentController::class, 'store'])->name('razorpay.payment.store');
Route::post('razorpay-payment-fail', [RazorpayPaymentController::class, 'store2'])->name('razorpay.payment.fail');


Route::redirect('/admin/login', '/admin/home');
Route::get('/', 'WebsiteController@index');
Route::get('/impact', 'WebsiteController@impact');
Route::get('/governance', 'WebsiteController@governance');
Route::get('/home2', 'WebsiteController@home');


Route::get('/about-us', 'WebsiteController@about_us');
Route::get('/I-want-to-grow-up-and-become-a-big-rich-man-says-6-year-old-cancer-champion-Shriraj', 'WebsiteController@champion_Shriraj');
Route::get('/A-single-mother-who-refused-to-give-up-so-her-young-son-could-bravely-fight-cancer', 'WebsiteController@fight_Cancer');
Route::get('/A-single-mother-determination-courage-to-make-sure-her-son-receives-treatment', 'WebsiteController@receives_treatment');
Route::get('/story-of-courage', 'WebsiteController@transport_sector');
Route::get('/aradhya-live-up', 'WebsiteController@aradhya_lives_up');
Route::get('Ayesha-west-bengal', 'WebsiteController@west_bengal');

Route::get('/details-of-shabnam', 'WebsiteController@details_of_shabnam');
Route::get('/details-of-sandeep', 'WebsiteController@details_of_sandeep');
Route::get('/details-of-poonam-nanda', 'WebsiteController@details_of_poonam_nanda');
Route::get('/details-yuvraj', 'WebsiteController@details_yuvraj');

Route::get('Deepu-was-just-in-9th-Class-when-he-started-having-swelling-and-pain', 'WebsiteController@legs_and_arms');
Route::get('Satwik-would-often-have-bruises-on-his-legs-and-arms', 'WebsiteController@swelling_and_pain');

Route::get('/blog/{slug}', 'WebsiteController@blog_detail');
Route::get('/news/{slug}', 'WebsiteController@news_detail');
Route::get('/press-releases/{slug}', 'WebsiteController@press_detail');
Route::get('/press-coverage/{slug}', 'WebsiteController@press_cov_detail');
Route::get('/blog', 'WebsiteController@blogs');
Route::get('/case-study/{slug}', 'WebsiteController@case_study_detail');
Route::get('/case-study', 'WebsiteController@case_study');
Route::get('/contact-us', 'WebsiteController@contact_us');
Route::get('/media-room', 'WebsiteController@media_room');
Route::get('/payment-failed', 'WebsiteController@payment_failed');


Route::get('/donate', 'WebsiteController@donate');

Route::get('/Careers', 'WebsiteController@Careers');

Route::get('/cancer-awareness', 'WebsiteController@cancer_awareness');
Route::get('/cancer-patient-navigation-program', 'WebsiteController@cancer_patient_navigation_program');
Route::get('/partner', 'WebsiteController@partner');
Route::get('/cancer-relief', 'WebsiteController@cancer_relief');
Route::get('/cancer-scholarship', 'WebsiteController@cancer_scholarship');
Route::get('/cancer-screening', 'WebsiteController@cancer_screening');
Route::get('/breast-cancer-program', 'WebsiteController@breast_cancer_program');
Route::get('/causes-and-risk', 'WebsiteController@causes_and_risk');
Route::get('/pediatric-cancer-program', 'WebsiteController@pediatric_cancer_program');
Route::get('/YWC-Oral-Head', 'WebsiteController@YWC_Oral_Head');
Route::get('/get-involed', 'WebsiteController@get_involed');
Route::get('/YWC-cancer-fund', 'WebsiteController@YWC_cancer_fund');
Route::get('/YWC-scholarship-cancer-survivors', 'WebsiteController@YWC_scholarship_cancer_survivors');
Route::get('/nearby-hospitals', 'WebsiteController@nearby_hospitals');
Route::get('/new-breast-cancer-program', 'WebsiteController@new_breast_cancer_program');

Route::get('/signs-and-symptoms', 'WebsiteController@signs_and_symptoms');
Route::get('/managing-and-treating-cancer', 'WebsiteController@ManagingAndTreatingCancer');
Route::get('/what-is-cancer', 'WebsiteController@WhatisCancer');
Route::get('/faq', 'WebsiteController@Faq');
Route::get('/key-cancer-statistics', 'WebsiteController@KeyCancerStatistics');
Route::get('/blog-detail', 'WebsiteController@blog_detail_2');
Route::get('/cancer-program', 'WebsiteController@cancer_program');
Route::get('/press-coverage-detail', 'WebsiteController@press_coverage_detail');
Route::get('/preventing-cancer', 'WebsiteController@preventing_cancer');
Route::get('/financial-aid', 'WebsiteController@government_schemes');
Route::get('/cancer-treatment', 'WebsiteController@cancer_treatment');
Route::get('/ngo', 'WebsiteController@ngo');
Route::get('/crowdfunding', 'WebsiteController@crowdfunding');
Route::post('/donation-receipt', 'WebsiteController@donation_receipt');
Route::post('/donation-certificate', 'WebsiteController@donation_certificate');
Route::get('/donate-thank-you', 'WebsiteController@donate_thank_you');
Route::get('/covid-relief', 'WebsiteController@covid_relief');
Route::get('/covid-relief-hygiene', 'WebsiteController@covid_relief_hygiene');
Route::get('/covid-relief-kit-distribution', 'WebsiteController@covid_relief_kit_distribution');
Route::get('/covid-relief-mission', 'WebsiteController@covid_relief_mission');
Route::get('/covid-relief-kit-project-1', 'WebsiteController@covid_relief_kit_project_1');
Route::get('/project-details/{slug}', 'WebsiteController@project_details');

Route::get('/refer-a-friend-and-earn', 'WebsiteController@refer_earn');
Route::get('/savings-calculator', 'WebsiteController@solar_calculator');
Route::get('/thank-you', 'WebsiteController@thank_you');

Route::get('/terms', 'WebsiteController@terms');
Route::get('/why_cancer', 'WebsiteController@why_cancer');

Route::get('/student_achievement', 'WebsiteController@student_achievement');
Route::get('/industrial_exposure', 'WebsiteController@industrial_exposure');

Route::get('/donation-certificate-pdf', 'WebsiteController@donation_certificate_pdf');
Route::get('/donation-receipt-pdf', 'WebsiteController@donation_receipt_pdf');




Route::get('/collaborate', 'WebsiteController@collaborate');
Route::get('/volunteer', 'WebsiteController@volunteer');
Route::get('/pediatric_cancer_detail', 'WebsiteController@pediatric_cancer_detail');


Route::get('/annexure', 'WebsiteController@annexure');


Route::get('logout', 'Auth\LoginController@logout')->name('auth.logout');
Route::post('/send-news', 'WebsiteController@news');
Route::post('/general-form-save', 'WebsiteController@general_form_save');
Route::post('/soler_calculator', 'WebsiteController@soler_calculator');
Route::post('/purchase-solar', 'WebsiteController@purchase_solar');
Route::post('/submitpop', 'WebsiteController@submitpop');




Route::post('/contact-save', 'WebsiteController@contactsave');
Route::post('/showdonation', 'WebsiteController@donation_show');
Route::post('/career-save', 'WebsiteController@careersave');




//addmission

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    //category
   
    //blog
    
    Route::resource('blog', 'Admin\blogController');
    Route::delete('blog_mass_destroy', 'Admin\blogController@massDestroy')->name('blog.mass_destroy');
    
    
     Route::resource('community', 'Admin\communitiesController');
    
    Route::delete('community_mass_destroy', 'Admin\communitiesController@massDestroy')->name('community.mass_destroy');
    
   
   
   //section content
   
    Route::resource('sectioncontent', 'Admin\SectionController');
    Route::delete('sectioncontent_mass_destroy', 'Admin\SectionController@massDestroy')->name('sectioncontent.mass_destroy');
    
    //hospital
       Route::resource('hospital', 'Admin\HospitalController');
    Route::delete('hospital_mass_destroy', 'Admin\HospitalController@massDestroy')->name('hospital.mass_destroy');
   
   
   //patner
   Route::resource('patner', 'Admin\PatnerController');
    Route::delete('patner_mass_destroy', 'Admin\PatnerController@massDestroy')->name('patner.mass_destroy');
   
   
     Route::resource('author', 'Admin\AuthorController');
    Route::delete('author_mass_destroy', 'Admin\AuthorController@massDestroy')->name('author.mass_destroy');
   
    Route::resource('tags', 'Admin\TagsController');
    Route::delete('tags_mass_destroy', 'Admin\TagsController@massDestroy')->name('tags.mass_destroy');
   
   
   Route::resource('news', 'Admin\CasestudyController');
    Route::delete('news_mass_destroy', 'Admin\CasestudyController@massDestroy')->name('news.mass_destroy');
   
    
    
      Route::resource('seos', 'Admin\All_urlController');
    Route::delete('seos_mass_destroy', ['uses' => 'Admin\All_urlController@massDestroy', 'as' => 'seos.mass_destroy']);
    Route::post('seos_restore/{id}', ['uses' => 'Admin\All_urlController@restore', 'as' => 'seos.restore']);
    Route::delete('seos_perma_del/{id}', ['uses' => 'Admin\All_urlController@perma_del', 'as' => 'seos.perma_del']);
    
       //contact
    
    Route::resource('contact', 'Admin\ContactController');
    Route::delete('contact_mass_destroy', 'Admin\ContactController@massDestroy')->name('contact.mass_destroy');
    
    //project
    
     Route::resource('project', 'Admin\projectController');
    Route::delete('project_mass_destroy', 'Admin\projectController@massDestroy')->name('project.mass_destroy');
    
    
     
    Route::resource('enquiry', 'Admin\GeneralController');
    Route::delete('enquiry_mass_destroy', 'Admin\GeneralController@massDestroy')->name('enquiry.mass_destroy');
    
    
     //testimonials
     Route::resource('testimonials', 'Admin\testimonialsController');
    Route::delete('testimonials_mass_destroy', 'Admin\testimonialsController@massDestroy')->name('testimonials.mass_destroy');

    //category
    Route::resource('categories', 'Admin\CategoriesController');
    Route::delete('categories_mass_destroy', 'Admin\CategoriesController@massDestroy')->name('categories.mass_destroy');

    //slider
    Route::resource('slider', 'Admin\sliderController');
    Route::delete('slider_mass_destroy', 'Admin\sliderController@massDestroy')->name('slider.mass_destroy');
    //slider

   Route::resource('galleries', 'Admin\GalleriesController');
    Route::delete('galleries_mass_destroy', 'Admin\GalleriesController@massDestroy')->name('galleries.mass_destroy');
    
    //team
    Route::resource('team', 'Admin\TeamController');
    Route::delete('team_mass_destroy', 'Admin\TeamController@massDestroy')->name('team.mass_destroy');
    
    Route::resource('video', 'Admin\VideoController');
    Route::delete('video_mass_destroy', 'Admin\VideoController@massDestroy')->name('video.mass_destroy');
    
    Route::resource('event', 'Admin\EventController');
    Route::delete('event_mass_destroy', 'Admin\EventController@massDestroy')->name('event.mass_destroy');
    
    
    //tags
      Route::resource('permissions', 'Admin\PermissionsController');
    Route::delete('permissions_mass_destroy', 'Admin\PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', 'Admin\RolesController');
    Route::delete('roles_mass_destroy', 'Admin\RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', 'Admin\UsersController');
    Route::delete('users_mass_destroy', 'Admin\UsersController@massDestroy')->name('users.mass_destroy');
});
