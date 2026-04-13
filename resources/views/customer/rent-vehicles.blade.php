@extends('layouts.customer-core')

@section('title', 'Rent Vehicles - AutoMate')

@section('content')
@include('customer.navbar')

<div class="cs-page cs-rent-vehicles-page min-h-screen bg-gray-50 pb-12">
    <main class="cs-rent-main max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="cs-rent-head mb-6">
            <h1 class="cs-rent-title text-3xl font-bold text-gray-900">Rent Vehicles</h1>
            <p class="cs-rent-subtitle text-gray-500 mt-1">Browse available vehicles and request a rental when you find the right one.</p>
        </div>

        @if(session('success'))
            <div class="cs-rent-alert cs-rent-alert-success mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
                <svg class="cs-rent-alert-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="cs-rent-alert cs-rent-alert-error mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex items-center animate-fade-in">
                <svg class="cs-rent-alert-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="cs-rent-alert cs-rent-alert-error mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 animate-fade-in">
                <p class="cs-rent-alert-title font-semibold mb-2">Could not submit rental request:</p>
                <ul class="cs-rent-alert-list list-disc pl-5 space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li class="cs-rent-alert-item">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($vehicles->count() === 0)
            <div class="cs-rent-empty bg-white rounded-3xl border border-dashed border-gray-200 p-10 text-center">
                <h3 class="cs-rent-empty-title text-xl font-semibold text-gray-900">No vehicles available right now</h3>
                <p class="cs-rent-empty-text text-gray-500 mt-2">Check back soon for new listings.</p>
            </div>
        @else
            <div class="cs-rent-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $vehicle)
                    @php
                        $resolveVehicleImageUrl = static function (?string $path): ?string {
                            if (!$path) {
                                return null;
                            }

                            $normalized = str_replace('\\', '/', trim($path));

                            if (\Illuminate\Support\Str::startsWith($normalized, ['http://', 'https://'])) {
                                return $normalized;
                            }

                            if (\Illuminate\Support\Str::startsWith($normalized, '/storage/')) {
                                return asset(ltrim($normalized, '/'));
                            }

                            if (\Illuminate\Support\Str::startsWith($normalized, 'storage/')) {
                                return asset($normalized);
                            }

                            return asset('storage/' . ltrim($normalized, '/'));
                        };

                        $allImages = [];
                        if ($vehicle->image_path) {
                            $allImages[] = $vehicle->image_path;
                        }
                        $allImages = array_merge($allImages, $vehicle->images->pluck('image_path')->toArray());
                        $primaryImage = count($allImages) > 0 ? $resolveVehicleImageUrl($allImages[0]) : null;
                        $isAdminVehicle = (bool) $vehicle->is_service_center_vehicle;
                        $displayRate = $isAdminVehicle ? $vehicle->daily_rate : ($vehicle->owner_daily_rate ?? $vehicle->daily_rate);
                        $vehiclePayload = [
                            'id' => $vehicle->id,
                            'owner_vehicle_id' => $vehicle->owner_vehicle_id,
                            'rental_type' => $isAdminVehicle ? 'admin' : 'marketplace',
                            'name' => $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model),
                            'details' => ($vehicle->vehicle_type ?? 'Vehicle') . ' • ' . ($vehicle->fuel_type ?? 'Fuel N/A') . ' • ' . ($vehicle->transmission_type ?? 'Transmission N/A'),
                            'owner' => $isAdminVehicle ? 'AutoMate Service Center' : ($vehicle->customer->name ?? 'N/A'),
                            'rate' => $displayRate !== null ? number_format($displayRate, 2) : 'N/A',
                            'image' => $primaryImage,
                        ];
                    @endphp

                    <div class="cs-rent-card bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col group">
                        <!-- Image Gallery Section -->
                        <div class="cs-rent-card-media relative h-48 bg-gray-100 overflow-hidden">
                            <!-- Main Image -->
                            @if(count($allImages) > 0)
                                <img src="{{ $resolveVehicleImageUrl($allImages[0]) }}"
                                     class="cs-rent-card-image w-full h-full object-cover"
                                     alt="{{ $vehicle->vehicle_name ?? $vehicle->brand }}">
                            @else
                                <div class="cs-rent-card-media-empty w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="cs-rent-card-media-empty-icon w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                                </div>
                            @endif

                            <span class="cs-rent-chip cs-rent-chip-available absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 shadow-sm">
                                <span class="cs-rent-chip-dot w-1.5 h-1.5 rounded-full bg-green-600 mr-2"></span>
                                Available
                            </span>
                        </div>
                        <div class="cs-rent-card-body p-6 flex-1">
                            <div class="cs-rent-card-head flex items-center justify-between mb-3">
                                <h3 class="cs-rent-card-title text-xl font-bold text-gray-900">
                                    {{ $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model) }}
                                </h3>
                            </div>
                            <p class="cs-rent-card-details text-sm text-gray-500 mb-2">{{ $vehicle->vehicle_type ?? 'Vehicle' }} • {{ $vehicle->fuel_type ?? 'Fuel N/A' }} • {{ $vehicle->transmission_type ?? 'Transmission N/A' }}</p>
                            <p class="cs-rent-card-owner text-xs text-gray-400 mb-3">
                                <span class="cs-rent-card-owner-inline inline-flex items-center">
                                    <svg class="cs-rent-card-owner-icon w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Owner: {{ $isAdminVehicle ? 'AutoMate Service Center' : ($vehicle->customer->name ?? 'N/A') }}
                                </span>
                            </p>
                            <div class="cs-rent-card-rate flex items-center text-lg font-bold text-[#ff5a1f] mb-3">
                                <svg class="cs-rent-card-rate-icon w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Rs. {{ $displayRate !== null ? number_format($displayRate, 2) : 'N/A' }} / day
                            </div>
                            <div class="cs-rent-card-plate flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                                <svg class="cs-rent-card-plate-icon w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                                </svg>
                                {{ $vehicle->plate_number }}
                            </div>
                        </div>
                        <div class="cs-rent-card-actions px-6 py-4 bg-gray-50/50 border-t border-gray-50">
                            <button
                                type="button"
                                onclick="openRentModalFromButton(this)"
                                data-vehicle-id="{{ $vehiclePayload['id'] }}"
                                data-owner-vehicle-id="{{ $vehiclePayload['owner_vehicle_id'] }}"
                                data-rental-type="{{ $vehiclePayload['rental_type'] }}"
                                data-vehicle-name="{{ $vehiclePayload['name'] }}"
                                data-vehicle-details="{{ $vehiclePayload['details'] }}"
                                data-vehicle-owner="{{ $vehiclePayload['owner'] }}"
                                data-vehicle-rate="{{ $vehiclePayload['rate'] }}"
                                data-vehicle-image="{{ $vehiclePayload['image'] ?? '' }}"
                                class="cs-rent-request-btn w-full px-4 py-2.5 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-100"
                            >
                                Request Rent
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div id="rent-modal-backdrop" class="cs-rent-modal-backdrop fixed inset-0 z-[90] bg-black/50 backdrop-blur-sm px-4 sm:px-6 pt-20 sm:pt-24 pb-6 hidden items-start justify-center overflow-y-auto">
                <div id="rent-modal" class="cs-rent-modal bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[calc(100vh-7rem)] sm:max-h-[calc(100vh-8rem)] overflow-y-auto">
                    <div class="cs-rent-modal-body p-5 sm:p-8">
                        <div class="cs-rent-modal-head flex items-start justify-between mb-6">
                            <div class="cs-rent-modal-copy">
                                <h2 class="cs-rent-modal-title text-2xl font-bold text-gray-900">Request Vehicle Rent</h2>
                                <p class="cs-rent-modal-subtitle text-sm text-gray-500 mt-1">Provide rental details to send your request.</p>
                            </div>
                            <button type="button" onclick="closeRentModal()" class="cs-rent-modal-close p-2 rounded-lg hover:bg-gray-100 transition">
                                <svg class="cs-rent-modal-close-icon w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="cs-rent-modal-summary bg-gray-50 rounded-2xl p-4 sm:p-5 mb-6">
                            <div class="cs-rent-modal-summary-inner flex items-start gap-4">
                                <img id="modal-vehicle-image" src="" alt="Selected vehicle" class="cs-rent-modal-image w-24 h-20 rounded-xl object-cover border border-gray-200 hidden">
                                <div class="cs-rent-modal-meta min-w-0">
                                    <h3 id="modal-vehicle-name" class="cs-rent-modal-vehicle-name text-lg font-bold text-gray-900"></h3>
                                    <p id="modal-vehicle-details" class="cs-rent-modal-vehicle-details text-sm text-gray-600"></p>
                                    <p class="cs-rent-modal-owner text-xs text-gray-500 mt-1">Owner: <span id="modal-vehicle-owner"></span></p>
                                    <p class="cs-rent-modal-rate text-sm font-bold text-[#ff5a1f] mt-1">Rs. <span id="modal-vehicle-rate"></span> / day</p>
                                </div>
                            </div>
                        </div>

                        <form id="rent-request-form" action="{{ route('rent-vehicles.request') }}" method="POST" class="cs-rent-form space-y-4">
                            @csrf
                            <input type="hidden" id="rent-vehicle-id" name="vehicle_id" value="">

                            <div class="cs-rent-form-grid grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="cs-rent-field-group">
                                    <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Start Date</label>
                                    <input type="date" id="rent-start-date" name="start_date" required class="cs-rent-field-control w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="cs-rent-field-group">
                                    <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">End Date</label>
                                    <input type="date" id="rent-end-date" name="end_date" required class="cs-rent-field-control w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="cs-rent-form-grid grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="cs-rent-field-group">
                                    <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Contact Number</label>
                                    <input type="tel" name="renter_contact" value="{{ old('renter_contact') }}" placeholder="Your contact number" class="cs-rent-field-control w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]">
                                </div>
                                <div class="cs-rent-field-group">
                                    <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pickup Location</label>
                                    <input type="text" name="pickup_location" value="{{ old('pickup_location') }}" placeholder="Where to pickup" class="cs-rent-field-control w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]">
                                </div>
                            </div>

                            <div class="cs-rent-field-group">
                                <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Notes (Optional)</label>
                                <textarea name="notes" rows="3" class="cs-rent-field-control cs-rent-field-textarea w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" placeholder="Any extra request details...">{{ old('notes') }}</textarea>
                            </div>

                            <div class="cs-rent-field-group">
                                <label class="cs-rent-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Service Booking Link (Optional)</label>
                                <input type="text" name="service_link" value="{{ old('service_link') }}" placeholder="Paste booking link if applicable" class="cs-rent-field-control w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f]">
                            </div>

                            <div class="cs-rent-form-actions pt-2 flex flex-col sm:flex-row justify-end gap-3">
                                <button type="button" onclick="closeRentModal()" class="cs-rent-cancel-btn px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                                <button type="submit" class="cs-rent-submit-btn px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-100">
                                    Send Rent Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </main>
</div>

<script>
    function openRentModalFromButton(button) {
        const backdrop = document.getElementById('rent-modal-backdrop');
        const vehicleIdInput = document.getElementById('rent-vehicle-id');
        const formEl = document.getElementById('rent-request-form');
        const nameEl = document.getElementById('modal-vehicle-name');
        const detailsEl = document.getElementById('modal-vehicle-details');
        const ownerEl = document.getElementById('modal-vehicle-owner');
        const rateEl = document.getElementById('modal-vehicle-rate');
        const imageEl = document.getElementById('modal-vehicle-image');
        const startDateEl = document.getElementById('rent-start-date');
        const endDateEl = document.getElementById('rent-end-date');

        vehicleIdInput.value = button.dataset.vehicleId || '';
        nameEl.textContent = button.dataset.vehicleName || '';
        detailsEl.textContent = button.dataset.vehicleDetails || '';
        ownerEl.textContent = button.dataset.vehicleOwner || '';
        rateEl.textContent = button.dataset.vehicleRate || '';

        formEl.action = '{{ route('rent-vehicles.request') }}';

        if (button.dataset.vehicleImage) {
            imageEl.src = button.dataset.vehicleImage;
            imageEl.classList.remove('hidden');
        } else {
            imageEl.src = '';
            imageEl.classList.add('hidden');
        }

        if (startDateEl) startDateEl.value = '';
        if (endDateEl) endDateEl.value = '';

        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
    }

    function closeRentModal() {
        const backdrop = document.getElementById('rent-modal-backdrop');
        if (!backdrop) return;

        backdrop.classList.add('hidden');
        backdrop.classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const backdrop = document.getElementById('rent-modal-backdrop');
        const startDateEl = document.getElementById('rent-start-date');
        const endDateEl = document.getElementById('rent-end-date');
        const today = '{{ date('Y-m-d') }}';

        if (backdrop) {
            backdrop.addEventListener('click', function (event) {
                if (event.target === backdrop) {
                    closeRentModal();
                }
            });
        }

        if (startDateEl && endDateEl) {
            startDateEl.addEventListener('change', function () {
                endDateEl.min = this.value || today;
                if (endDateEl.value && endDateEl.value < endDateEl.min) {
                    endDateEl.value = endDateEl.min;
                }
            });
        }
    });
</script>
@endsection
