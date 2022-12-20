@extends('candidates.layouts.default')

{{-- Page title --}}
@section('title')
@if($status == 1)
Active
@elseif($status == 2)
Inactive
@else
Test
@endif

@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
<style>
    .single-question-answer{
        border: 1px dashed #c4b9d5;
        margin-bottom: 10px;
    }
    .question{
        margin: 5px;
        /*border-bottom: 1px solid #d9d0d09e;*/
    }
    .pagination {
        float: right;
    }
    .question-heading, .answer-option{
        display: inline-flex !important;
    }
    .question-answer{
        text-indent: 20px;
        margin: 10px;
        /*border-bottom: 1px dashed #c4b9d5;*/
    }
    .answer-option{
        border: 2px dashed #04aceb;
        margin: 10px;
        padding: 8px;
    }
    .answer-option img{
        width: 90px;
        height: 56px;
    }

</style>
@stop

{{-- Page content --}}
@section('content')
    <!-- <section class="content-header">
        <h5>Assessment</h5>
         <ol class="breadcrumb">
            <li>
                <div id="examTimeCountDown"></div>
            </li>
            <li>
                Running Question: <span class="runningQuestionsShow">1</span>|
            </li>
            <li>
                Total Questions: <span class="totalQuestionsShow">3</span>
            </li>
        </ol> 
    </section> -->
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                {{----}}
                <div class="panel-body">

                    @php
                        if ($itemDetails->sub_question_status==1){
                            $itemType   = $itemDetails->sub_question_type;
                            $items      = explode('||', $itemDetails->sub_question);
                            $optionType = $itemDetails->sub_option_type;
                            $imagePath  = 'assets/uploads/sub_options/images/';
                            $soundPath  = 'assets/uploads/sub_options/sounds/';
                        } else{
                            $itemType   = $itemDetails->item_type;
                            $item       = $itemDetails->item;
                            $optionType = $itemDetails->option_type;
                            $imagePath  = 'assets/uploads/options/images/';
                            $soundPath  = 'assets/uploads/options/sounds/';
                        }
                    @endphp

                    @if ($itemDetails->sub_question_status !=1)

                    <div class="single-question-answer">

                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question">
                                    @if($itemType == 1)
                                        <h3 class="question-heading text-dark" style="display:inline-flex;">Question: &nbsp; <?php echo $item?></h3>
                                    @elseif($itemType == 2)
                                        <strong>Question: </strong> <img src="{{ asset('assets/uploads/questions/images/'.$item) }}" alt="..." style="width: 180px; height: 113px;" title="This image is the question" class="img-responsive img-thumbnail">
                                    @elseif($itemType == 3)
                                    <h3>Question : </h3>
                                    <audio controls>
                                            <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/ogg">
                                            <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                      
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question-answer">
                                    @php
                                        $options = $itemDetails->options;
                                        $itemCorAns = $itemDetails->correct_answer;

                                        $questionOptions = explode('||', $options);
                                    @endphp


                                    @if (count($questionOptions)>0)
                                        @foreach ($questionOptions as $key=>$questionOption)

                                            @if($optionType == 1)

                                            <input type="radio" id="{{$key}}o" name="options">
                                                
                                            <label for="{{$key}}o" class="btn btn-info"> {{ $questionOption }} </label>
                                               

                                            @elseif($optionType == 2)
                                                
                                                <div class="answer-option">
                                                    <input type="radio" id="{{$key}}i" name="imgOption">
                                                    <label for="{{$key}}i">
                                                        <img src="{{ asset($imagePath.$questionOption) }}" alt="..." class="img-responsive img-thumbnail">
                                                    </label>
                                                </div>
                                              
                                                
                                            @elseif($optionType == 3)
                                                Option {{$key+1}}: <audio controls>
                                                    <source src="{{ asset($soundPath.$questionOption) }}" type="audio/ogg">
                                                    <source src="{{ asset($soundPath.$questionOption) }}" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @endif

                                        @endforeach
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>




                    @else
                         <!-- ------------------ For Sub Question and Option --------------------- -->
                        @php
                            $optionsAll    = explode('~~', $itemDetails->sub_options);
                            $corAnswers     = explode('||', $itemDetails->sub_correct_answer);
                        @endphp
                        @foreach ($items as $key=>$item)

                    <div class="single-question-answer">
                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question">
                                    @if($itemType == 1)
                                        <h3 class="question-heading text-dark" style="display:inline-flex;">{{$key+1}}. &nbsp; <?php echo $item?> </h3>
                                    @elseif($itemType == 2)

                                    <strong> Question {{$key+1}}: &nbsp; &nbsp;</strong> <img src="{{ asset('assets/uploads/sub_questions/images/'.$item) }}" alt="..." style="width: 180px; height: 113px;" title="This image is the question">

                                    @elseif($itemType == 3)
                                    <h3>{{$key+1}}. Question : </h3>
                                        <audio controls>
                                            <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/ogg">
                                            <source src="{{ asset('assets/uploads/questions/sounds/'.$item) }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @endif

                                </div>
                            </div>

                        </div>



                    <div class="row">
                        <div class="col-md-12 col-xl-12 col-xs-12">
                            <div class="question-answer">
                                @php
                                    $questionOptions    = explode('||', $optionsAll[$key]);
                                    $corAns             = $corAnswers[$key];
                                @endphp

                                @if (count($questionOptions)>0)
                                    @foreach ($questionOptions as $j=>$questionOption)

                                        @if($optionType == 1)
                                           
                                           <input type="radio" id="{{$key}}o" name="options">
                                           <label for="{{$key}}o" class="btn btn-info">{{ $questionOption }} </label>
                                        


                                        @elseif($optionType == 2)

                                            
                                                <div class="answer-option">
                                                   
                                                    <input type="radio" id="{{$j}}o" name="imgOption">

                                                    <label for="">
                                                    <img src="{{ asset($imagePath.$questionOption) }}" alt="..." class="img-responsive img-thumbnail">
                                                </label>
                                                </div>
                                            
                                    

                                        @elseif($optionType == 3)
                                        Option {{$j+1}}:
                                            <audio controls>
                                                <source src="{{ asset($soundPath.$questionOption) }}" type="audio/ogg">
                                                <source src="{{ asset($soundPath.$questionOption) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif


                                    @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                        @endforeach
                    @endif

                    <br>
                    <div class="">
                    <button class="btn btn-success btn-sm pull-left" onclick="history.go(-1)">Previous</button>
                     {{--<a href="">--}}
                        {{--<button class="btn btn-success btn-sm pull-left">Previous</button>--}}
                    {{--</a>--}}
                    @if($next_demo_question_id==0)

                        <a href="{{route('candidate.examDemoFinish', ['examId'=>$examId])}}">
                            <button class="btn btn-success btn-sm pull-right">Next</button>
                        </a>
                    @else
                    <a href="{{url('/candidate/examDemoItemPreview'."?examId=$examId"."&next_demo_question_id=$next_demo_question_id"."&skip=$skip")}}">
                        <button class="btn btn-success btn-sm pull-right">Next</button>
                    </a>
                @endif
                </div>
                </div>


            </div>
        </div>
    </div>

</section>
<!-- content -->

@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- For Editors -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
<script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
@if($status == 2)
<script src="{{ asset('js/activate.js') }}"></script>
@endif

<script>
    $(document).ready(function(){
        @if (session('msgType'))
        toastr.success('{{ session("messege") }}', 'You Got Error', {timeOut: 5000});
        @endif
    });
</script>

<script>

    $(document).ready(function() {
        if (sessionStorage.getItem('activation') == 'success') {
            toastr.success('Item has been successfully activated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("activation");
        }

        $('#example').DataTable({
            "searching": false,
            "paging": false,
            "info": false,
            "lengthChange": false,
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": 2
            }]
        });

        @if($message = Session::get('success'))
        toastr.success('{{ $message }}', 'Success Alert', {
            timeOut: 5000
        });
        @endif
    });

    function QuestionDelete(id) {

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: '/destroyItem/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Item has been successfully deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function(e) {
                        toastr.error('You Got Error', 'Inconceivable!', {
                            timeOut: 5000
                        })
                    }
                })


            });
    }
</script>
{{ session()->forget('success') }}
@stop
