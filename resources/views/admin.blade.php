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
                                <th>Email</th>
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
                <label for="email">Email </label>
                {{ Form::text('email', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Password</label>
                {{ Form::password('password', ['class' => 'form-control']) }}
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
                            url :'{{ route('admin.list') }}',
                            data: { '_token' : '{{csrf_token() }}'},
                            type: 'POST',
                    },
                    columns: [
                        { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                        { data: 'email', name: 'email' },
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
                                deleteData(data.id, $('input[name="_token"]').val(), "{{ route('admin.delete') }}");
                                $('#dataTable').DataTable().ajax.reload();
                            },
                            cancel: function () {
                                // close
                            },
                        }
                    });
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
	                    url: "{{ route('admin.save') }}",
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
    </script>
@endpush