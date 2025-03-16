<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title ?? 'Alapértelmezett cím' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div id="header" class="bg-blue-600 text-white p-4">
        <nav id="top-nav" class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="white" stroke-width="2" />
                </svg>
                <span class="text-lg font-semibold">Oldal Cím</span>
            </div>
            <div class="space-x-4">
                <a href="#" class="text-white hover:underline">Kezdőlap</a>
                <a href="#" class="text-white hover:underline">Bejegyzések</a>
                <a href="#" class="text-white hover:underline">Kapcsolat</a>
            </div>
        </nav>
    </div>

    <div id="content" class="container mx-auto p-6">
        {{ $post->content ?? 'Nincs tartalom' }}
    </div>

    <div id="footer" class="bg-gray-800 text-white mt-12 p-6">
        <div class="grid grid-cols-3 gap-4">
            @include("themes.{$this->currentThemeName}.views.components.sidebar", ['widgets' => $footerSidebar_1])
            @include("themes.{$this->currentThemeName}.views.components.sidebar", ['widgets' => $footerSidebar_2])
            @include("themes.{$this->currentThemeName}.views.components.sidebar", ['widgets' => $footerSidebar_3])
        </div>
        <div class="text-center mt-6 pt-6 border-t border-gray-600 text-sm">
            &copy; {{ date('Y') }} Minden jog fenntartva.
        </div>
    </div>
</body>
</html>