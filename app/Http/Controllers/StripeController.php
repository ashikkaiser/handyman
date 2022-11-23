<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class StripeController extends Controller
{

    function __construct()
    {
        Stripe\Stripe::setApiKey(json_decode(site('stripe'))->stripe_secret);
    }

    function topupFromExisting(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51KMvQIBs1z3zp1acD6OnXqyVnl7OJ8ievaVYd67riMZ3mFKYM7nke8wM9ajjZIT8LgxoYyj7tZGPOy9wuSJmn80X00bx9RGfMh'
        );
        $user = User::find(Auth::user()->id);
        $company = CompanyProfile::find($user->company_id);

        $paymentIntents = $stripe->paymentIntents->create([
            'amount' => $request->amount * 100,
            'currency' => 'usd',
            'payment_method' => $request->payment_method_id,
            'customer' =>  $user->stripe_id,
            'payment_method_types' => ['card'],
        ]);
        $charge =  $stripe->paymentIntents->confirm(
            $paymentIntents->id,
            ['payment_method' => $request->payment_method_id]
        );
        if ($charge->status === 'succeeded') {
            return $this->complete($user, $charge->charges->data[0], $request->amount);
        }
        return redirect()->back()->with('success', 'Topup successfully');
    }

    function cardPayment(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51KMvQIBs1z3zp1acD6OnXqyVnl7OJ8ievaVYd67riMZ3mFKYM7nke8wM9ajjZIT8LgxoYyj7tZGPOy9wuSJmn80X00bx9RGfMh'
        );
        $user = User::find(Auth::user()->id);
        $company = CompanyProfile::find($user->company_id);
        $charge = $stripe->charges->create([
            'amount' => $request->amount * 100,
            'currency' => 'gbp',
            'source' => $request->stripeToken,
            'description' => 'Topup from ' . $user->name,
            'receipt_email' => $user->email,

        ]);
        if ($charge->status === 'succeeded') {
            return $this->complete($user, $charge, $request->amount);
        }
    }

    function stripePost(Request $request)
    {
        $st = Stripe\Stripe::setApiKey(json_decode(site('stripe'))->stripe_secret);
        $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
        $existed =   $stripe->customers->search([
            'query' => 'email:\'' . $request->token['email'] . '\'',
        ]);
        $user = User::where('email', $request->token['email'])->first();
        if ($existed) {
            $cus_id = $existed['data'][0]['id'];
        } else {
            if (session('customer_id')) {
                $cus_id = session('customer_id');
            } else {
                $customer = $stripe->customers->create([
                    'email' => $request->token['email'],
                    'name' => session('step1')['business_name'],
                    'phone' => session('step1')['business_phone'],
                    'address' => [
                        'line1' => session('step3')['business_address1'],
                        'line2' => session('step3')['business_address2'],
                        'city' => session('step3')['business_town'],
                        'country' => session('step3')['business_country'],
                        'postal_code' => session('step3')['business_postal_code'],
                    ],
                ]);


                $cus_id = $customer['id'];
            }
        }
        try {
            $xx =  \Stripe\Customer::createSource(
                $cus_id,
                ['source' => $request->token['id']]
            );

            $payment = json_encode(Stripe\Charge::create([
                "amount" => round($request->amount * 100),
                'customer' => $cus_id,
                "currency" => "gbp",
                "source" => $xx->id,
            ]));
            if ($user) {
                return $this->complete($user, $payment, $request->amount);
            } else {
                $transaction = new Transaction();
                $transaction->company_id = 0;
                $transaction->transaction_id = json_decode($payment)->id;
                $transaction->receipt_url = json_decode($payment)->receipt_url;
                $transaction->email = $request->token['email'];
                $transaction->phone = session('step1')['business_phone'];
                $transaction->name = session('step1')['business_name'];
                $transaction->amount = $request->amount;
                $transaction->others = $payment;
                $transaction->save();

                session()->put('transaction', $transaction->id);
                session()->put('customer_id', $cus_id);
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',

                ]);
            }
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getError()->message,
            ]);
        }
    }

    function subscription(Request $request)
    {
        $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
        $email = session('step1')['business_email'];

        $existed =   $stripe->customers->search([
            'query' => 'email:\'' . $email . '\'',
        ]);
        if ($existed->data) {
            $cus_id = $existed->data[0]->id;
        } else {
            $customer = $stripe->customers->create([
                'email' => $email,
                'name' => session('step1')['business_name'],
                'phone' => session('step1')['business_phone'],
                'address' => [
                    'line1' => session('step3')['business_address1'],
                    'line2' => session('step3')['business_address2'],
                    'city' => session('step3')['business_town'],
                    'country' => session('step3')['business_country'],
                    'postal_code' => session('step3')['business_postal_code'],
                ],
            ]);
            $cus_id = $customer['id'];
        }



        if ($cus_id) {
            $stripe->paymentMethods->attach(
                $request->payment_method,
                ['customer' => $cus_id]
            );
            $subscription = $stripe->subscriptions->create([
                'customer' => $cus_id,
                'items' => [
                    ['price' => $request->price_id],
                ],
                'default_payment_method' => $request->payment_method,

            ]);
            if ($subscription->status === 'active') {
                session()->put('subscription_id', $subscription->id);
                session()->put('customer_id', $cus_id);
                return response()->json([
                    'success' => true,
                    'message' => 'Payment successful',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment successful',
                ]);
            }
        }
    }

    function freesubscription($company)
    {
        $package = Package::where('id', $company->package_id)->first();
        $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
        $email = $company->business_email;

        $existed =   $stripe->customers->search([
            'query' => 'email:\'' . $email . '\'',
        ]);
        // dd($package->stripe_plan_id);
        if ($existed->data) {
            $cus_id = $existed->data[0]->id;
        } else {
            $customer = $stripe->customers->create([
                'email' => $email,
                'name' => session('step1')['business_name'],
                'phone' => session('step1')['business_phone'],
                'address' => [
                    'line1' => session('step3')['business_address1'],
                    'line2' => session('step3')['business_address2'],
                    'city' => session('step3')['business_town'],
                    'country' => session('step3')['business_country'],
                    'postal_code' => session('step3')['business_postal_code'],
                ],
            ]);
            $cus_id = $customer['id'];
        }



        if ($cus_id) {

            $subscription = $stripe->subscriptions->create([
                'customer' => $cus_id,
                'items' => [
                    ['price' => $package->stripe_plan_id],
                ],
                'metadata' => [
                    'email' => $email,
                ],
            ]);
            $formated['subscription_id'] = $subscription->id;
            $formated['package_id'] = $package->id;
            $formated['stripe_status'] = $subscription->status;
            $formated['trial_ends_at'] = $subscription->trial_end;
            $formated['ends_at'] = $subscription->current_period_end;
            $formated['stripe_id'] = $cus_id;

            if ($subscription->status === 'active') {
                session()->put('subscription_id', $subscription->id);
                session()->put('customer_id', $cus_id);
                session()->put('info', $formated);

                return $formated;
            } else {
                return false;
            }
        }
    }


    function complete($data, $payment, $amount)
    {


        $company = CompanyProfile::where('user_id', $data->id)->first();
        $transaction = new Transaction();
        $transaction->company_id = $company->id;
        $transaction->transaction_id = $payment->id;
        $transaction->receipt_url = $payment->receipt_url;
        $transaction->email = $data->email;
        $transaction->phone = $company->business_phone;
        $transaction->name = $company->business_name;
        $transaction->amount = $amount;
        $transaction->others = json_encode($payment);
        $transaction->save();
        $company->credit = $company->credit + ($amount * site()->credit_conversion);
        $company->save();
        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }
}
