@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update @if($db == 'pm-set') PM @elseif($db == 'vit-set') VIT @endif Item Set
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
        <h5>Welcome to Psychometrics Test</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Update @if($db == 'pm-set') PM @elseif($db == 'vit-set') VIT @endif Item Set</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update @if($db == 'pm-set') PM @elseif($db == 'vit-set') VIT @endif Item Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="update_iq_qusetion_set">

                                <input type="hidden" value="@if($db == 'pm-set')pm_question_set @elseif($db == 'vit-set')vit_question_set @endif" name="question_set_for">
                                <input type="hidden" value="{{ $question_set->id }}" id="id">

                                <div class="form-group">
                                    <label for="question_set_for">Item Set Name</label>
                                    <input type="text" class="form-control" name="item_set_name" placeholder="Item Set Name"  value="{{ $question_set->item_set_name }}" required/>
                                </div>

                                <div class="form-group">
                                    <label for="candidate_type">Select Candidate Type</label>
                                    <select name="candidate_type" id="candidate_type" class="form-control" required>
                                        <option value=""> Choose one </option>
                                        @foreach($candidate_type as $value)
                                            <option value="{{ $value->id }}" @if($value->id == $question_set->candidate_type) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label for="">Item Type</label>
                                <?php $i = 0;
                                    $explode = explode('||', $question_set->question_level)
                                ?>
                                <div class="row">
                                    @foreach($counts as $key => $count)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="{{ $key }}_level">{{ $key }} </label> ({{ $count }})
                                                <input type="number" class="form-control item_type" name="{{ $key }}" @if(isset($explode[$i])) value="{{ $explode[$i] }}" @endif id="{{ $key }}_level" min="1" max="{{ $count }}" placeholder="{{ $key }} Level">
                                            </div>
                                        </div>
                                        <?php $i++ ?>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Total Question</label>
                                    <input type="number" name="total_item" id="total_question" value="" class="form-control" readonly placeholder="Total Question" min="1" onkeydown="return false" onmousedown="return false" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_time">Total Time</label>
                                    <input type="number" name="total_time" id="total_time" class="form-control" value="{{ $question_set->total_time }}" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_time">Pass Mark</label>
                                    <input type="number" name="pass_mark" id="pass_mark" class="form-control" value="{{ $question_set->pass_mark }}" min="1" placeholder="Candidate's pass mark" required/>
                                </div>

                                <button class="btn btn-success update_ip_set">Submit</button>
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
    <script src="{{ asset('js/update-iq-question-set-validation.js') }}"></script>
    <script>
        $(document).ready(function(){
            var sum = 0;
            $(".item_type").each(function(){
                sum += +$(this).val();
            });
            $("#total_question").val(sum);
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
