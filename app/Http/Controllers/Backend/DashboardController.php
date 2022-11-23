<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $companies = CompanyProfile::orderBy('id', 'desc')->take(10)->get();
        $users = User::where('role', 'user')->orderBy('id', 'desc')->take(10)->get();
        $jobs = Jobs::orderBy('id', 'desc')->take(10)->get();

        $reviews = Review::orderBy('id', 'desc')->take(10)->get();


        return view('backend.dashboard.index', compact('companies', 'users', 'jobs', 'reviews'));
    }
}
