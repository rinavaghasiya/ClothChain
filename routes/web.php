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

Route::get('/', function () {
    return view('welcome');

});

Route::get('/adminlogin','Admin\AdminLoginController@index');
Route::post('/admin_login','Admin\AdminLoginController@adminlogin');
Route::get('/accountclose','seller\AccountCloseController@index');
Route::get('/close','seller\AccountCloseController@close');
Route::get('/','HomeController@index');
Route::get('/login','seller\LoginController@index');
Route::get('/logindata','seller\LoginController@login');
Route::get('/buyerlogin','buyer\BuyerLoginController@index');
Route::get('/buyerlogindata','buyer\BuyerLoginController@login');

Route::get('/main','seller\LoginController@mainpage');

Route::group(['middleware'=>'admin'],function()
{
	//Route::get('/adminmain','Admin\AdminMainController@index');
	Route::get('/dashboard','Admin\AdminLoginController@dashboard');
	Route::get('/adminprofile','Admin\AdminProfileController@index');
	Route::post('/profileupdate','Admin\AdminProfileController@profileupdate');
	Route::get('/admininsertcategory','Admin\AdminCategoryController@index');
	Route::get('/adminshowcategory','Admin\AdminCategoryController@index1');
	Route::post('/admininsert','Admin\AdminCategoryController@admininsert');
	Route::get('/adminupdate/{id}','Admin\AdminCategoryController@update');
	Route::post('/adminedit','Admin\AdminCategoryController@adminedit');
	Route::get('/admindelete/{id}','Admin\AdminCategoryController@admindelete');
	Route::get('/changestatus/{id}', 'Admin\AdminCategoryController@changestatus');
	Route::get('/adminshowpost','Admin\AdminCategoryController@showads');
	Route::get('/changestatusads/{id}', 'Admin\AdminCategoryController@changestatusads');
	Route::get('/changestatusadsdec/{id}', 'Admin\AdminCategoryController@changestatusadsdec');
	Route::get('/showdata/{imageid}', 'Admin\AdminCategoryController@showdata');
	Route::get('/adminlogout','Admin\AdminLoginController@adminlogout');\
	Route::get('/adminshowseller','Admin\AdminCategoryController@showseller');
	Route::get('/sellerchangestatus/{id}', 'Admin\AdminCategoryController@sellerchangestatus');
	Route::get('/adminshowbuyer','Admin\AdminCategoryController@showbuyer');
	Route::get('/buyerchangestatus/{id}', 'Admin\AdminCategoryController@buyerchangestatus');

	Route::get('adminshowsellermessage/{id}', 'Admin\AdminCategoryController@adminshowsellermessage');
	Route::get('adminsellermessagedetail/{id}/{rid}', 'Admin\AdminCategoryController@adminsellermessagedetail');
	Route::get('adminshowbuyermessage/{id}', 'Admin\AdminCategoryController@adminshowbuyermessage');
	Route::get('adminbuyermessagedetail/{id}/{sid}', 'Admin\AdminCategoryController@adminbuyermessagedetail');
	
});

Route::post('/edit','buyer\AccountHomeController@edit');
Route::post('/editpass','buyer\AccountHomeController@editpass');
Route::get('/buyerforgotpassword','buyer\BuyerForgotPasswordController@index');
Route::post('/buyerresendmail','buyer\BuyerForgotPasswordController@buyerresendmail');
Route::get('/buyerresetpass/{token}','buyer\BuyerForgotPasswordController@buyerresetpass');
Route::post('/buyerreset','buyer\BuyerForgotPasswordController@buyerresetpass1');

Route::group(['middleware'=>'buyer'],function()
{

	Route::get('/accountmessagebinbox','buyer\BuyerAccountMessageInboxController@index');
	Route::get('/accountmessagebcompose/{imageid}','buyer\BuyerAccountMessageInboxController@index1');

	//Route::get('/accountmessagebuyercompose','buyer\BuyerAccountMessageInboxController@index2');
    Route::get('/accountmessagebdetail/{id}','buyer\BuyerAccountMessageDetailController@index');
	Route::get('/buyermessagedetail/{id}','buyer\BuyerAccountMessageDetailController@onlydetail');

	Route::post('/insertmessage','buyer\BuyerAccountMessageInboxController@insertmessage');
	
	Route::post('/replymessagebuyer','buyer\BuyerAccountMessageDetailController@replymessagebuyer');
	Route::post('/draftmessagebuyer','buyer\BuyerAccountMessageDetailController@draftmessagebuyer');
	Route::get('/draftbuyer/{id}','buyer\BuyerAccountMessageDetailController@draftbuyer');

	Route::get('/accounthome','buyer\AccountHomeController@index');
	Route::get('/logout','buyer\BuyerLoginController@logout');
	Route::get('/buyerdelete/{id}','buyer\BuyerAccountMessageInboxController@buyerdelete');

	Route::get('/buyerfavourite','buyer\BuyerAccountMessageInboxController@buyerfavourite');
	Route::get('/buyerfavouritemail/{id}','buyer\BuyerAccountMessageInboxController@buyerfavouritemail');
	Route::get('/buyerunfavouritemail/{id}','buyer\BuyerAccountMessageInboxController@buyerunfavouritemail');
	Route::get('/buyersendmail','buyer\BuyerAccountMessageInboxController@buyersendmail');

	Route::get('/buyerimportant','buyer\BuyerAccountMessageInboxController@buyerimportant');
	Route::get('/buyerimportantemail/{id}','buyer\BuyerAccountMessageInboxController@buyerimportantemail');
	Route::get('/buyernotimportantemail/{id}','buyer\BuyerAccountMessageInboxController@buyernotimportantemail');

	Route::get('/buyerdraftmessage','buyer\BuyerAccountMessageInboxController@buyerdraftmessage');
		
});


Route::get('/forgotpassword','seller\ForgotPasswordController@index');
Route::post('/resendmail','seller\ForgotPasswordController@resendmail');
Route::get('/resetpass/{token}','seller\ForgotPasswordController@resetpass');
Route::post('/reset','seller\ForgotPasswordController@resetpass1');

Route::get('/signup','seller\SignupController@index');
Route::post('/insert','seller\SignupController@insert');

Route::get('/subcategory/{subcategory}','seller\SubCategoryController@index');
Route::get('/substate/{statenm}','seller\SubCategoryController@stateindex');
Route::get('/men','seller\CategoryController@menindex');
Route::get('/woman','seller\CategoryController@womanindex');
Route::get('/mensubcategory/{mensubcategory}','seller\SubCategoryController@mensubcatindex');
Route::get('/menstate/{menstatenm}','seller\SubCategoryController@menstateindex');
Route::get('/womansubcategory/{womansubcategory}','seller\SubCategoryController@womansubcatindex');
Route::get('/womanstate/{womanstatenm}','seller\SubCategoryController@womanstateindex');
Route::get('/category','seller\CategoryController@index');
Route::get('/adsdetail/{id}','seller\AddProductController@adsdetail');


Route::group(['middleware'=>'seller'],function()
{
	Route::get('/selleraccounthome','seller\SellerAccountHomeController@index');
	Route::post('/selleredit','seller\SellerAccountHomeController@selleredit');
	Route::post('/sellereditpass','seller\SellerAccountHomeController@sellereditpass');

	Route::get('/accountmyads','seller\AccountMyAdsController@index');
	Route::get('/sellerprofile','seller\SellerProfileController@index');
	Route::get('/accountmessageinbox','seller\AccountMessageInboxController@index');
	Route::get('/accountmessagedetail/{id}','seller\AccountMessageDetailController@index');
	Route::get('/viewmessage','seller\AccountMessageInboxController@viewMessage');
	Route::post('/replymessage','seller\AccountMessageDetailController@replymessage');
	Route::get('/pendingapproval','seller\PendingApprovalController@index');
	Route::get('/decline','seller\PendingApprovalController@declineindex');
	Route::get('/sellerlogout','seller\LoginController@sellerlogout');
	Route::get('/addproduct','seller\AddProductController@index');
	Route::post('/addproduct','seller\AddProductController@insert');
	Route::get('/deleteproduct/{id}','seller\PendingApprovalController@deleteproduct');
	Route::get('/updateproduct/{id}','seller\PendingApprovalController@updateproduct');
	Route::post('/editproduct','seller\PendingApprovalController@editproduct');
	Route::get('/deletemyads/{id}','seller\AccountMyAdsController@deletemyads');
	Route::get('/updatemyads/{id}','seller\AccountMyAdsController@updatemyads');
	Route::post('/editmyads','seller\AccountMyAdsController@editmyads');
	Route::get('/notification','seller\PendingApprovalController@notification');
	Route::get('/notificationview','seller\PendingApprovalController@notificationviewdata');
	Route::get('/sellerdelete/{id}','seller\AccountMessageInboxController@sellerdelete');

	Route::get('/favourite','seller\AccountMessageInboxController@favourite');
	Route::get('/favouritemail/{id}','seller\AccountMessageInboxController@favouritemail');
	Route::get('/unfavouritemail/{id}','seller\AccountMessageInboxController@unfavouritemail');
	Route::get('/sendmailseller','seller\AccountMessageInboxController@sendmailseller');
	Route::get('/draftmessage','seller\AccountMessageInboxController@draftmessage');
	Route::get('/sellermessagedetail/{id}','seller\AccountMessageDetailController@sellermessagedetail');
	Route::get('/important','seller\AccountMessageInboxController@important');
	Route::get('/importantemail/{id}','seller\AccountMessageInboxController@importantemail');
	Route::get('/notimportantemail/{id}','seller\AccountMessageInboxController@notimportantemail');
	Route::post('/draftmessageseller','seller\AccountMessageDetailController@draftmessageseller');
	Route::get('/draftseller/{id}','seller\AccountMessageDetailController@draftseller');
	
});
	
Route::get('/aboutus','seller\AboutUsController@index');
Route::get('/contactus','seller\AboutUsController@contact');
Route::post('/insertcontact','seller\AboutUsController@insertcontact');
Route::get('/terms_condition','seller\AboutUsController@terms_condition');
// Route::group(['middleware'=>'main'],function()
// {
	
	
// });