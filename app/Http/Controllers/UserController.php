<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
// use DB;
// use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Ambil user beserta data pendaftaran
        $users = User::with('pendaftaran:id,user_id,nama_ortu,nama_anak,kelas_tk')->get(['id', 'name', 'email', 'role']);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function showChangePasswordForm(): View
    {
        return view('users.change-password');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'current_password' => ['required'],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'new_password.required'   => 'Password baru wajib diisi.',
            'new_password.min'        => 'Password baru minimal harus 8 karakter.',
            'new_password.confirmed'  => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
        }

        // Update password
        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah');
    }

    public function resetPasswordAuto($id)
    {
        $currentUser = Auth::user();

        // Hanya izinkan Admin atau Guru
        // Jika login sebagai Admin atau Guru, tolak akses
        if ($currentUser->role === 'Admin' || $currentUser->role === 'Guru') {
            abort(403, 'Anda tidak memiliki izin untuk mereset password.');
        }


        $user = User::with('pendaftaran')->findOrFail($id);

        // 1. generate password acak
        $plainPassword = Str::random(10);

        // 2. update password
        $user->password = Hash::make($plainPassword);
        $user->save();

        // 3. ambil no_hp dari pendaftaran
        $rawPhone = $user->pendaftaran->no_hp ?? null;
        $phoneForWa = null;

        if ($rawPhone) {
            $digits = preg_replace('/\D+/', '', $rawPhone);

            if (Str::startsWith($digits, '0')) {
                $digits = '62' . substr($digits, 1);
            }

            $phoneForWa = $digits;
        }

        // 4. siapkan pesan WA
        $message = "Halo {$user->name},\n"
            . "Password akun Anda telah direset oleh admin.\n\n"
            . "Email/Username: {$user->email}\n"
            . "Password baru: {$plainPassword}\n\n"
            . "Silakan login dan segera ganti password setelah berhasil masuk.";

        $waLink = $phoneForWa
            ? 'https://api.whatsapp.com/send?phone=' . $phoneForWa . '&text=' . rawurlencode($message)
            : null;

        // 5. kirim ke view reset-success
        return view('users.reset-success', [
            'user' => $user,
            'plainPassword' => $plainPassword,
            'waLink' => $waLink,
            'phoneForWa' => $phoneForWa,
            'rawPhone' => $rawPhone
        ]);
    }

    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function submitForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'no_hp' => 'required|string',
        ]);

        // Cari user berdasarkan email & no_hp (ambil no_hp dari tabel pendaftaran)
        $user = User::where('email', $request->email)
            ->whereHas('pendaftaran', function ($q) use ($request) {
                $q->where('no_hp', $request->no_hp);
            })
            ->with('pendaftaran')
            ->first();


        if (!$user) {
            return back()->withErrors(['email' => 'Email atau No HP tidak sesuai dengan data kami.']);
        }

        // Simpan ke tabel request
        DB::table('password_requests')->insert([
            'user_id' => $user->id,
            'email' => $user->email,
            'no_hp' => $user->pendaftaran->no_hp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Buat link WhatsApp untuk notifikasi admin
        $adminNumber = "6283197391975"; // ganti dengan nomor admin
        $message = "Halo Admin,\n\nAda permintaan *Reset Password* dari user:\n"
            . "Email/Username: {$user->email}\n"
            . "No HP: {$user->pendaftaran->no_hp}\n\n"
            . "Silakan proses di halaman Manage User.";
        $whatsappLink = "https://api.whatsapp.com/send?phone={$adminNumber}&text=" . urlencode($message);

        // Kirim feedback ke user + link WA untuk admin
        return back()->with([
            'success' => 'Permintaan reset password berhasil dikirim. Admin akan segera memproses.',
            'wa_link' => $whatsappLink,
        ]);
    }
}
