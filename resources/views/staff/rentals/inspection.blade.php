@extends('layouts.staff')

@section('title', 'Vehicle Inspection')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Vehicle Inspection</h1>
            <p class="text-gray-600">{{ $rental->status === 'Approved' ? 'Pre-Rental' : 'Post-Return' }} Inspection</p>
        </div>

    <!-- Vehicle Info -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Vehicle Information</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Vehicle</p>
                <p class="font-semibold text-gray-800">
                    {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Plate Number</p>
                <p class="font-semibold text-gray-800">{{ $rental->vehicle->plate_number }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Renter</p>
                <p class="font-semibold text-gray-800">{{ $rental->renter->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Rental Period</p>
                <p class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - 
                    {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        {{ session('error') }}
    </div>
    @endif

    <!-- Inspection Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        @if($rental->status === 'Approved')
            <!-- Pre-Rental Inspection -->
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Pre-Rental Inspection Checklist</h2>
            <form action="{{ route('staff.rentals.pre-inspection', $rental) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Inspection Notes *</label>
                        <textarea name="pre_inspection_notes" required rows="6" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                  placeholder="Document vehicle condition:&#10;- Body condition (scratches, dents)&#10;- Tire condition&#10;- Fluid levels&#10;- Interior condition&#10;- Cleanliness&#10;- Fuel level&#10;- Documents (registration, insurance)"></textarea>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Inspection Photos</label>
                        <input type="file" name="pre_inspection_images[]" multiple accept="image/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-2">Upload photos of vehicle condition (multiple files allowed)</p>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <p class="text-sm text-blue-800">
                            ✓ After submission, the vehicle will be marked as "Ready for Pickup" and the renter will be notified.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            Submit Pre-Inspection
                        </button>
                        <a href="{{ route('staff.rentals.index') }}" 
                           class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        @elseif($rental->status === 'In Use')
            <!-- Post-Return Inspection -->
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Post-Return Inspection</h2>
            
            <!-- Show Pre-Inspection Notes -->
            @if($rental->pre_inspection_notes)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                <h3 class="font-semibold text-gray-800 mb-2">Pre-Inspection Reference</h3>
                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $rental->pre_inspection_notes }}</p>
            </div>
            @endif

            <form action="{{ route('staff.rentals.post-inspection', $rental) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Return Inspection Notes *</label>
                        <textarea name="post_inspection_notes" required rows="6" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                                  placeholder="Document vehicle condition on return:&#10;- Compare with pre-inspection condition&#10;- Note any new damage&#10;- Fuel level&#10;- Cleanliness&#10;- Mileage (if applicable)"></textarea>
                    </div>

                    <div>
                        <label class="flex items-center mb-4">
                            <input type="checkbox" name="has_damage" value="1" 
                                   onchange="document.getElementById('damageSection').classList.toggle('hidden')"
                                   class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-2 focus:ring-red-500">
                            <span class="ml-2 text-gray-700 font-medium">Vehicle has damage</span>
                        </label>

                        <div id="damageSection" class="hidden space-y-4 pl-7">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Damage Description *</label>
                                <textarea name="damage_description" rows="4" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                                          placeholder="Describe the damage in detail..."></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">Estimated Damage Charge (Rs.)</label>
                                <input type="number" name="damage_charge" min="0" step="0.01" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                                       placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium mb-2">Return Inspection Photos</label>
                        <input type="file" name="post_inspection_images[]" multiple accept="image/*" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <p class="text-sm text-gray-500 mt-2">Upload photos of vehicle condition on return</p>
                    </div>

                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-sm text-green-800">
                            ✓ After submission, the rental will be marked as "Returned" and the renter will be notified.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                            Submit Return Inspection
                        </button>
                        <a href="{{ route('staff.rentals.index') }}" 
                           class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        @else
            <p class="text-gray-500 text-center py-8">Inspection not available for current status</p>
        @endif
    </div>
    </div>
</div>
@endsection
