@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow-md rounded-2xl overflow-hidden">
        <div class="bg-gray-100 px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Reset Password Berhasil</h2>
        </div>

        <div class="px-6 py-4">
            <p class="mb-2"><span class="font-semibold">Nama:</span> {{ $user->name }}</p>
            <p class="mb-4"><span class="font-semibold">Email/Username:</span> {{ $user->email }}</p>

            <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-lg p-4 mb-4 flex items-center justify-between">
                <div>
                    <strong>Password baru (sementara):</strong>
                    <span id="pwText" class="ml-2 font-mono">{{ $plainPassword }}</span>
                </div>
                <button type="button" 
                        onclick="copyPw()" 
                        class="ml-3 px-3 py-1 text-sm font-medium border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                    Salin
                </button>
            </div>

            @if ($rawPhone)
                <p class="mb-2"><span class="font-semibold">No. HP (asal):</span> {{ $rawPhone }}</p>
            @endif

            @if ($phoneForWa)
                <p class="mb-2"><span class="font-semibold">No. HP (untuk WA):</span> {{ $phoneForWa }}</p>
            @else
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg p-3 mb-4">
                    Nomor HP tidak tersedia atau tidak valid untuk WhatsApp.
                </div>
            @endif

            <div class="flex flex-wrap gap-3 mt-6">
                @if ($waLink)
                    <a href="{{ $waLink }}" target="_blank" 
                       class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium transition">
                        Kirim via WhatsApp
                    </a>
                @endif

                <a href="{{ route('users.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg shadow text-sm font-medium transition">
                    Kembali ke Daftar User
                </a>
            </div>

            <hr class="my-6 border-gray-200">

            <small class="text-gray-500 block">
                Demi keamanan, minta user segera mengganti password setelah login.
            </small>
        </div>
    </div>
</div>

<script>
function copyPw() {
    const pw = document.getElementById('pwText').textContent;
    navigator.clipboard.writeText(pw).then(() => {
        alert('Password disalin ke clipboard');
    }).catch(() => {
        alert('Gagal menyalin password');
    });
}
</script>
@endsection
