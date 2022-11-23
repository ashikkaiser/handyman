<?php

use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\JobsController;
use App\Http\Controllers\Backend\PagesController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify' => true]);
// dd(route('password.reset'));

Route::get('/setup', function () {
    Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});




Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::any('/sign-up', [App\Http\Controllers\HomeController::class, 'signUp'])->name('signUp');

Route::get('/company/{id}', [App\Http\Controllers\HomeController::class, 'company'])->name('company.profile');
Route::any('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::any('/save-company', [App\Http\Controllers\HomeController::class, 'saveCompany'])->name('saveCompany');
Route::any('/blogs', [App\Http\Controllers\HomeController::class, 'blogs'])->name('blogs');
Route::any('/blogs/{slug}', [App\Http\Controllers\HomeController::class, 'singleBlog'])->name('blogs.single');
Route::any('/guest/post-a-job', [App\Http\Controllers\HomeController::class, 'postJob'])->name('guest.postJob');

Route::any('/post-a-job', [App\Http\Controllers\UserController::class, 'postJob'])->name('post-job');

Route::group(['middleware' => ['isUser']], function () {
    Route::any('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
    Route::any('/user/fetchjob', [App\Http\Controllers\UserController::class, 'fetchjob'])->name('user.fetchjob');
    Route::any('/user/reviews', [App\Http\Controllers\UserController::class, 'reviews'])->name('user.reviews');
    Route::any('/user/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');

    // deleteJOb
    Route::any('/user/modifyJob/{id}/{type}', [App\Http\Controllers\UserController::class, 'modifyJob'])->name('user.modifyJob');
});

Route::get('/ajax/cat_sub_cat', [App\Http\Controllers\UserController::class, 'cat_subcat'])->name('cat_subcat');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'IsSuperAdmin'], function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::get('category', [App\Http\Controllers\Backend\CategoryController::class, 'category'])->name('category.index');
    Route::post('category-update', [App\Http\Controllers\Backend\CategoryController::class, 'categoryModify'])->name('category.modify');
    Route::get('category-delete/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'categoryDelete'])->name('category.delete');
    Route::get('subcategory', [App\Http\Controllers\Backend\CategoryController::class, 'subCategory'])->name('subcategory.index');
    Route::post('subcategory-update', [App\Http\Controllers\Backend\CategoryController::class, 'subCategoryModify'])->name('subcategory.modify');
    Route::get('subcategory-delete/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');


    Route::get('package', [App\Http\Controllers\Backend\PackageController::class, 'index'])->name('package.index');
    Route::post('package-update', [App\Http\Controllers\Backend\PackageController::class, 'modifyPackage'])->name('package.modify');
    Route::get('company', [UserController::class, 'company'])->name('company.index');
    Route::any('company/edit/{id}', [UserController::class, 'company_edit'])->name('company.edit');
    Route::any('company/update/{id}', [UserController::class, 'company_update'])->name('company.update');
    Route::get('company/show/{id}', [UserController::class, 'company_show'])->name('company.show');
    Route::get('company/approved/{id}', [UserController::class, 'compnayApprove'])->name('company.approved');



    Route::resource('transactions', App\Http\Controllers\Backend\TransactionController::class);


    Route::get('users', [UserController::class, 'users'])->name('users.index');
    Route::any('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::any('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');


    Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
    Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::post('testimonial/update/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::get('testimonial/delete/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');



    Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('blogs/edit/{id}', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::post('blogs/update/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('blogs/delete/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');



    Route::get('jobs', [JobsController::class, 'index'])->name('jobs.index');
    Route::get('jobs/approve/{id}', [JobsController::class, 'approveJob'])->name('jobs.approve');
    Route::get('jobs/delete/{id}', [JobsController::class, 'deleteJob'])->name('jobs.delete');
    Route::get('jobs/view/{id}', [JobsController::class, 'viewJob'])->name('jobs.view');

    Route::get('reviews', [JobsController::class, 'reviews'])->name('reviews.index');
    Route::get('reviews/approve/{id}', [JobsController::class, 'approveReview'])->name('reviews.approve');
    Route::get('reviews/delete/{id}', [JobsController::class, 'deleteReview'])->name('reviews.delete');
    Route::get('reviews/view/{id}', [JobsController::class, 'viewReview'])->name('reviews.view');

    Route::get('pages', [PagesController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PagesController::class, 'create'])->name('pages.create');
    Route::post('pages/store', [PagesController::class, 'store'])->name('pages.store');
    Route::get('pages/edit/{id}', [PagesController::class, 'edit'])->name('pages.edit');
    Route::post('pages/update/{id}', [PagesController::class, 'update'])->name('pages.update');
    Route::get('pages/delete/{id}', [PagesController::class, 'destroy'])->name('pages.destroy');

    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('site-settings/store', [SiteSettingController::class, 'store'])->name('settings.store');
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::any('/payment/stripe/payment', [App\Http\Controllers\StripeController::class, 'stripePost'])->name('payment.stripePost');
Route::any('/payment/stripe/topupFromExisting', [App\Http\Controllers\StripeController::class, 'topupFromExisting'])->name('payment.topupFromExisting');
Route::any('/payment/stripe/cardPayment', [App\Http\Controllers\StripeController::class, 'cardPayment'])->name('payment.cardPayment');
Route::any('/payment/stripe/subscription', [App\Http\Controllers\StripeController::class, 'subscription'])->name('payment.subscription');
Route::group(['as' => 'tasker.'], function () {
    Route::middleware(['guest'])->group(function () {
        Route::any('step1', [App\Http\Controllers\Tasker\AuthController::class, 'step1'])->name('register.step1');
        Route::any('step2', [App\Http\Controllers\Tasker\AuthController::class, 'step2'])->name('register.step2');
        Route::any('step3', [App\Http\Controllers\Tasker\AuthController::class, 'step3'])->name('register.step3');
        Route::any('step4', [App\Http\Controllers\Tasker\AuthController::class, 'step4'])->name('register.step4');
        Route::any('step5', [App\Http\Controllers\Tasker\AuthController::class, 'step5'])->name('register.step5');
        Route::post('store', [App\Http\Controllers\Tasker\AuthController::class, 'store'])->name('register.store');
    });
    Route::any('getSubCategory', [App\Http\Controllers\Tasker\AuthController::class, 'getSubCategory'])->name('register.getSubCategory');
    Route::any('getSubCategorySetp2', [App\Http\Controllers\Tasker\AuthController::class, 'getSubCategorySetp2'])->name('register.getSubCategorySetp2');


    Route::middleware(['isTasker'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Tasker\DashboardController::class, 'dashboard'])->name('dashboard');
        Route::any('account', [App\Http\Controllers\Tasker\DashboardController::class, 'account'])->name('account');
        Route::get('membership', [App\Http\Controllers\Tasker\DashboardController::class, 'membership'])->name('membership');
        Route::any('subscriptionrenew', [App\Http\Controllers\Tasker\DashboardController::class, 'subscriptionrenew'])->name('subscriptionrenew');
        Route::any('subscriptioncancel', [App\Http\Controllers\Tasker\DashboardController::class, 'subscriptioncancel'])->name('subscriptioncancel');
        Route::any('my-billing-portal', [App\Http\Controllers\Tasker\DashboardController::class, 'mybillingPoral'])->name('mybillingPoral');
        Route::any('skills', [App\Http\Controllers\Tasker\DashboardController::class, 'skills'])->name('skills');
        Route::get('jobs', [App\Http\Controllers\Tasker\DashboardController::class, 'jobs'])->name('jobs');
        Route::get('credits', [App\Http\Controllers\Tasker\DashboardController::class, 'credits'])->name('credits');
        Route::get('saved-job', [App\Http\Controllers\Tasker\DashboardController::class, 'savedJob'])->name('saveJob');
        Route::get('save-job/{id}', [App\Http\Controllers\Tasker\DashboardController::class, 'saveJob'])->name('saveThisJob');
        Route::post('applyJob', [App\Http\Controllers\Tasker\DashboardController::class, 'applyJob'])->name('applyJob');
        Route::get('profile', [App\Http\Controllers\Tasker\AuthController::class, 'profile'])->name('profile');
        // Route::get('onboarding', [App\Http\Controllers\Tasker\AuthController::class, 'onboarding'])->name('onboarding');
        Route::get('remove-skill/{id}', [App\Http\Controllers\Tasker\DashboardController::class, 'removeSkill'])->name('removeSkill');
    });
    Route::any('onboarding', [App\Http\Controllers\Tasker\AuthController::class, 'onboarding'])->name('onboarding');
});


Route::any('/give-feedback', [App\Http\Controllers\UserController::class, 'giveFeedback'])->name('giveFeedback');
Route::any('/ajax/ajaxCompany', [App\Http\Controllers\UserController::class, 'ajaxCompany'])->name('ajaxCompany');
Route::any('/give-feedback/{id}', [App\Http\Controllers\UserController::class, 'giveFeedbackCompany'])->name('giveFeedbackCompany');
Route::any('/storeReview', [App\Http\Controllers\UserController::class, 'storeReview'])->name('storeReview');
Page::all()->map(function ($page) {
    // dd('/pages/{' . $page->slug . '}');
    Route::get('/pages/{slug}', [App\Http\Controllers\HomeController::class, 'page'])->name("web.$page->slug");
});
