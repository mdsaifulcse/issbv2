@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Course Schedule
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('css/form-check.css') }}" rel="stylesheet">
    
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
        <h5>Course Schedule</h5>
        <ol class="breadcrumb">
            <li>
                <a href="{{ URL::to('/') }}">Admin</a>
            </li>
            <li class="active">Create Course Schedule</li>
        </ol>
    </section>

    <section class="content" onbeforeunload="return myFunction()">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Course Schedule
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form enctype="multipart/form-data" action="{{ url('course-schedule-store') }}" method="POST" novalidate>
                                {{ csrf_field() }}
                                
                                <div class="form-group">
                                    <label for="question_name">Title</label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title"/>
                                </div>

                                <label for="down_text">File</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="{{ asset('assets/images/background.png') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file btn-sm">
                                                <span class="fileinput-new">Choose file</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="form-control img_questions" name="item_img" accept="image/*" id=""/>
                                            </span>
                                            <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                        </div><label id="item_img-error" class="error" for="item_img" hidden></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="question_name">Details</label>
                                    <input type="text" class="form-control" name="picture_details" id="picture_details" placeholder="Details"/>
                                </div>

                                <div class="form-group">
                                    <label for="question_name">Order</label>
                                    <input type="number" class="form-control" name="order" id="order" placeholder="Order"/>
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
@stop