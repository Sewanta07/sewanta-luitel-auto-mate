<?php $__env->startSection('title', 'AutoMate - Smart Vehicle Service Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-50 min-h-screen font-sans text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <span class="text-3xl font-extrabold tracking-tight text-[#ff5a1f]">AutoMate</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#services" class="text-sm font-medium text-gray-600 hover:text-[#ff5a1f] transition">Services</a>
                    <a href="#features" class="text-sm font-medium text-gray-600 hover:text-[#ff5a1f] transition">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 hover:text-[#ff5a1f] transition">How it Works</a>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard.' . auth()->user()->role)); ?>" class="px-5 py-2.5 rounded-xl bg-[#ff5a1f] text-white text-sm font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-200">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <div class="flex items-center space-x-4">
                            <a href="<?php echo e(route('login')); ?>" class="text-sm font-bold text-gray-700 hover:text-gray-900">Log in</a>
                            <a href="<?php echo e(route('register')); ?>" class="px-5 py-2.5 rounded-xl bg-[#ff5a1f] text-white text-sm font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-200">
                                Get Started
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="md:hidden flex items-center">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:w-1/2">
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                    Car Service, <br>
                    <span class="text-[#ff5a1f]">Reimagined.</span>
                </h1>
                <p class="text-lg text-gray-600 mb-10 leading-relaxed max-w-lg">
                    Experience the future of vehicle maintenance. Book services, track repairs in real-time, and manage your entire fleet from one beautiful dashboard.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard.' . auth()->user()->role)); ?>" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-[#ff5a1f] hover:bg-[#e64b15] shadow-xl shadow-orange-200 transition transform hover:-translate-y-1">
                            Go to Dashboard
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-2xl text-white bg-[#ff5a1f] hover:bg-[#e64b15] shadow-xl shadow-orange-200 transition transform hover:-translate-y-1">
                            Book a Service
                            <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex justify-center items-center px-8 py-4 border border-gray-200 text-base font-bold rounded-2xl text-gray-700 bg-white hover:bg-gray-50 transition">
                            Log In
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        
        <div class="absolute top-0 right-0 w-full lg:w-3/5 h-full opacity-10 lg:opacity-100 pointer-events-none">
            <svg class="absolute right-0 top-0 h-full w-auto text-gray-100 transform translate-x-1/4" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            <div class="absolute inset-y-0 right-0 w-full h-full bg-gradient-to-l from-white via-transparent to-transparent"></div>
            
            <img src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" alt="Car Service" class="absolute top-0 right-0 h-full w-full object-cover object-center lg:rounded-bl-[5rem] shadow-2xl">
        </div>
    </div>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-[#ff5a1f] uppercase tracking-widest mb-3">Simple Process</h2>
                <h3 class="text-4xl font-extrabold text-gray-900">How AutoMate Works</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-blue-50 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">1. Select Service</h4>
                    <p class="text-gray-500 leading-relaxed">Choose from our wide range of maintenance and repair services.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-orange-50 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">2. Book a Slot</h4>
                    <p class="text-gray-500 leading-relaxed">Pick a date and time that works for you, or request a pickup.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-purple-50 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">3. Track Progress</h4>
                    <p class="text-gray-500 leading-relaxed">Get real-time updates and approve estimates online.</p>
                </div>
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto bg-green-50 rounded-3xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-300">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">4. Drive Away</h4>
                    <p class="text-gray-500 leading-relaxed">Pay online and get your car back in top condition.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-xl">
                    <h2 class="text-sm font-bold text-[#ff5a1f] uppercase tracking-widest mb-3">Our Expertise</h2>
                    <h3 class="text-4xl font-extrabold text-gray-900">Professional Car Care</h3>
                </div>
                <a href="<?php echo e(route('register')); ?>" class="hidden md:inline-flex items-center font-bold text-[#ff5a1f] hover:text-[#e64b15] transition">
                    View All Services <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-orange-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#ff5a1f] transition duration-300">
                        <svg class="w-8 h-8 text-[#ff5a1f] group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">General Maintenance</h3>
                    <p class="text-gray-500 mb-6">Oil changes, filter replacements, and scheduled checkups to keep your vehicle running smoothly.</p>
                </div>

                
                <div class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition duration-300">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Engine & Transmission</h3>
                    <p class="text-gray-500 mb-6">Advanced diagnostics and repairs for the heart of your vehicle, ensuring peak performance.</p>
                </div>

                
                <div class="bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl transition duration-300 border border-gray-100 group">
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-purple-600 transition duration-300">
                        <svg class="w-8 h-8 text-purple-600 group-hover:text-white transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Diagnostics</h3>
                    <p class="text-gray-500 mb-6">Computerized scanning to pinpoint electrical and mechanical issues with precision.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <span class="text-3xl font-extrabold tracking-tight text-white mb-6 block">AutoMate</span>
                    <p class="text-gray-400 text-lg leading-relaxed max-w-sm">
                        Revolutionizing vehicle maintenance with digital transparency, efficiency, and trust.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-[#ff5a1f] transition">Home</a></li>
                        <li><a href="#services" class="hover:text-[#ff5a1f] transition">Services</a></li>
                        <li><a href="#how-it-works" class="hover:text-[#ff5a1f] transition">How it Works</a></li>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-[#ff5a1f] transition">Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-6">Contact</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li>support@automate.com</li>
                        <li>(555) 123-4567</li>
                        <li>123 Service Lane, Auto City</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 text-sm">
                <p>&copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/index.blade.php ENDPATH**/ ?>