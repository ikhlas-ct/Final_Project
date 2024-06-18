<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\Tema;
use App\Models\ListPembimbing;
use App\Models\StatusPengajuan;
use App\Models\JudulFinal;
use App\Models\Pembimbing2;
use App\Helpers\AlertHelper;

use function Laravel\Prompts\alert;

class TugasAkhirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswaId = $user->mahasiswa->id;
        $pengajuan = Pengajuan::with([
            'tema',
            'listPembimbing',
            'statusPengajuan.dosen',
            'judulFinal',
            'judulFinal.pembimbing1.dosen',
            'judulFinal.pembimbing2.dosen'
        ])->where('mahasiswa_id', $mahasiswaId)->get();
        return view('pages.mahasiswa.tugas_akhir.index', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $user = Auth::user();
        // $userFakultasId = $user->mahasiswa->fakultas_id;
        // $tema = Tema::where('fakultas_id', $userFakultasId)->get();
        $tema = Tema::with('fakultas')->get();
        return view('pages.mahasiswa.tugas_akhir.create', compact('tema'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa->id;

        $request->validate([
            'tema' => 'required',
            'judul' => 'required|string|max:255',
            'proposal' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('proposal')) {
            $proposal = $request->file('proposal');
            $proposalName = time() . '_' . $proposal->getClientOriginalName();
            $proposal->move(public_path('uploads/tugas-akhir/profosal'), $proposalName);
        }

        $pengajuan = Pengajuan::create([
            'mahasiswa_id' => $mahasiswa,
            'tema_id' => $request->tema,
            'judul' => $request->judul,
            'proposal' => $proposalName,

        ]);
        AlertHelper::alertSuccess('Anda telah berhasil mengajukan tugas akhir', 'Selamat!', 2000);
        return redirect()->route('tugasAkhir');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getData()
    {
        $user = Auth::user();
        $mahasiswaId = $user->mahasiswa->id;
        $pengajuan = Pengajuan::with([
            'tema',
            'listPembimbing',
            'statusPengajuan.dosen',
            'judulFinal',
            'judulFinal.pembimbing1.dosen',
            'judulFinal.pembimbing2.dosen'
        ])->where('mahasiswa_id', $mahasiswaId)->get();

        echo '<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th class="text-center" style="width: 3%">No</th>
            <th class="text-center" style="width: 17%">Tema</th>
            <th class="text-center" style="width: 40%">Judul</th>
            <th class="text-center" style="width: 40%">Keterangan</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($pengajuan as $key => $value) {
            $backgroundStyle = (
                !empty($value->listPembimbing) &&
                !empty($value->statusPengajuan) &&
                !empty($value->judulFinal) &&
                !empty($value->judulFinal->pembimbing1->dosen) &&
                !empty($value->judulFinal->pembimbing2->dosen)
            ) ? 'background-color: #13deb9;' : '';
            $collorStyle = (
                !empty($value->listPembimbing) &&
                !empty($value->statusPengajuan) &&
                !empty($value->judulFinal) &&
                !empty($value->judulFinal->pembimbing1->dosen) &&
                !empty($value->judulFinal->pembimbing2->dosen)
            ) ? 'color: white;' : '';
            echo '<tr style="' .   $backgroundStyle . '">
        <td style="' .   $collorStyle . 'vertical-align: middle;">' . ($key + 1) . '</td>
        <td style="' .   $collorStyle . 'vertical-align: middle;">' . $value->tema->nama . '</td>
        <td  style="' .   $collorStyle . 'vertical-align: middle;" class="text-justify">' . $value->judul . '</td>
        <td style="text-align: justify; ' .   $collorStyle . '" class="text-justify">';
            if ($value->listPembimbing->isEmpty()) {
                echo '<div class="d-flex justify-content-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>';
            }
            if (!$value->listPembimbing->isEmpty() && $value->statusPengajuan->isEmpty()) {
                echo 'Judul yang Anda ajukan telah disetujui oleh Kaprodi. Silakan pilih
        <a class="text-decoration-underline" href="' . route('pilih.pembimbingTugasAkhir', ['id' => $value->id]) . '">pembimbing</a>
        untuk melanjutkan proses tugas akhir Anda.';
            }
            if (!empty($value->listPembimbing) && !empty($value->statusPengajuan) && empty($value->judulFinal)) {
                foreach ($value->statusPengajuan as $status) {
                    if ($status->status == 'diproses') {
                        echo '<div class="my-2">
                    <div class="d-inline">
                        <span class="badge bg-secondary text-capitalize" style="width: 100px">' . $status->status . '</span>
                    </div>
                    <div class="d-inline"> Oleh <b>' . $status->dosen->nama . '</b> untuk menjadi pembimbing utama.
                    </div>
                </div>';
                    }
                    if ($status->status == 'ditolak') {
                        echo '<div class="my-2">
                    <span class="badge bg-danger text-capitalize" style="width: 100px">' . $status->status . '</span>
                    Oleh ' . $status->dosen->nama . ' <a class="text-decoration-underline" href="">Detail</a>
                </div>';
                    }
                    if ($status->status == 'diterima') {
                        echo '<div class="my-2">
                    <div class="d-inline">
                        <span class="badge bg-success text-capitalize" style="width: 100px">' . $status->status . '</span>
                    </div>
                    <div class="d-inline">
                        Oleh ' . $status->dosen->nama . ' sebagai pembimbing utama.
                        <form class="ambil-pembimbing-form d-inline">
                            <input type="hidden" name="type" value="1">
                            <input type="hidden" name="pengajuan_id" value="' . $value->id . '">
                            <input type="hidden" name="dosen_id" value="' . $status->dosen->id . '">
                            <button type="submit" class="btn btn-link p-0">Ambil</button>
                        </form>
                    </div>
                </div>';
                    }
                    echo '<hr class="my-0">';
                }
            }
            if (
                !empty($value->listPembimbing) &&
                !empty($value->statusPengajuan) &&
                !empty($value->judulFinal) &&
                !empty($value->judulFinal->pembimbing1->dosen) &&
                empty($value->judulFinal->pembimbing2->dosen)
            ) {
                echo '<div class="my-2">
                    Anda telah memilih <b>' . $value->judulFinal->pembimbing1->dosen->nama . '</b> sebagai pembimbing utama
                    selanjutnya silahkan pilih dosen yang ingin Anda jadikan sebagai pembimbing kedua:
                </div>';
                foreach ($value->statusPengajuan as $status) {
                    if ($value->judulFinal->pembimbing1->dosen->nama == $status->dosen->nama) {
                        continue;
                    }
                    echo '<form class="ambil-pembimbing-form">
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="judul_final_id" value="' . $value->judulFinal->id . '">
                    <input type="hidden" name="dosen_id" value="' . $status->dosen->id . '">
                    <button class="btn btn-link p-0">' . $status->dosen->nama . '</button>
                </form>';
                }
            }
            if (
                !empty($value->listPembimbing) &&
                !empty($value->statusPengajuan) &&
                !empty($value->judulFinal) &&
                !empty($value->judulFinal->pembimbing1->dosen) &&
                !empty($value->judulFinal->pembimbing2->dosen)
            ) {
                echo '<div class="my-2">
            Anda telah memilih <b>' . $value->judulFinal->pembimbing1->dosen->nama . '</b> sebagai pembimbing utama
            dan <b>' . $value->judulFinal->pembimbing2->dosen->nama . '</b> dijadikan sebagai pembimbing kedua.
            Selanjutnya silahkan berpindah ke halaman bimbingan untuk melanjutkan proses tugas akhir Anda.
        </div>';
            }
            echo '</td>
    </tr>';
        }
        echo '</tbody>
</table>';
    }

    public function pilihPembimbing(Request $request)
    {
        $pengajuanId = $request->route('id');
        $listPembimbing = ListPembimbing::where('pengajuan_id', $pengajuanId)
            ->with('dosen')
            ->get();

        return view('pages.mahasiswa.tugas_akhir.pilih_pembimbing', compact('listPembimbing', 'pengajuanId'));
        // 
    }

    public function storePilihPembimbing(Request $request)
    {

        foreach ($request->input('selected_pembimbing') as $dosenId) {
            StatusPengajuan::create([
                'pengajuan_id' => $request->pengajuan_id,
                'dosen_id' => $dosenId,
                'status' => 'diproses',
                'keterangan' => null,
            ]);
        }
        AlertHelper::alertSuccess('Anda teah berhasil memilih dosen pembimbing', 'Selamat!', 2000);
        return redirect()->route('tugasAkhir');
        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        // return redirect()->route('nama.rute.yang.akan.dituju')->with('success', 'Data pembimbing berhasil disimpan.');
    }

    public function storeAmbilPembimbing(Request $request)
    {

        if ($request->type == 1) {
            $judulFinal = JudulFinal::firstOrCreate([
                'pengajuan_id' => $request->pengajuan_id,
            ]);
            if (!$judulFinal->pembimbing1()->where('dosen_id', $request->dosen_id)->exists()) {
                $judulFinal->pembimbing1()->create([
                    'dosen_id' => $request->dosen_id,
                ]);
            }
            echo 'utama';
        } else {
            Pembimbing2::firstOrCreate([
                'judul_final_id' => $request->judul_final_id,
                'dosen_id' => $request->dosen_id
            ]);
            echo 'kedua';
        }
        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        // return redirect()->route('nama.rute.yang.akan.dituju')->with('success', 'Data pembimbing berhasil disimpan.');
    }
}
