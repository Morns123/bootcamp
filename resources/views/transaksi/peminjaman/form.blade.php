@extends("layout.main")

@section("content")
<div class="container mt-3">
    <div class="row ">
        <div class=" mt-4">
            <form action="{{ url('/transaksi/peminjaman/create') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">User / Peminjam</label>
                            <select name="profile_id" class="form-select" aria-label="Default select example">
                                <option disabled selected>-Pilih Peminjam-</option>
                                @foreach ($datas as $profile)
                                    <option value="{{$profile->id}}">{{$profile->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="PINJAM">
                            <div class="mb-3">
                                <label class="form-label">SN Number Buku</label>
                                <select name="dtl_buku_id" class="form-select" aria-label="Default select example">
                                    <option disabled selected>-Pilih Buku-</option>
                                    @foreach ($dtlDatas as $dtlBuku)
                                        @if($dtlBuku->status == "disimpan")
                                        <option value="{{$dtlBuku->id}}">
                                            {{$dtlBuku->buku->judul}} | {{$dtlBuku->sn_buku}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="KEMBALI" style="display: none">
                            <div class="mb-3">
                                <label class="form-label">SN Number Buku</label>
                                <select name="dtl_buku_id" class="form-select" aria-label="Default select example">
                                    <option disabled selected>-Pilih Buku-</option>
                                    @foreach ($dtlDatas as $dtlBuku)
                                        @if($dtlBuku->status == "dipinjam")
                                        <option value="{{$dtlBuku->id}}">
                                            {{$dtlBuku->buku->judul}} | {{$dtlBuku->sn_buku}}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="TIPE" class="form-select" aria-label="Default select example">
                                <option value="PINJAM" selected>PINJAM</option>
                                <option value="KEMBALI">KEMBALI</option>
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

            if(this.value == "PINJAM"){
                document.getElementById("PINJAM").style.display = "block"
                document.getElementById("KEMBALI").style.display = "none"
            }

            if(this.value == "KEMBALI"){
                document.getElementById("PINJAM").style.display = "none"
                document.getElementById("KEMBALI").style.display = "block"
            }

            console.log("The input value changed to: ", this.value);
        });
    </script>
@endsection