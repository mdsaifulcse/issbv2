@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Set Question Admin Preview
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <style>
        .mb-2{
            margin-bottom: 5px;
        }

         .container {
             display: block;
             position: relative;
             padding-left: 35px;
             margin-bottom: 12px;
             cursor: pointer;
             font-size: 15px;
             -webkit-user-select: none;
             -moz-user-select: none;
             -ms-user-select: none;
             user-select: none;
         }

        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>{{$set}} Set Preview</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Set Question Admin Preview</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Set Question Admin Preview
                        </h3>
                    </div>
                    <div class="panel-body">
                        <?php $question_numbers = (explode('||', $question_set->question_numbers));?>

                        <ol type="1" class="question">
                            @foreach($question_list as $questions)
                                @foreach($question_numbers as $key => $value)
                                        @if($questions->id == $value)
                                        <h3><li class="mb-2">
                                                @if($questions->question_type == 1)
                                                    {{ $questions->question }}
                                                @else
                                                        @if($questions->top_text)<h5><strong>{{$questions->top_text}}</strong></h5>@endif
                                                    <img src="{{ asset('assets/uploads/questions/'.$questions->question) }}" alt="..." style="width: 380px; height: 200px; border: 2px solid #760d0d;">
                                                        @if($questions->down_text)<h5><strong>{{$questions->down_text}}</strong></h5>@endif
                                                @endif
                                            </li>
                                        </h3><br>
                                            <div class="row" type="none">
                                                <?php $options = (explode('||', $questions->options)); ?>
                                                @foreach($options as $key => $option)
                                                        <div class="col-md-2">
                                                            <label class="container">
                                                                @if($questions->option_type == 1)
                                                                    {{ $option }}
                                                                @else
                                                                    <img src="{{ asset('assets/uploads/options/'.$option) }}" alt="..." style="width: 115px; height: 80px; border: 2px solid #760d0d;">
                                                                @endif
                                                                <input type="checkbox"  disabled @if(++$key == $questions->correct_answer) checked="checked" @endif>
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                @endforeach
                                            </div>
                                        @endif
                                @endforeach
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- content -->

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')

@stop
