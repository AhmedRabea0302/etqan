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
    
});



Route::get('/testa', 'SuspicionController@getAddSuspicion')->name('suspia');
Route::group(['namespace' => 'ApiController'], function() {
    // SUSPICIONS ENDPOINTS
    Route::get('/all-suspicions', 'SuspicionController@getAllSuspicions')->name('get-main-suspicions');
    Route::get('/suspicion-childs/{id}', 'SuspicionController@getSuspicionChilds')->name('suspicion-childs');
    Route::get('/suspicion-reply/{id}', 'SuspicionController@getSuspicionReply')->name('suspicion-reply');

    Route::get('/suspicion-tree', 'SuspicionController@getChildSuspicions')->name('suspicion-tree');

    // Hot SUSPICIONS ENDPOINTS
    Route::get('/all-hot-suspicions', 'HotSuspicionController@getAllSuspicions')->name('get-main-suspicions');
    Route::get('/suspicion-hot-childs/{id}', 'HotSuspicionController@getSuspicionChilds')->name('suspicion-childs');
    Route::get('/suspicion-hot-reply/{id}', 'HotSuspicionController@getSuspicionReply')->name('suspicion-reply');

    Route::get('/suspicion-hot-tree', 'HotSuspicionController@getChildSuspicions')->name('suspicion-tree');

    
    // MAIN GATEGORIES ENDPOINTS
    Route::get('/maincats', 'CategoryController@getMainCaats')->name('maincatsapi');

    // INFOGRAPHS ENDPOINTS
    Route::get('/infographs', 'infoGraphController@getInfographs')->name('infographsapi');

    // Discussions
    Route::get('/discussions', 'DiscussionController@getDiscussions')->name('get-discussions');
    Route::get('/discussion/{id}', 'DiscussionController@getDiscussionContent')->name('get-spec-discussion');

    // Evidences
    Route::get('/evidences', 'EvidenceController@getEvidences')->name('get-evidences');
    Route::get('/evidence/{id}', 'EvidenceController@getEvidencesContent')->name('get-spec-evidence');

    // MARSADS
    Route::get('/marsads', 'MarsadController@getMarsads')->name('get-marsads');

    // SHEIKHS ROUTES
    Route::post('/sheikh-login', 'SheikhAuthController@login');
    Route::get('/sheikh-logout', 'SheikhAuthController@logout');
    Route::get('/logedin-sheikh', 'SheikhAuthController@getAuthUser');

    Route::get('/all-sheikhs', 'SheikhController@getAllSheikhs');
    Route::group(['middleware' => 'jwt'], function() {
        Route::post('/sheikh-add-meet', 'SheikhController@sheikhAddMeet');
        Route::post('/sheikh-update-meet', 'SheikhController@sheikhUpdateMeet');
        Route::post('/ban-user/{id}', 'SheikhController@sheikhBanUser');
    });
    

    // APP USERS ROUTES
    Route::post('/user-register', 'AppUserController@register');
    Route::post('/user-login', 'AppUserController@login');
    Route::get('/user-logout', 'AppUserController@logout');
    Route::get('/user', 'AppUserController@getAuthUser');
    Route::get('/user', 'AppUserController@getAuthUser');

    Route::group(['middleware' => 'jwt'], function() {
        Route::post('/user-update-profile', 'AppUserController@updateProfile');
    });

    // ABOUT PAGE ROUTES
    Route::get('/about-details', 'AboutController@getAbouts');

    // MMET ROUTES
    
    Route::get('/all-meets', 'MeetController@getAllMeets');
    Route::get('/all-upcomming-meets', 'MeetController@getAllUpcommingMeets');
    Route::get('/all-sheikh-meets/{sheikh_id}', 'MeetController@getSheikhMeets');
    Route::get('/all-active-meets', 'MeetController@getAllActiveMeets');
    
    // COMMENTS ROUTES
    Route::get('/subject-comments/{subject_type}/{subject_id}', 'CommentsController@getSubjectComments');
    Route::group(['middleware' => 'jwt'], function() {
        Route::post('/add-comment', 'CommentsController@addComment');
        Route::post('/update-comment', 'CommentsController@updateComment');
        Route::post('/delete-comment', 'CommentsController@deleteComment');
    });



    // REPLIES ROUTES
    Route::group(['middleware' => 'jwt'], function() {
        Route::post('/add-reply', 'RepliesController@addReply');
        Route::post('/update-reply', 'RepliesController@updateReply');
        Route::post('/delete-reply', 'RepliesController@deleteReply');
    });
    Route::get('/comment-replies/{subject_type}/{comment_id}', 'RepliesController@getCommentReplies');

});
