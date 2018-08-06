@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Pilih Bulan">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Pilih Tahun">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-block btn-primary">Lihat Laporan</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary pull-right">Cetak Laporan</button>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Daftar</th>
                                <th>Nomor Antrian</th>
                                <th>Kode Antrian</th>
                                <th>Nama</th>
                                <th>Nomor Hp</th>
                                <th>Poli Tujuan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- /.row -->
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
       
    });
</script>
@endpush