@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Daftar Pesan Masuk</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tr>
                            <th>Nomor HP</th>
                            <th>Message ID</th>
                            <th>Pesan</th>
                            <th>Status</th>
                        </tr>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{$message->phone_number}}</td>
                                <td>{{$message->id}}</td>
                                <td>{{$message->message}}</td>
                                <td>{{$message->status}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- /.row -->
@endsection