<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Empty_;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[HomeController::class,'login'])->name('login');
Route::post('login',[HomeController::class,'Authlogin'])->name('Authlogin');
Route::get('signup',[HomeController::class,'signup'])->name('signup');
Route::post('signup',[HomeController::class,'register'])->name('register');
Route::post('logout', [HomeController::class, 'logout'])->name('logout');
 
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/project', [ProjectController::class, 'getProject'])->name('admin.project');
    Route::post('admin/project/Create', [ProjectController::class, 'createProject'])->name('admin.add.project');
    Route::get('admin/project/edit/{id}', [ProjectController::class, 'projectEdit'])->name('admin.project.edit');
    Route::post('admin/project/edit/{id}', [ProjectController::class, 'projectUpdate'])->name('admin.project.update');
    Route::get('admin/project/delete/{id}', [ProjectController::class, 'projectDelete'])->name('admin.project.delete');
    Route::get('admin/task/comment/{id}', [CommentController::class, 'taskCommentList'])->name('admin.comment.task.list');
    Route::get('admin/task/list/{id}', [TaskController::class, 'TaskList'])->name('admin.get.task.list');
    Route::get('admin/download/report/{id}', [TaskController::class, 'getPDF'])->name('admin.download.pdf');
    Route::get('admin/chart/view/{id}', [TaskController::class, 'getChart'])->name('admin.chart.view');
    Route::get('admin/tasks/chart', [TaskController::class, 'showChart'])->name('admin.chart');
    Route::get('admin/tasks/search', [TaskController::class, 'searchTask'])->name('admin.search');
    Route::get('admin/tasks/search-data', [TaskController::class, 'searchTaskData'])->name('admin.search.data');
});

Route::middleware(['auth', 'role:Manager'])->group(function () {
    Route::get('manager/dashboard', [HomeController::class, 'index'])->name('manager.dashboard');
    Route::get('manager/task', [TaskController::class, 'getTask'])->name('manage.task');
    Route::post('manager/task/Assign', [TaskController::class, 'taskAssign'])->name('manage.task.assign');
    Route::get('manager/task/{id}', [TaskController::class, 'taskEdit'])->name('manage.task.edit');
    Route::get('manager/task/delete/{id}', [TaskController::class, 'taskDelete'])->name('manage.task.delete');
    Route::post('manager/task/{id}', [TaskController::class, 'taskUpdate'])->name('manage.task.update');
    Route::get('manager/task/comment/{id}', [CommentController::class, 'taskCommentList'])->name('manager.comment.task.list');


});

Route::middleware(['auth', 'role:Employee'])->group(function () {
    Route::get('employee/dashboard', [HomeController::class, 'index'])->name('employee.dashboard');
    Route::get('Employe/task/list', [EmployeController::class, 'getUserTask'])->name('user.task.list');
    Route::get('employe/task/{id}', [EmployeController::class, 'getTaskEdit'])->name('user.task.edit');
    Route::post('employe/task/{id}', [EmployeController::class, 'getTaskStatus'])->name('employe.task.update');
    Route::get('Employe/task/comment/{id}', [CommentController::class, 'taskCommentList'])->name('employe.comment.task.list');
    
});
Route::post('Employe/task/comment/{id}', [CommentController::class, 'taskComment'])->name('employe.comment.task');


// chart
Route::get('/tasks/chart', [TaskController::class, 'showChart']);


// tesing mail 
Route::get('/send-mail', function () {
    $user = User::findOrFail(1);
    // Email details
    $details = [
        'title' => 'Mail from gtech.com',
        'body' => 'This is for testing email using SMTP'
    ];
    // Send email
    Mail::to($user->email)->send(new \App\Mail\TaskNotificationMail($details));
    dd("Email is Sent.");
    return view('welcome');
});
//  tesing mail