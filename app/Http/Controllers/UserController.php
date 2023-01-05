<?php

namespace App\Http\Controllers;

use App\Jobs\RegistrationNotification;
use App\Jobs\SendEmailJob;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('verified')->except(['dashboard', 'fetchjob']);
    }

    public function dashboard()
    {
        $jobs = Jobs::where('user_id', auth()->user()->id)

            // ->where('status', '!==', 'complete')?
            ->orderBy('id', 'desc')
            ->get();

        $categories = Category::all();
        return view('user.dashboard', compact('jobs', 'categories'));
    }

    public function fetchjob(request $request)
    {
        $job = Jobs::find($request->id);
        return view('user.job-details', compact('job'));
    }

    public function reviews()
    {

        $reviews = Review::where('user_id', auth()->user()->id)->get();
        return view('user.reviews', compact('reviews'));
    }
    public function profile(Request $request)
    {

        if ($request->isMethod('post')) {

            if ($request->has('updateProfile')) {

                $user = User::find(auth()->user()->id);
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->phone = $request->phone;
                $user->post_code = $request->post_code;
                $user->save();
                return redirect()->back()->with('success', 'Profile updated successfully');
            }

            if ($request->has('updatePassword')) {
                $request->validate([
                    'current_password' => 'required',
                    'new_password' => 'required|confirmed',
                    'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6'


                ]);

                if (Auth::attempt(['email' => auth()->user()->email, 'password' => $request->current_password])) {
                    $user = User::find(auth()->user()->id);
                    $user->password = bcrypt($request->new_password);
                    $user->save();
                    return redirect()->back()->with('success', 'Password updated successfully');
                } else {
                    return redirect()->back()->with('error', 'Current password is incorrect');
                }
            }
            if ($request->has('setPassword')) {
                $request->validate([

                    'new_password' => 'required|confirmed',
                    'new_password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6'


                ]);

                $user = User::find(auth()->user()->id);
                $user->password = bcrypt($request->new_password);
                $user->save();
                return redirect()->back()->with('success', 'Password updated successfully');
            }
        }

        return view('user.profile');
    }


    //
    public function postJob(Request $request)
    {
        if ($request->method() === "POST") {
            $request->validate([
                'subcategory_id' => 'required',
                'description' => 'required',
                'post_code' => 'required',
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'start_time' => 'required',



            ]);

            $checkUser = User::where('email', $request->email)->first();

            if ($checkUser) {
                $user = $checkUser;
            } else {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = 'user';
                $user->phone = $request->phone;
                $user->post_code = $request->post_code;
                $user->save();
                $adminMail = [
                    'user' => $user,
                    'title' => 'New User Registration',
                    'body' => "A new user $user->name has signup as a User",
                    'subject' => 'New User Registration',
                ];
                $admins = User::where('role', 'admin')->get();
                foreach ($admins as $admin) {
                    dispatch(new \App\Jobs\RegistrationNotification($admin, $adminMail));
                }
            }
            if ($user) {
                if (!$checkUser) {
                    Auth::login($user);
                    $user->sendEmailVerificationNotification();

                    $job = new Jobs();
                    $job->user_id = auth()->user()->id;
                    $job->company_id = $request->company_id;
                    $job->description = $request->description;
                    $job->category_id = Category::find($request->subcategory_id)->parent_id;
                    $job->subcategory_id = $request->subcategory_id;
                    $job->start_time = $request->start_time;
                    $job->name = $request->name;
                    $job->email = $request->email;
                    $job->phone = $request->phone;
                    $job->post_code = $request->post_code;
                    $job->status = "approved";
                    $job->save();
                    $data = [
                        'user' => $user,
                        'myself' => true,
                        'job' => $job,
                        'subject' => 'Your job has been posted.',
                        'title' => 'Your job has been posted',
                        'body' => "Your job has been posted successfully. You can view your job details by clicking the button below.",
                    ];

                    SendEmailJob::dispatch($data);
                    if (!$job->company_id) {
                        $getmatchedCompanies =  CompanyProfile::whereJsonContains('business_subcategory', "$job->subcategory_id")->get();

                        foreach ($getmatchedCompanies as $company) {
                            $data = [
                                'user' => User::find($company->user_id),
                                'myself' => false,
                                'subject' => 'A job matching your category has been posted. ',
                                'title' => 'A job matching your category has been posted',
                                'body' => "A job matching your category has been posted. You can view the job details by clicking the button below.",
                            ];
                            SendEmailJob::dispatch($data);
                        }
                    } else {
                        $company = CompanyProfile::find($job->company_id);
                        $data = [
                            'user' => User::find($company->user_id),
                            'myself' => false,
                            'subject' => 'A job matching your category has been posted. ',
                            'title' => 'A job matching your category has been posted',
                            'body' => "A job matching your category has been posted. You can view the job details by clicking the button below.",
                        ];
                        SendEmailJob::dispatch($data);
                    }

                    $details = [
                        'user' => $user,
                        'subject' => 'New Job Posted',
                        'title' => 'New Job Posted',
                        'body' => "A new job posted by user $user->name"
                    ];

                    $userx = User::where('role', 'admin')->get();
                    foreach ($userx as $admin) {
                        dispatch(new \App\Jobs\RegistrationNotification($admin, $details));
                    }





                    return redirect()->route('verification.notice')->with('success', 'Job posted successfully');
                } else {
                    $job = new Jobs();
                    $job->user_id = $user->id;
                    $job->company_id = $request->company_id;
                    $job->description = $request->description;
                    $job->category_id = Category::find($request->subcategory_id)->parent_id;
                    $job->subcategory_id = $request->subcategory_id;
                    $job->start_time = $request->start_time;
                    $job->name = $request->name;
                    $job->email = $request->email;
                    $job->phone = $request->phone;
                    $job->post_code = $request->post_code;
                    $job->status = "approved";
                    $job->save();
                    $data = [
                        'user' => $user,
                        'myself' => true,
                        'job' => $job,
                        'subject' => 'Your job has been posted.',
                        'title' => 'Your job has been posted',
                        'body' => "Your job has been posted successfully. You can view your job details by clicking the button below.",
                    ];

                    SendEmailJob::dispatch($data);


                    if (!$job->company_id) {
                        $getmatchedCompanies =  CompanyProfile::whereJsonContains('business_subcategory', "$job->subcategory_id")->get();

                        foreach ($getmatchedCompanies as $company) {
                            $data = [
                                'user' => User::find($company->user_id),
                                'myself' => false,
                                'subject' => 'A job matching your category has been posted. ',
                                'title' => 'A job matching your category has been posted',
                                'body' => "A job matching your category has been posted. You can view the job details by clicking the button below.",
                            ];
                            SendEmailJob::dispatch($data);
                        }
                    } else {
                        $company = CompanyProfile::find($job->company_id);
                        $data = [
                            'user' => User::find($company->user_id),
                            'myself' => false,
                            'subject' => 'A job matching your category has been posted. ',
                            'title' => 'A job matching your category has been posted',
                            'body' => "A job matching your category has been posted. You can view the job details by clicking the button below.",
                        ];
                        SendEmailJob::dispatch($data);
                    }
                }

                $details = [
                    'user' => $user,
                    'subject' => 'New Job Posted',
                    'title' => 'New Job Posted',
                    'body' => "A new job posted by user $user->name"
                ];

                $userx = User::where('role', 'admin')->get();
                foreach ($userx as $admin) {
                    dispatch(new \App\Jobs\RegistrationNotification($admin, $details));
                }
                return redirect()->route('login')->with('success', 'Job Posted Successfully Please Login to view your job');
            }
        }



        $company = CompanyProfile::find($request->company);

        return view('frontend.post-job', compact('company'));
    }
    public function cat_subcat(Request $request)
    {

        $scat = Category::whereNotNull('parent_id')->where('name', 'like', "%$request->q%")->get();
        $scat = $scat->groupBy('parent_id');
        $scat = $scat->map(function ($item, $key) {
            return [
                'text' => Category::find($key)->name,
                'children' => $item->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'text' => $item->name
                    ];
                })
            ];
        });
        return response()->json($scat->values());
        // ->groupBy('parent_id')
        //     ->map(function ($item) {
        //         return [

        //             'text' => $item[0]->parent->name,
        //             'children' => $item->map(function ($item) {
        //                 return [
        //                     'id' => $item->id,
        //                     'text' => $item->name
        //                 ];
        //             })
        //         ];
        //     });
        // dd($scat);
        // return response()->json($scat);
        $subcat = Category::whereNotNull('parent_id')->where('name', 'like', "%$request->q%")->groupBy('parent_id')->get()->map(function ($item) {
            return [
                'text' => $item->parent->name,
                'children' => [
                    ['id' => $item->id,  'text' => $item->name,]
                ]
            ];
        });
        return response()->json($subcat);
    }



    public function giveFeedback(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        return view('user.review');
    }

    public function ajaxCompany(Request $request)
    {
        $company = CompanyProfile::where('is_active', true)
            ->where('business_name', 'like', "%$request->q%")->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => "$item->business_name ($item->id) - $item->business_town"
                ];
            });
        return response()->json($company);
    }
    public function giveFeedbackCompany(Request $request, $id)
    {
        $company = companyProfile::find($request->id);
        return view('user.review-company', compact('company'));
    }


    public function storeReview(Request $request)
    {

        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->company_id = $request->company_id;
        $review->phone = $request->phone;
        $review->carried_out = $request->carried_out;
        if ($request->carried_out === 'Yes') {
            $review->category_id = $request->yes_category;
            $review->job_name = $request->yes_job_name;
            $review->completed_at = $request->yes_completed_at;
            $review->review = $request->yes_review;
            $review->workmanship = $request->workmanship;
            $review->tidiness = $request->tidiness;
            $review->reliability = $request->timekeeping;
            $review->courtesy = is_array($request->courtesy) ? 0 : $request->courtesy;
        } else {
            $review->overall = $request->review;
            $review->review = $request->no_review;
            $review->review_title = $request->no_review_title;
        }
        // dd($review);
        $review->save();
        return redirect()->route('user.dashboard')->with('success', 'Review Submitted Successfully');
    }

    public function modifyJob(Request $request, $id, $type)
    {
        $job = Jobs::find($id);
        if ($type === 'delete') {
            $job->delete();
            return redirect()->back()->with('success', 'Job Deleted Successfully');
        }
        if ($type === 'complete') {
            $job->save();
            $jobCompleteMail = [
                'user' => $job->company->user,
                'title' => 'Congratulations! ',
                'body' => "You have successfully completed a job. You can Login to your account to Apply on more jobs.",
                'subject' => 'Congratulations! ',
            ];

            dispatch(new RegistrationNotification($job->company->user, $jobCompleteMail));
            return redirect()->back()->with('success', 'Job Completed Successfully');
        }
        $job->company_id = $type;
        $job->status = 'replied';
        $job->save();

        $data = [
            'user' => $job->company->user,
            'jobuser' => $job->user,
            'job_name' => $job->name,
            'subject' => 'A job has been assigned to you',
            'title' => 'A job has been assigned to you by following user',

        ];

        SendEmailJob::dispatch($data);


        return redirect()->back()->with('success', 'Job assigned to Successfully');
        // return redirect()->back()->with('success', 'Job assigned to ' . $job->company->business_name . ' Successfully');
    }
}
