@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Assessment List
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
        <h1>Assessment List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Assessment List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Assessment List
                        </h3>
                        <div class="pull-right">
                            <a href="{{ route('examConfig.create') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Create Assessment</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">Sl No</th>
                                <th width="10%">Test Name</th>
                                <th width="10%">Board Name</th>
                                <th width="15%">Assessment Date</th>
                                <th width="15%">Duration</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examConfigs as $key => $config)
                            <tr @if ($config->exam_status == 1) class="color-full" @endif>
                                <td @if ($config->exam_status == 1) class="color-full" @endif>{{ ++$key }}</td>
                                <td>{{ $config->test_name }}</td>
                                <td>{{ $config->board_name }}</td>
                                <td>{{ $config->exam_date }}</td>
                                <td>{{ $config->exam_duration }}</td>
                                <td>{{ $config->total_candidate }}</td>
                                <td>@if($config->preview_status == 0) Pending @else Activated @endif</td>
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
                            @endforeach
                            </tbody>
                            @if (!empty($examConfig))
                            {{ $examConfigs->links() }}
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- content -->
    @stop

    {{-- page level scripts --}}
@section('footer_scripts')

    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

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
