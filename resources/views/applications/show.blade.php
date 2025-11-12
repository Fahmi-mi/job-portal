<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Lamaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Detail Lamaran</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pelamar</p>
                                <p class="text-gray-900 dark:text-gray-100">{{ $application->user->name }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Lowongan</p>
                                <p class="text-gray-900 dark:text-gray-100">{{ $application->job->title }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Perusahaan</p>
                                <p class="text-gray-900 dark:text-gray-100">{{ $application->job->company }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Lokasi</p>
                                <p class="text-gray-900 dark:text-gray-100">{{ $application->job->location }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</p>
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium
                                    {{ $application->status === 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                                      ($application->status === 'Accepted' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $application->status }}
                                </span>
                            </div>
                            
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Daftar</p>
                                <p class="text-gray-900 dark:text-gray-100">{{ $application->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">CV</p>
                        <a href="{{ asset('storage/' . $application->cv) }}" target="_blank"
                           class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Lihat CV
                        </a>
                    </div>
                    
                    @if(auth()->user()->role === 'admin')
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-600">
                        <h4 class="text-lg font-semibold mb-4">Update Status Lamaran</h4>
                        <form action="{{ route('applications.update', $application->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="flex flex-wrap gap-4">
                                <div>
                                    <input type="radio" id="status_pending" name="status" value="Pending" 
                                           {{ $application->status === 'Pending' ? 'checked' : '' }}>
                                    <label for="status_pending" class="ml-2">Pending</label>
                                </div>
                                <div>
                                    <input type="radio" id="status_accepted" name="status" value="Accepted" 
                                           {{ $application->status === 'Accepted' ? 'checked' : '' }}>
                                    <label for="status_accepted" class="ml-2">Diterima</label>
                                </div>
                                <div>
                                    <input type="radio" id="status_rejected" name="status" value="Rejected" 
                                           {{ $application->status === 'Rejected' ? 'checked' : '' }}>
                                    <label for="status_rejected" class="ml-2">Ditolak</label>
                                </div>
                            </div>
                            
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors duration-150 shadow-sm">
                                Update Status
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>