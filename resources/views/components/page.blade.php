<div class="">
    <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
    <div class="prose">
        {!! $post->content !!}
    </div>
</div>

@push('scripts')

@endpush