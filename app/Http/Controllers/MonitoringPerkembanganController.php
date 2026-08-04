<?php

namespace App\Http\Controllers;

use App\Models\MonitoringPerkembangan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MonitoringPerkembanganController extends Controller
{

    function __construct()
    {
        // $this->middleware('permission:perkembangan-list|perkembangan-create|perkembangan-edit|perkembangan-delete', ['only' => ['index', 'show']]);
        // $this->middleware('permission:perkembangan-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:perkembangan-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:perkembangan-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:perkembangan-approve', ['only' => ['approve', 'reject']]);
    }

    public function index()
    {
        $user = Auth::user();
        $tahunAjaranAktif = date('Y') . '/' . (date('Y') + 1);

        // Hanya orang tua yang wajib daftar ulang
        if ($user->role === 'orangtua') {
            $sudahDaftarUlang = \App\Models\DaftarUlang::where('user_id', $user->id)
                ->where('tahun_ajaran', $tahunAjaranAktif)
                ->exists();

            if (!$sudahDaftarUlang) {
                return redirect()->route('daftar-ulang.create')
                    ->with('error', 'Anda harus melakukan daftar ulang terlebih dahulu untuk mengakses halaman MONITORING PERKEMBANGAN.');
            }
        }

        // Ambil data perkembangan sesuai role
        if ($user->role === 'Guru') {
            $perkembangan = MonitoringPerkembangan::with(['pendaftaran', 'Guru'])
                ->where('guru_id', $user->id)
                ->latest()
                ->get();
        } elseif ($user->role === 'orangtua') {
            $pendaftaran = $user->pendaftaran;
            $perkembangan = $pendaftaran
                ? $pendaftaran->perkembangan()->with('guru')->latest()->get()
                : collect();
        } else { // Admin
            $perkembangan = MonitoringPerkembangan::with(['pendaftaran', 'Guru'])
                ->latest()
                ->get();
        }

        return view('monitoringperkembangan.index', compact('perkembangan'));
    }

    public function create(Request $request)
    {
        // ambil siswa yang sudah disetujui
        $pendaftaran = Pendaftaran::where('status', 'approved')->get();

        // ambil daftar kelas unik (bersih)
        $kelas = Pendaftaran::where('status', 'approved')
            ->pluck('kelas_tk')
            ->filter()   // buang null/empty
            ->unique()
            ->values();

        // ambil 10 data terbaru bersama relasi pendaftaran
        $riwayat = MonitoringPerkembangan::with('pendaftaran')
            ->latest()   // by created_at
            ->take(10)
            ->get();

        return view('monitoringperkembangan.create', compact('pendaftaran', 'kelas', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'kegiatan'       => 'required|string|max:255',
            'deskripsi'      => 'required|string|max:255',
            'foto'           => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            // simpan di storage/app/public/monitoring/foto
            $path = $request->file('foto')->store('monitoring/foto', 'public');
        }

        MonitoringPerkembangan::create([
            'pendaftaran_id' => $request->input('pendaftaran_id'),
            'guru_id'        => Auth::id(),                 // simpan guru yang menambahkan
            'kegiatan'       => $request->input('kegiatan'),
            'deskripsi'      => $request->input('deskripsi'),
            'foto'           => $path,
        ]);

        return redirect()->route('monitoringperkembangan.create')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $monitoring = MonitoringPerkembangan::findOrFail($id);

        // Ambil data siswa yang sudah approved
        $siswa = Pendaftaran::where('status', 'approved')->get();

        // Ambil kelas unik untuk filter
        $kelas = $siswa->pluck('kelas_tk')->unique()->sort()->values();

        return view('monitoringperkembangan.edit', compact('monitoring', 'siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        // $this->authorize('update', $perkembangan);

        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $monitoring = MonitoringPerkembangan::findOrFail($id);

        $data = $request->except('foto');

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($monitoring->foto) {
                Storage::disk('public')->delete($monitoring->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')->store('perkembangan', 'public');
        }

        $monitoring->update($data);

        return redirect()->route('monitoringperkembangan.index')->with('success', 'Data monitoring berhasil diperbarui');
    }


    public function destroy($id)
    {
        try {
            $perkembangan = MonitoringPerkembangan::findOrFail($id);

            // Hapus file foto jika ada
            if ($perkembangan->foto && Storage::disk('public')->exists($perkembangan->foto)) {
                Storage::disk('public')->delete($perkembangan->foto);
            }

            $perkembangan->delete();

            return redirect()->route('monitoringperkembangan.index')
                ->with('success', 'Data monitoring perkembangan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('monitoringperkembangan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $monitoring = MonitoringPerkembangan::with('pendaftaran')->findOrFail($id);

        return view('monitoringperkembangan.show', compact('monitoring'));
    }
}
