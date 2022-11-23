<?php

use App\Models\AppliedJob;
use App\Models\Category;
use App\Models\Jobs;
use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;

function checkIsApplied($jobId)
{
    $applied = AppliedJob::where('job_id', $jobId)->where('user_id', auth()->user()->id)->first();
    if ($applied) {
        return true;
    }
    return false;
}


function site($key = null)
{
    $setting = SiteSetting::first();
    if ($key) {
        return  $setting[$key];
    } else {
        return $setting;
    }
}


function allCats()
{
    return Category::where('parent_id', null)->get();
}


function reviewCount($company)
{

    $reviews = $company->reviews->count();
    return "<p class='reviews'>$reviews <span>($reviews reviews)</span></p>";
}


function getblogimage($content)
{

    $regexp = '<img[^>]+src=(?:\"|\')\K(.[^">]+?)(?=\"|\')';
    $images = new \Illuminate\Support\Collection();
    if (preg_match_all("/$regexp/", $content, $matches, PREG_SET_ORDER)) {
        return $matches[0][0] ?? "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png";
    } else {
        return "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/681px-Placeholder_view_vector.svg.png";
    }
}


function creditCalculation()
{
    $perMonthFree = auth()->user()->company->packages->credit;
    $perMonthUsed = AppliedJob::where('company_id', auth()->user()->company->id)->where('created_at', '>=', now()->subMonth())->count();
    $perMonthLeft = $perMonthFree - $perMonthUsed;

    return auth()->user()->company->credit;
}


function  searchSubscription($company)
{
    $stripe = new \Stripe\StripeClient(json_decode(site('stripe'))->stripe_secret);
    $user = User::find($company->user_id);
    $subscriptions = $stripe->subscriptions->all([
        'customer' => $user->stripe_id,

    ]);
    if ($subscriptions->data) {
        return $subscriptions->data[0];
    } else {
        return false;
    }
}


function stripeTime($time)
{
    $unixTime = DateTime::createFromFormat('U', $time);
    return $unixTime;
}

function getPage($slug)
{
    return json_decode(Page::where('slug', $slug)->first()->description);
}
