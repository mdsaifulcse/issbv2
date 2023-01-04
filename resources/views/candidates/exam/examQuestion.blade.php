@extends('candidates.layouts.default')

@push('styles')
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
        .option_show{
            display: flex;
        }
        .option_show .radio{
            padding-right:12px;
        }
        .option_show .radio label{
            padding-left:17px;
        }
    </style>
@endpush

@section('content')
<!-- Content area -->
<div class="content">
    <!-- Basic setup -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title color-red" id="examTimeCountDown"> </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    {{-- <li>
                        <div id="examTimeCountDown"></div>
                    </li> --}}
                    <li>
                        Running Question: <span class="runningQuestionsShow"></span>|
                    </li>
                    <li>
                        Total Questions: <span class="totalQuestionsShow"></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <div class="stepwizard mb-15">
                <div class="stepwizard-row setup-panel">
                    @foreach ($examQuestions as $key => $question)
                        <div class="stepwizard-step">
                            @if($key == 0)
                                <a stepData="{{$key+1}}" class="stepBtn btn btn-primary btn-circle step-{{$key+1}}">{{$key+1}}</a>
                                <p>Q-{{$key+1}}</p>
                            @else
                                <a stepData="{{$key+1}}" class="stepBtn btn btn-default btn-circle step-{{$key+1}}">{{$key+1}}</a>
                                <p>Q-{{$key+1}}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <form class="form-horizontal" id="qustion-form" role="form">
                @csrf
                <fieldset>
                    <input type="hidden" class="exam_config_status" name="exam_config_status" value="{{ $examConfigureStatus }}">
                    <input type="hidden" class="exam_id" name="exam_id">
                    <input type="hidden" class="question_id" name="question_id">
                    <input type="hidden" class="sl_no" name="sl_no">
                    <input type="hidden" id="current_time" name="current_time" value="" />
                    <input type="hidden" class="total_questions" name="total_questions">
                    <input type="hidden" class="exam_remaining_time" name="exam_remaining_time" value="{{ $examRemainingTime }}">

                    <div class="row setup-content">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <div class="page_loader">
                                    <div class="text-center"><h4>Your Assessment Configuring...</h4><div class="loader"></div></div>
                                </div>
                                <div class="form-group question_area" style="display: none">
                                    <label><b style="font-size: 18px" class="question">Questions</b></label>
                                    <div class="option_show">
                                        <div class="radio">
                                            <label>
                                                <input option_shownput type="radio" name="answer" class="styled" />
                                                test
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <legend class="text-bold"></legend>
                                <span id="submitBtnArea" class="pull-right">
                                    <button class="btn btn-primary btn-lg previousBtn" type="button">Previous</button>
                                    <button id="submitBtn" class="btn btn-success btn-lg ml-2 nextBtn" type="submit">Next</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

    </div>
    <!-- /basic setup -->

    <!-- Footer -->
    <div class="footer text-muted">
        &copy; {{date('Y')}}. <a href="#">Developed</a> by <a href="#" target="_blank">Silvereagle</a>
    </div>
    <!-- /footer -->

</div>
<!-- /content area -->
@endsection


@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            let htmlOptions             = '';
            let exam_id                 = $('.exam_id').val();
            let exam_remaining_time     = $('.exam_remaining_time').val();
            console.log(exam_remaining_time)
            let exam_config_status      = $('.exam_config_status').val();
            let step_id                 = '';
            $('.question_area').find('.question').text('');

            if (exam_config_status==0) {
                //EXAM CONFIGURE
                examQuestionFun(exam_config_status, step_id);
            } else {
                examQuestionFun(exam_config_status, step_id);
            }
            //END

            //EXAM FORM SUBMIT
            $('#qustion-form').submit(function(e){
                e.preventDefault();
                var formSubmitStatus = 0;
                formSubFun(formSubmitStatus);
            });

            // Start Countdown
            String.prototype.toHHMMSS = function () {
                var sec_num = parseInt(this, 10); // don't forget the second parm
                var hours = Math.floor(sec_num / 3600);
                var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
                var seconds = sec_num - (hours * 3600) - (minutes * 60);

                if (hours < 10) {
                    hours = "0" + hours;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                var time = hours + ':' + minutes + ':' + seconds;
                return time;
            }

            var count = exam_remaining_time; // it's 00:01:02
            var counter = setInterval(examTimeCountDown, 1000);

            function examTimeCountDown() {
                if (parseInt(count) <= 0) {
                    clearInterval(counter);

                    let exam_id = $('.exam_id').val();
                    $.ajax({
                        url : '{{route("candidate.autoCandidateExamSubmit")}}',
                        data: {exam_id:exam_id},
                        type: 'GET',
                        dataType: "json",
                        success: function(response)
                        {
                            window.location.href = "{{ url('candidate/dashboard') }}";
                        }
                    });
                }
                var temp = count.toHHMMSS();
                count = (parseInt(count) - 1).toString();
                $('#examTimeCountDown').html(temp);
                $('#current_time').val(temp);
                $('.exam_remaining_time').val(temp);
            }

            //update exam info
            setInterval(function() {
                let exam_id                 = $('.exam_id').val();
                let exam_remaining_time     = $('.exam_remaining_time').val();
                let redirect_url            = '/candidate/login';
                $.ajax({
                        url : '{{route("candidate.canExamInfoUpdate")}}',
                        data: {exam_id:exam_id,exam_remaining_time:exam_remaining_time, "_token": "{{ csrf_token() }}"},
                        type: 'POST',
                        dataType: "json",
                        success: function(response)
                        {
                            if(response.examStatus==2) { //2=Force Exam Stop
                                window.location=redirect_url;
                            } else {
                                console.log(response.message);
                            }
                        }
                    });
            }, 5000);

            //step
            $('.stepBtn').on('click', function(){
                var stepId              = $(this).attr('stepData');
                var quesId              = $('.question_id').val();
                var formSubmitStatus    = 1;

                // $('#submitBtn').trigger('click');
                // examQuestionFun(exam_config_status, stepId);
                formSubFun(1, exam_config_status, stepId);
            });

            $('.nextBtn').on('click', function(){
                console.log('sdf23')
                var stepId              = Number($('.sl_no').val()) + 1;
                var quesId              = $('.question_id').val();
                var formSubmitStatus    = 1;

                formSubFun(1, exam_config_status, stepId);
            });

            $('.previousBtn').on('click', function(){
                var stepId              = Number($('.sl_no').val()) - 1;
                var quesId              = $('.question_id').val();
                var formSubmitStatus    = 1;

                formSubFun(1, exam_config_status, stepId);
            });
        });

        //EXAM CONFIG AND EXAM START
        function examQuestionFun(exam_config_status, step_id){
            console.log('examQuestionFun');
            //EXAM CONFIGURE
            $.ajax({
                    url : '{{route("candidate.candidateExamConfigure", ["examId"=>$examId])}}',
                    data: {exam_config_status:exam_config_status, step_id:step_id},
                    type: 'GET',
                    dataType: "json",
                    success: function(response) {
                        console.log(response)

                        if (response.status==1) {
                            $('.page_loader').hide();
                            $('.question_area').show();
                            $('.sl_no').val(response.sl_no);
                            $('.exam_id').val(response.exam_id);
                            $('.question_id').val(response.question_id);
                            $('.total_questions').val(response.total_questions);
                            $('.totalQuestionsShow').text(response.total_questions);
                            $('.runningQuestionsShow').text(response.sl_no);
                            $('.exam_remaining_time').val(response.examRemainingTime);

                            //QUESTION STEPING
                            // $(".stepwizard-step").find('.btn-circle').removeClass('btn-primary');
                            // $(".stepwizard-step").find('.btn-circle').addClass('btn-default');
                            // $(".stepwizard-step").find('.step-'+response.sl_no).addClass('btn-primary');
                            if (step_id == '') {
                                console.log('dukchi');
                                if (response.sl_no != 0) {
                                    console.log('serial chilo', response.sl_no);
                                    examQuesStep(response.sl_no);
                                } else {
                                    console.log('serial chilo na');
                                    examQuesStep(1);
                                }
                            } else {
                                examQuesStep(step_id);
                            }
                            //END QUESTION STEPING

                            //QUESTION TITLE GENERATE
                            let question_title = response.question;
                            if (response.question_status == 1) { //1=Main Question
                                if (response.item_type == 1) {
                                    $('.question_area .question').text(`${response.sl_no}) ${question_title}`);
                                } else if (response.item_type == 2) {
                                    $('.question_area .question').html(`Question :<br/> <img src="{{ asset('assets/uploads/questions/images/${question_title}') }}" alt="Question Image" class="img-responsive img-thumbnail">`);
                                } else {
                                    let audio_name_arr = question_title.split(".", 2);
                                    let audio_ogg = `${audio_name_arr[0]}.ogg`;
                                    $('.question_area .question').html(`<audio controls>
                                                        <source src="${audio_ogg}" type="audio/ogg">
                                                        <source src="{{ asset('assets/uploads/questions/sounds/${question_title}') }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>`);
                                }
                            } else { //2=Sub Question
                                if (response.item_type == 1) {
                                    $('.question_area .question').text(`${response.sl_no}) ${question_title}`);
                                } else if (response.item_type == 2) {
                                    $('.question_area .question').html(`Question:<br/> <img src="{{ asset('assets/uploads/sub_questions/images/${question_title}') }}" alt="Question Image" class="img-responsive img-thumbnail">`);
                                } else {
                                    let audio_name_arr = question_title.split(".", 2);
                                    let audio_ogg = `${audio_name_arr[0]}.ogg`;
                                    $('.question_area .question').html(`<audio controls>
                                                        <source src="${audio_ogg}" type="audio/ogg">
                                                        <source src="{{ asset('assets/uploads/sub_questions/sounds/${question_title}') }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>`);
                                }
                            }

                            let questionOptions = response.options;
                            $('.option_show').html('');
                            for (let i = 0; i < questionOptions.length; i++) {
                                //QUESTION OPTIONS GENERATE
                                let question_option = questionOptions[i];
                                if (response.question_status == 1) { //1=Main Question
                                    if (response.option_type == 1) {
                                        // $('.question_area .question').text(`${i}) ${question_option}`);

                                        let htmlOptions = $('.option_show').append('<div class="radio"><label><input option_shownput type="radio" name="answer" class="styled" value='+i+'>'+question_option+'</label></div>');

                                    } else if (response.option_type == 2) {
                                        let htmlOptions = $('.option_show').append(`<div class="radio"><label> <b> Option ${i+1}</b> <input option_shownput type="radio" name="answer" class="styled" value="${i}"><img src="{{ asset('assets/uploads/options/images/${question_option}') }}" alt="Question Image" class="img-responsive img-thumbnail"></label></div>`);
                                    } else {
                                        let audio_name_arr = question_option.split(".", 2);
                                        let audio_ogg = `${audio_name_arr[0]}.ogg`;
                                        $('.question_area .question').html(`<audio controls>
                                                            <source src="${audio_ogg}" type="audio/ogg">
                                                            <source src="{{ asset('assets/uploads/options/sounds/${question_option}') }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>`);

                                        let htmlOptions = $('.option_show').append(`<div class="radio"><label><b> Option ${i+1}</b><input option_shownput type="radio" name="answer" class="styled" value="${i}"><audio controls>
                                                            <source src="${audio_ogg}" type="audio/ogg">
                                                            <source src="{{ asset('assets/uploads/options/sounds/${question_option}') }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio></label></div>`);
                                    }
                                } else { //2=Sub Question
                                    if (response.option_type == 1) {
                                        // $('.question_area .question').text(`${i}) ${question_option}`);

                                        let htmlOptions = $('.option_show').append('<div class="radio"><label><b> Option ${i+1}</b><input option_shownput type="radio" name="answer" class="styled" value='+i+'>'+question_option+'</label></div>');

                                    } else if (response.option_type == 2) {
                                        let htmlOptions = $('.option_show').append(`<div class="radio"> <label> <b> Option ${i+1}</b><input option_shownput type="radio" name="answer" class="styled" value="${i}">
                                        <img src="{{ asset('assets/uploads/sub_options/images/${question_option}') }}" alt="Question Image" class="img-responsive img-thumbnail"></label></div>`);
                                    } else {
                                        let audio_name_arr = question_option.split(".", 2);
                                        let audio_ogg = `${audio_name_arr[0]}.ogg`;
                                        $('.question_area .question').html(`<audio controls>
                                                            <source src="${audio_ogg}" type="audio/ogg">
                                                            <source src="{{ asset('assets/uploads/sub_options/sounds/${question_option}') }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>`);

                                        let htmlOptions = $('.option_show').append(`<div class="radio"><label><b> Option ${i+1}</b><input option_shownput type="radio" name="answer" class="styled" value="${i}"><audio controls>
                                                            <source src="${audio_ogg}" type="audio/ogg">
                                                            <source src="{{ asset('assets/uploads/sub_options/sounds/${question_option}') }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio></label></div>`);
                                    }
                                }

                                // let htmlOptions = $('.option_show').append('<div class="radio"><label><input option_shownput type="radio" name="answer" class="styled" value='+i+'>'+questionOptions[i]+'</label></div>');

                                $("input[name=answer][value="+response.answer_id+"]").prop("checked",true);
                            }

                            if (response.nextBtnStatus==0) {
                                $('#submitBtn').hide();
                                // $('#submitBtn').text('Final Submit');
                            }

                            if (response.previousBtnStatus==1) {
                                $('.previousBtn').show();
                            } else {
                                $('.previousBtn').hide();
                            }


                        } else if (response.status==2){
                            $('.page_loader').hide();
                            $('.question_area').hide();
                            $('.panel-body').append('<h2 class="text-center">Your Assessment Already finished!</h2>');
                            $('.stepwizard').hide();
                            $('.previousBtn').hide();
                            $('#submitBtn').hide();
                            $('.heading-elements').hide();
                        } else {
                            $('.page_loader').hide();
                            $('.question_area').show();
                            // alert('4th'+response.response);
                        }
                    },
                });
        }

        //EXAM QUESTION STEP
        function examQuesStep(sl_no){
            console.log('examQuesStep');
            //QUESTION STEPING
            $(".stepwizard-step").find('.btn-circle').removeClass('btn-primary');
            $(".stepwizard-step").find('.btn-circle').addClass('btn-default');
            $(".stepwizard-step").find('.step-'+sl_no).addClass('btn-primary');
            //END QUESTION STEPING
        }

        //FORM DATA SET 0=Form Submit 1=Step Submit
        function formSubFun(formSubmitStatus, examConfigStatus=false, stepId=false){
            console.log('formSubFun', stepId);
            var data = $('#qustion-form').serializeArray();
            var givenAnswer = data.length;
            var totalQuestions = $('#qustion-form').find('.toatl_questions').val();
            var slNo = $('#qustion-form').find('.sl_no').val();
            var redirect_url = '/candidate/dashboard';

            if(givenAnswer>3) {
                $button = $('#submitBtn');
                // $button.button('loading');
                $.ajax({
                    url : '{{route("candidate.candidateExamSubmit")}}',
                    data: data,
                    type: 'POST',
                    dataType: "json",
                    success: function(response)
                    {
                        if(response.examStatus==2){ //2=Force Exam Stop
                            window.location=redirect_url;
                        } else {
                            if (response.status==2) {
                                $('.page_loader').hide();
                                $('.panel-body').append('<h2 class="text-center">Your Assessment Already finished!</h2>');
                                $('.previousBtn').hide();
                                $('#submitBtn').hide();
                                $('.heading-elements').hide();
                                $('.question_area').hide();
                            } else {
                                $('.page_loader').hide();
                                $('.question_area').show();
                                $('.sl_no').val(response.sl_no);
                                $('.exam_id').val(response.exam_id);
                                $('.question_id').val(response.question_id);
                                $('.total_questions').val(response.total_questions);
                                $('.totalQuestionsShow').text(response.total_questions);
                                $('.runningQuestionsShow').text(response.sl_no);
                                $('.exam_remaining_time').val(response.examRemainingTime);
                                // alert(formSubmitStatus);
                                //QUESTION STEPING
                                if (formSubmitStatus==0) {
                                    examQuesStep(response.sl_no);
                                }
                                // if (formSubmitStatus==3) {
                                //     examQuestionFun(exam_config_status, response.sl_no);
                                // }
                                examQuestionFun(examConfigStatus, stepId);
                                //END QUESTION STEPING

                                //SUBMIT BTN
                                if (response.nextBtnStatus==0) {
                                    $('#submitBtn').hide();
                                    // $('#submitBtn').text('Final Submit');
                                }

                                //PREVIOUS BTN
                                if (response.previousBtnStatus==1) {
                                    $('.previousBtn').show();
                                    $('.nextBtn').show();
                                } else {
                                    $('.previousBtn').hide();
                                    $('.nextBtn').show();
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal("Cancelled", errorThrown, "error");
                    }
                });
            } else {
                swal("Give your answer, please!");
            }
        }
    </script>
@endpush
