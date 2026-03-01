@extends('layouts.public-core')

@section('title', 'AutoMate - Smart Vehicle Service Management')

@section('content')
<div class="lp-page">
    <!-- Navigation -->
    <nav class="lp-nav">
        <div class="lp-container">
            <div class="lp-nav-row">
                <div class="lp-brand-wrap">
                    <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="lp-logo-image">
                </div>
                
                <div class="lp-nav-links">
                    <a href="#services" class="lp-nav-link">Services</a>
                    <a href="#features" class="lp-nav-link">Features</a>
                    <a href="#how-it-works" class="lp-nav-link">How it Works</a>
                    <a href="#contact" class="lp-nav-link">Contact</a>
                    
                    @auth
                        <a href="{{ route('dashboard.' . auth()->user()->role) }}" class="lp-btn lp-btn-primary lp-btn-sm">
                            Dashboard
                        </a>
                    @else
                        <div class="lp-nav-auth">
                            <a href="{{ route('login') }}" class="lp-login-link">Log in</a>
                            <a href="{{ route('register') }}" class="lp-btn lp-btn-primary lp-btn-sm">
                                Get Started
                            </a>
                        </div>
                    @endauth
                </div>

                {{-- Mobile Menu Button (Placeholder) --}}
                <div class="lp-mobile-toggle-wrap">
                    <button class="lp-mobile-toggle" type="button" aria-label="Open menu">
                        <img src="{{ asset('assets/landing/icons/menu.svg') }}" alt="Menu" class="lp-icon-lg lp-icon-img">
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="lp-hero">
        <div class="lp-container lp-hero-row">
            <!-- Text Content -->
            <div class="lp-hero-copy">
                <h1 class="lp-hero-title">
                    Vechiles Service, <br>
                    <span class="lp-text-accent">Smart Move.</span>
                </h1>
                <p class="lp-hero-subtitle">
                    Experience the future of vehicle maintenance. Book services, track repairs in real-time, and manage your entire fleet from one beautiful dashboard.
                </p>
                <div class="lp-hero-actions">
                    @auth
                        <a href="{{ route('dashboard.' . auth()->user()->role) }}" class="lp-btn lp-btn-primary lp-btn-lg">
                            Go to Dashboard
                            <img src="{{ asset('assets/landing/icons/arrow-right-white.svg') }}" alt="Arrow" class="lp-icon-sm lp-icon-right lp-icon-img">
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="lp-btn lp-btn-primary lp-btn-lg">
                            Book a Service
                            <img src="{{ asset('assets/landing/icons/arrow-right-white.svg') }}" alt="Arrow" class="lp-icon-sm lp-icon-right lp-icon-img">
                        </a>
                        <a href="{{ route('login') }}" class="lp-btn lp-btn-outline lp-btn-lg">
                            Log In
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Image Content -->
            <div class="lp-hero-media">
                {{-- Hero Background Graphic --}}
                <img src="{{ asset('assets/landing/icons/hero-shape.svg') }}" alt="" class="lp-hero-bg" aria-hidden="true">
                {{-- Placeholder for Hero Image --}}
                <div class="lp-hero-image-wrap">
                    <img src="{{ asset('assets/landing/images/hero-car.jpg') }}" alt="Car Service" class="lp-hero-image">
                    <div class="lp-hero-image-overlay"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <section id="how-it-works" class="lp-section lp-section-white">
        <div class="lp-container">
            <div class="lp-section-head">
                <h2 class="lp-eyebrow">Simple Process</h2>
                <h3 class="lp-heading">How AutoMate Works</h3>
            </div>

            <div class="lp-hiw-grid">
                <div class="lp-hiw-item">
                    <div class="lp-hiw-icon lp-hiw-icon-blue">
                        <img src="{{ asset('assets/landing/icons/home-blue.svg') }}" alt="Select service" class="lp-icon-xl lp-icon-img">
                    </div>
                    <h4 class="lp-hiw-title">1. Select Service</h4>
                    <p class="lp-hiw-text">Choose from our wide range of maintenance and repair services.</p>
                </div>
                <div class="lp-hiw-item">
                    <div class="lp-hiw-icon lp-hiw-icon-orange">
                        <img src="{{ asset('assets/landing/icons/calendar-orange.svg') }}" alt="Book slot" class="lp-icon-xl lp-icon-img">
                    </div>
                    <h4 class="lp-hiw-title">2. Book a Slot</h4>
                    <p class="lp-hiw-text">Pick a date and time that works for you, or request a pickup.</p>
                </div>
                <div class="lp-hiw-item">
                    <div class="lp-hiw-icon lp-hiw-icon-purple">
                        <img src="{{ asset('assets/landing/icons/clipboard-purple.svg') }}" alt="Track progress" class="lp-icon-xl lp-icon-img">
                    </div>
                    <h4 class="lp-hiw-title">3. Track Progress</h4>
                    <p class="lp-hiw-text">Get real-time updates and approve estimates online.</p>
                </div>
                <div class="lp-hiw-item">
                    <div class="lp-hiw-icon lp-hiw-icon-green">
                        <img src="{{ asset('assets/landing/icons/check-green.svg') }}" alt="Drive away" class="lp-icon-xl lp-icon-img">
                    </div>
                    <h4 class="lp-hiw-title">4. Drive Away</h4>
                    <p class="lp-hiw-text">Pay online and get your car back in top condition.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="lp-section lp-section-gray">
        <div class="lp-container">
            <div class="lp-services-head">
                <div class="lp-services-head-copy">
                    <h2 class="lp-eyebrow">Our Expertise</h2>
                    <h3 class="lp-heading">Professional Car Care</h3>
                </div>
                <a href="{{ route('register') }}" class="lp-view-all-link">
                    View All Services <img src="{{ asset('assets/landing/icons/arrow-right-accent.svg') }}" alt="Arrow" class="lp-icon-sm lp-icon-right lp-icon-img">
                </a>
            </div>

            <div class="lp-services-grid">
                {{-- Service Card 1 --}}
                <div class="lp-service-card lp-service-card-orange">
                    <div class="lp-service-icon-wrap">
                        <img src="{{ asset('assets/landing/icons/settings-orange.svg') }}" alt="General maintenance" class="lp-icon-lg lp-icon-img">
                    </div>
                    <h3 class="lp-service-title">General Maintenance</h3>
                    <p class="lp-service-text">Oil changes, filter replacements, and scheduled checkups to keep your vehicle running smoothly.</p>
                </div>

                {{-- Service Card 2 --}}
                <div class="lp-service-card lp-service-card-blue">
                    <div class="lp-service-icon-wrap">
                        <img src="{{ asset('assets/landing/icons/wrench-blue.svg') }}" alt="Engine and transmission" class="lp-icon-lg lp-icon-img">
                    </div>
                    <h3 class="lp-service-title">Engine & Transmission</h3>
                    <p class="lp-service-text">Advanced diagnostics and repairs for the heart of your vehicle, ensuring peak performance.</p>
                </div>

                {{-- Service Card 3 --}}
                <div class="lp-service-card lp-service-card-purple">
                    <div class="lp-service-icon-wrap">
                        <img src="{{ asset('assets/landing/icons/file-purple.svg') }}" alt="Diagnostics" class="lp-icon-lg lp-icon-img">
                    </div>
                    <h3 class="lp-service-title">Diagnostics</h3>
                    <p class="lp-service-text">Computerized scanning to pinpoint electrical and mechanical issues with precision.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="lp-section lp-section-white">
        <div class="lp-container">
            <div class="lp-section-head">
                <h2 class="lp-eyebrow">Get in Touch</h2>
                <h3 class="lp-heading">Contact Us</h3>
                <p class="lp-section-sub">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>

            <div class="lp-contact-grid">
                {{-- Contact Form --}}
                <div class="lp-contact-form-wrap">
                    @if(session('success'))
                        <div class="lp-alert lp-alert-success">
                            <div class="lp-alert-row">
                                <img src="{{ asset('assets/landing/icons/check-green.svg') }}" alt="Success" class="lp-icon-sm lp-alert-icon-success lp-icon-img">
                                <p class="lp-alert-text-success">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="lp-alert lp-alert-error">
                            <div class="lp-alert-row">
                                <img src="{{ asset('assets/landing/icons/alert-red.svg') }}" alt="Error" class="lp-icon-sm lp-alert-icon-error lp-icon-img">
                                <div class="lp-alert-content">
                                    <h3 class="lp-alert-title-error">There were errors with your submission</h3>
                                    <ul class="lp-error-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="lp-form">
                        @csrf
                        <div>
                            <label for="name" class="lp-label">Your Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="lp-input @error('name') lp-input-error @enderror">
                            @error('name')
                                <p class="lp-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="lp-label">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required class="lp-input @error('email') lp-input-error @enderror">
                            @error('email')
                                <p class="lp-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject" class="lp-label">Subject</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="lp-input @error('subject') lp-input-error @enderror">
                            @error('subject')
                                <p class="lp-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="lp-label">Message</label>
                            <textarea id="message" name="message" rows="5" required class="lp-input lp-textarea @error('message') lp-input-error @enderror">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="lp-field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="lp-btn lp-btn-primary lp-btn-full">
                            Send Message
                        </button>
                    </form>
                </div>

                {{-- Contact Info --}}
                <div class="lp-contact-info">
                    <div class="lp-contact-item">
                        <div class="lp-contact-icon-box">
                            <div class="lp-contact-icon-wrap">
                                <img src="{{ asset('assets/landing/icons/mail-accent.svg') }}" alt="Email" class="lp-icon-md lp-icon-img">
                            </div>
                        </div>
                        <div class="lp-contact-text">
                            <h4 class="lp-contact-title">Email</h4>
                            <p class="lp-contact-line">support@automate.com</p>
                            <p class="lp-contact-line">sales@automate.com</p>
                        </div>
                    </div>

                    <div class="lp-contact-item">
                        <div class="lp-contact-icon-box">
                            <div class="lp-contact-icon-wrap">
                                <img src="{{ asset('assets/landing/icons/phone-accent.svg') }}" alt="Phone" class="lp-icon-md lp-icon-img">
                            </div>
                        </div>
                        <div class="lp-contact-text">
                            <h4 class="lp-contact-title">Phone</h4>
                            <p class="lp-contact-line">9852000987</p>
                            <p class="lp-contact-line">Mon-Fri 9am-6pm</p>
                        </div>
                    </div>

                    <div class="lp-contact-item">
                        <div class="lp-contact-icon-box">
                            <div class="lp-contact-icon-wrap">
                                <img src="{{ asset('assets/landing/icons/map-pin-accent.svg') }}" alt="Office" class="lp-icon-md lp-icon-img">
                            </div>
                        </div>
                        <div class="lp-contact-text">
                            <h4 class="lp-contact-title">Office</h4>
                            <p class="lp-contact-line">Itahari</p>
                            <p class="lp-contact-line">Sangit Chwok</p>
                        </div>
                    </div>

                    <div class="lp-social-wrap">
                        <h4 class="lp-contact-title">Follow Us</h4>
                        <div class="lp-social-list">
                            <a href="#" class="lp-social-link" aria-label="Facebook">
                                <img src="{{ asset('assets/landing/icons/facebook-white.svg') }}" alt="Facebook" class="lp-icon-sm lp-icon-img">
                            </a>
                            <a href="#" class="lp-social-link" aria-label="Twitter">
                                <img src="{{ asset('assets/landing/icons/twitter-white.svg') }}" alt="Twitter" class="lp-icon-sm lp-icon-img">
                            </a>
                            <a href="#" class="lp-social-link" aria-label="Instagram">
                                <img src="{{ asset('assets/landing/icons/instagram-white.svg') }}" alt="Instagram" class="lp-icon-sm lp-icon-img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="lp-footer">
        <div class="lp-container">
            <div class="lp-footer-grid">
                <div class="lp-footer-brand-col">
                    <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="lp-logo-image lp-logo-image-footer">
                    <p class="lp-footer-brand-text">
                        Revolutionizing vehicle maintenance with digital transparency, efficiency, and trust.
                    </p>
                </div>
                <div>
                    <h4 class="lp-footer-title">Quick Links</h4>
                    <ul class="lp-footer-list">
                        <li><a href="#" class="lp-footer-link">Home</a></li>
                        <li><a href="#services" class="lp-footer-link">Services</a></li>
                        <li><a href="#how-it-works" class="lp-footer-link">How it Works</a></li>
                        <li><a href="{{ route('login') }}" class="lp-footer-link">Login</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="lp-footer-title">Contact</h4>
                    <ul class="lp-footer-list">
                        <li>support@automate.com</li>
                        <li>9852000987</li>
                        <li>Itahari Sangit Chwok</li>
                    </ul>
                </div>
            </div>
            <div class="lp-footer-bottom">
                <p>&copy; {{ date('Y') }} AutoMate. All rights reserved.</p>
                <div class="lp-footer-bottom-links">
                    <a href="#" class="lp-footer-bottom-link">Privacy Policy</a>
                    <a href="#" class="lp-footer-bottom-link">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
