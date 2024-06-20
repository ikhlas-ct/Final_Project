<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Helpers\AlertHelper;

class BimbinganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswaId = $user->mahasiswa->id;
        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.dosen',
            'judulFinal.pembimbing1.bimbinganp1' => function ($query) {
                $query->orderBy('updated_at', 'desc')->with('logbookB1')->first();;
            },
            'judulFinal.pembimbing2.dosen',
            'judulFinal.pembimbing2.bimbinganp2' => function ($query) {
                $query->orderBy('updated_at', 'desc')->with('logbookB2')->first();;
            }
        ])->where('id', $mahasiswaId)->get();

        foreach ($pengajuan as $item) {
            if (empty($item->judulFinal) || empty($item->judulFinal->pembimbing1) || empty($item->judulFinal->pembimbing2)) {
                AlertHelper::alertError('Selesaikan pengajuan judul terlebih dahulu', 'Opsss!!', 3000);
                return redirect()->back();
            }
        }

        return view('pages.mahasiswa.bimbingan.index', compact('pengajuan'));
    }

    public function store(Request $request)
    {
        $modelClass = "App\\Models\\BimbinganP" . $request->type;
        $pembimbing = "pembimbing$request->type" . "_id";
        $modelClass::create([
            $pembimbing => $request->id,
            'tanggal' => $request->tanggal,
            'tanggal_reschedule' => NULL,
            'status' => 'diproses',
        ]);
    }

    public function update(Request $request, string $id)
    {
        $modelClass = "App\\Models\\BimbinganP" . $request->type;

        $bimbingan = $modelClass::findOrFail($id);

        if (isset($request->status)) {
            $bimbingan->status = $request->status;
        } elseif (isset($request->tanggal)) {
            $bimbingan->tanggal_reschedule = $request->tanggal;
        } else {
        }
        $bimbingan->save();
    }

    public function reschedule(Request $request, string $id)
    {
        Reschedule::create([
            'bimbingan_id' => $id,
            'tanggal' => $request->date,
        ]);
    }
}