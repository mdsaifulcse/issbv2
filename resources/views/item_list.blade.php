@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
@if($status == 1)
Active
@elseif($status == 2)
Inactive
@endif
@foreach($test_list as $test)
@if($test->id == $item_for)
{{ $test->name }}
@endif
@endforeach
Item Bank
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
        @if($status == 1)
            Active
            @elseif($status == 2)
            Inactive
        @endif

        @foreach($test_list as $test)
            @if($test->id == $item_for)
                {{ $test->name }}
            @endif
        @endforeach

        Item Bank
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/') }}">Dashboard</a>
        </li>
        <li>
            @if($status == 1)
            <a href="{{ URL::to('/item-bank/active') }}"> Active
                @elseif($status == 2)
                <a href="{{ URL::to('/item-bank/inactive') }}"> Inactive
                    @endif
                    Item Bank
                </a>
        </li>
        <li class="active">
            @if($status == 1)
            Active
            @elseif($status == 2)
            Inactive
            @endif
            @foreach($test_list as $test)
            @if($test->id == $item_for)
            {{ $test->name }}
            @endif
            @endforeach
            Item Bank
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        @if($status == 1)
                        Active
                        @elseif($status == 2)
                        Inactive
                        @endif
                        @foreach($test_list as $test)
                        @if($test->id == $item_for)
                        {{ $test->name }}
                        @endif
                        @endforeach
                        Item Bank
                    </h3>
                    @if($status == 1)
                    <div class="pull-right">
                        <a href="{{ URL::to('/items/'.$item_for.'/2') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add Item</a>
                    </div>
                    @endif
                </div>
                <div class="panel-body">

                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                @if($status == 1)
                                <th>Sl No</th>
                                @elseif($status == 2)
                                <th>Selection</th>
                                @endif
                                <th>Name</th>
                                <th>Item</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key => $value)
                            <tr>
                                @if($status == 1)
                                <td>{{ ++$key }}</td>
                                @elseif($status == 2)
                                <td class="text-center">
                                    <div class="checkbox-container">
                                        <input type="checkbox" class="check" value="{{ $value->id }}" id="check_{{$value->id}}" name="checkbox[]" />
                                    </div>
                                </td>
                                @endif
                                <td>{{ $value->name }}</td>
                                <td>
                                    @if($value->item_type == 1)
                                     <?php echo $value->item; ?> 
                                    @elseif($value->item_type == 2)
                                    <img src="{{ asset('assets/uploads/questions/images/'.$value->item) }}" alt="..." style="width: 150px; height: 95px">
                                    @elseif($value->item_type == 3)
                                    <audio controls>
                                        <source src="{{ asset('assets/uploads/questions/sounds/'.$value->item) }}" type="audio/ogg">
                                        <source src="{{ asset('assets/uploads/questions/sounds/'.$value->item) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    @endif
                                </td>
                                <td>{{$value->itemLevel->name}}</td>
                                <td>
                                    @if($value->item_status == 1)
                                    <span class="label label-success">Active</span>
                                    @elseif ($value->item_status == 2)
                                        <span class="label label-danger">Inactive</span>
                                    @elseif ($value->item_status == 3)
                                            <span class="label label-danger">Test</span>
                                    @elseif ($value->item_status == 4)
                                        <span class="label label-danger">No-Answer</span>
                                    @else
                                    <span class="label label-primary">Demo Question
                                    @endif</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ URL::to('/edit-items/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data"></i></a>
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>

                                    <br>
                                    <a href="{{ URL::to('/item-preview/'.$value->id) }}">
                                        <button class="btn btn-primary btn-sm">Preview</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $items->links() }}
                    @if($status == 2 || $status == 3)
                    <label for="checkall" style="margin:20px 15px;">
                        <div class="checkbox-container">
                            <input type="checkbox" id="checkall" data="{{ $item_for }}" name="checkall" value="1" /> Check all
                        </div>
                    </label>
                    <br>
                    <button type="submit" class="btn btn-success btn-sm submit">Activate</button>
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
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
<script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
@if($status == 2)
<script src="{{ asset('js/activate.js') }}"></script>
@endif

<script>
    $(document).ready(function() {
        if (sessionStorage.getItem('activation') == 'success') {

            toastr.success('Item has been successfully activated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("activation");
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

        @if($message = Session::get('success'))
        toastr.success('{{ $message }}', 'Success Alert', {
            timeOut: 5000
        });
        @endif
    });

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
                    url: '/destroyItem/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Item has been successfully deleted.",
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
{{ session()->forget('success') }}
@stop
