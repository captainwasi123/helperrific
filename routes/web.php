<?php

use Illuminate\Support\Facades\Route;

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


// Web Routes
<<<<<<< HEAD
	
	Route::middleware('siteMaintenn')->group(function(){

		// Main Pages
			Route::get('/', 'webController@index');
			Route::get('/helpers', 'webController@helpers');
			Route::get('/helpers/{cat}', 'webController@helpersCat');
			Route::get('/helpers/detail/{id}/{name}', 'webController@helperDetail');
			Route::get('/agencies', 'webController@agencies');
			Route::get('/agencies/detail/{id}/{name}', 'webController@agencyDetail');

			Route::get('/employer/detail/{id}/{name}', 'webController@employerDetail');
=======
	//maintenance
	Route::get('/maintenance','maintenanceController@index')->name('maintenance');

	// Main Pages
		Route::get('/', 'webController@index');
		Route::get('/helpers', 'webController@helpers');
		Route::get('/helpers/{cat}', 'webController@helpersCat');
		Route::get('/helpers/detail/{id}/{name}', 'webController@helperDetail');
		Route::get('/agencies', 'webController@agencies');
		Route::get('/agencies/detail/{id}/{name}', 'webController@agencyDetail');
		Route::get('/employers', 'webController@employers');
		
		Route::get('/employer/detail/{id}/{name}', 'webController@employerDetail');
>>>>>>> 7362012579add8637f368b2fd6967a56779dffcb

			Route::get('/searchResult', 'webController@searchResult');

<<<<<<< HEAD
			Route::post('/enquiry', 'webController@sendEnquiry');
			Route::post('/helpers', 'webController@helperSearch');
			Route::post('/agencies', 'webController@agencySearch');
=======
		Route::post('/enquiry', 'webController@sendEnquiry');
		Route::post('/helpers', 'webController@helperSearch');
		Route::post('/agencies', 'webController@agencySearch');
		Route::post('/employers', 'webController@employersSearch');
		
>>>>>>> 7362012579add8637f368b2fd6967a56779dffcb

			Route::get('/settings', 'webController@settings');
			Route::get('/private/status/{id}', 'webController@privateAccount');
			Route::get('/account/delete', 'webController@deleteAccount')->name('account.delete');
			Route::post('/password/change', 'webController@changePassword')->name('change.password');

			Route::get('/reviewInvitation/send/{id}', 'webController@sendInvitation');
			Route::get('reportReview/{id}', 'webController@reportReview');

		//Premium Account
			Route::prefix('premium')->group(function(){

				Route::get('/getPrice', 'premiumController@getPrice');
				Route::post('/subscribe', 'premiumController@subscribe')->name('premium.subscribe');
			});


		// User Authentication
			Route::post('/register', 'authController@register');
			Route::post('/login', 'authController@login');
			Route::get('/logout', 'authController@logout');

			Route::post('/profilePic/upload', 'authController@profilePic');
			Route::post('/coverPic/upload', 'authController@coverPic');

			Route::get('/favorite/add/{id}', 'authController@addFavorite');
			Route::get('/favorite/remove/{id}', 'authController@removeFavorite');
			Route::get('/saved', 'authController@savedProfile');

			Route::post('/users/type/setup', 'authController@userTypeSetup');

			//Login With Google

				Route::get('auth/google', 'googleController@redirectToGoogle');
				Route::get('auth/google/callback', 'googleController@handleGoogleCallback');

			//Login With Facebook

				Route::get('auth/facebook', 'facebookController@redirectToFacebook');
				Route::get('auth/facebook/callback', 'facebookController@handleFacebookCallback');


		//Messenger

<<<<<<< HEAD
			Route::get('/inbox', 'chatController@index');
			Route::get('/inbox/chat/{id}/{name}', 'chatController@inboxChat');

			Route::post('/inbox/messageSend', 'chatController@sendMessage');
	});
=======
		Route::get('/inbox/chat_delete/{id}', 'chatController@deleteChat');
		Route::get('/inbox/chat_follow_up/{id}/{chat_type}', 'chatController@chat_follow_up');
		Route::get('/inbox/chat_user/{id}', 'chatController@chat_user');
>>>>>>> 7362012579add8637f368b2fd6967a56779dffcb

	Route::get('maintenance', 'webController@maintenance')->name('maintenance');

	//Helper

	Route::prefix('helper')->group(function(){
		Route::get('profile', 'helperController@profile');
		Route::get('availability_status/{status}', 'helperController@changeAvailability');
		Route::get('gallery/image/delete/{id}', 'helperController@deleteImage');

		Route::get('rule_1', 'helperController@rule_1');
		Route::get('rule_2', 'helperController@rule_2');
		Route::get('form_1', 'helperController@form_1');
		Route::get('form_2', 'helperController@form_2');

		Route::post('form_1', 'helperController@form_1Submit');
		Route::post('form_2', 'helperController@form_2Submit');
		Route::post('gallery/upload', 'helperController@galleryUpload');

		Route::get('requests', 'helperController@Orders');

	});

	//Agency

	Route::prefix('agency')->group(function(){
		Route::get('profile', 'agencyController@profile');

		Route::get('rule_1', 'agencyController@rule_1');
		Route::get('rule_2', 'agencyController@rule_2');
		Route::get('form', 'agencyController@form');
		Route::get('join/{id}', 'agencyController@join');
		Route::get('request/accept/{id}', 'agencyController@acceptRequest');
		Route::get('request/reject/{id}', 'agencyController@rejectRequest');
		Route::get('helper/star/{id}', 'agencyController@makeStar');
		Route::get('helper/removeStar/{id}', 'agencyController@removeStar');
		Route::get('helper/terminate/{id}', 'agencyController@terminateHelper');

		Route::post('form', 'agencyController@formSubmit');


		Route::get('requests', 'agencyController@Orders');
	});
		
	//Employer

	Route::prefix('employer')->group(function(){
		Route::get('profile', 'employerController@profile');

		Route::get('rule_1', 'employerController@rule_1');
		Route::get('rule_2', 'employerController@rule_2');
		Route::get('form_1', 'employerController@form_1');
		Route::get('form_2', 'employerController@form_2');

		Route::post('form_1', 'employerController@form_1Submit');
		Route::post('form_2', 'employerController@form_2Submit');


		Route::get('requests', 'employerController@Orders');
	});

	//Orders

	Route::prefix('orders')->group(function(){
		Route::post('book', 'orderController@orderBook');
		Route::get('detail/{id}', 'orderController@orderDetail');
		Route::get('status/{id}/{status}', 'orderController@orderStatus');
		Route::get('review/{id}', 'orderController@orderReview');

		Route::post('messageSend', 'orderController@sendMessage');
		Route::post('review/submit', 'orderController@reviewSubmit');
	});



// Admin Routes

		
	// Authentication

		Route::get('/admin', 'adminController@index');
		Route::get('/admin/login', 'adminController@login');
		Route::get('/admin/logout', 'adminController@logout');

		Route::post('/admin/login', 'adminController@loginAttempt');


	// Admin Users

		Route::get('/admin/users', 'adminController@users');
		Route::get('/admin/users/add', 'adminController@addUsers');
		Route::get('/admin/users/in-active/{id}', 'adminController@inActiveUsers');
		Route::get('/admin/users/edit/{id}', 'adminController@editUsers');
		Route::get('/admin/users/active/{id}', 'adminController@activeUsers');
		Route::get('/admin/users/delete/{id}', 'adminController@deleteUsers');

		Route::post('/admin/users/add', 'adminController@insertUsers');
		Route::post('/admin/users/update', 'adminController@updateUsers');


	// Site Users

		Route::get('/admin/site-user/terminate/{id}', 'siteUserController@terminateUser');
		Route::get('/admin/site-user/suspend/{id}', 'siteUserController@suspendUser');
		Route::get('/admin/site-user/active/{id}', 'siteUserController@activeUser');

		// Employers
			Route::get('/admin/site-user/employers', 'siteUserController@employers');

		// Helpers
			Route::get('/admin/site-user/helpers', 'siteUserController@helpers');

		// Agencies
			Route::get('/admin/site-user/agencies', 'siteUserController@agencies');


	// Chat Logs

		Route::get('/admin/chat-log', 'chatLogController@index');
		Route::get('/admin/chat-log/detail/{sender}/{receiver}', 'chatLogController@logDetails');
		Route::get('/admin/chat-log/filter', 'chatLogController@filterLog');

		Route::post('/admin/chat-log/filter', 'chatLogController@filterLogSubmit');


	// Enquiries

		Route::get('/admin/enquiries', 'enquiryController@index');
		Route::get('/admin/enquiries/pending', 'enquiryController@pendingEnquiries');
		Route::get('/admin/enquiries/detail/{id}', 'enquiryController@enquiryDetail');

		Route::post('/admin/equiries/reply', 'enquiryController@insertReply');


	// Review Reports

		Route::get('/admin/reviewReports', 'reviewReportController@index');
		Route::get('/admin/reviewHide/{id}', 'reviewReportController@hide');
		Route::get('/admin/reviewDelete/{id}', 'reviewReportController@delete');

<<<<<<< HEAD
	//Site Maintenance

		Route::get('/admin/site_maintenance', 'adminController@siteMaintencance');
		Route::get('/admin/site_maintenance/{status}', 'adminController@siteMaintencanceStatus');
=======
	//website Setting 
	Route::get('/admin/websiteSetting', 'websiteSettingControlle@index');
	Route::get('/admin/websiteSetting/update/{id}', 'websiteSettingControlle@udapte');	
>>>>>>> 7362012579add8637f368b2fd6967a56779dffcb
