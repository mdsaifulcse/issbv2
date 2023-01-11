@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create PM Item Set
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
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
            <li class="active">Create PM Item Set</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create PM Item Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_iq_qusetion_set">
                                <input type="hidden" name="question_set_for" id="question_set_for" value="pm_question_set">

                                <div class="form-group">
                                    <label for="question_set_for">Item Set Name</label>
                                    <input type="text" class="form-control" name="item_set_name" placeholder="Item Set Name" required>
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

                                <label for="">Item Type</label>
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
                                    <label for="total_question">Total Item</label>
                                    <input type="number" name="total_item" id="total_question" value="" class="form-control" readonly placeholder="Total Question" min="1" onkeydown="return false" onmousedown="return false" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_time">Total Time</label>
                                    <input type="number" name="total_time" id="total_time" class="form-control" min="1" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_time">Pass Mark</label>
                                    <input type="number" name="pass_mark" id="pass_mark" class="form-control" min="1" placeholder="Candidate's pass mark" required/>
                                </div>

                                <button class="btn btn-success create_set">Submit</button>
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
    <script src="{{ asset('js/create-iq-question-set-validation.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.item_type').on('keyup', function(){
                var sum = 0;
                $(".item_type").each(function(){
                    sum += +$(this).val();
                });
                $("#total_question").val(sum);
            });
        });
    </script>
@stop
