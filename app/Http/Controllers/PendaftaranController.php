<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:pendaftaran-list|pendaftaran-create|pendaftaran-edit|pendaftaran-delete', ['only' => ['index', 'show']]);
        //  $this->middleware('permission:pendaftaran-create', ['only' => ['create','store']]);
        $this->middleware('permission:pendaftaran-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pendaftaran-delete', ['only' => ['destroy']]);
        $this->middleware('permission:pendaftaran-approve', ['only' => ['approve', 'reject']]);
    }

    public function index(Request $request)
    {
        $query = Pendaftaran::latest();

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kelas
        if ($request->has('kelas') && $request->kelas != '') {
            $query->where('kelas_tk', $request->kelas);
        }

        // Search berdasarkan nama
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_anak', 'like', '%' . $request->search . '%')
                    ->orWhere('nama_ortu', 'like', '%' . $request->search . '%');
            });
        }

        $pendaftarans = $query->paginate(10);
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        // Format nomor HP
        $no_hp = preg_replace('/\D/', '', $request->no_hp); // Hapus non-digit
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '62' . substr($no_hp, 1); // Ganti 0 dengan 62
        }
        $request->merge(['no_hp' => $no_hp]);

        // Validasi
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'no_hp' => 'required|string|starts_with:62|min:10',
            'nama_anak' => 'required|string|max:255',
            'kelas_tk' => 'required|in:TK A,TK B',
            'file_title' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:20480|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp',
            'dokumen_persyaratan_title' => 'nullable|string|max:255',
            'dokumen_persyaratan' => 'required|file|max:20480|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp'
        ], [
            'file.required' => 'Bukti pembayaran wajib diunggah.',
            'dokumen_persyaratan.required' => 'Dokumen persyaratan (KK, Akta, KTP) wajib diunggah.',
            // 'dokumen_persyaratan.mimes' => 'Format dokumen persyaratan harus PDF, Word, atau gambar.',
            'dokumen_persyaratan.max' => 'Ukuran dokumen persyaratan maksimal 20MB.'
        ]);

        // Persiapan data untuk disimpan
        $data = $request->only(['nama_ortu', 'no_hp', 'nama_anak', 'kelas_tk']);

        // Proses upload file bukti pembayaran wajib
        if ($request->hasFile('file')) {
            $fileData = $this->processFileUpload($request->file('file'), 'pendaftaran');
            $data = array_merge($data, [
                'file_title' => $request->file_title ?: $fileData['original_name'],
                'file_path' => $fileData['file_path'],
                'file_type' => $fileData['file_type'],
                'file_size' => $fileData['file_size']
            ]);
        }

        // Proses upload dokumen persyaratan (WAJIB)
        if ($request->hasFile('dokumen_persyaratan')) {
            $dokumenData = $this->processFileUpload($request->file('dokumen_persyaratan'), 'pendaftaran/persyaratan');
            $data = array_merge($data, [
                'dokumen_persyaratan_title' => $request->dokumen_persyaratan_title ?: $dokumenData['original_name'],
                'dokumen_persyaratan_path' => $dokumenData['file_path'],
                'dokumen_persyaratan_type' => $dokumenData['file_type'],
                'dokumen_persyaratan_size' => $dokumenData['file_size']
            ]);
        }

        // Simpan ke database
        Pendaftaran::create($data);

        return redirect()->route('pendaftaran.create')->with('success', 'Pendaftaran berhasil disimpan! Data Anda akan segera diproses.');
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        // Format nomor HP jika ada
        if ($request->filled('no_hp')) {
            $no_hp = preg_replace('/\D/', '', $request->no_hp); // Hapus non-digit
            if (substr($no_hp, 0, 1) === '0') {
                $no_hp = '62' . substr($no_hp, 1); // Ganti 0 dengan 62
            }
            $request->merge(['no_hp' => $no_hp]);
        }

        // Validasi - dinamis berdasarkan role user
        $rules = [
            'nama_ortu' => 'required|string|max:255',
            'no_hp' => 'required|string|min:10',
            'nama_anak' => 'required|string|max:255',
            'kelas_tk' => 'required|in:TK A,TK B',
            'file_title' => 'nullable|string|max:255',
            'file' => 'nullable|file|max:20480|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp',
            'dokumen_persyaratan_title' => 'nullable|string|max:255',
            'dokumen_persyaratan' => 'nullable|file|max:20480|mimes:pdf,doc,docx,jpg,jpeg,png,gif,bmp,webp'
        ];

        $messages = [
            'no_hp.min' => 'Nomor HP minimal 10 digit.',
            'file.max' => 'Ukuran file maksimal 20MB.',
            'dokumen_persyaratan.max' => 'Ukuran dokumen persyaratan maksimal 20MB.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status tidak valid.'
        ];

        $request->validate($rules, $messages);

        // Persiapan data untuk update
        $data = $request->only(['nama_ortu', 'no_hp', 'nama_anak', 'kelas_tk']);

        // Proses upload file bukti pembayaran baru jika ada
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($pendaftaran->hasFile() && Storage::disk('public')->exists($pendaftaran->file_path)) {
                Storage::disk('public')->delete($pendaftaran->file_path);
            }

            $fileData = $this->processFileUpload($request->file('file'), 'pendaftaran');
            $data = array_merge($data, [
                'file_title' => $request->file_title ?: $fileData['original_name'],
                'file_path' => $fileData['file_path'],
                'file_type' => $fileData['file_type'],
                'file_size' => $fileData['file_size']
            ]);
        } elseif ($request->filled('file_title')) {
            // Update title file saja jika tidak ada file baru
            $data['file_title'] = $request->file_title;
        }

        // Proses upload dokumen persyaratan baru jika ada
        if ($request->hasFile('dokumen_persyaratan')) {
            // Hapus file lama jika ada
            if ($pendaftaran->hasDokumenPersyaratan() && Storage::disk('public')->exists($pendaftaran->dokumen_persyaratan_path)) {
                Storage::disk('public')->delete($pendaftaran->dokumen_persyaratan_path);
            }

            $dokumenData = $this->processFileUpload($request->file('dokumen_persyaratan'), 'pendaftaran/persyaratan');
            $data = array_merge($data, [
                'dokumen_persyaratan_title' => $request->dokumen_persyaratan_title ?: $dokumenData['original_name'],
                'dokumen_persyaratan_path' => $dokumenData['file_path'],
                'dokumen_persyaratan_type' => $dokumenData['file_type'],
                'dokumen_persyaratan_size' => $dokumenData['file_size']
            ]);
        } elseif ($request->filled('dokumen_persyaratan_title')) {
            // Update title dokumen persyaratan saja jika tidak ada file baru
            $data['dokumen_persyaratan_title'] = $request->dokumen_persyaratan_title;
        }

        // Update data
        $pendaftaran->update($data);

        // Jika status diubah menjadi approved dan belum ada user
        if (isset($data['status']) && $data['status'] === 'approved' && !$pendaftaran->user_id) {
            $this->createUserForApprovedPendaftaran($pendaftaran);
        }

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran ' . $pendaftaran->nama_anak . ' berhasil diperbarui!');
    }


    // Helper method untuk memproses upload file
    private function processFileUpload($file, $baseFolder)
    {
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension()); // Pastikan lowercase
        $fileSize = $file->getSize();

        // Generate unique filename dengan ekstensi asli
        $filename = time() . '_' . Str::random(10) . '.' . $extension;

        // Tentukan tipe file dan folder
        $fileType = $this->determineFileType($extension);
        $folder = $baseFolder . '/' . $this->getFolderByType($fileType);

        // Simpan file dengan nama yang sudah include ekstensi
        $filePath = $file->storeAs($folder, $filename, 'public');

        return [
            'original_name' => $originalName,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'extension' => $extension // Tambahan untuk debugging
        ];
    }

    // Approve pendaftaran
    public function approve($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update status
        $pendaftaran->status = 'approved';

        // Cek apakah user sudah ada
        if (!$pendaftaran->user_id) {
            // Generate email dan password
            $slug = Str::slug($pendaftaran->nama_anak);
            $email = $slug . rand(10, 99);
            $passwordPlain = Str::random(8);

            // Buat user baru
            $user = User::create([
                'name' => $pendaftaran->nama_anak,
                'email' => $email,
                'password' => Hash::make($passwordPlain),
                'role' => 'orangtua',
            ]);

            // Simpan relasi dan informasi login ke tabel pendaftarans (tambahkan kolom jika belum)
            $pendaftaran->user_id = $user->id;
            $pendaftaran->roles = 'orangtua';
            $pendaftaran->email_login = $email;
            $pendaftaran->password_login = $passwordPlain; // Simpan plain untuk sementara
        }

        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran telah disetujui dan akun telah dibuat.');
    }

    // Reject pendaftaran
    public function reject(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'catatan' => 'required|string',
        ], [
            'catatan.required' => 'Alasan penolakan wajib diisi'
        ]);

        $pendaftaran->update([
            'status' => 'rejected',
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran ' . $pendaftaran->nama_anak . ' telah ditolak.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        // Hapus file bukti pembayaran jika ada
        if ($pendaftaran->hasFile() && Storage::disk('public')->exists($pendaftaran->file_path)) {
            Storage::disk('public')->delete($pendaftaran->file_path);
        }

        // Hapus dokumen persyaratan jika ada
        if ($pendaftaran->hasDokumenPersyaratan() && Storage::disk('public')->exists($pendaftaran->dokumen_persyaratan_path)) {
            Storage::disk('public')->delete($pendaftaran->dokumen_persyaratan_path);
        }

        // Hapus record
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus!');
    }

    // Download file dokumen
    public function downloadFile($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if (!$pendaftaran->hasFile()) {
            return back()->with('error', 'File tidak tersedia');
        }

        $filePath = storage_path('app/public/' . $pendaftaran->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        // Dapatkan ekstensi dari file_path yang tersimpan
        $originalExtension = pathinfo($pendaftaran->file_path, PATHINFO_EXTENSION);

        // Buat nama file download dengan ekstensi asli
        $downloadName = $pendaftaran->file_title;

        // Pastikan nama file memiliki ekstensi
        if (!pathinfo($downloadName, PATHINFO_EXTENSION)) {
            $downloadName .= '.' . $originalExtension;
        }

        // Set content-type berdasarkan ekstensi
        $mimeType = $this->getMimeType($originalExtension);

        return response()->download($filePath, $downloadName, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"'
        ]);
    }

    // Download dokumen persyaratan
    public function downloadDokumenPersyaratan($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if (!$pendaftaran->hasDokumenPersyaratan()) {
            return back()->with('error', 'Dokumen persyaratan tidak tersedia');
        }

        $filePath = storage_path('app/public/' . $pendaftaran->dokumen_persyaratan_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'Dokumen persyaratan tidak ditemukan');
        }

        // Dapatkan ekstensi dari dokumen_persyaratan_path yang tersimpan
        $originalExtension = pathinfo($pendaftaran->dokumen_persyaratan_path, PATHINFO_EXTENSION);

        // Buat nama file download dengan ekstensi asli
        $downloadName = $pendaftaran->dokumen_persyaratan_title;

        // Pastikan nama file memiliki ekstensi
        if (!pathinfo($downloadName, PATHINFO_EXTENSION)) {
            $downloadName .= '.' . $originalExtension;
        }

        // Set content-type berdasarkan ekstensi
        $mimeType = $this->getMimeType($originalExtension);

        return response()->download($filePath, $downloadName, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"'
        ]);
    }

    // View file dokumen
    public function viewFile($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if (!$pendaftaran->hasFile()) {
            return back()->with('error', 'File tidak tersedia');
        }

        $filePath = storage_path('app/public/' . $pendaftaran->file_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        // Dapatkan ekstensi dan mime type
        $originalExtension = pathinfo($pendaftaran->file_path, PATHINFO_EXTENSION);
        $mimeType = $this->getMimeType($originalExtension);

        // Untuk image dan PDF bisa langsung di-view
        if ($pendaftaran->isImage() || $pendaftaran->isPdf()) {
            return response()->file($filePath, [
                'Content-Type' => $mimeType
            ]);
        }

        // Untuk file lain, redirect ke download
        return $this->downloadFile($id);
    }

    // View dokumen persyaratan
    public function viewDokumenPersyaratan($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        if (!$pendaftaran->hasDokumenPersyaratan()) {
            return back()->with('error', 'Dokumen persyaratan tidak tersedia');
        }

        $filePath = storage_path('app/public/' . $pendaftaran->dokumen_persyaratan_path);

        if (!file_exists($filePath)) {
            return back()->with('error', 'Dokumen persyaratan tidak ditemukan');
        }

        // Dapatkan ekstensi dan mime type
        $originalExtension = pathinfo($pendaftaran->dokumen_persyaratan_path, PATHINFO_EXTENSION);
        $mimeType = $this->getMimeType($originalExtension);

        // Untuk image dan PDF bisa langsung di-view
        if ($pendaftaran->isDokumenPersyaratanImage() || $pendaftaran->isDokumenPersyaratanPdf()) {
            return response()->file($filePath, [
                'Content-Type' => $mimeType
            ]);
        }

        // Untuk file lain, redirect ke download
        return $this->downloadDokumenPersyaratan($id);
    }

    // Helper method untuk mendapatkan MIME type berdasarkan ekstensi
    private function getMimeType($extension)
    {
        $extension = strtolower($extension);

        $mimeTypes = [
            // Images
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',

            // Documents
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'txt' => 'text/plain',

            // Default
            'default' => 'application/octet-stream'
        ];

        return $mimeTypes[$extension] ?? $mimeTypes['default'];
    }

    private function determineFileType($extension)
    {
        $extension = strtolower($extension);

        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp', 'svg'];
        $documentTypes = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'];

        if (in_array($extension, $imageTypes)) {
            return 'image';
        } elseif (in_array($extension, $documentTypes)) {
            return 'document';
        } else {
            return 'other';
        }
    }

    // Helper method untuk menentukan folder berdasarkan tipe
    private function getFolderByType($fileType)
    {
        switch ($fileType) {
            case 'pdf':
                return 'pdfs';
            case 'image':
                return 'images';
            case 'word':
                return 'documents';
            default:
                return 'others';
        }
    }
}
