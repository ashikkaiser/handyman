<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Page;
use App\Models\SavedJob;
use App\Models\User;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Geocoder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = \App\Models\Category::whereNull('parent_id')->get();
        $companies = \App\Models\CompanyProfile::where('is_active', true)->orderBy('id', 'desc')->take(4)->get();


        return view('welcome', compact('categories', 'companies'));
    }

    public function signUp(Request $request)
    {
        $packages = \App\Models\Package::all();
        $subcategories = \App\Models\Category::whereNull('parent_id')->get();
        $testimonials = \App\Models\Testimonial::all();
        if ($request->isMethod('post')) {
            return redirect()->route('tasker.register.step1', ['category' => $request->category]);
        }


        return view('signup', compact('packages', 'subcategories', 'testimonials'));
    }


    public function company(Request $request, $slug)
    {

        $company = CompanyProfile::find($request->id);

        return view('company', compact('company'));
    }



    public function search(Request $request)
    {

        if ($request->method() == 'POST') {
            $request->session()->put('search', $request->all());
            return redirect()->route('search', ['categoryId' => $request->s, 'location' => $request->postal_code]);
        }

        $session = (object) $request->session()->get('search');

        if ($request->categoryId) {
            $subcats = Category::find($request->categoryId);

            $category = Category::find($subcats->parent_id);
        } else {
            $category = Category::where('slug', $session->c)->first();
            $subcats = Category::where('parent_id', $category->id)->get();
        }

        $companies = CompanyProfile::query();
        $companies->where('is_active', true);
        $companies->whereJsonContains('business_category', "$category->id");
        $companies->whereJsonContains('business_subcategory', "$subcats->id");

        isset($session->location) ? $companies->where('post_code', $session->location) : '';
        $geoCode =  Geocoder::getCoordinatesForAddress($request->location);
        $companies->distance($geoCode['lat'], $geoCode['lng']);



        if (!isset(request()->session()->get('search')['c'])) {
            return redirect()->route('home');
        }



        $companies = $companies->get();

        return view('search.index', compact('companies', 'category', 'subcats', 'session'));
    }

    public function recursive_array_replace($find, $replace, $array)
    {
        if (!is_array($array)) {
            return str_replace($find, $replace, $array);
        }

        $newArray = [];
        foreach ($array as $key => $value) {
            $newArray[$key] = $this->recursive_array_replace($find, $replace, $value);
        }
        return $newArray;
    }

    public function page($slug)
    {

        $page = Page::where('slug', $slug)->first();
        return view('page', compact('page'));
    }

    public function saveCompany(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'user') {
            $company = CompanyProfile::find($request->id);
            $saveJob = new SavedJob();
            $saveJob->user_id = Auth::user()->id;
            $saveJob->company_id = $company->id;
            $saveJob->save();
            return response()->json([
                'success' => true,
                'message' => 'Company saved successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'Please Login First',
                'success' => false
            ]);
        }
    }

    public function blogs()
    {

        $blogs = \App\Models\Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function singleBlog($slug)
    {

        $blog = \App\Models\Blog::where('slug', $slug)->first();
        return view('blogs.show', compact('blog'));
    }

    public function postJob(Request $request)
    {


        if ($request->method() === "POST") {
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
                if ($user->save()) {
                    $adminMail = [
                        'user' => $user,
                        'title' => 'New User Registration',
                        'body' => "A new user $user->name has signup as a User",
                        'subject' => 'New Home Owner Registration',
                    ];
                    $admins = User::where('role', 'admin')->get();
                    foreach ($admins as $admin) {
                        dispatch(new \App\Jobs\RegistrationNotification($admin, $adminMail));
                    }
                }
            }

            if ($user) {
                if (!$checkUser) {
                    Auth::login($user);
                    $user->sendEmailVerificationNotification();
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
                    return redirect()->route('verification.notice')->with('success', 'Job posted successfully');
                }
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
                    $getmatchedCompanies =
                        CompanyProfile::whereJsonContains('business_category', $job->category_id)
                        ->whereJsonContains('business_subcategory', $job->subcategory_id)->get();

                    foreach ($getmatchedCompanies as $company) {
                        $data = [
                            'user' => $user,
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




                return redirect()->route('login')->with('success', 'Job Posted Successfully Please Login to view your job');
            }
        }

        $company = CompanyProfile::find($request->company);

        return view('frontend.post-job', compact('company'));
    }
}
