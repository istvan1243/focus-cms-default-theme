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
        <main id="maintenance-content" class="container max-w-xl my-4 mx-auto p-4">
            {!! $maintenanceSidebarContent !!}
        </main>
    </body>
</html>