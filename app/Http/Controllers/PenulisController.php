<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenulisController extends Controller
{
    public function index(){
        $datas = Penulis::all();

        return view('penulis.penulis', compact('datas'));
    }

    public function create(){
        return view('penulis.create');
    }

    public function edit($id){
        $penulis = Penulis::find($id);

        return view('penulis.edit', compact('penulis'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nm_penulis' => ['required', 'string'],
            'jn_kelamin' => ['required', 'string'],
            'tgl_lahir' => ['required'],
            'text' => ['required', 'string'],
        ]);
        
        $user = Auth::user();
        $create = Penulis::create([
            'nm_penulis'=> $validated["nm_penulis"],
            'jn_kelamin'=>$validated["jn_kelamin"],
            'tgl_lahir'=>$validated["tgl_lahir"],
            'text'=>$validated["text"],
            'created_by'=>$user->id,    
        ]);

        if(!$create){
            return back()->withErrors(['create' => 'Gagal menyimpan Penulis!']);
        }

        return redirect('/penulis');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'nm_penulis' => ['required', 'string'],
            'jn_kelamin' => ['required', 'string'],
            'tgl_lahir' => ['required'],
            'text' => ['required', 'string']
        ]);

        $tobeUpdated = Penulis::find($id);
        $user = Auth::user();

        $update = $tobeUpdated->update([
            'nm_penulis'=> $validated["nm_penulis"],
            'jn_kelamin'=>$validated["jn_kelamin"],
            'tgl_lahir'=>$validated["tgl_lahir"],
            'text'=>$validated["text"],
            'updated_by' => $user->id,
        ]);

        if(!$update){
            return back()->withErrors(['update' => 'Gagal menyimpan Penulis!']);
        }

        return redirect('/penulis');
    }

    public function delete($id) {
        try{
            $tobeDeleted = Penulis::find($id);
            $tobeDeleted->delete();
    
            return redirect('/penulis');
        }catch(Exception $e){
            return back()->withErrors($e);
        }
    }
}
