@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Daftar Pengguna</h1>
    {{-- <div class="mb-4">
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md">Tambah Pengguna</a>
    </div> --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Joined at</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ $user->created_at }}</td>
                        <td class="px-6 py-4">{{ $user->roles[0]['name'] }}</td>
                        <td class="px-6 py-4">{{ !$user->deleted_at ? 'Active' : 'Deleted' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            {{-- <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536M9 13.5l-1.5 1.5V15h.5L11.5 13.5H11zM13 6.5l3.5 3.5m2.853-2.854a4.486 4.486 0 00-6.364-6.364L10.5 5.5H5v5.5l1.146 1.146a4.486 4.486 0 006.364 0l4.243-4.243z" />
                                </svg>
                            </a> --}}
                            @if (!$user->deleted_at)
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        @if ($user->roles[0]['name'] == 'admin') disabled class="text-gray-300 dark:text-gray-500 hover:underline"
                                    @else
                                    class="text-red-300 dark:text-red-500 hover:underline" @endif>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to restore this user?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        @if ($user->roles[0]['name'] == 'admin') disabled class="text-gray-300 dark:text-gray-500 hover:underline"
                                    @else
                                    class="text-red-300 dark:text-red-500 hover:underline" @endif>
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                            viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M3 9h13a5 5 0 0 1 0 10H7M3 9l4-4M3 9l4 4" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
