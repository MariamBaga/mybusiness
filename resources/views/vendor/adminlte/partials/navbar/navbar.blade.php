@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

<nav class="main-header navbar
    {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">

        @yield('content_top_nav_right')

        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- 🔔 Notifications --}}
        @auth
        <li class="nav-item dropdown" id="notifications-dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span id="notif-count" class="badge badge-warning navbar-badge">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <span class="dropdown-header">
                    <span id="notif-header-count">{{ auth()->user()->unreadNotifications->count() }}</span>
                    Notifications
                </span>

                <div class="dropdown-divider"></div>

                <div id="notif-list" style="max-height:260px; overflow-y:auto;">
                    @forelse(auth()->user()->unreadNotifications as $notif)
                        @php
                            $url = $notif->data['url'] ?? '#';
                            $message = $notif->data['message'] ?? 'Nouvelle notification';
                        @endphp

                        <a href="{{ $url }}"
                           class="dropdown-item"
                           onclick="event.preventDefault(); document.getElementById('notif-{{ $notif->id }}').submit();">
                            <i class="fas fa-info-circle mr-2"></i> {{ $message }}
                            <span class="float-right text-muted text-sm">{{ $notif->created_at->diffForHumans() }}</span>
                        </a>

                        <form id="notif-{{ $notif->id }}" action="{{ route('notifications.read', $notif->id) }}" method="POST" style="display:none;">
                            @csrf
                        </form>

                        <div class="dropdown-divider"></div>
                    @empty
                        <p class="dropdown-item text-center text-muted">Aucune notification</p>
                    @endforelse
                </div>

                <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">
                    Voir toutes les notifications
                </a>
            </div>
        </li>
        @endauth

        {{-- User menu --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        @if($layoutHelper->isRightSidebarEnabled())
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
