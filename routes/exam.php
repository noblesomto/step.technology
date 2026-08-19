<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Exam\UserController;
use App\Http\Controllers\Exam\AccountController;

/*
|--------------------------------------------------------------------------
| Exam routes (exams.step.technology)
|--------------------------------------------------------------------------
|
| Merged in from the standalone exam app. Loaded only inside the
| Route::domain('exams.step.technology') group in routes/web.php.
|
*/

Route::any('/', [AccountController::class, 'login'])->middleware('throttle:10,1');
Route::any('/login', [AccountController::class, 'login'])->middleware('throttle:10,1');
Route::get('/verifyaccount/{id}/{token}', [AccountController::class, 'verifyaccount']);
Route::any('/authenticate', [AccountController::class, 'authenticate'])->middleware('throttle:10,1');
Route::any('/resend-otp', [AccountController::class, 'resend_otp'])->middleware('throttle:10,1');
Route::any('/forgot-password', [AccountController::class, 'forgot_password'])->middleware('throttle:10,1');
Route::any('/reset-password/{id}/{token}', [AccountController::class, 'reset_password'])->middleware('throttle:10,1');

// Admin login now lives on the unified admin CMS (step.technology) —
// redirect rather than serve a second login form here.
Route::any('/admin', function () {
    return redirect('https://step.technology/adminlogin');
});

// User Dashboard Section
Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('usersession');
Route::get('/user/start-exam', [UserController::class, 'start_exam'])->name('exam.start')->middleware('usersession');
Route::post('/user/save-exam-progress', [UserController::class, 'saveProgress'])->name('user.save-exam-progress')->middleware('usersession');
Route::post('/user/submit-exam', [UserController::class, 'submitExam'])->name('user.submit-exam')->middleware('usersession');
Route::get('/user/exam-done', [UserController::class, 'exam_done'])->name('user.exam-done')->middleware('usersession');
Route::any('/user/profile', [UserController::class, 'profile'])->middleware('usersession');
Route::get('/user/logout', [UserController::class, 'logout'])->middleware('usersession');

// The entire admin section — dashboard, questions, enrollments — now lives
// on the unified admin CMS at step.technology/admin/*. Redirect any old
// bookmarks/links here rather than serving a second admin panel.
Route::any('/admin/{any}', function () {
    return redirect('https://step.technology/adminlogin');
})->where('any', '.*');
