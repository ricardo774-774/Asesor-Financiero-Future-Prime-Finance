<nav x-data="{ open: false }" class="bg-blue-800 border-b border-blue-700 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b bg-blue-800 shadow min-w-full">
        <div class="flex justify-between h-16 p-5">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->

                <!-- DASHBOARD -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-blue-100 border-blue-300">
                        {{ __('Tablero') }}
                    </x-nav-link>
                </div>
                
                @can('gasto.index')
                    <!-- INGRESOS -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('ingreso.index')" :active="request()->routeIs('ingreso.index')" class="text-white hover:text-blue-100 border-blue-300">
                        {{ __('Mis Ingresos') }}
                    </x-nav-link>
                </div>

                <!-- GASTOS -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('gasto.index')" :active="request()->routeIs('gasto.index')" class="text-white hover:text-blue-100 border-blue-300">
                        {{ __('Mis Gastos') }}
                    </x-nav-link>
                </div>

                <!-- SALDO -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('saldo.index')" :active="request()->routeIs('saldo.index')" class="text-white hover:text-blue-100 border-blue-300">
                        {{ __('Mi Saldo') }}
                    </x-nav-link>
                </div>
                @endcan

                @can('categoriasg.index')
                    
                <!-- CATEGORIASG-->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')" class="text-white hover:text-blue-100 border-blue-300">
                        {{ __('Administrar Usuarios') }}
                    </x-nav-link>
                </div>

                @endcan

            </div>



            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:text-blue-100 hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-800 hover:bg-slate-50">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="text-gray-800 hover:bg-slate-50">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-100 hover:text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:bg-blue-600">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        
        @can('gasto.index')
        <!--INGRESOS RESPONSIVE-->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('ingreso.index')" :active="request()->routeIs('ingreso.index')" class="text-white hover:bg-blue-600">
                {{ __('Mis Ingresos') }}
            </x-responsive-nav-link>
        </div>

        <!--GASTOS RESPONSIVE-->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('gasto.index')" :active="request()->routeIs('gasto.index')" class="text-white hover:bg-blue-600">
                {{ __('Mis Gastos') }}
            </x-responsive-nav-link>
        </div>

        <!--SALDO RESPONSIVE-->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('saldo.index')" :active="request()->routeIs('saldo.index')" class="text-white hover:bg-blue-600">
                {{ __('Mi Saldo') }}
            </x-responsive-nav-link>
        </div>
            
        @endcan

        @can('categoriasg.index')
        <!--CATEGORIASG RESPONSIVE-->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')" class="text-white hover:bg-blue-600">
                {{ __('Administrar Usuarios') }}
            </x-responsive-nav-link>
        </div>

        @endcan

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-100">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-blue-600">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="text-white hover:bg-blue-600">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
