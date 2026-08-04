<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarUlang;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DaftarUlangController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:daftar-ulang-list|daftar-ulang-create|daftar-ulang-edit|daftar-ulang-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:daftar-ulang-create', ['only' => ['create','store']]);
        $this->middleware('permission:daftar-ulang-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:daftar-ulang-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of daftar ulang
     */
    public function index(Request $request): View
    {
        $query = DaftarUlang::with('user');

        // Filter berdasarkan tahun ajaran
        if ($request->has('tahun_ajaran') && $request->tahun_ajaran != '') {
            $query->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $data = $query->latest()->paginate(10);
        
        // Get unique tahun ajaran for filter
        $tahunAjaranList = DaftarUlang::distinct()->pluck('tahun_ajaran');

        return view('daftar-ulang.index', compact('data', 'tahunAjaranList'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show form for creating new daftar ulang
     */
    public function create(): View
    {
        // Cek apakah user sudah daftar ulang untuk tahun ajaran aktif
        $tahunAjaranAktif = date('Y') . '/' . (date('Y') + 1);
        
        $sudahDaftar = DaftarUlang::where('user_id', Auth::id())
            ->where('tahun_ajaran', $tahunAjaranAktif)
            ->exists();

        return view('daftar-ulang.create', compact('sudahDaftar', 'tahunAjaranAktif'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'tahun_ajaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Cek apakah sudah pernah daftar ulang untuk tahun ajaran ini
        $existingDaftar = DaftarUlang::where('user_id', Auth::id())
            ->where('tahun_ajaran', $request->tahun_ajaran)
            ->first();

        if ($existingDaftar) {
            return back()->withErrors(['tahun_ajaran' => 'Anda sudah melakukan daftar ulang untuk tahun ajaran ini']);
        }

        // Upload bukti pembayaran
        $buktiPembayaran = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $buktiPembayaran = $file->storeAs('bukti-pembayaran', $filename, 'public');
        }

        // Create daftar ulang
        DaftarUlang::create([
            'user_id' => Auth::id(),
            'tahun_ajaran' => $request->tahun_ajaran,
            'biaya_daftar_ulang' => 500000, // Set default biaya atau bisa dinamis
            'bukti_pembayaran' => $buktiPembayaran,
            'tanggal_daftar' => now()
        ]);

        return redirect()->route('monitoringperkembangan.index')
            ->with('success', 'Daftar ulang berhasil disimpan');
    }

    public function show($id): View
    {
        $daftarUlang = DaftarUlang::with('user')->findOrFail($id);
        
        return view('daftar-ulang.show', compact('daftarUlang'));
    }

    public function edit($id): View
    {
        $daftarUlang = DaftarUlang::with('user')->findOrFail($id);
        
        return view('daftar-ulang.edit', compact('daftarUlang'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'tahun_ajaran' => 'required|string',
            'biaya_daftar_ulang' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $daftarUlang = DaftarUlang::findOrFail($id);
        
        // Handle file upload jika ada
        $buktiPembayaran = $daftarUlang->bukti_pembayaran;
        if ($request->hasFile('bukti_pembayaran')) {
            // Delete old file
            if ($buktiPembayaran) {
                Storage::disk('public')->delete($buktiPembayaran);
            }
            
            // Upload new file
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . $daftarUlang->user_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $buktiPembayaran = $file->storeAs('bukti-pembayaran', $filename, 'public');
        }

        $daftarUlang->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'biaya_daftar_ulang' => $request->biaya_daftar_ulang,
            'bukti_pembayaran' => $buktiPembayaran
        ]);

        return redirect()->route('daftar-ulang.index')
            ->with('success', 'Data daftar ulang berhasil diupdate');
    }

    /**
     * Delete daftar ulang
     */
    public function destroy($id): RedirectResponse
    {
        $daftarUlang = DaftarUlang::findOrFail($id);
        
        // Delete bukti pembayaran file
        if ($daftarUlang->bukti_pembayaran) {
            Storage::disk('public')->delete($daftarUlang->bukti_pembayaran);
        }
        
        $daftarUlang->delete();
        
        return redirect()->route('daftar-ulang.index')
            ->with('success', 'Data daftar ulang berhasil dihapus');
    }

    /**
     * My registration - untuk user melihat daftar ulang sendiri
     */
    public function myRegistration(): View
    {
        $daftarUlang = DaftarUlang::where('user_id', Auth::id())
            ->latest()
            ->paginate(5);

        return view('daftar-ulang.my-registration', compact('daftarUlang'));
    }
}