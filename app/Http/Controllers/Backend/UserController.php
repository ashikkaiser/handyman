<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CompanyDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\AppliedJob;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Package;
use App\Models\Review;
use App\Models\SavedJob;
use App\Models\Subscriptions;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Geocoder;

class UserController extends Controller
{

    public function company(CompanyDataTable $dataTable)
    {
        return $dataTable->render('backend.user.company.index');
    }
    public function company_show($id)
    {

        $company = CompanyProfile::find($id);
        return view('backend.user.company.show', compact('company'));
    }

    public function company_edit(Request $request, $id)
    {
        $company = CompanyProfile::find($id);
        $packages = Package::all();
        $categories = Category::all();
        $sub_categories = Category::where('parent_id', $company->business_category)->get();

        return view('backend.user.company.edit', compact('company', 'packages', 'categories', 'sub_categories'));
    }

    public function company_update(Request $request, $id)
    {
        // dd($request->all());

        $company = CompanyProfile::find($id);
        $geoCode =  Geocoder::getCoordinatesForAddress($request->business_postal_code);
        // dd($geoCode);
        // $company->user_id = Auth::user()->id;
        $company->credit = $request->credit;
        $company->business_name = $request->business_name;
        $company->business_description = $request->business_description;
        $company->business_email = $request->business_email;
        // $company->business_phone = $request->business_phone;
        $company->business_type = $request->business_type;
        $company->business_employee_size = $request->business_employee_size;
        $company->business_category = $request->business_category;
        $company->package_id = $request->package_id;
        $company->business_address1 = $request->business_address1;
        $company->business_address2 = $request->business_address2;
        $company->business_town = $request->business_town;
        $company->business_country = $request->business_country;
        $company->business_postal_code = $request->business_postal_code;
        $company->business_latitude = $geoCode['lat'] ?? '';
        $company->business_longitude = $geoCode['lng'] ?? '';
        $company->title = $request->title;
        $company->first_name = $request->first_name;
        $company->last_name = $request->last_name;
        $company->date_of_birth = $request->date_of_birth;
        $company->map_address = $request->map_address;
        $company->verified = $request->verified;
        $company->payment_date = $request->payment_date;
        $company->expiry_date = $request->expiry_date;
        $company->is_active = $request->is_active;
        $company->business_registration_number = $request->business_registration_number;
        $company->save();
        return redirect()->route('admin.company.index')->with('success', 'Company Updated Successfully');
    }


    public function users(UserDataTable $dataTable)
    {
        return $dataTable->render('backend.user.users.index');
    }

    public function show($id)
    {

        $user = User::find($id);
        return view('backend.user.users.show', compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        return view('backend.user.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->post_code = $request->post_code;
        $user->role = $request->role;
        $user->stripe_id = $request->stripe_id;
        if (!empty($request->password)) {
            $user->password = $request->password;
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully');
    }

    public function compnayApprove($id)
    {
        $company = CompanyProfile::find($id);
        $company->is_active = !$company->is_active;
        $company->save();
        if ($company->is_active) {

            $user = User::find($company->user_id);
            $userMail = [
                'user' => $user,
                'title' => 'Congratulations ! Your Account has been approved by Tradexpert.co.uk.',
                'body' => "Your Account has been approved by Tradexpert.co.uk. Now you can login and manage your account.",
                'subject' => 'Congratulations !',
                'button' => 'Login',
                'url' => route('login'),
            ];
            dispatch(new \App\Jobs\RegistrationNotification($user, $userMail));
        }
        return back();
    }

    public function companyDelete($id)
    {

        $company = CompanyProfile::find($id);
        User::find($company->user_id)->delete();
        Jobs::where('company_id', $company->id)->delete();
        Review::where('company_id', $company->id)->delete();
        Subscriptions::where('company_id', $company->id)->delete();
        Transaction::where('company_id', $company->id)->delete();
        AppliedJob::where('company_id', $company->id)->delete();
        $company->delete();
        return back()->with('success', 'Company Deleted Successfully');
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        AppliedJob::where('user_id', $user->id)->delete();
        Jobs::where('user_id', $user->id)->delete();
        Review::where('user_id', $user->id)->delete();
        SavedJob::where('user_id', $user->id)->delete();
        $user->delete();
        return back()->with('success', 'User Deleted Successfully');
    }
}
