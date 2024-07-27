<x-layout>
    <x-slot:title>{{ $news->title }}</x-slot:title>
    <x-slot:header>{{ $news->category->name }}</x-slot:header>
    <main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-2xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <!-- Author profile -->
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="mr-4 w-16 h-16 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                alt="{{ $news->user->name }}">
                            <div>
                                <a href="#" rel="author"
                                    class="text-xl font-bold text-gray-900 dark:text-white">{{ $news->user->name }}</a>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    {{ $news->user->roles[0]['name'] }}</p>
                                <p class="text-base text-gray-500 dark:text-gray-400">
                                    {{ $news->getAutoDiffTime($news->updated_at) }}</p>
                            </div>
                        </div>
                    </address>
                    <!-- Article title -->
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $news->title }}</h1>
                </header>
                {{ $news->body }}
                <!-- Post Comment section -->
                <section class="not-format">
                    <div class="pt-4 flex justify-between items-center mb-6">
                        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion
                            ({{ $news->comments->count() }})</h2>
                    </div>
                    @can('create comment')
                        <form method="POST" action="{{ url()->current() }}" class="mb-6">
                            @csrf
                            @method('POST')
                            <div
                                class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea name="content" id="comment" rows="6"
                                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                    placeholder="Write a comment..." required></textarea>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Post comment
                            </button>
                        </form>
                    @endcan
                    <!-- Comment section -->
                    @foreach ($news->comments as $comment)
                        <x-news-comment id="comment-btn-{{ $loop->index }}" :comment="$comment"></x-news-comment>
                    @endforeach
                </section>
            </article>
        </div>
    </main>

    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Related articles</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($related as $news)
                    <article class="max-w-xs">
                        <a href="{{ route('news.show', $news->id) }}">
                            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/article/blog-1.png"
                                class="mb-5 rounded-lg" alt="Image 1">
                        </a>
                        <h2 class="mb-2 text-xl font-bold leading-tight text-gray-900 dark:text-white">
                            <a href="{{ route('news.show', $news->id) }}">{{ $news->title }}</a>
                        </h2>
                        <p
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            {{ $news->category->name }}
                        </p>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">
                            {{ Str::of($news->body)->limit(70) }}
                        </p>
                    </article>
                @endforeach
            </div>
        </div>
    </aside>

</x-layout>
