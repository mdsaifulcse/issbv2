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

    .wr-content::before {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        background: url(assets/images/issb-logo.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 350px;
        opacity: 0.1;
    }

    .lightbluebg {
        background: #272467;
    }

    .palebluecolorbg {
        background: #01AEF0;
    }

    .goldbg {
        background: #912125;
    }

    .panel {
        border-radius: 0;
    }

    .panel-body {
        min-height: 120px;
    }

    .col-md-12.view {
        padding: 10px 32px;
        margin-top: -13px;
        border-bottom: 2px solid #0e0a22;
        border-radius: 5px;
    }

    .col-md-12.palebluecolorbg.view {
        border-bottom: 2px solid #277fa1;
    }

    .col-md-12.goldbg.view {
        border-bottom: 2px solid #321919;
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
                    <b>{{$data['total_live']}}/{{$activeBoard?$activeBoard->total_candidate:'N/A'}}</b>
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
                                    <td>{{ $config->testConfig->testFor->name }}</td>
                                    <td>{{ $config->testConfig->test_name }}</td>
                                    <td>{{ $config->boardCandidate->board_name }}</td>
                                    <td>{{ $config->exam_date }}</td>
                                    <td>{{ $config->exam_duration }}</td>
                                    <td>{{ $config->boardCandidate->total_candidate }}</td>
                                    <td> <a href="{{ route('examConfig.show', [$config->id]).'?status=0' }}"><b>Activate</b> </a>   </td>
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
                                                $test_for=$config->testConfig->testFor->id;
                                            ?>
                                        <a href="{{ route('examConfig.edit', [$config->id])."?test_for=$test_for" }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                        <a href="javascript:void(0)"><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete({{ $config->id }});></i></a>
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

@stop
