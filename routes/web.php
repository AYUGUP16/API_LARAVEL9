<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Admincontroller;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\ParentCategoryController;
use App\Http\Controllers\admin\ChildCategoryController;
use App\Http\Controllers\admin\SubChildCategoryController;
use App\Http\Controllers\admin\SubadminController;
use App\Http\Controllers\admin\PlanController;

// use App\Http\Controllers\admin\VendorController;

use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\BlogsController;

//use App\Http\Middleware\Adminlogincheck;
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

Route::get('/', function () {
    return view('front/welcome');
});


Route::view('admin/signup','admin/signup')->name('signup');
//Route::view('admin/dashboard','admin/dashboard');

Route::post('admin/user_login', [Admincontroller::class,'user_login_func'] );
Route::post('admin/register', [Admincontroller::class,'user_registration_func'] );
Route::get('signout', [Admincontroller::class, 'signOut'])->name('signout');


//Logged-in user
Route::group(['middleware' => ['auth']],function(){
	
	Route::view('/admin','admin/dashboard')->name('dashboard');
	Route::view('admin/dashboard','admin/dashboard')->name('dashboard');
	//Route::view('admin/add-subadmin','admin/add-subadmin');

	Route::get('admin/all-user',[AdminUserController::class,'get_users_list'])->name('all_users');
	Route::post('admin/insert-users', [AdminUserController::class,'insert_users']);
	Route::post('admin/edit-users', [AdminUserController::class,'edit_users']);
	Route::post('admin/check-email-existance', [AdminUserController::class,'check_email_existance']);

	Route::get('admin/subadmins', [SubadminController::class, 'get_subadmins_list'])->name('get_subadmins');
	Route::post('admin/insert-subadmin', [SubadminController::class,'insert_subadmin']);
	Route::post('admin/check-user-existance',[SubadminController::class,'check_user_existance']);
	Route::post('admin/edit-subadmin',[SubadminController::class,'edit_subadmin']);
	//Route::get('admin/edit-subadmin/{id}',[SubadminController::class, 'get_single_subadmin'])->name('edit_subadmins');
	//Route::get('admin/update-subadmin',[SubadminController::class, 'get_single_subadmin'])->name('update_subadmins');

	Route::get('admin/vendors',[VendorController::class,'get_vendors_list'])->name('get_vendors');

	Route::get('admin/parent-categories', [ParentCategoryController::class, 'get_parent_categories_list'])->name('get_parent_categories');
	Route::post('admin/insert-parentcat', [ParentCategoryController::class, 'insert_parent_cat']);
	Route::post('admin/edit-parentcat', [ParentCategoryController::class, 'edit_parent_cat']);

	Route::get('admin/child-categories', [ChildCategoryController::class,'get_child_categories_list'])->name('get_child_categories');
	Route::post('admin/insert-childcat',[ChildCategoryController::class, 'insert_child_cat']);
	Route::post('admin/edit-childcat', [ChildCategoryController::class,'edit_childcat']);

	Route::get('admin/sub-child-categories', [SubChildCategoryController::class,'get_subchild_categories_list'])->name('get_subchild_categories');
    Route::post('admin/insert-subchildcat', [SubChildCategoryController::class, 'insert_subchild_cat']);
    Route::post('admin/get-child-acc-to-parent', [SubChildCategoryController::class, 'get_child_acc_to_parent']);
    Route::post('admin/edit-subchildcat',[SubChildCategoryController::class, 'edit_subchildcat']);

    Route::view('admin/all-pages','admin/pages/index')->name('allpageslist');
    Route::get('admin/edit-page/{pagename}',[PagesController::class,'editpages'])->name('editpages');

    Route::get('admin/all-blogs',[BlogsController::class,'all_blogs_list'])->name('allblogslist');
    Route::post('admin/insert-blog', [BlogsController::class, 'insert_blog']);
    Route::post('admin/edit-blog', [BlogsController::class, 'edit_blog']);
	// Route::get('admin/add-plan', [BlogsController::class, 'plans'])->name('add_plans');

	Route::get('admin/add-plan', [PlanController::class, 'index']);
	Route::post('admin/create-plan', [PlanController::class, 'create'])->name('add_plans');
	Route::get('admin/list-plan', [PlanController::class, 'show'])->name('show_plans');
	Route::get('admin/delete-plan/{id}', [PlanController::class, 'deleteplan']);
	Route::get('admin/edit-plan', [PlanController::class, 'edit'])->name('edit_plan');
Route::get('admin/update-plan/{id}', [PlanController::class, 'updateplan']);
	Route::post('admin/plan-update/{id}', [PlanController::class, 'update'])->name('update_plan');

	
});
//Non-logged-in user
Route::group(['middleware' => ['guest']],function(){
	Route::view('admin/login','admin/auth/login')->name('login');
	Route::view('admin/forgot-password','admin/auth/forgot-password')->name('password.request');
});

Route::post('admin/recover-password', [Admincontroller::class,'recover_password_func'] );
Route::post('admin/reset-password', [Admincontroller::class,'reset_password_func'] );
Route::get('/reset-password/{token}', function ($token) {
    return view('admin.auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

//Route::view('admin/profile','admin/profile');
Route::get('admin/profile', [Admincontroller::class,'get_admin_generalinfo']);
Route::post('admin/admin_general_info', [Admincontroller::class,'update_admin_generalinfo'] );
Route::post('upload-images', [ Admincontroller::class, 'storeImage' ])->name('uploadimage');