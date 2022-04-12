<?php

namespace App\Http\Controllers;

use App\Layanan;
use App\Pengerjaan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::get();
        return view('layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    { 
        $input = $request->all();
        $layanan = Layanan::create($input);
        return redirect('layanan')->with('success', 'Berhasil menambah data layanan');
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);
        $input = $request->all();
        $layanan->update($input);
        return redirect('layanan')->with('success', 'Berhasil memperbaharui data layanan');
    }

    public function destroy(Layanan $layanan)
    {
        Pengerjaan::where('id_layanan', $layanan->id_layanan)->delete();
        $layanan->delete();
        return redirect('layanan')->with('success', 'Berhasil menghapus data layanan');
    }
}
