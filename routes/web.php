<?php
 
use App\BusinessType;
use App\Forms\FormRouter;
use App\Http\Controllers\taqneen\CustomerController;
use App\Http\Controllers\taqneen\CustomerFormController;
use App\Http\Controllers\taqneen\OpportunitController;
use App\Http\Controllers\taqneen\SubscriptionController;
use App\Http\Controllers\taqneen\UserController; 
use App\User;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;





/*
|--------------------------------------------------------------------------
| Web Routes For Forms Package
|--------------------------------------------------------------------------
| 
|
*/
Route::any('/forms', function(){
    return FormRouter::getInstance()->load();
}); 



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




Route::get('reset_password', function(){
    $user = User::where('username', 'Demo-admin')->update([
        "password" => bcrypt("123456789")
    ]);

    echo 'done';
});

Route::get('/artisan', function(){
    Artisan::call(request()->artisan);
});

Route::get('/remove_notfound_img', function(){
    foreach(DB::table('media')->get() as $item) {
        $filename = public_path("/uploads/media/" . $item->file_name);
        if (!file_exists($filename)) {
            DB::table('media')->where('id', $item->id)->delete();
        }
    }

    echo "done";
});
include_once('install_r.php');

Route::post('/test_error', function(){
    return view("auth.new_register");
});
Route::get('/test_register', function(){
    return view("auth.new_register");
});

Route::get('/test_data', function(){ 
    //ExpenseCategory::loadExpensesTypes(request()->session()->get('user.business_id'));
    //Account::loadChartAccounts(request()->session()->get('user.business_id'));
    BusinessType::loadBusinessTypePermissions();
    echo "done";
});

Route::get('test/{action}', 'TestController');

Route::get('/migrate', function(){
    Artisan::call('migrate');
});

Route::middleware(['setData'])->group(function () {
    Route::get('subscriptions/print/{id}', 'taqneen\SubscriptionController@print'); 
    Route::get('/customer-pdf/{id}', 'taqneen\CustomerFormController@viewPdfApi');
    Route::get('/customer-pdf-download/{id}', 'taqneen\CustomerFormController@downloadPdfApi');
    Route::get('/customer-pdf-viewer', 'taqneen\CustomerFormController@pdfViewer');
    Route::post('/customer-pdf-viewer', 'taqneen\CustomerFormController@pdfViewer');
        
    Auth::routes();
    Route::post('/register', 'taqneen\CustomerFormController@createAccount');

    Route::get('support/guest/tickets/create', 'taqneen\TicketController@createGuestTicket')->name('tickets.guest.create');
    Route::post('support/guest/tickets/create', 'taqneen\TicketController@store')->name('tickets.guest.create');
    Route::get('support/guest/tickets/reply/{id}', 'taqneen\TicketController@getGuestReply')->name('tickets.guest.reply');
    Route::post('support/guest/tickets/reply/{id}', 'taqneen\TicketReplyController@storeGuestReply')->name('tickets.guest.reply');
    Route::get('tickets/reply/download/files/{id}','taqneen\TicketReplyController@downloadTicketReplyFiles')->name('tickets.guest.reply.download.files');


    Route::get('/quick_access', function()
    {
        return view('auth.quick_register');
    });
    Route::post('/quick_access', 'taqneen\CustomerFormController@quickAccessAccount');
    
    Route::get('/verify-email', "UserController@verifyEmail");
    Route::get('/verify', 'BusinessController@verfiy')->name('business.verfiy');
    Route::post('/verify', 'BusinessController@postVerfiy')->name('business.postverfiy');
    Route::get('/email-verify', 'BusinessController@emailVerfiy');

    Route::post('/sign-google', 'BusinessController@signwithGoogle')->name('business.signWithGoogle');

    Route::get('/business/register', 'BusinessController@getRegister')->name('business.getRegister');
    Route::post('/business/register', 'BusinessController@postRegister')->name('business.postRegister');
    Route::post('/business/register/check-username', 'BusinessController@postCheckUsername')->name('business.postCheckUsername');
    Route::post('/business/register/check-email', 'BusinessController@postCheckEmail')->name('business.postCheckEmail');


    Route::get('/quote/{token}', 'SellPosController@showInvoice')
        ->name('show_quote');

    
    Route::get('/customer-form/{key}', 'taqneen\CustomerFormController@create');
    Route::get('/customer-form-pdf/{key}', 'taqneen\CustomerFormController@viewFinalPage');
    Route::post('/customer-form-upload', 'taqneen\CustomerFormController@uploadPdf');
});

//Routes for authenticated users only
Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin'])->group(function () {


    Route::get('/select2-autocomplete-ajax', 'taqneen\Select2AutoCompeleteController@dataAjax');

    // customer forms
    
    Route::get('/customer-form-index/{key}', 'taqneen\CustomerFormController@index');
    Route::post('/customer-form', 'taqneen\CustomerFormController@save');
    Route::get('/customer-form/edit/{id}', 'taqneen\CustomerFormController@edit');
    Route::delete('/customer-form/{id}', 'taqneen\CustomerFormController@destroy');



    Route::get('/', 'taqneen\MainDashboardController@index');
    Route::get('/home', 'taqneen\MainDashboardController@index');
    Route::get('/courier', 'taqneen\CourierDashboardController@index');
    // Route::get('/', 'HomeController@index');
    
    Route::get('/subscription-api', 'taqneen\MainDashboardController@getTotalSubscription');
    Route::get('/', 'taqneen\MainDashboardController@index');
    //Route::get('/', 'HomeController@index');
    Route::get('/taqneen-calendar', 'taqneen\CalendarController@index');
    Route::get('/taqneen-calendar-api', 'taqneen\CalendarController@get');
    Route::get('/support', 'HomeController@support');
    Route::get('/ticket', 'taqneen\MainDashboardController@ticket');
    Route::resource('services', 'taqneen\ServiceController');
    Route::resource('customers', 'taqneen\CustomerController');
    Route::get('download',[CustomerController::class,'download']);
    Route::post('upload_file',[CustomerController::class,'importFile']);
    Route::get('profile/{id}',[CustomerController::class,'show'])->name('profile.show');
    Route::resource('userstaq', 'taqneen\UserController'); 
    Route::get('user-profile',[UserController::class,'show'])->name('user-profile.show');
    Route::put('user-profile-update',[UserController::class,'updateProfile'])->name('user-profile-update.updateProfile');

    Route::resource('opportunities', 'taqneen\OpportunitController'); 
    Route::get('opportunit-download',[OpportunitController::class,'opportunitDownload']);
    Route::post('opportunit-upload_file',[OpportunitController::class,'opportunitImportFile']);
    Route::get('take-opportunity/{id}','taqneen\OpportunitController@takeOppotunity');
    Route::resource('packages', 'taqneen\PackageController'); 
    Route::resource('categories', 'taqneen\ExpensesCategoryController'); 
    Route::resource('taxs', 'taqneen\TaxsController'); 
    Route::resource('role', 'taqneen\RoleController'); 
    Route::resource('subscriptions', 'taqneen\SubscriptionController'); 
    Route::get('subscriptions-download',[SubscriptionController::class,'subscriptionDownload']);
    Route::post('subscriptions-upload_file',[SubscriptionController::class,'subscriptionImportFile']);
    Route::get('/notification-template', 'taqneen\NotificationTemplateController@index');
    Route::get('/notification-template/form', 'taqneen\NotificationTemplateController@form');
    Route::post('/notification-template', 'taqneen\NotificationTemplateController@save');
    Route::delete('/notification-template/{id}', 'taqneen\NotificationTemplateController@destroy');
    Route::get('subscriptions-delete/{id}',[SubscriptionController::class,'destroy']);

    Route::group(['prefix'=>'support'],function (){

        Route::get('tickets','taqneen\TicketController@index')->name('tickets');
        Route::get('tickets/create', 'taqneen\TicketController@create')->name('tickets.create');
        Route::get('tickets/show/{id}', 'taqneen\TicketController@show')->name('tickets.show');
        Route::get('tickets/{ticket_id}/status/change/{status_id}', 'taqneen\TicketController@changeTicketStatus')->name('tickets.status.change');
        Route::post('tickets/create', 'taqneen\TicketController@store')->name('tickets.store');
        Route::get('tickets/edit/{id}', 'taqneen\TicketController@edit')->name('tickets.edit');
        Route::post('tickets/edit/{id}', 'taqneen\TicketController@update')->name('tickets.update');
        Route::post('tickets/delete/{id}', 'taqneen\TicketController@delete')->name('tickets.delete');
        Route::post('tickets/change/user', 'taqneen\TicketController@changeTicketUser')->name('tickets.changeTicketUser');
        Route::get('tickets/print/{id}', 'taqneen\TicketController@printTicket')->name('tickets.print');
        Route::get('tickets/files/download/{id}', 'taqneen\TicketController@downloadTicketFiles')->name('tickets.files.download');

//        ticket replies
        Route::post('tickets/reply','taqneen\TicketReplyController@store')->name('tickets.reply.store');
        Route::get('tickets/reply/download/files/{id}','taqneen\TicketReplyController@downloadTicketReplyFiles')->name('tickets.reply.download.files');
        Route::delete('tickets/reply/delete/{id}','taqneen\TicketReplyController@delete')->name('tickets.reply.delete');
        Route::delete('tickets/reply/edit/{id}','taqneen\TicketReplyController@delete')->name('tickets.reply.edit');

        Route::get('canned-reply','taqneen\CannedReplyController@index')->name('canned-reply');
        Route::get('canned-reply/create', 'taqneen\CannedReplyController@create')->name('canned-reply.create');
        Route::post('canned-reply/create', 'taqneen\CannedReplyController@store')->name('canned-reply.store');
        Route::get('canned-reply/edit/{id}', 'taqneen\CannedReplyController@edit')->name('canned-reply.edit');
        Route::post('canned-reply/edit/{id}', 'taqneen\CannedReplyController@update')->name('canned-reply.update');
        Route::delete('canned-reply/delete/{id}', 'taqneen\CannedReplyController@delete')->name('canned-reply.delete');


        Route::get('/ticket/priorities','taqneen\TicketPriorityController@index')->name('tickets.priorities');
        Route::get('ticket/priorities/create', 'taqneen\TicketPriorityController@create')->name('tickets.priorities.create');
        Route::post('ticket/priorities/create', 'taqneen\TicketPriorityController@store')->name('tickets.priorities.store');
        Route::get('ticket/priorities/edit/{id}', 'taqneen\TicketPriorityController@edit')->name('tickets.priorities.edit');
        Route::post('ticket/priorities/edit/{id}', 'taqneen\TicketPriorityController@update')->name('tickets.priorities.update');
        Route::delete('ticket/priorities/delete/{id}', 'taqneen\TicketPriorityController@delete')->name('tickets.priorities.delete');


        Route::get('/ticket/statues','taqneen\TicketStatusController@index')->name('tickets.statues');
        Route::get('ticket/statues/create', 'taqneen\TicketStatusController@create')->name('tickets.statues.create');
        Route::post('ticket/statues/create', 'taqneen\TicketStatusController@store')->name('tickets.statues.store');
        Route::get('ticket/statues/edit/{id}', 'taqneen\TicketStatusController@edit')->name('tickets.statues.edit');
        Route::post('ticket/statues/edit/{id}', 'taqneen\TicketStatusController@update')->name('tickets.statues.update');
        Route::delete('ticket/statues/delete/{id}', 'taqneen\TicketStatusController@delete')->name('tickets.statues.delete');


        Route::get('ticket/departments','taqneen\TicketDepartmentController@index')->name('tickets.departments');
        Route::get('ticket/departments/create', 'taqneen\TicketDepartmentController@create')->name('tickets.departments.create');
        Route::post('ticket/departments/create', 'taqneen\TicketDepartmentController@store')->name('tickets.departments.store');
        Route::get('ticket/departments/edit/{id}', 'taqneen\TicketDepartmentController@edit')->name('tickets.departments.edit');
        Route::post('ticket/departments/edit/{id}', 'taqneen\TicketDepartmentController@update')->name('tickets.departments.update');
        Route::post('ticket/departments/delete/{id}', 'taqneen\TicketDepartmentController@delete')->name('tickets.departments.delete');

        Route::get('department/users','taqneen\DepartmentUserController@index')->name('department.users');
        Route::get('department/users/create', 'taqneen\DepartmentUserController@create')->name('department.users.create');
        Route::post('department/users/create', 'taqneen\DepartmentUserController@store')->name('department.users.store');
        Route::get('department/users/edit/{id}', 'taqneen\DepartmentUserController@edit')->name('department.users.edit');
        Route::post('departments/edit/{id}', 'taqneen\DepartmentUserController@update')->name('department.users.update');
        Route::get('main/department/users/stop/{id}', 'taqneen\DepartmentUserController@deactivateAll')->name('main.department.users.stop');
        Route::get('main/department/users/active/{id}', 'taqneen\DepartmentUserController@activateAll')->name('main.department.users.active');
        Route::get('department/users/stop/{id}', 'taqneen\DepartmentUserController@status')->name('department.users.stop');
        Route::delete('main/department/users/delete/{id}', 'taqneen\DepartmentUserController@delateAllForDepartment')->name('main.department.users.delete');
        Route::delete('department/users/delete/{id}', 'taqneen\DepartmentUserController@delete')->name('department.users.delete');


    });
/*
    Route::get('customerForm/createcustomermasarat', [CustomerFormController::class,'createCustomerMasarat']);
    Route::get('customerForm/createcustomermuqeem', [CustomerFormController::class,'createCustomerMuqeem']);
    Route::get('customerForm/createcustomernaba', [CustomerFormController::class,'createCustomerNaba']);
    Route::get('customerForm/createcustomershomoos', [CustomerFormController::class,'createCustomerShomoos']);
    Route::get('customerForm/createcustomertamm', [CustomerFormController::class,'createCustomerTamm']);
*/
    Route::post('customerForm/createCustomerMasarat', [CustomerFormController::class,'save'])->name('createCustomerMasarat.store'); 
    Route::post('customerForm/createcustomermuqeem', [CustomerFormController::class,'save'])->name('createCustomerMuqeem.store'); 
    Route::post('customerForm/createcustomernaba', [CustomerFormController::class,'save'])->name('createcustomernaba.store'); 
    Route::post('customerForm/createcustomershomoos', [CustomerFormController::class,'save'])->name('createcustomershomoos.store'); 
    Route::post('customerForm/createcustomertamm', [CustomerFormController::class,'save'])->name('createcustomertamm.store'); 
    
    Route::get('reports/services', 'taqneen\ReportController@services');
    Route::get('reports/sales-commissions', 'taqneen\ReportController@salesComissions');
    Route::get('reports/subscriptions', 'taqneen\ReportController@subscriptions');
    Route::get('subscriptions-data', 'taqneen\SubscriptionController@data');
    Route::post('subscriptions/save', 'taqneen\SubscriptionController@save');
    Route::get('subscriptions-export', 'taqneen\SubscriptionController@export');
    Route::post('subscriptions/customer-api', 'taqneen\SubscriptionController@customerApi');
    Route::post('subscriptions/add-note/{id}', 'taqneen\SubscriptionController@addNote');
    Route::post('subscriptions/renew/{id}', 'taqneen\SubscriptionController@renew');
    Route::delete('subscriptions/delete-media/{id}', 'taqneen\SubscriptionController@deleteMedia');
    
    Route::resource('languages', 'LanguageController');
    Route::resource('translations', 'TransController');
    Route::post('translations/copy', 'TransController@copy');

    Route::get('/settings', 'BusinessController@settings')->name('settings.page');
    
    // translation routes
    Route::get('/trans', "TranslationController@index");
    Route::get('/trans/get', "TranslationController@get");
    Route::post('/trans/update', "TranslationController@update");

 
    //Backup
    Route::get('backup/download/{file_name}', 'BackUpController@download');
    Route::get('backup/delete/{file_name}', 'BackUpController@delete');
    Route::resource('backup', 'BackUpController', ['only' => [
        'index', 'create', 'store'
    ]]);
 
});


Route::middleware(['EcomApi'])->prefix('api/ecom')->group(function () {
    Route::get('products/{id?}', 'ProductController@getProductsApi');
    Route::get('categories', 'CategoryController@getCategoriesApi');
    Route::get('brands', 'BrandController@getBrandsApi');
    Route::post('customers', 'ContactController@postCustomersApi');
    Route::get('settings', 'BusinessController@getEcomSettings');
    Route::get('variations', 'ProductController@getVariationsApi');
    Route::post('orders', 'SellPosController@placeOrdersApi');
});

//common route
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
