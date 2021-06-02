@extends('layouts.admin')

@section('title', 'Laundry Ceria - Home')

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
    $(document).ready(function () {
        var konsumens = {!! $konsumens !!}
        $('#btn-add-konsumen').click(function () {
            $('#nama').val("");
            $('#username').val("");
            $('#nohp').val("");
            $('#alamat').val("");
            $('#password').val("");
            $('#re-password').val("");
            $('#konsumen-form').attr('action', "{{route('konsumen.store')}}");
            $('#konsumen-modal-title').html("Tambah Konsumen");
            $('#konsumen-modal').modal('show');
        });

        $('.btn-edit-konsumen').click(function() {
            var index = $(this).data('index');
            var konsumen = konsumens[index]
            $('#konsumen-form').attr('action', '/konsumen/update/' + konsumen.id_konsumen);
            $('#konsumen-modal-title').html("Update Konsumen");
            $('#konsumen-modal').modal('show');
            $('#nama').val(konsumen.nama);
            $('#username').val(konsumen.username);
            $('#nohp').val(konsumen.nohp);
            $('#alamat').val(konsumen.alamat);
            $('#password').val(konsumen.password);
            $('#re-password').val(konsumen.password);
        });

        $(".btn-dlt-alert").click(function(event){
            button = $(this);
            title = button.data('title')
            text = button.data('text')
            index = $(".btn-dlt-alert").index(button);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
            })
            
            swalWithBootstrapButtons.fire({
                title: title,
                text: text,
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'ml-2',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $(".frm-dlt-alert").eq(index).submit();
                }
            });
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
                    <div class="row mb-20">
                        <div class="col-md-6 col-6">
                            <h6 class="card-title">Data Konsumen</h6>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="flt-right">
                                <a class="btn btn-success btn-icon-text btn-edit-profile" href="javascript:void(0)" id="btn-add-konsumen" >
                                    <i data-feather="plus" class="btn-icon-prepend"></i> Tambah Konsumen
                                </a>
                            </div>  
                        </div>
                    </div>          
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($konsumens as $key => $konsumen) 
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $konsumen->nama }}</td>
                                    <td>{{ $konsumen->username }}</td>
                                    <td>{{ $konsumen->nohp }}</td>
                                    <td>{{ $konsumen->alamat }}</td>
                                    <td>
                                        <button data-index="{{$key}}" class="btn-edit-konsumen btn btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </button>
                                        <form class="frm-dlt-alert" action="{{route('konsumen.delete', $konsumen)}}" method="post" style="display: inline-block;">
                                            @csrf
                                            <button type="button" class="btn-dlt-alert btn btn-danger btn-icon" data-title="Hapus Konsumen" data-text="Anda yakin menghapus data konsumen ini?">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </form> 
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
<div class="modal fade" id="konsumen-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">        
        <form id="konsumen-form" class="forms-sample" action="" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="konsumen-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_konsumen" id="id_konsumen">
                <div class="form-group">
                    <label for="nama">Nama Konsumen</label>
                    <input type="text" class="form-control" id="nama" name="nama" required autofocus>                     
                </div>      
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>                     
                </div>      
                <div class="form-group">
                    <label for="nohp">No Hp</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" required autofocus>                     
                </div>      
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required autofocus>                     
                </div>      
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autofocus>                     
                </div>      
                <div class="form-group">
                    <label for="re-password">Re-Password</label>
                    <input type="password" class="form-control" id="re-password" name="re-password" required autofocus>                     
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