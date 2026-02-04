@extends('layouts.app')

@section('content')
  @php
    $baseQuery = request()->except('page', 'category');
    $selectedCount = match ($category) {
        'services' => $serviceCount,
        'customers' => $customerCount,
        'parts' => $partCount,
        'vehicles' => $vehicleCount,
        default => $totalCount,
    };
  @endphp
  <div class="min-h-screen bg-gray-50">
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900">AutoMate</h1>
          <p class="text-gray-600 mt-2">Search across services, customers, parts, and vehicles</p>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto p-6">
      <form method="GET" action="{{ route('search.index') }}" class="mb-8">
        <div class="relative">
          <input
            type="search"
            name="q"
            value="{{ $q }}"
            placeholder="Search for services, customers, parts, vehicles..."
            class="w-full px-6 py-4 pl-12 text-lg border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500"
          >
          <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 mt-6">
          <h2 class="text-lg font-bold text-gray-900 mb-4">Advanced Filters</h2>
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
              <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all" {{ $category === 'all' ? 'selected' : '' }}>All Categories</option>
                <option value="services" {{ $category === 'services' ? 'selected' : '' }}>Services</option>
                @if($canViewCustomers)
                  <option value="customers" {{ $category === 'customers' ? 'selected' : '' }}>Customers</option>
                @endif
                @if($canViewParts)
                  <option value="parts" {{ $category === 'parts' ? 'selected' : '' }}>Parts</option>
                @endif
                <option value="vehicles" {{ $category === 'vehicles' ? 'selected' : '' }}>Vehicles</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
              <select name="date_range" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all" {{ $dateRange === 'all' ? 'selected' : '' }}>All Time</option>
                <option value="today" {{ $dateRange === 'today' ? 'selected' : '' }}>Today</option>
                <option value="this_week" {{ $dateRange === 'this_week' ? 'selected' : '' }}>This Week</option>
                <option value="this_month" {{ $dateRange === 'this_month' ? 'selected' : '' }}>This Month</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
              <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="all" {{ $status === 'all' ? 'selected' : '' }}>All Status</option>
                <option value="Pending" {{ $status === 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $status === 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Assigned" {{ $status === 'Assigned' ? 'selected' : '' }}>Assigned</option>
                <option value="In Progress" {{ $status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Waiting for Parts" {{ $status === 'Waiting for Parts' ? 'selected' : '' }}>Waiting for Parts</option>
                <option value="Completed" {{ $status === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Rejected" {{ $status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
              <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <option value="relevance" {{ $sort === 'relevance' ? 'selected' : '' }}>Relevance</option>
                <option value="date_newest" {{ $sort === 'date_newest' ? 'selected' : '' }}>Date (Newest)</option>
                <option value="date_oldest" {{ $sort === 'date_oldest' ? 'selected' : '' }}>Date (Oldest)</option>
                <option value="alphabetical" {{ $sort === 'alphabetical' ? 'selected' : '' }}>Alphabetical</option>
              </select>
            </div>
          </div>
          <div class="mt-4 flex gap-3">
            <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Apply Filters</button>
            <a href="{{ route('search.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300">Reset</a>
          </div>
        </div>
      </form>

      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Search Results</h2>
        <p class="text-sm text-gray-500">Showing {{ $selectedCount }} results</p>
      </div>

      <div class="flex gap-4 mb-6 border-b border-gray-200 overflow-x-auto">
        <a href="{{ route('search.index', array_merge($baseQuery, ['category' => 'all'])) }}" class="px-4 py-3 border-b-2 {{ $category === 'all' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-600 hover:text-gray-900' }} font-semibold">All Results ({{ $totalCount }})</a>
        <a href="{{ route('search.index', array_merge($baseQuery, ['category' => 'services'])) }}" class="px-4 py-3 border-b-2 {{ $category === 'services' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-600 hover:text-gray-900' }} font-semibold">Services ({{ $serviceCount }})</a>
        @if($canViewCustomers)
          <a href="{{ route('search.index', array_merge($baseQuery, ['category' => 'customers'])) }}" class="px-4 py-3 border-b-2 {{ $category === 'customers' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-600 hover:text-gray-900' }} font-semibold">Customers ({{ $customerCount }})</a>
        @endif
        @if($canViewParts)
          <a href="{{ route('search.index', array_merge($baseQuery, ['category' => 'parts'])) }}" class="px-4 py-3 border-b-2 {{ $category === 'parts' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-600 hover:text-gray-900' }} font-semibold">Parts ({{ $partCount }})</a>
        @endif
        <a href="{{ route('search.index', array_merge($baseQuery, ['category' => 'vehicles'])) }}" class="px-4 py-3 border-b-2 {{ $category === 'vehicles' ? 'border-orange-500 text-orange-600' : 'border-transparent text-gray-600 hover:text-gray-900' }} font-semibold">Vehicles ({{ $vehicleCount }})</a>
      </div>

      @if($selectedCount === 0)
        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
          <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-2">No results found</h3>
          <p class="text-gray-500">Try adjusting your filters or search terms.</p>
        </div>
      @else
        <div class="space-y-6">
          @if($category === 'all')
            @if($services && $services->count())
              <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Services</h3>
                <div class="space-y-4">
                  @foreach($services as $service)
                    @php
                      $serviceTitle = $service->service_type === 'Custom Service' ? ($service->custom_service ?: 'Custom Service') : $service->service_type;
                      $serviceUrl = $role === 'customer' ? route('bookings.show', $service->id) : ($role === 'staff' ? route('staff.services.show', $service->id) : route('admin.services'));
                      $serviceAction = $role === 'admin' ? 'Open Services' : 'View';
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                      <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                          <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Service</span>
                            <h3 class="text-lg font-bold text-gray-900">{{ $serviceTitle }} {{ $service->booking_code ? '• ' . $service->booking_code : '' }}</h3>
                          </div>
                          <p class="text-gray-600 mb-3">
                            {{ $service->vehicle_model ?? $service->vehicle_name ?? 'Vehicle' }} {{ $service->vehicle_year ? '• ' . $service->vehicle_year : '' }}
                            @if($service->customer)
                              • Customer: {{ $service->customer->name }}
                            @endif
                          </p>
                          <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Status: {{ $service->status }}</span>
                            <span>•</span>
                            <span>{{ $service->created_at?->format('M d, Y') }}</span>
                          </div>
                        </div>
                        <a href="{{ $serviceUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $serviceAction }}</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            @if($canViewCustomers && $customers && $customers->count())
              <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Customers</h3>
                <div class="space-y-4">
                  @foreach($customers as $customer)
                    @php
                      $customerUrl = $role === 'admin' ? route('admin.users.show', $customer->id) : ($role === 'staff' ? route('staff.customers.messages', $customer->id) : route('customer.profile'));
                      $customerAction = $role === 'staff' ? 'Message' : 'View Profile';
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                      <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                          <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Customer</span>
                            <h3 class="text-lg font-bold text-gray-900">{{ $customer->name }}</h3>
                          </div>
                          <p class="text-gray-600 mb-3">{{ $customer->email }}{{ $customer->phone ? ' • ' . $customer->phone : '' }}</p>
                          <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Total Services: {{ $customer->bookings_count ?? 0 }}</span>
                          </div>
                        </div>
                        <a href="{{ $customerUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $customerAction }}</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            @if($canViewParts && $parts && $parts->count())
              <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Parts</h3>
                <div class="space-y-4">
                  @foreach($parts as $part)
                    @php
                      $partUrl = $role === 'admin' ? route('admin.inventory.index') : route('staff.inventory');
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                      <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                          <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Part</span>
                            <h3 class="text-lg font-bold text-gray-900">{{ $part->part_name }}</h3>
                          </div>
                          <p class="text-gray-600 mb-3">{{ $part->category }}{{ $part->supplier ? ' • ' . $part->supplier : '' }}</p>
                          <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Stock: {{ $part->quantity }} units</span>
                            <span>•</span>
                            <span>Price: Rs. {{ number_format($part->unit_price, 2) }}</span>
                            <span>•</span>
                            <span class="{{ $part->stock_status === 'low_stock' ? 'text-orange-600' : ($part->stock_status === 'out_of_stock' ? 'text-red-600' : 'text-green-600') }} font-semibold">
                              {{ ucfirst(str_replace('_', ' ', $part->stock_status)) }}
                            </span>
                          </div>
                        </div>
                        <a href="{{ $partUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Details</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            @if($vehicles && $vehicles->count())
              <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3">Vehicles</h3>
                <div class="space-y-4">
                  @foreach($vehicles as $vehicle)
                    @php
                      $vehicleTitle = trim(($vehicle->brand ? $vehicle->brand . ' ' : '') . ($vehicle->model ?? $vehicle->vehicle_name ?? 'Vehicle'));
                      $vehicleSubtitle = $vehicle->plate_number ?: 'Plate not set';
                      $vehicleUrl = $role === 'customer' ? route('vehicles.edit', $vehicle->id) : ($role === 'admin' ? route('admin.rentals.vehicles') : route('staff.rentals.index'));
                      $vehicleAction = $role === 'customer' ? 'Edit' : 'Open Vehicles';
                    @endphp
                    <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                      <div class="flex items-start justify-between gap-6">
                        <div class="flex-1">
                          <div class="flex items-center gap-3 mb-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Vehicle</span>
                            <h3 class="text-lg font-bold text-gray-900">{{ $vehicleTitle }}</h3>
                          </div>
                          <p class="text-gray-600 mb-3">{{ $vehicleSubtitle }}{{ $vehicle->vehicle_type ? ' • ' . $vehicle->vehicle_type : '' }}</p>
                          <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>{{ $vehicle->fuel_type ?? 'Fuel N/A' }}</span>
                            <span>•</span>
                            <span>{{ $vehicle->transmission_type ?? 'Transmission N/A' }}</span>
                          </div>
                        </div>
                        <a href="{{ $vehicleUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $vehicleAction }}</a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif
          @else
            @if($category === 'services' && $services)
              <div class="space-y-4">
                @foreach($services as $service)
                  @php
                    $serviceTitle = $service->service_type === 'Custom Service' ? ($service->custom_service ?: 'Custom Service') : $service->service_type;
                    $serviceUrl = $role === 'customer' ? route('bookings.show', $service->id) : ($role === 'staff' ? route('staff.services.show', $service->id) : route('admin.services'));
                    $serviceAction = $role === 'admin' ? 'Open Services' : 'View';
                  @endphp
                  <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-6">
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Service</span>
                          <h3 class="text-lg font-bold text-gray-900">{{ $serviceTitle }} {{ $service->booking_code ? '• ' . $service->booking_code : '' }}</h3>
                        </div>
                        <p class="text-gray-600 mb-3">
                          {{ $service->vehicle_model ?? $service->vehicle_name ?? 'Vehicle' }} {{ $service->vehicle_year ? '• ' . $service->vehicle_year : '' }}
                          @if($service->customer)
                            • Customer: {{ $service->customer->name }}
                          @endif
                        </p>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                          <span>Status: {{ $service->status }}</span>
                          <span>•</span>
                          <span>{{ $service->created_at?->format('M d, Y') }}</span>
                        </div>
                      </div>
                      <a href="{{ $serviceUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $serviceAction }}</a>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="mt-8">{{ $services->links() }}</div>
            @elseif($category === 'customers' && $customers)
              <div class="space-y-4">
                @foreach($customers as $customer)
                  @php
                    $customerUrl = $role === 'admin' ? route('admin.users.show', $customer->id) : ($role === 'staff' ? route('staff.customers.messages', $customer->id) : route('customer.profile'));
                    $customerAction = $role === 'staff' ? 'Message' : 'View Profile';
                  @endphp
                  <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-6">
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Customer</span>
                          <h3 class="text-lg font-bold text-gray-900">{{ $customer->name }}</h3>
                        </div>
                        <p class="text-gray-600 mb-3">{{ $customer->email }}{{ $customer->phone ? ' • ' . $customer->phone : '' }}</p>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                          <span>Total Services: {{ $customer->bookings_count ?? 0 }}</span>
                        </div>
                      </div>
                      <a href="{{ $customerUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $customerAction }}</a>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="mt-8">{{ method_exists($customers, 'links') ? $customers->links() : '' }}</div>
            @elseif($category === 'parts' && $parts)
              <div class="space-y-4">
                @foreach($parts as $part)
                  @php
                    $partUrl = $role === 'admin' ? route('admin.inventory.index') : route('staff.inventory');
                  @endphp
                  <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-6">
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Part</span>
                          <h3 class="text-lg font-bold text-gray-900">{{ $part->part_name }}</h3>
                        </div>
                        <p class="text-gray-600 mb-3">{{ $part->category }}{{ $part->supplier ? ' • ' . $part->supplier : '' }}</p>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                          <span>Stock: {{ $part->quantity }} units</span>
                          <span>•</span>
                          <span>Price: Rs. {{ number_format($part->unit_price, 2) }}</span>
                          <span>•</span>
                          <span class="{{ $part->stock_status === 'low_stock' ? 'text-orange-600' : ($part->stock_status === 'out_of_stock' ? 'text-red-600' : 'text-green-600') }} font-semibold">
                            {{ ucfirst(str_replace('_', ' ', $part->stock_status)) }}
                          </span>
                        </div>
                      </div>
                      <a href="{{ $partUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Details</a>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="mt-8">{{ method_exists($parts, 'links') ? $parts->links() : '' }}</div>
            @elseif($category === 'vehicles' && $vehicles)
              <div class="space-y-4">
                @foreach($vehicles as $vehicle)
                  @php
                    $vehicleTitle = trim(($vehicle->brand ? $vehicle->brand . ' ' : '') . ($vehicle->model ?? $vehicle->vehicle_name ?? 'Vehicle'));
                    $vehicleSubtitle = $vehicle->plate_number ?: 'Plate not set';
                    $vehicleUrl = $role === 'customer' ? route('vehicles.edit', $vehicle->id) : ($role === 'admin' ? route('admin.rentals.vehicles') : route('staff.rentals.index'));
                    $vehicleAction = $role === 'customer' ? 'Edit' : 'Open Vehicles';
                  @endphp
                  <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between gap-6">
                      <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                          <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Vehicle</span>
                          <h3 class="text-lg font-bold text-gray-900">{{ $vehicleTitle }}</h3>
                        </div>
                        <p class="text-gray-600 mb-3">{{ $vehicleSubtitle }}{{ $vehicle->vehicle_type ? ' • ' . $vehicle->vehicle_type : '' }}</p>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                          <span>{{ $vehicle->fuel_type ?? 'Fuel N/A' }}</span>
                          <span>•</span>
                          <span>{{ $vehicle->transmission_type ?? 'Transmission N/A' }}</span>
                        </div>
                      </div>
                      <a href="{{ $vehicleUrl }}" class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">{{ $vehicleAction }}</a>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="mt-8">{{ method_exists($vehicles, 'links') ? $vehicles->links() : '' }}</div>
            @endif
          @endif
        </div>
      @endif
    </div>
  </div>
@endsection
