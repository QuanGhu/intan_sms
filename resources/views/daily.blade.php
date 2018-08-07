@extends('layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {!! Form::open(['class' => 'validate', 'id' => 'form-daily-report']) !!}
                        <div class="row">
                            <div class="col-md-5">
                                {{ Form::text('datestart', NULL ,['class' => 'form-control','id' => 'datestart','placeholder' => 'Pilih Tanggal Mulai']) }}
                            </div>
                            <div class="col-md-5">
                                {{ Form::text('datestop', NULL ,['class' => 'form-control','id' => 'datestop','placeholder' => 'Pilih Tanggal Berhenti']) }}
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-block btn-primary">Lihat Laporan</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="reportresult"></div>
</div><!-- /.row -->
@endsection
@push('scripts')
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#datestart').datepicker({ format: 'yyyy-mm-dd' });
        $('#datestop').datepicker({ format: 'yyyy-mm-dd' });
        $('#form-daily-report').submit(function(e){
            $('.page-loader-wrapper').show();
            e.preventDefault();
            getData("{{route('get.report.daily')}}");
        });
        function getData(url) {
            $.ajax({
                url : url,
                data : $('#form-daily-report').serialize(),
                type : "POST" 
            }).done(function (data) {
                $('.page-loader-wrapper').hide();
                $('.reportresult').html(data);  
            });
        }

    });
</script>
@endpush