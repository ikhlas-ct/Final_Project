<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\FiturHelper;
use App\Helpers\AlertHelper;
use App\Models\Kaprodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class ProfileController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        // 
        if (FiturHelper::showKaprodi()) {
            $user = User::with('kaprodi.fakultas')->find($userId);
        }
        if (FiturHelper::showAdmin()) {
            $user = User::with('admin.fakultas')->find($userId);
        }
        if (FiturHelper::showDosen()) {
            $user = User::with('dosen.fakultas')->find($userId);
        }
        if (FiturHelper::showMahasiswa()) {
            $user =  User::with('mahasiswa.fakultas')->find($userId);
        }
        // 
        return view('pages.profile.index', compact('user'));
    }

    public function updateProfileKprd(Request $request)
    {
        $user = Auth::user();
        // Find the Mahasiswa record by the authenticated user's ID
        $kaprodi = Kaprodi::where('user_id', $user->id)->first();

        if ($request->hasFile('poto')) {
            $file = $request->file('poto');
            // Generate a custom file name
            $imageName = 'dosen-' . time() . '.' . $file->extension();

            // Move the file to the desired location
            $file->move(public_path('uploads/profile/dosen'), $imageName);
            // Optionally, delete the old image if it exists
            if (file_exists($kaprodi->poto)) {
                unlink($kaprodi->poto);
            }
            $kaprodi->poto = 'uploads/profile/dosen/' . $imageName;
        }

        $kaprodi->nama = $request->nama;
        $kaprodi->nidn = $request->nidn;
        $kaprodi->no_hp = $request->no_hp;

        $kaprodi->save();

        // Display success message
        AlertHelper::alertSuccess('Anda telah berhasil mengupdate profile', 'Selamat!', 2000);
        return redirect()->back();
    }

    public function updateProfileDsn(Request $request)
    {
        $user = Auth::user();
        // Find the Mahasiswa record by the authenticated user's ID
        $dosen = Dosen::where('user_id', $user->id)->first();

        if ($request->hasFile('poto')) {
            $file = $request->file('poto');
            // Generate a custom file name
            $imageName = 'dosen-' . time() . '.' . $file->extension();

            // Move the file to the desired location
            $file->move(public_path('uploads/profile/dosen'), $imageName);
            // Optionally, delete the old image if it exists
            if (file_exists($dosen->poto)) {
                unlink($dosen->poto);
            }
            $dosen->poto = 'uploads/profile/dosen/' . $imageName;
        }

        $dosen->nama = $request->nama;
        $dosen->nidn = $request->nidn;
        $dosen->no_hp = $request->no_hp;

        $dosen->save();

        // Display success message
        AlertHelper::alertSuccess('Anda telah berhasil mengupdate profile', 'Selamat!', 2000);
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
            if (file_exists($mahasiswa->poto)) {
                unlink($mahasiswa->poto);
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
