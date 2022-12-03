<?php

namespace App\Http\Controllers\Tasker;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Mail\JobMail;
use App\Models\AppliedJob;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Subscriptions;
use App\Models\Package;
use App\Models\SavedJob;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class DashboardController extends Controller
{
    public function dashboard()
    {


        $jobs = Jobs::where('company_id', auth()->user()->company->id)->whereIn('status', ['approved'])
            ->orWhere('company_id', null)
            ->get()->map(function ($job) {
                $company = CompanyProfile::where('id', auth()->user()->company->id)
                    ->whereJsonContains('business_category', ["$job->category_id"])->first();

                if ($company) {
                    return $job;
                } else {
                    return null;
                }
            })->filter();

        $job_ids = SavedJob::where('user_id', auth()->user()->id)->pluck('job_id')->toArray();
        $savedJobs = Jobs::whereIn('id', $job_ids)->get();
        return view('frontend.tasker.dashboard.index', compact('jobs', 'savedJobs'));
    }

    public function account(Request $request)
    {
        $company = auth()->user()->company;
        $package = Package::find($company->package_id);
        $categories = Category::all();
        if ($request->method() === 'POST') {
            $c = CompanyProfile::find(Auth::user()->company->id);
            $c->business_name = $request->business_name;
            $c->business_phone = $request->business_phone;
            $c->business_description = $request->business_description;
            $c->business_email = $request->business_email;
            $c->business_type = $request->business_type;
            $c->business_employee_size = $request->business_employee_size;
            $c->business_address1 = $request->business_address1;
            $c->business_address2 = $request->business_address2;
            $c->business_town = $request->business_town;
            $c->business_country = $request->business_country;
            $c->business_postal_code = $request->business_postal_code;
            $c->title = $request->title;
            $c->first_name = $request->first_name;
            $c->last_name = $request->last_name;
            $c->date_of_birth = $request->date_of_birth;
            $c->business_category = json_encode($request->business_category);
            $images = $request->old_images;
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $name = $image->store('uploads/company/' . $c->id);
                    $images[] = $name;
                }
            }
            if ($request->hasFile('logo')) {

                $logo = $request->file('logo')->store('uploads/company/' . $c->id);
                $c->logo = $logo;
            }
            $c->images = json_encode($images);
            $c->save();
            return redirect()->back()->with('success', 'Account updated successfully');
        }


        return view('frontend.tasker.dashboard.account', compact('company', 'package', 'categories'));
    }
    public function membership()
    {
        $company = auth()->user()->company;

        $package = Package::find($company->package_id);
        $subscription =  searchSubscription($company);
        $packages = Package::where('price', '!=', 0)->where('id', '!=', $company->package_id)->get();
        return view('frontend.tasker.dashboard.membership', compact('package', 'subscription', 'packages'));
    }
    public function mybillingPoral(Request $request)
    {
        $stripe = Stripe\Stripe::setApiKey(json_decode(site('stripe'))->stripe_secret);
        $company = auth()->user()->company;
        $subscriptions =  Stripe\Subscription::all(['customer' => auth()->user()->stripe_id]);
        $invoices =  collect(Stripe\Invoice::all([
            'customer' => auth()->user()->stripe_id,
            'limit' => 3,
        ])->data)->map(function ($invoice) {

            $product = Stripe\Product::retrieve($invoice->lines->data[0]->price->product);
            $invoice->product = $product;
            return $invoice;
        });
        $products = collect($subscriptions->data)->map(function ($subscription) {
            $product = Stripe\Product::retrieve($subscription->plan->product);
            $product_price = Stripe\Price::retrieve($subscription->plan->id);
            $subscription->product = $product;
            $subscription->product_price = $product_price;

            return $subscription;
        });
        $paymentMethods = Stripe\PaymentMethod::all([
            'customer' => auth()->user()->stripe_id,
            'type' => 'card',
        ]);

        $billingInfo = Stripe\Customer::retrieve(auth()->user()->stripe_id);
        $package = Package::find($company->package_id);

        if ($request->method() === 'POST') {
            $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
            if ($request->type === "makeDefault") {
                $paymentMethod =  $stripe->paymentMethods->attach(
                    $request->payment_method,
                    ['customer' => auth()->user()->stripe_id]
                );
                $stripe->customers->update(
                    auth()->user()->stripe_id,
                    ['invoice_settings' => ['default_payment_method' => $paymentMethod->id]]
                );

                return response()->json(['success' => true]);
            }
            if ($request->type === "addCard") {
                try {
                    $count = Stripe\PaymentMethod::all([
                        'customer' => auth()->user()->stripe_id,
                        'type' => 'card',
                    ]);
                    $paymentMethod =  $stripe->paymentMethods->attach(
                        $request->payment_method,
                        ['customer' => auth()->user()->stripe_id]
                    );
                    if (!count($count->data)) {
                        $stripe->customers->update(
                            auth()->user()->stripe_id,
                            ['invoice_settings' => ['default_payment_method' => $paymentMethod->id]]
                        );
                    }

                    return redirect()->back()->with('success', 'Card added successfully');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
            if ($request->type === "removeCard") {
                try {
                    $stripe->paymentMethods->detach(
                        $request->payment_method,
                        []
                    );

                    return redirect()->back()->with('success', 'Card removed successfully');
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', $e->getMessage());
                }
            }
        }

        // dd($subscriptions);
        // $product = Stripe\Product::retrieve($subscription->items->data[0]->price->product);
        // dd($invoices);

        // dd($products->product);


        // $session = \Stripe\BillingPortal\Session::create([
        //     'customer' => Auth::user()->stripe_id,
        //     'return_url' => route('tasker.dashboard'),
        // ]);
        // dd($session);
        return view('frontend.tasker.dashboard.mybilling', compact('subscriptions', 'paymentMethods', 'billingInfo', 'invoices', 'package'));
        // header("Location: " . $session->url);
        // exit();
    }

    public function subscriptionrenew(Request $request)
    {

        \Stripe\Stripe::setApiKey(json_decode(site('stripe'))->stripe_secret);
        $package = Package::where('stripe_plan_id', $request->plan)->first();
        $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
        $subid =  $stripe->subscriptions->retrieve($request->subscription_id);
        $paymentMethod =  $stripe->paymentMethods->all([
            'customer' => auth()->user()->stripe_id,
            'type' => 'card',
        ]);
        if ($paymentMethod->data) {
            $paymentMethod = $paymentMethod->data[0]->id;
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Please add a payment method to upgrade your membership',
                    'redirect' =>  route('tasker.mybillingPoral')
                ]
            );
        }
        try {
            $subscription =  $stripe->subscriptions->update(
                $subid->id,
                [
                    'cancel_at_period_end' => false,
                    'proration_behavior' => 'create_prorations',
                    'items' => [
                        [
                            'id' => $subid->items->data[0]->id,
                            'price' => $request->plan,
                        ],
                    ],
                ]
            );
            if ($subscription->status == 'active') {
                $currentInvoice = $stripe->invoices->retrieve($subscription->latest_invoice);
                if ($currentInvoice->status == 'paid') {

                    $company = CompanyProfile::where('user_id', auth()->user()->id)->first();

                    $company->package_id = $package->id;
                    $company->credit = $company->credit + $package->credit;

                    $company->save();
                    $sbstore = Subscriptions::where('subscription_id', $subid->id)->first();
                    $sbstore->package_id = $request->package_id;
                    $sbstore->ends_at = stripeTime($subscription->current_period_end);
                    $sbstore->save();
                    return response()->json(
                        [
                            'success' => true,
                            'message' => 'Subscription renewed successfully'
                        ]
                    );
                } else {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Payment failed Please try again'
                        ]
                    );
                }
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage(),

                ]
            );
        }

        // $update =  \Stripe\Subscription::update($request->subscription_id, [
        //     'cancel_at_period_end' => false,
        //     'proration_behavior' => 'create_prorations',
        //     'items' => [
        //         [
        //             'id' => $subscription->items->data[0]->id,
        //             'price' => $request->plan,
        //         ],
        //     ],
        // ]);
        return response()->json([
            'success' => 'Subscription Renewed Successfully',
            // 'data' => $update
        ]);
    }

    public function subscriptioncancel(Request $request)
    {
        $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
        $action =   $stripe->subscriptions->update(
            $request->subscription_id,
            [
                'cancel_at_period_end' => $request->cancel_at_period_end === '1' ? true : false,
            ]

        );
        return $action;
    }

    public function skills(Request $request)
    {
        $company = auth()->user()->company;
        $subcategories = Category::all();
        if ($request->method() === 'POST') {
            // dd($request->subcategories);
            $oldSubcategories = json_decode($company->business_subcategory);
            $newSubcategories = $request->subcategories;
            array_push($oldSubcategories, $newSubcategories);
            $company->business_subcategory = json_encode($oldSubcategories);
            $company->save();
            return redirect()->route('tasker.skills')->with('success', 'Skills added successfully');
        }
        return view('frontend.tasker.dashboard.skills', compact('company', 'subcategories'));
    }


    public function removeSkill($id)
    {
        $company = auth()->user()->company;
        $oldSubcategories = json_decode($company->business_subcategory);
        $newSubcategories = array_diff($oldSubcategories, [$id]);
        $company->business_subcategory = json_encode($newSubcategories);
        $company->save();
        return redirect()->route('tasker.skills')->with('success', 'Skill removed successfully');
    }


    public function jobs()
    {
        $jobs = Jobs::whereIn('status', ['replied', 'complete'])
            ->get()->map(function ($job) {
                $company =
                    CompanyProfile::find(auth()->user()->company->id)
                    ->whereJsonContains('business_subcategory', "$job->subcategory_id")->first();
                if ($company) {
                    return $job;
                } else {
                    return null;
                }
            })->filter();
        $job_ids = SavedJob::where('user_id', auth()->user()->id)->pluck('job_id')->toArray();
        $savedJobs = Jobs::whereIn('id', $job_ids)->get();
        return view('frontend.tasker.dashboard.jobs', compact('jobs', 'savedJobs'));
    }
    public function credits()
    {

        $company = auth()->user()->company;
        $stripe = Stripe\Stripe::setApiKey(json_decode(site('stripe'))->stripe_secret);
        $billingInfo = Stripe\Customer::retrieve(auth()->user()->stripe_id);
        $paymentMethods = Stripe\PaymentMethod::all([
            'customer' => auth()->user()->stripe_id,
            'type' => 'card',
        ]);
        $transactions = Transaction::where('company_id', $company->id)->get();

        return view('frontend.tasker.dashboard.credits', compact('company', 'transactions', 'paymentMethods', 'billingInfo'));
    }
    public function savedJob()
    {
        $user_id = auth()->user()->id;
        $job_ids = SavedJob::where('user_id', $user_id)->pluck('job_id')->toArray();
        $savedJobs = Jobs::whereIn('id', $job_ids)->get();
        return view('frontend.tasker.dashboard.saveJob', compact('user_id', 'savedJobs'));
    }

    public function saveJob($id)
    {
        $user_id = auth()->user()->id;
        $job = Jobs::find($id);
        $savedJob = SavedJob::where('user_id', $user_id)->where('job_id', $job->id)->first();
        if ($savedJob) {
            $savedJob->delete();
            return redirect()->back()->with('success', 'Job removed from saved jobs');
        } else {
            $savedJob = new SavedJob();
            $savedJob->user_id = $user_id;
            $savedJob->job_id = $job->id;
            $savedJob->save();
            return redirect()->back()->with('success', 'Job saved successfully');
        }
    }
    public function applyJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'cover_letter' => 'required',
        ]);
        $job = Jobs::find($request->job_id);
        $checkJob = AppliedJob::where('job_id', $request->job_id)->where('company_id', auth()->user()->company->id)->first();
        if ($checkJob) {
            return  response()->json(['success' => 'You have already applied for this job']);
        }
        $company = CompanyProfile::find(auth()->user()->company->id);
        if ($company->credits > site()->credit_per_job_pos) {
            return response()->json([
                'success' => 'You have insufficient credits to apply for this job',
                'title' => 'Insufficient Credits',
            ]);
        }
        $appliedJob = new AppliedJob();
        $appliedJob->job_id = $request->job_id;
        $appliedJob->user_id = auth()->user()->company->user_id;
        $appliedJob->company_id = auth()->user()->company->id;
        $appliedJob->cover_letter = $request->cover_letter;
        $appliedJob->save();


        $company->credit = $company->credit - site()->credit_per_job_post;
        $company->save();

        $data = [
            'user' => $job->user,
            'company' => auth()->user()->company,
            'subject' => 'New Proposal for your Job ',
            'title' => 'A TradExpert is interested in your job ',
        ];

        SendEmailJob::dispatch($data);



        return response()->json([
            'title' => 'Job Applied',
            'type' => 'success',
            'success' => 'Job applied successfully',
            'redirect' => route('tasker.dashboard')
        ]);
    }
}
