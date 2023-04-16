@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Candidate Type
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
    <h1>Candidate Type</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">Candidate Type</li>
    </ol>
</section>
<section class="content">

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Create Candidate Type
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="form">
                        <form method="POST" id="create_data" enctype="multipart/form-data"  class="needs-validation" novalidate>
                            <div class="row">
                                <div class="form-group col-md-8 col-lg-8">
                                    <label for="candidate_type">Candidate Type</label>
                                    <input type="text" class="form-control" name="candidate_type" id="candidate_type" placeholder="Candidate Type" required/>
                                </div>
                                <div class="form-group col-md-2 col-lg-2">
                                    <label for="candidate_type">&nbsp;</label><br>
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
                        Candidate Type List
                    </h3>
                    {{-- <div class="pull-right">
                        <a href="{{ URL::to('/create-candidate-type') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add New</a>
                    </div> --}}
                </div>
                <div class="panel-body">

                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidate_types as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->name }}</td>
                                <td class="text-center">
                                    <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" onclick=QuestionEdit('<?php echo $value->id ?>');></i></a>
                                    <!--<a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>-->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $candidate_types->links() }}
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
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{asset('js/jequery-validation.js')}}"></script>
<script>
    $("#create_data").validate(
            {
                ignore: [],
                debug: false,
                rules: {
                },
                messages: {
                },

                submitHandler: function(form) {
                    $('.create').text('Sending');
                    $('.create').prop('disabled', true);
                    var formData = new FormData($(form)[0]);
                    $.ajax({
                        type: "POST",
                        url: 'storeCandidateType',
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
                                window.location.href = '/candidate-type';
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
<script>
    $(document).ready(function() {

        if (sessionStorage.getItem('update_success') == 'success') {

            toastr.success('Candidate type has been successfully updated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("update_success");
        } else if (sessionStorage.getItem('new_success') == 'success') {
            toastr.success('Candidate type has been successfully created', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("new_success");
        }

        $('#example').DataTable({
            "searching": false,
            "paging": false,
            "info": false,
            "lengthChange": false,
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": 2
            }]
        });
    });


    function QuestionEdit(id) {

        swal({
                title: "Are you sure?",
                text: "Some data will be change in other pages!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Edit it!",
                closeOnConfirm: false
            },
            function() {
                window.location.href = '/update-candidate-type/' + id;
            });
    }

    function QuestionDelete(id) {

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: '/destroyCandidateType/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function(e) {
                        toastr.error('You Got Error', 'Inconceivable!', {
                            timeOut: 5000
                        })
                    }
                })


            });
    }
</script>


{{ Session::forget('success') }}


@stop