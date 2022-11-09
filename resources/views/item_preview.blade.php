@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
@if($status == 1)
Active
@elseif($status == 2)
Inactive
@else
Test
@endif

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
    .question-heading{
        display: inline-flex;
    }
    .question-answer{
        text-indent: 20px;
    }
</style>
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>
        @if($status == 1)
        Active Item
        @elseif($status == 2)
        Inactive Item
        @else
        Test Item
        @endif
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ URL::to('/') }}">Dashboard</a>
        </li>
        <li>
            @if($status == 1)
            <a href="{{ URL::to('/item-bank/active') }}"> Active </a>
            @elseif($status == 2)
            <a href="{{ URL::to('/item-bank/inactive') }}"> Inactive Item Bank </a>
            @else
            <a href="{{ URL::to('/item-bank/test') }}"> Test Item Bank </a>
            @endif
        </li>
        <li class="active">
            @if($status == 1)
            Active Item
            @elseif($status == 2)
            Inactive Item
            @else
            Test Item
            @endif
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        {{$itemDetails->item}}
                       <!--  <?php // saif
                            if ($itemDetails->sub_question_status==1) {
                                echo $itemDetails->item;
                            }else {
                                echo $itemDetails->sub_question;
                            }
                        ?> -->
                        <!-- {{ ($itemDetails->sub_question_status==1)? $itemDetails->sub_question:$itemDetails->item }} -->
                    </h3>
                </div>
                <div class="panel-body">
                    @php
                        if ($itemDetails->sub_question_status==1){
                            $itemType   = $itemDetails->sub_question_type;
                            $items      = explode('||', $itemDetails->sub_question);
                            $optionType = $itemDetails->sub_option_type;
                            $imagePath  = 'assets/uploads/sub_options/images/';
                            $soundPath  = 'assets/uploads/sub_options/sounds/';
                        } else{
                            $itemType   = $itemDetails->item_type;
                            $item       = $itemDetails->item;
                            $optionType = $itemDetails->option_type;
                            $imagePath  = 'assets/uploads/options/images/';
                            $soundPath  = 'assets/uploads/options/sounds/';
                        }
                    @endphp

                    @if ($itemDetails->sub_question_status !=1)
                    <table id="" class="" style="width:100%">
                        <tbody>
                            <tr>
                                <th width="30%">Question</th>
                                <th width="70%">:
                                    @if($itemType == 1)
                                    {{ $item }}
                                    @elseif($itemType == 2)
                                    <img src="{{ asset('assets/uploads/questions/images/'.$item) }}" alt="..." style="width: 250px; height: 150px;">
                                    @elseif($itemType == 3)
                                    <audio controls>
                                        <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/ogg">
                                        <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    @endif
                            </tr>
                            @php
                                $options = $itemDetails->options;
                                $corAns = $itemDetails->correct_answer;

                                $questionOptions = explode('||', $options);
                            @endphp

                            @if (count($questionOptions)>0)
                                <tr>
                                    <th width="30%">Options</th>
                                    <th width="70%">:</th>
                                </tr>
                                @foreach ($questionOptions as $key=>$questionOption)
                                    <tr>
                                        <th width="30%"></th>
                                        <th width="70%"> {{ $key+1 .') ' }}
                                            @if($optionType == 1)
                                                {{ $item }}
                                            @elseif($optionType == 2)
                                            <img src="{{ asset($imagePath.$questionOption) }}" alt="..." style="width: 250px; height: 150px; margin-top:5px;">
                                            @elseif($optionType == 3)
                                            <audio controls>
                                                <source src="{{ asset($soundPath.$questionOption) }}" type="audio/ogg">
                                                <source src="{{ asset($soundPath.$questionOption) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @else
                        @php
                            $optionsAll    = explode('~~', $itemDetails->sub_options);
                            $corAnswers     = explode('||', $itemDetails->sub_correct_answer);
                        @endphp
                        @foreach ($items as $key=>$item)


                        <div class="question">
                            @if($itemType == 1)
                               <h3 class="question-heading">{{$key+1}}. &nbsp; <?php echo $item?> </h3>
                                @elseif($itemType == 2)
                                <img src="{{ asset('assets/uploads/questions/images/'.$item) }}" alt="..." style="width: 250px; height: 150px;">
                                @elseif($itemType == 3)
                                <audio controls>
                                    <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/ogg">
                                    <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @endif


                        </div>

                        <div class="question-answer">
                              @php
                                $questionOptions    = explode('||', $optionsAll[$key]);
                                $corAns             = $corAnswers[$key];
                              @endphp

                            @if (count($questionOptions)>0)
                              @foreach ($questionOptions as $j=>$questionOption)

                                @if($optionType == 1)
                                    <label class="btn btn-success">{{ $questionOption }}</label>

                                @elseif($optionType == 2)
                                    <img src="{{ asset($imagePath.$questionOption) }}" alt="..." style="width: 250px; height: 150px; margin-top:5px;">
                                @elseif($optionType == 3)
                                    <audio controls>
                                        <source src="{{ asset($soundPath.$questionOption) }}" type="audio/ogg">
                                        <source src="{{ asset($soundPath.$questionOption) }}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                @endif


                               @endforeach
                            @endif
                        </div>

                        @endforeach
                    @endif
                </div>
                <div class="panel-footer">
                    <button onclick="history.go(-1)">Back to List</button>
                    {{-- <a href="@if($status == 1) {{ URL::to('/item-bank/active') }} @elseif($status == 2) {{ URL::to('/item-bank/inactive') }} @else {{ URL::to('/item-bank/test') }} @endif">
                        <button class="btn btn-default btn-sm">Back to List</button>
                    </a> --}}
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
