<x-theme-layouts.public-default>
    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
    <div class="prose max-w-none">{!! nl2br(e($post->content)) !!}</div>
</x-theme-layouts.public-default>
