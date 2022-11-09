@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    PM @if($status==1) Active  @else Inactive @endif Item Bank
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
        <h1>PM @if($status==1) Active  @else Inactive @endif Item List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
              @if($status==1)
            <li>
                <a href="{{ URL::to('/item-bank/active') }}">Active Item Bank</a>
            </li>
            @else
            <li>
                <a href="{{ URL::to('/item-bank/inactive') }}">Inactive Item Bank</a>
            </li>
            @endif
            <li class="active">PM @if($status==1) Active  @else Inactive @endif Item List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            PM @if($status==1) Active  @else Inactive @endif Item List
                        </h3>
                        <div class="pull-right">
                            <a  href="{{ URL::to('/create-question') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add New PM Item</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Item Type</th>
                                <th>Item Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($questions as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>@if($value->question_type == 1)
                                            Text Question
                                            @else
                                            Image Question
                                            @endif
                                        </td>
                                        <td>
                                            @if($value->publish_status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-warning">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/update-question-bank/pm/'.$value->id.'/'.$status) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                            <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $questions->links() }}
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

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('update_success') == 'success') {

                toastr.success('PM Item has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('PM Item has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }
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
        } );

        function QuestionDelete(id)
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
                            url: '/delete-question/pm/' + id,
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Question has been deleted.",
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