@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-12 d-flex justify-content-between">
                <h1 class="m-0">{{ __('Pengajuan Cuti Tahunan') }}</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="alert alert-primary" role="alert">
            Jumlah Sisa Cuti Anda Tinggal : {{20-$count}}
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card p-4">
                    <form id="formCuti" action="#" enctype='multipart/form-data'>
                        @csrf
                        <label>
                            Masukan Tanggal Anda Ingin Melakukan Cuti
                        </label>
                        <br>
                        <input type="date" name="txtCuti" id="txtCuti" style="width: 300px;text-align: center;" />
                        <button type="button" onclick="actionSimpan()" class="btn btn-primary">Simpan</button>
                    </form>
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
    function actionSimpan() {

        let myForm = document.getElementById('formCuti');
        let formData = new FormData(myForm);

        $.ajax({
            type: 'POST',
            url: "{{ route('admin.karyawan.prosescuti') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status == 200) {
                    alert("Selamat Pengajan Cuti Berhasil, Mohon Untuk Menunggu Verifikasi");
                    location.reload();
                }
            },
            error: function(request, status, error) {
                errorMessage(request);
            }
        });
    }
</script>
@endsection