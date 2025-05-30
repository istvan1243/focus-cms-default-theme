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
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

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
    <body class="bg-white w-full min-h-screen flex flex-col">
        @if($isMinimalView == false)
            <!-- Fejléc -->
            <header id="header" class="w-full  max-w-[1160px] mx-auto p-4">
                {!! $sidebars['ts_FocusDefaultTheme_sidebar_top_nav'] !!}
            </header>
        @endif

        <!-- Fő tartalom -->
        <main id="content" class="w-full lg:bg-gray-200 py-0 md:py-1 lg:py-16">
            <div class="py-0 lg:py-10 px-6 bg-white lg:px-8 w-full max-w-[1160px] flex-grow mx-auto shadow-xl">
                {{ $slot }}
            </div>
        </main>

        <!-- Lábléc -->
        @if($isMinimalView == false)
            <footer id="footer" class="w-full max-w-[1160px] mx-auto p-4 text-white mt-16 py-8">
                <div class="container mx-auto">
                    <!-- Sidebarok grid-ben -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_1'] !!}
                            </div>
                        </div>
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_2'] !!}
                            </div>
                        </div>
                        <div>
                            <div>
                                {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_3'] !!}
                            </div>
                        </div>
                    </div>

                    <!-- Copyright szöveg -->
                    <div class="">
                        {!! $sidebars['ts_FocusDefaultTheme_sidebar_bottom_4'] !!}
                    </div>
                </div>
            </footer>
        @endif

        @stack('scripts')
    </body>
</html>