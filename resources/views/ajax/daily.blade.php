<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                    <button type="button" class="btn btn-primary" id="btnPrint">
                        Cetak Laporan
                    </button>
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

<div id="printarea" style="display: none;">
    <style>
        h2 {
            margin-top: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        p {
            margin: 0 0 10px;
        }
        table.table-print {
            width: 100%;
            border: 1px solid #cacaca;
        }
        .text-center {
            text-align: center;
        }
        table.table-print tr td,
        table.table-print tr th {
            padding: 3px 20px;
            border: 1px solid #cacaca;  
        }
        
    </style>
    <h2>Laporan Harian Pasien</h2>
    <table class="table-print">
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

<script type="text/javascript">
    $(function () {
        $("#btnPrint").click(function () {
            var prtContent = document.getElementById("printarea");
            var WinPrint = window.open();
            WinPrint.document.write( "<link rel='stylesheet' href='{{asset('web/plugins/bootstrap/css/bootstrap.css') }}' type='text/css' media='print'/>" );
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
    });
</script>