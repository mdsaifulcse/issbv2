@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Question Set List
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
        . content-height{
            max-height:400px;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>
            Question Set List
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li>
                <a href="{{ URL::to('/question-set') }}">Question Set</a>
            </li>
            <li class="active">
                Question Set List
            </li>
        </ol>
    </section>
    <section class="content content-height">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Question Set List
                        </h3>
                        <div class="pull-right">
                            <a href="{{ URL::to('/create-set') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" ></span>Create new set</a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">SL No</th>
                                <th width="35%">Item For</th>
                                <th width="35%">Item Set Name</th>
                                {{-- <th>Total Time</th> --}}
                                <th width="15%">Item Set For</th>
                                <th width="15%">Set</th>
                                <th width="15%">Item Set Type</th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($questions_set as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->itemFor->name }}</td>
                                    <td>{{ $value->item_set_name }}</td>
                                    {{-- <td>{{ $value->total_time }} min</td> --}}
                                    <td> {{$value->candidateType->name}} </td>
                                    <td>{{ ucfirst($value->set_type) }}</td>
                                    <td>
                                        @if($value->set_configuration_type == 1)
                                            <span class="badge badge-info">Random</span>
                                        @elseif($value->set_configuration_type == 2)
                                            <span class="badge badge-info">Static</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ URL::to('/edit-item-set/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                        <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionSetDelete('<?php echo $value->id ?>');></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $questions_set->links() }}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->



    <section class="content-header">
        <!--section starts-->
        <h1>
            Test Config List</h1>
        <ol class="breadcrumb">

        </ol>
    </section>
    <section class="content content-height">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test Config List
                        </h3>
                    </div>
                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">SL No</th>
                                <th width="10%">Test For</th>
                                <th width="50%">Test Name</th>
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
                                    <td>{{ $value->testFor->name }}</td>
                                    <td>{{ $value->test_name }}</td>
                                    <td>
                                        @if (!empty($value->set_id))
                                            Satic
                                        @else
                                            Random
                                        @endif
                                    </td>
                                    <td>{{ $value->total_time }}</td>
                                    <td>{{ $value->pass_mark }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('configInstruction.index', ['configId'=>$value->id]) }}" class="btn btn-sm btn-primary">Set Instruction Slide</a>
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



    </section>

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')

            <!-- For Editors -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('update_success') == 'success') {

                toastr.success('Question set has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Question set has been successfully created', 'Success Alert', {timeOut: 5000});
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

        function QuestionSetDelete(id)
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
                            url: '/destroyItemSet/' + id,
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Question set has been deleted.",
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
