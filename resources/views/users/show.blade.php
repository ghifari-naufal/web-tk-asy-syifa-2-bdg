@include('layout-lp.head')
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <i class="fas fa-user text-blue-600 mr-3"></i>
            Detail User
        </h1>
        <div class="flex space-x-3">
            <a href="{{ route('users.index') }}" 
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fa fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Main User Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-start space-x-4 mb-6">
                    <!-- Avatar -->
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    
                    <!-- Basic Info -->
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->email }}</p>
                        
                        <!-- Roles -->
                        <div class="mt-3">
                            @foreach ($user->getRoleNames() as $role)
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full mr-2">
                                    <i class="fas fa-user-tag mr-1"></i>{{ $role }}
                                </span>
                            @endforeach

                            @if (!empty($user->role))
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-semibold rounded-full">
                                    <i class="fas fa-shield-alt mr-1"></i>{{ ucfirst($user->role) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Informasi Akun
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-600 mb-1">ID User</label>
                            <p class="text-gray-900 font-mono">{{ $user->id }}</p>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-lg">
                            {{-- <label class="block text-sm font-medium text-gray-600 mb-1">
                                <i class="fas fa-phone mr-1"></i>No. HP
                            </label>
                            @if($user->no_hp)
                                <p class="text-gray-900">{{ $user->no_hp }}</p>
                                <a href="https://api.whatsapp.com/send?phone={{ $user->no_hp }}" 
                                   target="_blank"
                                   class="inline-flex items-center text-green-600 hover:text-green-700 text-sm mt-1">
                                    <i class="fab fa-whatsapp mr-1"></i>Chat WhatsApp
                                </a>
                            @else
                                <p class="text-gray-400 italic">Tidak ada</p>
                            @endif --}}
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Bergabung</label>
                            <p class="text-gray-900">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <label class="block text-sm font-medium text-gray-600 mb-1">Terakhir Diupdate</label>
                            <p class="text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="lg:col-span-1 space-y-6">
            
            <!-- Data Pendaftaran -->
            @if($user->pendaftaran)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-baby text-pink-600 mr-2"></i>
                    Data Pendaftaran
                </h3>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Orang Tua</label>
                        <p class="text-gray-900">{{ $user->pendaftaran->nama_ortu ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">No. Telepon</label>
                        @if($user->pendaftaran->no_hp)
                            <p class="text-gray-900">{{ $user->pendaftaran->no_hp }}</p>
                        @else
                            <p class="text-gray-400 italic">Tidak ada</p>
                        @endif
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Nama Anak</label>
                        <p class="text-gray-900">{{ $user->pendaftaran->nama_anak ?? '-' }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Kelas TK</label>
                        @if($user->pendaftaran->kelas_tk)
                            <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-sm rounded-full">
                                {{ $user->pendaftaran->kelas_tk }}
                            </span>
                        @else
                            <p class="text-gray-400 italic">Belum ditentukan</p>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-baby text-pink-600 mr-2"></i>
                    Data Pendaftaran
                </h3>
                <div class="text-center py-4">
                    <i class="fas fa-info-circle text-gray-300 text-3xl mb-2"></i>
                    <p class="text-gray-500">Belum ada data pendaftaran</p>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-tools text-gray-600 mr-2"></i>
                    Quick Actions
                </h3>
                
                <div class="space-y-3">
                    {{-- @can('user-edit')
                        <a href="{{ route('users.edit', $user->id) }}" 
                           class="w-full flex items-center justify-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                            <i class="fas fa-edit mr-2"></i>
                            Edit User
                        </a>
                    @endcan --}}

                    <!-- Reset Password -->
                    <form action="{{ route('users.reset.auto', $user->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin reset password untuk {{ $user->name }}?');">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-key mr-2"></i>
                            Reset Password
                        </button>
                    </form>

                    @can('user-delete')
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                              onsubmit="return confirm('Yakin hapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan!');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus User
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            <!-- Account Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    <i class="fas fa-chart-line text-green-600 mr-2"></i>
                    Status Akun
                </h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Status</span>
                        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-sm rounded-full">
                            <i class="fas fa-check-circle mr-1"></i>Aktif
                        </span>
                    </div>
                    
                    {{-- <div class="flex items-center justify-between">
                        <span class="text-gray-600">Email Verified</span>
                        @if($user->email_verified_at)
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 text-sm rounded-full">
                                <i class="fas fa-check mr-1"></i>Ya
                            </span>
                        @else
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 text-sm rounded-full">
                                <i class="fas fa-clock mr-1"></i>Belum
                            </span>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection