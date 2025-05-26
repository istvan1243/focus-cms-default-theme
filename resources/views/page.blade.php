<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    <div class="">
        <h1 class="text-4xl font-bold mb-3">{{ $post->title }}</h1>

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