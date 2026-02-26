<?php

use App\Events\UserNotificationCreated;
use App\Models\Notification;

if (!function_exists('createNotification')) {
    /**
     * Create a notification for a customer
     */
    function createNotification($customerId, $type, $title, $message, $iconType = 'info', $actionUrl = null, $actionText = null, $relatedId = null, $relatedType = null)
    {
        $notification = Notification::create([
            'customer_id' => $customerId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'icon_type' => $iconType,
            'action_url' => $actionUrl,
            'action_text' => $actionText,
            'related_id' => $relatedId,
            'related_type' => $relatedType,
        ]);

        event(new UserNotificationCreated(
            (int) $customerId,
            [
                'id' => (int) $notification->id,
                'type' => (string) $notification->type,
                'title' => (string) $notification->title,
                'message' => (string) $notification->message,
                'icon_type' => (string) $notification->icon_type,
                'action_url' => $notification->action_url,
                'action_text' => $notification->action_text,
                'is_read' => (bool) $notification->is_read,
                'created_at' => optional($notification->created_at)?->toISOString(),
            ],
            Notification::where('customer_id', $customerId)->where('is_read', false)->count()
        ));

        return $notification;
    }
}

if (!function_exists('notifyServiceUpdate')) {
    /**
     * Create a service update notification
     */
    function notifyServiceUpdate($customerId, $booking, $status, $staffName = null)
    {
        $messages = [
            'Pending' => 'Your service request has been submitted and is awaiting approval.',
            'Approved' => 'Your service request has been approved and is being scheduled.',
            'Assigned' => $staffName ? "Your service has been assigned to {$staffName}." : 'Your service has been assigned to a technician.',
            'In Progress' => 'Your vehicle service is now in progress.',
            'Waiting for Parts' => 'Your service is on hold while we order necessary parts.',
            'Customer Accepted' => 'Service quotation has been accepted. Work will begin shortly.',
            'Completed' => 'Your vehicle service has been completed successfully!',
            'Cancelled' => 'Your service request has been cancelled.',
        ];

        $iconTypes = [
            'Completed' => 'success',
            'Cancelled' => 'error',
            'Waiting for Parts' => 'warning',
            'In Progress' => 'info',
            'Approved' => 'success',
        ];

        return createNotification(
            $customerId,
            'service_update',
            "Service Status: {$status}",
            $messages[$status] ?? "Your service status has been updated to {$status}.",
            $iconTypes[$status] ?? 'info',
            route('bookings.show', $booking->id),
            'View Details',
            $booking->id,
            'ServiceBooking'
        );
    }
}

if (!function_exists('notifyPayment')) {
    /**
     * Create a payment notification
     */
    function notifyPayment($customerId, $amount, $invoiceNumber, $status = 'success')
    {
        $title = $status === 'success' ? 'Payment Received' : 'Payment Required';
        $message = $status === 'success' 
            ? "Payment of Rs. {$amount} for invoice #{$invoiceNumber} has been successfully processed."
            : "Payment of Rs. {$amount} is required for invoice #{$invoiceNumber}.";

        return createNotification(
            $customerId,
            'payment',
            $title,
            $message,
            $status === 'success' ? 'success' : 'warning',
            route('bookings.index'),
            $status === 'success' ? 'View Receipt' : 'Pay Now'
        );
    }
}

if (!function_exists('notifyRentalUpdate')) {
    /**
     * Create a rental update notification
     */
    function notifyRentalUpdate($customerId, $rentalRequest, $status, $vehicleName)
    {
        $messages = [
            'Pending' => "Your rental request for {$vehicleName} has been submitted.",
            'Approved' => "Your rental request for {$vehicleName} has been approved! You can now arrange pickup.",
            'Rejected' => "Your rental request for {$vehicleName} has been declined by the owner.",
            'Completed' => "Your rental of {$vehicleName} has been completed. Thank you!",
        ];

        $iconTypes = [
            'Approved' => 'success',
            'Rejected' => 'error',
            'Completed' => 'success',
            'Pending' => 'info',
        ];

        return createNotification(
            $customerId,
            'rental_update',
            "Rental {$status}",
            $messages[$status] ?? "Your rental status has been updated.",
            $iconTypes[$status] ?? 'info',
            route('customer.rentals'),
            'View Rentals',
            $rentalRequest->id,
            'RentalRequest'
        );
    }
}
