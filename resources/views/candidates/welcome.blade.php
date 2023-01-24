@extends('candidates.layouts.default')


@section('content')

 {{--<div class="page-header">--}}
    {{--<div class="page-header-content">--}}
        {{--<div class="page-title">--}}
            {{--<h4><span class="text-semibold">Selection Board</span></h4>--}}
        {{--</div>--}}

        {{--<div class="heading-elements">--}}
            {{--<div class="heading-btn-group">--}}
                {{--<a href="#" class="btn btn-link btn-float has-text">--}}
                    {{--<img class="img-circle img-sm" src="{{ asset('backend/assets/images/placeholder.jpg') }}" alt="ProfileImage">--}}
                {{--</a>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="text-center">--}}
            {{--<div style="border-bottom: 1px solid #dddddd;">--}}
                {{--<span style="font-size: 18px;">Welcome! <strong style="font-size: 24px; letter-spacing: 2px;">{{$userInfo->name}} Chest no: {{$userInfo->chest_no}}</strong></span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<a class="heading-elements-toggle"><i class="icon-menu"></i></a>--}}
    {{--</div>--}}

    {{--<div class="breadcrumb-line"></div>--}}
{{--</div>--}}


<!-- Content area -->
<div class="content" style="margin: auto;" width="100%">
    <div class="panel panel-white">

        <div class="panel-body text-center">
            <div class="">
                <!-- <a class="btn btn-lg btn-success" id="refresh" href="#" role="button">Refresh</a> -->
                <button class="btn btn-lg btn-success full-screen-btn" id="refresh">Refresh</button>
            </div>

            @if (!empty($configuredExam))
                @if (!empty($candidateExamInfo))
                    @if ($candidateExamInfo->exam_status==2)
                        <h2 class="text-danger">
                            Your Test time is over <br>
                            Or You have attempted this test, Please wait for next Instruction
                        </h2>
                    @else
                        @if ($candidateExamInfo->instruction_seen_status == 0)
                            <a class="btn btn-default btn-sm mt-10" href="{{ route('candidate.examInstruction', ['examId'=>$configuredExam->id,'step_id'=>'']) }}" style="padding: 5%;">Instruction & Demo <i class="icon-play3 position-right"></i></a>
                        @elseif($candidateExamInfo->instruction_seen_status == 1 && $candidateExamInfo->demo_exam_status == 0)
                            <a class="btn btn-default btn-sm mt-10" href="{{ route('candidate.examDemoItemPreview', ['examId'=>$configuredExam->id]) }}" style="padding: 5%;">Demo Assessment<i class="icon-play3 position-right"></i></a>
                        @elseif($configuredExam->exam_status == 1)
                            <a class="btn btn-default btn-sm mt-10" href="{{ route('candidate.candidateExamStart', ['examId'=>$configuredExam->id]) }}" style="padding: 5%;">Start Final Assessment<i class="icon-play3 position-right"></i></a>
                        @else
                            <a class="btn btn-danger btn-sm mt-10" href="#" style="padding: 5%;" disabled>Assessment Not Start<i class="icon-play3 position-right"></i></a>
                        @endif
                    @endif
                @else
                    @if($upcomingExamStatus==1)
                        <a class="btn btn-default btn-sm mt-10" href="{{ route('candidate.examInstruction', ['examId'=>$configuredExam->id, 'step_id'=>'']) }}" style="padding: 5%;">Instruction & Demo <i class="icon-play3 position-right"></i></a>
                    @else
                        <h2 class="text-danger">Assessment Not Available! </h2>
                    @endif
                @endif
            @endif

        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-muted modal-anywhere">
        &copy; {{date('Y')}}. <a href="#">Developed</a> by <a href="#" target="_blank">Silvereagle </a>
        <a href="#" class="open-modal secret_key" modal-title="Secret Key Check" modal-type="create" modal-size="medium" modal-class="" selector="viewResource" modal-link="{{route('candidate.secretKeyModal')}}"></a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
@endsection


@push('javascript')
    <script type="text/javascript">
        $('#refresh').on('click', function() {
            location.reload();            
        });
        
    </script>
    <script>
        $(document).ready(function(){
            @if (session('msgType'))
            toastr.success('{{ session("messege") }}', 'You Got Error', {timeOut: 5000});
            @endif
        });

        $(document).ready(function() {
            if (sessionStorage.getItem('activation') == 'success') {
                toastr.success('Item has been successfully activated', 'Success Alert', {
                    timeOut: 5000
                });
                sessionStorage.removeItem("activation");
            }


            @if($message = Session::get('success'))
            toastr.success('{{ $message }}', 'Success Alert', {
                timeOut: 5000
            });
            @endif
        });
    </script>
@endpush
