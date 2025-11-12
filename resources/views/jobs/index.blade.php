<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6 shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($jobs->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada lowongan kerja</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Belum ada lowongan yang tersedia saat ini.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($jobs as $job)
                            <div class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg overflow-hidden hover:shadow-lg transition-all duration-200">
                                <div class="p-6">
                                    <div class="flex gap-6">
                                        <!-- Logo Perusahaan (Kotak) -->
                                        <div class="flex-shrink-0">
                                            @if($job->logo)
                                                <img src="{{ asset('storage/' . $job->logo) }}" alt="{{ $job->company }}" class="w-24 h-24 object-cover border-2 border-gray-300 dark:border-gray-500 rounded-lg">
                                            @else
                                                <div class="w-24 h-24 bg-gray-300 dark:bg-gray-600 border-2 border-gray-400 dark:border-gray-500 rounded-lg flex items-center justify-center">
                                                    <svg class="h-12 w-12 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Info Lowongan -->
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">{{ $job->title }}</h3>
                                                    <p class="text-base font-semibold text-gray-700 dark:text-gray-300 mb-3">{{ $job->company }}</p>
                                                </div>
                                                
                                                <!-- Aksi Admin (Desktop) -->
                                                @if(Auth::user()->role === 'admin')
                                                <div class="hidden sm:flex gap-2 ml-4">
                                                    <a href="{{ route('jobs.edit', $job->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150 shadow-sm">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-150 shadow-sm" onclick="return confirm('Yakin ingin menghapus lowongan ini?')">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">{{ $job->description }}</p>
                                            
                                            <div class="flex flex-wrap gap-4">
                                                <div class="flex items-center text-sm text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-800 px-3 py-1.5 rounded-md border border-gray-300 dark:border-gray-600">
                                                    <svg class="w-4 h-4 mr-2 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    </svg>
                                                    <span class="font-medium">{{ $job->location }}</span>
                                                </div>
                                                @if($job->salary)
                                                <div class="flex items-center text-sm text-green-800 dark:text-green-100 bg-green-100 dark:bg-green-800 px-3 py-1.5 rounded-md border border-green-400 dark:border-green-600">
                                                    <svg class="w-4 h-4 mr-2 text-green-700 dark:text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="font-semibold">Rp {{ number_format($job->salary, 0, ',', '.') }}</span>
                                                </div>
                                                @else
                                                <div class="flex items-center text-sm text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-800 px-3 py-1.5 rounded-md border border-gray-300 dark:border-gray-600">
                                                    <span class="font-medium">Gaji: Negotiable</span>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Application form for non-admin users -->
                                            @if(Auth::user()->role !== 'admin')
                                            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                                <form action="{{ route('apply.store', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                                    @csrf
                                                    <div>
                                                        <label for="cv_{{ $job->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Upload CV (PDF)</label>
                                                        <input type="file" name="cv" id="cv_{{ $job->id }}" accept=".pdf" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600">
                                                    </div>
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-150 shadow-sm">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                        </svg>
                                                        Lamar Pekerjaan
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                            
                                            <!-- Aksi Admin (Mobile) -->
                                            @if(Auth::user()->role === 'admin')
                                            <div class="flex sm:hidden gap-2 mt-4">
                                                <a href="{{ route('jobs.edit', $job->id) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-150" onclick="return confirm('Yakin ingin menghapus lowongan ini?')">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
