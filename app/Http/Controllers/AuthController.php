<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login_identity' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['nim_nip' => $credentials['login_identity'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            $role = Auth::user()->role;
            if ($role === 'dosen') {
                return redirect()->intended('/dosen/dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->intended('/mahasiswa/dashboard');
            } elseif ($role === 'wd3') {
                return redirect()->intended('/wd3/dashboard');
            } elseif ($role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
        }
        return back()->withErrors([
            'login_identity' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
        ])->onlyInput('login_identity');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showRegistrationForm()
    {
        $dosens = User::where('role', 'dosen')->get();
        return view('register', compact('dosens'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim_nip' => ['required', 'string', 'regex:/^[0-9]+$/', 'unique:users,nim_nip'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'no_whatsapp' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:15'],
            'program_studi' => ['required', 'string', 'in:kimia,fisika,biologi,matematika,farmasi,informatika'],
            'angkatan' => ['required', 'integer', 'min:2000', 'max:' . (date('Y') + 1)],
            'dosen_pa_id' => ['required', 'exists:users,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'nim_nip.regex' => 'NIM hanya boleh berisi angka.',
            'nim_nip.unique' => 'NIM ini sudah terdaftar.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_whatsapp.regex' => 'No WhatsApp hanya boleh berisi angka.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'program_studi.in' => 'Program Studi tidak valid.',
        ]);

        // Pastikan dosen_pa_id yang dipilih memang memiliki role dosen
        $dosen = User::where('id', $request->dosen_pa_id)->where('role', 'dosen')->first();
        if (!$dosen) {
            return back()->withErrors(['dosen_pa_id' => 'Dosen PA yang dipilih tidak valid.'])->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'nim_nip' => $request->nim_nip,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'role' => 'mahasiswa',
            'password' => Hash::make($request->password),
            'program_studi' => $request->program_studi,
            'angkatan' => $request->angkatan,
            'dosen_pa_id' => $request->dosen_pa_id,
        ]);

        Auth::login($user);

        return redirect('/mahasiswa/dashboard');
    }
}