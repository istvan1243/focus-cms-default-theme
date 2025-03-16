<div class="bg-gray-700 p-4 rounded-lg">
    @foreach($widgets as $widget)
        <div class="mb-4">
            <h3 class="text-lg font-semibold">{{ $widget['title'] }}</h3>
            <p class="text-sm">{{ $widget['content'] }}</p>
        </div>
    @endforeach
</div>
