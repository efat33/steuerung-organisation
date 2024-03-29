@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/GEZE_Logo_130.png" class="navbar-brand-img h-100" alt="main_logo">
            <!-- <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> -->
            <!-- <span class="ms-2 font-weight-bold text-white">Steuerung Organisation</span> -->
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if (auth()->user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard.success') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('users.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem; padding-left: 3px;" class="fas fa-lg fa-list-ul text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'technical-offer' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('technical.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem; padding-left: 3px;" class="fas fa-lg fa-list-ul text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Technische Angebote /<br>Aufträge</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'maintenance-offer' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('maintenance.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem; padding-left: 3px;" class="fas fa-lg fa-list-ul text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Wartungsangebote /<br>aufträge</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'search-technical-offer' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('technical.search') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons">search</span>
                    </div>
                    <span class="nav-link-text ms-1">Suche Technische<br>Angebote</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'search-maintenance-offer' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('maintenance.search') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons">search</span>
                    </div>
                    <span class="nav-link-text ms-1">Suche Wartungsangebote</span>
                </a>
            </li>
            <li class="nav-item show-on-mobile">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('profile.edit') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <span class="material-icons">person</span>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item show-on-mobile logout-on-mobile">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Sign Out') }}
                    </x-dropdown-link>
                </form>
            </li>    
        </ul>
    </div>
</aside>