<nav x-data="{ open: false }" class="navbar bg-base-100 shadow-lg">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><x-responsive-nav-link href="{{ route('asistencias.index') }}" :active="request()->routeIs('asistencias.index')">{{ __('Asistencia') }}</x-responsive-nav-link></li>
                <li><x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-responsive-nav-link></li>
                @can('read users')
                    <li><x-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">{{ __('Usuarios') }}</x-responsive-nav-link></li>
                @endcan
                <li><x-responsive-nav-link href="{{ route('sucursales.index') }}" :active="request()->routeIs('sucursales.index')">{{ __('Sucursales') }}</x-responsive-nav-link></li>
                <li><x-responsive-nav-link href="{{ route('tipos-membresia.index') }}" :active="request()->routeIs('tipos-membresia.index')">{{ __('Tipos de Membresía') }}</x-responsive-nav-link></li>
                <li><x-responsive-nav-link href="{{ route('miembros.index') }}" :active="request()->routeIs('miembros.index')">{{ __('Miembros') }}</x-responsive-nav-link></li>
            </ul>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-ghost text-xl">
            @if (isset($logo) && $logo)
                <img src="{{ asset('storage/' . $logo) }}" alt="{{ config('app.name', 'Laravel') }}" class="block h-9 w-auto">
            @else
                <x-application-mark class="block h-9 w-auto" />
            @endif
            <span class="hidden sm:inline ms-2">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <div class="hidden sm:flex ml-4">
            <ul class="menu menu-horizontal px-1">
                <li><x-nav-link href="{{ route('asistencias.index') }}" :active="request()->routeIs('asistencias.index')">{{ __('Asistencia') }}</x-nav-link></li>
                <li><x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">{{ __('Dashboard') }}</x-nav-link></li>
                @can('read users')
                    <li><x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">{{ __('Usuarios') }}</x-nav-link></li>
                @endcan
                <li><x-nav-link href="{{ route('sucursales.index') }}" :active="request()->routeIs('sucursales.index')">{{ __('Sucursales') }}</x-nav-link></li>
                <li><x-nav-link href="{{ route('tipos-membresia.index') }}" :active="request()->routeIs('tipos-membresia.index')">{{ __('Tipos de Membresía') }}</x-nav-link></li>
                <li><x-nav-link href="{{ route('miembros.index') }}" :active="request()->routeIs('miembros.index')">{{ __('Miembros') }}</x-nav-link></li>
            </ul>
        </div>
    </div>

    <div class="navbar-end">
        <x-theme-switcher />

        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="dropdown dropdown-end ml-3">
                <div tabindex="0" role="button" class="btn btn-ghost">
                    <div>{{ Auth::user()->currentTeam->name }}</div>
                    <svg class="ms-2 -me-0.5 size-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" /></svg>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-300 rounded-box w-60">
                    <li class="menu-title"><span>{{ __('Manage Team') }}</span></li>
                    <li><a href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">{{ __('Team Settings') }}</a></li>
                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <li><a href="{{ route('teams.create') }}">{{ __('Create New Team') }}</a></li>
                    @endcan
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="divider my-1"></div>
                        <li class="menu-title"><span>{{ __('Switch Teams') }}</span></li>
                        @foreach (Auth::user()->allTeams() as $team)
                            <li><x-switchable-team :team="$team" /></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        @endif

        <div class="dropdown dropdown-end ml-3">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="w-10 rounded-full">
                        <img alt="{{ Auth::user()->name }}" src="{{ Auth::user()->profile_photo_url }}" />
                    </div>
                @else
                    <div class="w-10 rounded-full bg-primary text-primary-content flex items-center justify-center">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-300 rounded-box w-52">
                <li class="menu-title"><span>{{ __('Manage Account') }}</span></li>
                <li><a href="{{ route('profile.show') }}">{{ __('Profile') }}</a></li>
                @can('manage settings')
                    <li><a href="{{ route('settings.index') }}">{{ __('Settings') }}</a></li>
                @endcan
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <li><a href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</a></li>
                @endif
                <div class="divider my-1"></div>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <li><a href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</a></li>
                </form>
            </ul>
        </div>
    </div>
</nav>
