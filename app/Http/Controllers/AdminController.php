<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Helpers\AlertHelper;
use App\Models\Fakultas;
use App\Models\Kaprodi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $admin = Auth::user()->admin;

        if ($request->hasFile('gambar')) {
            Log::info('Gambar ditemukan dalam request.');
            $profileImage = $request->file('gambar');
            $profileImageSaveAsName = time() . Auth::id() . "-profile." . $profileImage->getClientOriginalExtension();
            $upload_path = 'admin_images/';
            $profile_image_url = $upload_path . $profileImageSaveAsName;
            $profileImage->move(public_path($upload_path), $profileImageSaveAsName);
            Log::info('Gambar berhasil diunggah ke: ' . $profile_image_url);
            $admin->gambar = $profile_image_url;
        } else {
            Log::info('Gambar tidak ditemukan dalam request.');
        }

        $admin->nama = $request->nama;
        $admin->no_hp = $request->no_hp;
        $admin->alamat = $request->alamat;
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
     
    public function pengguna()
    {
        $users = User::with('mahasiswa', 'dosen', 'kaprodi')
             ->where('role', '!=', 'admin')
             ->get();
        $countMahasiswa = User::where('role', 'mahasiswa')->count();
        $countDosen = User::where('role', 'dosen')->count();
        $countKaprodi = User::where('role', 'kaprodi')->count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $fakultas = Fakultas::all();
        
        return view('pages.admin.adminuser', compact('users', 'countMahasiswa', 'countDosen', 'countKaprodi','totalUsers', 'fakultas'));
    }
    
    public function filterByRole($role)
    {
        $users = User::with('mahasiswa', 'dosen', 'kaprodi')->where('role', $role)->get();

        // Menghitung jumlah pengguna berdasarkan peran
        $countMahasiswa = User::where('role', 'mahasiswa')->count();
        $countDosen = User::where('role', 'dosen')->count();
        $countKaprodi = User::where('role', 'kaprodi')->count();
        $totalUsers = User::count();
        $fakultas = Fakultas::all();

        return view('pages.admin.adminuser', compact('users', 'countMahasiswa', 'countDosen', 'countKaprodi', 'role', 'totalUsers', 'fakultas'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function update_user(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string',
            'fakultas' => 'required|exists:tb_fakultas,id', // Ensure fakultas exists
        ]);

        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Update username
        $user->username = $request->input('username');

        // Jika password diisi, update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Update Fakultas
        if ($user->role == 'mahasiswa') {
            $user->mahasiswa->fakultas_id = $request->input('fakultas');
            $user->mahasiswa->save();
        } elseif ($user->role == 'dosen') {
            $user->dosen->fakultas_id = $request->input('fakultas');
            $user->dosen->save();
        } elseif ($user->role == 'kaprodi') {
            $user->kaprodi->fakultas_id = $request->input('fakultas');
            $user->kaprodi->save();
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }
    
    public function tambah(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string',
            'fakultas' => 'required|exists:tb_fakultas,id',
            'role' => 'required|string|in:admin,mahasiswa,dosen,kaprodi',
        ]);
    
        // Buat user baru
        $user = new User();
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        $fakultas = $request->input('fakultas');
    
        // Simpan data tambahan berdasarkan role
        switch ($user->role) {
            case 'admin':
                Admin::create(['user_id' => $user->id]);
                break;
    
            case 'mahasiswa':
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'fakultas_id' => $fakultas,
                ]);
                break;
    
            case 'dosen':
                Dosen::create([
                    'user_id' => $user->id,
                    'fakultas_id' => $fakultas,
                ]);
                break;
    
            case 'kaprodi':
                Kaprodi::create([
                    'user_id' => $user->id,
                    'fakultas_id' => $fakultas,
                ]);
                break;
        }
    
        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
    
    // falkutas 
    
    // Method untuk menampilkan daftar fakultas
    public function index_fakultas()
    {
        $fakultas = Fakultas::all();
        return view('pages.admin.fakultas', compact('fakultas'));
    }

    // Method untuk menyimpan data fakultas baru
    public function store_fakultas(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:tb_fakultas,nama',
        ], [
            'nama.required' => 'Error! Nama fakultas harus diisi.',
            'nama.string' => 'Error! Nama fakultas harus berupa teks.',
            'nama.max' => 'Error! Nama fakultas maksimal :max karakter.',
            'nama.unique' => 'Error! Nama fakultas sudah ada.',
        ]);

        // Jika validasi gagal, kembalikan dengan pesan error
        if ($validator->fails()) {
            return redirect()->route('fakultas.index')
                                ->withErrors($validator)
                                ->withInput();
        }

        // Buat objek fakultas dan simpan ke dalam database
        $fakultas = new Fakultas();
        $fakultas->nama = $request->nama;
        $fakultas->save();

        // Redirect dengan pesan sukses jika berhasil
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    // Method untuk mengupdate data fakultas
    public function update_fakultas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $fakultas = Fakultas::findOrFail($id);
        $fakultas->nama = $request->nama;
        $fakultas->save();

        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diupdate.');
    }
    
    public function edit_fakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        return view('pages.admin.fakultasedit', compact('fakultas'));
    }
    
    // Method untuk menghapus data fakultas
    public function destroy_fakultas($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil di delete.');
    }   
}