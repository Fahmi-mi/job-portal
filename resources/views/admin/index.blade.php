<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Selamat Datang, Admin!</h3>
                    <p class="mb-4">Kelola sistem Job Portal dari dashboard ini.</p>
                    
                    <hr class="my-6 border-gray-300 dark:border-gray-600">
                    
                    <h4 class="font-semibold mt-2 mb-4">Menu Admin:</h4>
                    <div class="space-y-6">
                        <div>
                            <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                ➕ Tambah Lowongan Kerja Baru
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                📋 Lihat & Kelola Semua Lowongan
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('applications.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                👥 Lihat & Kelola Pelamar
                            </a>
                        </div>
                    </div>
                    
                    <hr class="mt-6 border-gray-300 dark:border-gray-600">
                    
                    <h4 class="font-semibold mt-2 mb-4">Import Lowongan:</h4>
                    <div class="space-y-4">
                        <div>
                            <p class="mb-2 text-sm text-gray-600 dark:text-gray-400">Import lowongan dari file Excel (.xlsx)</p>
                            <form action="{{ route('jobs.import') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <div>
                                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pilih File Excel</label>
                                    <input type="file" name="file" id="file" accept=".xlsx,.csv" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <button type="submit" class="inline-flex items-center mt-4 px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 tracking-widest uppercase text-xs font-semibold rounded-md hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    Import Lowongan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
