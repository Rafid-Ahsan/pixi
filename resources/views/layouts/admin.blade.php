<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">

            {{-- @if (Route::currentRouteName() == 'admin.index' || Route::currentRouteName() == 'home')

            @else
                @livewire('navigation-menu')
            @endif --}}


            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>

          <div>
              <nav class="bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                      <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow">
                      </div>
                      <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                          <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                          <a href="{{ route('admin.index') }}" class="{{ Route::currentRouteName() == "admin.index" ? ' bg-gray-900' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>

                          <a href="{{ route('admin.team.index') }}" class="{{ Route::currentRouteName() == "admin.team.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Team</a>

                          <a href="{{ route('admin.images.index') }}" class="{{ Route::currentRouteName() == "admin.images.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Images</a>

                          <a href="{{ route('admin.contest.index') }}" class="{{ Route::currentRouteName() == "admin.contest.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Contest
                            @if ($not_approved_contest_value > 0)
                            <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ $not_approved_contest_value }}</span>
                            @endif
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="hidden md:block">
                      <div class="ml-4 flex items-center md:ml-6">
                        <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                          <span class="sr-only">View notifications</span>
                          <!-- Heroicon name: outline/bell -->
                          <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                          </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                          {{ __('Profile') }}
                      </x-jet-responsive-nav-link>
                      </div>
                    </div>
                    <div class="-mr-2 flex md:hidden">
                      <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>

                <div class="md:hidden" id="mobile-menu">
                  <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="{{ route('admin.index') }}" class="{{ Route::currentRouteName() == "admin.index" ? ' bg-gray-900' : '' }} text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>

                          <a href="{{ route('admin.team.index') }}" class="{{ Route::currentRouteName() == "admin.team.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Team</a>

                          <a href="{{ route('admin.images.index') }}" class="{{ Route::currentRouteName() == "admin.images.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Images</a>

                          <a href="{{ route('admin.contest.index') }}" class="{{ Route::currentRouteName() == "admin.contest.index" ? ' bg-gray-900' : '' }} text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Contest</a>
                  </div>
                  <div class="pt-4 pb-3 border-t border-gray-700">
                    <div class="flex items-center px-5">
                      <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                      </div>
                      <div class="ml-3">
                        <div class="text-base font-medium leading-none text-white">Tom Cook</div>
                        <div class="text-sm font-medium leading-none text-gray-400">tom@example.com</div>
                      </div>
                      <button class="ml-auto bg-gray-800 flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                      </button>
                    </div>
                    <div class="mt-3 px-2 space-y-1">
                      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Your Profile</a>

                      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Settings</a>

                      <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700">Sign out</a>
                    </div>
                  </div>
                </div>
              </nav>

              <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                  <h1 class="text-3xl font-bold text-gray-900">
                    Dashboard
                  </h1>
                </div>
              </header>
              <main>
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                  @yield('content')
                </div>
              </main>
          </main>
            </div>

                  </div>

        @stack('modals')

        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
        <script src="{{ asset('js/custom/dropdown.js') }}"></script>
        @livewireScripts
    </body>
</html>
