{{-- Premium Customer Navigation Bar --}}
<nav id="customerNav" class="cs-cnav">
  <div class="cs-cnav-container">
    <div class="cs-cnav-row">
      
      {{-- BRANDING (LEFT) --}}
      <div class="cs-cnav-brand-wrap">
        <a href="{{ route('dashboard.customer') }}" class="cs-cnav-brand-link">
          <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="customer-logo-image">
        </a>
      </div>

      {{-- CENTERED LINKS --}}
      <div class="cs-cnav-links-wrap">
        <div class="cs-cnav-links">
          <a href="{{ route('dashboard.customer') }}" 
             class="cs-cnav-link {{ request()->routeIs('dashboard.customer') ? 'cs-cnav-link-active' : '' }}">
            Dashboard
          </a>
           <a href="{{ route('bookings.index') }}" 
             class="cs-cnav-link {{ request()->routeIs('bookings.index') ? 'cs-cnav-link-active' : '' }}">
            Bookings
            @if(($navCounts['services_pending'] ?? 0) > 0)
              <span class="cs-cnav-count">
                {{ ($navCounts['services_pending'] ?? 0) > 99 ? '99+' : ($navCounts['services_pending'] ?? 0) }}
              </span>
            @endif
          </a>
          <a href="{{ route('customer.vehicles') }}" 
             class="cs-cnav-link {{ request()->routeIs('customer.vehicles*') ? 'cs-cnav-link-active' : '' }}">
            Vehicles
          </a>
          <a href="{{ route('customer.rent-vehicles') }}" 
             class="cs-cnav-link {{ request()->routeIs('customer.rent-vehicles') ? 'cs-cnav-link-active' : '' }}">
            Rent Vehicles
          </a>
          <a href="{{ route('customer.rentals') }}" 
             class="cs-cnav-link {{ request()->routeIs('customer.rentals*') ? 'cs-cnav-link-active' : '' }}">
            My Rentals
            @if(($navCounts['rentals_pending'] ?? 0) > 0)
              <span class="cs-cnav-count">
                {{ ($navCounts['rentals_pending'] ?? 0) > 99 ? '99+' : ($navCounts['rentals_pending'] ?? 0) }}
              </span>
            @endif
          </a>
          </div>
      </div>

      {{-- ACTIONS & USER (RIGHT) --}}
      <div class="cs-cnav-actions">
        <button id="customerMobileMenuButton" type="button" class="cs-cnav-mobile-toggle" aria-label="Toggle mobile menu">
          <svg class="cs-cnav-mobile-toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        
        {{-- High-Priority Action --}}
        <a href="{{ route('bookings.create') }}" class="cs-cnav-cta">
          <svg class="cs-cnav-cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
          Book Service
        </a>

        {{-- Customer Messaging --}}
        <a href="{{ route('customer.messages') ?? '#' }}" class="cs-cnav-icon-link" title="Messages">
          <svg class="cs-cnav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
          @if(($navCounts['messages_unread'] ?? 0) > 0)
            <span class="cs-cnav-badge cs-cnav-badge-accent">
              {{ ($navCounts['messages_unread'] ?? 0) > 99 ? '99+' : ($navCounts['messages_unread'] ?? 0) }}
            </span>
          @endif
        </a>

        {{-- Notifications --}}
        <a href="{{ route('notifications.index') }}" class="cs-cnav-icon-link">
          <svg class="cs-cnav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span id="customerNotificationBadge" class="cs-cnav-badge cs-cnav-badge-danger hidden"></span>
        </a>

        {{-- USER DROPDOWN --}}
        <div class="cs-cnav-user">
          <button id="customerUserDropdownButton" type="button"
                  class="cs-cnav-user-btn">
            <div class="cs-cnav-user-avatar">
              <svg class="cs-cnav-user-avatar-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
          </button>

          {{-- DROPDOWN PANEL --}}
          <div id="customerUserDropdownMenu" class="cs-cnav-dropdown hidden">
            
            <div class="cs-cnav-dropdown-head">
              <p class="cs-cnav-dropdown-label">Logged in as</p>
              <p class="cs-cnav-dropdown-name">{{ Auth::user()->name ?? 'Customer' }}</p>
            </div>

            <div class="cs-cnav-dropdown-body">
              <a href="{{ route('customer.profile') }}" class="cs-cnav-dropdown-link">
                <svg class="cs-cnav-dropdown-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                My Profile
              </a>



              <a href="{{ route('owner.earnings.dashboard') }}" class="cs-cnav-dropdown-link">
                <svg class="cs-cnav-dropdown-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Earnings
              </a>

              <div class="cs-cnav-dropdown-divider"></div>

              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="cs-cnav-dropdown-logout">
                  <svg class="cs-cnav-dropdown-link-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/></svg>
                  Sign Out
                </button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- MOBILE MENU --}}
  <div id="customerMobileMenu" class="cs-cnav-mobile-menu hidden">
    
    <a href="{{ route('dashboard.customer') }}" class="cs-cnav-mobile-link">Dashboard</a>
    <a href="{{ route('customer.vehicles') }}" class="cs-cnav-mobile-link">My Vehicles</a>
    <a href="{{ route('bookings.create') }}" class="cs-cnav-mobile-link">Book Service</a>
    <a href="{{ route('bookings.index') }}" class="cs-cnav-mobile-link">My Bookings</a>
    <a href="{{ route('customer.messages') }}" class="cs-cnav-mobile-link">Messages</a>
    <a href="{{ route('customer.rent-vehicles') }}" class="cs-cnav-mobile-link">Rent Vehicles</a>
    <a href="{{ route('customer.rentals') }}" class="cs-cnav-mobile-link">My Rentals</a>
    <a href="{{ route('customer.profile') }}" class="cs-cnav-mobile-link">Profile</a>
    
    <div class="cs-cnav-mobile-divider"></div>
    
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="cs-cnav-mobile-logout">Logout</button>
    </form>
  </div>
</nav>

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navRoot = document.getElementById('customerNav');
    const userDropdownButton = document.getElementById('customerUserDropdownButton');
    const userDropdownMenu = document.getElementById('customerUserDropdownMenu');
    const mobileMenuButton = document.getElementById('customerMobileMenuButton');
    const mobileMenu = document.getElementById('customerMobileMenu');

    const closeUserDropdown = () => userDropdownMenu?.classList.add('hidden');
    const closeMobileMenu = () => mobileMenu?.classList.add('hidden');

    userDropdownButton?.addEventListener('click', (event) => {
      event.stopPropagation();
      userDropdownMenu?.classList.toggle('hidden');
    });

    mobileMenuButton?.addEventListener('click', () => {
      mobileMenu?.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
      if (!navRoot?.contains(event.target)) {
        closeUserDropdown();
      }
    });

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') {
        closeUserDropdown();
        closeMobileMenu();
      }
    });

    const userId = @json((int) (Auth::id() ?? 0));
    const initialUnreadCount = @json((int) ($navCounts['notifications_unread'] ?? 0));
    const badge = document.getElementById('customerNotificationBadge');

    const setBadge = (count) => {
      if (!badge) {
        return;
      }

      const normalized = Number(count) || 0;
      if (normalized > 0) {
        badge.classList.remove('hidden');
        badge.textContent = normalized > 99 ? '99+' : String(normalized);
        return;
      }

      badge.classList.add('hidden');
      badge.textContent = '';
    };

    if (window.realtime && userId > 0) {
      window.realtime.subscribeUser(userId, {
        notification: (payload) => {
          setBadge(payload?.unread_count ?? 0);
        },
      });
    }

    setBadge(initialUnreadCount);
  });
</script>
@endpush

