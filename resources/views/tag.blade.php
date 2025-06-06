<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    @if(!empty($head_image_url))
        <div class="w-full flex justify-items-center">
            <img
                class="mx-auto inline-block"
                src="{{ $head_image_url }}"
            >
        </div>
    @endif
    <div class="mb-0 py-12 font-semibold bg-slate-100 text-black w-full flex justify-items-center">
        <h1 class="inline-block mx-auto text-3xl">{{ $tag->title }}</h1>
    </div>
    @if(!empty($description))
        <div class="mb-10 p-6 w-full border-4 border-solid border-gray-100">
            {!! markdownToHtml($description) !!}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
        @foreach($tag->posts()->where('status', 'published')->get() as $post)
           <div class="px-2">
                <p class="text-sm text-gray-400">{{ $tag->title }}</p>
                <p class="mt-1 mb-0 text-black text-2xl font-semibold">
                    <a href="{{ route('post.show', ['slug'=>$post->name]) }}" target="_self">{{ $post->title }}</a>
                </p>
                <p class="text-gray-600 w-full">{{ $post->created_at->format('Y-m-d') }}</p>
                <p class="my-2">{!! strip_tags(Str::limit(markdownToHtml($post->content), 240, '<span class="ml-1 text-gray-400">[...]</span>')) !!}</p>
                <p class="">
                    <a
                        href="{{ route('post.show', ['slug'=>$post->name]) }}"
                        target="_self"
                        class="text-blue-700 hover:text-blue-400 font-semibold"
                    >Tovább az olvasáshoz<i class="mdi mdi-arrow-right"></i></a>
                </p>
            </div>
        @endforeach
    </div>
</x-public-default>