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
    $role = getAuthenticatedUserRole();
    if ($role) {
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
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('multi.auth');

// Contact Form Route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// TEST ROUTE - Remove this after testing
Route::view('/test-pages', 'test-pages')->name('test.pages');

// Protected Routes
Route::middleware(['multi.auth', 'check.staff.status'])->group(function () {
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
        Route::post('bookings/{id}/cancel', [\App\Http\Controllers\ServiceBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::post('bookings/{id}/reschedule', [\App\Http\Controllers\ServiceBookingController::class, 'reschedule'])->name('bookings.reschedule');
        Route::post('bookings/{id}/accept', [\App\Http\Controllers\ServiceBookingController::class, 'accept'])->name('bookings.accept');
        Route::get('bookings/{id}/invoice', [\App\Http\Controllers\ServiceBookingController::class, 'invoice'])->name('bookings.invoice');
        Route::get('/vehicles', [\App\Http\Controllers\VehicleController::class, 'index'])->name('customer.vehicles');
        Route::post('/vehicles', [\App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles/{vehicle}/edit', [\App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::put('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
        Route::post('/vehicles/{vehicle}/rent', [\App\Http\Controllers\VehicleController::class, 'toggleRent'])->name('vehicles.toggle-rent');
        Route::delete('/vehicles/{vehicle}', [\App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destroy');
        Route::get('/rent-vehicles', [\App\Http\Controllers\VehicleController::class, 'rentIndex'])->name('customer.rent-vehicles');
        Route::post('/rent-vehicles/request', [\App\Http\Controllers\RentalRequestController::class, 'store'])->name('rent-vehicles.request');
        Route::post('/rentals/{request}/approve', [\App\Http\Controllers\RentalRequestController::class, 'approve'])->name('rentals.approve');
        Route::post('/rentals/{request}/reject', [\App\Http\Controllers\RentalRequestController::class, 'reject'])->name('rentals.reject');
        Route::post('/rentals/{request}/pay', [\App\Http\Controllers\RentalRequestController::class, 'pay'])->name('rentals.pay');
        Route::post('/rentals/{request}/return', [\App\Http\Controllers\RentalRequestController::class, 'markReturned'])->name('rentals.return');
        Route::view('/history', 'customer.history')->name('customer.history');
        Route::get('/rentals', [\App\Http\Controllers\RentalRequestController::class, 'index'])->name('customer.rentals');
        Route::view('/settings', 'customer.settings')->name('customer.settings');
        
        // NEW: Customer payment pages
        Route::view('/payments', 'customer.payments')->name('customer.payments');
        Route::get('/payment-history', [\App\Http\Controllers\PaymentHistoryController::class, 'index'])->name('customer.payment-history');
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
            abort_unless(getAuthenticatedUserRole() === 'admin', 403);
            return view('admin.vehicles');
        })->name('admin.vehicles');

        Route::get('/analytics', function () {
            abort_unless(getAuthenticatedUserRole() === 'admin', 403);
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
        Route::post('/services/{id}/approve', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'approve'])->name('admin.services.approve');
        Route::post('/services/{id}/reject', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'reject'])->name('admin.services.reject');
        
        // Rental Management (Admin)
        Route::get('/rentals', [\App\Http\Controllers\Admin\RentalManagementController::class, 'dashboard'])->name('admin.rentals.dashboard');
        Route::get('/rentals/quick-approval', [\App\Http\Controllers\Admin\RentalManagementController::class, 'quickApproval'])->name('admin.rentals.quick-approval');
        Route::get('/rentals/vehicles', [\App\Http\Controllers\Admin\RentalManagementController::class, 'vehicles'])->name('admin.rentals.vehicles');
        Route::post('/rentals/vehicles', [\App\Http\Controllers\Admin\RentalManagementController::class, 'storeVehicle'])->name('admin.rentals.vehicles.store');
        Route::put('/rentals/vehicles/{vehicle}', [\App\Http\Controllers\Admin\RentalManagementController::class, 'updateVehicle'])->name('admin.rentals.vehicles.update');
        Route::delete('/rentals/vehicles/{vehicle}', [\App\Http\Controllers\Admin\RentalManagementController::class, 'destroyVehicle'])->name('admin.rentals.vehicles.destroy');
        Route::get('/rentals/pending-listings', [\App\Http\Controllers\Admin\RentalManagementController::class, 'pendingListings'])->name('admin.rentals.pending-listings');
        Route::post('/rentals/pending-listings/{vehicle}/approve', [\App\Http\Controllers\Admin\RentalManagementController::class, 'approveVehicleListing'])->name('admin.rentals.pending-listings.approve');
        Route::post('/rentals/pending-listings/{vehicle}/reject', [\App\Http\Controllers\Admin\RentalManagementController::class, 'rejectVehicleListing'])->name('admin.rentals.pending-listings.reject');
        Route::get('/rentals/requests', [\App\Http\Controllers\Admin\RentalManagementController::class, 'requests'])->name('admin.rentals.requests');
        Route::post('/rentals/requests/{request}/approve', [\App\Http\Controllers\Admin\RentalManagementController::class, 'approveRequest'])->name('admin.rentals.requests.approve');
        Route::post('/rentals/requests/{rental}/reject', [\App\Http\Controllers\Admin\RentalManagementController::class, 'rejectRequest'])->name('admin.rentals.requests.reject');
        Route::post('/rentals/requests/{rental}/assign-staff', [\App\Http\Controllers\Admin\RentalManagementController::class, 'assignStaff'])->name('admin.rentals.requests.assign-staff');
        Route::get('/rentals/reports', [\App\Http\Controllers\Admin\RentalManagementController::class, 'reports'])->name('admin.rentals.reports');
        
        // NEW: Stock Management
        Route::view('/stock', 'admin.stock')->name('admin.stock');
        
        // NEW: Issues Management
        Route::view('/issues', 'admin.issues')->name('admin.issues');
    });
});

// Additional customer UI routes (protected)
Route::middleware(['multi.auth', 'check.staff.status'])->group(function () {
    // Redirect old requests routes to new bookings routes
    Route::get('/customer/requests', function () {
        return redirect()->route('bookings.index');
    })->name('customer.requests.index');

    Route::get('/customer/requests/create', function () {
        return redirect()->route('bookings.create');
    })->name('customer.requests.create');
    
    // Redirect old service request details to new bookings show
    Route::get('/customer/requests/{id}', function ($id) {
        return redirect()->route('bookings.show', $id);
    })->name('customer.requests.show');
    
    // Notifications
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
    
    // NEW: Search
    Route::view('/search', 'search.index')->name('search.index');
});

// Staff context
Route::middleware(['multi.auth', 'check.staff.status'])->prefix('staff')->group(function () {
    Route::get('/bookings', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'index'])->name('staff.bookings');
    Route::post('/bookings/{id}/status', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'updateStatus'])->name('staff.bookings.status');
    Route::get('/services/{id}', function ($id) {
         $booking = \App\Models\ServiceBooking::with('customer')->findOrFail($id);
         return view('staff.services.show', compact('booking'));
    })->name('staff.services.show');
    
    // Rental Operations (Staff)
    Route::get('/rentals', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'index'])->name('staff.rentals.index');
    Route::get('/rentals/{rental}/inspection', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'showInspection'])->name('staff.rentals.inspection');
    Route::post('/rentals/{rental}/pre-inspection', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'storePreInspection'])->name('staff.rentals.pre-inspection');
    Route::post('/rentals/{rental}/pickup', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'markPickedUp'])->name('staff.rentals.pickup');
    Route::post('/rentals/{rental}/status', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'updateStatus'])->name('staff.rentals.status');
    Route::post('/rentals/{rental}/post-inspection', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'storePostInspection'])->name('staff.rentals.post-inspection');
    Route::post('/rentals/{rental}/complete', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'completeRental'])->name('staff.rentals.complete');
    Route::get('/rentals/history', [\App\Http\Controllers\Staff\RentalOperationsController::class, 'history'])->name('staff.rentals.history');
});

// Staff status pages
Route::view('/staff/pending', 'staff.pending')->name('staff.pending')->middleware('multi.auth');
Route::view('/staff/rejected', 'staff.rejected')->name('staff.rejected');
