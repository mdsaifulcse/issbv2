@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Question Set
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
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
            <li class="active">
                Question Set
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            @foreach($test_list as $test)
                <div class="col-md-3 animated fadeInLeftBig" style="padding:5px">
                    <a class="view-details" href="{{ URL::to('/question-set/'.$test->id) }}">
                        <div class="row">
                            <div class="col-md-12 palebluecolorbg view">
                                {{--<a class="view-details" href="{{ URL::to('/iq-item-create') }}">View Details</a>--}}
                                {{ $test->name }} Question Set
                        <span class="widget_circle3 pull-right">
                            <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-203{{ $test->id }}" style="width: 20px; height: 20px;"></i>
                        </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <!--/row-->
    </section>

@stop
