@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit
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
                <a href="{{ URL::to('/') }}">Admin</a>
            </li>
            <li>
                <a href="{{ URL::to('/test-configuration-list') }}">Test Config</a>
            </li>
            <li><a href="{{ URL::to('/test-configuration-list/'.$test_for) }}">
                    @foreach($test_list as $test)
                        @if($test->id == $test_for)
                            {{ $test->name }}
                        @endif
                    @endforeach
                    Test Config List</a>
            </li>
            <li class="active">Edit
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

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit
                            @foreach($test_list as $test)
                                @if($test->id == $test_for)
                                    {{ $test->name }}
                                @endif
                            @endforeach
                            Test Config 
                            @if($test_config->test_configuration_type==1)
                            <b class="text-success">(Random Item)</b>
                            @else
                            <b class="text-success">(Static Item)</b>
                             @endif
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_random_test">
                                <input type="hidden" id="id" value="{{ $test_config->id }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Test Name</label>
                                            <input type="text" name="test_name" id="item_set_name" value="{{ $test_config->test_name }}" class="form-control" placeholder="Item Set Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Total Item</label>
                                            <input type="number" name="total_item" id="total_question" value="{{ $test_config->total_item }}" class="form-control" placeholder="Total Item" required/>
                                            <label id="invalid_total_question" class="error" hidden></label>
                                            <span class="text-danger" id="totalItemError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Number of Selected Item</label>
                                            <input type="number" name="number_of_selected_item_item" id="number_of_selected_item_item" value="{{ $test_config->total_item }}" class="form-control" readonly placeholder="Number of Selected Item" min="1" onkeydown="return false" onmousedown="return false" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="candidate_type">Select Candidate Type</label>
                                            <select name="candidate_type" id="candidate_type" class="form-control" required>
                                                <option value=""> Choose one </option>
                                                @foreach($candidate_type as $value)
                                                    <option value="{{ $value->id }}" @if($test_config->candidate_type == $value->id) selected @endif>{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div> <!-- end row -->

                                

                                <label for="">Item Level</label>
                                <div class="row">
                                    @foreach($counts as $key => $count)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="{{ $key }}_level">{{ $count[$key.'_name'] }} </label> ({{ $count[$key.'_count'] }})
                                                <input type="number" name="{{ $count[$key.'_name'] }}" value="{{$count[$key.'_item_data']}}" id="{{ $key }}_level" class="form-control item_type" min="1" max="{{ $count[$key.'_count'] }}" placeholder="{{ $key }} level"  onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                                            </div>
                                        </div>
                                    @endforeach
                                </div> <!-- end row -->
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_time">Total Time</label>
                                            <input type="number" name="total_time" id="total_time" class="form-control" value="{{ $test_config->total_time }}" min="1" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="total_time">Pass Mark</label>
                                            <input type="number" name="pass_mark" id="pass_mark" class="form-control" min="1" value="{{ $test_config->pass_mark }}" placeholder="Candidate's pass mark" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Result Configuration? </label>
                                            <br/>
                                             <label for="result_config_yes">
                                                <input type="radio" name="result_config" class="result_config" id="result_config_yes" {{$test_config->result_config==1?'checked':''}} value="1" required/> Yes
                                            </label>
                                             <label for="result_config_no">
                                                <input type="radio" name="result_config" class="result_config" id="result_config_no" {{$test_config->result_config==0?'checked':''}}  value="0" required/> No 
                                            </label>
                                            <label> <a href="">&nbsp; &nbsp;&nbsp;&nbsp; |&nbsp; &nbsp; Refresh </a> </label>
                                        </div>
                                    </div> 
                                </div> <!--end row -->

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div id="testConfigDetails">
                                            <table class="table table-border table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>SL </th>
                                                        <th>Raw Score</th>
                                                        <th>Estimated Score</th>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                @if(count($test_config->resultConfigData)>0)
                                                @foreach ( $test_config->resultConfigData as $key=>$resultConfig)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td><input type='number' name='raw_score[]' value="{{ $resultConfig->raw_score}}" min='0' max='999' placeholder='Raw Score' class='raw-score' style="width:120px;" required /> </td>
                                                    <td><input type='number' name='estimated_score[]' value="{{$resultConfig->estimated_score}}" min='0' max='999999' placeholder='Estimated Score'   style="width:130px;" required/> </td>
                                                </tr>
                                                @endforeach

                                                   
                                                    @else
                                                    <tr>
                                                        <td colspan='3' style="text-align:center">No Test Config Data Found</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><!-- end row -->

                                <button class="btn btn-success create_set">Submit</button> | 
                                <a class="btn btn-danger" href="{{ URL::to('/new-test-configuration') }}">Back</a>
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
    <script src="{{ asset('js/edit_random_test_validation.js') }}"></script>

    <script>
        $('.result_config').on('change',function(){

            var total_question=$('#total_question').val()

            // Total Item / question Validation ------------
            if(total_question==''){
                $('#totalItemError').html('Total item is required')
                $('#totalItemError').css('displey','block')
                return false;
            }else{
                $('#totalItemError').html('')
                $('#totalItemError').css('displey','none')
            }

            var item_set_for=$('#item_set_for').val()
            var result_config=$(this).val()
            
            if(result_config==0){
                $('#testConfigDetails').empty();
            }else{
                $('#testConfigDetails').html('<center><img src=" {{asset('images/default/loading.gif')}}"/></center>').load('{{URL::to("load-test-result-config")}}/'+total_question); 
            }

            
        })
    </script>

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
