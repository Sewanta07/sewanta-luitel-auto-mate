<nav class="ad-topnav">
  <div class="ad-topnav-container">
    <div class="ad-topnav-row">
      {{-- Logo / Brand --}}
      <div class="ad-topnav-brand-wrap">
        <a href="{{ route('dashboard.admin') }}" class="ad-topnav-brand-link">
          <svg class="ad-topnav-brand-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="ad-topnav-brand-title">
            Auto<span class="ad-topnav-brand-accent">Mate</span><span class="ad-topnav-brand-tag">Admin</span>
          </span>
        </a>
      </div>

      {{-- Desktop Navigation Menu --}}
      <div class="ad-topnav-menu">
        <a href="{{ route('dashboard.admin') }}" class="ad-topnav-link {{ request()->routeIs('dashboard.admin') ? 'ad-topnav-link-active' : '' }}">
            Overview
        </a>
        <a href="{{ route('admin.users') }}" class="ad-topnav-link {{ request()->routeIs('admin.users*') ? 'ad-topnav-link-active' : '' }}">
            Users
        </a>
        <a href="{{ route('admin.staff-applications.index') }}" class="ad-topnav-link {{ request()->routeIs('admin.staff-applications*') ? 'ad-topnav-link-active' : '' }}">
            Applications
        </a>
        <a href="{{ route('admin.analytics') }}" class="ad-topnav-link {{ request()->routeIs('admin.analytics') ? 'ad-topnav-link-active' : '' }}">
            Analytics
        </a>
      </div>

      {{-- Right side menu (Profile & Logout) --}}
        <div class="ad-topnav-actions">
        <div class="ad-topnav-divider"></div>

        <div class="ad-topnav-user">
          <span class="ad-topnav-user-name">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
          <button type="submit" class="ad-topnav-logout" title="Logout">
            <svg class="ad-topnav-logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </button>
            </form>
        </div>

        {{-- Mobile menu button --}}
        <button class="ad-topnav-mobile-btn" type="button" aria-label="Toggle mobile menu">
          <svg class="ad-topnav-mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div class="ad-topnav-mobile-menu ad-hidden">
    <a href="{{ route('dashboard.admin') }}" class="ad-topnav-mobile-link">Overview</a>
    <a href="{{ route('admin.users') }}" class="ad-topnav-mobile-link">Users</a>
    <a href="{{ route('admin.staff-applications.index') }}" class="ad-topnav-mobile-link">Applications</a>
    <a href="{{ route('admin.analytics') }}" class="ad-topnav-mobile-link">Analytics</a>
  </div>
</nav>
