@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test Group
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
         .lowercase {
             text-transform: lowercase;
         }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Test Group</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Group</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test Group
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form id="create_test_group">
                            @foreach($test_groups as $groups)
                                @if($groups->groups == 1)
                                    <?php $intelligence_test = 1;?>
                                @endif
                                @if($groups->groups == 2)
                                    <?php $personality_test = 1;?>
                                @endif
                                @if($groups->groups == 3)
                                    <?php $psym_test = 1;?>
                                @endif
                            @endforeach
                            <div class="form-group">
                                <label for="test_group">Test Group</label>
                                <select name="test_group"  id="test_group" class="form-control" required>
                                    <option value="">Choose one</option>
                                    @if(!isset($intelligence_test))
                                        <option value="1">Intelligence Test</option>
                                    @endif
                                    @if(!isset($personality_test))
                                        <option value="2">Personality Test</option>
                                    @endif
                                    @if(!isset($psym_test))
                                        <option value="3">PSYM Test</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="test_config">Select Test </label>
                                <select name="test_config[]" id="test_config" class="form-control select2" multiple="multiple" required>
                                    <option value="">Choose one </option>
                                    @if(isset($test_list))
                                        @foreach($test_list as $key => $value)
                                            @if(isset($value[0]))
                                                <option value="{{ $value[0]->id }}">{{ $value[0]->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <label id="test_config-error" class="error" for="test_config" hidden></label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                            </div>
                        </form>

                        @if($count >=1)
                            <br>
                            <table id="example" class="display nowrap" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Test Group Name</th>
                                    <th>Grouping</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($test_groups as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if($value->groups == 1)
                                                Intelligence Test
                                            @elseif($value->groups == 2)
                                                Personality Test
                                            @elseif($value->groups == 3)
                                                PSYM Test
                                            @endif
                                        </td>
                                        <?php $explode_test_list = explode('||', $value->test_config_id);?>
                                        <td>
                                            @foreach($explode_test_list as $explode_test)
                                                @foreach($test_list_show as $config)
                                                    @if($config->id == $explode_test)
                                                        <span class="badge badge-info">{{ $config->name }}</span>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=TestGroupDelete('<?php echo $value->id ?>');></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
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


    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/jquery.dataTables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme:"bootstrap",
                placeholder:"Choose one",
                dropdownAutoWidth : true,
                width: 'auto'

            });
            if (sessionStorage.getItem('new_success') == 'success') {

                toastr.success('Test group has been successfully created', 'Success Alert', {timeOut: 5000});
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
            });

            $("#create_test_group").validate(
                    {
                        ignore: [],
                        debug: false,
                        rules: {},
                        messages: {},
                        submitHandler: function(form) {
                            $('.submit').text('Sending...');
                            $('.submit').prop('disabled', true);
                            var formData = new FormData($(form)[0]);
                            $.ajax({
                                type: "POST",
                                url: '/storeTestGroup',
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
                                        window.location.reload();
                                    }
                                },
                                error: function (e) {
                                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                                }
                            });

                            return false;
                        }
                    });


         } );

        function TestGroupDelete(id)
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
                            url: '/destroyTestGroup/' + id,
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Test group has been deleted.",
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
