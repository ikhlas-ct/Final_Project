<?php

namespace App\Http\Controllers;

use App\Models\Judul;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Helpers\AlertHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:mahasiswa');
    }

    public function pilihPembimbing()
    {
        return view('pages.Mahasiswa.Pembimbing.pilihPembimbing');
    }

    public function tugasAkhir()
    {
        $tugasAkhir = Judul::all();
        return view('pages.Mahasiswa.TugasAkhir.tugasAkhir', compact('tugasAkhir'));
    }

    public function StoreTugasAkhir(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa->id;

        $request->validate([
            'judul' => 'required|string|max:255',
            'konsentrasi' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tugas-akhir'), $filename);
        }

        // Buat pengajuan baru
        $pengajuan = Pengajuan::create([
            'mahasiswa_id' => $mahasiswa,
        ]);

        // Buat judul baru terkait dengan pengajuan yang baru saja dibuat
        $judul = $pengajuan->Judul()->create([
            'judul' => $request->judul,
            'konsentrasi' => $request->konsentrasi,
            'file' => $filename,
            'status' => 'diproses',
        ]);

        return redirect()->route('tugasAkhir')->with('success', 'Tugas Akhir berhasil didaftarkan.');
    }

    public function konsul()
    {
        return view('pages.Mahasiswa.Konsultasi.konsultasi');
    }

    public function tgl_penting()
    {
        return view('pages.Mahasiswa.TanggalPenting.tanggal_penting');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'gambar' => 'sometimes|file|image|max:2048', // Allow image file optionally
            'nim' => 'required|string',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'alamat' => 'required|string',
            'fakultas' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')
                ->withErrors($validator)
                ->withInput();
        }

        // Find the Mahasiswa record by the authenticated user's ID
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Generate a custom file name
            $imageName = 'mahasiswa-' . time() . '.' . $file->extension();
            // Move the file to the desired location
            $file->move(public_path('uploads/profile/mahasiswa'), $imageName);
            // Optionally, delete the old image if it exists
            if (file_exists($mahasiswa->gambar)) {
                unlink($mahasiswa->gambar);
            }
            $mahasiswa->gambar = 'uploads/profile/mahasiswa/' . $imageName;
        }

        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->no_hp = $request->no_hp;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->fakultas = $request->fakultas;

        $mahasiswa->save();

        AlertHelper::alertSuccess('Anda telah berhasil mengupdate profile', 'Selamat!', 2000);

        return redirect()->back()->with('success', 'Profile updated successfully');
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
}
