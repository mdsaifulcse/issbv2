@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Memory Item
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('css/form-check.css') }}" rel="stylesheet">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jasny-bootstrap.css')}}">
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <style>
        .preview_question {
            background: url(/assets/images/background.png);
            max-width: 466px;
            height: 100%;
            margin: 35px 5px;
            padding: 0px;
            display: none;
        }
        img.icons {
            width: 25px;
            padding: 2px;
            border: 2px solid #00000000;
            margin: 20px;
        }
        .checked {
            border: 2px solid #030303 !important;
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
                <a href="{{ URL::to('/') }}">Admin</a>
            </li>
            <li class="active">Create Memory Item</li>
        </ol>
    </section>

    <section class="content" onbeforeunload="return myFunction()">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Memory Item
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_memory_item" method="post" enctype="multipart/form-data"  class="needs-validation" novalidate>
                                {{ csrf_field() }}

                                <input type="hidden" class="total_question" name="total_question"/>
                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" id="question_name" placeholder="Item Name" required/>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" placeholder="Down Text"/>
                                </div>

                                <label for="down_text">Bacground Image</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('assets/images/background.png') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file btn-sm">
                                                <span class="fileinput-new">Choose image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="form-control img_questions" name="item_img" accept="image/*" id=""/>
                                            </span>
                                            <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                        </div><label id="item_img-error" class="error" for="item_img" hidden></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Sub Question Images</label>
                                    <input type="file" class="form-control" name="sub_question_images_0[]" id="sub_question_images_0" multiple required/>
                                </div>

                                <div class="form-group">
                                    <span class="btn btn-info btn-sm preview" id="preview_0">Preview</span>
                                </div>

                                <input type="hidden" id="sub_question_data_0" name="sub_question_data_0">
                                <input type="hidden" id="sub_correct_answer_0" class="empty" name="sub_correct_answer_0">
                                <div class="preview_question" id="preview_question_0"></div>

                                <span class="more_sub_question_blog"></span>

                                <div class="form-group">
                                    <span class="btn btn-primary btn-sm more_sub_question">Add more sub question</span>
                                </div>

                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
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
    <script src="{{asset('js/create_memory_item_validation.js')}}"></script>
    <script src="{{asset('js/create_memory_item.js')}}"></script>
@stop