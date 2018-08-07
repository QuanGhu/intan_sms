<div class="row">
    <div class="col-12">
        <div class="card">
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
                    <tbody>
                        @foreach($patients as $key => $data)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$data->register_time}}</td>
                                <td>{{$data->queue_no}}</td>
                                <td>{{$data->queue_code}}</td>
                                <td>{{$data->name}}</td>
                                <td>{{$data->phone_number}}</td>
                                <td>{{$data->poli->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->
    </div>
</div>