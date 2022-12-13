@extends('candidates.layouts.default')

@section('content')
    {{-- <div class="page-header">
        <div class="page-header-content">
            <div class="page-title">
                <h4><span class="text-semibold">Selection Board</h4>
            </div>

            <div class="heading-elements">
                <div class="heading-btn-group">
                    <a href="#" class="btn btn-link btn-float has-text">
                        <img class="img-circle img-sm" src="{{ asset('backend/assets/images/placeholder.jpg') }}" alt="ProfileImage">
                    </a>
                </div>
            </div>

            <div class="text-center">
                <div style="border-bottom: 1px solid #dddddd;">
                    <span style="font-size: 18px;">Welcome! <strong style="font-size: 24px; letter-spacing: 2px;">{{$userInfo->name}} Chest no: 101</strong></span>
                </div>
            </div>
            <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
        </div>

        <div class="breadcrumb-line"></div>
    </div> --}}

    <!-- Content area -->
    <div class="content" style="max-width: 1600px; margin: auto;">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Instruction
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="load_content">
                            <div class="page_loader">
                                <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                            </div>
                            <div class="inst_content">
                                <p class="instruction-text">{{$configInstruction->text}}</p>
                                <hr>
                                <img src="{{ asset('uploads/instruction/'.$configInstruction->image) }}" alt="" class="instruction-image img-fluid img-thumbnail" height="auto" width="50%">
                                <input type="hidden" name="" id="instrucId" value="{{$configInstruction->id}}">
                            </div>
                        </div>
                        <div class="action-btn">
                            @if ($instructionEndStatus == 0)
                                <a class="btn btn-lg btn-primary pull-right" href="{{route('candidate.examDemoQOne', ['examId'=>$examId])}}" role="button">Next</a>
                            @else
                                <button class="btn btn-lg btn-primary pull-right" id="nextInst" examId="{{$examId}}" role="button">Next</button>
                            @endif
                        </div>

                    </div>

                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- /content area -->
@stop

@push('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.page_loader').hide();

        // sub menu
        $('#nextInst').on('click', function(e) {
            e.preventDefault();
            let instrucId = $('#instrucId').val();
            let examId = $(this).attr('examId');


//            $('.load_content').html(`<div class="page_loader">
//                                <div class="text-center"><h4>Loading...0</h4><div class="loader"></div></div>
//                            </div>`);

            $.ajax({
                mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                url: "{{ route('candidate.getInstruction') }}",
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
                        let html =
                        `<div class="inst_content">
                            <p class="instruction-text">${response.text}</p><hr>
                            <img src="{{ asset('uploads/instruction/${response.image}') }}" alt="" class="instruction-image img-fluid img-thumbnail">
                            <input type="hidden" id="instrucId" value="${response.instrucId}">
                        </div>`;
                        $('.load_content').html(html);
                        if (response.instructionEndStatus == 0) {
                            $('#nextInst').remove();
                            $('.action-btn').html(`<a class="btn btn-lg btn-primary pull-right" href="{{route('candidate.examDemoItemPreview', ['examId'=>$examId])}}" role="button">Next</a>`);
                        }
                    }
                }
            });
        })
        // end sub
    })

</script>
@endpush
