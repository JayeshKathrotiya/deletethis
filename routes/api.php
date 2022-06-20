<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//GET API
Route::get('/getLocation', 'Api\Student@getLocation');


Route::get('/getBlog', 'Api\Student@getBlog');

Route::get('/getCoupons', 'Api\Student@getCoupons');

Route::get('/getAdmissionFess', 'Api\Student@getAdmissionFess');

Route::get('/getAllMainCategories', 'Api\Student@getAllMainCategories');




/*
{
    "url": http://192.168.2.173:8888/api/knowUs,
    "title": "Know US API",
    "method": "GET",
    "parameter": []
    "Header": [API_KEY]
}
*/
Route::get('/knowUs', 'Api\Student@knowUs');

/*
{
    "url": http://192.168.2.173:8888/api/getCity,
    "title": "Get City API",
    "method": "GET",
    "parameter": []
    "Header": [API_KEY]
}
*/
Route::get('/getCity', 'Api\Student@getCity');

//==================================================================================================

//POST API
Route::post('/registration', 'Api\Student@addStudent');
Route::post('/resendotp', 'Api\Student@resendOTP');
Route::post('/verifyotp', 'Api\Student@verifyOTP');
/*
{
    "url": http://192.168.2.173:8888/api/login,
    "title": "Login API",
    "method": "POST",
    "parameter": [username,password]
    "Header": [API_KEY]
}
*/
Route::post('/login', 'Api\Student@login');

/*
{
    "url": http://192.168.2.173:8888/api/home,
    "title": "Home Page API",
    "method": "POST",
    "parameter": [postal_code]
    "Header": [API_KEY]
}
*/
Route::post('/home', 'Api\Student@home');

/*
{
    "url": http://192.168.2.173:8888/api/getSubcategories,
    "title": "Get subcategories API",
    "method": "POST",
    "parameter": [category_id]
    "Header": [API_KEY]
}
*/
Route::post('/getSubcategories', 'Api\Student@getSubcategories');

/*
{
    "url": http://192.168.2.173:8888/api/getChildcategories,
    "title": "Get subcategories API",
    "method": "POST",
    "parameter": [sub_category_id]
    "Header": [API_KEY]
}
*/
Route::post('/getChildcategories', 'Api\Student@getChildcategories');

/*
{
    "url": http://192.168.2.173:8888/api/getAreaByCity,
    "title": "Get subcategories API",
    "method": "POST",
    "parameter": [city_id]
    "Header": [API_KEY]
}
*/
Route::post('/getAreaByCity', 'Api\Student@getAreaByCity');

/*
{
    "url": http://192.168.2.173:8888/api/viewCourse,
    "title": "Get subcategories API",
    "method": "POST",
    "parameter": [class_id]
    "Header": [API_KEY]
}
*/
Route::post('/viewCourse', 'Api\Student@viewCourse');

/*
{
    "url": http://192.168.2.173:8888/api/getEnroll,
    "title": "Get enroll API",
    "method": "POST",
    "parameter": [student_id]
    "Header": [API_KEY]
}
*/
Route::post('/getEnroll', 'Api\Student@getEnroll');

/*
{
    "url": http://192.168.2.173:8888/api/addReview,
    "title": "Add Review API",
    "method": "POST",
    "parameter": [enroll_id,student_id]
    "Header": [API_KEY]
}
*/
Route::post('/addReview', 'Api\Student@addReview');

/*
{
    "url": http://192.168.2.173:8888/api/filterClass,
    "title": "Get filter Class API",
    "method": "POST",
    "parameter": [city_id,sortby{1:"High To Low",2:"Low To High",3:"Popular",4:"Exclusive"},maincourse_id,area,fees,trial_course,subcourse_id,childcourse_id],
    "Header": [API_KEY],
    "Pagination":20
}
*/
Route::post('/filterClass', 'Api\Student@filterClass');

/*
{
    "url": http://192.168.2.173:8888/api/editProfile,
    "title": "Get filter Class API",
    "method": "POST",
    "parameter": [student_id,firstname,lastname,schoolname],
    "Header": [API_KEY],
    "Pagination":20
}
*/
Route::post('/editProfile', 'Api\Student@editProfile');

/*
{
    "url": http://192.168.2.173:8888/api/getProfile,
    "title": "Get Profile API",
    "method": "POST",
    "parameter": [student_id],
    "Header": [API_KEY],
    "Pagination":20
}
*/
Route::post('/getProfile', 'Api\Student@getProfile');

//Paytm Generate checksum API
/*
{
    "url": http://192.168.2.173:8888/api/generateChecksum,
    "title": "Get Profile API",
    "method": "POST",
    "parameter": [],
    "Header": [API_KEY],
    "Pagination":20
}
*/
Route::post('/generateChecksum', 'Api\generateChecksum@generate');

//PaytmResponse Response API
/*
{
    "url": http://192.168.2.173:8888/api/PaytmResponse,
    "title": "Get Profile API",
    "method": "POST",
    "parameter": [],
    "Header": [API_KEY],
    "Pagination":20
}
*/
Route::post('/PaytmResponse', 'Api\Student@PaytmResponse');

//Related search API
/*
{
    "url": http://192.168.2.173:8888/api/relatedSearch,
    "title": "Related Search API",
    "method": "POST",
    "parameter": [class_id,city_id,area_id,cat_id,subcat_id,childcat_id],
    "Header": [API_KEY],
    "Pagination":maximum 5 records
}
*/
Route::post('/relatedSearch', 'Api\Student@relatedSearch');


/*
{
    "url": http://192.168.2.173:8888/api/getClassMainCategory,
    "title": "Get Category API",
    "method": "POST",
    "parameter": [class_id]
    "Header": [API_KEY]
}
*/
Route::post('/getClassMainCategory', 'Api\Student@getClassMainCategory');

/*
{
    "url": http://192.168.2.173:8888/api/forgotPassword,
    "title": "Forgot Password(Send Mail) API",
    "method": "POST",
    "parameter": [email]
    "Header": [API_KEY]
}
*/
Route::post('/forgotPassword', 'Api\Student@forgotPassword');