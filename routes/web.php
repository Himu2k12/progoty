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
Route::get('/events','WelcomeController@viewEvent');
Route::get('/contact','WelcomeController@viewContact');





Route::get('locale/{locale}',function ($locale){

    Session::put('locale',$locale);

   return redirect()->back();
});
Auth::routes();
//admin routs
Auth::routes(['register' => false]);
Route::get('/admin-dashboard','AdminController@ShowDashboard');
Route::get('/add-role','RoleController@viewRole');
Route::get('/inactive-members-for-cause/{slug}','AdminController@inactiveMember');
Route::get('/active-members-for-cause/{slug}','AdminController@activeMember');
Route::get('/all-closed-members','AdminController@closedMembers');
Route::get('/all-sheets','AdminController@viewSheets');
Route::get('/edit-sheet-again/{id}','AdminController@EditSheetInfo');
Route::get('/register-staffs','AdminController@RegisterStaffs');
Route::post('/new-staffs','AdminController@newStaffs');
Route::get('/inactive-staff/{id}', 'AdminController@inactiveStaffInfo');
Route::get('/active-staff/{id}', 'AdminController@activeStaffInfo');
Route::get('/edit-staff/{id}', 'AdminController@editStaffForm');
Route::post('/update-staff', 'AdminController@updateStaffInfo')->name('update-staff');

//Loan routes Admin
Route::get('/verify-loan-first-admin/{id}', 'AdminController@LoanApproveComment');
Route::post('/loan-final-verify', 'AdminController@LoanApprove');
Route::get('/ready-to-dispatch-loan-request-admin', 'AdminController@LoanReadytoDispatchbyAdmin');
Route::get('/edit-admin-consider-loan-amount/{slug}', 'AdminController@AdminLoanAmountEdit');
Route::post('/loan-final-update', 'AdminController@LoanSanctionUpdate');
Route::get('/approved-loans', 'AdminController@LoanApprovebyAdmin');
Route::get('/admin-cancel-loan/{slug}', 'AdminController@AdminLoanCancel');
Route::get('/admin-all-active-loans','AdminController@allLoansforAdmin');
Route::get('/transaction-loan-payment-view/{id}','AdminController@transactionById');
Route::post('/close-loan','AdminController@closeLoan');
Route::get('loan-statements','AdminController@loanStatement');
Route::get('savings-statements','AdminController@savingsStatement');
Route::get('submit-loan-statement','AdminController@searchLoan');
Route::get('submit-savings-statement','AdminController@searchSavings');



//Role routes for admin
Route::post('/new-role','RoleController@addRole');
Route::get('/inactive-role/{id}', 'RoleController@inactiveRoleInfo');
Route::get('/active-role/{id}', 'RoleController@activeRoleInfo');
Route::get('/edit-role/{id}', 'RoleController@editRoleInfo');
Route::post('/update-role', 'RoleController@updateRoleInfo');
Route::get('/scheme', 'AdminController@percentageform');
Route::get('inactive-percentage/{id}', 'AdminController@inactivePercentage');
Route::get('active-percentage/{id}', 'AdminController@activePercentage');
Route::post('/new-percent', 'AdminController@addPercent');


//Savings withdraw routes for Admin
Route::get('/savings-withdraw-request-by-supervisor', 'AdminController@SavingsWithdrawRequests');
Route::get('/approved-withdraws-admin', 'AdminController@ApprovedSavingsWithdrawRequests');
Route::get('/withdraw-history', 'AdminController@SavingsWithdrawHistory');
Route::get('/details-view-withdraw-request-admin/{id}', 'AdminController@viewSavingsDetails');
Route::get('/approve-for-despatch/{id}', 'AdminController@approveForDespatch');
//Route::get('/withdraw-history', 'AdminController@HistroyOfWithdraw');
Route::get('withdraw-despatched-details-id/{id}', 'AdminController@DetailsOfWithdraw');
Route::get('cancel-request-by-admin/{slug}','AdminController@CancelWithdrawRequest');



//Loan Routes for Supervisor
Route::get('/loan-request-admin', 'AdminController@loanRequestsAdmin');
Route::get('/details-loan-admin-view/{slug}', 'AdminController@detailsLoanPapers');



//supervisor routes

Route::get('/new-member-requests','SupervisorController@newMembers');
Route::get('/verify-members/{slug}','SupervisorController@confirmMember');
Route::get('/decline-members/{slug}','SupervisorController@DeclineMember');
Route::get('/verified-members','SupervisorController@verifiedMembers');
Route::get('/details-member-view/{slug}','SupervisorController@detailsView');
Route::get('/details-verified-member/{slug}','SupervisorController@VerifiedDetailsView');
Route::get('/daily-Collections','SupervisorController@AllDailyCollections');
Route::get('/today-all-collection/{id}','SupervisorController@DailyCollectionOfFieldofficer');
Route::get('/new-loan-request','SupervisorController@newLoanRequest');
Route::get('/details-loan-view/{slug}','SupervisorController@LoanRequestDetails');
Route::get('/view-loan-document-upload/{slug}','SupervisorController@SupervisorLoanVerification');
Route::post('/additional-loan-document','SupervisorController@UploadDocuments');
Route::get('/cancel-loan-by-supervisor/{slug}','SupervisorController@SupervisorLoanVerificationCancel');
Route::get('/new-loan-documents','SupervisorController@LoanDocuments');
Route::get('/download-loan-document/{slug}','SupervisorController@downloadDocument');
Route::get('/view-document/{slug}','SupervisorController@viewDoc');
Route::get('/edit-loan-documents/{slug}','SupervisorController@EditLoanDocumentForm');
Route::post('update-loan-document','SupervisorController@UpdateLoanDocumentForm');
Route::get('del-document/{id}','SupervisorController@deleteDocument');
Route::get('All-current-loans','SupervisorController@allActiveLoansforSupervisor');


//Supervisor Savings withdraw routes
Route::get('/withdraw-requests','SupervisorController@withdrawSavings');
Route::get('/withdraw-requests-by-id/{slug}','SupervisorController@WithdrawRequestDetails');
Route::get('/approve-request-by-supervisor/{slug}','SupervisorController@approveWithdrawRequest');
Route::get('/cancel-request-by-supervisor/{slug}','SupervisorController@CancelWithdrawRequest');
Route::post('/submit-to-super','SupervisorController@submitRequestToSuper');
Route::get('/pending-withdraw-requests','SupervisorController@viewSubmitedRequest');
Route::get('/edit-submit-requests-by-id/{id}','SupervisorController@editSubmittedRequest');
Route::post('/update-submit-to-super','SupervisorController@updateSubmittedRequest');



//supervisor Report issue routes
Route::get('/daily-all-Collections','SupervisorController@dailyAllCollection');
Route::post('/search-all-collection','SupervisorController@SearchAllCollection');
Route::get('print-supervisor-daily-all-collection','SupervisorController@printDailyReport');



//field officer routes
Route::get('/new-member-form','MemberIncludingController@newMemberForm');
Route::post('/add-member','MemberIncludingController@addMember');
Route::get('fieldOfficer-included-members','MemberIncludingController@allMembers');
Route::get('/edit-member-details/{slug}','MemberIncludingController@editMemberDetails');
Route::get('/member-details-info/{slug}','MemberIncludingController@detailsMemberView');
Route::post('/update-member','MemberIncludingController@UpdateMember');
Route::get('/savings-form','SavingsController@showForm');
//Route::get('/new-savings','SavingsController@storeSavings');
Route::post('/get-member-by-id','SavingsController@memberById');
Route::post('/new-savings','SavingsController@storeMoney');
Route::get('/today-saving-collection','SavingsController@todaySavings');
Route::get('/edit-member-daily-savings/{slug}','SavingsController@editTodaySavings');
Route::get('/delete-member-daily-savings/{slug}','SavingsController@deleteTodaySavings');
Route::post('/edit-savings','SavingsController@updateDailysavings');
Route::get('/edit-daily-loan-deposites/{slug}','SavingsController@editDailyLoanDeposite');
Route::get('/delete-daily-loan-deposites/{slug}','SavingsController@deleteDailyLoanDeposite');
Route::post('/update-daily-loan-deposites','SavingsController@updateDailyLoanDeposite');
Route::get('/withdraw-savings','SavingsController@savingsWithdrawForm');
Route::post('/get-withdraw-info-id','SavingsController@memberInfoForWithdraw');
Route::post('/withdraw-savings-account','SavingsController@SaveWithdrawInformation');

//fieldofficer savings routes


//field officer routes-loan section
Route::get('/collection-by-date','LoanController@viewInfo');
Route::get('/new-loan-form','LoanController@index');
Route::post('/get-nominee-by-id','LoanController@NomineeInfo');
Route::post('/create-loan','LoanController@createLoan');
Route::post('/get-amount-by-id','LoanController@getTotalAmountofApplicant');
Route::get('new-loan-by-customer','LoanController@newLoanView');
Route::get('all-loan-by-fieldofficer','LoanController@allActiveLoans');
Route::get('/edit-loan-info/{slug}','LoanController@EditFormForLoan');
Route::post('/update-loan','LoanController@UpdateLoanApplication');
Route::get('/loan-status-fieldOfficer','LoanController@LoanStatus');
Route::get('/loan-details/{slug}','LoanController@LoanDetails');
Route::get('/view-loan-info/{slug}','SavingsController@viewInfo');
Route::get('/collection-by-date','SavingsController@savingsByDate');
Route::post('/search-savings-history','SavingsController@searchSavings');
Route::get('/print-statement/{date}/{sheet}','SavingsController@printSavings');
Route::get('/print-by-date-statement/{date}','SavingsController@printByDateSavings');
Route::get('/print-by-sheet-statement/{sheet}','SavingsController@printBySheetSavings');




//CASHIER routes
Route::get('Cash-Panel','CashierController@dailyCollection');
Route::get('loan-for-dispatch','CashierController@dispatchRequest');
Route::get('dispatch-loan-form/{slug}','CashierController@dispatchForm');
Route::post('save-loan-dispatch','CashierController@saveDispatchInfo');
Route::get('/all-active-loans','CashierController@allLoans');
Route::get('all-time-loan','CashierController@AllLoanApplications');
Route::get('/daily-field-officer-collection','CashierController@todayCollection');
Route::get('/cashier-view-of-today-collection/{id}/{sheet}','CashierController@todayFieldofficerCollection');
Route::get('/cashier-daily-entry','CashierController@getCashierCollection');
Route::get('daily-collection-cashier','CashierController@CashierCollectionsData');
Route::get('daily-generate-pdf-for-cashier-collection','CashierController@CashierCollectionsGeneratePdf');

//Cashier Savings Routes
Route::get('despatch-savings-withdraw-money','CashierController@listOfSavingsDespatch');
Route::get('amount-despatched-to-field-officer/{id}','CashierController@despatchedToDelivery');
Route::post('/cash-final-despatch','CashierController@SaveDespatchSavings');
Route::get('despatched-savings-money','CashierController@AlreadyDespatched');
Route::get('cashier-receive-money','CashierController@receiveMoney');
Route::post('store-sheet-info','CashierController@StoreReceiveMoney')->name('store-sheet-info');
Route::get('cashier-edit-sheet/{slug}','CashierController@editSheetForm');
Route::post('cashier-update-sheet','CashierController@updateSheet')->name('update-sheet-info');

//Cashier Additional Cost routes
Route::get('/additional-cost-form', 'CashierController@viewAdditionalExpence');
Route::post('create-additional-cost', 'CashierController@createAdditionalCost')->name('create-additional-cost');
Route::get('edit-additional-cost/{id}', 'CashierController@editAdditionalCost');
Route::post('update-additional-cost', 'CashierController@UpdateAdditioanlCost')->name('update-additional-cost');

Route::get('additional-cost-category-form', 'CashierController@viewAdditionalCostcategory');
Route::post('create-cost-category-additional', 'CashierController@createCostCategory')->name('create-cost-category-additional');
Route::get('/inactive-cost-category/{id}', 'CashierController@inactiveCostCategory');
Route::get('/active-cost-category/{id}', 'CashierController@activeCostCategory');

//Cashier Additional Collection routes
Route::get('/all-received-collection', 'CashierController@CashierReceivedSheet');
Route::get('/additional-collection-form', 'CashierController@viewAdditionalCollection');
Route::get('additional-category-form', 'CashierController@viewAdditionalcategory');
Route::post('create-additional-collection', 'CashierController@createAdditionalCollection')->name('create-additional-collection');
Route::post('create-category-additional-collection', 'CashierController@createCategoryAdditionalCollection')->name('create-category-additional-collection');
Route::get('edit-additional-collection/{id}', 'CashierController@editAdditionalCollection');
Route::post('update-additional-collection', 'CashierController@UpdateAdditionalCollection')->name('update-additional-collection');
Route::get('/inactive-collection-category/{id}', 'CashierController@inactiveCollectionCategory');
Route::get('/active-collection-category/{id}', 'CashierController@activeCollectionCategory');
//IT Specialist routes
Route::get('/slider-input','HomeController@viewSliderForm');
Route::post('/new-slide','HomeController@newSlide');
Route::get('/inactive-slide/{id}','HomeController@inActiveSlider');
Route::get('/active-slide/{id}','HomeController@ActiveSlider');
Route::get('/inactive-about/{id}','HomeController@inActiveAbout');
Route::get('/active-about/{id}','HomeController@ActiveAbout');
Route::get('/edit-about/{id}','HomeController@editAbout');
Route::post('/update-about-content','HomeController@UpdateAbout');
Route::get('/all-staffs','HomeController@ViewAllstaffs');
Route::get('/new-staff-info/{id}','HomeController@viewFormNewStaff');
Route::post('/save-new-staff-details', 'HomeController@storeStaffInfo');
Route::post('/update-staff-details', 'HomeController@UpdateStaffInfo');
//Route::post('/new-staff-info','HomeController@saveInfo');
Route::get('pause-staff-info/{id}','HomeController@InactiveInfo');
Route::get('active-info-staff/{id}','HomeController@ActiveInfo');
//Route::get('edit-information-staff/{id}','HomeController@editInfo');
//Route::post('/update-staff-info','HomeController@updateInfo');
Route::get('/new-about-info','HomeController@viewAboutInfoForm');
Route::post('/store-about-content','HomeController@storeAboutContent');

//ROute for Event Create
Route::get('/all-event','HomeController@EventPage');
Route::post('/store-new-event','HomeController@NewEvent');
Route::get('/edit-event/{id}','HomeController@editEvent');
Route::post('/update-event','HomeController@UpdateEvent');



//ALl report routes starts from here

//Additional Cost routes
Route::get('Expense-reports', 'ReportController@ExpenseReports');
Route::get('daily-Expense-reports', 'ReportController@DailyExpenseReport');
Route::get('generate-pdf-for-Expense-reports', 'ReportController@PfdOfExpenseReports');
Route::get('daily-generate-pdf-for-Expense-reports', 'ReportController@PfdOfDailyExpenseReports');
//Additional Collection Routes
Route::get('Collection-reports', 'ReportController@CollectionReports');
Route::get('daily-collection-reports', 'ReportController@DailyCollectionReport');
Route::get('generate-pdf-for-collection-reports', 'ReportController@PfdOfCollectionReports');
Route::get('daily-generate-pdf-for-collection-reports', 'ReportController@PfdOfDailyCollectionReports');

//Savings collection Reports
Route::get('savings-report', 'ReportController@SavingsReports');
Route::get('daily-savings-reports', 'ReportController@DailySavingsReport');
Route::get('generate-pdf-for-savings-reports', 'ReportController@PfdOfSavingsReports');
Route::get('daily-generate-pdf-for-savings-reports', 'ReportController@PfdOfDailySavingsReports');

//Loan Dispatch Reports
Route::get('Loan-dispatch-report','ReportController@loanDispatch');
Route::get('daily-loan-dispatch-reports','ReportController@DailyLoanDispatch');
Route::get('generate-pdf-for-loan-dispatch','ReportController@LoanDispatchPdf');
Route::get('daily-generate-pdf-for-loan-dispatch','ReportController@DailyLoanDispatchPdf');
Route::get('show-dispatch-report','ReportController@viewloanDispatchReportForm');


//Loan collection Reports
Route::get('Loan-report', 'ReportController@LoanReports');
Route::get('daily-loan-reports', 'ReportController@DailyLoanReport');
Route::get('generate-pdf-for-loan-reports', 'ReportController@PfdOfLoanReports');
Route::get('generate-form/{slug}','ReportController@pdfGenerateApplicantForm');
Route::get('daily-generate-pdf-for-loan-reports', 'ReportController@PfdOfDailyLoanReports');
Route::get('generate-pdf-for-loan-statment', 'ReportController@PfdOfLoanStatement');
Route::get('generate-pdf-for-savings-statment', 'ReportController@PfdOfSavingsStatement');
Route::get('field-officers-statement', 'AdminController@FieldofficersStatement');
Route::get('field-officer-reports', 'AdminController@CreateNewReport');
Route::get('daily-field-officer-reports', 'AdminController@CreateDailyReport');
Route::get('generate-pdf-field-officer', 'ReportController@generatePDFFieldOfficer');
Route::get('daily-generate-pdf-field-officer', 'ReportController@generatePDFDailyFieldOfficer');
Route::get('sheet-report', 'AdminController@SheetReport');
Route::get('submit-sheet-reports', 'AdminController@SheetSubmitReport');
Route::post('generate-pdf-for-sheet', 'ReportController@pdfsheet');
