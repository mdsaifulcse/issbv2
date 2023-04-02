@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test Configuration
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
            background-color: #c6aa68!important;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    {{--<section class="content-header">--}}
        {{--<!--section starts-->--}}
        {{--<h1>Board & Candidates</h1>--}}
        {{--<ol class="breadcrumb">--}}
            {{--<li>--}}
                {{--<a href="#">Admin</a>--}}
            {{--</li>--}}
            {{--<li class="active">Board & Candidates</li>--}}
        {{--</ol>--}}
    {{--</section>--}}
    <br>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Board & Candidates
                        </h3>
                        <div class="pull-right">
                            <a href="{{ url('savegenarateToken') }}" class="btn btn-sm btn-primary" title="Click here to generate token and download user"><span class="glyphicon glyphicon-download"></span></a>
                        </div>
                    </div>
                    <div class="panel-body">

                        <!--Board Create form Start-->
                        <div class="form">
                            <form action="{{route('boardCandidate.store')}}" method="post" class="needs-validation form-horizontal0">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-3">
                                        <label class="control-label">Board No </label>
                                        <div class="">
                                            <input type="text" class="form-control" name="board_name" required="">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="control-label">Total Candidate</label>
                                        <div class="">
                                            <input type="number" class="form-control" name="total_candidate" required="">
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label class="control-label" for="status">Select Status</label>
                                        <div class="">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">Select Test</option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">In Active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label class="control-label" for="status"></label>
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">Create <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                    </div>


                                </div>



                            </form>
                        </div>
                        <hr>

                        <!--Board Create form End-->


                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">Sl No</th>
                                <th width="20%">Board No</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($boardCandidates as $key => $candidate)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $candidate->board_name }}</td>
                                <td>{{ $candidate->total_candidate }}</td>
                                <td>@if($candidate->status == 0) <button class="btn btn-danger">InActive</button> @else <button class="btn btn-success">Active</button> @endif</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal{{$candidate->id}}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                    <a href="javascript:void(0)"><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $candidate->id }});></i></a>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{$candidate->id}}" role="dialog">{{ route('boardCandidate.edit', [$candidate->id]) }}
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update <u>{{$candidate->board_name}}</u> info</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="form">
                                                <form action="{{route('boardCandidate.update', [$candidate->id])}}" method="post" class="needs-validation form-horizontal0">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-lg-6">
                                                            <label class="control-label">Board No</label>
                                                            <div class="">
                                                                <input type="text" class="form-control" name="board_name" value="{{$candidate->board_name}}" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-3">
                                                            <label class="control-label">Total Candidate</label>
                                                            <div class="">
                                                                <input type="number" class="form-control" name="total_candidate" value="{{$candidate->total_candidate}}" required="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-3">
                                                            <label class="control-label" for="status">Select Status</label>
                                                            <div class="">
                                                                <select name="status" id="status" class="form-control" required>
                                                                    <option value="">Select Test</option>
                                                                    <option value="1" @if($candidate->status == 1) selected @endif>Active</option>
                                                                    <option value="0" @if($candidate->status == 0) selected @endif>In Active</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-3">
                                                            <label class="control-label" for="status"></label>
                                                            <div class="">
                                                                <button type="submit" class="btn btn-warning">Update <i class="icon-arrow-right14 position-right"></i></button>
                                                            </div>
                                                        </div>


                                                    </div>

                                                </form>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Modal End -->
                            @endforeach
                            </tbody>
                            @if (!empty($boardCandidates))
                            {{ $boardCandidates->links() }}
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
                    url: '/boardCandidate/' + id,
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
