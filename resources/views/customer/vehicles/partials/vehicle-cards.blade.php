{{-- Success/Error Messages --}}
@if(session('success'))
    <div class="col-span-full mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="col-span-full mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="col-span-full mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 animate-fade-in">
        <p class="font-semibold mb-2">Could not save vehicle:</p>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($vehicles->count() > 0)
    @foreach($vehicles as $vehicle)
        @php
            $status = $vehicle->currentStatus();
            $badgeBgMap = [
                'blue' => '#eff6ff',
                'green' => '#f0fdf4',
                'purple' => '#f5f3ff',
                'red' => '#fef2f2',
            ];
            $badgeIconMap = [
                'blue' => '#2563eb',
                'green' => '#10b981',
                'purple' => '#7c3aed',
                'red' => '#ef4444',
            ];
            $badgeBgColor = $badgeBgMap[$status['badge_color']] ?? '#f0fdf4';
            $badgeIconColor = $badgeIconMap[$status['badge_color']] ?? '#10b981';
        @endphp
        
        {{-- Vehicle Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
            <div class="relative h-44 bg-gray-100">
                @if($vehicle->image_path)
                    <img src="{{ asset('storage/' . $vehicle->image_path) }}" alt="{{ $vehicle->vehicle_name ?? $vehicle->brand }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                    </div>
                @endif
                <span class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $status['badge_bg'] }} {{ $status['badge_text'] }} shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full {{ $status['dot_color'] }} mr-2"></span>
                    {{ $status['status'] }}
                </span>
                @if($vehicle->is_listed_for_rent)
                    <span class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 shadow-sm">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        For Rent
                    </span>
                @endif
            </div>
            <div class="p-6 flex-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 rounded-2xl" style="background-color: {{ $badgeBgColor }};">
                        <svg class="w-8 h-8" style="color: {{ $badgeIconColor }};" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0 a2 2 0 114 0"></path>
                        </svg>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $vehicle->vehicle_type ?? 'Vehicle' }}</p>
                        <p class="text-xs text-gray-400">{{ $vehicle->fuel_type ?? 'Fuel N/A' }} • {{ $vehicle->transmission_type ?? 'Transmission N/A' }}</p>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">
                    {{ $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model) }}
                </h3>
                <p class="text-sm text-gray-500 mb-2">{{ $vehicle->brand }} {{ $vehicle->model }} • {{ $vehicle->year }}</p>
                
                @if($vehicle->daily_rate)
                    <p class="text-sm text-[#ff5a1f] font-semibold mb-3">Rs. {{ number_format($vehicle->daily_rate, 2) }} / day</p>
                @endif
                
                <div class="flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                    </svg>
                    {{ $vehicle->plate_number }}
                </div>
            </div>
            
            <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="text-gray-400 hover:text-blue-600 transition" title="Edit Vehicle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this vehicle?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Remove Vehicle" {{ $vehicle->rented_by_user_id ? 'disabled' : '' }}>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    <a href="{{ route('bookings.create', ['vehicle_id' => $vehicle->id]) }}" class="text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] transition flex items-center">
                        Request Service
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                @if($vehicle->rentalRequests && $vehicle->rentalRequests->count() > 0)
                    <div class="bg-white rounded-xl border border-gray-100 p-3">
                        <p class="text-xs font-bold text-gray-600 mb-2">Pending Rent Requests</p>
                        <div class="space-y-2">
                            @foreach($vehicle->rentalRequests as $request)
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-gray-600">Request #{{ $request->id }}</span>
                                    <div class="flex items-center gap-2">
                                        <form action="{{ route('rentals.approve', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg bg-green-100 text-green-700 hover:bg-green-200">Approve</button>
                                        </form>
                                        <form action="{{ route('rentals.reject', $request->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-lg bg-red-100 text-red-700 hover:bg-red-200">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <form action="{{ route('vehicles.toggle-rent', $vehicle->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 rounded-xl text-sm font-bold transition {{ $vehicle->is_listed_for_rent ? 'bg-purple-100 text-purple-700 hover:bg-purple-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}" {{ $vehicle->rented_by_user_id ? 'disabled' : '' }}>
                        {{ $vehicle->is_listed_for_rent ? 'Unlist from Rent' : 'List for Rent' }}
                    </button>
                </form>
                @if(!$vehicle->rented_by_user_id && $vehicle->daily_rate)
                    <form action="{{ route('owner-vehicles.list') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                        <input type="hidden" name="daily_rate" value="{{ $vehicle->daily_rate }}">
                        <button type="submit" class="w-full px-4 py-2 rounded-xl text-sm font-bold bg-orange-100 text-orange-700 hover:bg-orange-200 transition">
                            Submit to Marketplace Approval
                        </button>
                    </form>
                @endif
                @if($vehicle->rented_by_user_id && $vehicle->approvedRental)
                    <form action="{{ route('rentals.return', $vehicle->approvedRental->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 rounded-xl text-sm font-bold bg-red-100 text-red-700 hover:bg-red-200">
                            Mark as Returned
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
@else
    <div class="col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center px-4">
        <div class="p-6 bg-orange-50 rounded-full mb-6">
            <svg class="w-20 h-20 text-[#ff5a1f] opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $showAll ? "You haven't added any vehicles yet" : "You haven't listed any vehicles for rent yet" }}</h3>
        <p class="text-gray-500 mb-8 max-w-sm">
            {{ $showAll ? "Register your cars here to enable fast service booking and track maintenance history." : "List your vehicles to earn money by renting them to other users." }}
        </p>
        @if($showAll)
            <button onclick="openVehicleModal()" class="px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                Add Your First Vehicle
            </button>
        @endif
    </div>
@endif
