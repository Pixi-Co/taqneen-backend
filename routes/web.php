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
use App\System;
use App\User;
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
Route::get('test_system', function(){
    /*System::truncate();
    $systems = array(
        array('id' => '1','key' => 'db_version','value' => '3.7'),
        array('id' => '2','key' => 'default_business_active_status','value' => '1'),
        array('id' => '3','key' => 'superadmin_version','value' => '2.6'),
        array('id' => '4','key' => 'app_currency_id','value' => '35'),
        array('id' => '5','key' => 'invoice_business_name','value' => 'vauxerp'),
        array('id' => '6','key' => 'invoice_business_landmark','value' => 'Faten Hamama cinema'),
        array('id' => '7','key' => 'invoice_business_zip','value' => '12511'),
        array('id' => '8','key' => 'invoice_business_state','value' => 'Al-Manyal'),
        array('id' => '9','key' => 'invoice_business_city','value' => 'Cairo'),
        array('id' => '10','key' => 'invoice_business_country','value' => 'Egaypt'),
        array('id' => '11','key' => 'email','value' => 'superadmin@example.com'),
        array('id' => '12','key' => 'package_expiry_alert_days','value' => '5'),
        array('id' => '13','key' => 'enable_business_based_username','value' => '1'),
        array('id' => '14','key' => 'repair_version','value' => '0.9'),
        array('id' => '15','key' => 'woocommerce_version','value' => '2.7'),
        array('id' => '16','key' => 'crm_version','value' => '1.0'),
        array('id' => '17','key' => 'superadmin_register_tc','value' => NULL),
        array('id' => '18','key' => 'welcome_email_subject','value' => NULL),
        array('id' => '19','key' => 'welcome_email_body','value' => NULL),
        array('id' => '20','key' => 'additional_js','value' => NULL),
        array('id' => '21','key' => 'additional_css','value' => NULL),
        array('id' => '22','key' => 'offline_payment_details','value' => NULL),
        array('id' => '23','key' => 'superadmin_enable_register_tc','value' => '0'),
        array('id' => '24','key' => 'allow_email_settings_to_businesses','value' => '0'),
        array('id' => '25','key' => 'enable_new_business_registration_notification','value' => '0'),
        array('id' => '26','key' => 'enable_new_subscription_notification','value' => '0'),
        array('id' => '27','key' => 'enable_welcome_email','value' => '0'),
        array('id' => '28','key' => 'enable_offline_payment','value' => '1'),
        array('id' => '29','key' => 'essentials_version','value' => '2.5'),
        array('id' => '30','key' => 'manufacturing_version','value' => '2.2'),
        array('id' => '31','key' => 'project_version','value' => '1.6'),
        array('id' => '34','key' => 'subscribe_masarat_model','value' => '"{\\"company_num\\":{\\"top\\":\\"249px\\",\\"left\\":\\"617px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"16px\\",\\"letterSpacing\\":\\"5.6px\\",\\"dataValue\\":\\"1234567898\\",\\"replace\\":\\"\\"},\\"commercial_number\\":{\\"top\\":\\"250px\\",\\"left\\":\\"328px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"6.4px\\",\\"dataValue\\":\\"1234567892\\",\\"replace\\":\\"\\"},\\"release_date\\":{\\"top\\":\\"249px\\",\\"left\\":\\"506px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"release_date\\",\\"replace\\":\\"\\"},\\"end_date\\":{\\"top\\":\\"249px\\",\\"left\\":\\"169px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"end_date\\",\\"replace\\":\\"\\"},\\"fullname_ar\\":{\\"top\\":\\"286px\\",\\"left\\":\\"563px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"\\u0639\\u0644\\u0649 \\u0641\\u0631\\u062c \\u0645\\u062d\\u0645\\u062f\\",\\"replace\\":\\"\\"},\\"fullname_en\\":{\\"top\\":\\"288px\\",\\"left\\":\\"334px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"fullname_en\\",\\"replace\\":\\"\\"},\\"name_ar\\":{\\"top\\":\\"286px\\",\\"left\\":\\"240px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_ar\\",\\"replace\\":\\"\\"},\\"name_en\\":{\\"top\\":\\"288px\\",\\"left\\":\\"115px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_en\\",\\"replace\\":\\"\\"},\\"city\\":{\\"top\\":\\"357px\\",\\"left\\":\\"696px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"city\\",\\"replace\\":\\"\\"},\\"mailbox\\":{\\"top\\":\\"359px\\",\\"left\\":\\"574px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mailbox\\",\\"replace\\":\\"\\"},\\"postcode\\":{\\"top\\":\\"359px\\",\\"left\\":\\"419px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"postcode\\",\\"replace\\":\\"\\"},\\"compony_phone\\":{\\"top\\":\\"359px\\",\\"left\\":\\"302px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"com_phone\\",\\"replace\\":\\"\\"},\\"fax_num\\":{\\"top\\":\\"359px\\",\\"left\\":\\"196px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"fax_num\\",\\"replace\\":\\"\\"},\\"company_website\\":{\\"top\\":\\"360px\\",\\"left\\":\\"67px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"12px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"taqneen.com\\",\\"replace\\":\\"\\"},\\"owner_name\\":{\\"top\\":\\"429px\\",\\"left\\":\\"648px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_name\\",\\"replace\\":\\"\\"},\\"owner_number\\":{\\"top\\":\\"432px\\",\\"left\\":\\"497px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_number\\",\\"replace\\":\\"\\"},\\"owner_phone\\":{\\"top\\":\\"430px\\",\\"left\\":\\"367px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_phone\\",\\"replace\\":\\"\\"},\\"company_email\\":{\\"top\\":\\"436px\\",\\"left\\":\\"205px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"9px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"alifaragmhamed@gmail.com\\",\\"replace\\":\\"\\"},\\"identity\\":{\\"top\\":\\"431px\\",\\"left\\":\\"70px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"identity\\",\\"replace\\":\\"\\"},\\"select_service_1\\":{\\"top\\":\\"558px\\",\\"left\\":\\"744.975px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"select_service_2\\":{\\"top\\":\\"578px\\",\\"left\\":\\"745px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"c\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"select_service_3\\":{\\"top\\":\\"597px\\",\\"left\\":\\"745px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"c\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"}}"'),
        array('id' => '35','key' => 'subscribe_muqeem_model','value' => '"{\\"choice\\":{\\"top\\":\\"63px\\",\\"left\\":\\"356px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"choice\\",\\"replace\\":\\"\\"},\\"company_num\\":{\\"top\\":\\"242px\\",\\"left\\":\\"393px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"16px\\",\\"letterSpacing\\":\\"8px\\",\\"dataValue\\":\\"1236547895\\",\\"replace\\":\\"\\"},\\"name_ar\\":{\\"top\\":\\"281px\\",\\"left\\":\\"331px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_ar\\",\\"replace\\":\\"\\"},\\"name_en\\":{\\"top\\":\\"616px\\",\\"left\\":\\"-160px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_en\\",\\"replace\\":\\"\\"},\\"city\\":{\\"top\\":\\"77px\\",\\"left\\":\\"-150px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"city\\",\\"replace\\":\\"\\"},\\"phone\\":{\\"top\\":\\"371px\\",\\"left\\":\\"195px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"phone\\",\\"replace\\":\\"\\"},\\"mailbox\\":{\\"top\\":\\"110px\\",\\"left\\":\\"-152px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mailbox\\",\\"replace\\":\\"\\"},\\"postcode\\":{\\"top\\":\\"142px\\",\\"left\\":\\"-150px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"postcode\\",\\"replace\\":\\"\\"},\\"hr_name\\":{\\"top\\":\\"175px\\",\\"left\\":\\"-151px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"hr_name\\",\\"replace\\":\\"\\"},\\"mobile_num\\":{\\"top\\":\\"213px\\",\\"left\\":\\"-158px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mobile_num\\",\\"replace\\":\\"\\"},\\"email\\":{\\"top\\":\\"376px\\",\\"left\\":\\"57px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"9px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"alifaragmahmed@gmail.com\\",\\"replace\\":\\"\\"},\\"phone_notfic\\":{\\"top\\":\\"236px\\",\\"left\\":\\"-208px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"phone_notfic\\",\\"replace\\":\\"\\"},\\"mail_notific\\":{\\"top\\":\\"280px\\",\\"left\\":\\"-228px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mail_notific\\",\\"replace\\":\\"\\"},\\"commercial_number\\":{\\"top\\":\\"324px\\",\\"left\\":\\"-226px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"commercial_number\\",\\"replace\\":\\"\\"},\\"release_date\\":{\\"top\\":\\"356px\\",\\"left\\":\\"-159px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"release_date\\",\\"replace\\":\\"\\"},\\"manager_name\\":{\\"top\\":\\"389px\\",\\"left\\":\\"-160px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"manager_name\\",\\"replace\\":\\"\\"},\\"manager_phone\\":{\\"top\\":\\"418px\\",\\"left\\":\\"-157px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"manager_phone\\",\\"replace\\":\\"\\"},\\"user_name\\":{\\"top\\":\\"448px\\",\\"left\\":\\"-153px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name\\",\\"replace\\":\\"\\"},\\"id_number\\":{\\"top\\":\\"482px\\",\\"left\\":\\"-157px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"id_number\\",\\"replace\\":\\"\\"},\\"user_phone\\":{\\"top\\":\\"514px\\",\\"left\\":\\"-152px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_phone\\",\\"replace\\":\\"\\"},\\"user_mail\\":{\\"top\\":\\"543px\\",\\"left\\":\\"-154px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_mail\\",\\"replace\\":\\"\\"},\\"&#039;name&#039;\\":{\\"top\\":\\"727px\\",\\"left\\":\\"483px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"&#039;name&#039;\\",\\"replace\\":\\"\\"},\\"&#039;position&#039;\\":{\\"top\\":\\"724px\\",\\"left\\":\\"133px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"&#039;position&#039;\\",\\"replace\\":\\"\\"},\\"&#039;delegate_name&#039;\\":{\\"top\\":\\"582px\\",\\"left\\":\\"-166px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"&#039;delegate_name&#039;\\",\\"replace\\":\\"\\"}}"'),
        array('id' => '36','key' => 'subscribe_naba_model','value' => '"{\\"portal_naba\\":{\\"top\\":\\"67px\\",\\"left\\":\\"-74px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"c\\",\\"replace\\":\\"|c\\"},\\"pc_num\\":{\\"top\\":\\"168.988px\\",\\"left\\":\\"70px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"17px\\",\\"letterSpacing\\":\\"10.5px\\",\\"dataValue\\":\\"1236547896\\",\\"replace\\":\\"\\"},\\"name_ar\\":{\\"top\\":\\"169px\\",\\"left\\":\\"378px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_ar\\",\\"replace\\":\\"\\"},\\"name_en\\":{\\"top\\":\\"190px\\",\\"left\\":\\"377px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_en\\",\\"replace\\":\\"\\"},\\"city\\":{\\"top\\":\\"209.988px\\",\\"left\\":\\"376px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"city\\",\\"replace\\":\\"\\"},\\"owner_phone\\":{\\"top\\":\\"210px\\",\\"left\\":\\"70px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_phone\\",\\"replace\\":\\"\\"},\\"company_website\\":{\\"top\\":\\"230px\\",\\"left\\":\\"375px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"company_website\\",\\"replace\\":\\"\\"},\\"company_email\\":{\\"top\\":\\"250px\\",\\"left\\":\\"375px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"company_email\\",\\"replace\\":\\"\\"},\\"owner_name\\":{\\"top\\":\\"188.987px\\",\\"left\\":\\"71px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_name\\",\\"replace\\":\\"\\"},\\"commercial_number\\":{\\"top\\":\\"231px\\",\\"left\\":\\"70px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"17px\\",\\"letterSpacing\\":\\"10.5px\\",\\"dataValue\\":\\"3214569876\\",\\"replace\\":\\"\\"},\\"end_date\\":{\\"top\\":\\"250.966px\\",\\"left\\":\\"131px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"4px\\",\\"dataValue\\":\\"20-10-2020\\",\\"replace\\":\\"-| \\"},\\"building_num\\":{\\"top\\":\\"286px\\",\\"left\\":\\"539px\\",\\"width\\":\\"40px\\",\\"fontSize\\":\\"14px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"156\\",\\"replace\\":\\"\\"},\\"street\\":{\\"top\\":\\"284px\\",\\"left\\":\\"444px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"street\\",\\"replace\\":\\"\\"},\\"district\\":{\\"top\\":\\"284px\\",\\"left\\":\\"351px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"district\\",\\"replace\\":\\"\\"},\\"postal_code\\":{\\"top\\":\\"284px\\",\\"left\\":\\"162px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"postal_code\\",\\"replace\\":\\"\\"},\\"leader_name\\":{\\"top\\":\\"326px\\",\\"left\\":\\"473px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"leader_name\\",\\"replace\\":\\"\\"},\\"leader_idenitiy\\":{\\"top\\":\\"326px\\",\\"left\\":\\"80px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"17px\\",\\"letterSpacing\\":\\"21px\\",\\"dataValue\\":\\"1234568965\\",\\"replace\\":\\"\\"},\\"leader_phone\\":{\\"top\\":\\"346px\\",\\"left\\":\\"474px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"leader_phone\\",\\"replace\\":\\"\\"},\\"leader_phone2\\":{\\"top\\":\\"346px\\",\\"left\\":\\"72px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"leader_phone2\\",\\"replace\\":\\"\\"},\\"leader_email\\":{\\"top\\":\\"365px\\",\\"left\\":\\"351px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"leader_email\\",\\"replace\\":\\"\\"},\\"user_name\\":{\\"top\\":\\"407px\\",\\"left\\":\\"472px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name\\",\\"replace\\":\\"\\"},\\"user_idenitiy\\":{\\"top\\":\\"409px\\",\\"left\\":\\"78px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"17px\\",\\"letterSpacing\\":\\"21px\\",\\"dataValue\\":\\"3698527415\\",\\"replace\\":\\"\\"},\\"user_phone\\":{\\"top\\":\\"429px\\",\\"left\\":\\"472px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_phone\\",\\"replace\\":\\"\\"},\\"user_phone2\\":{\\"top\\":\\"430px\\",\\"left\\":\\"72px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_phone2\\",\\"replace\\":\\"\\"},\\"user_email\\":{\\"top\\":\\"450px\\",\\"left\\":\\"352px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_email\\",\\"replace\\":\\"\\"},\\"sub_represent_name\\":{\\"top\\":\\"512px\\",\\"left\\":\\"409px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"sub_represent_name\\",\\"replace\\":\\"\\"},\\"sub_represent_idenitiy\\":{\\"top\\":\\"512px\\",\\"left\\":\\"109px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"17px\\",\\"letterSpacing\\":\\"13px\\",\\"dataValue\\":\\"9874563698\\",\\"replace\\":\\"\\"},\\"sub_represent_phone\\":{\\"top\\":\\"534px\\",\\"left\\":\\"407px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"sub_represent_phone\\",\\"replace\\":\\"\\"},\\"sub_represent_phone2\\":{\\"top\\":\\"533px\\",\\"left\\":\\"68px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"sub_represent_phone2\\",\\"replace\\":\\"\\"},\\"sub_represent_email\\":{\\"top\\":\\"549px\\",\\"left\\":\\"348px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"sub_represent_email\\",\\"replace\\":\\"\\"},\\"sub_type\\":{\\"top\\":\\"591px\\",\\"left\\":\\"70px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"sub_type\\",\\"replace\\":\\"\\"},\\"cost_data\\":{\\"top\\":\\"611px\\",\\"left\\":\\"69px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"cost_data\\",\\"replace\\":\\"\\"},\\"reason\\":{\\"top\\":\\"652px\\",\\"left\\":\\"346px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"reason\\",\\"replace\\":\\"\\"},\\"portal_naba_1\\":{\\"top\\":\\"118.963px\\",\\"left\\":\\"658.987px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"0| ,1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"portal_naba_2\\":{\\"top\\":\\"120.988px\\",\\"left\\":\\"585.987px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"0| ,1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"}}"'),
        array('id' => '37','key' => 'subscribe_shomoos_model','value' => '"{\\"company_name\\":{\\"top\\":\\"194.987px\\",\\"left\\":\\"261px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"company_name\\",\\"replace\\":\\"\\"},\\"activity_type\\":{\\"top\\":\\"196px\\",\\"left\\":\\"55px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"activity_type\\",\\"replace\\":\\"\\"},\\"owner_name\\":{\\"top\\":\\"229px\\",\\"left\\":\\"449px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_name\\",\\"replace\\":\\"\\"},\\"owner_identifi\\":{\\"top\\":\\"231px\\",\\"left\\":\\"260px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_identifi\\",\\"replace\\":\\"\\"},\\"owner_phone\\":{\\"top\\":\\"228px\\",\\"left\\":\\"51px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_phone\\",\\"replace\\":\\"\\"},\\"city\\":{\\"top\\":\\"258px\\",\\"left\\":\\"450px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"city\\",\\"replace\\":\\"\\"},\\"neighborhood_name\\":{\\"top\\":\\"258px\\",\\"left\\":\\"258.989px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"neighborhood_name\\",\\"replace\\":\\"\\"},\\"street_name\\":{\\"top\\":\\"259px\\",\\"left\\":\\"53px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"street_name\\",\\"replace\\":\\"\\"},\\"addrees\\":{\\"top\\":\\"289px\\",\\"left\\":\\"448px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"addrees\\",\\"replace\\":\\"\\"},\\"enterprise_phone\\":{\\"top\\":\\"290px\\",\\"left\\":\\"261px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"enterprise_phone\\",\\"replace\\":\\"\\"},\\"enterprise_fax\\":{\\"top\\":\\"289px\\",\\"left\\":\\"52px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"enterprise_fax\\",\\"replace\\":\\"\\"},\\"enterprise_email\\":{\\"top\\":\\"320px\\",\\"left\\":\\"446px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"alifaragmahmed@gmail.com\\",\\"replace\\":\\"\\"},\\"mailbox\\":{\\"top\\":\\"318px\\",\\"left\\":\\"261px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mailbox\\",\\"replace\\":\\"\\"},\\"postcode\\":{\\"top\\":\\"320px\\",\\"left\\":\\"51.9886px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"postcode\\",\\"replace\\":\\"\\"},\\"user_name\\":{\\"top\\":\\"380px\\",\\"left\\":\\"446px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name\\",\\"replace\\":\\"\\"},\\"user_identifi\\":{\\"top\\":\\"378px\\",\\"left\\":\\"53px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_identifi\\",\\"replace\\":\\"\\"},\\"user_email\\":{\\"top\\":\\"412px\\",\\"left\\":\\"445.989px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_email\\",\\"replace\\":\\"\\"},\\"id_type\\":{\\"top\\":\\"423px\\",\\"left\\":\\"-244px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"id_type\\",\\"replace\\":\\"\\"},\\"user_phone\\":{\\"top\\":\\"411px\\",\\"left\\":\\"53px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_phone\\",\\"replace\\":\\"\\"},\\"subscription_date\\":{\\"top\\":\\"485px\\",\\"left\\":\\"81.9886px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"18px\\",\\"letterSpacing\\":\\"5px\\",\\"dataValue\\":\\"04-04-2022\\",\\"replace\\":\\"-| \\"},\\"delegate_name\\":{\\"top\\":\\"456px\\",\\"left\\":\\"-252.011px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"delegate_name\\",\\"replace\\":\\"\\"},\\"id_type_1\\":{\\"top\\":\\"419px\\",\\"left\\":\\"347px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"12px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"id_type_2\\":{\\"top\\":\\"419px\\",\\"left\\":\\"293px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"12px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"}}"'),
        array('id' => '38','key' => 'subscribe_tamm_model','value' => '"{\\"choice_new\\":{\\"top\\":\\"599px\\",\\"left\\":\\"-193px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"choice_new\\",\\"replace\\":\\"\\"},\\"company_num\\":{\\"top\\":\\"146px\\",\\"left\\":\\"387px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"16px\\",\\"letterSpacing\\":\\"15.4px\\",\\"dataValue\\":\\"1236548796\\",\\"replace\\":\\"\\"},\\"name_ar\\":{\\"top\\":\\"187px\\",\\"left\\":\\"421px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_ar\\",\\"replace\\":\\"\\"},\\"name_en\\":{\\"top\\":\\"207px\\",\\"left\\":\\"420px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_en\\",\\"replace\\":\\"\\"},\\"city\\":{\\"top\\":\\"248px\\",\\"left\\":\\"548px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"city\\",\\"replace\\":\\"\\"},\\"company_type\\":{\\"top\\":\\"636.966px\\",\\"left\\":\\"-192px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"company_type\\",\\"replace\\":\\"\\"},\\"enterprise_activity\\":{\\"top\\":\\"224px\\",\\"left\\":\\"35px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"enterprise_activity\\",\\"replace\\":\\"\\"},\\"owner_name\\":{\\"top\\":\\"288.988px\\",\\"left\\":\\"547px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_name\\",\\"replace\\":\\"\\"},\\"owner_phone\\":{\\"top\\":\\"246.988px\\",\\"left\\":\\"325px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_phone\\",\\"replace\\":\\"\\"},\\"owner_phone2\\":{\\"top\\":\\"288.988px\\",\\"left\\":\\"327px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"owner_phone2\\",\\"replace\\":\\"\\"},\\"mailbox\\":{\\"top\\":\\"268.988px\\",\\"left\\":\\"547px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mailbox\\",\\"replace\\":\\"\\"},\\"postcode\\":{\\"top\\":\\"266.988px\\",\\"left\\":\\"326px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"postcode\\",\\"replace\\":\\"\\"},\\"person_name\\":{\\"top\\":\\"329px\\",\\"left\\":\\"545px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"person_name\\",\\"replace\\":\\"\\"},\\"person_phone\\":{\\"top\\":\\"328px\\",\\"left\\":\\"326px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"person_phone\\",\\"replace\\":\\"\\"},\\"person_mail\\":{\\"top\\":\\"354px\\",\\"left\\":\\"487px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"8px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"person_mail\\",\\"replace\\":\\"\\"},\\"phone_notfic\\":{\\"top\\":\\"352.977px\\",\\"left\\":\\"308px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"0065656566\\",\\"replace\\":\\"\\"},\\"mail_notific\\":{\\"top\\":\\"687px\\",\\"left\\":\\"-195px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"mail_notific\\",\\"replace\\":\\"\\"},\\"commercial_number\\":{\\"top\\":\\"370px\\",\\"left\\":\\"554px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"8965745896\\",\\"replace\\":\\"\\"},\\"release_date\\":{\\"top\\":\\"369px\\",\\"left\\":\\"329px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"2020-02-20\\",\\"replace\\":\\"\\"},\\"end_date\\":{\\"top\\":\\"369px\\",\\"left\\":\\"35px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"2020-02-20\\",\\"replace\\":\\"\\"},\\"lang\\":{\\"top\\":\\"662px\\",\\"left\\":\\"-190px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"lang\\",\\"replace\\":\\"\\"},\\"user_name_ar\\":{\\"top\\":\\"555px\\",\\"left\\":\\"412px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name_ar\\",\\"replace\\":\\"\\"},\\"user_name_en\\":{\\"top\\":\\"554px\\",\\"left\\":\\"35px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name_en\\",\\"replace\\":\\"\\"},\\"user_identifi\\":{\\"top\\":\\"516px\\",\\"left\\":\\"241px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"8.5px\\",\\"dataValue\\":\\"6543256978\\",\\"replace\\":\\"\\"},\\"user_phone\\":{\\"top\\":\\"516px\\",\\"left\\":\\"40.9857px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"13px\\",\\"letterSpacing\\":\\"8.5px\\",\\"dataValue\\":\\"5896745896\\",\\"replace\\":\\"\\"},\\"user_mail\\":{\\"top\\":\\"534.98px\\",\\"left\\":\\"251.99px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"14px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"alifaragmahmed@gmail.com\\",\\"replace\\":\\"\\"},\\"applicant_name\\":{\\"top\\":\\"670px\\",\\"left\\":\\"354px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"applicant_name\\",\\"replace\\":\\"\\"},\\"position\\":{\\"top\\":\\"668px\\",\\"left\\":\\"35.9886px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"position\\",\\"replace\\":\\"\\"},\\"identifi_number\\":{\\"top\\":\\"692px\\",\\"left\\":\\"353px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"identifi_number\\",\\"replace\\":\\"\\"},\\"applicant_phone\\":{\\"top\\":\\"692px\\",\\"left\\":\\"34px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"applicant_phone\\",\\"replace\\":\\"\\"},\\"delegate_name\\":{\\"top\\":\\"714px\\",\\"left\\":\\"-200px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"delegate_name\\",\\"replace\\":\\"\\"},\\"choice_new_1\\":{\\"top\\":\\"103px\\",\\"left\\":\\"666px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"choice_new_2\\":{\\"top\\":\\"101.955px\\",\\"left\\":\\"602px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"company_type_1\\":{\\"top\\":\\"240px\\",\\"left\\":\\"652px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"company_type_2\\":{\\"top\\":\\"239.985px\\",\\"left\\":\\"572px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"mail_notfic\\":{\\"top\\":\\"354px\\",\\"left\\":\\"34px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"10px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"alifaragmhamed@gmai.com\\",\\"replace\\":\\"\\"},\\"lang_1\\":{\\"top\\":\\"544px\\",\\"left\\":\\"160px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"},\\"lang_2\\":{\\"top\\":\\"544px\\",\\"left\\":\\"83px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"1\\",\\"replace\\":\\"1|<img src=\'https:\\/\\/taqneen.vauxerp.com\\/assets\\/images\\/shomoos-pdf\\/check.png\' width=\'10px\' >\\"}}"'),
        array('id' => '39','key' => 'edit_subscribe_muqeem_model','value' => '"{\\"company_num\\":{\\"top\\":\\"0px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"company_num\\",\\"replace\\":\\"\\"},\\"name_ar\\":{\\"top\\":\\"20px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"name_ar\\",\\"replace\\":\\"\\"},\\"user_name\\":{\\"top\\":\\"40px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name\\",\\"replace\\":\\"\\"},\\"user_identifi\\":{\\"top\\":\\"60px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_identifi\\",\\"replace\\":\\"\\"},\\"user_phone\\":{\\"top\\":\\"80px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_phone\\",\\"replace\\":\\"\\"},\\"user_email\\":{\\"top\\":\\"100px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_email\\",\\"replace\\":\\"\\"},\\"user_name_delete\\":{\\"top\\":\\"120px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_name_delete\\",\\"replace\\":\\"\\"},\\"user_identifi_delete\\":{\\"top\\":\\"140px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"user_identifi_delete\\",\\"replace\\":\\"\\"},\\"choice_process\\":{\\"top\\":\\"160px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"choice_process\\",\\"replace\\":\\"\\"},\\"other_user_name\\":{\\"top\\":\\"180px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"other_user_name\\",\\"replace\\":\\"\\"},\\"other_user_identifi\\":{\\"top\\":\\"200px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"other_user_identifi\\",\\"replace\\":\\"\\"},\\"applicant_name\\":{\\"top\\":\\"220px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"applicant_name\\",\\"replace\\":\\"\\"},\\"position\\":{\\"top\\":\\"240px\\",\\"left\\":\\"0px\\",\\"width\\":\\"auto\\",\\"fontSize\\":\\"15px\\",\\"letterSpacing\\":\\"0px\\",\\"dataValue\\":\\"position\\",\\"replace\\":\\"\\"}}"')
      );
    
    foreach($systems as $item) {
        System::create([
            "key" => $item['key'],
            "value" => $item['value'],
        ]);
    }

    echo "done";*/
});

Route::get('/migrate', function(){
    Artisan::call("migrate");
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
    Route::delete('/customer-form/{id}', 'taqneen\CustomerFormController@destroy');
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
 