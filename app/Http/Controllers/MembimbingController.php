<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;

class MembimbingController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id; // Pastikan variabel $dosenId sudah didefinisikan dengan benar

        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.dosen.bimbingan' => function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            },
            'judulFinal.pembimbing2.dosen.bimbingan' => function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId);
            },
        ])->get();

        return view('pages.dosen.membimbing.index', compact('pengajuan'));
    }
}
