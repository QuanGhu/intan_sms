@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Tambah Data
                    </button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Poli</th>
                                <th>Nama Poli</th>
                                <th>Nama Dokter</th>
                                <th>Action</th>
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
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-add']) !!}
            <div class="form-group">
                <label for="email">Kode Poli </label>
                {{ Form::text('poli_code', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Poli </label>
                {{ Form::text('name', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Dokter </label>
                {{ Form::text('doctor_name', NULL ,['class' => 'form-control']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-edit']) !!}
            <div class="form-group">
                {{ Form::hidden('id', NULL ,['class' => 'form-control', 'id' => 'id']) }}
                <label for="email">Kode Poli </label>
                {{ Form::text('poli_code', NULL ,['class' => 'form-control', 'id' => 'edit_poli_code']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Poli </label>
                {{ Form::text('name', NULL ,['class' => 'form-control', 'id' => 'edit_poli_name']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Dokter </label>
                {{ Form::text('doctor_name', NULL ,['class' => 'form-control', 'id' => 'edit_doctor_name']) }}
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
                            url :'{{ route('poli.list') }}',
                            data: { '_token' : '{{csrf_token() }}'},
                            type: 'POST',
                    },
                    columns: [
                        { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                        { data: 'poli_code', name: 'poli_code' },
                        { data: 'name', name: 'name' },
                        { data: 'doctor_name', name: 'doctor_name' },
                        { data: 'action', name: 'action', "width": "390px" },
                    ]
                });

                $('table#dataTable tbody').on( 'click', 'td>button', function (e) {
                var parent = $(this).parent().get( 0 );
                var parent1 = $(parent).parent().get( 0 );
                var row = dt.row(parent1);
                var data = row.data();

                if($(this).hasClass('delete')) {
                    $.confirm({
                        title: 'Delete Data!',
                        content: 'Are You Sure To Delete This Data ?',
                        buttons: {
                            confirm: function () {
                                deleteData(data.id, $('input[name="_token"]').val(), "{{ route('poli.delete') }}");
                                $('#dataTable').DataTable().ajax.reload();
                            },
                            cancel: function () {
                                // close
                            },
                        }
                    });
                }else {
                    $('input#id').val(data.id);
                    $('input#edit_poli_code').val(data.poli_code);
                    $('input#edit_poli_name').val(data.name);
                    $('input#edit_doctor_name').val(data.doctor_name);
                    setFormEdit();
                }
            });
        });
        $('#form-add').validate({
	        rules: {
	            poli_code: {
	                required: true
                },
                name : {
                    required: true
                },
                doctor_name : {
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
	                    url: "{{ route('poli.save') }}",
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

        $('#form-edit').validate({
	        rules: {
	            poli_code: {
	                required: true
                },
                name : {
                    required: true
                },
                doctor_name : {
                    required: true
                }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'PUT',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('poli.update') }}",
	                    data: $('#form-edit').serialize(),
	                    dataType: 'JSON',
	                    cache: false,
	                    beforeSend: function(){
	                        $('.page-loader-wrapper').show();
	                    },
	                    success: function(result) {
	                        $('#form-add')[0].reset();
	                        $('#dataTable').DataTable().ajax.reload();
	                        $('#editModal').modal('hide');
	                        $('.page-loader-wrapper').hide();
                    		if(result.status=='success'){
	                            notification('Data Successfully updated','success');
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

        function deleteData(id, token, url) {
            $.ajax({
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': token
                },
                url: url,
                dataType: 'JSON',
                cache: false,
                data: {id: id},
                beforeSend: function(){
                    $('.page-loader-wrapper').show();
                },
                success: function(result) {
                    $('#dataTable').DataTable().ajax.reload();
                    $('.page-loader-wrapper').hide();
                    if(result.status=='success'){
                        notification('Data Successfully Deleted','success');
                    }
                    else  {
                        notification('Something Went Wrong','danger');
                    }
                }
            });
        }
        function setFormEdit() {
            $('#editModal').modal('show');
        }

        function setFormImage() {
            $('input#mode').val('PUT');
            $('#imageForm').modal('show');
        }
        function setFormAdd() {
            $('input#mode').val('POST');
            $('#modalForm').modal('show');
            $('#form-input')[0].reset();
        }
    </script>
@endpush