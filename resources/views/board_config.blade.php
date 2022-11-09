@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Board Configuration
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
        <h1>Board Configuration</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Board Configuration</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Board Configuration
                        </h3>
                    </div>
                    <div class="panel-body">

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Test Group</th>
                                <th>Test Names</th>
                                <th>Result</th>
                                <th>Time</th>
                                <th>Total Item</th>
                                <th>Pass Mark</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($test_groups as $key => $value)
                            <tr>
                                <td>{{ ++$key .'-'.$value->id}}</td>
                                <td>
                                    @if($value->groups == 1)
                                        Intelligence Test
                                    @elseif($value->groups == 2)
                                        Personality Test
                                    @elseif($value->groups == 3)
                                        PSYM Test
                                    @endif
                                </td>
                                <?php
                                    $explode_test_config = explode('||', $value->test_config_id);
                                    $totalTime      = 0;
                                    $totalItem      = 0;
                                    $totalSetItem   = 0;
                                    $passMarks      = 0;
                                ?>

                                <td>
                                    @foreach($explode_test_config as $explode_test)
                                        {{ $explode_test }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    <label for="merge_result_{{ $value->id }}">
                                        <input type="checkbox" id="merge_result_{{ $value->id }}" data="{{ $value->id }}" class="merge_result" name="merge_result" value="1"> Merge Result
                                    </label>
                                </td>
                                <td>
                                    @foreach($explode_test_config as $explode_test)
                                        {{ $explode_test }} <br>
                                    @endforeach
                                    {{ $totalTime }} Mins
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    
                                </td>
                                <td>Active</td>
                                <td class="text-center">
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete();></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            {{ $test_groups->links() }}
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- content -->

    <!-- Modal -->
    <div class="modal fade" id="mergeResults" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Merge Result</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="merge_result_form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="random">
                                <input type="radio" class="merge_status" name="merge_status" id="random" value="1" required> Percentage &nbsp;
                            </label>
                            <label for="static">
                                 <input type="radio" class="merge_status" name="merge_status" id="static" value="2"> File
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

            $('.merge_result').on('change', function(){
                var checked = $(this).prop('checked')==true;
                var id = $(this).attr('data');

                if(checked)
                {
                    $('#mergeResults').modal('show');
                }

                $('#merge_result_form').on('submit', function(){
                    var value = $('.merge_status:checked').val();

                    console.log('selected value =',value, 'id =',id);
                    return false;
                });
            });

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Board has been successfully created', 'Success Alert', {timeOut: 5000});
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
@stop
