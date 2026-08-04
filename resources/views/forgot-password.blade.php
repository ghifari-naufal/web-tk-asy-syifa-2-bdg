@extends('layouts.app')

@section('content')
    <div class="relative min-h-screen flex items-center justify-center bg-gray-50 px-4">

        <!-- Tombol Back -->
        <a href="{{ route('login') }}"
            class="absolute top-6 left-6 inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gray-200 hover:bg-gray-300 transition shadow-sm">
            <i class="fas fa-arrow-left text-gray-700"></i>
            {{-- <span class="text-gray-700 text-sm font-medium"></span> --}}
        </a>

        <!-- Card -->
        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔑 Lupa Password</h2>

            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                    <p class="font-medium">{{ session('success') }}</p>
                    @if (session('wa_link'))
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600 mb-2">Kirim lewat WhatsApp (Fast Response)</p>
                            <a href="{{ session('wa_link') }}" target="_blank"
                                class="inline-block bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg shadow transition">
                                📲 Kirim Permintaan Via WhatsApp
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <form method="POST" action="{{ route('password.submit') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username Terdaftar</label>
                    <input type="text" name="email"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="username" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp Terdaftar</label>

                    <div class="relative">
                        {{-- <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">+62</span> --}}
                        <input type="text" name="no_hp" id="no_hp"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                            placeholder="628xxxxxxxx" required>
                    </div>

                    <p class="text-xs text-gray-600 mt-1 flex items-center">
                        <i class="fas fa-info-circle text-gray-500 mr-1"></i>
                        <span><strong>**</strong>Ganti 08 menjadi 628</span>
                    </p>

                    @error('no_hp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition">
                        Kirim Permintaan Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    function formatWhatsApp(input) {
        let value = input.value.replace(/\D/g, ''); // Hapus semua non-digit

        // Jika diawali dengan 0, ganti dengan 62
        if (value.startsWith('0')) {
            value = '62' + value.substring(1);
        }
        // Jika belum ada kode negara, tambahkan 62
        else if (!value.startsWith('62') && value.length > 0) {
            value = '62' + value;
        }

        input.value = value;
    }
</script>
