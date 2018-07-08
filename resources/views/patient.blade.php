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
                    <table class="table table-hover" id="dataTable">
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div><!-- /.row -->
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        var dt = $('#dataTable').DataTable({
                orderCellsTop: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                autoWidth: false,
                ajax: {
                        url :'{{ route('patient.list') }}',
                        data: { '_token' : '{{csrf_token() }}'},
                        type: 'POST',
                },
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                    { data: 'register_time', name: 'register_time' },
                    { data: 'queue_no', name: 'queue_no' },
                    { data: 'queue_code', name: 'queue_code' },
                    { data: 'name', name: 'name' },
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'poli', name: 'poli' }
                ]
            });
    });
</script>
@endpush