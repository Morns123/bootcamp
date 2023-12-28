<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\TransaksiBuku;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransaksiBukuController extends Controller
{

    public function index(){

        $datas = TransaksiBuku::all();

        return view('transaksi.buku.index', compact('datas'));
    }

    public function create(){

        $datas = Buku::all();
        $dtlDatas = DetailBuku::where("status", "!=", 'removed')->get();

        return view('transaksi.buku.form', compact('datas', 'dtlDatas'));
    }

    public function show($id){

        $transaksi = TransaksiBuku::findOrFail($id);

        return view('transaksi.buku.show',compact('transaksi'));
    }

    public function storeTransaction(Request $request){;

        $validate = $request->validate([
            'tipe' => ['required']
        ]);

        switch ($validate['tipe']) {
            case 'IN':
                return $this->saveIn($request->toArray());
                break;
            case 'OUT':
                return $this->saveOut($request->toArray());
                break;
            default:
                return back()->withErrors(["tipe" => "Tipe operasi tidak diketahui!"]);
                break;
        }

    }

    private function saveIn($datas){

        $create = TransaksiBuku::create([
            'buku_id' => $datas['buku_id'],
            'qty' => $datas['qty'],
            'tipe' => "IN",
            'created_by' => auth()->id(),
            'tgl_transaksi' =>$datas['tgl'],
        ]);

        if(!$create){
            return back()->withErrors(["create" => "Gagal menyimpan data transaksi in!"]);
        }

        for ($i=0; $i < $create->qty; $i++) {
            DetailBuku::create([
                'buku_id' => $datas['buku_id'],
                'status' => "disimpan",
                'trx_in_id' => $create->id,
                'sn_buku' => Carbon::now().".".$datas['buku_id'].".".$create->id.".".$i,
                'created_by' => auth()->id(),
                
            ]);
        }

        return redirect('/transaksi/buku');
    }

    private function saveOut($datas){

        $find = DetailBuku::find( $datas['dtl_buku_id']);

        if(!$find){
            return back()->withErrors(["find" => "Gagal menemukan data detail buku!"]);
        }
        
        $create = TransaksiBuku::create([
            'buku_id' => $find->buku_id,
            'dtl_buku_id' => $datas['dtl_buku_id'],
            'qty' => 1,
            'tipe' => "OUT",
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if(!$create){
            return back()->withErrors(["create" => "Gagal menyimpan data transaksi in!"]);
        }

        $update = $find->update([
            'trx_out_id' => $create->id,
            'status' => "removed",
        ]);

        if(!$update){
            return back()->withErrors(["update" => "Gagal menyimpan data detail buku!"]);
        }

        return redirect('/transaksi/buku');

    }
}