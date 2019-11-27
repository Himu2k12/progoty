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


Route::get('/','WelcomeController@viewHome');
Route::post('/upazila-By-id','WelcomeController@getUpazilla');
Route::post('/permanent-upazila-By-id','WelcomeController@getpermanentUpazilla');
Route::post('/permanent-upazila-By-id-for-present','WelcomeController@UpazilaNameById');
Route::get('/about','WelcomeController@viewAbout');
Route::get('/policy','WelcomeController@viewPolicy');
Route::get('/contact','WelcomeController@viewContact');

Route::get('locale/{locale}',function ($locale){

    Session::put('locale',$locale);

   return redirect()->back();
});
Auth::routes();
//admin routs

Route::get('/admin-dashboard','AdminController@ShowDashboard');
Route::get('/add-role','RoleController@viewRole');
Route::get('/register-staffs','AdminController@RegisterStaffs');
Route::post('/new-staffs','AdminController@newStaffs');
Route::get('/staffs','AdminController@allStaffs');
Route::get('/inactive-staff/{id}', 'AdminController@inactiveStaffInfo');
Route::get('/active-staff/{id}', 'AdminController@activeStaffInfo');

Route::post('/new-role','RoleController@addRole');


Route::get('/inactive-role/{id}', 'RoleController@inactiveRoleInfo');
Route::get('/active-role/{id}', 'RoleController@activeRoleInfo');
Route::get('/edit-role/{id}', 'RoleController@editRoleInfo');
Route::post('/update-role', 'RoleController@updateRoleInfo');

//supervisor routes

Route::get('/new-member-requests','SupervisorController@newMembers');
Route::get('/verify-members/{slug}','SupervisorController@confirmMember');
Route::get('/verified-members','SupervisorController@verifiedMembers');
Route::get('/details-member-view/{slug}','SupervisorController@detailsView');
Route::get('/details-verified-member/{slug}','SupervisorController@VerifiedDetailsView');
Route::get('/daily-collections','SupervisorController@AllDailyCollections');
Route::get('/new-loan-request','SupervisorController@newLoanRequest');
Route::get('/details-loan-view/{slug}','SupervisorController@LoanRequestDetails');
//field officer routes

Route::get('/new-member-form','MemberIncludingController@newMemberForm');
Route::post('/add-member','MemberIncludingController@addMember');
Route::get('/savings-form','SavingsController@showForm');
Route::get('/new-savings','SavingsController@storeSavings');
Route::post('/get-member-by-id','SavingsController@memberById');
Route::post('/new-savings','SavingsController@storeMoney');
Route::get('/today-saving-collection','SavingsController@todaySavings');
Route::get('/edit-member-daily-savings/{slug}','SavingsController@editTodaySavings');
Route::post('/edit-savings','SavingsController@updateDailysavings');
//field officer routes-loan section
Route::get('/new-loan-form','LoanController@index');
Route::post('/get-nominee-by-id','LoanController@NomineeInfo');
Route::post('/create-loan','LoanController@createLoan');
