<?php

use App\Account;
use App\BusinessType;
use App\ExpenseCategory;
use App\Http\Controllers\taqneen\CustomerController;
use App\Http\Controllers\taqneen\CustomerFormController;
use App\Http\Controllers\taqneen\OpportunitController;
use App\Http\Controllers\taqneen\SubscriptionController;
use App\Http\Controllers\taqneen\UserController;
use App\ShippingFees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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
Route::get('customer-sub', function(){
    dd();
    $key = 'subscribe_masarat_model';
    $formStirng = json_encode(request()->form);
    return view('taqneen.customer_forms.subscribe_masarat_model'); 
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
        
    Auth::routes();
    Route::post('/register', 'taqneen\CustomerFormController@createAccount');
    
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
});

//Routes for authenticated users only
Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'CheckUserLogin'])->group(function () {
     
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
    Route::get('/customer-form/{form_name}', 'taqneen\CustomerFormController@create');
    Route::get('/customer-edit/{form_name}/{id}', 'taqneen\CustomerFormController@edit');
    Route::get('/customer-form/{form_name}/index', 'taqneen\CustomerFormController@index');
    Route::get('/notification-template', 'taqneen\NotificationTemplateController@index');
    Route::get('/notification-template/form', 'taqneen\NotificationTemplateController@form');
    Route::post('/notification-template', 'taqneen\NotificationTemplateController@save');
    Route::delete('/notification-template/{id}', 'taqneen\NotificationTemplateController@destroy');
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
    Route::post('subscriptions/save', 'taqneen\SubscriptionController@save');
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
 