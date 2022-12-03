@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Test
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <style>
        .instruction-image{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }
    </style>
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5>Assessment Configuration</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Assessment Configuration</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                {{-- <div class="text-center"><a class="btn btn-lg btn-success" href="#" role="button">Refresh</a></div>
                <br> --}}
                {{--<div class="panel panel-info">--}}
                    {{--<div class="panel-heading clearfix">--}}
                        {{--<h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>--}}
                            {{--Instruction--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        <div class="load_content">
                            <div class="page_loader">
                                <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                            </div>
                            @if (!empty($configInstruction))
                                <div class="inst_content">
                                    <p class="instruction-text">
                                        @if ($configInstruction->text != NULL || $configInstruction->text != '')
                                        {{ $configInstruction->text }}
                                        @endif</p>
                                    <img src="{{ asset('uploads/instruction/'.$configInstruction->image) }}" alt="" class="instruction-image">
                                    <input type="hidden" name="" id="instrucId" value="{{$configInstruction->id}}">
                                </div>
                            @else
                                <div class="inst_content text-center">
                                    <h3>No Instruction Found</h3>
                                </div>
                            @endif
                        </div>
                        @if (!empty($configInstruction))
                        <div class="action-btn" style="margin-top: 15px;">
                            @if ($instructionEndStatus == 0)
                                <a class="btn btn-lg btn-primary pull-right" href="{{route('examDemoQOne', ['examId'=>$examId])}}" role="button">Next</a>
                            @else
                                <a class="btn btn-lg btn-primary pull-left" href="{{route('examScheduleList')}}" role="button">Back</a>
                                <button class="btn btn-lg btn-primary pull-right" id="nextInst" examId="{{$examId}}" role="button">Next</button>
                            @endif
                        </div>
                        @endif

                    {{--</div>--}}
                {{--</div>--}}
                {{-- <br>
                <div class="text-center"><a class="btn btn-lg btn-primary" href="{{route('examDemoQOne', ['examId'=>$examId])}}" role="button">Sample Test</a></div>
                <br> --}}
            </div>


        </div>
        <!--/row-->
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

            $('.page_loader').hide();
            $('#nextInst').on('click', function(e) {
                e.preventDefault();
                let instrucId = $('#instrucId').val();
                let examId = $(this).attr('examId');


                $('.load_content').html(`<div class="page_loader">
                                    <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                                </div>`);

                $.ajax({
                    mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                    url: "{{ route('nextInstruction') }}",
                    data: {'examId': examId, 'instrucId': instrucId},
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        console.log(response)
                        if (parseInt(response) === 0) {
                            $('.page_loader').show();
                        } else {
                            $('.page_loader').hide();
                            $('.inst_content').remove();
                            if(response.text !=null){
                                var title = response.text;
                            } else {
                                var title = '';
                            }
                            let html =
                            `<div class="inst_content">
                                <p class="instruction-text">${title}</p>
                                <img src="{{ asset('uploads/instruction/${response.image}') }}" alt="" class="instruction-image">
                                <input type="hidden" id="instrucId" value="${response.instrucId}">
                            </div>`;
                            $('.load_content').html(html);
                            if (response.instructionEndStatus == 0) {
                                $('#nextInst').remove();
                                $('.action-btn').html(`<a class="btn btn-lg btn-primary pull-right" href="{{route('examDemoItemPreview', ['examId'=>$examId])}}" role="button">Next</a>`);
                                {{--$('.action-btn').html(`<a class="btn btn-lg btn-primary pull-right" href="{{route('examDemoQOne', ['examId'=>$examId])}}" role="button">Next</a>`);--}}
                            }
                            console.log(response.instructionEndStatus);

                        }
                    }
                });
            })
        });
    </script>

@stop
