@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Item
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
        .mb-4 {
            margin-bottom: 6px;
        }
        div#sub_question {
            margin-top: 5px;
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            color: #ef6f6c;
            background: #fff;
            font-size: 15px;
            font-weight: bold;
        }
        .mt-4{
            margin-top: 4px;
        }
        label#-error {
            display: none;
        }
        .tox-notifications-container,.tox-statusbar__branding{
            display: none;
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
            <li class="active">Create Item</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Item
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form id="create_item" method="post" action="{{ URL::to('/storeNewItem') }}" enctype="multipart/form-data"  class="needs-validation" novalidate>

                                {{ csrf_field() }}

                                <input type="hidden" class="text_options_list" name="options_list"/>
                                <div class="form-group">
                                    <label for="question_for">Select Item For</label>
                                    <select name="item_for" id="question_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($test_list as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    {{--<textarea class="tinymce-editor form-control" name="question_name" id="question_name" placeholder="Item Name" required></textarea>--}}

                                    <input type="text" class="form-control" name="question_name" id="question_name" placeholder="Item Name" required/>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Difficulty Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag0')->count();
                                    if($menu>0)
                                        { $t0mnu = DB::table('item_tag_maps')->where('tag', 'tag0')->value('name'); }
                                    else{ $t0mnu ='Tag 0'; }
                                ?>
                                <div class="form-group">
                                    <label for="question_category">{{$t0mnu}}</label>
                                    <select name="question_category" id="question_category" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag1')->count();
                                    if($menu>0)
                                        { $t1mnu = DB::table('item_tag_maps')->where('tag', 'tag1')->value('name'); }
                                    else{ $t1mnu ='Tag 1'; }
                                ?>
                                @if(count($item_tag1)>0)
                                <div class="form-group">
                                    <label for="question_tag1">{{$t1mnu}}</label>
                                    <select name="question_tag1" id="question_tag1" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag1 as $tag1)
                                            <option value="{{$tag1->id}}">{{$tag1->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag2')->count();
                                    if($menu>0)
                                        { $t2mnu = DB::table('item_tag_maps')->where('tag', 'tag2')->value('name'); }
                                    else{ $t2mnu ='Tag 2'; }
                                ?>
                                @if(count($item_tag2)>0)
                                <div class="form-group">
                                    <label for="question_tag2">{{$t2mnu}}</label>
                                    <select name="question_tag2" id="question_tag2" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag2 as $tag2)
                                            <option value="{{$tag2->id}}">{{$tag2->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag3')->count();
                                    if($menu>0)
                                        { $t3mnu = DB::table('item_tag_maps')->where('tag', 'tag3')->value('name'); }
                                    else{ $t3mnu ='Tag 3'; }
                                ?>
                                @if(count($item_tag3)>0)
                                <div class="form-group">
                                    <label for="question_tag3">{{$t3mnu}}</label>
                                    <select name="question_tag3" id="question_tag3" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag3 as $tag3)
                                            <option value="{{$tag3->id}}">{{$tag3->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag4')->count();
                                    if($menu>0)
                                        { $t4mnu = DB::table('item_tag_maps')->where('tag', 'tag4')->value('name'); }
                                    else{ $t4mnu ='Tag 4'; }
                                ?>
                                @if(count($item_tag4)>0)
                                <div class="form-group">
                                    <label for="question_tag4">{{$t4mnu}}</label>
                                    <select name="question_tag4" id="question_tag4" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag4 as $tag4)
                                            <option value="{{$tag4->id}}">{{$tag4->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag5')->count();
                                    if($menu>0)
                                        { $t5mnu = DB::table('item_tag_maps')->where('tag', 'tag5')->value('name'); }
                                    else{ $t5mnu ='Tag 5'; }
                                ?>
                                @if(count($item_tag5)>0)
                                <div class="form-group">
                                    <label for="question_tag5">{{$t5mnu}}</label>
                                    <select name="question_tag5" id="question_tag5" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag5 as $tag5)
                                            <option value="{{$tag5->id}}">{{$tag5->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag6')->count();
                                    if($menu>0)
                                        { $t6mnu = DB::table('item_tag_maps')->where('tag', 'tag6')->value('name'); }
                                    else{ $t6mnu ='Tag 6'; }
                                ?>
                                @if(count($item_tag6)>0)
                                <div class="form-group">
                                    <label for="question_tag6">{{$t6mnu}}</label>
                                    <select name="question_tag6" id="question_tag6" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag6 as $tag6)
                                            <option value="{{$tag6->id}}">{{$tag6->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <?php
                                    $menu = DB::table('item_tag_maps')->where('tag', 'tag7')->count();
                                    if($menu>0)
                                        { $t7mnu = DB::table('item_tag_maps')->where('tag', 'tag7')->value('name'); }
                                    else{ $t7mnu ='Tag 7'; }
                                ?>
                                @if(count($item_tag7)>0)
                                <div class="form-group">
                                    <label for="question_tag7">{{$t7mnu}}</label>
                                    <select name="question_tag7" id="question_tag7" class="form-control" >
                                        <option value="">Choose one</option>
                                        @foreach($item_tag7 as $tag7)
                                            <option value="{{$tag7->id}}">{{$tag7->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" placeholder="Down Text"/>
                                </div>

                                <div class="form-group">
                                    <label>Item Type</label><br>
                                    <label for="qt_text_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_text_field" value="1" required/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_img_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_img_field" value="2" required/> Image Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_sound_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_sound_field" value="3" required/> Sound Field
                                    </label>
                                    <br>
                                    <label id="question_type_error" class="error" for="question_type" hidden>This field is required.</label>
                                </div>


                                <div id="qt_text_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Item</label>
                                        <textarea class="form-control text_questions tinymce-editor" name="item_text" id="" placeholder="Item"></textarea>
                                        <div class="invalid-feedback">This field is required.</div>
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
                                                    <input type="file" class="form-control img_questions" name="item_img" accept="image/*" id=""/>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </span>
                                                <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                            </div><label id="item_img-error" class="error" for="item_img" hidden></label>
                                        </div>
                                    </div>
                                </div>

                                <div id="qt_sound_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Item</label>
                                        <input type="file" class="form-control sound_questions" accept="audio/*" name="item_sound"/>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sub_question_enable">
                                        <input type="checkbox" name="sub_question_enable" id="sub_question_enable" value="1"> Sub Question
                                    </label>
                                </div>

                                <div id="sub_item" hidden>
                                    <div class="sub_question_blog mb-4">
                                        <div class="form-group">
                                            <label>Sub Item Type</label><br>
                                            <label for="sub_question_text_field">
                                                <input type="radio" name="sub_question_type" class="sub_question_type" id="sub_question_text_field" value="1"/> Text Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_question_img_field">
                                                <input type="radio" name="sub_question_type" class="sub_question_type" id="sub_question_img_field" value="2"/> Image Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_question_sound_field">
                                                <input type="radio" name="sub_question_type" class="sub_question_type" id="sub_question_sound_field" value="3"/> Sound Field
                                            </label><br>
                                            <label id="sub_question_type_error" class="error" for="sub_question_type" hidden>This field is required.</label>
                                        </div>

                                        <div class="form-group">
                                            <label>Sub Answer Type</label><br>
                                            <label for="sub_opt_text_field">
                                                <input type="radio" name="sub_option_type" class="sub_option_type" id="sub_opt_text_field" value="1"/> Text Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_opt_img_field">
                                                <input type="radio" name="sub_option_type" class="sub_option_type" id="sub_opt_img_field" value="2"/> Image Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_opt_sound_field">
                                                <input type="radio" name="sub_option_type" class="sub_option_type" id="sub_opt_sound_field" value="3"/> Sound Field
                                            </label><br>
                                            <label id="sub_option_type_error" class="error" for="sub_option_type_0" hidden>This field is required.</label>
                                        </div>

                                        <div id="sub_question_text" class="form-group" hidden>
                                            <label for="sub_question">Sub Item</label>
                                            <textarea class="form-control sub_question_text tinymce-editor" name="sub_text_question[]" placeholder="Sub Question"></textarea>

                                            <!-- <input type="text" class="form-control sub_question_text" name="sub_text_question[]" id="" placeholder="Sub Question"/> -->
                                            <div class="invalid-feedback">This field is required.</div>
                                        </div>

                                        <div id="sub_question_img" hidden>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="sub_question">Sub Item</label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 180px; height: 100px;"/>
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>
                                                            <div>
                                                            <span class="btn btn-primary btn-file btn-sm">
                                                                <span class="fileinput-new">Choose image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" class="form-control img_sub_question" name="sub_img_question[]" accept="image/*" id=""/>
                                                                <div class="invalid-feedback">This field is required.</div>
                                                            </span>
                                                                <label id="sub_img_question[]-error" class="error" for="sub_img_question[]" hidden></label>
                                                                <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="sub_more_img_opt"></span>
                                            </div>
                                        </div>

                                        <div id="sub_question_sound" hidden>
                                            <div class="form-group">
                                                <label for="sub_question">Sub Item</label>
                                                <input type="file" class="form-control sub_sound_questions" name="sub_sound_question[]" id="" accept="audio/*"/>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                        </div>

                                        <div id="otp_text">
                                            <div id="sub_otp_text_show" hidden>
                                                <div class="form-group">
                                                    <label for="option">Option-1</label>
                                                    <input type="text" class="form-control sub_text_options_0" name="sub_text_options_0[]" id="" placeholder="Option"/>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                                <span class="sub_more_text_opt_0"></span>
                                                <div class="btn btn-info btn-sm sub_text_opt" id="sub_text_opt_0">add more</div>
                                            </div>

                                            <div id="sub_opt_img_show" hidden>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="down_text">Option-1</label>
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
                                                                    <input type="file" class="form-control sub_img_options_0" name="sub_img_options_0[]" accept="image/*" id=""/>
                                                                    <div class="invalid-feedback">This field is required.</div>
                                                                </span>
                                                                    <label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>
                                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                                </div>
                                                            </div>
                                                            <label id="sub_img_options_0[]-error" class="error" for="sub_img_options_0[]" hidden></label>
                                                        </div>
                                                    </div>
                                                    <span id="sub_more_img_opt_0"></span>
                                                </div>
                                                <div class="btn btn-info btn-sm sub_img_opt" id="sub_img_opt_0">add more</div>
                                            </div>

                                            <div id="sub_otp_sound_show" hidden>
                                                <div class="form-group">
                                                    <label for="">Option-1</label>
                                                    <input type="file" class="form-control sub_sound_options_0" name="sub_sound_options_0[]" id="" accept="audio/*"/>
                                                    <div class="invalid-feedback">This field is required.</div>
                                                </div>
                                                <span id="sub_more_sound_opt_0"></span>
                                                <div class="btn btn-info btn-sm sub_sound_opt" id="sub_sound_opt_0">add more</div>
                                            </div>
                                            <div class="sub_correct_answer" style="display: none;">
                                            <select name="sub_right_answer[]"  id="sub_right_answer_0"  class="form-control mt-4 sub_right_answer_0">
                                                <option value=""> Choose Sub Correct Answer</option>
                                                <option value="1">Option-1</option>
                                            </select>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="more_sub_question"></span><br>
                                    <div class="btn btn-primary btn-sm mt-2" id="sub_question">add more sub question</div>
                                </div>

                             <div id="pm_vit">
                                <div class="form-group">
                                    <label>Answer Type</label><br>
                                    <label for="opt_text_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_text_field" value="1" required/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_img_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_img_field" value="2" required/> Image Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_sound_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_sound_field" value="3" required/> Sound Field
                                    </label><br>
                                    <label id="option_type_error" class="error" for="option_type" hidden>This field is required.</label>
                                </div>

                                <div id="otp_text_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Option-1</label>
                                        <input type="text" class="form-control text_options" name="text_options[]" id="" placeholder="Option" required/>
                                    </div>
                                    <span id="more_text_opt"></span>
                                    <div class="btn btn-info btn-sm" id="text_opt">add more</div>
                                </div>

                                <div id="opt_img_show" hidden>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="down_text">Option-1</label>
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
                                        <span id="more_img_option"></span>
                                    </div>
                                    <div class="btn btn-info btn-sm" id="img_option">add more</div>
                                </div>

                                <div id="otp_sound_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Option-1</label>
                                        <input type="file" class="form-control sound_options" name="sound_options[]" id="" accept="audio/*"/>
                                    </div>
                                    <span id="more_sound_opt"></span>
                                    <div class="btn btn-info btn-sm" id="sound_opt">add more</div>
                                </div>

                                <div class="form-group">
                                    <label for="right_answer">Correct Answer</label>
                                    <select name="right_answer" id="right_answer" class="form-control" required>
                                        <option value="">Choose one</option>
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                             </div>

                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control item_status" required>
                                        <option value="">Choose one</option>
                                        @foreach ($item_statuses as $item_status)
                                        <option value="{{ $item_status->id }}">{{ $item_status->item_status }}</option>
                                        @endforeach
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
    <script src="{{ asset('js/create-new-item.js') }}"></script>
    <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
    {{--<script src="{{ asset('js/create-item-validation.js') }}"></script>--}}
    

    <script>
        
            tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 150,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            //content_css: '//www.tiny.cloud/css/codepen.min.css'
        });

    </script>

    <script>
        (function() {
            'use strict';

            window.addEventListener('load', function() {

                var forms = document.getElementsByClassName('needs-validation');

                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(document).ready(function(){
            $('.item_status').on('change', function(){
                var item_status = $(".item_status option:selected").val();
                if(item_status==4) {
                    $('.sub_question_type').removeAttr('required');
                    $('.sub_option_type').removeAttr('required');
                    $('.sub_question_text').removeAttr('required');
                    $('.sub_text_options_0').removeAttr('required');
                    $('.sub_right_answer_0').removeAttr('required');
                    $('.sub_sound_questions').removeAttr('required');
                    $('.option_type').removeAttr('required');
                    $('#right_answer').removeAttr('required');
                    $('.text_options').removeAttr('required');
                } else {
                    $('.sub_question_type').addAttr('required');
                    $('.sub_option_type').addAttr('required');
                    $('.sub_question_text').addAttr('required');
                    $('.sub_text_options_0').addAttr('required');
                    $('.sub_right_answer_0').addAttr('required');
                    $('.sub_sound_questions').addAttr('required');
                    $('.option_type').addAttr('required');
                    $('#right_answer').addAttr('required');
                    $('.text_options').addAttr('required');
                }
            });
        });
    </script>

@stop
