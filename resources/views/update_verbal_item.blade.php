@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Verbal Item
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('css/form-check.css') }}" rel="stylesheet">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jasny-bootstrap.css')}}">
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <style>
        span.btn.btn-primary.btn-file.btn-sm {
            margin: 0px 2px;
        }
        span.btn.btn-danger.btn-sm.remove-img {
             padding: 2px 7px;
             border-radius: 50%;
             box-shadow: 0px 0px 6px 0px #535353;
             border: 0;
         }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            color: #dc3545;
            background: #fff;
            font-size: 12px;
        }
        label#-error {
            display: none;
        }
        .btn.btn-info.btn-sm {
             margin: 7px 0px;
         }
        .mt-2 {
            margin-top: 10px;
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
            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
            <li>
                <a href="{{ URL::to('/item-create') }}">Item Create</a>
            </li>
            <li>
                <a href="{{ URL::to('/psym-item-create') }}">PSYM Item Create</a>
            </li>
            <li class="active">Update Verbal Item</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update Verbal Item
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="update_verbal_item" enctype="multipart/form-data"  class="needs-validation" novalidate>

                                <input type="hidden" class="text_options_list" name="text_options_list">
                                <input type="hidden" id="id" value="{{ $verbal_item->id }}">
                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" value="{{ $verbal_item->name }}" id="question_name" placeholder="Item Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($levels as $value)
                                            <option value="{{ $value->id }}" @if($value->id == $verbal_item->level) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($categories as $value)
                                            <option value="{{ $value->id }}" @if($value->id == $verbal_item->category) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" value="{{ $verbal_item->top_text }}" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" value="{{ $verbal_item->down_text }}" placeholder="Down Text"/>
                                </div>

                                <div class="form-group" hidden>
                                    <label>Item Type</label><br>
                                    <label for="qt_text_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_text_field" value="1" checked/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_img_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_img_field" value="2"/> Image Field
                                    </label>
                                </div>
                                <label id="question_type-error" class="error" for="question_type" hidden></label>

                                <div id="qt_text_show" hidden>
                                    <label for="item">Item</label>
                                    <div class="form-group">
                                        <textarea name="item" id="item" class="form-control" placeholder="Item" required>{{ $verbal_item->question }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group" hidden>
                                    <label>Option Type</label><br>
                                    <label for="opt_text_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_text_field" value="1" checked/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_img_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_img_field" value="2" /> Image Field
                                    </label>
                                </div>
                                <label id="option_type-error" class="error" for="option_type" hidden></label>

                                <?php $sub_questions = explode('||', $verbal_item->sub_questions);
                                $sub_options = explode('~~', $verbal_item->sub_options);
                                $sub_right_answers = explode('||', $verbal_item->sub_right_answers);
                                ?>
                                @foreach($sub_options as $key => $sub_option)
                                    <div class="sub_question_blog sub_ques">
                                        <span class="btn btn-danger btn-sm remove_sub_question" id="remove_{{ $key + 1}}" style="float: right; margin-top: 5px; margin-bottom: 5px;">&times;</span>
                                        <div class="form-group">
                                            <label for="sub_question" style="margin: 5px 2px;">Sub Question</label>
                                            <input type="text" class="form-control sub_question" name="sub_question[]" id="" placeholder="Sub Question" value="{{ $sub_questions[$key++] }}" required/>
                                        </div>
                                        <div id="otp_text_show">
                                            <?php $options = explode('||', $sub_option); ?>
                                            @foreach($options as $option)
                                              <div class="form-group extra_field">
                                                <label for="option">Option</label>
                                                <span class="btn btn-danger btn-sm remove" id="remove_{{ $key }}" style="float: right;margin-bottom: 2px;">&times;</span>
                                                <input type="text" class="form-control textOptions_{{ $key }}" name="text_options_{{ $key }}[]" id="" placeholder="Option" value="{{ $option }}" required/>
                                              </div>
                                            @endforeach
                                            <span class="more_text_opt"></span>
                                            <div class="btn btn-info btn-sm text_opt" id="textOpt_{{ $key }}">add more option</div>
                                            <select name="sub_right_answer[]" id="sub_right_answer_{{ $key }}" class="form-control sub_right_answer" required>
                                                <option value=""> Choose Sub Correct Answer </option>
                                                <?php $options = explode('||', $sub_options[--$key]);
                                                $sub_right_answers= explode('||', $verbal_item->sub_right_answers);
                                                $option = count($options);

                                                for($i=1; $i<=$option; $i++)
                                                {?>
                                                <option value="{{ $i }}"  @if($sub_right_answers[$key] == $i) selected @endif>Option {{ $i }}</option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                                <span id="more_sub_question"></span>
                                <div class="btn btn-primary btn-sm mt-2" id="sub_question">add more sub question</div>

                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1" @if($verbal_item->publish_status == 1) selected @endif>Active</option>
                                        <option value="2" @if($verbal_item->publish_status == 2) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <button class="btn btn-success update">Submit</button>
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
    <script src="{{asset('assets/js/jasny-bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{asset('js/jequery-validation.js')}}"></script>
    <script src="{{ asset('js/update-verbal-item-validation.js') }}"></script>
    <script src="{{ asset('js/update-numeric-question.js') }}"></script>
    <script>
        $(document).ready(function(){
            var names = [];
            var sub_question = $('.sub_question').length;
            for(i = 1; i <= sub_question; i++){
                names.push('text_options_'+i);
            }
            $('.text_options_list').val(names);

            var i = sub_question;
            $('#sub_question').on('click', function(){
                i++;
                names.push('text_options_'+i);
                $('.text_options_list').val(names);

                var total_question = $('.sub_question').length;
                if(total_question != 1){
                    $('.remove_sub_question').show();
                }
            });
            $(document).on('click', '.remove_sub_question', function(e){
                var total_question = $('.sub_question').length;
                var id = $(this).attr('id');
                var split_id = id.split(/_/);
                names = jQuery.grep(names, function(value) {
                    return value != 'text_options_'+split_id[1];
                });
                $('.text_options_list').val(names);

                if(total_question == 1){
                    $('.remove_sub_question').hide();
                }
            });
        })
    </script>
@stop
