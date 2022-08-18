<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <title>{{ config('app.name', 'Zaid Corp') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @livewireStyles



    <!-- Scripts sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
    <!-- end sweetalert2-->

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>


    <script src="https://kit.fontawesome.com/d28e5f8122.js" crossorigin="anonymous"></script>

</head>

<body class="font-sans">
    <!-- component -->
    <div class="md:flex flex-col md:flex-row md:min-h-screen w-full">
        <div @click.away="open = false"
            class="flex flex-col w-full md:w-64 text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-primary-800 flex-shrink-0"
            x-data="{ open: false }">
            <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">

                <a href="{{ route('dashboard') }}"
                    class="text-2xl font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-heartbeat"></i> Zaid Corp.</a>


                <a class="rounded-lg md:hidden focus:outline-none focus:shadow-outline cursor-pointer"
                    @click="open = !open">

                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">

                        <path x-show="!open" fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>

                        <path x-show="open" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
            <nav :class="{ 'block': open, 'hidden': !open }"
                class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

                {{-- ususarios --}}
                <x-a-sidenav href="{{ route('user.dashboard') }}" :active="request()->routeIs('user.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-address-card"></i> {{ ' Usuarios' }}
                </x-a-sidenav>
                {{-- tipos --}}
                <x-a-sidenav href="{{ route('type.dashboard') }}" :active="request()->routeIs('type.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-user-tag"></i> {{ ' Tipos de clientes' }}
                </x-a-sidenav>
                {{-- cliente --}}
                <x-a-sidenav href="{{ route('client.dashboard') }}" :active="request()->routeIs('client.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-address-book"></i> {{ ' Clientes' }}
                </x-a-sidenav>
                {{-- vendedor --}}
                <x-a-sidenav href="{{ route('seller.dashboard') }}" :active="request()->routeIs('seller.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-user-tie"></i> {{ ' Vendedores' }}
                </x-a-sidenav>
                {{-- ciudad --}}
                <x-a-sidenav href="{{ route('city.dashboard') }}" :active="request()->routeIs('city.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-map-marker"></i> {{ ' Ciudades' }}
                </x-a-sidenav>
                {{-- meta --}}
                <x-a-sidenav href="{{ route('goal.dashboard') }}" :active="request()->routeIs('goal.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-calendar-check"></i> {{ ' Metas' }}
                </x-a-sidenav>
                {{-- ruta --}}
                <x-a-sidenav href="{{ route('route.dashboard') }}" :active="request()->routeIs('route.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-map"></i> {{ ' Rutas' }}
                </x-a-sidenav>
                {{-- detallevendedor --}}
                <x-a-sidenav href="{{ route('detailseller.dashboard') }}" :active="request()->routeIs('detailseller.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-route"></i>{{ ' Asignacion de rutas' }}
                </x-a-sidenav>
                {{-- productos --}}
                <x-a-sidenav href="{{ route('product.dashboard') }}" :active="request()->routeIs('product.dashboard')"
                    class="text-l font-semibold tracking-widest text-primary-500 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">
                    <i class="fas fa-shopping-bag"></i> {{ 'Productos' }}
                </x-a-sidenav>
                {{-- nota --}}
                <x-a-sidenav href="{{ route('note.dashboard') }}" :active="request()->routeIs('note.dashboard')">
                    <i class="fas fa-people-carry"></i> Notas
                </x-a-sidenav>
                {{-- lote --}}
                <x-a-sidenav href="{{ route('batch.dashboard') }}" :active="request()->routeIs('batch.dashboard') ||
                    request()->routeIs('batch.create') ||
                    request()->routeIs('batch.update')">
                    <i class="fas fa-users-cog"></i> Lotes
                </x-a-sidenav>

                <hr class=" my-2">

                {{-- profile options --}}
                <div @click.away="open = false" class="relative z-30" x-data="{ open: false }">
                    <a @click="open = !open"
                        class="flex flex-row items-center content-between w-full px-4 py-2 mt-2 text-gray-500  text-sm font-semibold text-left bg-transparent rounded-full dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-primary-600 dark-mode:hover:bg-primary-600 md:block hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 ">
                        <div class="w-full flex justify-between ">
                            <div class="flex space-x-2 ">

                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <div
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                            src="{{ Auth::user()->profile_photo_url }}"
                                            alt="{{ Auth::user()->name }}" />
                                    </div>
                                    <div class="flex h-full justify-center items-center ">
                                        <span class="inline-block align-middle">{{ Auth::user()->name }}</span>
                                    </div>
                                @else
                                    <div
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                        <svg class="h-8 w-8 rounded-full" xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex h-full justify-center items-center ">
                                        <span class="inline-block align-middle">{{ Auth::user()->name }}</span>
                                    </div>
                                @endif

                            </div>
                            <div class="flex space-x-2 ">
                                <div class="flex h-full justify-center items-center">
                                    <svg fill="currentColor" viewBox="0 0 20 20"
                                        :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                        class="w-6 h-6 transition-transform duration-200 transform">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>

                        </div>
                    </a>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-primary-800">

                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                href="{{ route('profile.show') }}">{{ __('menu.profile') }}</a>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                    href="{{ route('api-tokens.index') }}">API Tokens</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                this.closest('form').submit();"
                                    class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                    href="login">
                                    Cerrar sesión </a>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- end profile options --}}





                {{-- <div @click.away="open = false" class="relative " x-data="{ open: false }">
                    <a @click="open = !open"
                        class="flex flex-row items-center content-between w-full px-4 py-2 mt-2 text-gray-500  text-sm font-semibold text-left bg-transparent rounded-full dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-primary-600 dark-mode:hover:bg-primary-600 md:block hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 ">
                        <div class="w-full flex justify-between ">
                            <span>Opción 5</span>
                            <svg fill="currentColor" viewBox="0 0 20 20"
                                :class="{'rotate-180': open, 'rotate-0': !open}"
                                class="w-4 h-4 transition-transform duration-200 transform">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </a>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-primary-800">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                href="#">Opción 5.1</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                href="#">Opción 5.2</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-full dark-mode:bg-transparent dark-mode:hover:bg-primary-600 dark-mode:focus:bg-primary-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-primary-500 focus:text-primary-500 hover:bg-primary-200 "
                                href="#">Opción 5.3</a>
                        </div>
                    </div>
                </div> --}}

            </nav>
        </div>



        {{-- content dashboard --}}
        <div class="bg-gray-200 w-full min-h-screen">

            {{-- header content --}}
            <div class="w-full px-4 sm:px-6 lg:px-8 bg-white">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <h1
                                class="inline-flex items-center px-1 pt-1 text-lg font-medium leading-5 text-primary-500 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out">
                                {{ $header }}
                                <h1>

                        </div>
                    </div>
                </div>
            </div>
            {{-- end header content --}}


            <main>
                {{ $slot }}
            </main>
        </div>
        {{-- content dashboard --}}
    </div>

    @stack('modals')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>

    <script>
        console.log("funciona");
    </script>
    @stack('custom-scripts')

</body>

</html>
