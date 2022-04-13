@extends('layouts.admin')

@section('title', 'Ceria Laundry - Home')

@section('plugin-css')
<link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
{{-- SWEETALERT --}}
<link rel="stylesheet" href="{{asset('assets/vendors/sweetalert2/sweetalert2.min.css')}}">
{{-- SELECT2 --}}
<link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
@endsection

@section('plugin-js')
<script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
{{-- SWEETALERT --}}
<script src="{{asset('assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
{{-- SELECT2 --}}
<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
@endsection

@section('custom-js')
<script src="{{asset('assets/js/data-table.js')}}"></script>
<script>
    @if (\Session::has('success'))  
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        
        Toast.fire({
            type: 'success',
            title: "{{ \Session::get('success') }}"
        });
    @endif   
</script>
<script>
    function numberWithCommas(x) {
        var parts = x.toString().replace(".", ",").split(",");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(",");
    }

    function showCurrency(x) {
        return "Rp" + numberWithCommas(x);
    }
    $(document).ready(function () {
        $("#id_konsumen").select2({placeholder: "Pilih Konsumen"});
        $("#id_layanan").select2({placeholder: "Pilih Layanan"});
        $("#status").select2({placeholder: "Pilih Status", width: "100%"});

        var layanans = {!! $layanans !!}
        var pengerjaans = {!! $pengerjaans !!}
        console.log(pengerjaans)

        function hitung_total(){
            var jumlah = parseFloat(($("#jumlah").val()=="")?0:$("#jumlah").val())
            console.log(jumlah)
            var harga_layanan = parseFloat($("#harga").val())
            var total = jumlah * harga_layanan
            $("#total_harga").val(total)
            $('#total_harga-display').val(showCurrency(total));
        }

        //ubah harga layanan
        $("#id_layanan").change(function(){
            var index = $(this).prop('selectedIndex') - 1
            var harga_layanan = layanans[index].harga
            $("#harga").val(harga_layanan)
            $('#harga-display').val(showCurrency(harga_layanan))
            hitung_total()
        })

        $("#jumlah").keyup(function(){
            hitung_total()
        })

        //tampilkan modal tambah pengerjaan
        $('#btn-add-pengerjaan').click(function () {
            $('#id_konsumen').val("");
            $('#id_layanan').val("");
            $('#harga').val("");
            $('#harga-display').val("");
            $('#jumlah').val("");
            $('#total_harga').val("");
            $('#total_harga-display').val("");
            $('#pengerjaan-form').attr('action', "{{route('pengerjaan.store')}}");
            $('#pengerjaan-modal-title').html("Tambah Pengerjaan");
            $('#status_select').val('antrean')
            $('#status_select').hide()
            $('#pengerjaan-modal').modal('show');
        });

        //tampilkan modal edit pengerjaan
        $('.btn-edit-pengerjaan').click(function() {
            var index = $(this).data('index');
            var pengerjaan = pengerjaans[index]

            //url update data pengerjaan
            $('#pengerjaan-form').attr('action', '/pengerjaan/update/' + pengerjaan.id_pengerjaan); // /pengerjaan/update/{id}

            $('#pengerjaan-modal-title').html("Update Pengerjaan");
            $('#pengerjaan-modal').modal('show');
            $('#id_konsumen').val(pengerjaan.id_konsumen).trigger('change');
            $('#id_layanan').val(pengerjaan.id_layanan).trigger('change');
            $('#harga').val(pengerjaan.harga);
            $('#harga-display').val(showCurrency(pengerjaan.harga))
            $('#jumlah').val(pengerjaan.jumlah);
            $('#total_harga').val(pengerjaan.total_harga);
            $('#total_harga-display').val(showCurrency(pengerjaan.total_harga));
            $('#status').val(pengerjaan.status).trigger('change');
            $('#status_select').show()
        });

    });        
</script>
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
@endsection


@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="formData" action="" method="get">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <h6 class="card-title">Data Pengerjaan</h6>
                        </div>
                        <div class="col-md-6 col-6 mb-20">
                            <div class="flt-right">
                                <a class="btn btn-success btn-icon-text btn-edit-profile" href="javascript:void(0)" id="btn-add-pengerjaan" >
                                    <i data-feather="plus" class="btn-icon-prepend"></i> Tambah Pengerjaan
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 d-sm-block d-none">
                            <label for="start_date" class="w-100">Status</label>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-md-3 col-sm-6 d-sm-none d-block">
                            <label for="start_date" class="w-100">Status</label>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="form-group">
                                <select name="status">
                                    <option {{(!$request->status) ? "selected" : ""}} value=''>Semua Status</option>
                                    <option {{($request->status == "antrean") ? "selected" : ""}} value='antrean'>Antrean</option>
                                    <option {{($request->status == "dicuci") ? "selected" : ""}} value='dicuci'>Dicuci</option>
                                    <option {{($request->status == "disetrika") ? "selected" : ""}} value='disetrika'>Disetrika</option>
                                    <option {{($request->status == "selesai") ? "selected" : ""}} value='selesai'>Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button id="btnSubmit" type="submit" class="btn btn-primary btn-icon-text" style="height: 35px">
                                    Tampilkan
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>     
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Konsumen</th>
                                    <th>Jenis Layanan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengerjaans as $key => $pengerjaan) 
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $pengerjaan->konsumen->nama }}</td>
                                    <td>{{ $pengerjaan->layanan->jenis_layanan }}</td>
                                    <td>{{ $pengerjaan->jumlah }}</td>
                                    <td>Rp{{ number_format($pengerjaan->harga, 0, "", ".") }}</td>
                                    <td>Rp{{ number_format($pengerjaan->total_harga, 0, "", ".") }}</td>
                                    <td>
                                        @switch($pengerjaan->status)
                                            @case('antrean')
                                            <span class="badge badge-light">antrean</span>
                                            @break
                                            @case('dicuci')
                                            <span class="badge badge-primary">dicuci</span>
                                            @break
                                            @case('disetrika')
                                            <span class="badge badge-primary">disetrika</span>
                                            @break
                                            @case('selesai')
                                            <span class="badge badge-success">selesai</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ $pengerjaan->tanggal }}</td>
                                    <td>
                                        <button data-index="{{$key}}" class="btn-edit-pengerjaan btn btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </button>
                                        <a href="{{ route('pengerjaan.print', $pengerjaan) }}" target="_blank" class="btn-edit-pengerjaan btn btn-info btn-icon">
                                            <i data-feather="printer"></i>
                                        </a>
                                    </td>                         
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="pengerjaan-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div style="max-width: 800px !important" class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">        
        <form id="pengerjaan-form" class="forms-sample" action="" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="pengerjaan-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nama_pengerjaan" class="w-100">Nama Konsumen</label>
                    <select id="id_konsumen" name="id_konsumen" class="form-control" style="width: 100%" required>
                        <option></option>
                        @foreach($konsumens as $konsumen)
                        <option value="{{$konsumen->id_konsumen}}">{{$konsumen->nohp}} - {{$konsumen->nama}}</option>
                        @endforeach
                    </select>
                </div>     
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nohp">Jenis Layanan</label>
                            <select id="id_layanan" name="id_layanan" class="form-control" style="width: 100%" required>
                                <option></option>
                                @foreach($layanans as $layanan)
                                <option value="{{$layanan->id_layanan}}">{{$layanan->jenis_layanan}}</option>
                                @endforeach
                            </select>
                        </div>      
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="harga">Harga Layanan</label>
                            <input type="text" class="form-control" id="harga-display" required readonly>                     
                            <input type="hidden" class="form-control" id="harga" name="harga" required>  
                        </div>     
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="text" class="form-control" id="jumlah" name="jumlah" required autofocus min=1>                     
                        </div>      
                    </div>  
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="total_harga">Total Harga</label>
                            <input type="text" class="form-control" id="total_harga-display" required readonly>  
                            <input type="hidden" class="form-control" id="total_harga" name="total_harga" required>                     
                        </div>  
                    </div>
                    <div class="col-md-1">
                        <button data-index="{{$key}}" class="btn-edit-pengerjaan btn btn-primary btn-icon">
                            <i data-feather="add"></i>
                        </button>
                    </div>
                
                    
                </div>    
                <div class="form-group" id="status_select">
                    <label for="status">Status Pengerjaan</label>
                    <select id="status" name="status">
                        <option value="antrean">antrean</option>
                        <option value="dicuci">dicuci</option>
                        <option value="disetrika">disetrika</option>
                        <option value="selesai">selesai</option>
                    </select>
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="btnSave" value="create" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>
{{-- Modal --}}
@endsection