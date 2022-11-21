@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test List
    @parent
@stop

{{-- page level styles --}}
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

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Test List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12" style="">
                <div class="panel panel-primary " style="border: 1px solid red; margin-bottom: 50px;">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            All Active Test List
                        </h3>
                        <div class="pull-right">
                            {{--<a href="{{ route('examConfig.create') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Create Test</a>--}}
                        </div>
                    </div>

                    <div class="panel-body">
                        <table id="activeTest" class="display nowrap" style="width:100%">
                            <thead>
                            <tr class="color-full">
                                <th width="10%">Sl No</th>
                                <th width="10%">Test For</th>
                                <th width="10%">Test Name</th>
                                <th width="10%">Board Name</th>
                                <th width="15%">Test Date</th>
                                <th width="15%">Duration</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examConfigs as $key => $config)
                                @if($config->status == 1 && $config->preview_status == 1)
                                <tr @if ($config->exam_status == 1) class="bg" @endif>
                                    <td @if ($config->exam_status == 1) class="color-full1" @endif>{{ ++$key }}</td>
                                    <td>{{ $config->testConfig->testFor->name }}</td>
                                    <td>{{ $config->testConfig->test_name }}</td>
                                    <td>{{ $config->boardCandidate->board_name }}</td>
                                    <td>{{ $config->exam_date }}</td>
                                    <td>{{ $config->exam_duration }}</td>
                                    <td>{{ $config->boardCandidate->total_candidate }}</td>
                                    <td> <a href="{{ route('examConfig.show', [$config->id]).'?status=0' }}"><b>Activate</b> </a>   </td>
                                    <td class="text-center">
                                        @if ($config->exam_status == 1)
                                            <a href="{{ route('runningExamTimeRemain', ['examId'=>$config->id]) }}">
                                                <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('examPreview', ['examId'=>$config->id]) }}" target="_blank">
                                            <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                        </a>
                                        <a href="{{ route('examConfig.edit', [$config->id]) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                        <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $config->id }});></i></a>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>



                        </table>
                        @if(count($examConfigs)>0)
                            {{ $examConfigs->links() }}
                        @endif
                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                          All  Test List
                        </h3>
                        <div class="pull-right">
                            {{--<a href="{{ route('examConfig.create') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Create Test</a>--}}
                        </div>
                    </div>

                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr class="color-full">
                                <th width="10%">Sl No</th>
                                <th width="10%">Test For</th>
                                <th width="10%">Test Name</th>
                                <th width="10%">Board Name</th>
                                <th width="15%">Test Date</th>
                                <th width="15%">Duration</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examConfigs as $key => $data)
                                @if($data->status != 1 && $data->preview_status != 1)
                                <tr @if ($data->exam_status == 1) class="color-full1" @endif>
                                    <td @if ($data->exam_status == 1) class="color-full1" @endif>{{ ++$key }}</td>
                                    <td>{{ $data->testConfig->testFor->name }}</td>
                                    <td>{{ $data->testConfig->test_name }}</td>
                                    <td>{{ $data->boardCandidate->board_name }}</td>
                                    <td>{{ $data->exam_date }}</td>
                                    <td>{{ $data->exam_duration }}</td>
                                    <td>{{ $data->boardCandidate->total_candidate }}</td>
                                    <td>@if($data->status == 1 && $data->preview_status == 1)
                                            <a href="{{ route('examConfig.show', [$data->id]).'?status=0' }}"><b>Activate</b> </a>
                                        @else
                                            <a href="{{ route('examConfig.show', [$data->id]).'?status=1' }}"><b class="text-danger">In-Active</b></a>
                                        @endif</td>
                                    <td class="text-center">
                                        @if ($data->exam_status == 1)
                                        <a href="{{ route('runningExamTimeRemain', ['examId'=>$data->id]) }}">
                                            <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('examPreview', ['examId'=>$data->id]) }}" target="_blank">
                                            <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                        </a>
                                        <a href="{{ route('examConfig.edit', [$data->id]) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                        <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $data->id }});></i></a>
                                        <a href="#"><i data="{{ $config->id }}" class="livicon ass_conf_status_update" data-name="info" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                    </td>
                                </tr>
                                @endif

                            @endforeach
                            </tbody>



                        </table>
                        @if(count($examConfigs)>0)
                        {{ $examConfigs->links() }}
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </section>

    {{-- MODAL FOR STATUS UPDATE --}}
    <div class="modal fade" id="ass_conf_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="assessmentStatusUpdate" method="post">
                        @csrf
                        <div class="form-group text-center">
                            <h3>Are You Sure!</h3>
                            <h4>Publish this Test!</h4>
                            <input type="hidden" class="assignment_id" name="assignment_id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center" style="text-align: center !important;">
                    <button type="button" class="btn btn-secondary text-center" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-center status_update_btn">Publish</button>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
    @stop

    {{-- page level scripts --}}
@section('footer_scripts')

    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            console.log('sdf')

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
                            window.location="{{Request::path()}}"+"?test_config_id={{$request->test_config_id}}";
                        } else {
                            $("#ass_conf_status").modal('hide');
                            toastr.warning(data.messege, 'Warning', {timeOut: 5000});
                        }

                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            @if (session('msgType') == 'success')
                toastr.success('{{ session("messege") }}', 'Success', {timeOut: 5000});
            @endif

            @if (session('msgType') == 'danger')
                toastr.warning('{{ session("messege") }}', 'Warning', {timeOut: 5000});
            @endif

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Assessment has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }

            $('#activeTest').DataTable( {
                "searching": true,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );


            $('#example').DataTable( {
                "searching": true,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );
        });

        function Delete(id)
        {

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {
                $.ajax({
                    url: '/examConfig/' + id,
                    method: 'DELETE',
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        setTimeout(function () {
                            swal({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
                    }
                })
            });
        }
    </script>
@stop
