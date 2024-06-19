<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Pengajuan;
use App\Models\Mahasiswa;

class PdfController extends Controller
{
    public function generatePDF($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $nama = $mahasiswa->nama;
        $nim = $mahasiswa->nim;

        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.bimbinganp1' => function ($query) {
                $query->where('status', 'selesai')->with('logbookB1');
            },
            'judulFinal.pembimbing2.bimbinganp2' => function ($query) {
                $query->where('status', 'selesai')->with('logbookB2');
            }
        ])->where('id', $id)->get();
        $dataBimbingan1 = [];
        foreach ($pengajuan as $item) {
            $namaDosen = $item->judulFinal->pembimbing1->dosen->nama;
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
                        "id" => $bimbinganP1->id,
                        "type" => 1,
                        "nama_dosen" => $namaDosen,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "status" => $bimbinganP1->status,
                        'logbook' => $logbook,
                    ];
                }
            }
        }
        $dataBimbingan2 = [];
        foreach ($pengajuan as $item) {
            $namaDosen = $item->judulFinal->pembimbing2->dosen->nama;
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
                        "id" => $bimbinganP2->id,
                        "type" => 2,
                        "nama_dosen" => $namaDosen,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "status" => $bimbinganP2->status,
                        'logbook' => $logbook,
                    ];
                }
            }
        }

        // Gabungkan kedua array menjadi satu
        $mergeData = array_merge($dataBimbingan1, $dataBimbingan2);
        usort($mergeData, function ($a, $b) {
            return strtotime($a['tanggal_bimbingan']) <=> strtotime($b['tanggal_bimbingan']);
        });




        // Render view ke HTML
        $html = view('pages.pdf.document', ['mergeData' => $mergeData, 'nama' => $nama, 'nim' => $nim])->render();

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // (Opsional) Atur opsi seperti ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Simpan PDF atau tampilkan dalam browser
        return $dompdf->stream('logbook' . '-' . $nama . '-' .  $nim);
    }
}
