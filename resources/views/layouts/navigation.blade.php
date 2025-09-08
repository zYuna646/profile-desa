<nav x-data="{ open: false }" class="bg-jordy-blue-50 border-b border-jordy-blue-200 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-jordy-blue-900" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:ms-auto space-x-4">
                @foreach(config('navigation.main_menu') as $menu)
                    @if(isset($menu['external_url']))
                        <a 
                            href="{{ $menu['external_url'] }}" 
                            target="_blank"
                            class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100"
                        >
                            <div class="flex items-center">
                                <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @elseif(isset($menu['href']))
                        <a 
                            href="{{ $menu['href'] }}" 
                            class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100 {{ request()->url() == $menu['href'] ? 'bg-jordy-blue-100' : '' }}"
                        >
                            <div class="flex items-center">
                                <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @elseif(isset($menu['route']))
                        <x-nav-link 
                            :href="route($menu['route'])" 
                            :active="request()->routeIs($menu['route'])"
                            class="group relative px-3 py-2 rounded-md transition-all duration-300 hover:bg-jordy-blue-100"
                        >
                            <div class="flex items-center">
                                <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-jordy-blue-800 group-hover:text-jordy-blue-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-jordy-blue-500 group-hover:w-full transition-all duration-300"></div>
                        </x-nav-link>
                    @endif
                @endforeach

                <!-- Settings Dropdown -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-jordy-blue-900 bg-jordy-blue-200 hover:bg-jordy-blue-300 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-jordy-blue-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.dashboard')" class="hover:bg-jordy-blue-100">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>

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
                @else
                    <a href="{{ route('login') }}" class="text-sm text-white bg-jordy-blue-400 hover:bg-jordy-blue-500 px-4 py-2 rounded-md transition shadow-md">
                        {{ __('Login') }}
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
            @foreach(config('navigation.main_menu') as $menu)
                @if(isset($menu['external_url']))
                    <a href="{{ $menu['external_url'] }}" target="_blank" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-jordy-blue-700 hover:text-jordy-blue-900 hover:bg-jordy-blue-100 hover:border-jordy-blue-300 focus:outline-none focus:text-jordy-blue-900 focus:bg-jordy-blue-100 focus:border-jordy-blue-300 transition duration-150 ease-in-out">
                        <div class="flex items-center">
                            {!! $menu['icon'] !!}
                            <span class="ml-2">{{ $menu['name'] }}</span>
                        </div>
                    </a>
                @elseif(isset($menu['href']))
                    <a href="{{ $menu['href'] }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->url() == $menu['href'] ? 'border-jordy-blue-400 text-jordy-blue-900 bg-jordy-blue-100' : 'border-transparent text-jordy-blue-700 hover:text-jordy-blue-900 hover:bg-jordy-blue-100 hover:border-jordy-blue-300' }} text-base font-medium focus:outline-none focus:text-jordy-blue-900 focus:bg-jordy-blue-100 focus:border-jordy-blue-300 transition duration-150 ease-in-out">
                        <div class="flex items-center">
                            {!! $menu['icon'] !!}
                            <span class="ml-2">{{ $menu['name'] }}</span>
                        </div>
                    </a>
                @elseif(isset($menu['route']))
                    <x-responsive-nav-link :href="route($menu['route'])" :active="request()->routeIs($menu['route'])">
                        <div class="flex items-center">
                            {!! $menu['icon'] !!}
                            <span class="ml-2">{{ $menu['name'] }}</span>
                        </div>
                    </x-responsive-nav-link>
                @endif
            @endforeach
            
            <!-- Custom Navigation Menu for Mobile -->
            @if(count(config('navigation.custom_menu', [])) > 0)
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-sm text-gray-500">Menu Kustom</div>
                    </div>
                    
                    <div class="mt-3 space-y-1">
                        @foreach(config('navigation.custom_menu') as $menu)
                            @if(isset($menu['external_url']))
                                <a href="{{ $menu['external_url'] }}" target="_blank" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        {!! $menu['icon'] !!}
                                        <span class="ml-2">{{ $menu['name'] }}</span>
                                    </div>
                                </a>
                            @elseif(isset($menu['href']))
                                <a href="{{ $menu['href'] }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->url() == $menu['href'] ? 'border-gray-400 text-gray-800 bg-gray-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-sm font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        {!! $menu['icon'] !!}
                                        <span class="ml-2">{{ $menu['name'] }}</span>
                                    </div>
                                </a>
                            @elseif(isset($menu['route']))
                                <a href="{{ route($menu['route']) }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs($menu['route']) ? 'border-gray-400 text-gray-800 bg-gray-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-sm font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div class="flex items-center">
                                        {!! $menu['icon'] !!}
                                        <span class="ml-2">{{ $menu['name'] }}</span>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-jordy-blue-200">
                <div class="px-4">
                    <div class="font-medium text-base text-jordy-blue-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-jordy-blue-700">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')">
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
        @else
            <div class="pt-4 pb-1 border-t border-jordy-blue-200">
                <div class="px-4 space-y-1">
                    <x-responsive-nav-link :href="route('login')" class="bg-jordy-blue-500 text-white">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endauth
    </div>
</nav>

<!-- Secondary Navigation Menu -->
@if(count(config('navigation.custom_menu', [])) > 0)
<div class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center h-10">
            <!-- Custom Navigation Links -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                @foreach(config('navigation.custom_menu') as $menu)
                    @if(isset($menu['children']) && count($menu['children']) > 0)
                        <div class="relative group" x-data="{ open: false }">
                            <button 
                                @click="open = !open" 
                                @click.away="open = false"
                                class="group relative px-2 py-1 text-sm rounded-md transition-all duration-300 hover:bg-gray-100 flex items-center"
                            >
                                <div class="mr-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-gray-600 group-hover:text-gray-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                                <svg class="ml-1 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></div>
                            </button>
                            <div 
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                style="display: none;"
                            >
                                <div class="py-1">
                                    @foreach($menu['children'] as $child)
                                        @if(isset($child['external_url']))
                                            <a href="{{ $child['external_url'] }}" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                <div class="flex items-center">
                                                    <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                                        {!! $child['icon'] !!}
                                                    </div>
                                                    <span>{{ $child['name'] }}</span>
                                                </div>
                                            </a>
                                        @elseif(isset($child['href']))
                                            <a href="{{ $child['href'] }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ request()->url() == $child['href'] ? 'bg-gray-100' : '' }}">
                                                <div class="flex items-center">
                                                    <div class="mr-2 opacity-70 group-hover:opacity-100 transition-opacity">
                                                        {!! $child['icon'] !!}
                                                    </div>
                                                    <span>{{ $child['name'] }}</span>
                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @elseif(isset($menu['external_url']))
                        <a 
                            href="{{ $menu['external_url'] }}" 
                            target="_blank"
                            class="group relative px-2 py-1 text-sm rounded-md transition-all duration-300 hover:bg-gray-100"
                        >
                            <div class="flex items-center">
                                <div class="mr-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-gray-600 group-hover:text-gray-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @elseif(isset($menu['href']))
                        <a 
                            href="{{ $menu['href'] }}" 
                            class="group relative px-2 py-1 text-sm rounded-md transition-all duration-300 hover:bg-gray-100 {{ request()->url() == $menu['href'] ? 'bg-gray-100' : '' }}"
                        >
                            <div class="flex items-center">
                                <div class="mr-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-gray-600 group-hover:text-gray-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @elseif(isset($menu['route']))
                        <a 
                            href="{{ route($menu['route']) }}" 
                            class="group relative px-2 py-1 text-sm rounded-md transition-all duration-300 hover:bg-gray-100 {{ request()->routeIs($menu['route']) ? 'bg-gray-100' : '' }}"
                        >
                            <div class="flex items-center">
                                <div class="mr-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                    {!! $menu['icon'] !!}
                                </div>
                                <span class="text-gray-600 group-hover:text-gray-900 transition-colors">
                                    {{ $menu['name'] }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gray-500 group-hover:w-full transition-all duration-300"></div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
