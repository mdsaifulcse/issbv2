@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test List
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
        <h1>Create Test & Test List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Test
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="form-group col-lg-4 col-md-4">
                                        <label for="category_name">Test Name</label>
                                        <input type="text" class="form-control" name="test_name" id="teset_name" placeholder="Test Name" required/>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4">
                                        <label for="category_name">Status</label>
                                        <select name="status" id="" class="form-control" required>
                                            <option value="">Choose one</option>
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4">
                                        <label for="category_name">&nbsp;</label>
                                        <br>
                                        <button class="btn btn-success create">Submit</button>
                                    </div>
                                    
                                    
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test List
                        </h3>
                        {{-- <div class="pull-right">
                            <a  href="{{ URL::to('/create-test') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add Test</a>
                        </div> --}}
                    </div>
                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">Serial No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($test_list as $key => $value)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @if($value->status == 1)
                                        <span class="label label-success">Active</span>
                                        @elseif($value->status == 2)
                                        <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" onclick=QuestionEdit('<?php echo $value->id ?>'); ></i></a>
                                        <!--<a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>-->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $test_list->links() }}
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

                toastr.success('Test has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Test has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }

            $('#example').DataTable( {
                "searching": true,
                "paging": true,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );
         } );

        function QuestionEdit(id)
        {

            swal({
                        title: "Are you sure?",
                        text: "Some data will be change in other pages!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, Edit it!",
                        closeOnConfirm: false
                    },
                    function () {
                        window.location.href = "{{url('/')}}"+'/edit-test/'+id;
                    });
        }

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
                            url: '/destroyItemLevel/' + id,
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

<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{asset('js/jequery-validation.js')}}"></script>
<script>
    $("#create_data").validate(
            {
                ignore: [],
                debug: false,
                rules: {
                    test_name: {
                        required: true
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    test_name: "This field is required",
                    status: "This field is required",
                },

                submitHandler: function(form) {
                    $('.create').text('Sending');
                    $('.create').prop('disabled', true);
                    var formData = new FormData($(form)[0]);
                    $.ajax({
                        type: "POST",
                        url: 'storeTest',
                        data:formData,
                        processData: false,
                        contentType: false,
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async: true,
                        success: function(response) {
                            if (response == 'success')
                            {
                                sessionStorage.setItem("new_success", "success");
                                window.location.href = "{{url('/')}}"+'/test-list';
                            }
                        },
                        error: function (e) {
                            toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                            $('.create').text('Submit');
                            $('.create').prop('disabled', false);
                        }
                    });

                    return false;

                }


            });
</script>
@stop
