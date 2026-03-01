<div class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 h-full fixed left-0 top-0 z-30">
    {{-- Brand --}}
    <div class="flex items-center justify-center h-16 border-b border-gray-100">
        <a href="{{ route('dashboard.admin') }}" class="flex items-center gap-2">
            <span class="text-2xl font-bold tracking-tight text-[#ff5a1f]">AutoMate</span>
            <span class="px-2 py-0.5 rounded text-xs font-bold bg-gray-900 text-white uppercase tracking-wider">Admin</span>
        </a>
    </div>

    {{-- Navigation --}}
    <div class="flex-1 overflow-y-auto py-6 flex flex-col justify-between">
        <nav class="space-y-1 px-4">
            {{-- Dashboard --}}
            <a href="{{ route('dashboard.admin') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('dashboard.admin') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('dashboard.admin') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </a>

            {{-- Users --}}
            <a href="{{ route('admin.users') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.users*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.users*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manage Users
            </a>

            {{-- Applications --}}
            <a href="{{ route('admin.staff-applications.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.staff-applications*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.staff-applications*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Staff Applications
            </a>

            {{-- Analytics --}}
            <a href="{{ route('admin.analytics') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.analytics*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.analytics*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Analytics
            </a>

            {{-- Transactions --}}
            <a href="{{ route('admin.transactions') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.transactions*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.transactions*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Transactions
            </a>

            {{-- Contact Messages --}}
            <a href="{{ route('admin.contact-messages.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.contact-messages*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.contact-messages*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Messages
                @if(($navCounts['contact_new'] ?? 0) > 0)
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full">
                        {{ $navCounts['contact_new'] }}
                    </span>
                @endif
            </a>

            {{-- NEW: Service Management --}}
            <a href="{{ route('admin.services') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.services*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.services*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Services
                @if(($navCounts['services_pending'] ?? 0) > 0)
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full">
                        {{ $navCounts['services_pending'] }}
                    </span>
                @endif
            </a>

            {{-- NEW: Rental Management --}}
            <a href="{{ route('admin.rentals.dashboard') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.rentals*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.rentals*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rentals
                @if(($navCounts['rentals_pending'] ?? 0) > 0)
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full">
                        {{ $navCounts['rentals_pending'] }}
                    </span>
                @endif
            </a>

            {{-- Inventory --}}
            <a href="{{ route('admin.inventory.index') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.inventory*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.inventory*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventory
                @if(($navCounts['inventory_low_stock'] ?? 0) > 0)
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                        {{ $navCounts['inventory_low_stock'] }}
                    </span>
                @endif
            </a>

            {{-- Messages Monitoring --}}
            <a href="{{ route('admin.messages') }}" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition {{ request()->routeIs('admin.messages*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.messages*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500' }} transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Messages
                <span id="adminMessagesUnreadBadge" class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full {{ (int) ($navCounts['messages_unread'] ?? 0) > 0 ? '' : 'hidden' }}">
                    {{ (int) ($navCounts['messages_unread'] ?? 0) > 99 ? '99+' : (int) ($navCounts['messages_unread'] ?? 0) }}
                </span>
            </a>
        </nav>

        {{-- Bottom --}}
        <div class="p-4 border-t border-gray-100">
            <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition w-full">
                <div class="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-xs ring-2 ring-gray-100">
                    A
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name ?? 'Administrator' }}</p>
                    <p class="text-xs text-gray-500 truncate">View Profile</p>
                </div>
            </a>
            
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Mobile Sidebar Overlay (Placeholder) --}}
{{-- In a real app, this would use Alpine.js or JS for toggling --}}

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const badge = document.getElementById('adminMessagesUnreadBadge');
                let unreadCount = @json((int) ($navCounts['messages_unread'] ?? 0));

                const setBadge = (count) => {
                    unreadCount = Math.max(0, Number(count) || 0);

                    if (!badge) {
                        return;
                    }

                    if (unreadCount > 0) {
                        badge.classList.remove('hidden');
                        badge.textContent = unreadCount > 99 ? '99+' : String(unreadCount);
                        return;
                    }

                    badge.classList.add('hidden');
                    badge.textContent = '';
                };

                if (window.realtime) {
                    window.realtime.subscribeDashboard('admin', null, {
                        chatMessage: (payload) => {
                            if (!payload) {
                                return;
                            }

                            if (payload.is_read === false || payload.is_read === 0) {
                                setBadge(unreadCount + 1);
                            }
                        },
                        chatRead: (payload) => {
                            const readCount = Array.isArray(payload?.message_ids) ? payload.message_ids.length : 0;
                            if (readCount > 0) {
                                setBadge(unreadCount - readCount);
                            }
                        },
                    });
                }

                setBadge(unreadCount);
            });
        </script>
    @endpush
@endonce
