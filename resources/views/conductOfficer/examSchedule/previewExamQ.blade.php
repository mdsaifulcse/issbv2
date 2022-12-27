@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test Preview
    @parent
@stop

@section('header_styles')
    <style>
        .answer-section .single-answer{
            display: table-cell !important;
        }
    </style>
    @endsection

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Test Preview</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Preview</li>
        </ol>
    </section>


    <!-- Content area -->
    <div class="content">
        <div class="panel panel-body">
            @php
                $sl = 1;
            @endphp
            @foreach ($examQuestions as $key => $question)
                @if ($question->sub_question_status=='' || $question->sub_question_status==NULL)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{-- <label><b style="font-size: 18px">Q{{$sl}}. {!! $question->question_title !!}</b></label> --}}
                                <div class="question-section">
                                    <label>
                                        <b style="font-size: 18px">
                                            Q.
                                            {{--Q{{$sl}}.--}}
                                            @if ($question->item_type == 1)
                                                {!! $question->question_title !!}
                                            @elseif($question->item_type == 2)
                                                <img src="{{ asset('assets/uploads/questions/images/'.$question->question_title) }}" alt="Question Image"  class="img-responsive img-thumbnail">
                                            @else
                                                @php
                                                    $audio_name_arr = explode('.', $question->question_title, 2);
                                                    $audio_ogg = $audio_name_arr[0].'.ogg';
                                                @endphp
                                                <audio controls>
                                                    <source src="{{$audio_ogg}}" type="audio/ogg">
                                                    <source src="{{ asset('assets/uploads/questions/sounds/'.$question->question_title) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @endif
                                        </b>
                                    </label>
                                </div>
                                {{-- assets/uploads/questions/
                                assets/uploads/options/
                                assets/uploads/sub_questions/
                                assets/uploads/sub_options/ --}}
                                @php
                                    $labelClass = 'radio';
                                    $labelType = 'radio';
                                @endphp
                                <div class="answer-section">
                                    @foreach($question->answerSet as $ansKey => $answer)
                                        <div class="{{$labelClass}} single-answer">
                                            <label class="@if($question->true_answer == $ansKey){{'text-success'}}@else{{'text-danger'}}@endif" for="ans-{{$ansKey}}">
                                                <input type="{{$labelType}}" name="answer_{{$question->id}}" id="ans-{{$ansKey}}" class="styled">
                                                <span class="text-danger">
                                            @if ($question->option_type == 1)
                                                        {{$answer}}
                                                    @elseif ($question->option_type == 2)
                                                        <img src="{{ asset('assets/uploads/options/images/'.$answer) }}" alt="Question Image"  class="img-responsive img-thumbnail">
                                                    @else
                                                        @php
                                                            $audio_name_arr = explode('.', $answer, 2);
                                                            $audio_ogg = $audio_name_arr[0].'.ogg';
                                                        @endphp
                                                        <audio controls>
                                                    <source src="{{$audio_ogg}}" type="audio/ogg">
                                                    <source src="{{ asset('assets/uploads/options/sounds/'.$answer) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                                    @endif
                                        </span>
                                                {{-- @if($question->true_answer == $ansKey) |
                                                    <span class="text-success"><i class="icon-checkmark4"></i> Correct</span>
                                                @endif --}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <legend class="text-bold"></legend>
                        </div>
                    </div>
                    @php
                        ++$sl;
                    @endphp
                @else
                    @foreach ($question->sub_questions as $subKey => $sub_q)

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>
                                        <b style="font-size: 18px">
                                            Q.
                                            {{--Q{{$sl}}.--}}
                                            @if ($question->sub_question_type == 1)
                                                {!! $sub_q !!}
                                            @elseif($question->sub_question_type == 2)
                                                <img src="{{ asset('assets/uploads/sub_questions/images/'.$sub_q) }}" alt="Question Image"  class="img-responsive img-thumbnail">
                                            @else
                                                @php
                                                    $audio_name_arr = explode($sub_q, 2);
                                                    $audio_ogg = $audio_name_arr[0].'.ogg';
                                                @endphp
                                                <audio controls>
                                                    <source src="{{$audio_ogg}}" type="audio/ogg">
                                                    <source src="{{ asset('assets/uploads/sub_questions/sounds/'.$sub_q) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @endif
                                            {{-- {!! $sub_q !!} --}}
                                        </b>
                                    </label>

                                    @php
                                        $labelClass = 'radio';
                                        $labelType = 'radio';
                                        $subOptions = explode('~~', $question->sub_options);
                                        $answerSet = explode('||', $subOptions[$subKey]);
                                        $sub_correct_answers = explode('||', $question->sub_correct_answer);
                                    @endphp
                                    @foreach($answerSet as $subAnsKey => $answer)
                                    @php
                                        ++$subAnsKey;
                                    @endphp
                                    <div class="{{$labelClass}}">
                                        <label class="@if($sub_correct_answers[$subKey] == $subAnsKey){{'text-success'}}@else{{'text-danger'}}@endif" for="ans-{{$subAnsKey}}">
                                            <input type="{{$labelType}}" name="answer_{{$sub_q}}" id="ans-{{$subAnsKey}}" class="styled">
                                            <span class="text-danger">{{$answer}}</span>
                                            {{-- @if($sub_correct_answers[$subKey] == $subAnsKey) |
                                                <span class="text-success"><i class="icon-checkmark4"></i> Correct</span>
                                            @endif --}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                                <legend class="text-bold"></legend>
                            </div>
                        </div>
                        @php
                            ++$sl;
                        @endphp
                    @endforeach
                @endif
            @endforeach


            <div class="">
                {{--<a class="btn btn-primary" @if($preview_status == 0) href="{{route('activateExam', ['examId' => $examId])}}" @else href="#" @endif role="button">@if($preview_status == 0) Activate @else Activated @endif</a>--}}
                @if($nextIndex>1)
                <a href="{{url('examPreview?'."examId=$examId&index=$previousIndex")}}" class="btn btn-info pull-left">Previous <i class="icon-backward2 position-left"></i></a>
                    @endif

                @if($nextButton!=0)
                <a href="{{url('examPreview?'."examId=$examId&index=$nextIndex")}}" class="btn btn-success pull-right">Next <i class="icon-backward2 position-right"></i></a>
                    @endif
            </div>

        </div>
    </div>
    <!-- /content area -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script>
        $(document).ready(function(){

        });
    </script>

@stop
