<?php

namespace App\Http\Controllers;

use App\Models\CustomerUser;
use App\Models\InventoryItem;
use App\Models\ServiceBooking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $user = getAuthenticatedUser();
        $role = getAuthenticatedUserRole();

        $q = trim((string) $request->get('q', ''));
        $category = strtolower((string) $request->get('category', 'all'));
        $dateRange = strtolower((string) $request->get('date_range', 'all'));
        $status = (string) $request->get('status', 'all');
        $sort = strtolower((string) $request->get('sort', 'relevance'));

        $allowedCategories = ['all', 'services', 'customers', 'parts', 'vehicles'];
        if (!in_array($category, $allowedCategories, true)) {
            $category = 'all';
        }

        $canViewParts = in_array($role, ['admin', 'staff'], true);
        $canViewCustomers = in_array($role, ['admin', 'staff'], true);

        $serviceQuery = ServiceBooking::with(['customer', 'staff']);
        if ($role === 'customer' && $user) {
            $serviceQuery->where('customer_id', $user->id);
        } elseif ($role === 'staff' && $user) {
            $serviceQuery->where('staff_id', $user->id);
        }

        if ($q !== '') {
            $serviceQuery->where(function ($query) use ($q) {
                $query->where('booking_code', 'like', "%{$q}%")
                    ->orWhere('service_type', 'like', "%{$q}%")
                    ->orWhere('custom_service', 'like', "%{$q}%")
                    ->orWhere('vehicle_number', 'like', "%{$q}%")
                    ->orWhere('vehicle_model', 'like', "%{$q}%")
                    ->orWhere('vehicle_name', 'like', "%{$q}%")
                    ->orWhere('vehicle_type', 'like', "%{$q}%")
                    ->orWhere('status', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%");
            });
        }

        if ($status !== 'all') {
            $serviceQuery->where('status', $status);
        }

        if ($dateRange !== 'all') {
            $startDate = match ($dateRange) {
                'today' => Carbon::now()->startOfDay(),
                'this_week' => Carbon::now()->startOfWeek(),
                'this_month' => Carbon::now()->startOfMonth(),
                default => null,
            };

            if ($startDate) {
                $serviceQuery->where('created_at', '>=', $startDate);
            }
        }

        $serviceQuery->when($sort, function ($query) use ($sort) {
            switch ($sort) {
                case 'date_oldest':
                    $query->orderBy('created_at');
                    break;
                case 'alphabetical':
                    $query->orderBy('vehicle_name');
                    break;
                case 'date_newest':
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        });

        $customerQuery = CustomerUser::query()->withCount('bookings');
        if ($role === 'staff' && $user) {
            $customerQuery->whereHas('bookings', function ($query) use ($user) {
                $query->where('staff_id', $user->id);
            });
        } elseif ($role === 'customer' && $user) {
            $customerQuery->where('id', $user->id);
        }

        if ($q !== '') {
            $customerQuery->where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('phone', 'like', "%{$q}%")
                    ->orWhere('current_address', 'like', "%{$q}%");
            });
        }

        $customerQuery->when($sort, function ($query) use ($sort) {
            switch ($sort) {
                case 'date_oldest':
                    $query->orderBy('created_at');
                    break;
                case 'alphabetical':
                    $query->orderBy('name');
                    break;
                case 'date_newest':
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        });

        $vehicleQuery = Vehicle::query();
        if ($role === 'customer' && $user) {
            $vehicleQuery->where('customer_id', $user->id);
        }

        if ($q !== '') {
            $vehicleQuery->where(function ($query) use ($q) {
                $query->where('vehicle_name', 'like', "%{$q}%")
                    ->orWhere('brand', 'like', "%{$q}%")
                    ->orWhere('model', 'like', "%{$q}%")
                    ->orWhere('plate_number', 'like', "%{$q}%")
                    ->orWhere('vehicle_type', 'like', "%{$q}%")
                    ->orWhere('fuel_type', 'like', "%{$q}%")
                    ->orWhere('transmission_type', 'like', "%{$q}%");
            });
        }

        $vehicleQuery->when($sort, function ($query) use ($sort) {
            switch ($sort) {
                case 'date_oldest':
                    $query->orderBy('created_at');
                    break;
                case 'alphabetical':
                    $query->orderBy('model');
                    break;
                case 'date_newest':
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        });

        $partQuery = InventoryItem::query();
        if (!$canViewParts) {
            $partQuery->whereRaw('1 = 0');
        }

        if ($q !== '') {
            $partQuery->where(function ($query) use ($q) {
                $query->where('part_name', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%")
                    ->orWhere('supplier', 'like', "%{$q}%")
                    ->orWhere('status', 'like', "%{$q}%");
            });
        }

        $partQuery->when($sort, function ($query) use ($sort) {
            switch ($sort) {
                case 'date_oldest':
                    $query->orderBy('created_at');
                    break;
                case 'alphabetical':
                    $query->orderBy('part_name');
                    break;
                case 'date_newest':
                default:
                    $query->orderByDesc('created_at');
                    break;
            }
        });

        $serviceCount = (clone $serviceQuery)->count();
        $customerCount = $canViewCustomers ? (clone $customerQuery)->count() : 0;
        $vehicleCount = (clone $vehicleQuery)->count();
        $partCount = $canViewParts ? (clone $partQuery)->count() : 0;
        $totalCount = $serviceCount + $customerCount + $vehicleCount + $partCount;

        $perPage = 12;
        $services = null;
        $customers = null;
        $vehicles = null;
        $parts = null;

        if ($category === 'services') {
            $services = $serviceQuery->paginate($perPage)->appends($request->query());
        } elseif ($category === 'customers') {
            $customers = $canViewCustomers ? $customerQuery->paginate($perPage)->appends($request->query()) : collect();
        } elseif ($category === 'vehicles') {
            $vehicles = $vehicleQuery->paginate($perPage)->appends($request->query());
        } elseif ($category === 'parts') {
            $parts = $canViewParts ? $partQuery->paginate($perPage)->appends($request->query()) : collect();
        } else {
            $services = $serviceQuery->limit(5)->get();
            $customers = $canViewCustomers ? $customerQuery->limit(5)->get() : collect();
            $vehicles = $vehicleQuery->limit(5)->get();
            $parts = $canViewParts ? $partQuery->limit(5)->get() : collect();
        }

        return view('search.index', [
            'q' => $q,
            'category' => $category,
            'dateRange' => $dateRange,
            'status' => $status,
            'sort' => $sort,
            'role' => $role,
            'canViewParts' => $canViewParts,
            'canViewCustomers' => $canViewCustomers,
            'serviceCount' => $serviceCount,
            'customerCount' => $customerCount,
            'vehicleCount' => $vehicleCount,
            'partCount' => $partCount,
            'totalCount' => $totalCount,
            'services' => $services,
            'customers' => $customers,
            'vehicles' => $vehicles,
            'parts' => $parts,
        ]);
    }
}
