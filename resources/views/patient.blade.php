@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Daftar Pasien</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                    <tr>
                        <th>Nomor Antrian</th>
                        <th>Kode Antrian</th>
                        <th>Tanggal Daftar</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Poli Tujuan</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>A101</td>
                        <td>25-6-2018</td>
                        <td>Budi</td>
                        <td>28 Tahun</td>
                        <td>Poli Gigi</td>
                    </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- /.row -->
@endsection