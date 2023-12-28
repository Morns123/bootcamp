@extends("layout.main")

@section("content")
<div class="container mt-3">
    <div class="row ">
        <div class=" mt-4">
            <form action="{{ url('/transaksi/buku/create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div id="IN">
                            <div class="mb-3">
                                <label class="form-label">Buku</label>
                                <select name="buku_id" class="form-select" aria-label="Default select example">
                                    <option disabled selected>-Pilih Buku-</option>
                                    @foreach ($datas as $buku)
                                        <option value="{{$buku->id}}">{{$buku->judul}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Qty</label>
                                <input type="number" class="form-control" name="qty" autocomplete="off" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">tanggal transaksi</label>
                                <input type="daTe" class="form-control" name="tgl" autocomplete="off" />
                            </div>
                        </div>
                        <div id="OUT" style="display: none">
                            <div class="mb-3">
                                <label class="form-label">SN Number Buku</label>
                                <select name="dtl_buku_id" class="form-select" aria-label="Default select example">
                                    <option disabled selected>-Pilih Buku-</option>
                                    @foreach ($dtlDatas as $dtlBuku)
                                        <option value="{{$dtlBuku->id}}">
                                            {{$buku->judul}} | {{$dtlBuku->sn_buku}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="TIPE" class="form-select" aria-label="Default select example">
                                <option value="IN" selected>IN</option>
                                <option value="OUT">OUT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="float-start">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script>
        var inputElement = document.getElementById("TIPE");

        inputElement.addEventListener("change", function() {

            if(this.value == "IN"){
                document.getElementById("IN").style.display = "block"
                document.getElementById("OUT").style.display = "none"
            }

            if(this.value == "OUT"){
                document.getElementById("IN").style.display = "none"
                document.getElementById("OUT").style.display = "block"
            }

            console.log("The input value changed to: ", this.value);
        });
    </script>
@endsection