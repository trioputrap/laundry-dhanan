<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::get();
        return view('pegawai.index', compact('pegawais'));
    }

    public function store(Request $request)
    { 
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $pegawai = Pegawai::create($input);
        return redirect()->route('pegawai.index')->with('success', 'Berhasil menambah data pegawai');
    }

    public function edit(Pegawai $pegawai){
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $input = $request->all();
        $input['password'] = ($input['password'] == '') ? $pegawai->password : Hash::make($input['password']);
        $pegawai->update($input);
        return redirect()->route('pegawai.index')->with('success', 'Berhasil memperbaharui data pegawai');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Berhasil menghapus data pegawai');
    }
}
