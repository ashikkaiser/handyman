<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::first();
        return view('backend.site-settings.index', compact('siteSettings'));
    }

    public function store(Request $request)
    {

        $siteSettings = SiteSetting::findOrNew($request->id);
        $siteSettings->name = $request->name;
        $siteSettings->email = $request->email;
        $siteSettings->phone = $request->phone;
        $siteSettings->address = $request->address;
        $siteSettings->logo = $request->logo;
        $siteSettings->favicon = $request->favicon;
        $siteSettings->banner_image = $request->banner_image;
        $siteSettings->social_links = json_encode($request->social);
        $siteSettings->stripe = json_encode($request->stripe);
        $siteSettings->footer_links =
            json_encode((object)['main' => array_values($request->main), 'quick' => array_values($request->quick)]);
        $siteSettings->smtp = json_encode($request->smtp);
        $siteSettings->credit_conversion = $request->credit_conversion;
        $siteSettings->credit_per_job_post = $request->credit_per_job_post;
        $siteSettings->copy_right_text = $request->copy_right_text;
        $siteSettings->credit_list = $request->credit_list;
        $siteSettings->popup_text = $request->popup_text;
        // dd($request->all());
        $siteSettings->save();
        // dd($siteSettings);
        return redirect()->back()->with('success', 'Site Settings Updated Successfully');
    }
}
