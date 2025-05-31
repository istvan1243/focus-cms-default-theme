<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    @push('meta_tags')
        <title>{{ config('app.name')." | ".($post->title) }}</title>
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta name="description" content="{!! strip_tags(Str::limit(markdownToHtml($post->content), 145, '<span class="ml-1 text-gray-400">[...]</span>')) !!}" />
        <meta name="author" content="{{ config('app.name') }}">
        <meta name="robots" content="index, follow">
        <meta property="article:published_time" content="{{ $post->created_at->format('Y-m-d') }}" />
        <meta property="article:modified_time" content="{{ $post->updated_at->format('Y-m-d') }}" />
        <meta property="article:author" content="{{ config('app.name') }}" />
        @if(!empty($category))
            <meta property="article:section" content="{{ $category->title }}" />
        @endif
        @if(!empty($tags))
            <meta property="article:tag" content="{{ implode(', ', $tags->pluck('title')->toArray()) }}" />
            <meta name="keywords" content="{{ implode(', ', $tags->pluck('title')->toArray()) }}">
        @endif
        <meta property="og:title" content="{{ $post->title }}" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:image" content="{{ url('storage/images/site-logo.jpg') }}" />
        <meta property="og:description" content="{!! strip_tags(Str::limit(markdownToHtml($post->content), 145, '<span class="ml-1 text-gray-400">[...]</span>')) !!}" />
        <meta property="og:site_name" content="{{ config('app.name') }}" />
        <meta property="og:locale" content="hu_HU" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ $post->title }}" />
        <meta name="twitter:description" content="{!! strip_tags(Str::limit(markdownToHtml($post->content), 145, '<span class="ml-1 text-gray-400">[...]</span>')) !!}" />
        <meta name="twitter:image" content="{{ url('storage/images/site-logo.jpg') }}" />
        <meta name="twitter:site" content="" />
    @endpush

    <div class="">
        <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

        <p class="mb-1 text-gray-600 w-full">{{ $post->created_at->format('Y-m-d') }}</p>

        <p class="mb-4 w-full">

            @if(!empty($category))
                <a
                    class="mr-4 font-semibold text-blue-600 hover:text-blue-400"
                    href="{{ route('front.category', ['category' => $category->name]) }}"
                    target="_self"
                >{{ $category->title }}</a>
            @endif

            @if(!empty($tags))
                @foreach($tags as $tag)
                    <a
                        class="mr-2 font-semibold text-blue-600 hover:text-blue-400"
                        href="{{ route('front.tag', ['tag' => $tag->name]) }}"
                        target="_self"
                    >#{{ $tag->title }}</a>
                @endforeach
            @endif
        </p>

        <div class="prose">
            {!! $post->content !!}
        </div>

        @if($post->post_type_name == 'post')
            <div
                class="mt-10 w-full block justify-center"
                x-data="prevNextToggle()"
                x-cloak
            >
                <div
                    class=" w-fit mx-auto !mb-6 shadow-lg py-4 px-6  grid grid-cols-1 sm:grid-cols-[auto_auto] gap-4 sm:gap-1 justify-center items-center space-x-2 text-center text-lg cursor-pointer border rounded"
                    :class="isCategoryFilter ? 'text-purple-600' : 'text-blue-900'"
                    @click="isCategoryFilter = !isCategoryFilter"
                >
                    <div class="inline-flex justify-center sm:justify-start items-center">További tartalmak:</div>

                    <div class="inline-flex w-full sm:w-auto justify-center sm:justify-start items-center space-x-4">
                        <input
                            type="hidden"
                            id="PrevNextPostCategoryFilter"
                            name="PrevNextPostCategoryFilter"
                            x-model="isCategoryFilter"
                            :value="isCategoryFilter ? 1 : 0"
                            x-cloak
                        >
                        <span class="inline-block" x-text="isCategoryFilter ? 'a kategóriában' : 'mind'"></span>
                        <i
                            class="inline-block mdi scale-[180%]"
                            :class="isCategoryFilter ? 'mdi-filter-check-outline' : 'mdi-filter-off-outline'"
                        ></i>
                    </div>
                </div>

                <!-- Kategória alapú navigáció -->
                <div
                    class="w-full p-2 grid grid-cols-[1fr_auto_1fr] gap-2 x-cloak overflow-hidden"
                    x-show.immediate="isCategoryFilter"
                    x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-40"
                    x-transition:leave="transition ease-in duration-600"
                    x-transition:leave-start="opacity-100 max-h-40"
                    x-transition:leave-end="opacity-0 max-h-0"
                >
                    <div class="flex text-blue-800 hover:text-blue-500 text-start">
                        @if(!empty($prevPostInTerm))
                            <a href="{{ url($prevPostInTerm->name) }}" target="_self" class="w-full">
                                <span class="inline-block w-full my-1"><i class="mdi mdi-arrow-left-thin"></i> Előző</span>
                                <span class="inline-block w-full my-1">{{ $prevPostInTerm->title }}</span>
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center">
                        <div class="flex-col h-[calc(80%)] w-[1px] bg-gray-400"></div>
                    </div>
                    <div class="flex text-blue-800 hover:text-blue-500 text-end">
                        @if(!empty($nextPostInTerm))
                            <a href="{{ url($nextPostInTerm->name) }}" target="_self" class="w-full">
                                <span class="inline-block w-full my-1">Következő <i class="mdi mdi-arrow-right-thin"></i></span>
                                <span class="inline-block w-full my-1">{{ $nextPostInTerm->title }}</span>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Nem kategória alapú navigáció -->
                <div
                    class="w-full p-2 grid grid-cols-[1fr_auto_1fr] gap-2 x-cloak overflow-hidden"
                    x-show.immediate="!isCategoryFilter"
                    x-transition:enter="transition ease-out duration-600"
                    x-transition:enter-start="opacity-0 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-40"
                    x-transition:leave="transition ease-in duration-600"
                    x-transition:leave-start="opacity-100 max-h-40"
                    x-transition:leave-end="opacity-0 max-h-0"
                >
                    <div class="flex text-blue-800 hover:text-blue-500 text-start">
                        @if(!empty($prevPost))
                            <a href="{{ url($prevPost->name) }}" target="_self" class="w-full">
                                <span class="inline-block w-full my-1"><i class="mdi mdi-arrow-left-thin"></i> Előző</span>
                                <span class="inline-block w-full my-1">{{ $prevPost->title }}</span>
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center">
                        <div class="flex-col h-[calc(80%)] w-[1px] bg-gray-400"></div>
                    </div>
                    <div class="flex text-blue-800 hover:text-blue-500 text-end">
                        @if(!empty($nextPost))
                            <a href="{{ url($nextPost->name) }}" target="_self" class="w-full">
                                <span class="inline-block w-full my-1">Következő <i class="mdi mdi-arrow-right-thin"></i></span>
                                <span class="inline-block w-full my-1">{{ $nextPost->title }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            function prevNextToggle() {
                return {
                    isCategoryFilter: true,
                    init() {
                        let val = Cookies.get('PrevNextPostCategoryFilter');
                        console.log("InitVal: " + val);
                        this.isCategoryFilter = val !== 'false'; // ha nincs: true

                        this.$watch('isCategoryFilter', (val) => {
                            console.log("CookieSetVal: " + val);
                            Cookies.set('PrevNextPostCategoryFilter', val ? 'true' : 'false', { expires: 7 });
                        });
                    }
                }
            }
        </script>
    @endpush
</x-public-default>