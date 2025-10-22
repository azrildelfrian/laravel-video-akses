<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\VideoRequestController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\VideoController as CustomerVideoController;

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

// Route::get('/', function () {
//     return view('template/master');
// });

Route::get('/', function () {
    return redirect('login');
});
Route::get('/redirect-login', function () {
    if (auth()->user()->role === 'admin') {
        return redirect('/admin/dashboard');
    }
    return redirect('/customer/dashboard');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // route admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/videos', AdminVideoController::class);
    Route::resource('/admin/users', AdminUserController::class);

    Route::get('/admin/video-requests', [VideoRequestController::class, 'index'])->name('admin.video_requests.index');
    Route::post('/admin/video-requests/{id}/approve', [VideoRequestController::class, 'approve'])->name('admin.video_requests.approve');
    Route::post('/admin/video-requests/{id}/reject', [VideoRequestController::class, 'reject'])->name('admin.video_requests.reject');
});
Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    // route customer
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/videos', [CustomerVideoController::class, 'index'])->name('customer.videos.index');
    Route::get('/videos/{video}', [CustomerVideoController::class, 'show'])->name('customer.videos.show');
    Route::post('/videos/{video}/request-time', [CustomerVideoController::class, 'requestTime'])->name('customer.videos.requestTime');
});


require __DIR__ . '/auth.php';
