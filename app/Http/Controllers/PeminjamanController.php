<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\Profile;
use App\Models\TransaksiPeminjam;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    public function index(){

        $datas = TransaksiPeminjam::with("user",'detailBuku')->get();

        return view('transaksi.peminjaman.index', compact('datas'));
    }

    public function create(){
        $datas = User::where('role',"user")->get();
        $dtlDatas = DetailBuku::where("status", "!=", 'removed')->with("buku")->get();

        return view('transaksi.peminjaman.form', compact('datas', 'dtlDatas'));
    }

    public function show($id){
        $peminjaman = TransaksiPeminjam::find($id);

        return view('transaksi.peminjaman.show', compact('peminjaman'));
    }

    public function storeTransaction(Request $request){

        $validated = $request->validate([
            "profile_id" => ['required'],
            "dtl_buku_id" => ['required'],
            "tipe" => ["required"]
        ]);

        switch ($validated['tipe']) {
            case 'PINJAM':
                return $this->savePeminjaman($request->toArray());
                break;
            case 'KEMBALI':
                return $this->savePengembalian($request->toArray());
                break;
            default:
                return back()->withErrors(["tipe" => "Tipe operasi tidak diketahui!"]);
                break;
        }
    }

    private function savePeminjaman($datas){

        $dataBuku = DetailBuku::find($datas['dtl_buku_id']);

        $create = TransaksiPeminjam::create([
            "user_id" => $datas['profile_id'],
            "buku_id" => $dataBuku['buku_id'],
            "dtl_buku_id" => $datas['dtl_buku_id'],
            "tgl_transaksi" => date("Y-m-d H:i:s"),
            "tipe" => "PINJAM",
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if(!$create){
            return back()->withErrors(["create" => "Gagal menyimpan data transaksi Peminjaman!"]);
        }


        if($dataBuku->status == "disimpan"){
            $update = $dataBuku->update(["status"=> "dipinjam"]);

            if(!$update){
                return back()->withErrors(["update" => "Gagal merubah status buku"]);
            }
        }else{
            return back()->withErrors(["update" => "Status Buku Sudah Dipinjam/Removed!"]);
        }

        return redirect()->intended('/transaksi/peminjaman'); //GANTI NANTI
    }

    private function savePengembalian($datas){

        $dataBuku = DetailBuku::find($datas['dtl_buku_id']);

        $create = TransaksiPeminjam::create([
            "user_id" => $datas['profile_id'],
            "buku_id" => $dataBuku['buku_id'],
            "dtl_buku_id" => $datas['dtl_buku_id'],
            "tgl_transaksi" => date("Y-m-d H:i:s"),
            "tipe" => "KEMBALI",
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        if(!$create){
            return back()->withErrors(["create" => "Gagal menyimpan data transaksi Pengembalian!"]);
        }

        if($dataBuku->status == "dipinjam"){
            $update = $dataBuku->update(["status"=>"disimpan"]);

            if(!$update){
                return back()->withErrors(["update" => "Gagal merubah status buku"]);
            }
        }else{
            return back()->withErrors(["update" => "Status Buku Sudah Disimpan/Removed!"]);
        }

        return redirect()->intended('/transaksi/peminjaman');
    }
}