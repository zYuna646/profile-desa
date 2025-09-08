<nav x-data="{ open: false }" class="bg-jordy-blue-50 border-b border-jordy-blue-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('admin.dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-jordy-blue-900" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @foreach(config('admin-navigation.admin_menu') as $menu)
                        @if(isset($menu['submenu']))
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" @click.away="open = false" class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100 flex items-center">
                                    <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                        {!! $menu['icon'] !!}
                                    </div>
                                    <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                        {{ $menu['name'] }}
                                    </span>
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-400 group-hover:w-full transition-all duration-300"></div>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" style="display: none;">
                                    <div class="py-1">
                                        @foreach($menu['submenu'] as $submenu)
                                            <a href="{{ route($submenu['route']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-jordy-blue-100 flex items-center">
                                                <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                                    {!! $submenu['icon'] !!}
                                                </div>
                                                <span>{{ $submenu['name'] }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <x-nav-link 
                                :href="route($menu['route'])" 
                                :active="request()->routeIs($menu['route'])"
                                class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100 flex items-center"
                            >
                                <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-400 group-hover:w-full transition-all duration-300"></div>
                            </x-nav-link>
                        @endif
                    @endforeach
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100 flex items-center">
                        <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                            {{ __('Halaman Utama') }}
                        </span>
                        <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-jordy-blue-900 bg-jordy-blue-200 hover:bg-jordy-blue-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4 text-jordy-blue-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-jordy-blue-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="hover:bg-jordy-blue-100">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-jordy-blue-700 hover:text-jordy-blue-900 hover:bg-jordy-blue-200 focus:outline-none focus:bg-jordy-blue-200 focus:text-jordy-blue-900 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
                @foreach(config('admin-navigation.admin_menu') as $menu)
                    @if(isset($menu['submenu']))
                        <div x-data="{ open: false }" class="space-y-1">
                            <button @click="open = !open" class="flex items-center w-full px-3 py-2 text-base font-medium rounded-md transition-all duration-300 hover:bg-jordy-blue-100">
                                <div class="mr-3 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                                <svg class="ml-auto w-4 h-4" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" class="pl-4 space-y-1" style="display: none;">
                                @foreach($menu['submenu'] as $submenu)
                                    <a href="{{ route($submenu['route']) }}" class="flex items-center px-3 py-2 text-base font-medium rounded-md transition-all duration-300 hover:bg-jordy-blue-100">
                                        <div class="mr-3 opacity-70 group-hover:opacity-100 transition-opacity">
                                            {!! $submenu['icon'] !!}
                                        </div>
                                        <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                            {{ $submenu['name'] }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <x-responsive-nav-link 
                            :href="route($menu['route'])" 
                            :active="request()->routeIs($menu['route'])"
                            class="flex items-center px-3 py-2 text-base font-medium rounded-md transition-all duration-300 hover:bg-jordy-blue-100"
                        >
                            <div class="mr-3 opacity-70 group-hover:opacity-100 transition-opacity">
                                {!! $menu['icon'] !!}
                            </div>
                            <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                {{ $menu['name'] }}
                            </span>
                        </x-responsive-nav-link>
                    @endif
                @endforeach
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                <div class="flex items-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="ml-2">{{ __('Halaman Utama') }}</span>
                </div>
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-jordy-blue-200">
            <div class="px-4">
                <div class="font-medium text-base text-jordy-blue-900">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-jordy-blue-700">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>