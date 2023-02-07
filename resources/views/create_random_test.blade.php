@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create
    @foreach($test_list as $test)
        @if($test->id == $test_for)
            {{ $test->name }}
        @endif
    @endforeach
    Test Config
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <style>
        .lowercase {
           text-transform: lowercase;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create
                @foreach($test_list as $test)
                    @if($test->id == $test_for)
                        {{ $test->name }}
                    @endif
                @endforeach
                Test Config
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-10 col-md-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create
                            @foreach($test_list as $test)
                                @if($test->id == $test_for)
                                    {{ $test->name }}
                                @endif
                            @endforeach
                            Test Config
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_random_test">

                                <input type="hidden" name="test_for" id="item_set_for" value="{{ $test_for }}">
                                <input type="hidden" name="test_type" id="set_configuration_type" value="1">
                                <div class="form-group">
                                    <label for="total_question">Test Name </label>
                                    <input type="text" name="test_name" id="item_set_name" value="{{ $test_name }}" class="form-control" placeholder="Item Set Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Total Item</label>
                                    <input type="number" name="total_item" id="total_question" value="{{ $total_item }}" class="form-control" placeholder="Total Item" required/>
                                    <label id="invalid_total_question" class="error" idden></label>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Number of Selected Item</label>
                                    <input type="number" name="number_of_selected_item_item" id="number_of_selected_item_item" class="form-control" readonly placeholder="Number of Selected Item" min="1" onkeydown="return false" onmousedown="return false" required/>
                                </div>

                                <div class="form-group">
                                    <label for="candidate_type">Select Candidate Type</label>
                                    <select name="candidate_type" id="candidate_type" class="form-control" required>
                                        <option value=""> Choose one </option>
                                        @foreach($candidate_type as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="">Item Level</label>
                                <div class="row">
                                @foreach($counts as $key => $count)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="{{ $key }}_level">{{ $key }} </label> ({{ $count }})
                                            <input type="number" name="{{ $key }}" id="{{ $key }}_level" class="form-control item_type" min="1" max="{{ $count }}" placeholder="{{ $key }} level"  onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                                        </div>
                                    </div>
                                @endforeach
                                </div>

                                <div class="row">
                                    @if($noAnswerExist==0)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_time">Total Time</label>
                                            <input type="number" step="any" name="total_time" id="total_time" class="form-control" min="1" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                            {{--<input type="number" step="any" name="total_time" id="total_time" class="form-control" min="1" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>--}}
                                        </div>
                                    </div>
                                    @else

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_time_no_ans">Total Time In Second</label>
                                            <input type="number" step="any" name="total_time_no_ans" id="total_time_no_ans" class="form-control" placeholder="Total Time In Second"  required/>
                                            <input type="hidden" name="noAnswerExist" value="{{$noAnswerExist}}"/>
                                        </div>
                                    </div>    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="break_time">Break Time</label>
                                            <input type="number" name="break_time" id="break_time" class="form-control" placeholder="Break Time in minute"  required/>
                                        </div>
                                    </div>

                                        @endif

                                </div>


                                <div class="form-group">
                                    <label for="total_time">Pass Mark</label>
                                    <input type="number" name="pass_mark" id="pass_mark" class="form-control" min="1" placeholder="Candidate's pass mark" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                    <input type="hidden" value="{{url('/')}}" id="baseUrl"/>
                                </div>

                                <button class="btn btn-success create_set">Submit</button>
                                <a class="btn btn-danger pull-right" href="{{ URL::to('/new-test-configuration') }}">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script src="{{asset('js/jequery-validation.js')}}"></script>
    <script src="{{ asset('js/create_random_test_validation.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.item_type').on('keyup', function(){
                var sum = 0;
                $(".item_type").each(function(){
                    sum += +$(this).val();
                });
                $("#number_of_selected_item_item").val(sum);
            });
        });
    </script>
@stop
