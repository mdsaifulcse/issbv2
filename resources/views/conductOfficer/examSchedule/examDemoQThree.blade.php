@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Test
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <style>
        /* body{
            margin-top:40px;
        } */

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5>Assessment</h5>
        <ol class="breadcrumb">
            <li>
                <div id="examTimeCountDown"></div>
            </li>
            <li>
                Running Question: <span class="runningQuestionsShow">3</span>|
            </li>
            <li>
                Total Questions: <span class="totalQuestionsShow">3</span>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row setup-content">
            <div class="stepwizard mb-15">
                <div class="stepwizard-row setup-panel">
                    @php
                        $examQuestions = [1, 2, 3];
                    @endphp
                    @foreach ($examQuestions as $key => $question)
                        <div class="stepwizard-step">
                            @if($key == 0)
                                <a stepData="{{$key+1}}" class="stepBtn btn btn-default btn-circle step-{{$key+1}}">{{$key+1}}</a>
                                <p>Q-{{$key+1}}</p>
                            @else
                                <a stepData="{{$key+1}}" class="stepBtn btn @if($question == 3) btn-primary @else btn-default @endif btn-circle step-{{$key+1}}">{{$key+1}}</a>
                                <p>Q-{{$key+1}}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b style="font-size: 18px" class="item">Demo Question 3?</b></label>
                        <div class="option_show">
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer One
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Two
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Three
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Four
                                </label>
                            </div>
                        </div>
                    </div>
                    <legend class="text-bold"></legend>
                        <span id="submitBtnArea" class="pull-right">
                            <a href="{{route('examDemoQTwo', ['examId'=>$examId])}}" class="btn btn-primary btn-lg previousBtn" type="button">Previous</a>
                            <a href="{{route('examDemoFinish', ['examId'=>$examId])}}" class="btn btn-success btn-lg  ml-2" type="submit">Next</a>
                        </span>
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
