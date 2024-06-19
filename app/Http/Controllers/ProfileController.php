<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\FiturHelper;
use App\Models\Mahasiswa;
use App\Helpers\AlertHelper;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        // 
        $user = FiturHelper::showKaprodi()
            ? User::with('kaprodi.fakultas')->find($userId)
            : User::with('mahasiswa.fakultas')->find($userId);
        // 
        return view('pages.profile.index', compact('user'));
    }

    public function updateProdi(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'gambar' => 'sometimes|file|image|max:2048',
            'nama' => 'required|string',
            'nidn' => 'required|string',
            'departemen' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Find the Prodi record by the authenticated user's ID
        $prodi = Prodi::where('user_id', $user->id)->first();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Generate a custom file name
            $imageName = 'kaprodi-' . time() . '.' . $file->extension();

            // Move the file to the desired location
            $file->move(public_path('uploads/profile/kaprodi'), $imageName);
            // Optionally, delete the old image if it exists
            if (file_exists($prodi->gambar)) {
                unlink($prodi->gambar);
            }
            $prodi->gambar = 'uploads/profile/kaprodi/' . $imageName;
        }

        // Update the Prodi record with new data
        $prodi->nama = $request->nama;
        $prodi->nidn = $request->nidn;
        $prodi->departemen = $request->departemen;
        $prodi->no_hp = $request->no_hp;
        $prodi->alamat = $request->alamat;
        $prodi->save();

        // Display success message
        AlertHelper::alertSuccess('Anda telah berhasil mengupdate profile', 'Selamat!', 2000);
        return redirect()->back();
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password_lama' => 'required',
            'password_baru' => 'required|confirmed',
            'password_baru_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Lanjutkan dengan logika untuk mengganti password di sini
        // Misalnya, periksa apakah password lama cocok, lalu ganti password

        // Contoh pengecekan password lama dan pembaruan password
        $user = auth()->user(); // Asumsi user yang sedang login
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()
                ->withErrors(['password_lama' => 'Password lama tidak sesuai.'])
                ->withInput();
        }

        // Update password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        AlertHelper::alertSuccess('Anda telah berhasil mengupdate password', 'Selamat!', 2000);
        return redirect()->back();
    }

    public function updateProfileMhs(Request $request)
    {
        $user = Auth::user();



        // Find the Mahasiswa record by the authenticated user's ID
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($request->hasFile('poto')) {
            $file = $request->file('poto');
            // Generate a custom file name
            $imageName = 'mahasiswa-' . time() . '.' . $file->extension();

            // Move the file to the desired location
            $file->move(public_path('uploads/profile/mahasiswa'), $imageName);
            // Optionally, delete the old image if it exists
            if (file_exists($mahasiswa->gambar)) {
                unlink($mahasiswa->gambar);
            }
            $mahasiswa->poto = 'uploads/profile/mahasiswa/' . $imageName;
        }

        // Update the Mahasiswa record with new data
        $mahasiswa->nama = $request->nama;


        $mahasiswa->nim = $request->nim;
        $mahasiswa->no_hp = $request->no_hp;

        $mahasiswa->save();

        // Display success message
        AlertHelper::alertSuccess('Anda telah berhasil mengupdate profile', 'Selamat!', 2000);
        return redirect()->back();
    }
}
