<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffApplicationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ContactController;

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
    
    // NEW: Forgot Password
    Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Contact Form Route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// TEST ROUTE - Remove this after testing
Route::view('/test-pages', 'test-pages')->name('test.pages');

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

        // Customer static pages
        Route::view('/services', 'customer.services')->name('customer.services');
        Route::resource('bookings', \App\Http\Controllers\ServiceBookingController::class);
        Route::view('/vehicles', 'customer.vehicles.index')->name('customer.vehicles');
        Route::view('/history', 'customer.history')->name('customer.history');
        Route::view('/rentals', 'customer.rentals')->name('customer.rentals');
        Route::view('/settings', 'customer.settings')->name('customer.settings');
        
        // NEW: Customer payment pages
        Route::view('/payments', 'customer.payments')->name('customer.payments');
        Route::view('/payment-history', 'customer.payment-history')->name('customer.payment-history');
    });

    // Staff Profile Routes
    Route::prefix('staff')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\StaffProfileController::class, 'index'])->name('staff.profile');
        Route::post('/profile/update', [\App\Http\Controllers\StaffProfileController::class, 'updateProfile'])->name('staff.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\StaffProfileController::class, 'updatePassword'])->name('staff.profile.password');

        // Staff static pages
        Route::view('/service-logs', 'staff.service-logs')->name('staff.service.logs');
        Route::view('/inventory', 'staff.inventory')->name('staff.inventory');
        Route::view('/customers', 'staff.customers')->name('staff.customers');
        Route::view('/settings', 'staff.profile-settings')->name('staff.settings');
        
        // NEW: Staff service details
        Route::view('/services/{id}', 'staff.services.show')->name('staff.services.show');
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

        // Contact Messages
        Route::get('/contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
        Route::get('/contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('admin.contact-messages.show');
        Route::post('/contact-messages/{id}/status', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateStatus'])->name('admin.contact-messages.updateStatus');
        Route::delete('/contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
        
        // Admin Service Management
        Route::get('/services', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'index'])->name('admin.services');
        Route::post('/services/{id}/assign', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'assign'])->name('admin.services.assign');
        Route::post('/services/{id}/status', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'updateStatus'])->name('admin.services.status');
        
        // NEW: Rental Management
        Route::view('/rentals', 'admin.rentals')->name('admin.rentals');
        
        // NEW: Stock Management
        Route::view('/stock', 'admin.stock')->name('admin.stock');
        
        // NEW: Issues Management
        Route::view('/issues', 'admin.issues')->name('admin.issues');
    });
});

// Additional customer UI routes (protected)
Route::middleware(['auth', 'check.staff.status'])->group(function () {
    // Requests
    Route::get('/customer/requests', function () {
        return view('customer.requests.index');
    })->name('customer.requests.index');

    Route::get('/customer/requests/create', function () {
        return view('customer.requests.create');
    })->name('customer.requests.create');
    
    // NEW: Service request details
    Route::get('/customer/requests/{id}', function () {
        return view('customer.requests.show');
    })->name('customer.requests.show');
    
    // NEW: Notifications
    Route::view('/notifications', 'notifications.index')->name('notifications.index');
    
    // NEW: Search
    Route::view('/search', 'search.index')->name('search.index');
});

// Staff context
Route::middleware(['auth', 'check.staff.status'])->prefix('staff')->group(function () {
    Route::get('/bookings', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'index'])->name('staff.bookings');
    Route::post('/bookings/{id}/status', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'updateStatus'])->name('staff.bookings.status');
    Route::get('/services/{id}', function ($id) {
         $booking = \App\Models\ServiceBooking::with('customer')->findOrFail($id);
         return view('staff.services.show', compact('booking'));
    })->name('staff.services.show');
});

// Staff status pages
Route::view('/staff/pending', 'staff.pending')->name('staff.pending')->middleware('auth');
Route::view('/staff/rejected', 'staff.rejected')->name('staff.rejected');
