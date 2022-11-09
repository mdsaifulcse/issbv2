@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Edit
    @foreach($test_list as $test)
        @if($test->id == $item_set_for)
            {{ $test->name }}
        @endif
    @endforeach
    Question Set
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
        <h5>Welcome to Psychometrics Test</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li>
                <a href="{{ URL::to('/question-set') }}">Question Set </a>
            </li>
            <li>
                <a href="{{ URL::to('/question-set/'.$item_set_for) }}">
                    @foreach($test_list as $test)
                        @if($test->id == $item_set_for)
                            {{ $test->name }}
                        @endif
                    @endforeach
                    Question Set List
                </a>
            </li>
            <li class="active">Edit
                @foreach($test_list as $test)
                    @if($test->id == $item_set_for)
                        {{ $test->name }}
                    @endif
                @endforeach
                Question Set
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
                                @if($test->id == $item_set_for)
                                    {{ $test->name }}
                                @endif
                            @endforeach
                            Question Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="edit_qusetion_set">

                                <input type="hidden" name="item_set_for" id="item_set_for" value="{{ $item_set_for }}">
                                <input type="hidden" name="set_configuration_type" id="set_configuration_type" value="1">
                                <input type="hidden" name="item_change_status" id="item_change_status">
                                <input type="hidden" id="id" value="{{ $item_set->id }}">
                                <div class="form-group">
                                    <label for="total_question">Item Set Name</label>
                                    <input type="text" name="item_set_name" id="item_set_name" value="{{ $item_set->item_set_name }}" class="form-control" placeholder="Item Set Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Total Item</label>
                                    <input type="number" name="total_item" id="total_question" value="{{ $item_set->total_items }}" class="form-control" placeholder="Total Item" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Number of Selected Item</label>
                                    <input type="number" name="number_of_selected_item_item" value="{{ $item_set->total_items }}" id="number_of_selected_item_item" class="form-control" readonly placeholder="Number of Selected Item" min="1" onkeydown="return false" onmousedown="return false" required/>
                                </div>

                                <div class="form-group">
                                    <label for="candidate_type">Select Candidate Type</label>
                                    <select name="candidate_type" id="candidate_type" class="form-control" required>
                                        <option value=""> Choose one </option>
                                        @foreach($candidate_type as $value)
                                            <option value="{{ $value->id }}" @if($item_set->candidate_type == $value->id) selected @endif>{{ $value->name }}</option>
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

                                <div class="form-group">
                                    <label for="set_type">Set Type</label>
                                    <input type="text" name="set_type" id="set_type" class="form-control lowercase" value="{{ $item_set->set_type }}" placeholder="Set Type" required/>
                                </div>

                                <button class="btn btn-success edit_set">Submit</button>
                                <a class="btn btn-danger" href="{{ URL::to('/question-set/'.$item_set_for) }}">Back</a>
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
    <script src="{{ asset('js/edit-random-item-set-validation.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.item_type').on('keyup', function(){
                var sum = 0;
                $(".item_type").each(function(){
                    sum += +$(this).val();
                });

                var total_question = $("#total_question").val();

                if(sum == 0){
                    $("#number_of_selected_item_item").val(total_question);
                }
                else{
                    $("#number_of_selected_item_item").val(sum);
                }
            });

        });
    </script>
@stop
