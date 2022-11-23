<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\JobDataTable;
use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Jobs;
use App\Models\Review;
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
        return $dataTable->render('backend.jobs.reviews');
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
}
