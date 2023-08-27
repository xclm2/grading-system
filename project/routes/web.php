<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
Use App\Models\Subject;
use Illuminate\Support\Facades\DB;

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
    if (Auth::check()) {
        return view('user.admin.dashboard.updates');
    }
    return view('user.login');
})->name('home');

Route::prefix('user')->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('createTestAccount', 'createTest');
        Route::post('login', 'login');
        Route::get('logout', function(Request $request) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->intended();
        });
    });
});

Route::controller(AdminController::class)->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('users', 'users')->middleware('auth');
        Route::get('config', 'users')->middleware('auth');
    });
    
    /** TODO: Use Route::resource instead */
    Route::prefix('admin/instructor')->group(function() {
        Route::get('list', 'instructorList')->middleware('auth');
        Route::get('add', 'instructorAdd')->middleware('auth');
        Route::post('save', 'instructorSave')->middleware('auth');
    });

    Route::prefix('admin/subject')->group(function() {
        Route::get('list/{query?}', 'subjectList')->middleware('auth');
        Route::get('search/{query?}', 'subjectSearch')->middleware('auth');
        Route::post('save', 'subjectSave')->middleware('auth');
        Route::delete('delete', 'subjectDelete')->middleware('auth');
        Route::delete('massDelete/{ids?}', 'massDeleteSubject')->middleware('auth');
    });
});

Route::get('/admin/config', function() {
    return view('user.admin.config.main');
});

Route::get('/admin/config/general', function() {
    return view('user.admin.config.main.general');
});

Route::get('/customer', function(Request $request) {
    var_dump($request->get('test'));
});
// Route::get('/login', function(Request $request) {
//     return view('customer.sign-in');
// });
Route::get('/register', function(Request $request) {
    return view('user.registration');
});

Route::get('/customer/id/{id}', function($id) {
    return view('customer',['name' => $id]);
});

Route::get('/test/page/{no}', function($no) {
    $user =  DB::table('users')->paginate(15);
    print_r($user);
});

Route::redirect('/redirectme','/greet');

Route::get('/user/profile', function () {
    //
})->name('profile');