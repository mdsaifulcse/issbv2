@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Numeric Item
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
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li><a href="{{ URL::to('/') }}">Dashboard</a></li>
            <li>
                <a href="{{ URL::to('/item-create') }}">Item Create</a>
            </li>
            <li class="active">
                <a href="{{ URL::to('/psym-item-create') }}">PSYM Item Create</a>
            </li>
            <li class="active">Create New Numeric Item</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Numeric Item
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form method="POST" action="{{ URL::to('/storeNumericQuestion') }}" id="create_numeric_qusetion" enctype="multipart/form-data"  class="needs-validation" novalidate>
                                {{ csrf_field() }}

                                <input type="hidden" class="text_options_list" name="text_options_list">
                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" id="question_name" placeholder="Item Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($levels as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($categories as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" placeholder="Down Text"/>
                                </div>

                                <div class="form-group" hidden>
                                    <label>Item Type</label><br>
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
                                        <label for="option">Item</label>
                                        <input type="text" class="form-control text_questions" name="text_questions" id="" placeholder="Question"/>
                                    </div>
                                </div>

                                <div id="qt_img_show" hidden>
                                    <label for="down_text">Item</label>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file btn-sm">
                                                    <span class="fileinput-new">Choose image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" class="form-control img_questions" name="img_questions" accept="image/*" id="" required/>
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

                                <div class="sub_question_blog">
                                    <div class="form-group">
                                        <label for="sub_question">Sub Question</label>
                                        <input type="text" class="form-control sub_question" name="sub_question[]" id="" placeholder="Sub Question" required/>
                                    </div>
                                    <div id="otp_text_show" hidden>
                                        <div class="form-group">
                                            <label for="option">Option</label>
                                            <input type="text" class="form-control text_options" name="text_options_0[]" id="" placeholder="Option" required/>
                                        </div>
                                        <span class="more_text_opt"></span>
                                        <div class="btn btn-info btn-sm text_opt">add more option</div>
                                        <select name="sub_right_answer[]" id="" class="form-control sub_right_answer" required>
                                            <option value=""> Choose Sub Correct Answer</option>
                                            <option value="1">Option 1</option>
                                        </select>
                                    </div>
                                </div>
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
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
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
    <script src="{{ asset('js/create-numeric-question-validation.js') }}"></script>
    <script src="{{ asset('js/create-numeric-question.js') }}"></script>

    <script>
        $(document).ready(function(){
            @if (count($errors) > 0)
            toastr.error('<br>'+'@foreach ($errors->all() as $error){{ $error }}@endforeach', 'You Got Error', {timeOut: 5000});
            @endif

            var i = 0;
            var names = [];
            $('#sub_question').on('click', function(){
                i++;
                names.push('text_options_'+i);
                $('.text_options_list').val(names);
            });
            $(document).on('click', '.remove_sub_question', function(e){
                var id = $(this).attr('id');
                var split_id = id.split(/_/);
                names = jQuery.grep(names, function(value) {
                    return value != 'text_options_'+split_id[1];
                });
                $('.text_options_list').val(names);
            });
        });
    </script>
@stop