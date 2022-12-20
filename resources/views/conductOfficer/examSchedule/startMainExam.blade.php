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
                {{--<div class="panel panel-info">--}}
                    {{--<div class="panel-heading clearfix">--}}
                        {{--<h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>--}}
                            {{--Assessment--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="panel-body" style="margin-bottom: 150px;">
                    <h3 class="text-center" style="font-size: 20px">On Going Assessment</h3>
                    <h2 class="text-center" style="font-size: 25px">{{$exam_name}}</h2>
                    <hr>

                    <h2 class="text-center" style="font-size: 20px; color: red;">Time Remaining</h2>
                    <h2 class="text-center">
                        <div id="examTimeCountDown" style="font-size: 72px;"></div>
                        <input type="hidden" id="current_time" name="current_time" value="" />
                        <input type="hidden" class="exam_id" name="exam_id" value="{{$examId}}">

                    </h2>
                    {{-- <hr>
                    <div class="text-center" style="margin-bottom: 30px;">
                        <a class="btn btn-lg btn-primary" href="{{route('completeMainExam', ['examId' => $examId])}}" role="button">Complete Assessment</a>
                    </div> --}}
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
            @if ($msgType)
                toastr.success('{{ $messege }}', 'Success', {timeOut: 5000});
            @endif

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

            var count = "{{$exam_duration}}"; // it's 00:01:02
            var counter = setInterval(examTimeCountDown, 1000);

            function examTimeCountDown() {
                if (parseInt(count) <= 0) {
                    clearInterval(counter);
                    swal({
                        title: "Oops!!",
                        text: "Assessment time is over!",
                        confirmButtonColor: "#66BB6A",
                        type: 'danger'
                    });
                    // $('#qustion-form').submit();
                    // swal({
                    //     title: "Oops!!",
                    //     text: "Your Exam Time has finished",
                    //     type: "error",
                    //     showCancelButton: false,
                    //     confirmButtonClass: "btn-success",
                    //     confirmButtonText: "Submit & Get Exam Result!",
                    //     closeOnConfirm: true
                    // },
                    // function(){
                    //     $('#qustion-form').submit();
                    // });
                    return;
                }
                var temp = count.toHHMMSS();
                count = (parseInt(count) - 1).toString();
                $('#examTimeCountDown').html(temp);
                $('#current_time').val(temp);
            }


            //updae exam info
            setInterval(function() {
                let exam_id                 = $('.exam_id').val();
                let current_remain_time     = $('#current_time').val();
                $.ajax({
                        url : '{{route("updateMainExamTime")}}',
                        data: {exam_id:exam_id, current_remain_time:current_remain_time, "_token": "{{ csrf_token() }}"},
                        type: 'POST',
                        dataType: "json",
                        success: function(response)
                        {
                            console.log(response.message);
                        }
                    });
            }, 60000);
        });
    </script>

@stop
