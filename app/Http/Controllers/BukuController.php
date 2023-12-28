<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Penulis;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    public function index(){
        
        $datas = Buku::with('penerbit','penulis')->get();
        return view('Buku/buku', compact('datas')); //GANTI NANTI
    }

    public function show($id){
        $buku = Buku::find($id);

        return view('', compact('buku')); //GANTI NANTI
    }

    public function create(){

        $penulis = Penulis::all();
        $penerbit = Penerbit::all();

        return view('Buku/create', compact('penulis','penerbit')); //GANTI NANTI
    }

    public function edit($id){
        $penuliss = Penulis::all();

        $buku = Buku::find($id);

        return view('', compact('penuliss', 'buku')); //GANTI NANTI
    }

    public function store(Request $request){

        $validated = $request->validate([
            'judul' => ['required', "string"],
            'jml_halaman' => ['required', "integer"],
            'tahun_terbit' => ['required'],
            'isbn' => ['required'],
            'penulis_id' => ['required', 'array'],
            'penerbit_id' => ['required', 'integer'],
        ]);

        $create = Buku::create([
            'judul'=>$request->judul,
            'jml_halaman'=>$request->jml_halaman,
            'tahun_terbit'=>$request->tahun_terbit,
            'isbn'=>$request->isbn,
            'penerbit_id'=>$request->penerbit_id,
            'created_by'=>Auth::id(),
        ]);

        if(!$create){
            return back()->withErrors(['create' => 'Gagal menyimpan buku!']);
        }

        foreach($request->penulis_id as $penulisId){
            DB::table('penulis_buku')->insert([
                'penulis_id' => $penulisId,
                'buku_id' => $create->id,
                'created_by'=>Auth::id(),
            ]);
        }

        return redirect('/buku'); // GANTI NANTI
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'judul' => ['required', "string"],
            'jml_halaman' => ['required', "integer"],
            'tahun_terbit' => ['required'],
            'isbn' => ['required'],
            'penulis_id' => ['required', 'array'],
            'penerbit_id' => ['required', 'integer'],
        ]);

        $tobeUpdated = Buku::find($id);

        $update = $tobeUpdated->update([
            'judul'=>$validated['judul'],
            'jml_halaman'=>$validated['jml_halaman'],
            'tahun_terbit'=>$validated['tahun_terbit'],
            'isbn'=>$validated['isbn'],
            'penerbit_id'=>$validated['penerbit_id']
        ]);

        if(!$update){
            return back()->withErrors(['create' => 'Gagal menyimpan buku!']);
        }

        DB::table('penulis_buku')
        ->where("buku_id", "=", $tobeUpdated->id)
        ->delete();

        foreach($validated["penulis_id"] as $penulisId){
            DB::table('penulis_buku')->insert([
                'penulis_id' => $penulisId,
                'buku_id' => $tobeUpdated->id,
            ]);
        }

        return redirect('/buku'); // GANTI NANTI

    }

    public function delete($id) {
        try{

            $tobeDeleted = Buku::find($id);

            $tobeDeleted->delete();
    
            return redirect(''); // GANTI NANTI

        }catch(Exception $e){
            return back()->withErrors($e);
        }
    }
}