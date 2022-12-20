@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Dashboard
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<style>
    a.view-details {
        color: #ffffff;
    }

    .lightbluebg {
        background: #272467;
    }


    .panel {
        border-radius: 0;
    }

    .panel-body b{
        /*min-height: 120px;*/
        font-size: 22px;
    }


    /* --- ---  */

    a.view-details {
        color: #ffffff;
    }

    .lightbluebg {
        background: #272467;
    }

    .panel {
        border-radius: 0;
    }

    *,*:before,*:after {
        box-sizing: border-box;
    }
    html {
        font-size: 16px;
    }

    .plane {
        margin: 20px auto;
        /* max-width: 300px; */
    }


    .fuselage {
        border: 5px solid #d8d8d8;
    }

    ol {
        list-style :none;
        padding: 0;
        margin: 0;
    }

    .seats {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
    }

    .seat {
        display: flex;
        flex: 10 0 14.28571428571429%;
        padding: 5px;
        position: relative;
    &:nth-child(3) {
         margin-right: 14.28571428571429%;
     }
    }
    .seats .seat span {
        /* background: #bada55;  */
        display: block;
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.5rem;
        padding: 4px 0;
        background: #F42536;
        border-radius: 5px;
    }
    .bg-green { background: green!important; color: white !important; }
    .bg-red { background: red!important; }
    .mr-20 { margin-right: 20px; }

    .live-div-right {
        float: right;
        font-size: 18px;
        margin-right: 40px;
    }

</style>
<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/vendors/modal-popup-ybox/dist/css/yBox.min.css') }}" rel="stylesheet" />
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h4>Welcome to Psychometric Dimension</h4>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">Dashboard</li>
    </ol>
</section>

@if(Auth::user()->hasRole('admin'))
<section class="content">
    <h1 class="text-center" style="color: #515763;">Welcome to Admin</h1>
</section>
@endif

@if(Auth::user()->hasRole('testing'))
<section class="content">
    <div class="row">
        <div class="col-md-3 animated fadeInLeftBig">

            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <a class="view-details" href="#">
                        <b>Current Board Number</b>
                    </a>
                </div>
                <div class="panel-body">
                    <b>{{$activeBoard?$activeBoard->board_name:'N/A'}}</b>
                </div>
            </div>

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <a class="view-details" href="#"><b>Total Number of Candidate</b></a>
                </div>
                <div class="panel-body">
                    <b>{{$activeBoard?$activeBoard->total_candidate:'N/A'}}</b>
                </div>
            </div>

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            {{--<a class="view-details" href="{{url('/examConfig?all_active=1')}}">--}}
            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <b>Active Tests</b>
                </div>
                <div class="panel-body">
                    <b>{{$activeTest}}</b>
                </div>
            </div>
            {{--</a>--}}

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            <a class="view-details" href="{{url('/stdSeatPlan')}}">
            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <b>Seat plan</b>
                </div>
                <div class="panel-body panel-primary">
                    <b>{{$total_live}}/{{$activeBoard?$activeBoard->total_candidate:'N/A'}}</b>
                </div>
            </div>
            </a>

        </div>

    </div>
    <!--/row-->

    <div class="row">

        <div class="col-lg-12" style="">
            <div class="panel panel-primary " style="border: 1px solid red; margin-bottom: 50px;">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        All Active Test List
                    </h3>
                    <div class="pull-right">
                        {{--<a href="{{ route('examConfig.create') }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Create Test</a>--}}
                    </div>
                </div>

                <div class="panel-body">
                    <table id="activeTest" class="display nowrap" style="width:100%">
                        <thead>
                        <tr class="color-full">
                            <th width="10%">Sl No</th>
                            <th width="10%">Test For</th>
                            <th width="10%">Test Name</th>
                            <th width="10%">Board Name</th>
                            <th width="15%">Test Date</th>
                            <th width="15%">Duration</th>
                            <th width="10%">Total Candidate</th>
                            <th width="10%">Status</th>
                            <th width="20%" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($examConfigs as $key => $config)
                            @if($config->status == 1 && $config->preview_status == 1)
                                <tr @if ($config->exam_status == 1) class="bg" @endif>
                                    <td @if ($config->exam_status == 1) class="color-full1" @endif>{{ ++$key }}</td>
                                    <td>{{ $config->testConfig?$config->testConfig->testFor->name:'N/A' }}</td>
                                    <td>{{ $config->testConfig?$config->testConfig->test_name:'N/A' }}</td>
                                    <td>{{ $config->boardCandidate->board_name }}</td>
                                    <td>{{ $config->exam_date }}</td>
                                    <td>{{ $config->exam_duration }}</td>
                                    <td>{{ $config->boardCandidate->total_candidate }}</td>
                                    <td> <a href="{{ route('examConfig.show', [$config->id]).'?status=0' }}" onclick="return confirm('Are sure to change this status?')">Active </a>   </td>
                                    <td class="text-center">
                                        @if ($config->exam_status == 1)
                                            <a href="{{ route('runningExamTimeRemain', ['examId'=>$config->id]) }}">
                                                <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('examPreview', ['examId'=>$config->id]) }}" target="_blank">
                                            <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                        </a>
                                            <?php
                                                $test_for=$config->testConfig?$config->testConfig->testFor->id:0;
                                            ?>
                                        <a href="{{ route('examConfig.edit', [$config->id])."?test_for=$test_for" }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                        {{--<a href="javascript:void(0)"><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $config->id }});></i></a>--}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>



                    </table>
                    @if(count($examConfigs)>0)
                        {{ $examConfigs->links() }}
                    @endif
                </div>

            </div>
        </div>

    </div>

    <div class="row text-center">
        <h3><span>Initial Login Status</span>   <span class="live-div-right">{{$total_live}}/{{$activeBoard?$activeBoard->total_candidate:'N/A'}} [ Till logged in {{$total_live}} out of {{$activeBoard?$activeBoard->total_candidate:'N/A'}} ]</span></h3>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">
                    @php
                        $left_arr = [
                            [191, 171, 147, 120],
                            [192, 172, 148, 121],
                            [193, 173, 149, 122],
                            [194, 174, 150, 123],
                            [195, 175, 151, 124],
                            [196, 176, 152, 125],
                            [197, 177, 153, 126],
                            [198, 178, 154, 127],
                            [199, 179, 155, 128],
                            [200, 180, 156, 129],
                            ['', 181, 157, 130],
                            ['', '', 158, 131],
                            ['', '', 159, 132],
                            ['', '', '', 133],
                        ]
                    @endphp
                    @foreach ($left_arr as $lRow)
                        <li class="row row--1">
                            <ol class="seats" type="A">
                                @foreach ($lRow as $lCol)
                                    @php
                                        $candidate = 'candidate_'.$lCol;
                                    @endphp
                                    <li class="seat">
                                        @if($lCol != '')<span class="bg-@if(@$$candidate == 1)green @else red @endif">{{$lCol}}</span>@endif
                                    </li>
                                @endforeach
                            </ol>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">

                    @php
                        $middle_arr = [
                            [91, 76, 61, 46, 31, 16,  1],
                            [92, 77, 62, 47, 32, 17,  2],
                            [93, 78, 63, 48, 33, 18,  3],
                            [94, 79, 64, 49, 34, 19,  4],
                            [95, 80, 65, 50, 35, 20,  5],
                            [96, 81, 66, 51, 36, 21,  6],
                            [97, 82, 67, 52, 37, 22,  7],
                            [98, 83, 68, 53, 38, 23,  8],
                            [99, 84, 69, 54, 39, 24,  9],
                            [100, 85, 70, 55, 40, 25, 10],
                            [101, 86, 71, 56, 41, 26, 11],
                            [102, 87, 72, 57, 42, 27, 12],
                            [103, 88, 73, 58, 43, 28, 13],
                            [104, 89, 74, 59, 44, 29, 14],
                            [105, 90, 75, 60, 45, 30, 15],
                        ]
                    @endphp

                    @foreach ($middle_arr as $mRow)
                        <li class="row row--6">
                            <ol class="seats" type="A">
                                @foreach ($mRow as $mCol)
                                    @php
                                        $candidate = 'candidate_'.$mCol;
                                    @endphp
                                    <li class="seat">
                                        <span class="bg-@if(@$$candidate == 1)green @else red @endif">{{$mCol}}</span>
                                    </li>
                                @endforeach
                            </ol>
                        </li>

                    @endforeach

                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">
                    @php
                        $right_array = [
                            [106, 134, 160, 182],
                            [107, 135, 161, 183],
                            [108, 136, 162, 184],
                            [109, 137, 163, 185],
                            [110, 138, 164, 186],
                            [111, 139, 165, 187],
                            [112, 140, 166, 188],
                            [113, 141, 167, 189],
                            [114, 142, 168, 190],
                            [115, 143, 169, ''],
                            [116, 144, 170, ''],
                            [117, 145, '', ''],
                            [118, 146, '', ''],
                            [119, '', '', ''],
                        ]
                    @endphp

                    @foreach ($right_array as $rRow)
                        <li class="row row--1">
                            <ol class="seats" type="A">
                                @foreach ($rRow as $rCol)
                                    @php
                                        $candidate = 'candidate_'.$rCol;
                                    @endphp
                                    <li class="seat">
                                        @if($rCol != '')<span class="bg-@if(@$$candidate == 1)green @else red @endif">{{$rCol}}</span>@endif
                                    </li>
                                @endforeach
                            </ol>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
    {{-- <div class="row text-center">
        <hr>
        <a href="#" class="btn btn-primary pull-right mr-20">Next</a>
    </div> --}}
</section>

@endif

@if(Auth::user()->hasRole('user'))
<section class="content">
    <!-- <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div>Welcome: {{Auth::user()->name}}</div>
                <div style="padding: 10px; text-align:center">
                    <h4>On Going Board Info</h4>
                    <p>Board Number: 2209</p>
                    <p>Total Candidate: 105</p>
                    <p>Ongoing: Personality Test</p>
                </div>
                <div style="padding: 10px">
                    <h4>Share Here / Drop Box</h4>
                    <form class="form-inline" enctype="multipart/form-data" action="{{ url('sharedoc-store') }}" method="POST" novalidate>
                        {{ csrf_field() }}
                        <input class="form-group" type="file" name="item_img" accept="image/*" id="">
                        <button type="submit" class="btn btn-primary mb-2">Upload</button>
                    </form>
                    <p style="padding: 10px;">Shared Docs:</p>
                    <?php
                        $sharedocs = DB::table('psy_modules')->where('type', 'share_doc')->orderBy('id','DESC')->take(5)->get();
                    ?>
                    <ul>
                        @if($sharedocs)
                        @foreach ($sharedocs as $sdoc)
                            <li style="padding-bottom: 7px">{{$sdoc->file}} <a href="{{asset('assets/uploads/psy_module/'.$sdoc->file)}}" target="_blank"><i class="fa fa-download"></i></a></li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="border-left:1px solid #CCC;border-right:1px solid #CCC">
            <div class="row">
                <div>Today: {{date('j F Y, ')}}<span id="MyTime"></span></div>
                <div style="padding: 10px">
                    <?php
                        $sescal = DB::table('psy_modules')->where('type', 'session_calender')->orderBy('order','DESC')->first();
                    ?>
                    @if($sescal)
                    <h4>Calender</h4>
                       <a href="{{asset('assets/uploads/psy_module/'.$sescal->file)}}" target="_blank"><img src="{{asset('assets/uploads/psy_module/'.$sescal->file)}}" width="90%" alt="{{$sescal->title}}"></a>
                    @endif
                </div>
                <div style="padding: 10px">
                    <?php
                        $events = DB::table('psy_modules')->where('type', 'upcoming_events')->orderBy('order','ASC')->take(2)->get();
                        $cnt=1;
                    ?>
                    @if($events)
                    <h4>Upcoming Events</h4>
                    @foreach ($events as $event)
                    <a href="">{!! $cnt.'. '.$event->title.'<br>'!!}</a>
                        <?php $cnt++; ?>
                    @endforeach
                    @endif
                </div>
                <div style="padding: 10px">
                    <?php
                        $notice = DB::table('psy_modules')->where('type', 'announcement')->orderBy('order','DESC')->first();
                        $cnt=1;
                    ?>
                    @if($notice)
                    <h4>Notice</h4>
                    <div class="col-md-6">
                        <a href=""><img src="{{asset('assets/uploads/psy_module/'.$notice->file)}}" width="40%" alt="{{$notice->title}}"></a>
                    </div>
                    <div class="col-md-6" style="font-weight:500">
                        {!!'<b>'.$notice->title.'</b><br>'.$notice->details!!}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div></div>
                <div>{{Auth::user()->name}}</div>
                <div>
                    <h4>History</h4>
                </div>
            </div>
        </div>
    </div> -->
    <div style="height: 5em">&nbsp;</div>
    <!--/row-->





</section>
@endif

@stop

{{-- page level scripts --}}
@section('footer_scripts')
<script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/modal-popup-ybox/dist/js/directive.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/modal-popup-ybox/dist/js/yBox.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

<script>
    $(document).ready(function() {
        @if (session('msgType') == 'success')
        toastr.success('{{ session("messege") }}', 'Success', {timeOut: 5000});
        @endif

        @if (session('msgType') == 'danger')
        toastr.warning('{{ session("messege") }}', 'Warning', {timeOut: 5000});
        @endif
    });

    $('#activeTest').DataTable( {
        "searching": true,
        "paging": false,
        "info": false,
        "lengthChange":false,
        responsive: true,
        "columnDefs": [
            { "orderable": false, "targets": 2 }
        ]
    } );
</script>

<script>
    setInterval(myTimer, 1000);
    function myTimer() {
    const d = new Date();
    document.getElementById("MyTime").innerHTML = d.toLocaleTimeString();
    }
</script>


{{--<script>--}}
    {{--setInterval(function () {--}}
        {{--location.reload();--}}
    {{--},10000)--}}

{{--</script>--}}

@stop
