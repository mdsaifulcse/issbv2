@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    {{$test?$test:''}} : Create Test
    @parent
@stop
@section('header_styles')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
        .color-full {
            background-color: #a0ffff!important;
        }
    </style>
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5> {{$test?$test:''}} : Test Configuration</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">{{$test?$test:''}} : Create Test Configuration</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            {{$test?$test:''}} : Create Test Configuration
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="{{route('examConfig.store')}}" method="post" class="needs-validation form-horizontal" >
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Test</label>
                                        <div class="col-lg-4">
                                            <select name="test_config_id" id="test_config_id" class="form-control" required>
                                                <option value="">Select Test</option>
                                                @foreach ($testConfigs as $test)
                                                <option value="{{$test->id}}">{{$test->test_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Test Date</label>
                                        <div class="col-lg-4">
                                            <input type="date" class="form-control" name="exam_date" required="" value="{{date('Y-m-d')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-7 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Generate Question <i class="icon-arrow-right14 position-right"></i></button>
                                        <a href="{{route('examConfig.index')."?test_for=$request->test_for"}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->

        {{--<div class="row">--}}

            {{--<div class="col-lg-12">--}}
                {{--<div class="panel panel-info">--}}
                    {{--<div class="panel-heading clearfix">--}}
                        {{--<h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>--}}
                            {{--In-Active And Force Stop Test List--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--<table id="example" class="display nowrap" style="width:100%">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th width="10%">Sl No</th>--}}
                                {{--<th width="10%">Test Name</th>--}}
                                {{--<th width="10%">Board Name</th>--}}
                                {{--<th width="15%">Test Date</th>--}}
                                {{--<th width="15%">Duration</th>--}}
                                {{--<th width="10%">Total Candidate</th>--}}
                                {{--<th width="10%">Status</th>--}}
                                {{--<th width="20%" class="text-center">Action</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($examConfigs as $key => $config)--}}
                            {{--<tr @if ($config->exam_status == 1) class="color-full" @endif>--}}
                                {{--<td @if ($config->exam_status == 1) class="color-full" @endif>{{ ++$key }}</td>--}}
                                {{--<td>{{ $config->test_name }}</td>--}}
                                {{--<td>{{ $config->board_name }}</td>--}}
                                {{--<td>{{ $config->exam_date }}</td>--}}
                                {{--<td>{{ $config->exam_duration }}</td>--}}
                                {{--<td>{{ $config->total_candidate }}</td>--}}
                                {{--<td>--}}
                                    {{--@if($config->status == 0) --}}
                                    {{--In-Active --}}
                                    {{--@else --}}
                                    {{--Force Stop --}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                {{--<td class="text-center">--}}
                                    {{--@if ($config->exam_status == 1)--}}
                                    {{--<a href="{{ route('runningExamTimeRemain', ['examId'=>$config->id]) }}">--}}
                                        {{--<i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>--}}
                                    {{--</a>--}}
                                    {{--@endif--}}
                                    {{--<a href="{{ route('examPreview', ['examId'=>$config->id]) }}" target="_blank">--}}
                                        {{--<i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#"><i data="{{ $config->id }}" class="livicon ass_conf_status_update" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>--}}
                                    {{-- <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $config->id }});></i></a> --}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                            {{--@if (!empty($examConfig))--}}
                            {{--{{ $examConfigs->links() }}--}}
                            {{--@endif--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
   {{----}}
        {{--</div>--}}

    </section>

    {{-- MODAL FOR STATUS UPDATE --}}

    {{--<div class="modal fade" id="ass_conf_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
        {{--<div class="modal-dialog" role="document">--}}
          {{--<div class="modal-content">--}}
            {{--<div class="modal-body">--}}
              {{--<form id="assessmentStatusUpdate" method="post">--}}
                {{--@csrf--}}
                {{--<div class="form-group text-center">--}}
                    {{--<h3>Are You Sure!</h3>--}}
                    {{--<h4>Publish this Test!</h4>--}}
                    {{--<input type="hidden" class="assignment_id" name="assignment_id">--}}
                {{--</div>--}}
              {{--</form>--}}
            {{--</div>--}}
            {{--<div class="modal-footer text-center" style="text-align: center !important;">--}}
              {{--<button type="button" class="btn btn-secondary text-center" data-dismiss="modal">Close</button>--}}
              {{--<button type="button" class="btn btn-primary text-center status_update_btn">Publish</button>--}}
            {{--</div>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</div>--}}

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    {{--<script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>--}}
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{asset('js/jequery-validation.js')}}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){


            @if (session('msgType') == 'success')
                toastr.success('{{ session("messege") }}', 'Success', {timeOut: 5000});
            @endif

            @if (session('msgType') == 'danger')
                toastr.warning('{{ session("messege") }}', 'Warning', {timeOut: 5000});
            @endif

            $('#example').DataTable( {
                "searching": false,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );

            $('.ass_conf_status_update').on('click', function(){
                var id = $(this).attr('data');
                $("#ass_conf_status").modal('show');
                $('.assignment_id').val(id);
            });

            $(".status_update_btn").on('click', function(e) {
                e.preventDefault();
                var assignment_id = $('.assignment_id').val();

                $.ajax({
                    type: "get",
                    url: "{{url('/assessment-status-update')}}",
                    data: {assignment_id:assignment_id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.msgType == 'success') {
                            $("#ass_conf_status").modal('hide');
                            toastr.success(data.messege, 'Success', {timeOut: 5000});
                        } else {
                            $("#ass_conf_status").modal('hide');
                            toastr.warning(data.messege, 'Warning', {timeOut: 5000});
                        }

                    }
                });
            });
        });
    </script>

@stop
