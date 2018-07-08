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
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <th>No</th>
                            <th>Nomor Hp</th>
                            <th>Pesan</th>
                            <th>Pesan ID</th>
                            <th>Status</th>
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
                        url :'{{ route('message.list') }}',
                        data: { '_token' : '{{csrf_token() }}'},
                        type: 'POST',
                },
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                    { data: 'phone_number', name: 'phone_number' },
                    { data: 'message', name: 'message' },
                    { data: 'message_id', name: 'message_id' },
                    { data: 'status', name: 'status' }
                ]
            });
    });
</script>
@endpush