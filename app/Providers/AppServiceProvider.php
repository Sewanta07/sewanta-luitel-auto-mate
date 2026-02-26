<?php

namespace App\Providers;

use App\Models\ContactMessage;
use App\Models\InventoryItem;
use App\Models\Message;
use App\Models\Notification;
use App\Models\RentalRequest;
use App\Models\ServiceBooking;
use App\Support\Realtime\ChatUserResolver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes([
            'middleware' => ['web', 'multi.auth'],
        ]);

        View::composer([
            'components.admin-sidebar',
            'components.admin-navbar',
            'components.staff-navbar',
            'customer.navbar',
        ], function ($view) {
            $counts = [
                'messages_unread' => 0,
                'notifications_unread' => 0,
                'rentals_pending' => 0,
                'services_pending' => 0,
                'inventory_low_stock' => 0,
                'contact_new' => 0,
                'rental_requests_pending' => 0,
                'rental_listings_pending' => 0,
            ];

            $role = getAuthenticatedUserRole();
            $authUser = getAuthenticatedUser();

            if (!$authUser || !$role) {
                $view->with('navCounts', $counts);

                return;
            }

            if (in_array($role, ['customer', 'staff'], true)) {
                $chatUser = ChatUserResolver::forAuthenticated();

                if ($chatUser) {
                    $counts['messages_unread'] = Message::query()
                        ->where('receiver_id', $chatUser->id)
                        ->where('is_read', false)
                        ->count();
                }
            }

            if ($role === 'customer') {
                $counts['notifications_unread'] = Notification::query()
                    ->where('customer_id', (int) $authUser->id)
                    ->where('is_read', false)
                    ->count();

                $counts['rentals_pending'] = RentalRequest::query()
                    ->where('renter_id', (int) $authUser->id)
                    ->whereIn('status', ['Pending', 'Approved', 'Ready for Pickup'])
                    ->count();

                $counts['services_pending'] = ServiceBooking::query()
                    ->where('customer_id', (int) $authUser->id)
                    ->whereIn('status', ['Pending', 'Assigned', 'Customer Accepted', 'In Progress'])
                    ->count();
            }

            if ($role === 'staff') {
                $counts['rentals_pending'] = RentalRequest::query()
                    ->where('assigned_staff_id', (int) $authUser->id)
                    ->whereIn('status', ['Approved', 'Ready for Pickup', 'Picked Up'])
                    ->count();

                $counts['services_pending'] = ServiceBooking::query()
                    ->where('staff_id', (int) $authUser->id)
                    ->whereIn('status', ['Assigned', 'Customer Accepted', 'In Progress', 'Waiting for Parts'])
                    ->count();

                $counts['inventory_low_stock'] = InventoryItem::query()
                    ->whereColumn('quantity', '<=', 'minimum_stock')
                    ->count();
            }

            if ($role === 'admin') {
                $counts['contact_new'] = ContactMessage::query()
                    ->where('status', 'new')
                    ->count();

                $counts['rental_listings_pending'] = DB::table('vehicles')
                    ->where('listing_status', 'pending')
                    ->count();

                $counts['rental_requests_pending'] = RentalRequest::query()
                    ->where('status', 'Pending')
                    ->count();

                $counts['rentals_pending'] = $counts['rental_listings_pending'] + $counts['rental_requests_pending'];

                $counts['services_pending'] = ServiceBooking::query()
                    ->whereIn('status', ['Pending', 'Assigned'])
                    ->count();

                $counts['inventory_low_stock'] = InventoryItem::query()
                    ->whereColumn('quantity', '<=', 'minimum_stock')
                    ->count();

                $counts['messages_unread'] = Message::query()
                    ->where('is_read', false)
                    ->count();
            }

            $view->with('navCounts', $counts);
        });
    }
}
