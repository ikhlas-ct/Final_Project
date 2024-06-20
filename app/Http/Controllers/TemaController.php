<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\AlertHelper;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::with('fakultas')->get();
        return view('pages.kaprodi.tema.index', compact('temas'));
    }

    public function addTema()
    {
        $fakultas = Fakultas::all();
        return view('pages.kaprodi.tema.add', compact('fakultas'));
    }

    public function storeTema(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas_id' => 'required|exists:tb_fakultas,id',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('halamanTambahTema')
                ->withErrors($validator)
                ->withInput();
        }

        Tema::create([
            'fakultas_id' => $request->fakultas_id,
            'nama' => $request->nama,
        ]);

        AlertHelper::alertSuccess('Anda telah berhasil membuat tema TA', 'Selamat!', 2000);
        return redirect()->back();
    }

    public function editTema($id)
    {
        $tema = Tema::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('pages.kaprodi.tema.edit', compact('tema', 'fakultas'));
    }

    public function updateTema(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fakultas_id' => 'required|exists:tb_fakultas,id',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('halamanEditTema', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $tema = Tema::findOrFail($id);
        $tema->update([
            'nama' => $request->nama,
            'fakultas_id' => $request->fakultas_id,
        ]);
        AlertHelper::alertSuccess('Anda telah berhasil mengupdate tema TA', 'Selamat!', 2000);
        return redirect()->route('temaIndex');
    }

    public function showTema($id)
    {
        $tema = Tema::findOrFail($id);
        return view('pages.kaprodi.tema.index', compact('tema'));
    }

    public function hapusTema($id)
    {
        $tema = Tema::findOrFail($id);
        $tema->delete();
        AlertHelper::alertSuccess('Anda telah berhasil menghapus tema TA', 'Selamat!', 2000);
        return redirect()->back();
    }
}