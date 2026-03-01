@extends('layouts.customer-core')

@section('title', 'My Vehicles - AutoMate')

@section('content')
@include('customer.navbar')

<div class="cs-vehicles-page min-h-screen bg-gray-50 pb-12">
    <main class="cs-vehicles-main max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="cs-vehicles-head flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 mt-4">
            <div class="cs-vehicles-head-copy">
                <h1 class="cs-vehicles-title text-3xl font-bold text-gray-900">My Vehicles</h1>
                <p class="cs-vehicles-subtitle mt-2 text-lg text-gray-600">Manage your registered vehicles for service and maintenance.</p>
            </div>
            <button onclick="openVehicleModal()" class="cs-vehicles-add-btn inline-flex items-center px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition transform hover:-translate-y-0.5">
                <svg class="cs-vehicles-add-btn-icon w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Vehicle
            </button>
        </div>

        {{-- Tab Navigation --}}
        <div class="cs-vehicles-tabs-wrap mb-6" x-data="{ activeTab: 'all' }">
            <div class="cs-vehicles-tabs flex space-x-1 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
                <button @click="activeTab = 'all'" 
                        :class="activeTab === 'all' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="cs-vehicles-tab-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    All Vehicles ({{ $vehicles->count() }})
                </button>
                <button @click="activeTab = 'listed'" 
                        :class="activeTab === 'listed' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="cs-vehicles-tab-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Listed for Rent ({{ $vehicles->where('is_listed_for_rent', true)->count() }})
                </button>
            </div>

            {{-- All Vehicles Tab Content --}}
            <div x-show="activeTab === 'all'" x-transition class="cs-vehicles-tab-panel mt-6">
                <div class="cs-vehicles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="all-vehicles-grid">
                    @include('customer.vehicles.partials.vehicle-cards', ['vehicles' => $vehicles, 'showAll' => true])
                </div>
            </div>

            {{-- Listed for Rent Tab Content --}}
            <div x-show="activeTab === 'listed'" x-transition class="cs-vehicles-tab-panel mt-6">
                <div class="cs-vehicles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @include('customer.vehicles.partials.vehicle-cards', ['vehicles' => $vehicles->where('is_listed_for_rent', true), 'showAll' => false])
                </div>
            </div>
        </div>
    </main>
</div>

{{-- Add/Edit Vehicle Modal --}}
<div id="vehicle-modal-backdrop" class="cs-vehicle-modal-backdrop fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-start sm:items-center justify-center p-4 sm:p-6 overflow-y-auto">
    <div id="vehicle-modal" class="cs-vehicle-modal bg-white rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300 my-4 sm:my-0">
        <div class="cs-vehicle-modal-body p-5 sm:p-8">
            <div class="cs-vehicle-modal-head flex items-center justify-between mb-8">
                <h2 id="modal-title" class="cs-vehicle-modal-title text-2xl font-bold text-gray-900">Add New Vehicle</h2>
                <button onclick="closeVehicleModal()" class="cs-vehicle-modal-close p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="cs-vehicle-modal-close-icon w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('vehicles.store') }}" method="POST" class="cs-vehicle-form space-y-6" enctype="multipart/form-data">
                @csrf
                <div class="cs-vehicle-form-grid grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="cs-vehicle-field-group cs-vehicle-field-group-full sm:col-span-2">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Name (Optional)</label>
                        <input type="text" name="vehicle_name" placeholder="e.g. Family Car" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" placeholder="e.g. Toyota" required class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Model <span class="text-red-500">*</span></label>
                        <input type="text" name="model" placeholder="e.g. Executive" required class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mfg. Year <span class="text-red-500">*</span></label>
                        <input type="number" name="year" placeholder="2018" required min="1900" max="{{ date('Y') }}" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="cs-vehicle-field-group cs-vehicle-field-group-full sm:col-span-2">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">License Plate Number <span class="text-red-500">*</span></label>
                        <input type="text" name="plate_number" placeholder="e.g. BA 2 PA 1234" required class="cs-vehicle-field-control cs-vehicle-field-mono block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] font-mono transition duration-200 uppercase">
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Type <span class="text-red-500">*</span></label>
                        <select name="vehicle_type" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Car">Car</option>
                            <option value="SUV">SUV</option>
                            <option value="Bike">Bike</option>
                        </select>
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fuel Type <span class="text-red-500">*</span></label>
                        <select name="fuel_type" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div class="cs-vehicle-field-group">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Transmission <span class="text-red-500">*</span></label>
                        <select name="transmission_type" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                    <div class="cs-vehicle-field-group cs-vehicle-field-group-full sm:col-span-2">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Vehicle Images (Professional Gallery)</label>
                        <div class="cs-vehicle-upload-stack space-y-3">
                            <!-- Primary Image -->
                            <div class="cs-vehicle-upload-area cs-vehicle-upload-area-primary border-2 border-dashed border-[#ff5a1f] rounded-xl p-6 text-center hover:bg-orange-50 transition cursor-pointer" onclick="document.getElementById('primary-image').click()">
                                <svg class="cs-vehicle-upload-icon w-10 h-10 mx-auto text-[#ff5a1f] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <p class="cs-vehicle-upload-title text-sm font-semibold text-gray-700">Primary Image (Thumbnail)</p>
                                <p class="cs-vehicle-upload-help text-xs text-gray-500 mt-1">Click to upload main vehicle image</p>
                                <input type="file" id="primary-image" name="vehicle_image" accept="image/*" class="cs-vehicle-upload-input hidden">
                                <div id="primary-preview" class="cs-vehicle-primary-preview mt-3 hidden">
                                    <img id="primary-img" class="cs-vehicle-primary-preview-image h-32 object-cover rounded-lg mx-auto">
                                </div>
                            </div>

                            <!-- Multiple Images Gallery -->
                            <div class="cs-vehicle-upload-group">
                                <p class="cs-vehicle-upload-label text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Additional Images (Up to 10)</p>
                                <div class="cs-vehicle-upload-area cs-vehicle-upload-area-gallery border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition cursor-pointer" onclick="document.getElementById('gallery-images').click()">
                                    <svg class="cs-vehicle-upload-icon w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <p class="cs-vehicle-upload-title text-sm font-semibold text-gray-700">Add Gallery Images</p>
                                    <p class="cs-vehicle-upload-help text-xs text-gray-500 mt-1">Drag multiple images or click to upload</p>
                                    <input type="file" id="gallery-images" name="vehicle_images[]" accept="image/*" multiple class="cs-vehicle-upload-input hidden">
                                </div>
                                <div id="gallery-preview" class="cs-vehicle-gallery-preview grid grid-cols-2 sm:grid-cols-3 gap-3 mt-3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="cs-vehicle-field-group cs-vehicle-field-group-full sm:col-span-2">
                        <label class="cs-vehicle-field-label block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Daily Rate (Optional)</label>
                        <input type="number" name="daily_rate" step="0.01" min="0" placeholder="e.g. 2500" class="cs-vehicle-field-control block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                </div>

                <div class="cs-vehicle-form-actions flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                    <button type="button" onclick="closeVehicleModal()" class="cs-vehicle-form-cancel w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="cs-vehicle-form-submit w-full sm:w-auto px-10 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                        Save Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openVehicleModal() {
        const backdrop = document.getElementById('vehicle-modal-backdrop');
        const modal = document.getElementById('vehicle-modal');
        
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeVehicleModal() {
        const backdrop = document.getElementById('vehicle-modal-backdrop');
        const modal = document.getElementById('vehicle-modal');
        
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }, 300);
    }

    // Primary image preview
    document.getElementById('primary-image').addEventListener('change', function(e) {
        const preview = document.getElementById('primary-preview');
        const img = document.getElementById('primary-img');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                img.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

    // Multiple gallery images preview
    document.getElementById('gallery-images').addEventListener('change', function(e) {
        const preview = document.getElementById('gallery-preview');
        preview.innerHTML = '';
        const files = e.target.files;
        
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const container = document.createElement('div');
                container.className = 'cs-vehicle-gallery-item relative group';
                container.innerHTML = `
                    <img src="${event.target.result}" class="cs-vehicle-gallery-image w-full h-32 object-cover rounded-lg">
                    <div class="cs-vehicle-gallery-overlay absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition flex items-center justify-center">
                        <span class="cs-vehicle-gallery-index text-white text-xs font-bold bg-black bg-opacity-50 px-2 py-1 rounded hidden group-hover:block">${index + 1}</span>
                    </div>
                `;
                preview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    });

    // Drag and drop for gallery
    const galleryArea = document.querySelector('[onclick="document.getElementById(\'gallery-images\').click()"]');
    if (galleryArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            galleryArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            galleryArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            galleryArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            galleryArea.classList.add('cs-vehicle-upload-area-highlight', 'bg-orange-50', 'border-[#ff5a1f]');
        }

        function unhighlight(e) {
            galleryArea.classList.remove('cs-vehicle-upload-area-highlight', 'bg-orange-50', 'border-[#ff5a1f]');
        }

        galleryArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            document.getElementById('gallery-images').files = files;
            
            const event = new Event('change', { bubbles: true });
            document.getElementById('gallery-images').dispatchEvent(event);
        }
    }

    // Close on backdrop click
    document.getElementById('vehicle-modal-backdrop').addEventListener('click', function(e) {
        if (e.target === this) closeVehicleModal();
    });
</script>

@endsection
