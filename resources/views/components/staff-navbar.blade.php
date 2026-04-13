<nav class="sf-topnav">
  <div class="sf-topnav-container">
    <div class="sf-topnav-row">
      {{-- Logo / Brand --}}
      <div class="sf-topnav-brand-wrap">
        <a href="{{ route('dashboard.staff') }}" class="sf-topnav-brand-link">
          <svg class="sf-topnav-brand-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="sf-topnav-brand-title">
            Auto<span class="sf-topnav-brand-accent">Mate</span><span class="sf-topnav-brand-tag">Staff</span>
          </span>
        </a>
      </div>

      {{-- Desktop Navigation Menu --}}
      <div class="sf-topnav-menu">
        <a href="{{ route('dashboard.staff') }}" class="sf-topnav-link {{ request()->routeIs('dashboard.staff') ? 'sf-topnav-link-active' : '' }}">
            Dashboard
        </a>
        <a href="{{ route('staff.bookings') }}" class="sf-topnav-link {{ request()->routeIs('staff.bookings*') ? 'sf-topnav-link-active' : '' }}">
            Bookings
            @if(($navCounts['services_pending'] ?? 0) > 0)
              <span class="sf-topnav-pill">
                {{ ($navCounts['services_pending'] ?? 0) > 99 ? '99+' : ($navCounts['services_pending'] ?? 0) }}
              </span>
            @endif
        </a>
        <a href="{{ route('staff.rentals.index') }}" class="sf-topnav-link {{ request()->routeIs('staff.rentals*') ? 'sf-topnav-link-active' : '' }}">
            Rentals
            @if(($navCounts['rentals_pending'] ?? 0) > 0)
              <span class="sf-topnav-pill">
                {{ ($navCounts['rentals_pending'] ?? 0) > 99 ? '99+' : ($navCounts['rentals_pending'] ?? 0) }}
              </span>
            @endif
        </a>
        <a href="{{ route('staff.service.logs') }}" class="sf-topnav-link {{ request()->routeIs('staff.service.logs*') ? 'sf-topnav-link-active' : '' }}">
            Service Logs
        </a>
        <a href="{{ route('staff.inventory') }}" class="sf-topnav-link {{ request()->routeIs('staff.inventory*') ? 'sf-topnav-link-active' : '' }}">
            Inventory
            @if(($navCounts['inventory_low_stock'] ?? 0) > 0)
              <span class="sf-topnav-pill sf-topnav-pill-danger">
                {{ ($navCounts['inventory_low_stock'] ?? 0) > 99 ? '99+' : ($navCounts['inventory_low_stock'] ?? 0) }}
              </span>
            @endif
        </a>
        <a href="{{ route('staff.customers') }}" class="sf-topnav-link {{ request()->routeIs('staff.customers*') ? 'sf-topnav-link-active' : '' }}">
            Customers
            @if(($navCounts['messages_unread'] ?? 0) > 0)
              <span class="sf-topnav-pill">
                {{ ($navCounts['messages_unread'] ?? 0) > 99 ? '99+' : ($navCounts['messages_unread'] ?? 0) }}
              </span>
            @endif
        </a>
      </div>

      {{-- Right side menu (Profile & Logout) --}}
      <div class="sf-topnav-actions">
        <a href="{{ route('staff.profile') }}" class="sf-topnav-profile-link">
          <span class="sf-topnav-avatar">
              {{ substr(auth()->user()->name, 0, 1) }}
          </span>
        </a>

        <div class="sf-topnav-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="sf-topnav-logout" title="Logout">
            <svg class="sf-topnav-logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
          </button>
        </form>

        {{-- Mobile menu button --}}
        <button id="staffMobileMenuButton" class="sf-topnav-mobile-btn" type="button" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="staffMobileMenu">
          <svg class="sf-topnav-mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div id="staffMobileMenu" class="sf-topnav-mobile-menu sf-hidden">
    <a href="{{ route('dashboard.staff') }}" class="sf-topnav-mobile-link">Dashboard</a>
    <a href="{{ route('staff.bookings') }}" class="sf-topnav-mobile-link">Bookings</a>
    <a href="{{ route('staff.service.logs') }}" class="sf-topnav-mobile-link">Service Logs</a>
    <a href="{{ route('staff.inventory') }}" class="sf-topnav-mobile-link">Inventory</a>
    <a href="{{ route('staff.customers') }}" class="sf-topnav-mobile-link">Customers</a>
  </div>
</nav>

@once
  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        const navRoot = document.querySelector('.sf-topnav');
        const button = document.getElementById('staffMobileMenuButton');
        const menu = document.getElementById('staffMobileMenu');

        if (!button || !menu) {
          return;
        }

        const closeMenu = () => {
          menu.classList.add('sf-hidden');
          button.setAttribute('aria-expanded', 'false');
        };

        const toggleMenu = () => {
          const shouldOpen = menu.classList.contains('sf-hidden');
          menu.classList.toggle('sf-hidden', !shouldOpen);
          button.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
        };

        button.addEventListener('click', (event) => {
          event.preventDefault();
          event.stopPropagation();
          toggleMenu();
        });

        menu.querySelectorAll('a').forEach((link) => {
          link.addEventListener('click', () => {
            closeMenu();
          });
        });

        document.addEventListener('click', (event) => {
          if (!navRoot?.contains(event.target)) {
            closeMenu();
          }
        });

        document.addEventListener('keydown', (event) => {
          if (event.key === 'Escape') {
            closeMenu();
          }
        });
      });
    </script>
  @endpush
@endonce
