<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerbitController extends Controller
{
    public function index(){
        $datas = Penerbit::all();

        return view('Penerbit/penerbit', compact('datas'));
    }


    public function create(){
        return view('Penerbit/create'); 
    }

    public function edit($id){

        $penerbit = Penerbit::find($id);

        return view('penerbit/edit', compact('penerbit')); 
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nm_penerbit' => ['required', 'string'],
           
            'alamat' => ['required', 'string']
        ]);
    
        $user = Auth::user();
        $create = Penerbit::create([
            'nm_penerbit'=> $validated["nm_penerbit"],
           
            'alamat'=>$validated["alamat"],
            'created_by'=>$user->id,    
        ]);

        if(!$create){
            return back()->withErrors(['create' => 'Gagal menyimpan Penerbit!']);
        }

        return redirect('/penerbit'); 
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'nm_penerbit' => ['required', 'string'],
           
            'alamat' => ['required', 'string']
        ]);

        $tobeUpdated = Penerbit::find($id);
        $user = Auth::user();

        $update = $tobeUpdated->update([
            'nm_penerbit'=> $validated["nm_penerbit"],
           
            'alamat'=>$validated["alamat"],
            'updated_by' => $user->id,
        ]);

        if(!$update){
            return back()->withErrors(['create' => 'Gagal menyimpan Penerbit!']);
        }

        return redirect('/penerbit'); 

    }

    public function delete($id) {
        try{

            $tobeDeleted = Penerbit::find($id);

            $tobeDeleted->delete();
    
            return redirect('/penerbit'); 

        }catch(Exception $e){
            return back()->withErrors($e);
        }
    }
}