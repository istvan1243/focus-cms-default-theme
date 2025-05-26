<x-public-default
    :isMinimalViewFromController="($isMinimalViewFromController ?? null)"
>
 @foreach($categories as $category)
        <a href="{{ route('front.category', ['category' => $category->name]) }}" target="_self">{{ $category->title }}</a><br>
    @endforeach
</x-public-default>