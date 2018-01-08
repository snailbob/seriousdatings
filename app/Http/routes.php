<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

use Illuminate\Support\Facades\App;
use App\Http\Controllers\SubscriptionCheckController;
use App\User;
use App\AboutYourDate;
/* Route::get('test', function () {



  $ip = $_SERVER['REMOTE_ADDR'];
  $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
  dd($details);

  }); */

//Route::get('checkemail','UsersController@checkEmail');
Route::resource('users', 'UsersController');
Route::post('ajaxLogin', 'HomeController@ajaxLogin');
Route::post('submitAboutDate', 'UsersController@submitAboutDate');

// Route::get('auth/facebook', 'FacebookController@redirectToProvider')->name('facebook.login');
// Route::get('auth/facebook/callback', 'FacebookController@handleProviderCallback');

Route::get('user/paginate', 'HomeController@paginateUser');

Route::get('bloglist', 'HomeController@ListBlog');


Route::get('users/{username}/verify/{key}', 'VerifyController@getVerify');

Route::get('username/check', function () {

    $username = Input::get('username');
    $id = DB::table('users')->where('username', $username)->pluck('id');

    if ($id == null) {
        return '1';
    } else {
        return '0';
    }
});

Route::get('/start', function() {
    $verified = new Role();
    $verified->name = 'Verified';
    $verified->save();

    $admin = new Role();
    $admin->name = 'Admin';
    $admin->save();

    $user = new Role();
    $user->name = 'User';
    $user->save();

    $read = new Permission();
    $read->name = 'can_see';
    $read->display_name = 'Can See User Profiles';
    $read->save();

    $edit = new Permission();
    $edit->name = 'can_see_compatability';
    $edit->display_name = 'Can See Compatability';
    $edit->save();

    $admin_p = new Permission();
    $admin_p->name = 'admin';
    $admin_p->display_name = 'Can Control Anything';
    $admin_p->save();

    $admin->attachPermission($admin_p);

    $verified->attachPermission($read);
    $verified->attachPermission($edit);

    $user1 = \User::find(1);
    $user2 = \User::find(2);

    $user1->attachRole($admin);
    $user2->attachRole($verified);

    return 'Woohoo!';
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('users/{username}/about_your_date', 'AboutYourDateController@index');
    Route::get('users/{username}/select_mates', 'AboutYourDateController@selectMates');
    Route::get('users/{username}/like_movies', 'AboutYourDateController@likeMovies');
    Route::get('online_chat', 'UsersController@onlineChatPage');
    Route::get('video_chat', 'UsersController@videoChatPage');
    Route::get('video_room', 'UsersController@videoRoomPage');
    Route::get('advertise', 'AdsSpaceController@create');
    Route::get('browse', 'SearchController@browseUsers');
    Route::get('payment_method', 'PaymentMethodController@index');
    Route::get('payment_checkout/{plan_id}', 'PaymentMethodController@getCheckout');
    Route::get('getdone/{plan_id}', 'PaymentMethodController@getDone');
    Route::get('getcancel', 'PaymentMethodController@getCancel');

    Route::get('profile_settings', 'UsersController@profileSettings');
    Route::get('privacy_settings', 'UsersController@privacySettings');
    
});

Route::get('search', 'SearchController@index');
Route::get('search/profile/{id}', 'SearchController@searchProfile');
Route::post('search_side', 'SearchController@xpostIndex');
Route::post('login_facebook', 'UsersController@login_facebook');

Route::get('user_session', 'AboutYourDateController@userSession');

Route::group(['prefix' => 'api'], function () {
    
    Route::get('body_contents', 'UsersController@getBodyContents');
    Route::match(['get', 'post'], 'homepage', 'UsersController@homepage');
    Route::post('homepage_search_people', 'UsersController@homepage_search_people');
    Route::get('get_signup_location', 'HomeController@get_signup_location');
    Route::post('signup', 'UsersController@signup');
    Route::post('validate_email', 'UsersController@validate_email');
    Route::post('validate_username', 'UsersController@validate_username');
    Route::get('aboutdate', 'UsersController@getAboutdate');
    Route::post('aboutdate', 'UsersController@postAboutdate');
    Route::get('selectmates', 'UsersController@selectmates');
    Route::get('usermates/{username}', 'UsersController@selectmates');
    Route::post('add_friend', 'UserFriendshipController@store');
    Route::post('delete_friend', 'UserFriendshipController@destroy');
    Route::post('block_user', 'UserBlockController@store');

    Route::post('save_advertisement', 'AdsSpaceController@store');

    Route::get('get_video_shuffle', 'UsersController@getVideoShuffle');

    Route::post('send_invite', 'UsersController@send_invite');

    Route::get('search_user', 'SearchController@getSearchUser');
    Route::get('search_profile', 'SearchController@getSearchProfile');
    Route::get('search_byname', 'SearchController@getSearchByName');
    Route::get('random_compatible', 'SearchController@getRandomCompatible');
    Route::get('get_browse_members', 'SearchController@getBrowseMembers');
    
    Route::get('get_readydate_question', 'ReadyDateQuestion@index');
    Route::post('readydate_answer', 'ReadDateAnswer@store');
    
    Route::post('notifications', 'NotificationController@update');
    
    
    Route::get('movies', 'LikeMoviesController@index');
    Route::post('likemovies', 'LikeMoviesController@store');
    Route::post('dislikemovies', 'LikeMoviesController@destroy');

    Route::get('place', 'UserDestinationController@index');
    Route::post('add_place', 'UserDestinationController@store');
    Route::post('remove_place', 'UserDestinationController@destroy');
    
    Route::get('testfriends', 'UsersController@testfriends');
    
    Route::get('current_user', 'UsersController@getCurrentUser');

    Route::get('events', 'EventManagementController@apiGetEvent');
    Route::get('events/{id}', 'EventManagementController@apiGetEventType');
    Route::get('events/details/{id}', 'EventsController@apiGetEventsDetails');
    Route::post('join_event', 'EventsController@apiPostJoinEvent');
    Route::delete('leave_event', 'EventsController@apiLeaveEvent');

    //for admin
    Route::post('send_event_invite', 'EventsController@send_event_invite');
    Route::post('change_primary_video', 'VideoManagementController@change_primary_video');
    
    
    
    Route::get('profile/{username}', 'ProfileController@userProfile');
    Route::get('notify_check/{id}', 'ProfileController@checkNotify');
    Route::get('match/{username}', 'ProfileController@getUserMatch');
    Route::get('friends', 'ProfileController@getUserFriend');
    Route::get('friend/{username}', 'ProfileController@getMatchPercentage');

    /*START messages services ROUTING*/
    Route::get('messages', 'userMessagesController@messages');
    Route::get('messagesview', 'userMessagesController@messagesview');
    Route::post('messagescount', 'userMessagesController@messagescount');
    Route::post('sendmessage', 'userMessagesController@sendmessage');
    /*END  messages services ROUTING*/

    Route::get('viewImage', 'userMessagesController@getImage');
    Route::post('savechat', 'userMessagesController@saveChat');
    Route::get('gethistorychat', 'userMessagesController@getChatHistory');
    Route::get('gethistorychatexist', 'userMessagesController@getChatHistoryExist');

    Route::get('getuserlocation', 'liveCHatController@getAllUserLocation');


    Route::post('validateuser', 'liveCHatController@validateUserMoreThanOneDay');
    Route::get('verified', 'VerifyController@send_verification_mail');
    // Route::get('emailertest', function(){
    //     $user = User::find(147);
        
    //     $data = [
    //         'email' => $user['email'],
    //         'image' => $user['photo'],
    //         'name' => $user['firstName'] . ' ' . $user['lastName'],
    //         'username' => $user['username'],
    //         'verification_link' => url().'/users/' . $user['id'] . '/verify/' . $user['verify_key'],
    //         'image_link' => url().'/public/images/logo.jpg',
    //         'contact_address' => ''
    //     ];
    
    //     return response()->view('email.verification', $data);
        
    // });
    
    

});

Route::group(array('before' => 'admin'), function() {
    Route::get('admin/logout', function() {
        $user_id = Auth::user()->id;
        Auth::logout();
        DB::table('user_online')->where('user_id', '=', $user_id)->delete();
        \Session::flush();
        return \Redirect::guest('/');
    });

    Route::get('admin/users/{id}/removePicture', function ($id) {

        DB::table('users')
                ->where('id', $id)
                ->update(['photo' => 'placeholder.png']);
        $username = DB::table('users')->where('id', $id)->pluck("username");
        $file = public_path() . '\images\placeholder.png';
        $dest = public_path() . '\images\users\\' . $username . '\placeholder.png';
        // dd($dest);
        \File::copy($file, $dest);

        return redirect(url() . '/admin/users/' . $id);
    });
    
    Route::get('admin/templates/{id}/content', 'TemplateController@showContent');
    Route::get('admin/change_password', 'ChangePasswordController@showForm');
    Route::get('admin/calendar', 'AdminCalendarEveController@showCalendar'); //  BY AK
    Route::get('admin/calendar/{id}', 'AdminCalendarEveController@showCalendarByEvent'); //  BY AK
    Route::get('admin/sendmail', 'AdminCalendarEveController@showComposeMail'); //  BY AK
    Route::get('admin/events/addEventType', 'EventManagementController@eventTypeForm');
    Route::post('admin/events/type', 'EventManagementController@eventTypePost');
    Route::get('admin/events/manage_eventtypes', 'EventManagementController@manage_eventtypes');
    Route::delete('admin/events/delete_eventtypes/{id}', 'EventManagementController@delete_eventtypes');
    Route::get('admin/events/eventtype/{id}/edit', 'EventManagementController@update_eventtypes');

    Route::get('admin/seo/edit/{type}', 'SeoContentController@edit');
    Route::post('admin/seo/update', 'SeoContentController@update');
    
    Route::post('admin/change_password', 'ChangePasswordController@updatePassword');
    Route::post('admin/send', 'AdminDashboardController@sendEmail');

    Route::resource('admin/slide', 'SlideManagementController');
    Route::resource('admin/events', 'EventManagementController');
    Route::resource('admin/templates', 'TemplateController');
    Route::resource('admin/gift_cards', 'GiftCardController');
    // Route::get('admin/users/cat/{cat}', 'UserManagementController@showUserbyCat');
    Route::get('admin/users/cat/{cat}', 'UserManagementController@userbyCat');
    Route::resource('admin/users', 'UserManagementController');
    Route::get('admin/demographic', 'UserManagementController@demographic');
    Route::get('admin/monthlypayment', 'UserManagementController@monthlypayment');
    Route::resource('admin/nonusers', 'NonUserManagementController');
    Route::resource('admin/videos', 'VideoManagementController');
    Route::resource('admin/banners', 'BannerManagementController');
    Route::resource('admin/dating_plans', 'DatingPlanManagementController');
    Route::resource('admin/pages', 'ContentManagementController');
    Route::controller('admin', 'AdminDashboardController');
    //Route::get('admin/calendar', 'CalendarController@showCalendar');

    /** Admin New Section* */
    //Route::resource('admin_new', 'AdminDashboardController@admin_new');
    // Route::resource('admin_new/slide/new', 'NSlideManagementController');
    // Route::get('admin_new/slide/create', 'NSlideManagementController@create');
    //Route::resource('admin_new/slide/{id}/edit_new', 'NSlideManagementController@edit_new');

    /** Admin New Section* */
});

Route::get('/test', 'AdminDashboardController@getTest');

Route::get('ajax', 'AjaxRequestController@getSearchType');
Route::get('users/ajax/profile', 'AjaxRequestController@profileData');
Route::get('events/category/{category}', 'EventsController@eventCategory');

Route::get('forgotPassword', 'ForgotPasswordController@showForgetForm');
Route::get('forgotPassword/{username}/{key}', 'ForgotPasswordController@showForgetFormWithKey');


Route::get('success_story', 'SuccessStoryController@showSucsces');
Route::get('contact', 'ContactController@showForm');


Route::post('profileupload', 'MatchController@Profileupload');




Route::get('test_coords', function(){
    $u = AboutYourDate::where('id', '120')->first(); //->update(['relationshipGoal'=>'yeah']);
    return  json_encode($u);
    // $details = json_decode(file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=23423"));
    // $lat = $details->results[0]->geometry->location->lat;
    // $lng = $details->results[0]->geometry->location->lng;
    // $location = $details->results[0]->formatted_address;
    // return json_encode(count($details->results));
});




Route::get('adminlogin', 'AdminLoginController@getIndex');
//Route::get('calendar', 'CalendarController');
Route::post('admindashboard', 'AdminLoginController@postLogin');
Route::get('comingsoon', function() {
    return View::make('comingsoon');
});

/*Route::get('blog', function() {
    return View::make('blog');
});*/

Route::get('ashuT', 'AshuController@showForm');


Route::post('contact', 'ContactController@postForm');
Route::post('success_story', 'SuccessStoryController@successPost');

Route::post('updatePassword', 'ForgotPasswordController@forgetFormWithKeyPost');
Route::post('forgotPassword', 'ForgotPasswordController@forgetFormPost');

// Route::controller('deploy', 'ServerController');

//::controller('ajax/{action?}/{type?}', 'AjaxRequestController@getSearchType');

Route::get('pages/{title}', 'PageController@showContent');

Route::group(['middleware' => 'auth'], function() {

    Route::get('groups', 'MyGroupController@showGroups');
    Route::get('profiles/groups', 'MyGroupController@index');
    Route::get('groups/{group_id}', 'MyGroupController@show');
    Route::get('profiles/groups/create', 'MyGroupController@create');
    Route::get('groups/{groupID}/addMember', 'MyGroupController@addMemberForm');
    Route::get('groups/{groupID}/removeMember', 'MyGroupController@removeMemberForm');
    
    Route::get('datingPlan/{planId}', 'DatingPlanController@subscribe');
    Route::get('datingPlan/{planId}/success', 'DatingPlanController@success');
    Route::get('profile/datingPlan/succes', 'DatingPlanController@success');
    Route::get('datingPlan/{planId}/cancel', 'DatingPlanController@cancel');
    
    Route::get('events/{id}/upload', 'EventsController@uploadForm');
    Route::get('match', 'MatchController@getIndex');

    Route::post('groups/ajax/group', 'AjaxRequestController@updateGroupMember');
    Route::post('groups', 'MyGroupController@store');
    Route::post('groups/{groupID}/addMember', 'MyGroupController@addMemberPost');
    Route::post('groups/{groupID}/removeMember', 'MyGroupController@removeMemberPost');
    Route::post('events/create', 'EventsController@create');
    
    Route::resource('events', 'EventsController');
    Route::get('events/details/{id}', 'EventsController@getEventsDetails');

    Route::get('users/{username}/compatability', 'CompatabilityController@getCompatibles');
    Route::get('users/{username}/verify', 'VerifyController@getVarifyPlease');
    Route::get('verifyPlease', 'VerifyController@getVarifyPlease');
    Route::get('user/profile/{username}', 'ProfileController@getUserProfile');
    Route::controller('users/{username}/photos', 'UserPublicPhotoController');
    Route::controller('users/{username}/videos', 'UserPublicVideoController');
    Route::controller('datingPlan', 'DatingPlanController');

    Route::get('speeddating/{id}', 'liveCHatController@initializeData');
    Route::get('maplocation/{id}', 'liveCHatController@getUserLocation');
    Route::get('maplocationSppeed/{id}', 'liveCHatController@getUserLocationSpeed');
    Route::get('speeddatingnew', 'liveCHatController@speeddatingInitialize');

    Route::resource('profile/photo', 'UserPhotoController');
    Route::resource('profile/music', 'UserMusicController');
    Route::resource('profile/video', 'UserVideoController');
    Route::resource('profile/group', 'UserGroupController');
    Route::controller('profile', 'ProfileController');
    // Route::get('profile', 'ProfileController@userProfile');

    Route::get('profile/logout', function() {
        $user_id = Auth::user()->id;
        Auth::logout();
        DB::table('user_online')->where('user_id', '=', $user_id)->delete();
        \Session::flush();
        return redirect(url());
        // return \Redirect::guest('/');
    });

});


Route::controller('/', 'HomeController');
// Route::get('/', 'HomeController@getIndex');
// Route::get('/logout', 'HomeController@getLogout');


Route::filter('profile', function() {
    if (Auth::user()) {
        $checkSubscription = new SubscriptionCheckController();
        $checkSubscription->checkSubscription();
        $user = Auth::user();
    } else {
        return \Redirect::guest(url());
    }
});


Route::filter('admin', function() {
    if (Auth::user()) {
        $user = Auth::user();
        if (!$user->hasRole('Admin')) {
            return redirect(url());
        }
    } else {
        return \Redirect::guest('adminlogin');
    }
});
