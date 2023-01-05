<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\JobDataTable;
use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CompanyProfile;
use App\Models\Jobs;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    //

    public function index(JobDataTable $dataTable)
    {
        return $dataTable->render('backend.jobs.index');
    }

    public function approveJob(Request $request)
    {
        $job = Jobs::find($request->id);
        $job->status = 'approved';
        $job->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Job Approved'
        ]);
    }

    public function deleteJob(Request $request)
    {
        $job = Jobs::find($request->id);
        $job->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Job Deleted'
        ]);
    }

    public function viewJob($id)
    {
        $job = Jobs::find($id);
        return view('backend.jobs.view-job', compact('job'));
    }

    public function reviews(ReviewDataTable $dataTable)
    {
        $users = User::where('role', '!=', 'company')->get();
        $companies = CompanyProfile::all();
        $categories = Category::all();

        return $dataTable->render('backend.jobs.reviews', compact('users', 'companies', 'categories'));
    }

    public function approveReview(Request $request)
    {
        $review = Review::find($request->id);
        $review->published = $review->published == 1 ? 0 : 1;
        $review->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Review Approved'
        ]);
    }

    public function deleteReview(Request $request)
    {
        $review = Review::find($request->id);
        $review->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Review Deleted'
        ]);
    }
    public function viewReview($id)
    {
        $review = Review::find($id);
        return view('backend.jobs.view-review', compact('review'));
    }

    //editReview
    public function editReview($id)
    {
        $review = Review::find($id);
        return view('backend.jobs.edit-review', compact('review'));
    }

    public function updateReview(Request $request)
    {
        // dd($request->all());
        $review = Review::findOrNew($request->id);
        $review->user_id = $request->user_id;
        $review->company_id = $request->company_id;
        $review->category_id = $request->category_id;
        $review->carried_out = $request->carried_out ? $request->carried_out : 1;
        $review->review_title = $request->review_title;
        $review->review = $request->review;
        $review->phone = $request->phone;
        $review->workmanship = $request->workmanship ? $request->workmanship : 0;
        $review->tidiness = $request->tidiness ? $request->tidiness : 0;
        $review->reliability = $request->reliability ? $request->reliability : 0;
        $review->courtesy = $request->courtesy ? $request->courtesy : 0;
        // dd($review);
        $review->save();
        if ($request->id) {
            return redirect()->route('admin.reviews.index')->with('success', 'Review Updated Successfully');
        } else {
            return redirect()->route('admin.reviews.index')->with('success', 'Review Created Successfully');
        }
    }
}
