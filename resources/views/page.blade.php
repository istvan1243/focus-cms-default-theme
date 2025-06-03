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
        <meta property="og:type" content="website" />
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

        <div class="prose">
            {!! $post->content !!}
        </div>
    </div>
</x-public-default>