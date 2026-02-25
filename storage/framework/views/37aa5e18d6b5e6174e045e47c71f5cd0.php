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
                    <a href="#contact" class="text-sm font-medium text-gray-600 hover:text-[#ff5a1f] transition">Contact</a>
                    
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
            <!-- Text Content -->
            <div class="w-full lg:w-1/2 z-10">
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                    Vechiles Service, <br>
                    <span class="text-[#ff5a1f]">Smart Move.</span>
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

            <!-- Image Content -->
            <div class="w-full lg:w-1/2 relative hidden lg:block">
                
                <svg class="absolute -top-20 -right-20 h-96 w-96 text-gray-100 opacity-20" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>
                
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1487754180451-c456f719a1fc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" alt="Car Service" class="w-full h-auto object-cover object-center rounded-3xl">
                    <div class="absolute inset-0 bg-gradient-to-l from-transparent to-transparent rounded-3xl"></div>
                </div>
            </div>
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

    
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-[#ff5a1f] uppercase tracking-widest mb-3">Get in Touch</h2>
                <h3 class="text-4xl font-extrabold text-gray-900">Contact Us</h3>
                <p class="mt-4 text-lg text-gray-600">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <div class="bg-gray-50 rounded-3xl p-8 lg:p-12">
                    <?php if(session('success')): ?>
                        <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-100">
                            <div class="flex">
                                <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="ml-3 text-sm font-medium text-green-800"><?php echo e(session('success')); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-100">
                            <div class="flex">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc pl-5">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Your Name</label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" value="<?php echo e(old('subject')); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition resize-none <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-200 transform hover:-translate-y-0.5">
                            Send Message
                        </button>
                    </form>
                </div>

                
                <div class="flex flex-col justify-center space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">Email</h4>
                            <p class="mt-1 text-gray-600">support@automate.com</p>
                            <p class="text-gray-600">sales@automate.com</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">Phone</h4>
                            <p class="mt-1 text-gray-600">(555) 123-4567</p>
                            <p class="text-gray-600">Mon-Fri 9am-6pm</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-bold text-gray-900">Office</h4>
                            <p class="mt-1 text-gray-600">123 Service Lane</p>
                            <p class="text-gray-600">Auto City, AC 12345</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-[#ff5a1f] hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-[#ff5a1f] hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-[#ff5a1f] hover:text-white transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>
                            </a>
                        </div>
                    </div>
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
                        <li>9852000987</li>
                        <li>Itahari Sangit Chwok</li>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\index.blade.php ENDPATH**/ ?>