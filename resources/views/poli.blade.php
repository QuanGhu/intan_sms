@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Data Poli</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tr>
                            <th>No</th>
                            <th>Kode Poli</th>
                            <th>Nama Poli</th>
                            <th>Nama Dokter</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>A101</td>
                            <td>25-6-2018</td>
                            <td>Budi</td>
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