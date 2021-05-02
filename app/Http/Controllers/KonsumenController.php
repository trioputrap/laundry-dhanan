<?php

namespace App\Http\Controllers;

use App\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    
    public function login(Request $request){ 
        $input = $request->all(); 
        $konsumen = Konsumen::where(['username' => $input['username'], 'password' => $input['password']]);
        if($konsumen->count()) {
            $response['status'] = 200;
            $response['message'] = "Login success";
            $response['data'] = $konsumen->first();
            return response()->json($response, 200);
        }
        
        $response['status'] = 401;
        $response['message'] = "Login failed";
        return response()->json($response, 401);
    }

    public function index()
    {
        $konsumens = Konsumen::get();
        return view('konsumen.index', compact('konsumens'));
    }

    public function store(Request $request)
    { 
        $input = $request->all();
        $konsumen = Konsumen::create($input);
        return redirect('home')->with('success', 'Berhasil menambah data konsumen');
    }

    public function update(Request $request, $id)
    {
        $konsumen = Konsumen::find($id);
        $input = $request->all();
        $konsumen->update($input);
        return redirect('home')->with('success', 'Berhasil memperbaharui data konsumen');
    }
    
    public function register(Request $request)
    { 
        $input = $request->all();
        $konsumen = Konsumen::create($input);
        $response['status'] = 200;
        $response['message'] = "Berhasil Register";
        $response['data'] = $konsumen;

        return response()->json($response, 200);
    }

    
    public function update_profil(Request $request, $id)
    {
        $konsumen = Konsumen::find($id);
        $input = $request->all();
        $konsumen->update($input);
        $response['status'] = 200;
        $response['message'] = "Berhasil Update Profil";
        $response['data'] = $konsumen;

        return response()->json($response, 200);
    }

    public function destroy(Konsumen $konsumen)
    {
        $konsumen->delete();
        return redirect('home')->with('success', 'Berhasil menghapus data konsumen');
    }
}
