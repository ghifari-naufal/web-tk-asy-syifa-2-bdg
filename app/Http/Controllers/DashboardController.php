<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\DaftarUlang;
use App\Models\MonitoringPerkembangan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $data = [];

        // Jika Guru login, tampilkan data siswa yang sudah di-approve dan monitoring
        if ($user->role === ('Guru')) {
            $data['approvedSiswa'] = Pendaftaran::where('status', 'approved')->get();
            $data['monitoring'] = MonitoringPerkembangan::with('siswa')->latest()->get();
        }

        // return view('dashboard', $data);

        // Statistik Pendaftaran
        $totalPendaftar = Pendaftaran::count();
        $pendaftarApproved = Pendaftaran::where('status', 'approved')->count();
        $pendaftarPending = Pendaftaran::where('status', 'pending')->count();
        $pendaftarRejected = Pendaftaran::where('status', 'rejected')->count();

        // Statistik Users berdasarkan role - HANYA ORANGTUA YANG DIUBAH
        $totalUsers = User::count();
        $totalAdmin = User::role('Admin')->count();        // Admin tetap seperti semula
        $totalGuru = User::role('Guru')->count();          // Guru tetap seperti semula  
        $totalOrtu = User::role('orangtua')->count();      // HANYA INI yang diubah: orangtua (bukan "Orang Tua")

        // Statistik Daftar Ulang
        $totalDaftarUlang = DaftarUlang::count();
        $daftarUlangTahunIni = DaftarUlang::whereYear('tanggal_daftar', Carbon::now()->year)->count();
        
        // Total biaya daftar ulang yang terkumpul
        $totalBiayaDaftarUlang = DaftarUlang::sum('biaya_daftar_ulang');

        // Statistik Monitoring Perkembangan
        $totalMonitoring = MonitoringPerkembangan::count();
        $monitoringBulanIni = MonitoringPerkembangan::whereMonth('created_at', Carbon::now()->month)
                                                   ->whereYear('created_at', Carbon::now()->year)
                                                   ->count();

        // Statistik per kelas TK
        $statistikKelas = Pendaftaran::select('kelas_tk', DB::raw('count(*) as total'))
                                   ->where('status', 'approved')
                                   ->groupBy('kelas_tk')
                                   ->get();

        // Pendaftaran per bulan (6 bulan terakhir)
        $pendaftaranPerBulan = [];
        $labelBulan = [];
        for ($i = 5; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subMonths($i);
            $count = Pendaftaran::whereYear('created_at', $tanggal->year)
                               ->whereMonth('created_at', $tanggal->month)
                               ->count();
            $pendaftaranPerBulan[] = $count;
            $labelBulan[] = $tanggal->format('M Y');
        }

        // Monitoring perkembangan per guru
        $monitoringPerGuru = MonitoringPerkembangan::with('Guru')
                                                  ->select('guru_id', DB::raw('count(*) as total'))
                                                  ->groupBy('guru_id')
                                                  ->orderByDesc('total')
                                                  ->limit(5)
                                                  ->get();

        // Daftar ulang per bulan tahun ini
        $daftarUlangPerBulan = [];
        $labelBulanDaftarUlang = [];
        for ($i = 1; $i <= 12; $i++) {
            $count = DaftarUlang::whereYear('tanggal_daftar', Carbon::now()->year)
                               ->whereMonth('tanggal_daftar', $i)
                               ->count();
            $daftarUlangPerBulan[] = $count;
            $labelBulanDaftarUlang[] = Carbon::create()->month($i)->format('M');
        }

        // Recent activities (5 aktivitas terakhir)
        $recentPendaftaran = Pendaftaran::with('user')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(5)
                                       ->get();

        $recentMonitoring = MonitoringPerkembangan::with(['Guru', 'pendaftaran'])
                                                 ->orderBy('created_at', 'desc')
                                                 ->limit(5)
                                                 ->get();

        $recentDaftarUlang = DaftarUlang::with('user')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(5)
                                       ->get();

        // Progress rate
        $approvalRate = $totalPendaftar > 0 ? round(($pendaftarApproved / $totalPendaftar) * 100, 1) : 0;
        $rejectionRate = $totalPendaftar > 0 ? round(($pendaftarRejected / $totalPendaftar) * 100, 1) : 0;

        return view('dashboard', compact(
            // Statistik utama
            'totalPendaftar', 'pendaftarApproved', 'pendaftarPending', 'pendaftarRejected',
            'totalUsers', 'totalAdmin', 'totalGuru', 'totalOrtu',
            'totalDaftarUlang', 'daftarUlangTahunIni', 'totalBiayaDaftarUlang',
            'totalMonitoring', 'monitoringBulanIni',
            
            // Recent activities
            'recentPendaftaran', 'recentMonitoring', 'recentDaftarUlang',
            
            // Progress rates
            'approvalRate', 'rejectionRate',

            $data
        ));
    }
}