<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffApplicationController;
use App\Http\Controllers\Admin\UserManagementController;

// Landing Page - Redirect authenticated users to their dashboard
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        
        // Get user role - prioritize instance check
        $role = 'customer'; // default
        
        // Check user type by class FIRST (most reliable)
        if ($user instanceof \App\Models\Admin) {
            $role = 'admin';
        } elseif ($user instanceof \App\Models\StaffMember) {
            $role = 'staff';
        } elseif ($user instanceof \App\Models\CustomerUser) {
            $role = 'customer';
        } elseif (method_exists($user, 'getRoleAttribute')) {
            $role = $user->getRoleAttribute() ?? 'customer';
        } elseif (isset($user->role)) {
            $role = $user->role ?? 'customer';
        }
        
        return redirect()->route('dashboard.' . $role);
    }
    
    return view('index');
})->name('index');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/register/success', function () {
        return view('auth.register-success');
    })->name('register.success');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware(['auth', 'check.staff.status'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('dashboard.customer');
    Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->name('dashboard.staff');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');

    // Customer Profile Routes
    Route::prefix('customer')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\CustomerProfileController::class, 'index'])->name('customer.profile');
        Route::post('/profile/update', [\App\Http\Controllers\CustomerProfileController::class, 'updateProfile'])->name('customer.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\CustomerProfileController::class, 'updatePassword'])->name('customer.profile.password');
    });

    // Staff Profile Routes
    Route::prefix('staff')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\StaffProfileController::class, 'index'])->name('staff.profile');
        Route::post('/profile/update', [\App\Http\Controllers\StaffProfileController::class, 'updateProfile'])->name('staff.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\StaffProfileController::class, 'updatePassword'])->name('staff.profile.password');
    });

    // Admin Staff Applications
    Route::prefix('admin')->group(function () {
        Route::get('/staff-applications', [StaffApplicationController::class, 'index'])->name('admin.staff-applications.index');
        Route::post('/staff-applications/{staff}/approve', [StaffApplicationController::class, 'approve'])->name('admin.staff-applications.approve');
        Route::post('/staff-applications/{staff}/reject', [StaffApplicationController::class, 'reject'])->name('admin.staff-applications.reject');
        Route::post('/staff-applications/{staff}/role', [StaffApplicationController::class, 'updateRole'])->name('admin.staff-applications.updateRole');
        Route::delete('/staff-applications/{staff}', [StaffApplicationController::class, 'destroy'])->name('admin.staff-applications.destroy');

        Route::get('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile/update', [\App\Http\Controllers\Admin\AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\Admin\AdminProfileController::class, 'updatePassword'])->name('admin.profile.password');

        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
        Route::get('/users/{id}', [UserManagementController::class, 'show'])->name('admin.users.show');
        Route::post('/users/{id}/status', [UserManagementController::class, 'updateStatus'])->name('admin.users.updateStatus');
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/vehicles', function () {
            abort_unless(auth()->user()?->role === 'admin', 403);
            return view('admin.vehicles');
        })->name('admin.vehicles');

        Route::get('/analytics', function () {
            abort_unless(auth()->user()?->role === 'admin', 403);
            return view('admin.analytics');
        })->name('admin.analytics');

        Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings/general', [\App\Http\Controllers\Admin\SettingsController::class, 'updateGeneral'])->name('admin.settings.general');
        Route::post('/settings/service', [\App\Http\Controllers\Admin\SettingsController::class, 'updateService'])->name('admin.settings.service');
        Route::post('/settings/notification', [\App\Http\Controllers\Admin\SettingsController::class, 'updateNotification'])->name('admin.settings.notification');
        Route::post('/settings/display', [\App\Http\Controllers\Admin\SettingsController::class, 'updateDisplay'])->name('admin.settings.display');
        Route::post('/settings/security', [\App\Http\Controllers\Admin\SettingsController::class, 'updateSecurity'])->name('admin.settings.security');
    });
});

// Staff status pages
Route::view('/staff/pending', 'staff.pending')->name('staff.pending')->middleware('auth');
Route::view('/staff/rejected', 'staff.rejected')->name('staff.rejected');
