@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Exam Configuration
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
        <h1>Assessment Schedules</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Assessment Schedules</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Assessment Schedules
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Test Name</th>
                                <th>Assessment Date</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($examConfigs as $key => $config)
                            <tr @if ($config->exam_status == 1) class="color-full" @endif>
                                <td @if ($config->exam_status == 1) class="color-full" @endif>{{ ++$key }}</td>
                                <td>{{ $config->test_name }}</td>
                                <td>{{ $config->exam_date }}</td>
                                <td>{{ $config->exam_duration }} Minutes</td>
                                <td>@if($config->preview_status == 0) Pending @else Activated @endif</td>
                                <td class="text-center">
                                    <a href="{{ url('examPreview?examId='.$config->id) }}" target="_blank" class="btn btn-sm btn-primary">Preview Exam</a>

                                    @if ($config->exam_status == 2)
                                        <a href="#" class="btn btn-sm btn-success" disabled>Exam Completed</a>
                                    @else
                                        @if($config->preview_status == 1)
                                        <a href="{{ route('examInstruction', ['examId'=>$config->id]) }}" class="btn btn-sm btn-primary">Show Introduction</a>
                                        @endif
                                    @endif

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

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Exam has been successfully created', 'Success Alert', {timeOut: 5000});
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
         } );

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
