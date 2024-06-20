<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;
use App\Models\JudulFinal;
use App\Models\Pengajuan;
use App\Models\Pembimbing1;
use App\Models\Pembimbing2;
use App\Helpers\AlertHelper;

class MembimbingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id; // Pastikan variabel $dosenId sudah didefinisikan dengan benar

        $dosenMembimbing = Dosen::with([
            'pembimbing1.bimbinganp1' => function ($query) {
                $query->orderBy('updated_at', 'desc')->first();
            },
            'pembimbing2.bimbinganp2' => function ($query) {
                $query->orderBy('updated_at', 'desc')->first();
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
                    'mahasiswa_id' => $pengajuan->mahasiswa->id,
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
                    'mahasiswa_id' => $pengajuan->mahasiswa->id,
                    'judul' => $pengajuan->judul,
                    'tanggal' => $bimbingan->tanggal_reschedule ?? $bimbingan->tanggal,
                    'tanggal_reschedule' => $bimbingan->tanggal_reschedule,
                    'status' => $bimbingan->status,
                    'pembimbing' => '2',
                ];
            }
        }

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
    
    public function show($id)
    {
        $parts = explode('.', $id);
        $mahasiswaId = $parts[0];
        $pembimbing = $parts[1];

        if ($pembimbing == 1) {
            $as = "P1";
        } else {
            $as = "P2";
        }

        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.bimbinganp1' => function ($query) {
                $query->where('status', 'selesai')->with('logbookB1');
            },
            'judulFinal.pembimbing2.bimbinganp2' => function ($query) {
                $query->where('status', 'selesai')->with('logbookB2');
            }
        ])->where('id', $mahasiswaId)->get();

        $dataBimbingan1 = [];
        foreach ($pengajuan as $item) {
            $pembimbingP1 = $item->judulFinal->pembimbing1->id;
            $namaDosen = $item->judulFinal->pembimbing1->dosen->nama;
            $noTelp = $item->judulFinal->pembimbing1->dosen->no_hp;
            $namaMahasiswa = $item->mahasiswa->nama;
            $tema = $item->tema->nama;
            $judul = $item->judul;
            // Status
            $status = $item->judulFinal->pembimbing1->status;
            foreach ($item->judulFinal->pembimbing1->bimbinganp1 as $bimbinganP1) {
                $logbook = [];
                foreach ($bimbinganP1->logbookB1 as $logbookB1) {
                    $logbook[] = [
                        "id" => $logbookB1->id,
                        "kegiatan" => $logbookB1->kegiatan,
                        "detail_kegiatan" => $logbookB1->detail_kegiatan
                    ];
                }
                // Tentukan tanggal bimbingan
                $tanggalBimbingan = $bimbinganP1->tanggal_reschedule ? $bimbinganP1->tanggal_reschedule : $bimbinganP1->tanggal;
                // Pastikan tanggal bimbingan tidak kosong
                if (!empty($tanggalBimbingan)) {
                    $dataBimbingan1[] = [
                        "p1_id" => $pembimbingP1,
                        "p1_status" => $status,
                        "dosen_p1" => $namaDosen,
                        "dosen_p1_no" => $noTelp,
                        "nama_mahasiswa" => $namaMahasiswa,
                        "tema" => $tema,
                        "judul" => $judul,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "logbook" => $logbook,
                        "type1" => $as,
                        "type2" => 'P1',
                    ];
                }
            }
        }

        $dataBimbingan2 = [];

        foreach ($pengajuan as $item) {
            $pembimbingP2 = $item->judulFinal->pembimbing2->id;
            $namaDosen = $item->judulFinal->pembimbing2->dosen->nama;
            $noTelp = $item->judulFinal->pembimbing2->dosen->no_hp;
            $namaMahasiswa = $item->mahasiswa->nama;
            $tema = $item->tema->nama;
            $judul = $item->judul;
            // Status
            $status = $item->judulFinal->pembimbing2->status;
            foreach ($item->judulFinal->pembimbing2->bimbinganp2 as $bimbinganP2) {
                $logbook = [];
                foreach ($bimbinganP2->logbookB2 as $logbookB2) {
                    $logbook[] = [
                        "id" => $logbookB2->id,
                        "kegiatan" => $logbookB2->kegiatan,
                        "detail_kegiatan" => $logbookB2->detail_kegiatan
                    ];
                }
                // Tentukan tanggal bimbingan
                $tanggalBimbingan = $bimbinganP2->tanggal_reschedule ? $bimbinganP2->tanggal_reschedule : $bimbinganP2->tanggal;
                // Pastikan tanggal bimbingan tidak kosong
                if (!empty($tanggalBimbingan)) {
                    $dataBimbingan2[] = [
                        "p2_id" => $pembimbingP2,
                        "p2_status" => $status,
                        "dosen_p2" => $namaDosen,
                        "dosen_p2_no" => $noTelp,
                        "nama_mahasiswa" => $namaMahasiswa,
                        "tema" => $tema,
                        "judul" => $judul,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "logbook" => $logbook,
                        "type1" => $as,
                        "type2" => 'P2',
                    ];
                }
            }
        }
        $mergeData = array_merge($dataBimbingan1, $dataBimbingan2);
        usort($mergeData, function ($a, $b) {
            return strtotime($a['tanggal_bimbingan']) <=> strtotime($b['tanggal_bimbingan']);
        });
        $dosen_p1 = null;
        $totalBimbinganP1 = 0;
        $totalBimbinganP2 = 0;
        $dosen_p2 = null;
        $pembimbingId = "";
        $status_p1 = "";
        $status_p2 = "";
        foreach ($mergeData as $item) {
            if (isset($item['dosen_p1'])) {
                $status_p1 = $item['p1_status'];
                $dosen_p1 = $item['dosen_p1'];
                $totalBimbinganP1++;
                // Asumsikan bahwa 'p1_id' dapat ada pada indeks ini
                if ($pembimbing == 1) {
                    $pembimbingId = isset($item['p1_id']) ? $item['p1_id'] . '.1' : '';
                }
            }
            if (isset($item['dosen_p2'])) {
                $status_p2 = $item['p2_status'];
                $dosen_p2 = $item['dosen_p2'];
                $totalBimbinganP2++;
                // Asumsikan bahwa 'p2_id' dapat ada pada indeks ini
                if ($pembimbing == 2) {
                    $pembimbingId = isset($item['p2_id']) ? $item['p2_id'] . '.2' : '';
                }
            }
        }
        
        if (empty($pembimbingId)) {
            AlertHelper::alertError('Mahasiswa terkait belum melakukan sesi bimbingan apa pun.', 'Opsss!!', 3000);
            return redirect()->back();
        }
        return view('pages.dosen.membimbing.show', compact('mergeData', 'as', 'dosen_p1', 'totalBimbinganP1', 'dosen_p2', 'totalBimbinganP2', 'pembimbingId', 'status_p1', 'status_p2'));
    }

    public function update($id)
    {
        $parts = explode('.', $id);
        $pembimbingId = $parts[0];
        $pembimbing = $parts[1];

        if ($pembimbing == 1) {
            $statusNull = Pembimbing1::find($pembimbingId);
        } else {
            $statusNull = Pembimbing2::find($pembimbingId);
            echo $pembimbing;
        }
        $statusNull->status = 'selesai';
        $statusNull->save();
        return redirect()->route('membimbing');
    }
}