<?php
date_default_timezone_set('Asia/Kolkata');
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
function flash($status,$message)
{
    session()->flash($status,$message);
}

Route::get('/priceLogic', 'Add@priceLogic');

//Get OTP Api
Route::get('/getOtp/{mobile}', 'Api\Student@getOtp');
Route::get('/viewblog/{bolg}', 'Edifygo_class\Edifygo@viewBlog');


/* All ADMIN ROUTES START*/
Route::get('/admin','Login@index');
Route::post('/login','Login@login');
Route::get('/logout','Login@logout');

Route::group(['middleware' => 'adminlogin'],function(){
    Route::get('/dashboard','Dashboard@index');

    
    //country master
    Route::resource('country','CountryMaster');
    Route::post('country/fetch_country_data','CountryMaster@fetch_country_data')->name('country.fetch_country_data');
    Route::post('country/update_country','CountryMaster@update_country');
    Route::post('country/delete_country_data','CountryMaster@delete_country_data')->name('country.delete_country_data');
    Route::post('country/check_country_name','CountryMaster@check_country_name')->name('country.check_country_name');
    Route::post('country/check_country_name_edit','CountryMaster@check_country_name_edit')->name('country.check_country_name_edit');

    //state master
    Route::resource('state','StateMaster');
    Route::post('state/fetch_state_data','StateMaster@fetch_state_data')->name('state.fetch_state_data');
    Route::post('state/update_state','StateMaster@update_state');
    Route::post('state/delete_state_data','StateMaster@delete_state_data')->name('state.delete_state_data');
    Route::post('state/check_state_name','StateMaster@check_state_name')->name('state.check_state_name');
    Route::post('state/check_state_name_edit','StateMaster@check_state_name_edit')->name('state.check_state_name_edit');

    //city master
    Route::resource('city','CityMaster');
    Route::post('city/cityChange','CityMaster@cityChange')->name('city.cityChange');
    Route::post('city/fetch_city_data','CityMaster@fetch_city_data')->name('city.fetch_city_data');
    Route::post('city/fetch_state_data','CityMaster@fetch_state_data')->name('city.fetch_state_data');
    Route::post('city/update_city','CityMaster@update_city');
    Route::post('city/delete_city_data','CityMaster@delete_city_data')->name('city.delete_city_data');
    Route::post('city/check_city_name','CityMaster@check_city_name')->name('city.check_city_name');
    Route::post('city/check_city_name_edit','CityMaster@check_city_name_edit')->name('city.check_city_name_edit');
    Route::post('city/checkPostalcode','CityMaster@checkPostalcode')->name('city.checkPostalcode');
    Route::post('city/checkPosatalcodeEdit','CityMaster@checkPosatalcodeEdit')->name('city.checkPosatalcodeEdit');

    //area master
    Route::get('area','AreaMaster@index');
    Route::post('area.fetch_state','AreaMaster@fetch_state')->name('area.fetch_state');
    Route::post('area.fetch_city','AreaMaster@fetch_city')->name('area.fetch_city');
    Route::post('area.fetch_area','AreaMaster@fetch_area')->name('area.fetch_area');
    Route::post('area.checkAddAreaExists','AreaMaster@checkAddAreaExists')->name('area.checkAddAreaExists');
    Route::post('/add_area','AreaMaster@addArea');
    Route::post('area.getEditArea','AreaMaster@getEditArea')->name('area.getEditArea');
    Route::post('area.checkEditAreaExists','AreaMaster@checkEditAreaExists')->name('area.checkEditAreaExists');
    Route::post('/area/update_area','AreaMaster@updateArea');
    Route::post('area.deleteArea','AreaMaster@deleteArea')->name('area.deleteArea');

    //main category
    Route::get('maincourse','MainCategory@index');
    Route::post('maincategory/fetch_maincategory_data','MainCategory@fetch_maincategory_data')->name('maincategory.fetch_maincategory_data');
    Route::post('maincategory/insert','MainCategory@insert')->name('maincategory.insert');
    Route::post('maincategory/insert/priority','MainCategory@priorityInsert');
    Route::post('maincategory/checkPosition','MainCategory@checkPosition')->name('maincategory.checkPosition');
    Route::post('maincategory/update_maincategory','MainCategory@update_maincategory');
    Route::post('maincategory/delete_maincategory_data','MainCategory@delete_maincategory_data')->name('maincategory.delete_maincategory_data');
    Route::post('maincategory/check_maincategory_name','MainCategory@check_maincategory_name')->name('maincategory.check_maincategory_name');
    Route::post('maincategory/check_maincategory_name_edit','MainCategory@check_maincategory_name_edit')->name('maincategory.check_maincategory_name_edit');
    Route::post('maincategory/change_maincategory_status','MainCategory@change_maincategory_status')->name('maincategory.change_maincategory_status');

    //sub category
    Route::get('subcourse','SubCategory@index');
    Route::post('subcategory/fetch_subcategory_data','SubCategory@fetch_subcategory_data')->name('subcategory.fetch_subcategory_data');
    Route::post('subcategory/insert','SubCategory@insert')->name('subcategory.insert');
    Route::post('subcategory/update_subcategory','SubCategory@update_subcategory');
    Route::post('subcategory/delete_subcategory_data','SubCategory@delete_subcategory_data')->name('subcategory.delete_subcategory_data');
    Route::post('subcategory/check_subcategory_name','SubCategory@check_subcategory_name')->name('subcategory.check_subcategory_name');
    Route::post('subcategory/check_subcategory_name_edit','SubCategory@check_subcategory_name_edit')->name('subcategory.check_subcategory_name_edit');
    Route::post('subcategory/change_subcategory_status','SubCategory@change_subcategory_status')->name('subcategory.change_subcategory_status');

    //child category
    Route::get('childcourse','ChildCategory@index');
    Route::post('childcategory/fetch_childcategory_data','ChildCategory@fetch_childcategory_data')->name('childcategory.fetch_childcategory_data');
    Route::post('childcategory/insert','ChildCategory@insert')->name('childcategory.insert');
    Route::post('childcategory/update_childcategory','ChildCategory@update_childcategory');
    Route::post('childcategory/delete_childcategory_data','ChildCategory@delete_childcategory_data')->name('childcategory.delete_childcategory_data');
    Route::post('childcategory/check_childcategory_name','ChildCategory@check_childcategory_name')->name('childcategory.check_childcategory_name');
    Route::post('childcategory/check_childcategory_name_edit','ChildCategory@check_childcategory_name_edit')->name('childcategory.check_childcategory_name_edit');
    Route::post('childcategory/change_childcategory_status','ChildCategory@change_childcategory_status')->name('childcategory.change_childcategory_status');
    Route::post('childcategory/fetch_sub_data','ChildCategory@fetch_sub_data')->name('childcategory.fetch_sub_data');


    //fee structure
    Route::get('/fee','Fees@index');
    Route::post('fee.checkAddExistFee','Fees@checkAddExistFee')->name('fee.checkAddExistFee');
    Route::post('/add_fee','Fees@addFee');
    Route::post('fee.checkEditExistFee','Fees@checkEditExistFee')->name('fee.checkEditExistFee');
    Route::post('fee.getEditFee','Fees@getEditFee')->name('fee.getEditFee');
    Route::post('/edit_fee','Fees@updateFee');
    Route::post('fee.deleteFee','Fees@deleteFee')->name('fee.deleteFee');

    //Admission Amount
    Route::get('/admission','Admission@index');
    Route::post('admission.checkAddExistAmount','Admission@checkAddExistAmount')->name('admission.checkAddExistAmount');
    Route::post('/add_amount','Admission@addAmount');
    Route::post('admission.checkEditExistAmount','Admission@checkEditExistAmount')->name('admission.checkEditExistAmount');
    Route::post('admission.editAmount','Admission@getEditAmount')->name('admission.editAmount');
    Route::post('/update_amount','Admission@updateAmount');
    Route::post('admission.deleteAmount','Admission@deleteAmount')->name('admission.deleteAmount');

    //General Settings
    Route::get('/setting','GeneralSetting@index');
    Route::post('/add_value','GeneralSetting@addValue');
    Route::post('setting.editValue','GeneralSetting@EditValue')->name('setting.editValue');
    Route::post('/update_value','GeneralSetting@updateValue');
    Route::post('setting.deleteValue','GeneralSetting@deleteValue')->name('setting.deleteValue');

    //know-us
    Route::get('/know-us','KnowUs@index');
    Route::post('/add_know-us','KnowUs@addKnow');
    Route::post('know.checkAddTitle','KnowUs@checkAddTitle')->name('know.checkAddTitle');
    Route::post('know.deleteKnow','KnowUs@deleteKnow')->name('know.deleteKnow');
    Route::post('know.isActive','KnowUs@isActive')->name('know.isActive');
    Route::post('know.editKnow','KnowUs@editKnow')->name('know.editKnow');
    Route::post('/update_know-us','KnowUs@updateKnow');
    Route::post('know.checkEditTitle','KnowUs@checkEditTitle')->name('know.checkEditTitle');

    //Coupon
    Route::get('/coupon','Coupon@index');
    Route::post('coupon.checkExists','Coupon@checkExists')->name('coupon.checkExists');
    Route::post('/add_coupon','Coupon@addCoupon');
    Route::post('coupon.isActive','Coupon@isActive')->name('coupon.isActive');
    Route::post('coupon.deleteCoupon','Coupon@deleteCoupon')->name('coupon.deleteCoupon');
    Route::post('coupon.editCoupon','Coupon@editCoupon')->name('coupon.editCoupon');
    Route::post('/update_coupon','Coupon@updateCoupon');

    //class
    Route::get('/classes','Classes@index')->name('classes.index');
    Route::post('admin.isApproveClass','Classes@isApproveClass')->name('admin.isApproveClass');
    Route::post('admin.isSubscribe','Classes@isSubscribe')->name('admin.isSubscribe');
    Route::get('/ad_view_class/{id}','Classes@viewClass');
    Route::post('admin.isPopular','Classes@isPopular')->name('admin.isPopular');
    Route::post('admin.deleteClass','Classes@deleteClass')->name('admin.deleteClass');
    Route::post('admin.getEditClass','Classes@getEditClass')->name('admin.getEditClass');
    Route::post('admin.checkEditMobileExists','Classes@checkEditMobileExists')->name('admin.checkEditMobileExists');
    Route::post('admin.checkEditEmailExists','Classes@checkEditEmailExists')->name('admin.checkEditEmailExists');
    Route::post('/update_Adminclass','Classes@updateAdminclass');
    Route::get('/admin_edit_class/{id}','Classes@EditClass');
    Route::post('profile.updateclassImageAdmin','Edifygo_class\Edifygo@updateclassImage')->name('profile.updateclassImageAdmin');
    Route::post('class.deleteTubeAdmin','Classes@deleteTube')->name('class.deleteTubeAdmin');
    Route::post('profile.delete_ranker_imageAdmin','Edifygo_class\Edifygo@deleteRankerImage')->name('profile.delete_ranker_imageAdmin');
    Route::post('profile.updaterankerImageAdmin','Edifygo_class\Edifygo@updaterankerImage')->name('profile.updaterankerImageAdmin');
    Route::post('class.deletePdfAdmin','Classes@deletePdf')->name('class.deletePdfAdmin');
    Route::post('/update_profileAdmin','Edifygo_class\Edifygo@updateProfile');
     Route::post('profile.delete_class_imageAdmin','Edifygo_class\Edifygo@deleteClassImage')->name('profile.delete_class_imageAdmin');

        //Class Custom New Fees 
        Route::post('admin.getFeesDetails','Classes@getFeesDetails')->name('admin.getFeesDetails');
        Route::post('admin.addClassFees','Classes@addClassFees')->name('admin.addClassFees');
        Route::post('admin.getClassFees','Classes@getClassFees')->name('admin.getClassFees');
        Route::post('admin.deleteClassFees','Classes@deleteClassFees')->name('admin.deleteClassFees');
        Route::post('admin.editClassFees','Classes@editClassFees')->name('admin.editClassFees');
        Route::post('admin.updateClassFees','Classes@updateClassFees')->name('admin.updateClassFees');

    //slider1
    Route::get('/exclusive_slider','HomeSlider@index');
    Route::post('/home_slider/insert','HomeSlider@insert');
    Route::post('/home_slider/update','HomeSlider@update');
    Route::post('/home_slider/delete_home_slider_data','HomeSlider@delete_home_slider_data')->name('home_slider.delete_home_slider_data');
    Route::post('/home_slider/check_class_name','HomeSlider@check_class_name')->name('home_slider.check_class_name');
    Route::post('/home_slider/check_class_name_edit','HomeSlider@check_class_name_edit')->name('home_slider.check_class_name_edit');
    Route::post('home_slider.fetch_class','HomeSlider@fetch_class')->name('home_slider.fetch_class');
    
    //slider2
    Route::get('/promoter_slider','PromoterSlider@index');
    Route::post('/promoter_slider/insert','PromoterSlider@insert');
    Route::post('/promoter_slider/update','PromoterSlider@update');
    Route::post('/promoter_slider/delete_promoter_slider_data','PromoterSlider@delete_promoter_slider_data')->name('promoter_slider.delete_promoter_slider_data');
    Route::post('/promoter_slider/fetch_class','PromoterSlider@fetch_class')->name('promoter_slider.fetch_class');
    Route::post('/promoter_slider/check_class_name','PromoterSlider@check_class_name')->name('promoter_slider.check_class_name');
    Route::post('/promoter_slider/check_class_name_edit','PromoterSlider@check_class_name_edit')->name('promoter_slider.check_class_name_edit');

    //slider3
    Route::get('/feature_slider','FeatureSlider@index');
    Route::post('/feature_slider/insert','FeatureSlider@insert');
    Route::post('/feature_slider/update','FeatureSlider@update');
    Route::post('/feature_slider/fetch_class','FeatureSlider@fetch_class')->name('feature_slider.fetch_class');
    Route::post('/feature_slider/delete_feature_slider_data','FeatureSlider@delete_feature_slider_data')->name('feature_slider.delete_feature_slider_data');
    Route::post('/feature_slider/check_class_name','FeatureSlider@check_class_name')->name('feature_slider.check_class_name');
    Route::post('/feature_slider/check_class_name_edit','FeatureSlider@check_class_name_edit')->name('feature_slider.check_class_name_edit');

    //slider4
    Route::get('/newly_slider','NewlySlider@index');
    Route::post('/newly_slider/insert','NewlySlider@insert');
    Route::post('/newly_slider/update','NewlySlider@update');
    Route::post('/newly_slider/delete_newly_slider_data','NewlySlider@delete_newly_slider_data')->name('newly_slider.delete_newly_slider_data');
    Route::post('/newly_slider/check_class_name','NewlySlider@check_class_name')->name('newly_slider.check_class_name');
    Route::post('/newly_slider/check_class_name_edit','NewlySlider@check_class_name_edit')->name('newly_slider.check_class_name_edit');

    //slider5
    Route::get('/sponsored_slider','SponsoredSlider@index');
    Route::post('/sponsored_slider/insert','SponsoredSlider@insert');
    Route::post('/sponsored_slider/update','SponsoredSlider@update');
    Route::post('/sponsored_slider/delete_sponsored_slider_data','SponsoredSlider@delete_sponsored_slider_data')->name('sponsored_slider.delete_sponsored_slider_data');
    Route::post('/sponsored_slider/fetch_class','SponsoredSlider@fetch_class')->name('sponsored_slider.fetch_class');
    Route::post('/sponsored_slider/check_class_name','SponsoredSlider@check_class_name')->name('sponsored_slider.check_class_name');
    Route::post('/sponsored_slider/check_class_name_edit','SponsoredSlider@check_class_name_edit')->name('sponsored_slider.check_class_name_edit');
    Route::post('/sponsored_slider/fetch_main_course','SponsoredSlider@fetch_main_course')->name('sponsored_slider.fetch_main_course');
    Route::post('/sponsored_slider/fetch_sub_course','SponsoredSlider@fetch_sub_course')->name('sponsored_slider.fetch_sub_course');
    Route::post('/sponsored_slider/fetch_child_course','SponsoredSlider@fetch_child_course')->name('sponsored_slider.fetch_child_course');
    Route::post('/sponsored_slider/fetch_course_id','SponsoredSlider@fetch_course_id')->name('sponsored_slider.fetch_course_id');
    Route::post('/sponsored_slider/change_sponsored_status','SponsoredSlider@change_sponsored_status')->name('sponsored_slider.change_sponsored_status');

    
    Route::post('slider.isViewSlider','HomeSlider@isViewSlider')->name('slider.isViewSlider');


    //promocode
    Route::get('/promocode','Promocode@index');
    Route::post('/promocode/insert','Promocode@insert');
    Route::post('/promocode/update','Promocode@update');
    Route::post('/promocode/delete_promocode_slider_data','Promocode@delete_promocode_slider_data')->name('promocode.delete_promocode_slider_data');

    //category slider
    Route::get('/category_slider','CategorySlider@index');
    Route::post('/category_slider/insert','CategorySlider@insert');
    Route::post('/category_slider/update','CategorySlider@update');
    Route::post('/category_slider/delete_category_slider_data','CategorySlider@delete_category_slider_data')->name('category_slider.delete_category_slider_data');

        //course list
    Route::get('/courselist','Course@index');
    Route::post('/course/isApprovecourse','Course@isApprovecourse')->name('course.isApprovecourse');
    Route::post('/course/deleteCourse','Course@deleteCourse')->name('admin.deleteCourse');
    Route::post('/course/fetch_course_details','Course@fetch_course_details')->name('course.fetch_course_details');
    Route::get('/course/courseview/{id}','Course@courseView');
    Route::post('admin.getEnroll','Course@getEnroll')->name('admin.getEnroll');

        //filter routes
         Route::post('admin.getFilterSubcourse_courselist','Course@getFilterSubcourse_courselist')->name('admin.getFilterSubcourse_courselist');
         Route::post('admin.getchildCourse_courselist','Course@getchildCourse_courselist')->name('admin.getchildCourse_courselist');
         Route::post('admin.getFilterArea_courselist','Course@getFilterArea_courselist')->name('admin.getFilterArea_courselist');
         Route::post('/filter_courselist','Course@filterCourseList');

    //enroll list
    Route::get('/enrollcourse','Student@getEnrollList');
    Route::post('admin.getFilterSubcourse','Student@getFilterSubcourse')->name('admin.getFilterSubcourse');
    Route::post('admin.getchildCourse','Student@getchildCourse')->name('admin.getchildCourse');
    //location filter
    Route::post('admin.getFilterArea','Student@getFilterArea')->name('admin.getFilterArea');
    Route::post('/filter_enroll','Student@filterEnrollList');

    //student list
    Route::get('/studentlist','Student@getStudentList');

    //Review list admin side
    Route::get('/reviews','Dashboard@review');
    Route::post('reviews/isapprove','Dashboard@isapprove')->name('reviews.isapprove');

    //Advertise

    Route::get('/admin/add','Add@listAdd');
    Route::post('admin.isApproveRequest','Add@isApproveRequest')->name('admin.isApproveRequest');

    //testimonial
    Route::get('/testimonials','Testimonial@index');
    Route::post('/testimonial/insert','Testimonial@insert')->name('testimonial.insert');
    Route::post('/testimonial/isActive','Testimonial@isActive')->name('testimonial.isActive');
    Route::post('/testimonial/isDelete','Testimonial@isDelete')->name('testimonial.isDelete');
    Route::post('/testimonial/editTesti','Testimonial@editTesti')->name('testimonial.editTesti');
    Route::post('/testimonial/update','Testimonial@update')->name('testimonial.update');

    //blog
    Route::get('/bl','Blog@index');
    Route::post('/blog/insert','Blog@insert')->name('blog.insert');
    Route::post('/blog/isActive','Blog@isActive')->name('blog.isActive');
    Route::post('/blog/isDelete','Blog@isDelete')->name('blog.isDelete');
    Route::post('/blog/editTesti','Blog@editTesti')->name('blog.editTesti');
    Route::post('/blog/update','Blog@update')->name('blog.update');
    

    //contact us
    Route::get('/contactus','Dashboard@contactus');

    
});

/* All ADMIN ROUTES END*/

/*==============================================================================================================================*/
/* All CLASS ROUTES START*/
    Route::get('/','Edifygo_class\Edifygo@index');
    Route::post('/search-classes/{maincourse?}/{maincourse_id?}/{subcourse?}/{subcourse_id?}','Edifygo_class\Edifygo@searchClass')->name('search-classes');
    Route::get('/search-classes/{maincourse?}/{maincourse_id?}/{subcourse?}/{subcourse_id?}','Edifygo_class\Edifygo@searchClass');
    Route::post('/edifygo_class/change_session','Edifygo_class\Edifygo@change_session')->name('edifygo_class.change_session');
    Route::post('class.getFilterSubcourse','Edifygo_class\ECourse@getFilterSubcourse')->name('class.getFilterSubcourse');
    Route::post('class.getFilterchildcourse','Edifygo_class\ECourse@getFilterchildcourse')->name('class.getFilterchildcourse');
    Route::get('/class/registration','Edifygo_class\Edifygo@registration');
    Route::post('class.fetch_state','AreaMaster@fetch_state')->name('class.fetch_state');
    Route::post('class.fetch_city','AreaMaster@fetch_city')->name('class.fetch_city');
    Route::post('class.fetch_area','AreaMaster@fetch_area')->name('class.fetch_area');
    Route::post('/class/add_registration','Edifygo_class\Edifygo@addRegistration');
    Route::post('cl.checkAddClassExists','Edifygo_class\Edifygo@checkAddClassExists')->name('cl.checkAddClassExists');
    Route::post('cl.checkAddEmailExists','Edifygo_class\Edifygo@checkAddEmailExists')->name('cl.checkAddEmailExists');
    Route::post('cl.checkAddMobileExists','Edifygo_class\Edifygo@checkAddMobileExists')->name('cl.checkAddMobileExists');
    Route::post('cl.checkEditMobileExists','Edifygo_class\Edifygo@checkEditMobileExists')->name('cl.checkEditMobileExists');

    Route::post('/class/verifyOtp','Edifygo_class\Edifygo@verifyOtp');
    Route::post('class.resendOtp','Edifygo_class\Edifygo@resendOtp')->name('class.resendOtp');
    Route::get('/class/otp','Edifygo_class\Edifygo@otp');

    //login
    Route::get('/class/login','Edifygo_class\Login@index');
    Route::post('/class/check_login','Edifygo_class\Login@checkLogin');
    Route::get('/viewcourse/{id}/{classname?}','Edifygo_class\ECourse@viewCourse');
    Route::post('/viewcourse/{id}/{classname?}','Edifygo_class\ECourse@viewCourse');
    Route::post('search.setCourseSession','Edifygo_class\ECourse@setCourseSession')->name('search.setCourseSession');

    //forgot password
    Route::get('/forgot','Edifygo_class\Login@forgotPasswd');
    Route::get('stud/forgot','Edifygo_class\Login@forgotPasswdStud');
    Route::post('/forgotlink','Edifygo_class\Login@forgotLink');
    Route::post('stud/forgotlink','Edifygo_class\Login@forgotLink');
    Route::get('class/changepassword/{id}','Edifygo_class\Login@changePassword');
    Route::get('student/changepassword/{id}','Edifygo_class\Login@changePasswordStudent');
    Route::post('/updatepassword','Edifygo_class\Login@updatePassword');

    //terms
    Route::get('/class-terms','Edifygo_class\Edifygo@terms');

    //contact-us forms
    Route::post('/contact-us','Edifygo_class\Edifygo@contactUs');

    Route::group(['middleware' => 'classlogin'],function(){

        //profile
        Route::get('/view_profile','Edifygo_class\Edifygo@viewProfile');
        Route::get('/class/profile','Edifygo_class\Edifygo@profile');
        Route::get('/edit_profile','Edifygo_class\Edifygo@edit_profile');
        Route::get('/change_password','Edifygo_class\Edifygo@changePassword');
        Route::post('/update_password','Edifygo_class\Edifygo@updatePassword');
        Route::post('cl.checkEditClassExists','Edifygo_class\Edifygo@checkEditClassExists')->name('cl.checkEditClassExists');
        Route::post('/update_profile','Edifygo_class\Edifygo@updateProfile');
        Route::post('profile.delete_class_image','Edifygo_class\Edifygo@deleteClassImage')->name('profile.delete_class_image');
        Route::post('profile.updateclassImage','Edifygo_class\Edifygo@updateclassImage')->name('profile.updateclassImage');
        Route::post('profile.delete_ranker_image','Edifygo_class\Edifygo@deleteRankerImage')->name('profile.delete_ranker_image');
        Route::post('profile.updaterankerImage','Edifygo_class\Edifygo@updaterankerImage')->name('profile.updaterankerImage');
        Route::post('class.deletePdf','Classes@deletePdf')->name('class.deletePdf');
        Route::post('class.deleteTube','Classes@deleteTube')->name('class.deleteTube');




        //subscription payment
        Route::get('/payment','Edifygo_class\Edifygo@payment');
        Route::post('/subscribe','Edifygo_class\Edifygo@subscribe');
        //paytm
        Route::post('/paytm-callback-cl', 'Edifygo_class\Paytm@paytmCallback');
        // Route::post('/pay-now', 'Edifygo@payNow');

        //dashboard
        Route::get('/class/dashboard','Edifygo_class\Dashboard@index');
        Route::get('/class_logout','Edifygo_class\Dashboard@logout');

        //create course
        Route::get('/create_course','Edifygo_class\ECourse@index')->name('course.create_course');
        Route::post('course.checkAddCourseExists','Edifygo_class\ECourse@checkAddCourseExists')->name('course.checkAddCourseExists');
        Route::post('course.checkeditCourseExists','Edifygo_class\ECourse@checkeditCourseExists')->name('course.checkeditCourseExists');
        Route::post('class.getSubcourse','Edifygo_class\ECourse@getSubcourse')->name('class.getSubcourse');
        Route::post('class.getchildCourse','Edifygo_class\ECourse@getchildCourse')->name('class.getchildCourse');
        Route::post('course.getOwnerCharge','Edifygo_class\ECourse@getOwnerCharge')->name('course.getOwnerCharge');
        Route::post('course.getFeeSelectionAuto','Edifygo_class\ECourse@getFeeSelectionAuto')->name('course.getFeeSelectionAuto');
        Route::post('/add_course','Edifygo_class\ECourse@addCourse');
        Route::post('course.deletePdf','Edifygo_class\ECourse@deletePdf')->name('course.deletePdf');
        Route::post('course.deleteTube','Edifygo_class\ECourse@deleteTube')->name('course.deleteTube');
        Route::post('course.deletetime','Edifygo_class\ECourse@deletetime')->name('course.deletetime');
        Route::post('course.updatecourseImage','Edifygo_class\ECourse@updatecourseImage')->name('course.updatecourseImage');
        Route::post('/update_course','Edifygo_class\ECourse@update_course');
        Route::post('class.getEnroll','Edifygo_class\ECourse@getEnroll')->name('class.getEnroll');
        Route::post('class.getReview','Edifygo_class\ECourse@getReview')->name('class.getReview');

        //course validation
        Route::post('course.checkExistsCourse','Edifygo_class\ECourse@checkExistsCourse')->name('course.checkExistsCourse');

        //Cource Time
        Route::post('cource.checkcourceTime','Edifygo_class\ECourse@checkcourceTime')->name('cource.checkcourceTime');
        Route::post('cource.submitTime','Edifygo_class\ECourse@submitTime')->name('cource.submitTime');
        Route::get('listcourse/{id}','Edifygo_class\ECourse@listCourse');
        Route::get('/editcourse','Edifygo_class\ECourse@editCourse');
        Route::post('course.deleteCourse','Edifygo_class\ECourse@deleteCourse')->name('course.deleteCourse');
        Route::post('course.isAvailableSeat','Edifygo_class\ECourse@isAvailableSeat')->name('course.isAvailableSeat');
        Route::get('/editcourse/{id}','Edifygo_class\ECourse@editViewCourse');


        Route::get('/create_class1','Edifygo_class\EClass@createClass1');
        Route::get('/create_class2','Edifygo_class\EClass@createClass2');

        //FAQ
        Route::get('/faq','Edifygo_class\Faq@index');
        Route::post('/faq/addfaq','Edifygo_class\Faq@addfaq');
        Route::post('/faq/editfaq','Edifygo_class\Faq@editfaq');
        Route::post('/faq/deletefaq','Edifygo_class\Faq@deletefaq')->name('faq.deletefaq');
        Route::post('/faq/fetch_faq_data','Edifygo_class\Faq@fetch_faq_data')->name('faq.fetch_faq_data');

        //filter-class
        // Route::get('/filterclass','Edifygo_class\EClass@filterClass');

        //Advertise
        Route::get('/add','Add@index');
        Route::post('/add/addadvertise','Add@addadvertise');
        Route::post('add.deleteRequest','Add@deleteRequest')->name('add.deleteRequest');
        Route::post('add.getMainCourse','Add@getMainCourse')->name('add.getMainCourse');
        Route::post('add.getSubCourse','Add@getSubCourse')->name('add.getSubCourse');
        Route::post('add.getChildCourse','Add@getChildCourse')->name('add.getChildCourse');
        /*Route::post('/sponsored_slider/fetch_sub_course','SponsoredSlider@fetch_sub_course')->name('sponsored_slider.fetch_sub_course');
        Route::post('/sponsored_slider/fetch_child_course','SponsoredSlider@fetch_child_course')->name('sponsored_slider.fetch_child_course');
        Route::post('/sponsored_slider/fetch_course_id','SponsoredSlider@fetch_course_id')->name('sponsored_slider.fetch_course_id');*/

    });



/* All CLASS ROUTES END*/

/* All STUDENT ROUTES START*/
Route::get('/student/login','Student@index');
Route::post('/student/check_login','Student@checkLogin');

Route::get('/student/registration','Student@registration');
Route::post('stud.checkAddEmailExists','Student@checkAddEmailExists')->name('stud.checkAddEmailExists');
Route::post('stud.checkAddMobileExists','Student@checkAddMobileExists')->name('stud.checkAddMobileExists');
Route::post('stud.checkEditMobileExists','Student@checkEditMobileExists')->name('stud.checkEditMobileExists');
Route::post('/student/add_registration','Student@addRegistration');
Route::get('/student/otp','Student@otp');
Route::post('/student/verifyOtp','Student@verifyOtp');
Route::post('stud.resendOtp','Student@resendOtp')->name('stud.resendOtp');

Route::post('student.enrollbeforlogin','Student@enrollbeforLogin')->name('student.enrollbeforlogin');

//terms
Route::get('/student-terms','Student@terms');

//other links
Route::get('/about','Student@about');
Route::get('/contact','Student@contact');
Route::get('/privacy','Student@privacy');
Route::get('/refund','Student@refund');
Route::get('/faq','Student@faq');

Route::group(['middleware' => 'studentlogin'],function(){
    Route::get('/student/profile','Student@profile');
    Route::get('/student/edit_profile','Student@edit_profile');
    Route::post('/student/update_profile','Student@updateProfile');
    Route::get('/student/change_password','Student@changePassword');
    Route::post('/student/update_password','Student@updatePassword');
    Route::get('/student/logout','Student@logout');
    Route::post('/student/enroll','Student@enroll');
    Route::post('/student/finalenroll','Student@finalenroll');

    //befor payment orderdetails
    Route::get('/student/orderdetails','Student@orderdetails');

    //paytm
    Route::post('/paytm-callback-enroll', 'Student@paytmCallbackEnroll');

    //enroll
    Route::get('/student/enrolllist','Student@enrolllist');

    //Review and Rating 
    Route::post('/rating','Student@addRating');
});

// 9723702893
/* All STUDENT ROUTES END*/