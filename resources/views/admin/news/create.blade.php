@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah Berita Baru</h1>
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Judul:</label>
            <input type="text" id="title" name="title" class="mt-1 block w-full" required>
        </div>
        <div class="mb-4">
            <label for="body" class="block text-gray-700">Isi Berita:</label>
            <textarea id="body" name="body" class="mt-1 block w-full tinymce-editor" required></textarea>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Kategori:</label>
            <select id="category_id" name="category_id" class="mt-1 block w-full" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="mb-4">
            <label for="image" class="block text-gray-700">Gambar:</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full" required>
        </div>
        <div class="mb-4">
            <label for="image_caption" class="block text-gray-700">Keterangan Gambar:</label>
            <input type="text" id="image_caption" name="image_caption" class="mt-1 block w-full" required>
        </div> --}}
        <div class="mb-4">
            <label for="date" class="block text-gray-700">Tanggal:</label>
            <input type="date" id="date" name="date" class="mt-1 block w-full" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Simpan</button>
    </form>
@endsection
