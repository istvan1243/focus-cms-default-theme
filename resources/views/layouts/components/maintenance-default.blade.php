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
        <main id="maintenance-content" class="container max-w-xl my-4 mx-auto p-4">
            {!! $maintenanceSidebarContent !!}
        </main>
    </body>
</html>