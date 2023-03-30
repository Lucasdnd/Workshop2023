<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
    @include('adminlte::partials.common.brand-logo-xl')
    @else
    @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}" data-widget="treeview" role="menu" @if(config('adminlte.sidebar_nav_animation_speed') !=300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif @if(!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
<<<<<<< HEAD
=======
                <li class="nav-item">
                    <a href="{{ route('contact.leads') }}" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.prospects') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>Prospects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.clients') }}" class="nav-link">
                        <i class="fas fa-user-check"></i>
                        <p>Clients</p>
                    </a>
                </li>
            </ul>
            <hr class="mt-0">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-users-cog"></i>
                        <p>Gestion des utilisateurs</p>
                    </a>
                </li>
>>>>>>> 781521a67b13ca5c5120099eb8025a7fa6b6431a
            </ul>
        </nav>
    </div>
</aside>