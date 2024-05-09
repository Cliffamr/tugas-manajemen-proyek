@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Penggajuan Cuti Tahunan') }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nik</th>
                                        <th>Tanggal Pengajuan Cuti</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($loadCuti as $data)
                                    <tr>
                                        <td>{{ $data->nama_karyawan }}</td>
                                        <td>{{ $data->email_karyawan }}</td>
                                        <td>{{ $data->nik_karyawan }}</td>
                                        <td>{{ date("d-m-Y", strtotime($data->tgl_cuti)) }}</td>
                                        <td>
                                            <button type="button" class="btn-sm btn-success" id="btn-update-verifikasi" onclick="onVerif('{{$data->id}}')"><i class="fa fa-check"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->


                </div>

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    function onVerif(id) {
        $.ajax({
            url: "{{ Route('admin.absensis.terimaCuti') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'id': id,
            },
            success: function(response) {
                alert("Data Cuti Berhasil Di Update");
                location.reload(); 
            },
            error: function(request, status, error) {
                errorMessage(request);
            }
        });
    }
</script>
@endsection