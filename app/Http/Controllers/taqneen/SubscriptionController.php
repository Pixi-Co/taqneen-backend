<?php

namespace App\Http\Controllers\taqneen;

use App\Category;
use App\Contact;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ServicePackage;
use App\Subscription;
use App\TaxRate;
use App\TransactionPayment;
use App\User;
use App\Utils\ContactUtil; 

class SubscriptionController extends Controller
{
    
    public function index() {
        $subscriptions = Subscription::where('business_id', session('user.business_id'))->where('Subscription_type', 'subscription')->get(); 
        return view('taqneen.subscription.index', compact("subscriptions"));
    }


    public function create() {
        $business_id = session('business.id');
        $subscription = new Subscription();
        $payment = new TransactionPayment();
        $customers = Contact::where('business_id', $business_id)->onlyCustomers()->get();
        $customerObject = Contact::getObject();
        $services = Category::forDropdown(session('user.business_id'), "service"); 
        $packages = ServicePackage::where('business_id', $business_id)->get();
        $users = User::allUsersDropdown($business_id);
        $taxs = TaxRate::getObject();
        $expenses = ExpenseCategory::getObject();
        $expensesList = ExpenseCategory::where('business_id', $business_id)->pluck("name", "id")->toArray();
        $disabled = "disabled";
        $subscription->created_by = auth()->user()->id; 
        $subscription->contact = new Subscription();
        $status = [
            "waiting" => __('waiting'),
            "processing" => __('processing'),
            "pay_pending" => __('pay_pending'),
            "active" => __('active'),
            "cancel" => __('cancel')
        ]; 
        $paper_status = [
            "received" => __('received'),
            "not_received" => __('not_received')
        ]; 
        $payment_methods = [
            "transform_from_taqneen" => __('transform_from_taqneen'),
            "for_elm" => __('for_elm'),
            "direct_pay" => __('direct_pay') 
        ]; 
        $walk_in_customer = (new ContactUtil())->getWalkInCustomer($business_id);
         
        return view('taqneen.subscription.form', compact(
            "subscription", 
            "status", 
            "users", 
            "walk_in_customer", 
            "customers", 
            "disabled",
            "services",
            "packages",
            "taxs",
            "expenses",
            "expensesList",
            "payment",
            "payment_methods",
            "paper_status",
            "customerObject",
        ));
    }
    
    public function edit($id) {
        $subscription = Subscription::find($id);
        $subscriptions = Subscription::forDropdown(session('user.business_id'), "subscription"); 
        return view('taqneen.subscription.form', compact("subscription", "subscriptions"));
    }
    
    public function store(Request $request) {
        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description,
                "parent_id" => $request->parent_id? $request->parent_id : '0',
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "Subscription_type" => "subscription",
            ];
    
            Subscription::create($data);

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        return back()->with('status', $output); 
    }
    
    public function update(Request $request, $id) {
        try {
            $data = [
                "name" => $request->name,
                "description" => $request->description,
                "parent_id" => $request->parent_id? $request->parent_id : '0',
                "business_id" => session('business.id'),
                "created_by" => session('user.id'),
                "Subscription_type" => "subscription",
            ];
    
            $Subscription = Subscription::find($id);
            $Subscription->update($data);

            $output = [
                "success" => 1,
                "msg" => @trans('done')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }
        return redirect('/subscriptions')->with('status', $output); 
    }

    
    
    public function destroy($id) {
        try { 
            $Subscription = Subscription::find($id);
            $Subscription->delete();

            $output = [
                "success" => 1,
                "msg" => @trans('delete successfull')
            ];
        } catch (\Exception $th) {
            $output = [
                "success" => 0,
                "msg" => $th->getMessage()
            ];
        }

        return $output;
        return back()->with('status', $output); 
    }
}
