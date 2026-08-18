<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DevPreviewController;
use App\Http\Controllers\Exam\Admin\ManageExamController;
use App\Http\Controllers\Exam\Admin\AdminController as ExamAdminController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SettingsController;

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

// Exam portal (exams.step.technology) — merged in from the standalone exam
// app. Domain-scoped so its routes (many of which share the same paths as
// step's own, e.g. /login, /admin/index) only match on that subdomain.
Route::domain('exams.step.technology')->group(function () {
    require base_path('routes/exam.php');
});

// Unlinked internal preview of the Tailwind design system foundation.
// Not part of the live site — see docs/superpowers/specs/2026-08-18-tailwind-design-system-foundation-design.md
Route::get('/dev/style-guide', [DevPreviewController::class, 'styleGuide']);

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/about-coretep', [PageController::class, 'about_coretep']);
Route::get('/step-support', [PageController::class, 'support']);
Route::get('/memberships', [PageController::class, 'membership']);
Route::get('/trainings', [PageController::class, 'trainings']);
Route::get('/journal-publication', [PageController::class, 'journal_publication']);
Route::get('/certifications', [PageController::class, 'certifications']);
Route::any('/contact', [PageController::class, 'contact']);
Route::get('/blog', [PageController::class, 'blog']);
Route::get('/blog/{blog_id}/{slug}', [PageController::class, 'blog_detials']);
Route::get('/events', [PageController::class, 'event']);
Route::get('/events/{event_id}/{slug}', [PageController::class, 'event_detials']);
Route::any('/adminlogin', [PageController::class, 'adminlogin'])->middleware('throttle:10,1');
Route::get('/refresh_captcha', [PageController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::get('/email', [PageController::class, 'email']);
Route::any('/ICTES2025', [PageController::class, 'conference']);

//Account Section
Route::any('/join', [AccountController::class, 'login'])->middleware('throttle:10,1');
Route::any('/login', [AccountController::class, 'login'])->middleware('throttle:10,1');
Route::any('/register-undergraduate', [AccountController::class, 'register_undergraduate'])->middleware('throttle:10,1');
Route::any('/register-young-professional', [AccountController::class, 'register_young_professional'])->middleware('throttle:10,1');
Route::any('/register', [AccountController::class, 'register_young_professional'])->middleware('throttle:10,1');
Route::any('/register-corporate-professional', [AccountController::class, 'register_corporate_professional'])->middleware('throttle:10,1');
Route::any('/register-corporate-organization', [AccountController::class, 'register_corporate_organization'])->middleware('throttle:10,1');
Route::get('/verifyaccount/{id}/{token}', [AccountController::class, 'verifyaccount']);
Route::any('/forgot-password', [AccountController::class, 'forgot_password'])->middleware('throttle:10,1');
Route::any('/reset-password/{id}/{token}', [AccountController::class, 'reset_password'])->middleware('throttle:10,1');


//Admin Section
Route::get('/admin/index', [AdminController::class, 'index'])->middleware('adminsession');
Route::get('/admin/users', [AdminController::class, 'users'])->middleware('adminsession');
Route::get('/admin/export-users', [AdminController::class, 'export'])->middleware('adminsession');
Route::get('/admin/logout', [AdminController::class, 'logout'])->middleware('adminsession');



//Events Sections
Route::any('/event/new-post', [EventController::class, 'new_post'])->middleware('adminsession');
Route::get('/event/all-events', [EventController::class, 'all_post'])->middleware('adminsession');
Route::any('/event/post-status/{event_id}/{status}', [EventController::class, 'post_status'])->middleware('adminsession');
Route::any('/event/edit-post/{event_id}', [EventController::class, 'edit_post'])->middleware('adminsession');
Route::any('/event/delete-post/{event_id}', [EventController::class, 'delete_post'])->middleware('adminsession');



//Blog Sections
Route::any('/blogpost/new-post', [BlogController::class, 'new_post'])->middleware('adminsession');
Route::get('/blogpost/all-post', [BlogController::class, 'all_post'])->middleware('adminsession');
Route::any('/blogpost/post-status/{blog_id}/{status}', [BlogController::class, 'post_status'])->middleware('adminsession');
Route::any('/blogpost/edit-post/{blog_id}', [BlogController::class, 'edit_post'])->middleware('adminsession');
Route::any('/blogpost/delete-post/{blog_id}', [BlogController::class, 'delete_post'])->middleware('adminsession');

// Trix Upload
Route::post('/trix-upload', [BlogController::class, 'trixUpload'])->name('trix.upload');
Route::post('/ckeditor/upload', [BlogController::class, 'upload'])->name('ckeditor.upload');

//User Dashboard Section
Route::get('/user/index', [UserController::class, 'index'])->middleware('usersession');
Route::any('/user/profile', [UserController::class, 'profile'])->middleware('usersession');
Route::any('/user/membership', [UserController::class, 'membership'])->middleware('usersession');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('usersession');

//Payment Confirmation
Route::any('/admin/payment', [AdminController::class, 'payment'])->middleware('adminsession');
Route::any('/admin/confirm-payment/{user_id}', [AdminController::class, 'confirm_payment'])->middleware('adminsession');

// Exam Portal management — folded into the unified admin CMS so there's one
// login/nav for both step's own content and the exam portal's questions and
// enrollments (previously split across step.technology/admin and
// exams.step.technology/admin as two separate admin panels).
Route::any('/admin/questions/new', [ManageExamController::class, 'new_question'])->middleware('adminsession');
Route::get('/admin/questions', [ManageExamController::class, 'index'])->name('questions.index')->middleware('adminsession');
Route::get('/admin/questions/{id}/edit', [ManageExamController::class, 'edit'])->name('questions.edit')->middleware('adminsession');
Route::put('/admin/questions/{id}', [ManageExamController::class, 'update'])->name('questions.update')->middleware('adminsession');
Route::get('/admin/enrollments', [ExamAdminController::class, 'enrollments'])->middleware('adminsession');
Route::get('/admin/exam-status/{id}/{status}', [ExamAdminController::class, 'exam_status'])->middleware('adminsession');

// Settings
Route::get('/admin/settings', [SettingsController::class, 'edit'])->middleware('adminsession');
Route::put('/admin/settings', [SettingsController::class, 'update'])->middleware('adminsession');
Route::post('/admin/settings/password', [SettingsController::class, 'updatePassword'])->middleware('adminsession');


