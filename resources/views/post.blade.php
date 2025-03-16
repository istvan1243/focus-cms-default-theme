<x-public-default :footerSidebar1="$footerSidebar1" :footerSidebar2="$footerSidebar2" :footerSidebar3="$footerSidebar3">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
        <div class="prose">
            {!! $post->content !!}
        </div>
    </div>
</x-public-default>