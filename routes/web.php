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

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Candidate', 'prefix' => 'candidate', 'as'=>'candidate.'], function (){
    //Login & Logout
    Route::get('/', ['as'=>'login', function (){ return redirect()->route('candidate.login');}]);
    Route::get('login', 'CandidateAuthController@getLogin')->name('login');
    Route::post('postLogin', 'CandidateAuthController@postLogin')->name('postLogin');
    Route::post('logout', 'CandidateAuthController@logout')->name('logout');
    Route::get('verifyUser', 'CandidateAuthController@verifyUser')->name('verifyUser');
    Route::post('candidate-verify', 'CandidateAuthController@candidateVerify')->name('candidateVerify');


    Route::group(['middleware' => 'candAuth'], function (){
        Route::get('dashboard', 'CandidateAuthController@dashboard')->name('dashboard');
        Route::get('candidate-last-action', 'CandidateAuthController@tractCandidateLastAction')->name('tractCandidateLastAction');
        // Route::get('examInstruction', 'CandidateAuthController@examInstruction')->name('examInstruction');
        // Route::get('examDemoQOne', 'CandidateAuthController@examDemoQOne')->name('examDemoQOne');
        // Route::get('examDemoQTwo', 'CandidateAuthController@examDemoQTwo')->name('examDemoQTwo');
        // Route::get('examDemoQThree', 'CandidateAuthController@examDemoQThree')->name('examDemoQThree');
        // Route::get('examDemoFinish', 'CandidateAuthController@examDemoFinish')->name('examDemoFinish');

        Route::get('secretKeyModal', 'CandidateAuthController@secretKeyModal')->name('secretKeyModal');
        Route::post('secretKeyCheck', 'CandidateAuthController@secretKeyCheck')->name('secretKeyCheck');

        Route::get('startMainExam', 'CandidateAuthController@startMainExam')->name('startMainExam');

        //CANDIDATE EXAM
        Route::get('candidate-exam-configure', 'CandidateExamController@candidateExamConfigure')->name('candidateExamConfigure');
        Route::get('candidate-exam-start', 'CandidateExamController@candidateExamStart')->name('candidateExamStart');
        Route::post('candidate-exam-submit', 'CandidateExamController@candidateExamSubmit')->name('candidateExamSubmit');
        Route::get('can-exam-previous-question', 'CandidateExamController@canExamPreviousQuestion')->name('canExamPreviousQuestion');


        Route::get('/examInstruction', 'CandidateExamController@examInstruction')->name('examInstruction');
        Route::get('/getInstruction', 'CandidateExamController@getInstruction')->name('getInstruction');

        // Md.Saiful Islam (Saif)
        Route::get('/examDemoItemPreview', 'CandidateExamController@examDemoItemPreview')->name('examDemoItemPreview');
        Route::get('/examDemoFinish', 'CandidateExamController@examDemoFinish')->name('examDemoFinish');

        Route::get('/examDemoQOne', 'CandidateExamController@examDemoQOne')->name('examDemoQOne');
        Route::get('/examDemoQTwo', 'CandidateExamController@examDemoQTwo')->name('examDemoQTwo');
        Route::get('/examDemoQThree', 'CandidateExamController@examDemoQThree')->name('examDemoQThree');
        Route::post('/can_exam_info_update', 'CandidateExamController@canExamInfoUpdate')->name('canExamInfoUpdate');
        Route::get('/autoCandidateExamSubmit', 'CandidateExamController@autoCandidateExamSubmit')->name('autoCandidateExamSubmit');


    });
});

Route::auth();

// Route::get('/candidate/login', 'ExamController@candidateLogin');
Route::post('/candidate-login-process', 'ExamController@candidateLoginProcess')->name('candidate-login-process');
Route::get('/candidate/instructions', 'ExamController@candidateInstructions');
Route::get('/candidate/sample-test', 'ExamController@sampleTest');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@dashboard');


//    Route::get('/', function () {
//        return view('welcome');
//    });


    /* ================   Result Connfig  ================ Md.Saiful Islam */
    Route::post('/result-config', 'ResultConfigController@saveResultConfig')->name('result-config');
    Route::get('/result-config', 'ResultConfigController@index');
    Route::get('/load_test_config_data/{testId}', 'ResultConfigController@loadTestConfigDataByTestId');

    // side navigation
    Route::get('/item-create', 'AdminController@itemCreate');
    Route::get('/iq-item-create', 'AdminController@iqItemCreate');
    Route::get('/psym-item-create', 'AdminController@psymItemCreate');
    Route::get('/item-bank/active', 'AdminController@itemBankActive');
    Route::get('/item-bank/no_answer', 'AdminController@itemNoAnswer');
    Route::get('/item-bank/test', 'AdminController@itemBankTest');
    Route::get('/item-bank/inactive', 'AdminController@itemBankInactive');
    Route::get('/item-bank/demo', 'AdminController@itemBankDemo');

    // create new pm question
    Route::get('create-question', ['as' => 'create.question', 'uses' => 'AdminController@createQuestion']);
    Route::post('/store', 'AdminController@store');
    Route::get('/pm-question-bank/{status}', 'AdminController@pmQuestionList');
    Route::get('/vit-question-bank/{status}', 'AdminController@vitQuestionList');
    Route::get('/update-question-bank/{db}/{id}/{status}', 'AdminController@update');
    Route::post('/edit-question/{id}', 'AdminController@edit');
    Route::delete('/delete-question/{db}/{id}', 'AdminController@delete');
    Route::post('/singleOptionRemove', 'AdminController@singleOptionRemove');
    Route::get('/create-new-questions', function () {
        return view('create_question');
    });
    Route::get('/image-options', function () {
        return view('image-options');
    });
    // create new pm question set
    Route::get('/create-question-set', 'AdminController@createIQquestionSet');
    Route::get('/getQusetionType/{question_set_for}', 'AdminController@getQusetionType');
    Route::get('/iq-question-set-list/{db}', 'AdminController@iqQuestionSetList');
    Route::post('/storeIQquestionSet', 'AdminController@storeIQquestionSet');
    Route::get('/update-iq-question-set/{db}/{id}', 'AdminController@updateIQquestionSet');
    Route::post('/editIQquestionSet/{id}', 'AdminController@editIQquestionSet');
    Route::delete('/deleteIQquestionSet/{db}/{id}', 'AdminController@deleteIQquestionSet');

    Route::get('/single-question-view/{db}/{id}', 'AdminController@singleQuestionView');

    Route::get('/studentQuestionSet', 'AdminController@studentIQquestionSet');
    Route::get('/create-pm-item-set', 'AdminController@createPMitemSet');
    Route::get('/create-vit-item-set', 'AdminController@createVITitemSet');
    //numeric question
    Route::get('/numeric-question-bank/{status}', 'AdminController@NumericQuestion');
    Route::get('/create-numeric-question', 'AdminController@createNumericQuestion');
    Route::post('/storeNumericQuestion', 'AdminController@storeNumericQuestion');
    Route::get('/update-numeric-question/{id}/{status}', 'AdminController@updateNumericQuestion');
    Route::post('/editNumericQuestion/{id}', 'AdminController@editNumericQuestion');
    Route::delete('/deleteNumericQuestion/{id}', 'AdminController@deleteNumericQuestion');
    Route::post('/numericQuestionSet', 'AdminController@numericQuestionSet');
    Route::get('/view-numeric-question/{id}', 'AdminController@viewNumericQuestion');
    // numeric item set
    Route::get('/numeric-set-list', 'AdminController@numericItemSetList');
    Route::get('/create-numeric-item-set', 'AdminController@createNumericQuestionSet');
    Route::post('/storeNumericQuestionSet', 'AdminController@storeNumericQuestionSet');
    Route::get('/update-numeric-item-set/{id}', 'AdminController@updateNumericItemSet');
    Route::post('/editNumericQuestionSet/{id}', 'AdminController@editNumericQuestionSet');
    Route::delete('/destroyNumericQuestionSet/{id}', 'AdminController@destroyNumericQuestionSet');

    // verbal item
    Route::get('/create-verbal-item', 'AdminController@createVerbalItem');


    // side navigation

    // item category
    Route::get('/item-category', 'AdminController@itemCategory');
    Route::get('/create-item-category', 'AdminController@createItemCategory');
    Route::post('/storeItemCategory', 'AdminController@storeItemCategory');
    Route::get('/update-item-category/{id}', 'AdminController@updateItemCategory');
    Route::post('/editItemCategory/{id}', 'AdminController@editItemCategory');
    Route::delete('/destroyItemCategory/{id}', 'AdminController@destroyItemCategory');

    // item level
    Route::get('/item-level', 'AdminController@itemLevel');
    Route::get('/create-item-level', 'AdminController@createItemLevel');
    Route::post('/storeItemLevel', 'AdminController@storeItemLevel');
    Route::get('/update-item-level/{id}', 'AdminController@updateItemLevel');
    Route::post('/editItemLevel/{id}', 'AdminController@editItemLevel');
    Route::delete('/destroyItemLevel/{id}', 'AdminController@destroyItemLevel');

    // Candidate Type
    Route::get('/candidate-type', 'AdminController@candidateType');
    Route::get('/create-candidate-type', 'AdminController@createCandidateType');
    Route::post('/storeCandidateType', 'AdminController@storeCandidateType');
    Route::get('/update-candidate-type/{id}', 'AdminController@updateCandidateType');
    Route::post('/editCandidateType/{id}', 'AdminController@editCandidateType');
    Route::delete('/destroyCandidateType/{id}', 'AdminController@destroyCandidateType');

    // item Tags 1
    Route::get('/item-tag1', 'ItemTagsController@itemTag1');
    Route::get('/create-item-tag1', 'ItemTagsController@createItemTag1');
    Route::post('/storeItemTag1', 'ItemTagsController@storeItemTag1');
    Route::get('/update-item-tag1/{id}', 'ItemTagsController@updateItemTag1');
    Route::post('/editItemTag1/{id}', 'ItemTagsController@editItemTag1');
    Route::delete('/destroyItemTag1/{id}', 'ItemTagsController@destroyItemTag1');

    // item Tags 2
    Route::get('/item-tag2', 'ItemTagsController@itemTag2');
    Route::get('/create-item-tag2', 'ItemTagsController@createItemTag2');
    Route::post('/storeItemTag2', 'ItemTagsController@storeItemTag2');
    Route::get('/update-item-tag2/{id}', 'ItemTagsController@updateItemTag2');
    Route::post('/editItemTag2/{id}', 'ItemTagsController@editItemTag2');
    Route::delete('/destroyItemTag2/{id}', 'ItemTagsController@destroyItemTag2');

    // item Tags 3
    Route::get('/item-tag3', 'ItemTagsController@itemTag3');
    Route::get('/create-item-tag3', 'ItemTagsController@createItemTag3');
    Route::post('/storeItemTag3', 'ItemTagsController@storeItemTag3');
    Route::get('/update-item-tag3/{id}', 'ItemTagsController@updateItemTag3');
    Route::post('/editItemTag3/{id}', 'ItemTagsController@editItemTag3');
    Route::delete('/destroyItemTag3/{id}', 'ItemTagsController@destroyItemTag3');

    // item Tags 4
    Route::get('/item-tag4', 'ItemTagsController@itemTag4');
    Route::get('/create-item-tag4', 'ItemTagsController@createItemTag4');
    Route::post('/storeItemTag4', 'ItemTagsController@storeItemTag4');
    Route::get('/update-item-tag4/{id}', 'ItemTagsController@updateItemTag4');
    Route::post('/editItemTag4/{id}', 'ItemTagsController@editItemTag4');
    Route::delete('/destroyItemTag4/{id}', 'ItemTagsController@destroyItemTag4');

    // item Tags 5
    Route::get('/item-tag5', 'ItemTagsController@itemTag5');
    Route::get('/create-item-tag5', 'ItemTagsController@createItemTag5');
    Route::post('/storeItemTag5', 'ItemTagsController@storeItemTag5');
    Route::get('/update-item-tag5/{id}', 'ItemTagsController@updateItemTag5');
    Route::post('/editItemTag5/{id}', 'ItemTagsController@editItemTag5');
    Route::delete('/destroyItemTag5/{id}', 'ItemTagsController@destroyItemTag5');

    // item Tags 6
    Route::get('/item-tag6', 'ItemTagsController@itemTag6');
    Route::get('/create-item-tag6', 'ItemTagsController@createItemTag6');
    Route::post('/storeItemTag6', 'ItemTagsController@storeItemTag6');
    Route::get('/update-item-tag6/{id}', 'ItemTagsController@updateItemTag6');
    Route::post('/editItemTag6/{id}', 'ItemTagsController@editItemTag6');
    Route::delete('/destroyItemTag6/{id}', 'ItemTagsController@destroyItemTag6');

    // item Tags 7
    Route::get('/item-tag7', 'ItemTagsController@itemTag7');
    Route::get('/create-item-tag7', 'ItemTagsController@createItemTag7');
    Route::post('/storeItemTag7', 'ItemTagsController@storeItemTag7');
    Route::get('/update-item-tag7/{id}', 'ItemTagsController@updateItemTag7');
    Route::post('/editItemTag7/{id}', 'ItemTagsController@editItemTag7');
    Route::delete('/destroyItemTag7/{id}', 'ItemTagsController@destroyItemTag7');

    // mapping item tags names
    Route::get('/item-mapping', 'ItemTagsController@mapnames');
    Route::post('/storemapname', 'ItemTagsController@storemapname');
    Route::get('/edit-tagmap/{id}', 'ItemTagsController@edittagmap');
    Route::post('/updateTagMap/{id}', 'ItemTagsController@updateTagMap');

    // test list
    Route::get('/test-list', 'AdminController@testList');
    Route::get('/create-test', 'AdminController@createTest');
    Route::post('/storeTest', 'AdminController@storeTest');
    Route::get('/edit-test/{id}', 'AdminController@editTest');
    Route::post('/updateTest/{id}', 'AdminController@updateTest');

    // verbal item bank
    Route::get('/verbal-item-bank/{status}', 'AdminController@verbalItemBank');
    Route::get('/create-verbal-item', 'AdminController@createVerbalItem');
    Route::post('/storeVerbalItem', 'AdminController@storeVerbalItem');
    Route::get('/edit-verbal-item/{id}', 'AdminController@editVerbalItem');
    Route::post('/updateVerbalItem/{id}', 'AdminController@updateVerbalItem');
    Route::delete('/destroyVerbalItem/{id}', 'AdminController@destroyVerbalItem');

    // abstract item bank
    Route::get('/create-abstract-item-bank', 'AdminController@createAbstractItemBank');

    // generic form
    Route::get('/items/{item_for}/{status}', 'AdminController@itemList');
    Route::get('/create-item', 'AdminController@createItem');
    Route::post('/storeItem', 'AdminController@storeItem');
    Route::get('/edit-item/{id}', 'AdminController@editItem');
    Route::post('/updateItem/{id}', 'AdminController@updateItem');
    Route::post('/testSubOptions/{id}', 'AdminController@testSubOptions');
    Route::get('/item-preview/{id}', 'AdminController@itemPreview');

    // new item
    Route::get('/create-new-item', 'AdminController@createNewItem');
    Route::post('/storeNewItem', 'AdminController@storeNewItem');
    Route::get('/edit-items/{id}', 'AdminController@editItems');
    Route::post('/updateItems/{id}', 'AdminController@updateItems');
    Route::post('/activateItem', 'AdminController@activateItem');
    Route::delete('/destroyItem/{id}', 'AdminController@destroyItem');

    // set & Test list - -- Saif
    Route::get('/question-set-and-test-configuration-list', 'AdminController@questionSetAndTestConfigurationList');


    // set configuration
    Route::get('/question-set/{set_for}', 'AdminController@questionSet');
    Route::get('/question-set', 'AdminController@questionSetList');
    Route::get('/create-set', 'AdminController@createSets');
    Route::post('/setRedirect', 'AdminController@setRedirect');
    Route::get('/create-question-set', 'AdminController@createItemSet');// Old
    //Route::get('/create-question-set/{item_set_for?}/{item_configuration_type?}', 'AdminController@createItemSet'); //Saif
    Route::post('/storeItemSet', 'AdminController@storeItemSet');
    Route::get('/edit-item-set/{id}', 'AdminController@editItemSet');
    Route::post('/updateItemSet/{id}', 'AdminController@updateItemSet');
    Route::delete('/destroyItemSet/{id}', 'AdminController@destroyItemSet');

    // memory item
    Route::get('/memory-items/{status}', 'AdminController@memoryItemList');
    Route::get('/create-memory-item', 'AdminController@createMemoryItem');
    Route::post('/uploadMemoryImage', 'AdminController@uploadMemoryImage');
    Route::post('/removeMemoryImage', 'AdminController@removeMemoryImage');
    Route::post('/storeMemoryItem', 'AdminController@storeMemoryItem');
    Route::get('/edit-memory-item/{id}', 'AdminController@editMemoryItem');
    Route::post('/updateMemoryItem/{id}', 'AdminController@updateMemoryItem');
    Route::delete('/destroyMemoryItem/{id}', 'AdminController@destroyMemoryItem');


    // board
    Route::get('/create-board', 'AdminController@createBoard');

    // test configuration
    Route::get('/test-configuration-list/{test_for}', 'AdminController@testConfigurations');
    Route::get('/test-configuration-list', 'AdminController@testConfigList');
    Route::get('/new-test-configuration', 'AdminController@testConfig');
    Route::post('/testRedirect', 'AdminController@testRedirect');
    Route::get('/create-test-configuration', 'AdminController@createTestConfig');
    Route::get('/load-test-result-config/{totalItems}', 'AdminController@loadRestResultConfig');
    Route::post('/storeTestConfig', 'AdminController@storeTestConfig');
    Route::get('/update-test-configuration/{id}', 'AdminController@editTestConfig');
    Route::post('/updateTestConfig/{id}', 'AdminController@updateTestConfig');
    Route::delete('/destroyTestConfig/{id}', 'AdminController@destroyTestConfig');

    // test group
    Route::get('/test-group', 'AdminController@testGroup');
    Route::post('/storeTestGroup', 'AdminController@storeTestGroup');
    Route::delete('/destroyTestGroup/{id}', 'AdminController@destroyTestGroup');

    // board configuration
    Route::get('/board-configuration', 'AdminController@boardConfiguration');
    // Users
    Route::get('users', ['as' => 'users.index', 'uses' => 'UserController@index', 'middleware' => ['role:admin']]);
    Route::get('users/create', ['as' => 'users.create', 'uses' => 'UserController@create', 'middleware' => ['role:admin']]);
    Route::post('users/create', ['as' => 'users.store', 'uses' => 'UserController@store', 'middleware' => ['role:admin']]);
    Route::get('users/{id}', ['as' => 'users.show', 'uses' => 'UserController@show', 'middleware' => ['role:admin']]);
    Route::get('users/{id}/edit', ['as' => 'users.edit', 'uses' => 'UserController@edit', 'middleware' => ['role:admin']]);
    Route::post('users/{id}', ['as' => 'users.update', 'uses' => 'UserController@update', 'middleware' => ['role:admin']]);
    Route::delete('users/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy', 'middleware' => ['role:admin']]);
    // Roles
    Route::get('roles', ['as' => 'roles.index', 'uses' => 'RoleController@index', 'middleware' => ['role:admin']]);
    Route::get('roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create', 'middleware' => ['role:admin']]);
    Route::post('roles/create', ['as' => 'roles.store', 'uses' => 'RoleController@store', 'middleware' => ['role:admin']]);
    Route::get('roles/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show', 'middleware' => ['role:admin']]);
    Route::get('roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit', 'middleware' => ['role:admin']]);
    Route::post('roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update', 'middleware' => ['role:admin']]);
    Route::delete('roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy', 'middleware' => ['role:admin']]);
    // Permission
    Route::get('permissions', ['as' => 'permissions.index', 'uses' => 'PermissionController@index', 'middleware' => ['role:admin']]);
    Route::get('permissions/create', ['as' => 'permissions.create', 'uses' => 'PermissionController@create', 'middleware' => ['role:admin']]);
    Route::post('permissions/create', ['as' => 'permissions.store', 'uses' => 'PermissionController@store', 'middleware' => ['role:admin']]);
    Route::get('permissions/{id}', ['as' => 'permissions.show', 'uses' => 'PermissionController@show', 'middleware' => ['role:admin']]);
    Route::get('permissions/{id}/edit', ['as' => 'permissions.edit', 'uses' => 'PermissionController@edit', 'middleware' => ['role:admin']]);
    Route::post('permissions/{id}', ['as' => 'permissions.update', 'uses' => 'PermissionController@update', 'middleware' => ['role:admin']]);
    Route::delete('permissions/delete/{id}', ['as' => 'permissions.destroy', 'uses' => 'PermissionController@destroy', 'middleware' => ['role:admin']]);


    // psy picture module
    Route::get('/psy-picture-list', 'TestingController@psyPictureList');
    Route::get('/create-psy-picture', 'TestingController@createPsyPictures');
    Route::post('/storePsyPicture', 'TestingController@storePsyPictures');
    Route::get('/edit-psy-picture/{id}', 'TestingController@editPsyPictures');
    Route::post('/updatePsyPicture/{id}', 'TestingController@updatePsyPictures');
    Route::delete('/delete/psypicture/{id}', 'TestingController@destroyPsyPictures');

    // Session Calender
    Route::get('/session-calender-list', 'PsyModuleController@sessionCalenderList');
    Route::get('/session-calender-create', 'PsyModuleController@createSessionCalender');
    Route::post('/session-calender-store', 'PsyModuleController@storeSessionCalender');
    Route::get('/session-calender-edit/{id}', 'PsyModuleController@editSessionCalender');
    Route::post('/session-calender-update', 'PsyModuleController@updateSessionCalender');
    Route::delete('/session-calender-delete/{id}', 'PsyModuleController@destroySessionCalender');

    // TAT / BL
    Route::get('/tat-bl-list', 'PsyModuleController@tatBlList');
    Route::get('/tat-bl-create', 'PsyModuleController@createTatBl');
    Route::post('/tat-bl-store', 'PsyModuleController@storeTatBl');
    Route::get('/tat-bl-edit/{id}', 'PsyModuleController@editTatBl');
    Route::post('/tat-bl-update', 'PsyModuleController@updateTatBl');
    Route::delete('/tat-bl-delete/{id}', 'PsyModuleController@destroyTatBl');

    // Course Schedule
    Route::get('/course-schedule-list', 'PsyModuleController@courseScheduleList');
    Route::get('/course-schedule-create', 'PsyModuleController@createCourseSchedule');
    Route::post('/course-schedule-store', 'PsyModuleController@storeCourseSchedule');
    Route::get('/course-schedule-edit/{id}', 'PsyModuleController@editCourseSchedule');
    Route::post('/course-schedule-update', 'PsyModuleController@updateCourseSchedule');
    Route::delete('/course-schedule-delete/{id}', 'PsyModuleController@destroyCourseSchedule');

    // upcoming events
    Route::get('/upcoming-events-list', 'PsyModuleController@upcomingEventsList');
    Route::get('/upcoming-events-create', 'PsyModuleController@createUpcomingEvents');
    Route::post('/upcoming-events-store', 'PsyModuleController@storeUpcomingEvents');
    Route::get('/upcoming-events-edit/{id}', 'PsyModuleController@editUpcomingEvents');
    Route::post('/upcoming-events-update', 'PsyModuleController@updateUpcomingEvents');
    Route::delete('/upcoming-events-delete/{id}', 'PsyModuleController@destroyUpcomingEvents');

    // testing Schedule
    Route::get('/testing-schedule-list', 'PsyModuleController@testingScheduleList');
    Route::get('/testing-schedule-create', 'PsyModuleController@createTestingSchedule');
    Route::post('/testing-schedule-store', 'PsyModuleController@storeTestingSchedule');
    Route::get('/testing-schedule-edit/{id}', 'PsyModuleController@editTestingSchedule');
    Route::post('/testing-schedule-update', 'PsyModuleController@updateTestingSchedule');
    Route::delete('/testing-schedule-delete/{id}', 'PsyModuleController@destroyTestingSchedule');

    // announcement Schedule
    Route::get('/announcement-list', 'PsyModuleController@announcementList');
    Route::get('/announcement-create', 'PsyModuleController@createAnnouncement');
    Route::post('/announcement-store', 'PsyModuleController@storeAnnouncement');
    Route::get('/announcement-edit/{id}', 'PsyModuleController@editAnnouncement');
    Route::post('/announcement-update', 'PsyModuleController@updateAnnouncement');
    Route::delete('/announcement-delete/{id}', 'PsyModuleController@destroyAnnouncement');

    Route::get('/session-calender', 'PsyDetailsController@sessionCalender');
    Route::get('/tat-bl', 'PsyDetailsController@tatBl');
    Route::get('/testing-schedule', 'PsyDetailsController@testingSchedule');
    Route::get('/upcoming-events', 'PsyDetailsController@upcomingEvents');
    Route::get('/course-schedule', 'PsyDetailsController@courseSchedule');
    Route::get('/announcement', 'PsyDetailsController@announcement');

    // share docs Schedule
    Route::get('/sharedoc-list', 'PsyModuleController@shareDocList');
    Route::post('/sharedoc-store', 'PsyModuleController@storeShareDoc');
    Route::delete('/sharedoc-delete/{id}', 'PsyModuleController@destroyShareDoc');

    // ADMIN
    Route::resource('configInstruction', 'ConfigInstructionController');

    Route::resource('boardCandidate', 'BoardCandidateController');
    Route::get('get-candidate-board', 'BoardCandidateController@getCandidateBoard')->name('getCandidateBoard');

    // TESTING OFFICER
    Route::resource('examConfig', 'ExamConfigController');
    Route::get('/runningExamTimeRemain', 'ExamConfigController@runningExamTimeRemain')->name('runningExamTimeRemain');
    Route::get('/examPreview', 'ExamConfigController@examPreview')->name('examPreview');
    Route::get('/activateExam', 'ExamConfigController@activateExam')->name('activateExam');
    Route::get('genarateToken', 'GenarateTokenController@genarateToken')->name('genarateToken');
    Route::get('savegenarateToken', 'GenarateTokenController@savegenarateToken')->name('saveGenarateToken');
    Route::get('/assessment-status-update', 'ExamConfigController@assessmentStatusUpdate')->name('assessmentStatusUpdate');

    // CONDUCTING OFFICER
    Route::get('/stdSeatPlan', 'StdSeatPlanController@index')->name('stdSeatPlan');
    Route::get('/ifream-stdSeatPlan', 'StdSeatPlanController@ifreamStdSeatPlan');
    Route::get('/examScheduleList', 'ExamScheduleController@index')->name('examScheduleList');
    Route::get('/examInstruction', 'ExamScheduleController@examInstruction')->name('examInstruction');
    Route::get('/nextInstruction', 'ExamScheduleController@nextInstruction')->name('nextInstruction');

    Route::get('/examDemoItemPreview', 'ExamScheduleController@examDemoItemPreview')->name('examDemoItemPreview');

    Route::post('/candidateExamStop', 'ExamScheduleController@candidateExamStopByConductionOfficer')->name('candidateExamStopByConductionOfficer');

    Route::get('/examDemoQOne', 'ExamScheduleController@examDemoQOne')->name('examDemoQOne');
    Route::get('/examDemoQTwo', 'ExamScheduleController@examDemoQTwo')->name('examDemoQTwo');
    Route::get('/examDemoQThree', 'ExamScheduleController@examDemoQThree')->name('examDemoQThree');
    Route::get('/examDemoFinish', 'ExamScheduleController@examDemoFinish')->name('examDemoFinish');
    Route::get('/startMainExam', 'ExamScheduleController@startMainExam')->name('startMainExam');
    Route::post('/updateMainExamTime', 'ExamScheduleController@updateMainExamTime')->name('updateMainExamTime');

    Route::get('/completeMainExam', 'ExamScheduleController@completeMainExam')->name('completeMainExam');

});


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/memory_draft', function () {
    return view('image-options');
});


Route::post('/formCheck', 'AdminController@formCheck');

