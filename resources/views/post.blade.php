<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    <div class="">
        <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

        <p class="mb-4">
            @if(!empty($category))
                <p class="mb-4">
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
    </div>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

            });
        </script>
    @endpush
</x-public-default>