@php
    $viteIsActive = check_theme_vite_is_active();

    if( $viteIsActive == true) {
        $viteAssets = [
            "Themes/{$currentTheme}/public/js/theme.js",
            "resources/css/theme-{$currentTheme}-app.css"
        ];
    } else {
        $themeManifestPath = public_path("themepublic/build/manifest.json");
        $manifest = json_decode(file_get_contents($themeManifestPath), true);
        $theme_vite_data = [
            "js" => "themepublic/build/".$manifest["Themes/{$currentTheme}/public/js/theme.js"]['file'] ?? '',
            "css" => "themepublic/build/".$manifest["resources/css/theme-{$currentTheme}-app.css"]['file'] ?? ''
        ];
    }

    $isMinimalView = !empty($isMinimalViewFromController) ? $isMinimalViewFromController : request()->has('minimal');
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
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/prism.js/prism.css') }}" />
        <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>

        <!-- Scripts -->
        <style>
            [x-cloak] { display: none !important; }
        </style>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
        <script defer src="{{ asset('assets/prism.js/prism.js') }}"></script>


        @if( $viteIsActive == false)
            <link rel="stylesheet" href="{{ asset($theme_vite_data['css']) }}" rel="stylesheet" />
            <script defer src="{{ asset($theme_vite_data['js']) }}"></script>
        @else
            @vite($viteAssets)
        @endif


        <!-- Head scripts -->
        @stack('head_scripts')

        @stack('my-styles')
    </head>
    <body class="bg-gray-100">

        @if($isMinimalView == false)
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
                        {!! $topNavContent !!}
                </nav>
            </header>
        @endif

        <!-- Fő tartalom -->
        <main id="content" class="container my-4 mx-auto p-4">
            <div id="twteszt-2">
                <p>TW TESZT 2</p><br><br>
                <button id="jqueryTeszt" class="px-4 py-2 bg-blue-500 text-white rounded">jQuery Teszt</button><br><br>
                <div x-data="{ open: false }" x-cloak>
                    <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded">
                    <span x-show="!open">Mutasd</span>
                    <span x-show="open">Rejtsd</span>
                    </button>

                    <p x-show="open" class="mt-4 p-4 bg-gray-700 rounded">
                        Ez egy egyszerű Alpine.js példa!
                    </p>
                </div>
            </div>
            {{ $slot }}
        </main>

        <!-- Lábléc -->
        @if($isMinimalView == false)
            <footer id="footer" class="bg-gray-800 text-white mt-16 py-8">
                <div class="container mx-auto">
                    <!-- Sidebarok grid-ben -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                {!! $topSidebarContent !!}
                            </div>
                        </div>
                        <div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                {!! $bottomSidebarContent !!}
                            </div>
                        </div>
                        <div>
                            <div class="bg-gray-700 p-4 rounded-lg">
                                {!! $rightSidebarContent !!}
                            </div>
                        </div>
                    </div>

                    <!-- Copyright szöveg -->
                    <div class="mt-16 text-center text-gray-400">
                        &copy; {{ date('Y') }} Minden jog fenntartva.
                    </div>
                </div>
            </footer>
        @endif
    </body>
</html>