@extends('candidates.layouts.default')

@section('content')
    <section class="content">
        <div class="panel panel-white">
            <div class="panel panel-white">
                {{--<div class="panel-heading">--}}
                    {{--<h6 class="panel-title">Assessment </h6>--}}
                {{--</div>--}}
            </div>
            <div class="panel-body">
                <h2 class="text-center">Please wait for the Next Instruction!</h2>
                <hr>
                @if ($examConfigRunningStatus == 1)
                <div class="text-center">
                    <a class="btn btn-lg btn-primary" href="{{route('candidate.candidateExamStart', ['examId'=>$examId])}}" role="button">Start Assessment</a>
                </div>
                @else
                    <div class="text-center">
                        <a class="btn btn-lg btn-success" id="refresh" href="#" role="button">Refresh</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

@stop


@push('javascript')
    <script type="text/javascript">
        $('#refresh').click(function() {
            location.reload();
        });
    </script>
@endpush
