<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()   
     */
    public function index(): View
    {
        return view('login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Jika role dari tabel user adalah 'orangtua'
            if ($user->role == 'orangtua') {
                return redirect()->route('monitoringperkembangan.index')
                    ->withSuccess('Selamat datang! Anda berhasil masuk ke sistem monitoring perkembangan.');
            }

            // Jika user punya role 'Guru' dari Spatie Permission
            if ($user->hasRole('Guru')) {
                return redirect()->route('monitoringperkembangan.index')
                    ->withSuccess('Halo Guru, selamat datang di sistem monitoring perkembangan.');
            }

            // Default redirect untuk role lain
            return redirect()->intended('dashboard')
                ->withSuccess('You have Successfully logged in');
        }


        return redirect("login")->withError('Opps! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        return $this->noCache(response()->view('dashboard'));
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => FacadesHash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        FacadesSession::flush();
        Auth::logout();

        return redirect()->route('landingpage')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 01 Jan 1990 00:00:00 GMT',
        ]);
    }
}
