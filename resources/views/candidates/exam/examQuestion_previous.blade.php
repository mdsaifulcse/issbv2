@extends('candidates.layouts.default')


@section('content')
<!-- Content area -->
<div class="content">
    <!-- Basic setup -->
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title">Assessment </h6>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li>
                        <div id="examTimeCountDown"></div>
                    </li>
                    {{-- <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li> --}}
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id="qustion-form" role="form">
                @csrf
                <fieldset>
                    <input type="hidden" name="test_config_id" value="{{ $testConfig->id }}" />
                    <input type="hidden" id="current_time" name="current_time" value="" />
                    <input type="hidden" id="sl_no" name="sl_no" value="{{ $slNo }}">
                    <input type="hidden" id="sub_question_status" name="sub_question_status" value="{{ $sub_question_status }}">
                    <input type="hidden" id="sub_question_sl_no" name="sub_question_sl_no" value="{{ $sub_question_sl_no }}">
                    <input type="hidden" id="total_questions" name="total_questions" value="{{ $totalQuestions }}">
                    <input type="hidden" id="total_sub_questions" name="total_sub_questions" value="{{ $totalSubQuestions }}">

                    <div class="row setup-content">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b style="font-size: 18px" class="item">{{ $question }}</b></label>
                                    <div class="option_show">
                                        @foreach ($options as $key=>$option)
                                            <div class="radio">
                                                <label>
                                                    <input option_shownput type="radio" name="answer" class="styled" />
                                                    {{ $option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <legend class="text-bold"></legend>
                                    <span id="submitBtnArea" class="pull-right">
                                        <button class="btn btn-primary btn-lg previousBtn" type="button" style="display: none">Previous</button>
                                        <button id="submitBtn" class="btn btn-success btn-lg  ml-2" type="submit">Next</button>
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
        &copy; {{date('Y')}}. <a href="#">Developed</a> by <a href="#" target="_blank">Silver Eagle</a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
@endsection


@push('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
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

            var count = '10000'; // it's 00:01:02
            var counter = setInterval(examTimeCountDown, 1000);

            function examTimeCountDown() {
                if (parseInt(count) <= 0) {
                    clearInterval(counter);
                    // $('#qustion-form').submit();
                    swal({
                        title: "Oops!!",
                        text: "Your Assessment Time has finished",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Submit & Get Assessment Result!",
                        closeOnConfirm: false
                    },
                    function(){
                        $('#qustion-form').submit();
                    });
                    return;
                }
                var temp = count.toHHMMSS();
                count = (parseInt(count) - 1).toString();
                $('#examTimeCountDown').html(temp);
                $('#current_time').val(temp);
            }

            //EXAM FORM SUBMIT
            $('#qustion-form').submit(function(e){
                e.preventDefault();
                var data = $(this).serializeArray();
                var givenAnswer = data.length;
                var totalQuestions = $('#toatl_questions').val();
                var slNo = $('#sl_no').val();
                // alert(parseInt(slNo)+1);

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
                            $('.item').text(response.question);
                            let questionOptions = response.options;
                            $('#sl_no').val(response.slNo);
                            let htmlOptions = '';

                            $('.option_show').html('');
                            for (let i = 0; i < questionOptions.length; i++) {
                                let htmlOptions = $('.option_show').append('<div class="radio"><label><input option_shownput type="radio" name="answer" class="styled" />'+questionOptions[i]+'</label></div>');
                            }

                            $('.previousBtn').show();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            swal("Cancelled", errorThrown, "error");
                        }
                    });
                } else {
                    swal("Give your answer, please!");
                }

                // if (totalQuestions>=parseInt(slNo)+1) {

                // } else {
                //     swal("Question already finished!");
                // }
            });
        });
    </script>
@endpush
