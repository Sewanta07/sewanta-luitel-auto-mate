// === TEMPORARY DIAGNOSTIC ROUTE ===
Route::get('/view-paths-diagnostic', function () {
    return response()->json([
        'view_paths' => config('view.paths'),
        'base_path' => base_path(),
        'cwd' => getcwd(),
        'dir' => __DIR__,
        'files_in_views' => is_dir(base_path('resources/views')) ? scandir(base_path('resources/views')) : 'NOT FOUND',
    ]);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\StaffApplicationController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\SearchController;

// Landing Page
Route::get('/', function () {
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
    
    // Forgot Password Routes (Role-based authentication)
    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
        ->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
        ->name('password.update');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('multi.auth');

// Contact Form Route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public payment gateway callbacks
Route::match(['get', 'post'], '/payments/esewa/success', [PaymentController::class, 'esewaSuccess'])->name('payments.esewa.success');
Route::match(['get', 'post'], '/payments/esewa/failure', [PaymentController::class, 'esewaFailure'])->name('payments.esewa.failure');

// Protected Routes
Route::middleware(['multi.auth', 'check.staff.status'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'customer'])->name('dashboard.customer');
    Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->name('dashboard.staff');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->middleware('role:admin')
        ->name('dashboard.admin');

    // Customer Profile Routes
    Route::prefix('customer')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\CustomerProfileController::class, 'index'])->name('customer.profile');
        Route::post('/profile/update', [\App\Http\Controllers\CustomerProfileController::class, 'updateProfile'])->name('customer.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\CustomerProfileController::class, 'updatePassword'])->name('customer.profile.password');

        // Customer static pages
        Route::view('/services', 'customer.services')->name('customer.services');
        Route::resource('bookings', \App\Http\Controllers\ServiceBookingController::class)
            ->only(['index', 'create', 'store', 'show']);
        Route::post('bookings/{id}/cancel', [\App\Http\Controllers\ServiceBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::post('bookings/{id}/reschedule', [\App\Http\Controllers\ServiceBookingController::class, 'reschedule'])->name('bookings.reschedule');
        Route::post('bookings/{id}/accept', [\App\Http\Controllers\ServiceBookingController::class, 'accept'])->name('bookings.accept');
        Route::get('bookings/{id}/invoice/download', [\App\Http\Controllers\ServiceBookingController::class, 'downloadInvoice'])->name('bookings.invoice.download');
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
        Route::post('/rentals/{request}/pay-esewa', [PaymentController::class, 'payRentalRequest'])
            ->middleware('role:customer')
            ->name('payments.rental-requests.pay');
        Route::post('/rentals/{request}/pay-damage', [PaymentController::class, 'payRentalDamage'])
            ->middleware('role:customer')
            ->name('payments.rental-requests.damage-pay');
        Route::get('/rentals', [\App\Http\Controllers\RentalRequestController::class, 'index'])->name('customer.rentals');
        
        // Customer messaging
        Route::get('/messages', [\App\Http\Controllers\CustomerMessageController::class, 'index'])->name('customer.messages');
        Route::get('/messages/{staff}', [\App\Http\Controllers\CustomerMessageController::class, 'show'])->name('customer.messages.show');
        Route::post('/messages/{staff}', [\App\Http\Controllers\CustomerMessageController::class, 'send'])->name('customer.messages.send');
        
        // Customer payment details are merged into customer history

        // Service payment flow
        Route::post('/bookings/{booking}/pay', [PaymentController::class, 'payService'])
            ->middleware('role:customer')
            ->name('payments.service.pay');

        // Admin rental flow
        Route::post('/rentals/admin', [RentalController::class, 'storeAdminRental'])
            ->middleware('role:customer')
            ->name('rentals.admin.store');

        // Marketplace listing and rental flow
        Route::post('/owner-vehicles/list', [RentalController::class, 'listOwnerVehicle'])
            ->middleware('role:customer')
            ->name('owner-vehicles.list');
        Route::post('/rentals/marketplace', [RentalController::class, 'storeMarketplaceRental'])
            ->middleware('role:customer')
            ->name('rentals.marketplace.store');
        Route::get('/owner/earnings-dashboard', [RentalController::class, 'ownerEarningsDashboard'])
            ->middleware('role:customer')
            ->name('owner.earnings.dashboard');
        Route::get('/owner/rental-history', [RentalController::class, 'ownerRentalHistory'])
            ->middleware('role:customer')
            ->name('owner.rental.history');
        Route::post('/owner/withdrawals/request', [RentalController::class, 'requestWithdrawal'])
            ->middleware('role:customer')
            ->name('owner.withdrawals.request');
    });

    // Staff Profile Routes
    Route::prefix('staff')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\StaffProfileController::class, 'index'])->name('staff.profile');
        Route::post('/profile/update', [\App\Http\Controllers\StaffProfileController::class, 'updateProfile'])->name('staff.profile.update');
        Route::post('/profile/password', [\App\Http\Controllers\StaffProfileController::class, 'updatePassword'])->name('staff.profile.password');

        // Staff booking management
        Route::get('/bookings', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'index'])->name('staff.bookings');
        Route::post('/bookings/{id}/status', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'updateStatus'])->name('staff.bookings.status');

        // Staff static pages
        Route::get('/service-logs', [\App\Http\Controllers\Staff\ServiceLogController::class, 'index'])->name('staff.service.logs');
        Route::get('/inventory', [\App\Http\Controllers\Staff\InventoryController::class, 'index'])->name('staff.inventory');
        Route::get('/customers', [\App\Http\Controllers\Staff\CustomerController::class, 'index'])->name('staff.customers');
        Route::get('/customers/{customer}/messages', [\App\Http\Controllers\Staff\CustomerController::class, 'messages'])->name('staff.customers.messages');
        Route::post('/customers/{customer}/messages', [\App\Http\Controllers\Staff\CustomerController::class, 'sendMessage'])->name('staff.customers.sendMessage');
        
        // Staff service details
        Route::get('/services/{id}', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'show'])->name('staff.services.show');
        Route::post('/services/{id}/parts', [\App\Http\Controllers\Staff\ServiceBookingController::class, 'addPart'])->name('staff.services.parts.add');
        
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

    // Admin Staff Applications
    Route::prefix('admin')->group(function () {
        Route::get('/staff-applications', [StaffApplicationController::class, 'index'])->name('admin.staff-applications.index');
        Route::post('/staff-applications/{staff}/approve', [StaffApplicationController::class, 'approve'])->name('admin.staff-applications.approve');
        Route::post('/staff-applications/{staff}/reject', [StaffApplicationController::class, 'reject'])->name('admin.staff-applications.reject');
        Route::post('/staff-applications/{staff}/role', [StaffApplicationController::class, 'updateRole'])->name('admin.staff-applications.updateRole');
        Route::delete('/staff-applications/{staff}', [StaffApplicationController::class, 'destroy'])->name('admin.staff-applications.destroy');

        Route::get('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile/update', [\App\Http\Controllers\Admin\AdminProfileController::class, 'updateProfile'])->name('admin.profile.update');
        Route::post('/profile/password/reset-link', [\App\Http\Controllers\Admin\AdminProfileController::class, 'sendPasswordResetLink'])->name('admin.profile.password.reset-link');

        Route::get('/users', [UserManagementController::class, 'index'])->name('admin.users');
        Route::get('/users/{id}', [UserManagementController::class, 'show'])->name('admin.users.show');
        Route::post('/users/{id}/status', [UserManagementController::class, 'updateStatus'])->name('admin.users.updateStatus');
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/analytics', [\App\Http\Controllers\DashboardController::class, 'analytics'])
            ->middleware('role:admin')
            ->name('admin.analytics');

        Route::get('/transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])
            ->middleware('role:admin')
            ->name('admin.transactions');
        Route::get('/transactions/export', [\App\Http\Controllers\Admin\TransactionController::class, 'exportCsv'])
            ->middleware('role:admin')
            ->name('admin.transactions.export');


        // Contact Messages
        Route::get('/contact-messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.contact-messages.index');
        Route::get('/contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('admin.contact-messages.show');
        Route::post('/contact-messages/{id}/status', [\App\Http\Controllers\Admin\ContactMessageController::class, 'updateStatus'])->name('admin.contact-messages.updateStatus');
        Route::delete('/contact-messages/{id}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
        
        // Admin Service Management
        Route::get('/services', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'index'])->name('admin.services');
        Route::get('/services/{id}/invoice', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'invoice'])->name('admin.services.invoice');
        Route::post('/services/{id}/assign', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'assign'])->name('admin.services.assign');
        Route::post('/services/{id}/status', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'updateStatus'])->name('admin.services.status');
        Route::post('/services/{id}/approve', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'approve'])->name('admin.services.approve');
        Route::post('/services/{id}/reject', [\App\Http\Controllers\Admin\ServiceBookingController::class, 'reject'])->name('admin.services.reject');
        
        // Rental Management (Admin)
        Route::get('/rentals', [\App\Http\Controllers\Admin\RentalManagementController::class, 'dashboard'])->name('admin.rentals.dashboard');
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
        
        // Inventory Management
        Route::get('/inventory', [\App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('admin.inventory.index');
        Route::get('/inventory/create', [\App\Http\Controllers\Admin\InventoryController::class, 'create'])->name('admin.inventory.create');
        Route::post('/inventory', [\App\Http\Controllers\Admin\InventoryController::class, 'store'])->name('admin.inventory.store');
        Route::get('/inventory/{id}/edit', [\App\Http\Controllers\Admin\InventoryController::class, 'edit'])->name('admin.inventory.edit');
        Route::put('/inventory/{id}', [\App\Http\Controllers\Admin\InventoryController::class, 'update'])->name('admin.inventory.update');
        Route::delete('/inventory/{id}', [\App\Http\Controllers\Admin\InventoryController::class, 'destroy'])->name('admin.inventory.destroy');
        Route::get('/inventory/reports', [\App\Http\Controllers\Admin\InventoryController::class, 'reports'])->name('admin.inventory.reports');
        
        // Message Monitoring
        Route::get('/messages', [\App\Http\Controllers\Admin\MessageMonitorController::class, 'index'])->name('admin.messages');
        Route::get('/messages/conversations/{customer}/{staff}', [\App\Http\Controllers\Admin\MessageMonitorController::class, 'show'])
            ->name('admin.messages.conversation');
        

        // Staff/admin service pricing
        Route::post('/services/{booking}/set-amount', [PaymentController::class, 'setServiceAmount'])
            ->middleware('role:admin,staff')
            ->name('admin.services.set-amount');

        // Marketplace approval + payout
        Route::post('/owner-vehicles/{ownerVehicle}/approval', [RentalController::class, 'approveOwnerVehicle'])
            ->middleware('role:admin')
            ->name('admin.owner-vehicles.approval');
        Route::post('/rentals/{rental}/complete', [RentalController::class, 'completeRental'])
            ->middleware('role:admin')
            ->name('admin.rentals.complete');
        Route::post('/earnings/{earning}/payout-paid', [RentalController::class, 'markPayoutPaid'])
            ->middleware('role:admin')
            ->name('admin.earnings.payout-paid');
        Route::get('/owner-vehicles', [RentalController::class, 'ownerListings'])
            ->middleware('role:admin')
            ->name('admin.owner-vehicles.index');
        Route::get('/earnings/payouts', [RentalController::class, 'earningsPayouts'])
            ->middleware('role:admin')
            ->name('admin.earnings.payouts');
        Route::post('/withdrawals/{withdrawalRequest}/process', [RentalController::class, 'processWithdrawalRequest'])
            ->middleware('role:admin')
            ->name('admin.withdrawals.process');
    });
});

Route::middleware(['multi.auth', 'check.staff.status', 'role:customer'])->group(function () {
    Route::match(['get', 'post'], '/payments/rentals/{rental}/pay', [PaymentController::class, 'payRental'])->name('payments.rentals.pay');
    Route::get('/payments/esewa/{payment}', [PaymentController::class, 'redirectToEsewa'])->name('payments.esewa.redirect');
    Route::get('/payments/{payment}/receipt', [PaymentController::class, 'receipt'])->name('payments.receipt');
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
    
    // Search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');

});

// Staff status pages
Route::view('/staff/pending', 'staff.pending')->name('staff.pending')->middleware('multi.auth');
Route::view('/staff/rejected', 'staff.rejected')->name('staff.rejected');
