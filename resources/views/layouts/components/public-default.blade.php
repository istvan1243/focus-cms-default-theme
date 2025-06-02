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

        @stack('meta_tags')

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />

        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <link rel="stylesheet" href="{{ asset('assets/prism.js/prism.css') }}" />
        <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
        <link rel="stylesheet" href="{{ url('themepublic/ps/dist/photoswipe.css') }}">

        <script defer src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script defer src="{{ asset('assets/prism.js/prism.js') }}"></script>

        @if( $viteIsActive == false)
            <link rel="stylesheet" href="{{ asset($theme_vite_data['css']) }}" rel="stylesheet" />
            <script defer src="{{ asset($theme_vite_data['js']) }}"></script>
        @else
            @vite($viteAssets)
        @endif

        @stack('head_scripts')

        @stack('head_styles')
    </head>
    <body class="bg-white w-full min-h-screen flex flex-col">
        @if($isMinimalView == false)
            <!-- Fejléc -->
            <header id="header" class="w-full  max-w-[1160px] mx-auto p-4 break-words whitespace-normal hyphens-auto">
                {!! $sidebars['ts_FocusDefaultTheme_sidebar_top_nav'] !!}
            </header>
        @endif

        <!-- Fő tartalom -->
        <main id="content" class="w-full lg:bg-gray-200 py-0 md:py-1 lg:py-16 break-words whitespace-normal hyphens-auto">
            <div class="mx-auto pt-0 pb-10 lg:pt-10 lg:pb-20 px-6 bg-white lg:px-8 w-full max-w-[1160px] flex-grow shadow-xl">
                {{ $slot }}
            </div>
        </main>

        <!-- Lábléc -->
        @if($isMinimalView == false)
            <footer id="footer" class="w-full max-w-[1160px] mx-auto p-4 text-white mt-16 py-8 break-words whitespace-normal hyphens-auto">
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

        <script>
        document.addEventListener('DOMContentLoaded', async () => {
            try {
                const gallery = document.querySelector('.image-gallery');
                if (!gallery) return;

                const PhotoSwipeLightboxModule = await import("{{ url('themepublic/ps/dist/photoswipe-lightbox.esm.min.js') }}");
                const PhotoSwipeModule = await import("{{ url('themepublic/ps/dist/photoswipe.esm.min.js') }}");

                const PhotoSwipeLightbox = PhotoSwipeLightboxModule.default;
                const PhotoSwipe = PhotoSwipeModule.default;

                const lightbox = new PhotoSwipeLightbox({
                    gallery: '.image-gallery',
                    children: 'figure > a',
                    pswpModule: PhotoSwipe,

                    zoom: false,
                    maxZoomLevel: 3,
                    //secondaryZoomLevel: 2,
                    initialZoomLevel: 'fit',

                    fullscreenEl: true,

                    arrowEl: true,
                    closeEl: true,
                    zoomEl: true,
                    counterEl: true,
                });

                lightbox.on('uiRegister', function() {
                    lightbox.pswp.ui.registerElement({
                        name: 'fullscreen_button_div',
                        ariaLabel: 'Teljes képernyő',
                        order: 9,
                        isButton: true,
                        html: `
                            <button type="button" id="fullscreen-toggle" class="text-gray-100 text-xl" title="Teljes képernyő">
                                <i id="fullscreen-icon" class="mdi mdi-fullscreen mdi-24"></i>
                            </button>
                        `,
                        onClick: () => {
                            if (!document.fullscreenElement) {
                                document.body.requestFullscreen();
                                // ikon frissítés opcionálisan
                                document.getElementById('fullscreen-icon').classList.remove('mdi-fullscreen');
                                document.getElementById('fullscreen-icon').classList.add('mdi-fullscreen-exit');
                                document.body.style.overflow = 'hidden';
                            } else {
                                document.exitFullscreen();
                                // ikon visszaállítása
                                document.getElementById('fullscreen-icon').classList.remove('mdi-fullscreen-exit');
                                document.getElementById('fullscreen-icon').classList.add('mdi-fullscreen');
                                document.body.style.overflow = '';
                            }
                        }
                    });
                });

                lightbox.on('close', function() {
                    // Kilépés fullscreen módból, ha benne vagyunk
                    if (document.fullscreenElement) {
                        document.exitFullscreen().catch(err => {
                            console.warn('Nem sikerült kilépni fullscreen módból:', err);
                        });
                    }

                    // Visszaállítjuk az ikonokat
                    const icon = document.getElementById('fullscreen-icon');
                    if (icon) {
                        icon.classList.remove('mdi-fullscreen-exit');
                        icon.classList.add('mdi-fullscreen');
                    }

                    // Scroll engedélyezése újra
                    document.body.style.overflow = '';
                });

                lightbox.init();

            } catch (error) {
                console.error('Hiba történt a PhotoSwipe betöltése közben:', error);
            }
        });
        </script>

        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>

                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>