@props(['id', 'comment'])

<article class="p-6 py-3 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 font-semibold text-sm text-gray-900 dark:text-white">
                <img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                    alt="{{ $comment->user->name }}">{{ $comment->user->name }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $comment->getAutoDiffTime($comment->updated_at) }}
            </p>
        </div>
        @auth
            @if (Auth::user()->id === $comment->user_id)
                <!-- Comment settings -->
                <button id="{{ $id }}Button" data-dropdown-toggle="{{ $id }}"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:text-gray-400 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                    <span class="sr-only">Comment settings</span>
                </button>
                <!-- Dropdown menu -->
                <div id="{{ $id }}"
                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownMenuIconHorizontalButton">
                        <li>
                            <button
                                onclick="openEditModal('{{ $comment->news_id }}', '{{ $comment->id }}', '{{ $comment->content }}')"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600
                                dark:hover:text-white">Edit</button>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth
    </footer>
    <!-- Comment Content -->
    <p>{{ $comment->content }}</p>
</article>

<div id="edit-comment-modal"
    class="fixed inset-0 hidden bg-gray-800 bg-opacity-75 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h2 class="text-xl font-bold mb-4">Edit Comment</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong> Ada beberapa masalah dengan inputan Anda.<br><br>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="edit-comment-form" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="textarea" name="content" id="edit-comment-content"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Your comment...">
            </div>
            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">Submit</button>
                <button type="button" onclick="closeModal('edit-comment-modal')"
                    class="ml-2 bg-gray-600 text-white px-4 py-2 rounded shadow hover:bg-gray-700 focus:bg-gray-700 focus:outline-none">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(news_id, id, content) {
        document.getElementById('edit-comment-form').action = '/news/' + news_id + '/' + id;
        document.getElementById('edit-comment-content').value = content;
        openModal('edit-comment-modal');
    }
</script>
