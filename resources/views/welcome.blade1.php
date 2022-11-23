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
        height: 85px;
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
<link href="{{ asset('assets/vendors/modal-popup-ybox/dist/css/yBox.min.css') }}" rel="stylesheet" />
@stop

{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h5>Welcome to Psychometrics Test</h5>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">Dashboard</li>
    </ol>
</section>

@if(Auth::user()->hasRole('admin'))
<section class="content">
    <div class="row">
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel lightbluebg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>INTELLIGENCE TEST</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 lightbluebg view">
                    <a class="view-details" href="#">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-234" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel palebluecolorbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>PSYCHOMETRIC OBJECTIVE PERSONALITY TEST</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 palebluecolorbg view">
                    <a class="view-details" href="#">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-235" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel goldbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>PSYCHOMETRIC COGNITIVE TEST </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 goldbg view">
                    <a class="view-details" href="#">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-236" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->
</section>
@endif

@if(Auth::user()->hasRole('testing'))
<section class="content">
    <div class="row">
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel lightbluebg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>TAT/BL</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 lightbluebg view">
                    <a class="view-details" href="{{url('/psy-picture-list')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-234" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>

    </div>
    <!--/row-->
</section>
@endif

@if(Auth::user()->hasRole('user'))
<section class="content">
    <div class="row">

        {{-- <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel lightbluebg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>SESSION CALENDER</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 lightbluebg view">
                    <a class="view-details" href="{{url('session-calender')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-234" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel palebluecolorbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>TAT/BL</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 palebluecolorbg view">
                    <a class="view-details" href="{{url('/tat-bl')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-235" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel goldbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>TESTING SCHEDULE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 goldbg view">
                    <a class="view-details" href="{{url('testing-schedule')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-236" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel lightbluebg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>UPCOMING EVENTS</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 lightbluebg view">
                    <a class="view-details" href="{{url('upcoming-events')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-237" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel palebluecolorbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>IMPORTANT NOTICE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 palebluecolorbg view">
                    <a class="view-details" href="#">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-238" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel goldbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>COURSE SCHEDULE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 goldbg view">
                    <a class="view-details" href="{{url('course-schedule')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-239" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel lightbluebg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>SLIDE SHARE</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 lightbluebg view">
                    <a class="view-details" href="#">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-240" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-4 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="panel goldbg">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span>ANNOUNCEMENT</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 goldbg view">
                    <a class="view-details" href="{{url('announcement')}}">View Details</a>
                    <span class="widget_circle3 pull-right">
                        <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-241" style="width: 20px; height: 20px;"></i>
                    </span>
                </div>
            </div>
        </div> --}}
    </div>
    <!--/row-->
</section>
@endif

@stop

{{-- page level scripts --}}
@section('footer_scripts')

<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/modal-popup-ybox/dist/js/directive.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/modal-popup-ybox/dist/js/yBox.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>


<script>

</script>

@stop
