@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-clipboard-check text-green-500 mr-3"></i>
                Daftar Ulang
            </h2>
        </div>

        <!-- Error Alert -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                <p class="font-semibold">❌ Ada masalah dengan input Anda:</p>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Sudah Daftar Alert -->
        @if ($sudahDaftar)
            <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded">
                <h5 class="font-semibold">ℹ️ Informasi</h5>
                <p class="mt-1">
                    Anda sudah melakukan daftar ulang untuk tahun ajaran
                    <strong>{{ $tahunAjaranAktif }}</strong>.
                    <a href="{{ route('my-registration') }}" class="underline text-blue-600 hover:text-blue-800">Lihat
                        status daftar ulang Anda</a>.
                </p>
            </div>
        @else
            <!-- Form -->
            <div class="bg-white shadow rounded-lg p-6">
                <h5 class="text-lg font-semibold mb-4">
                    Form Daftar Ulang - Tahun Ajaran {{ $tahunAjaranAktif }}
                </h5>

                <!-- Info Pembayaran -->
                <div class="bg-blue-50 border border-blue-200 p-4 rounded mb-6">
                    <h6 class="font-semibold text-blue-800">💳 Informasi Pembayaran:</h6>
                    <p><strong>Biaya Daftar Ulang:</strong> Rp 500.000</p>
                    <p><strong>Rekening:</strong> BCA 1234567890 a.n. Yayasan Pendidikan</p>
                    <p><strong>Catatan:</strong> Upload bukti pembayaran JPG/PNG (maksimal 2MB)</p>
                </div>

                <form action="{{ route('daftar-ulang.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <!-- Tahun Ajaran -->
                    <div>
                        <label for="tahun_ajaran" class="block text-gray-700 font-medium">Tahun Ajaran:</label>
                        <input type="text" id="tahun_ajaran" name="tahun_ajaran" value="{{ $tahunAjaranAktif }}" readonly
                            class="mt-1 block w-full border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-gray-100">
                    </div>

                    <!-- Bukti Pembayaran -->
                    <div>
                        <label for="bukti_pembayaran" class="block text-gray-700 font-medium">Bukti Pembayaran:</label>
                        <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*"
                            class="mt-1 block w-full border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <small class="text-gray-500">Upload JPG/PNG maksimal 2MB</small>

                        <!-- Preview -->
                        <div id="preview-container" class="mt-3 hidden">
                            <img id="preview-image" src="" alt="Preview" class="max-h-40 rounded border shadow">
                        </div>
                    </div>

                    <!-- Persetujuan -->
                    <div class="flex items-start">
                        <input type="checkbox" id="persetujuan" name="persetujuan" class="mt-1 mr-2" required>
                        <label for="persetujuan" class="text-gray-700">
                            Saya menyatakan bahwa data dan bukti pembayaran yang saya upload adalah benar dan dapat
                            dipertanggung jawabkan.
                        </label>
                    </div>

                    <!-- Submit -->
                    <div class="text-center">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg shadow">
                            <i class="fa fa-upload"></i> Submit Daftar Ulang
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <!-- Script Preview -->
    <script>
        document.getElementById('bukti_pembayaran')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('preview-image').src = ev.target.result;
                    document.getElementById('preview-container').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
