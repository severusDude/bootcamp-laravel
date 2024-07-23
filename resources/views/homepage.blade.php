<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>Homepage</x-slot:header>

    @foreach ($categories as $category)
        <p>{{ $category->category_name }}</p>
    @endforeach
    @foreach ($news as $news_item)
        <p>{{ $news_item->category_id }} • {{ $news_item->news_title }}</p>
    @endforeach
</x-layout>
