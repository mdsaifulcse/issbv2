@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @if($db == 'pm-set')PM @elseif($db == 'vit-set') VIT @endif Item Set
    @parent
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
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>@if($db == 'pm-set')PM @elseif($db == 'vit-set') VIT @endif Item Set</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">@if($db == 'pm-set')PM @elseif($db == 'vit-set') VIT @endif Item Set</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            @if($db == 'pm-set')PM @elseif($db == 'vit-set') VIT @endif Item Set
                        </h3>
                        <div class="pull-right">
                            @if($db == 'pm-set')
                                <a href="{{ URL::to('/create-pm-item-set') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" ></span>Create PM Item Set</a>
                            @elseif($db == 'vit-set')
                                <a href="{{ URL::to('/create-vit-item-set') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" ></span>Create VIT Item Set</a>
                            @endif

                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Item Set Name</th>
                                <th>Total Time</th>
                                <th>Pass Mark</th>
                                <th>Item Set For</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($question_set as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->item_set_name }}</td>
                                    <td>{{ $value->total_time }} min</td>
                                    <td>{{ $value->pass_mark }}</td>
                                    <td>
                                        @foreach($candidate_types as $candidate_type)
                                            @if($candidate_type->id == $value->candidate_type) {{ $candidate_type->name }} @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($db == 'pm-set')
                                            <a href="{{ URL::to('/single-question-view/pm-set/'.$value->id) }}"><i class="livicon" data-name="eye-open" data-size="20" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view details"></i></a>
                                            <a href="{{ URL::to('/update-iq-question-set/pm-set/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                        @elseif($db == 'vit-set')
                                            <a href="{{ URL::to('/single-question-view/vit-set/'.$value->id) }}"><i class="livicon" data-name="eye-open" data-size="20" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view details"></i></a>
                                            <a href="{{ URL::to('/update-iq-question-set/vit-set/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                        @endif
                                        <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=PermissionDelete('<?php echo $value->id ?>');></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $question_set->links() }}
                    </div>
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

    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('update_success') == 'success') {

                toastr.success('Item Set has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Item Set has been successfully created', 'Success Alert', {timeOut: 5000});
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

        function PermissionDelete(id)
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
                            @if($db == 'pm-set')
                            url: '/deleteIQquestionSet/pm-set/' + id,
                            @elseif($db == 'vit-set')
                            url: '/deleteIQquestionSet/vit-set/' + id,
                            @endif
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Item set has been deleted.",
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
