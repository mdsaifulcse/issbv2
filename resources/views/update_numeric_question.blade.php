@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Numeric Question
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
                @if($status==1)
                <a href="{{ URL::to('/item-bank/active') }}">Item Bank Active</a>
                    @else
                    <a href="{{ URL::to('/item-bank/inactive') }}">Item Bank Inactive</a>
                    @endif
            </li>
            
            
             <li>
                <a href="{{ URL::to('numeric-question-bank/'.$status) }}">Numeric @if($status==1) Active  @else Inactive @endif Item List</a>
                
            </li>
            
            <li class="active">
               Update Numeric Question
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update Numeric Question
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form method="POST" action="{{ URL::to('/editNumericQuestion/'.$numeric_question->id) }}" id="update_numeric_qusetion" enctype="multipart/form-data"  class="needs-validation" novalidate>
                                {{ csrf_field() }}

                                <input type="hidden" class="text_options_list" name="text_options_list">
                                <div class="form-group">
                                    <label for="question_name">Question Name</label>
                                    <input type="text" class="form-control" name="question_name" id="question_name" value="{{ $numeric_question->name }}" placeholder="Item Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Question Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($levels as $value)
                                            <option value="{{ $value->id }}" @if($numeric_question->level == $value->id) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Question Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($categories as $value)
                                            <option value="{{ $value->id }}" @if($numeric_question->category == $value->id) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" value="{{ $numeric_question->top_text }}" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" value="{{ $numeric_question->down_text }}" placeholder="Down Text"/>
                                </div>

                                <div class="form-group" hidden>
                                    <label>Question Type</label><br>
                                    <label for="qt_text_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_text_field" value="1" /> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_img_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_img_field" value="2" checked/> Image Field
                                    </label>
                                </div><label id="question_type-error" class="error" for="question_type" hidden></label>

                                <div id="qt_text_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Question</label>
                                        <input type="text" class="form-control text_questions" name="text_questions" id="" placeholder="Question"/>
                                    </div>
                                </div>

                                <div id="qt_img_show" hidden>
                                    <label for="down_text">Question</label>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if($numeric_question->question_type == 2)
                                                    <img src="{{ asset('assets/uploads/questions/'.$numeric_question->question) }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                                @else
                                                    <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file btn-sm">
                                                    <span class="fileinput-new">Choose image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" class="form-control img_questions" name="img_questions" accept="image/*" id=""/>
                                                </span>
                                                <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                            </div><label id="img_questions-error" class="error" for="img_questions"></label>
                                        </div>
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
                                <?php $sub_questions = explode('||', $numeric_question->sub_questions);
                                      $sub_options = explode('~~', $numeric_question->sub_options);
                                      $sub_right_answers = explode('||', $numeric_question->sub_right_answers);
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
                                                  $sub_right_answers= explode('||', $numeric_question->sub_right_answers);
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

                                <div id="opt_img_show" hidden>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="down_text">Option</label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>
                                                    <div>
                                            <span class="btn btn-primary btn-file btn-sm">
                                                <span class="fileinput-new">Choose image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="form-control img_options" name="img_options[]" accept="image/*" id=""/>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </span>
                                                        <label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>
                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <span id="more_img_opt"></span>
                                    </div>
                                    <div class="btn btn-info btn-sm" id="img_opt">add more</div>
                                </div>
                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1" @if($numeric_question->publish_status == 1) selected @endif>Active</option>
                                        <option value="2" @if($numeric_question->publish_status == 2) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <button class="btn btn-success create">Submit</button>
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
    <script src="{{ asset('js/update-numeric-question-validation.js') }}"></script>
    <script src="{{ asset('js/update-numeric-question.js') }}"></script>

    <script>
        $(document).ready(function(){
            @if (count($errors) > 0)
            toastr.error('<br>'+'@foreach ($errors->all() as $error){{ $error }}@endforeach', 'You Got Error', {timeOut: 5000});
            @endif

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
        });
    </script>
@stop