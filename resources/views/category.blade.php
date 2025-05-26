<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
    <div class="mb-10 py-12 font-semibold bg-slate-100 text-black w-full justify-items-center">
        <h1 class="text-3xl">{{ $category->title }}</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($category->posts as $post)
            <div class="p-2">
                <p class="text-sm text-gray-400">{{ $category->title }}</p>
                <p class="mt-1 mb-3 text-black text-2xl font-semibold">
                    <a href="{{ route('post.show', ['slug'=>$post->name]) }}" target="_self">{{ $post->title }}</a>
                </p>
                <p class="mb-8">{!! Str::limit(markdownToHtml($post->content), 240, '<span class="ml-1 text-gray-400">[...]</span>') !!}</p>
                <p class="mt-2">
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