<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

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

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
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
Route::any('/adminlogin', [PageController::class, 'adminlogin']);
Route::get('/refresh_captcha', [PageController::class, 'refreshCaptcha'])->name('refresh_captcha');

//Account Section
Route::any('/join', [AccountController::class, 'login']);
Route::any('/login', [AccountController::class, 'login']);
Route::any('/register-undergraduate', [AccountController::class, 'register_undergraduate']);
Route::any('/register-young-professional', [AccountController::class, 'register_young_professional']);
Route::any('/register', [AccountController::class, 'register_young_professional']);
Route::any('/register-corporate-professional', [AccountController::class, 'register_corporate_professional']);
Route::any('/register-corporate-organization', [AccountController::class, 'register_corporate_organization']);
Route::get('/verifyaccount/{id}/{token}', [AccountController::class, 'verifyaccount']);
Route::any('/forgot-password', [AccountController::class, 'forgot_password']);
Route::any('/reset-password/{id}/{token}', [AccountController::class, 'reset_password']);


//Admin Section
Route::get('/admin/index', [AdminController::class, 'index'])->middleware('adminsession');
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


//User Dashboard Section
Route::get('/user/index', [UserController::class, 'index'])->middleware('usersession');
Route::any('/user/profile', [UserController::class, 'profile'])->middleware('usersession');
Route::any('/user/membership', [UserController::class, 'membership'])->middleware('usersession');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('usersession');

Route::post('ckeditor/upload', [PageController::class, 'ckeditor'])->name('ckeditor.image-upload');


//Payment Confirmation
Route::any('/admin/payment', [AdminController::class, 'payment']);
Route::any('/admin/confirm-payment/{user_id}', [AdminController::class, 'confirm_payment']);