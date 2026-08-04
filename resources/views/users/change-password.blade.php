@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="bg-gray-800 text-white px-6 py-4">
            <h2 class="text-lg font-semibold">🔑 Ganti Password</h2>
        </div>

        <div class="p-6">
            {{-- Pesan sukses --}}
            @if (session('success'))
                <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('change.password') }}" class="space-y-5">
                @csrf

                {{-- Password Lama --}}
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password Saat Ini
                    </label>
                    <input id="current_password" 
                           type="password" 
                           name="current_password" 
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('current_password') border-red-500 @enderror">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password Baru
                    </label>
                    <input id="new_password" 
                           type="password" 
                           name="new_password" 
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('new_password') border-red-500 @enderror">
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password Baru --}}
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password Baru
                    </label>
                    <input id="new_password_confirmation" 
                           type="password" 
                           name="new_password_confirmation" 
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                {{-- Tombol --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" 
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        Ganti Password
                    </button>
                    {{-- <a href="{{ route('dashboard') }}" 
                       class="px-5 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg shadow hover:bg-gray-600 transition">
                        Kembali
                    </a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
