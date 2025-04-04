@php
    $viteIsActive = check_theme_vite_is_active();

    if( $viteIsActive == true) {
        $theme_vite_data = theme_vite_assets($currentTheme);
    } else {
        $theme_vite_data = theme_vite_assets_builded($currentTheme);
    }

    $viteAssets = [
        'resources/css/app.css',
        'resources/css/style.css',
        'resources/js/app.js',
    ];

    $viteAssets = $viteIsActive ? array_merge($viteAssets, $theme_vite_data) : $viteAssets;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'Laravel') }} Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/prism.js/prism.css') }}" rel="stylesheet" />

        <!-- Scripts -->

        @vite($viteAssets)

        @if( $viteIsActive == false)
            <link rel="stylesheet" href="{{ asset($theme_vite_data['css']) }}" rel="stylesheet" />
            <script type="module" src="{{ asset($theme_vite_data['js']) }}"></script>
        @endif

        <script type="module" src="{{ asset('assets/prism.js/prism.js') }}"></script>


        <!-- Head scripts -->
        @stack('head_scripts')

        @stack('my-styles')

    </head>
    <body class="bg-gray-100">
        <!-- Fejléc -->
        <header id="header" class="bg-white shadow">
            <nav id="top-nav" class="container mx-auto p-4 flex items-center justify-between">
                <!-- Bal oldal: Logo és oldal cím -->
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span class="ml-2 text-xl font-bold">Oldal Címe</span>
                </div>

                <!-- Jobb oldal: Navigációs linkek -->
                <div class="flex space-x-4">
                    <a href="/" class="text-gray-700 hover:text-blue-500">Kezdőlap</a>
                    <a href="/posts" class="text-gray-700 hover:text-blue-500">Bejegyzések</a>
                    <a href="/contact" class="text-gray-700 hover:text-blue-500">Kapcsolat</a>
                </div>
            </nav>
        </header>

        <!-- Fő tartalom -->
        <main id="content" class="container mx-auto p-4">
            {{ $slot }}
        </main>

        <!-- Lábléc -->
        <footer id="footer" class="bg-gray-800 text-white mt-16 py-8">
            <div class="container mx-auto">
                <!-- Sidebarok grid-ben -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        @include('theme::components.sidebar', ['widgets' => $footerSidebar1])
                    </div>
                    <div>
                        @include('theme::components.sidebar', ['widgets' => $footerSidebar2])
                    </div>
                    <div>
                        @include('theme::components.sidebar', ['widgets' => $footerSidebar3])
                    </div>
                </div>

                <!-- Copyright szöveg -->
                <div class="mt-16 text-center text-gray-400">
                    &copy; {{ date('Y') }} Minden jog fenntartva.
                </div>
            </div>
        </footer>
    </body>
</html>