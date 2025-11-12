<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Judul Lowongan</label>
                            <input id="title" type="text" name="title" value="{{ old('title', $job->title) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <textarea id="description" name="description" rows="4" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $job->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div class="mb-4">
                            <label for="company" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                            <input id="company" type="text" name="company" value="{{ old('company', $job->company) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('company')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Lokasi</label>
                            <input id="location" type="text" name="location" value="{{ old('location', $job->location) }}" required class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('location')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="mb-4">
                            <label for="salary" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Gaji (Opsional)</label>
                            <input id="salary" type="number" name="salary" value="{{ old('salary', $job->salary) }}" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            @error('salary')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Logo -->
                        @if($job->logo)
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">Logo Saat Ini</label>
                            <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="h-24 w-24 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>
                        @endif

                        <!-- Logo -->
                        <div class="mb-4">
                            <label for="logo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                {{ $job->logo ? 'Ganti Logo Perusahaan (Opsional)' : 'Logo Perusahaan (Opsional)' }}
                            </label>
                            <input id="logo" type="file" name="logo" accept="image/*" class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-300 border border-gray-300 dark:border-gray-700 rounded-md cursor-pointer bg-gray-50 dark:bg-gray-900 focus:outline-none">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: JPG, PNG, JPEG. Maksimal 2MB</p>
                            @error('logo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Update
                            </button>
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
