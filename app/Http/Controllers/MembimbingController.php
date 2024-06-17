<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\JudulFinal;
use App\Models\Pengajuan;

class MembimbingController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id; // Pastikan variabel $dosenId sudah didefinisikan dengan benar

        $dosenMembimbing = Dosen::with([
            'pembimbing1.bimbinganp1' => function ($query) {
                $query->orderByRaw('COALESCE(tanggal_reschedule, tanggal) DESC')->first();
            },
            'pembimbing2.bimbinganp2' => function ($query) {
                $query->orderByRaw('COALESCE(tanggal_reschedule, tanggal) DESC')->first();
            },
        ])
            ->where('id', $dosenId) // Filter by Dosen ID
            ->first();

        $dataPembimbing1 = [];
        foreach ($dosenMembimbing->pembimbing1 as $pembimbing1) {
            foreach ($pembimbing1->bimbinganp1 as $bimbingan) {
                $judulFinalId = $pembimbing1->judul_final_id;
                $judulFinal = JudulFinal::find($judulFinalId);
                $pengajuan = Pengajuan::with('mahasiswa')->find($judulFinal->pengajuan_id);

                $dataPembimbing1[] = [
                    'id' => $bimbingan->id,
                    'nama' => $pengajuan->mahasiswa->nama,
                    'judul' => $pengajuan->judul,
                    'tanggal' => $bimbingan->tanggal_reschedule ?? $bimbingan->tanggal,
                    'tanggal_reschedule' => $bimbingan->tanggal_reschedule,
                    'status' => $bimbingan->status,
                    'pembimbing' => '1',
                ];
            }
        }
        $dataPembimbing2 = [];
        foreach ($dosenMembimbing->pembimbing2 as $pembimbing2) {
            foreach ($pembimbing2->bimbinganp2 as $bimbingan) {
                $judulFinalId = $pembimbing2->judul_final_id;
                $judulFinal = JudulFinal::find($judulFinalId);
                $pengajuan = Pengajuan::with('mahasiswa')->find($judulFinal->pengajuan_id);

                $dataPembimbing2[] = [
                    'id' => $bimbingan->id,
                    'nama' => $pengajuan->mahasiswa->nama,
                    'judul' => $pengajuan->judul,
                    'tanggal' => $bimbingan->tanggal_reschedule ?? $bimbingan->tanggal,
                    'tanggal_reschedule' => $bimbingan->tanggal_reschedule,
                    'status' => $bimbingan->status,
                    'pembimbing' => '2',
                ];
            }
        }
        // usort($array, function ($a, $b) {
        //     return strtotime($a['tanggal']) <=> strtotime($b['tanggal']);
        // });
        // Gabungkan kedua array menjadi satu
        $mergeData = array_merge($dataPembimbing1, $dataPembimbing2);

        usort($mergeData, function ($a, $b) {
            if (!empty($a['tanggal_reschedule']) && !empty($b['tanggal_reschedule'])) {
                $dateA = strtotime($a['tanggal_reschedule']);
                $dateB = strtotime($b['tanggal_reschedule']);
            } else {
                // Jika tanggal_reschedule kosong, gunakan tanggal
                $dateA = empty($a['tanggal_reschedule']) ? strtotime($a['tanggal']) : strtotime($a['tanggal_reschedule']);
                $dateB = empty($b['tanggal_reschedule']) ? strtotime($b['tanggal']) : strtotime($b['tanggal_reschedule']);
            }

            return $dateA <=> $dateB;
        });

        return view('pages.dosen.membimbing.index', compact('mergeData'));
    }
}
