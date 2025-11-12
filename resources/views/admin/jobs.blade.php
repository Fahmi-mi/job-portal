<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">Admin</a> / 
                        <strong>Kelola Lowongan Kerja</strong>
                    </div>
                    
                    <hr class="my-4">
                    
                    <h3 class="text-lg font-semibold mb-4">Kelola Lowongan Kerja</h3>
                    <p class="mb-4">Halaman untuk mengelola lowongan kerja</p>
                    
                    <hr class="my-4">
                    
                    <a href="{{ route('admin.index') }}" class="text-blue-600 hover:underline">← Kembali ke Dashboard Admin</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
