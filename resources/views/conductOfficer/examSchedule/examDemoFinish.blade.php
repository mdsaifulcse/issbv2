@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Test
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    {{--<section class="content-header">--}}
        {{--<!--section starts-->--}}
        {{--<h1>Assessment</h1>--}}
        {{--<ol class="breadcrumb">--}}
            {{--<li>--}}
                {{--<a href="#">Admin</a>--}}
            {{--</li>--}}
            {{--<li class="active">Assessment</li>--}}
        {{--</ol>--}}
    {{--</section>--}}
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    {{--<div class="panel-heading clearfix">--}}
                        {{--<h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>--}}
                            {{--Assessment--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                </div>
                <div class="panel-body">
                    <h2 class="text-center">Ready to launch Assessment</h2>
                    <hr>
                    <div class="text-center" style="margin-top: 20px; margin-bottom: 100px;">
                        {{--<a class="btn btn-lg btn-primary" href="{{route('startMainExam', ['examId' => $examId])}}" role="button" target="_blank">Start Assessment</a>--}}
                        @if($total_candidate==$total_live)
                        <a class="btn btn-lg btn-primary" href="{{route('startMainExam', ['examId' => $examId])}}" role="button" target="_blank">Start Assessment</a>
                            @else
                            <a class="btn btn-lg btn-warning" href="{{route('examDemoFinish', ['examId' => $examId])}}" role="button" title="Wait for all candidate login">Wait & Refresh</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{asset('js/jequery-validation.js')}}"></script>

    <script>
        $(document).ready(function(){
            @if (session('msgType'))
                toastr.success('{{ session("messege") }}', 'You Got Error', {timeOut: 5000});
            @endif
        });
    </script>

@stop
