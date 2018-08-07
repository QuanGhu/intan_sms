@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Daftar Pasien</h3>
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addModal">
                        Tambah Data
                    </button>
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

<div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data Patient</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-add']) !!}
            <div class="form-group">
                <label for="email">Nama Pasien </label>
                {{ Form::text('name', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Nomor Hp </label>
                {{ Form::text('phone_number', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Poli </label>
                {{ Form::select('poli_id', $polies, NULL, ['class' => 'form-control','placeholder' => 'Pilih Nama Poli','style' => 'width: 100%;']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


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
            $('#form-add').validate({
                rules: {
                    poli_id: {
                        required: true
                    },
                    name : {
                        required: true
                    },
                    phone_number : {
                        required: true
                    }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'POST',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('patient.save') }}",
	                    data: $('#form-add').serialize(),
	                    dataType: 'JSON',
	                    cache: false,
	                    beforeSend: function(){
	                        $('.page-loader-wrapper').show();
	                    },
	                    success: function(result) {
	                        $('#form-add')[0].reset();
	                        $('#dataTable').DataTable().ajax.reload();
	                        $('#addModal').modal('hide');
	                        $('.page-loader-wrapper').hide();
                    		if(result.status=='success'){
	                            notification('Data Successfully saved','success');
	                        }else {
	                            notification('Something Went Wrong','danger');
	                        }
                        },
                        error: function(error) {
                            console.log(error)
                        }
	            });
	            return false;
	        }
        });

        function notification(msg, type)
        {
            $.notify(msg, type);
        }
    });
</script>
@endpush