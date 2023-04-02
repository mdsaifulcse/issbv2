@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test Config List
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>
           Test Config List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ URL::to('/') }}">Admin</a>
            </li>
            <li>
                <a href="{{ URL::to('/test-configuration-list') }}">Test Config</a>
            </li>
            <li class="active">
                 Test Config List
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                         Test Config List for @if(isset($testData)) {{$testData->name}} @endif
                        </h3>
                        <div class="pull-right">
                            @if(isset($testData))
                                <a href="{{ URL::to('/test-configuration-list') }}" class="btn btn-sm btn-primary" title="All Test and Result Config list"><span class="glyphicon glyphicon-list" ></span> All Test List</a>
                            @endif
                            <a href="{{ URL::to('/new-test-configuration') }}" class="btn btn-sm btn-primary" title="Create new Test and Result Config"><span class="glyphicon glyphicon-plus" ></span> Create new</a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">SL No</th>
                                <th width="10%">Test For</th>
                                <th width="50%">Test Name</th>
                                <th width="50%">Total Item</th>
                                <th width="10%">Type</th>
                                <th width="5%">Total Time</th>
                                <th width="5%">Pass Mark</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($test_config_list as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        <input type="hidden" value="{{ $value->testFor->id }}" id="test_id{{$value->id}}"/>
                                        {{ $value->testFor->name }}</td>
                                    <td>
                                        {{ $value->test_name }}</td>
                                    <td>
                                        <input type="hidden" value="{{ $value->total_item }}" id="total_item{{$value->id}}"/>
                                        {{ $value->total_item }}</td>
                                    <td>
                                        @if (!empty($value->set_id))
                                            <span class="btn btn-success">Static</span>
                                        @else
                                            <span class="btn btn-primary">Random </span>
                                        @endif
                                    </td>

                                    <td>{{ $value->total_time }}</td>
                                    <td>{{ $value->pass_mark }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('configInstruction.index', ['configId'=>$value->id]) }}" class="btn btn-sm btn-primary" title="Click here to set Instruction slider">Instruction</a>

                                        @if(count($value->resultConfigData)>0)
                                            <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="showEditResultConfigModal({{$value->id}})" title="Edit Result Config"><span class="glyphicon glyphicon-edit" ></span> Result Config</a>
                                        @else
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="showCreateResultConfigModal({{$value->id}})" title="Click here to set Result Config"><span class="glyphicon glyphicon-plus" ></span> Result Config</a>
                                        @endif

                                        @if(Auth::user()->hasRole('admin'))
                                        <a href="{{ URL::to('update-test-configuration/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                        <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=testDelete('<?php echo $value->id ?>'); ></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $test_config_list->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="resultConfigModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

                <!-- Modal content-->

                <div class="modal-content" id="testConfigDetails">

                </div>

            </div>
        </div>

    </section>
    <!-- content -->

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')

            <!-- For Editors -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

    @if(Session::has('success'))
        <script type="text/javascript">
            swal({
                title: "Success",
                text: "{{Session::get('success')}}",
                type: "success",
                confirmButtonText: "OK"
            });
        </script>
    @endif
    @if(Session::has('errors'))
        <script type="text/javascript">
            toastr.error("{{Session::get("errors")}}", 'Error Alert', {timeOut: 5000});
        </script>
    @endif

    <script>
        function showCreateResultConfigModal(text_config_id) {

            var total_question=$('#total_item'+text_config_id).val()

            if(total_question==0){
                $('#testConfigDetails').empty();
            }else{
                $('#testConfigDetails').html('<center><img src=" {{asset('images/default/loading.gif')}}"/></center>')
                    .load('{{URL::to("load-test-result-config")}}/'+text_config_id+'/'+total_question);
            }

            $('#resultConfigModal').modal('show')
        }

        function showEditResultConfigModal(text_config_id) {

            var total_question=$('#total_item'+text_config_id).val()

            if(total_question==0){
                $('#testConfigDetails').empty();
            }else{
                $('#testConfigDetails').html('<center><img src=" {{asset('images/default/loading.gif')}}"/></center>')
                    .load('{{URL::to("edit-load-test-result-config")}}/'+text_config_id+'/'+total_question);
            }

            $('#resultConfigModal').modal('show')
        }
    </script>

    <script>
        $(document).ready(function() {
            if (sessionStorage.getItem('update_success') == 'success') {

                toastr.success('Test Config has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Test Config has been successfully created', 'Success Alert', {timeOut: 5000});
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

        function testDelete(id)
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
                    url: '/destroyTestConfig/' + id,
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
