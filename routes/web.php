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

// TESERTS
// ============================== SITE ROUTES ==================================== //
Route::group(['namespace' => 'Site'], function() {
    
    // SITE LOGIN & Register & Logout
    Route::get('/login', 'SiteLoginController@login')->name('site-login');
    Route::post('/login', 'SiteLoginController@postLogin')->name('site-post-login');

    Route::post('/register', 'SiteLoginController@register')->name('site-register');

    Route::get('/logout', 'SiteLoginController@logout')->name('site-logout');

    Route::get('/shlogin', 'SiteLoginController@sheikhLogin')->name('site-sheikh-login');
    Route::post('/shlogin', 'SiteLoginController@postSheikhLogin')->name('site-post-shikh-login');

    //SiteHome
    Route::get('/', 'HomeController@index')->name('site-main'); 
    Route::get('/suspicions', 'HomeController@index')->name('site-home'); 
    Route::get('/suspicion/{id}', 'HomeController@getSuspicionContent')->name('suspicion-site-content');
    Route::get('/suspicion-comments/{id}', 'HomeController@getSuspicionComments')->name('get-suspicion-comments');
    Route::get('/download-video', 'HomeController@downloadVideo')->name('download-video');

    Route::group(['middleware' => 'auth-site'], function() {
        Route::post('/suspicion-add-comment', 'HomeController@addCommnet')->name('stie-add-comment');
        Route::post('/suspicion-add-reply', 'HomeController@addReply')->name('stie-add-reply');
    });
    Route::post('/add-to-fav/{id}', 'HomeController@addToFavorite')->name('suspicion-add-favorite');
    Route::post('/read-later/{id}', 'HomeController@readLater')->name('suspicion-read-later');

    Route::get('/nosrah-suspicion-content/{id}', 'HomeController@getSuspicionContentShare')->name('stie-suspicion-content');


    // Hot Suspicions 
    Route::get('/hot-suspicions', 'HotSuspicionController@index')->name('site-hot-suspicions');
    Route::get('/hot-suspicion/{id}', 'HotSuspicionController@getSuspicionContent')->name('hot-suspicion-site-content');
    Route::get('/hot-suspicion-comments/{id}', 'HotSuspicionController@getSuspicionComments')->name('get-hot-suspicion-comments');

    Route::group(['middleware' => 'auth-site'], function() {
        Route::post('/hot-suspicion-add-comment', 'HotSuspicionController@addCommnet')->name('stie-add-hot-suspicion-comment');
        Route::post('/hot-suspicion-add-reply', 'HotSuspicionController@addReply')->name('stie-add-hot-suspicion-reply');
    });
    Route::post('/add-to-hot-fav/{id}', 'HotSuspicionController@addToFavorite')->name('suspicion-add-hot-favorite');
    Route::post('/read-hot-later/{id}', 'HotSuspicionController@readLater')->name('suspicion-read-hot-later');

    Route::get('/nosrah-hot-suspicion-content/{id}', 'HotSuspicionController@getSuspicionContentShare')->name('stie-hot-suspicion-content');


    // EVIDENCES 
    Route::get('/evidences', 'EvidenceController@index')->name('site-evidences');
    Route::get('/evidence/{id}', 'EvidenceController@getEvidenceContent')->name('evidence-site-content');
    Route::get('/evidence-comments/{id}', 'EvidenceController@getEvidenceComments')->name('get-evidence-comments');

    Route::group(['middleware' => ['auth-site'  || 'auth-site-sheikh']], function() {
        Route::post('/evidence-add-comment', 'EvidenceController@addCommnet')->name('evidence-add-comment');
        Route::post('/evidence-add-reply', 'EvidenceController@addReply')->name('evidence-add-reply');
    });
    Route::post('/add-fav-evidence/{id}', 'EvidenceController@addToFavorite')->name('favorite-evidence');
    Route::post('/read-evidence-later/{id}', 'EvidenceController@readLater')->name('read-evidence-later');

    Route::get('/nosrah-evidence-content/{id}', 'EvidenceController@getEvidenceContentShare')->name('stie-evidence-content');


    // DISCUSSIONS 
    Route::get('/discussions', 'DiscussionController@index')->name('site-discussions');
    Route::get('/discussion/{id}', 'DiscussionController@getDiscussionContent')->name('discussion-site-content');
    Route::get('/discussion-comments/{id}', 'DiscussionController@getDiscussionComments')->name('get-discussion-comments');

    Route::group(['middleware' => 'auth-site'], function() {
        Route::post('/discussion-add-comment', 'DiscussionController@addCommnet')->name('discussion-add-comment');
        Route::post('/discussion-add-reply', 'DiscussionController@addReply')->name('discussion-add-reply');
    });
    Route::post('/add-fav-discussion/{id}', 'DiscussionController@addToFavorite')->name('favorite-discussion');
    Route::post('/read-discussion-later/{id}', 'DiscussionController@readLater')->name('read-discussion-later');

    Route::get('/nosrah-discussion-content/{id}', 'DiscussionController@getDiscussionContentShare')->name('stie-discussion-content');
    
    // SITE CARDS 
    Route::get('/infograph', 'InfographController@index')->name('site-infographs');

    // FAVORITE SUBJECTS 
    Route::get('/favorites', 'FavoriteController@index')->name('site-favorites');

    // Contact Us 
    Route::get('/contact-us', 'HomeController@contactUs')->name('site-contact');
    Route::post('/contact-us', 'MessageSiteController@sendMessage')->name('site-contact-us');

    // SUPERVISOR ROUTES
    Route::get('/supervisor-word', 'SuperVisorController@suervisorWord')->name('site-supervisor');
    Route::get('/about-supervisor', 'SuperVisorController@suervisorAbout')->name('site-supervisor-about');

    // ABOUT US
    Route::get('/about-us', 'AboutController@getAbout')->name('site-about-us');
    
});


// ============================== ADMIN PANEL ROUTES ==================================== //

// ADMIN AUTHENTICATION ROUTES

Route::get('/admin/login', 'AdminAuthController@index')->name('login');
Route::post('/admin/login', 'AdminAuthController@postLogin')->name('do-login'); // admin@gmail.com == 0-6
Route::get('/admin/logout', 'AdminAuthController@logout');


Route::get('/admin', 'AdminAuthController@getDashBoard')->name('index');
Route::get('/admin/home', 'AdminAuthController@getDashBoard')->name('home');


Route::group(['middleware' => 'auth'], function() {

    // ADMINS CONTROLLER
    Route::get('/admins', 'AdminController@index')->name('admins');
    Route::post('/add-admin', 'AdminController@addAdmin')->name('add-admin');  
    Route::get('/admin-edit-page/{id}', 'AdminController@getAdminEditPage')->name('get-admin-edit-page');
    Route::post('/update-admin/{id}', 'AdminController@updateAdmin')->name('update-admin');
    Route::get('/delete-admin/{id}', 'AdminController@deleteAdmin')->name('delete-admin');

    // SUSPICION CONTROLLER
    Route::get('/add-suspicion', 'SuspicionController@getAddSuspicion')->name('add-suspicion');
    Route::post('/add-suspicion', 'SuspicionController@AddSuspicion')->name('post-add-suspicion');
    Route::get('/suspicion-reply/{id}', 'SuspicionController@getSuspicionReply')->name('suspicion-reply');
    Route::post('/update-suspicion/{id}', 'SuspicionController@updateSuspicion')->name('post-update-suspicion-content'); 
    Route::post('/update-suspicion-title', 'SuspicionController@updateSuspicionTitle')->name('post-update-suspicion-title'); 

    Route::get('/suspicion-content/{id}', 'SuspicionController@getSuspicionContent')->name('suspicion-content');

    Route::get('/all-suspicions', 'SuspicionController@getAllSuspicions')->name('all-suspicions');
    Route::post('/delete-suspicoin', 'SuspicionController@deleteSuspicion')->name('delete-suspicion');
    // Route::get('/child-suspicions/{id}', 'SuspicionController@getChildSuspicions')->name('child-suspicions');

    // HOT SUSPICION CONTROLLER
    Route::get('/add-hot-suspicion', 'HotSuspicionController@getAddSuspicion')->name('add-hot-suspicion');
    Route::post('/add-hot-suspicion', 'HotSuspicionController@AddSuspicion')->name('post-add-hot-suspicion');
    Route::get('/suspicion-hot-reply/{id}', 'HotSuspicionController@getSuspicionReply')->name('suspicion-hot-reply');
    Route::post('/update-hot-suspicion/{id}', 'HotSuspicionController@updateSuspicion')->name('post-update-hot-suspicion-content'); 
    Route::post('/update-hot-suspicion-title', 'HotSuspicionController@updateHotSuspicionTitle')->name('post-update-hot-suspicion-title');

    Route::get('/hot-suspicion-content/{id}', 'HotSuspicionController@getHotSuspicionContent')->name('hot-suspicion-content');

    Route::get('/all-hot-suspicions', 'HotSuspicionController@getAllSuspicions')->name('all-hot-suspicions');
    Route::post('/delete-hot-suspicoin', 'HotSuspicionController@deleteSuspicion')->name('delete-hot-suspicion');

    // ELMARSAD CONTROLLER
    Route::get('/add-marasad', 'MarsadController@getAddMarsad')->name('add-marsad');
    Route::post('/add-marasad', 'MarsadController@AddMarsad')->name('post-add-marsad');
    Route::get('/marsad-reply/{id}', 'MarsadController@getMarsadReply')->name('marsad-reply');
    Route::post('/update-marsad', 'MarsadController@updateMarsad')->name('update-marsad');
    Route::get('/all-marasads', 'MarsadController@getAllMarsads')->name('all-marasads');
    Route::post('/delete-marsad', 'MarsadController@deleteMarsad')->name('delete-marsad');

    // EVIDENCE CONTROLLER
    Route::get('/get-add-evidence', 'EvidenceController@index')->name('get-add-evidence');
    Route::post('/add-evidence', 'EvidenceController@addEvidence')->name('post-add-evidence');
    Route::get('/all-evidence', 'EvidenceController@getAllEvidences')->name('all-evidences');
    Route::get('/evidence-content/{id}', 'EvidenceController@getEvidenceContent')->name('evidence-content');
    Route::post('/update-evidence-content/{id}', 'EvidenceController@updateEvidenceContent')->name('post-update-evidence-content');
    Route::post('/update-evidence-title', 'EvidenceController@updateEvidenceTitle')->name('post-update-evidence-title');
    Route::post('/delete-evidence', 'EvidenceController@deleteEvidence')->name('delete-evidence');

    // MEETS CONTROLLER
    Route::get('/meets', 'MeetController@index')->name('meets');
    Route::post('/add-meet', 'MeetController@addMeet')->name('add-meet');
    Route::post('/alter-meet/{id}', 'MeetController@alterMeet')->name('alter-meet');
    Route::get('/get-update-meet/{id}', 'MeetController@getUpdateMeet')->name('get-update-meet');
    Route::post('/update-meet/{id}', 'MeetController@updateMeet')->name('update-meet');
    Route::get('/delete-meet/{id}', 'MeetController@deleteMeet')->name('delete-meet');

    // INFOGRAPHS CONTROLLER
    Route::get('/infographs', 'InfoGraphController@index')->name('infographs');
    Route::post('/post-infograph', 'InfoGraphController@addInfograph')->name('add-infograph');
    Route::get('/update-infograph/{id}', 'InfoGraphController@getUpdateInfograph')->name('get-update-infograph');
    Route::post('/update-infograph/{id}', 'InfoGraphController@posttUpdateInfograph')->name('post-update-infograph');
    Route::post('/delete-infograph/{id}', 'InfoGraphController@posttDeleteInfograph')->name('post-delete-infograph');

    // DISCUSSIONS CONTROLLER
    Route::get('/get-add-discussion', 'DiscussionsController@index')->name('get-add-discussion');
    Route::post('/add-discussion', 'DiscussionsController@addDiscussion')->name('post-add-discussion');
    Route::get('/all-discussions', 'DiscussionsController@getAllDiscussions')->name('all-discussions');
    Route::get('/discussion-content/{id}', 'DiscussionsController@getDiscussionContent')->name('discussion-content');
    Route::post('/update-discussion-content/{id}', 'DiscussionsController@updateDiscussionContent')->name('post-update-discussion-content');
    Route::post('/update-discussion-title', 'DiscussionsController@updateDiscussionTitle')->name('post-update-title');
    Route::post('/delete-discussion', 'DiscussionsController@deleteDiscussion')->name('delete-discussion');

    // SHEIKHS ROUTES
    Route::get('/get-sheikhs', 'SheikhController@index')->name('get-sheikhs');
    Route::post('/add-sheikh', 'SheikhController@addSheikh')->name('add-sheikh');
    Route::get('/sheikh-edit-page/{id}', 'SheikhController@getSheikhEditPage')->name('get-sheikh-edit-page');
    Route::post('/update-sheikh/{id}', 'SheikhController@updateSheikh')->name('update-sheikh');
    Route::get('/delete-sheikh/{id}', 'SheikhController@deleteSheikh')->name('delete-sheikh');

    // ABOUT PAGE ROUTES
    Route::get('/about', 'AboutController@index')->name('about');
    Route::post('/about', 'AboutController@updateAbout')->name('about-update');
    // Route::get('/update-discussion/{id}', 'DiscussionController@getUpdateDiscussion')->name('get-update-discussion');
    // Route::post('/update-discussion/{id}', 'DiscussionController@posttUpdateDiscussion')->name('post-update-discussion');
    // Route::post('/delete-discussion/{id}', 'DiscussionController@deleteDiscussion')->name('delete-discussion');

});
