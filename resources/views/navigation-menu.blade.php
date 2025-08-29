<nav x-data="{ open: false }" class="navbar bg-base-100 shadow-lg">
    <div class="navbar-start">
        <!-- Hamburger -->
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </div>
            <!-- Responsive Menu -->
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-200 rounded-box w-52">
                <li><a href="{{ route('asistencias.index') }}" class="{{ request()->routeIs('asistencias.index') ? 'active' : '' }}">{{ __('Asistencia') }}</a></li>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a></li>
                @can('read users')
                    <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">{{ __('Usuarios') }}</a></li>
                @endcan
                <li><a href="{{ route('sucursales.index') }}" class="{{ request()->routeIs('sucursales.index') ? 'active' : '' }}">{{ __('Sucursales') }}</a></li>
                <li><a href="{{ route('tipos-membresia.index') }}" class="{{ request()->routeIs('tipos-membresia.index') ? 'active' : '' }}">{{ __('Tipos de Membresía') }}</a></li>
                <li><a href="{{ route('miembros.index') }}" class="{{ request()->routeIs('miembros.index') ? 'active' : '' }}">{{ __('Miembros') }}</a></li>
            </ul>
        </div>
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl normal-case">
            @if (isset($logo) && $logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ config('app.name') }}" class="block h-9 w-auto">
            @else
                <x-application-mark class="block h-9 w-auto" />
            @endif
            <span class="hidden sm:inline ms-2">{{ config('app.name') }}</span>
        </a>
    </div>

    <div class="navbar-center hidden sm:flex">
        <!-- Desktop Menu -->
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('asistencias.index') }}" class="{{ request()->routeIs('asistencias.index') ? 'active' : '' }}">{{ __('Asistencia') }}</a></li>
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">{{ __('Dashboard') }}</a></li>
            <li tabindex="0">
                <details>
                    <summary>Administración</summary>
                    <ul class="p-2 bg-base-100 rounded-t-none z-[1]">
                        @can('read users')
                            <li><a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">{{ __('Usuarios') }}</a></li>
                        @endcan
                        <li><a href="{{ route('sucursales.index') }}" class="{{ request()->routeIs('sucursales.index') ? 'active' : '' }}">{{ __('Sucursales') }}</a></li>
                        <li><a href="{{ route('tipos-membresia.index') }}" class="{{ request()->routeIs('tipos-membresia.index') ? 'active' : '' }}">{{ __('Tipos de Membresía') }}</a></li>
                        <li><a href="{{ route('miembros.index') }}" class="{{ request()->routeIs('miembros.index') ? 'active' : '' }}">{{ __('Miembros') }}</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>

    <div class="navbar-end">
        <!-- Light/Dark Toggle -->
        <x-light-dark-toggle />

        <!-- User Dropdown -->
        <div class="dropdown dropdown-end ml-3">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                @if (Auth::user()->profile_photo_path)
                    <div class="w-10 rounded-full"><img alt="{{ Auth::user()->name }}" src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" /></div>
                @else
                    <div class="w-10 rounded-full bg-neutral text-neutral-content flex items-center justify-center"><span>{{ substr(Auth::user()->name, 0, 1) }}</span></div>
                @endif
            </div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52">
                <li class="menu-title"><span>{{ Auth::user()->name }}</span></li>
                <li><a href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                @can('manage settings')
                    <li><a href="{{ route('settings.index') }}">{{ __('Settings') }}</a></li>
                @endcan
                <div class="divider my-1"></div>
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
