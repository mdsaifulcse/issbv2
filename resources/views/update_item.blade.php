@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Item
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
            <li class="active">Update Item</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update Item
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form id="create_item" method="post" action="{{ URL::to('/testSubOptions/'.$item->id) }}" enctype="multipart/form-data"  class="needs-validation" novalidate>

                                {{ csrf_field() }}
                                <input type="hidden" class="text_options_list" name="options_list"/>
                                <input type="hidden" class="removed_sub_question" name="removed_sub_question">
                                <input type="hidden" class="removed_sub_options" name="removed_sub_options">
                                <div class="form-group">
                                    <label for="question_for">Select Item For</label>
                                    <select name="item_for" id="question_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($test_list as $value)
                                            <option value="{{ $value->id }}" @if($item->item_for == $value->id) selected @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" value="{{ $item->name }}" id="question_name" placeholder="Item Name" required/>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_levels as $level)
                                            <option value="{{$level->id}}" @if($item->level == $level->id) selected @endif>{{$level->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_categories as $category)
                                            <option value="{{$category->id}}" @if($item->category == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" value="{{ $item->top_text }}" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" value="{{ $item->down_text }}" id="down_text" placeholder="Down Text"/>
                                </div>

                                <div class="form-group">
                                    <label>Item Type</label><br>
                                    <label for="qt_text_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_text_field" value="1" @if($item->item_type == 1) checked  required @endif/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_img_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_img_field" value="2" @if($item->item_type == 2) checked required @endif/> Image Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_sound_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_sound_field" value="3" @if($item->item_type == 3) checked required @endif/> Sound Field
                                    </label>
                                    <br>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div id="qt_text_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Item</label>
                                        <textarea class="form-control text_questions" name="item_text" id="" placeholder="Item">@if($item->item_type == 1){{ $item->item }}@endif</textarea>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                </div>

                                <div id="qt_img_show" hidden>
                                    <label for="down_text">Item</label>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if($item->item_type == 2)
                                                <img src="{{ asset('assets/uploads/questions/images/'.$item->item) }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                                @else
                                                   <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                                @endif
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                            <div>
                                                <span class="btn btn-primary btn-file btn-sm">
                                                    <span class="fileinput-new">Choose image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" class="form-control img_questions" name="item_img" value="{{ $item->item }}" accept="image/*" id=""/>
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
                                        <input type="file" @if($item->item_type == 3) value="{{ $item->item }}" @endif class="form-control sound_questions" accept="audio/*" name="item_sound"/>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sub_question_enable">
                                        <input type="checkbox" name="sub_question_enable" id="sub_question_enable" value="1" @if($item->sub_question_staus == 1) checked @endif> Sub Question
                                    </label>
                                </div>

                                <div id="sub_item" hidden>
                                    <?php
                                    $sub_question_types = explode('||', $item->sub_question_type);
                                    $sub_question = explode('||', $item->sub_question);
                                    $sub_option_type = explode('||', $item->sub_option_type);
                                    $sub_options = explode('~~', $item->sub_options);
                                    $sub_correct_answer = explode('||', $item->sub_correct_answer);

                                    ?>
                                    @foreach($sub_question_types as $key => $sub_question_type)
                                      <div class="sub_question_blog mb-4">
                                          <span class="btn btn-danger btn-sm sub_qt_old remove_sub_question" id="remove_{{ $key+1 }}" style="float: right;margin-bottom: 2px;">&times;</span>
                                        <div class="form-group">
                                            <label>Sub Question Type</label><br>
                                            <label for="sub_text_type_{{ $key }}">
                                                <input type="radio" name="sub_question_type_{{ $key }}" class="sub_question_type" id="sub_text_type_{{ $key }}" value="1" @if($sub_question_type == 1) checked @endif/> Text Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_img_type_{{ $key }}">
                                                <input type="radio" name="sub_question_type_{{ $key }}" class="sub_question_type" id="sub_img_type_{{ $key }}" value="2" @if($sub_question_type == 2) checked @endif/> Image Field
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            <label for="sub_sound_type_{{ $key }}">
                                                <input type="radio" name="sub_question_type_{{ $key }}" class="sub_question_type" id="sub_sound_type_{{ $key }}" value="3" @if($sub_question_type == 3) checked @endif/> Sound Field
                                            </label><br>
                                            <label id="sub_question_type_0-error" class="error" for="sub_question_type_0" hidden></label>
                                        </div>

                                        <div id="sub_question_text_{{ $key }}" class="form-group" hidden>
                                            <label for="sub_question">Sub Question</label>
                                            <input type="text" class="form-control sub_question sub_question_text_{{ $key }}" @if($sub_question_type == 1) value="{{ $sub_question[$key] }}" @endif name="sub_text_question[]" id="" placeholder="Sub Question" @if($sub_question_type == 1) required @endif/>
                                            <label class="invalid-feedback">This field is required.</label>
                                        </div>

                                        <div id="sub_question_img_{{ $key }}" hidden>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="sub_question">Sub Question</label>
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                @if($sub_question_type == 2)
                                                                    <img src="{{ asset('assets/uploads/sub_questions/images/'.$sub_question[$key]) }}" alt="..." class="img-responsive" style="width: 180px; height: 100px;"/>
                                                                @else
                                                                   <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 180px; height: 100px;"/>
                                                                @endif
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>
                                                            <div>
                                                            <span class="btn btn-primary btn-file btn-sm">
                                                                <span class="fileinput-new">Choose image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" class="form-control img_sub_question_{{ $key }}" name="sub_img_question[]" accept="image/*" id=""/>
                                                                <label class="invalid-feedback">This field is required.</label>
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

                                        <div id="sub_question_sound_{{ $key }}" hidden>
                                            <div class="form-group">
                                                <label for="sub_question">Sub Question</label>
                                                <input type="file" class="form-control sub_sound_question_{{ $key }}" @if($sub_question_type == 3) value="{{ $sub_question[$key] }}" @endif name="sub_sound_question[]" id="" accept="audio/*"/>
                                                <label class="invalid-feedback">This field is required.</label>
                                            </div>
                                        </div>

                                        <div id="otp_text">
                                            <div class="form-group">
                                                <label>Sub Option Type</label><br>
                                                <label for="sub_text_opt_{{ $key }}">
                                                    <input type="radio" name="sub_option_type_{{ $key }}" class="sub_option_type" id="sub_text_otp_{{ $key }}" value="1" @if($sub_option_type[$key] == 1) checked @endif/> Text Field
                                                    &nbsp;&nbsp;&nbsp;
                                                </label>
                                                <label for="sub_img_opt_{{ $key }}">
                                                    <input type="radio" name="sub_option_type_{{ $key }}" class="sub_option_type" id="sub_img_opt_{{ $key }}" value="2" @if($sub_option_type[$key] == 2) checked @endif/> Image Field
                                                    &nbsp;&nbsp;&nbsp;
                                                </label>
                                                <label for="sub_sound_opt_{{ $key }}">
                                                    <input type="radio" name="sub_option_type_{{ $key }}" class="sub_option_type" id="sub_sound_otp_{{ $key }}" value="3" @if($sub_option_type[$key] == 3) checked @endif/> Sound Field
                                                </label><br>
                                                <label id="sub_option_type_0-error" class="error" for="sub_option_type_0" hidden></label>
                                            </div>

                                            <div id="sub_otp_text_show_{{ $key }}" hidden>
                                                @if($sub_option_type[$key] == 1)
                                                    <?php $sub_option = explode('||', $sub_options[$key]);


                                                    ?>

                                                    @foreach($sub_option as $option)
                                                        <div class="form-group extra_field">
                                                            <span class="btn btn-danger btn-sm remove_subText_opt_{{ $key }} remove_sub_opt" id="remove_sub_opt_{{ $key }}" style="float: right;margin-bottom: 2px;">&times;</span>
                                                            <label for="option">Option</label>
                                                            <input type="text" class="form-control sub_text_options_{{ $key }}" value="{{ $option }}" name="sub_text_options_{{ $key }}[]" id="" placeholder="Option" @if($sub_option_type[$key] == 1) required @endif/>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                <div class="form-group">
                                                    <label for="option">Option</label>
                                                    <input type="text" class="form-control sub_text_options_{{ $key }}" name="sub_text_options_{{ $key }}[]" id="" placeholder="Option"/>
                                                </div>
                                                @endif
                                                <span class="sub_more_text_opt_{{ $key }}"></span>
                                                <div class="btn btn-info btn-sm sub_text_opt" id="sub_text_opt_{{ $key }}">add more</div>
                                            </div>

                                            <div id="sub_opt_img_show_{{ $key }}" hidden>
                                                <div class="row">
                                                    @if($sub_option_type[$key] == 2)
                                                      <?php $sub_option = explode('||', $sub_options[$key]); $x = 0; ?>
                                                      @foreach($sub_option as $option)
                                                         <div class="col-md-2 extra_field">
                                                        <label for="down_text">Option</label>
                                                          <span class="btn btn-danger btn-sm remove-img old_img_opt remove_subImg_opt_{{ $key }} remove_sub_opt" id="remove_sub_opt_{{ $key }}" data="{{ $key }}_{{ ++$x }}" style="margin-left: 18px;">&times;</span>
                                                        <div class="form-group">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail">
                                                                    <img src="{{ asset('assets/uploads/sub_options/images/'.$option) }}" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>
                                                                </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>
                                                                {{--<div>
                                                                <span class="btn btn-primary btn-file btn-sm">
                                                                    <span class="fileinput-new">Choose image</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" class="form-control sub_img_options_{{ $key }}" name="sub_img_options_{{ $key }}[]" accept="image/*" id=""/>
                                                                    <div class="invalid-feedback">This field is required.</div>
                                                                </span>
                                                                    <label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>
                                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                                </div>--}}
                                                                <span class="sub_img_options_{{ $key }}"></span>
                                                            </div>
                                                            <label id="sub_img_options_0[]-error" class="error" for="sub_img_options_0[]" hidden></label>
                                                        </div>
                                                    </div>
                                                      @endforeach
                                                    @else
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
                                                                    <input type="file" class="form-control sub_img_options_{{ $key }}" name="sub_img_options_{{ $key }}[]" accept="image/*" id=""/>
                                                                </span>
                                                                        <label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>
                                                                        <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                                    </div>
                                                                </div>
                                                                <label id="sub_img_options_0[]-error" class="error" for="sub_img_options_0[]" hidden></label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <span id="sub_more_img_opt_{{ $key }}"></span>
                                                </div>
                                                <div class="btn btn-info btn-sm sub_img_opt" id="sub_img_opt_{{ $key }}">add more</div>
                                            </div>

                                            <div id="sub_otp_sound_show_{{ $key }}" hidden>
                                                @if($sub_option_type[$key] == 3)
                                                    <?php $sub_option = explode('||', $sub_options[$key]); $x = 0; ?>
                                                    @foreach($sub_option as $option)
                                                    <div class="form-group extra_field">
                                                        <span class="btn btn-danger btn-sm old_sound_opt remove_subSound_opt_{{ $key }} remove_sub_opt" id="remove_sub_opt_{{ $key }}" data="{{ $key }}_{{ ++$x }}" style="float: right;margin-bottom: 2px;">&times;</span>
                                                        <label for="">Option</label><br>
                                                        <audio controls>
                                                            <span class="sub_sound_options_{{ $key }}"></span>
                                                            <source src="{{ asset('assets/uploads/sub_options/sounds/'.$option) }}" type="audio/ogg">
                                                            <source src="{{ asset('assets/uploads/sub_options/sounds/'.$option) }}" type="audio/mpeg">
                                                            Your browser does not support the audio element.
                                                        </audio>

                                                        {{--<input type="file" class="form-control sub_sound_options_{{ $key }}" value="" name="sub_sound_options_{{ $key }}[]" id="" accept="audio/*"/>
                                                        <div class="invalid-feedback">This field is required.</div>--}}
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group">
                                                        <label for="">Option</label>
                                                        <input type="file" class="form-control sub_sound_options_0" name="sub_sound_options_0[]" id="" accept="audio/*"/>
                                                    </div>
                                                @endif
                                                <span id="sub_more_sound_opt_{{ $key }}"></span>
                                                <div class="btn btn-info btn-sm sub_sound_opt" id="sub_sound_opt_{{ $key }}">add more</div>
                                            </div>

                                            <div class="sub_correct_answer">
                                            <select name="sub_right_answer_{{ $key }}[]" id="" class="form-control mt-4 sub_right_answer_{{ $key }}" required>
                                                <option value=""> Choose Sub Correct Answer</option>

                                                @if($sub_option_type[$key] == 1 || $sub_option_type[$key] == 2 || $sub_option_type[$key] == 3)
                                                    <?php $sub_option = explode('||', $sub_options[$key]) ?>
                                                    @foreach($sub_option as $i => $option)
                                                       <option value="{{ ++$i }}" @if($sub_correct_answer[$key] == $i++) selected @endif>Option {{ --$i }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="1">Option 1</option>
                                                @endif
                                            </select>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                      <input type="hidden" class="total_prev_sub_question" value="{{ count($sub_question_types) }}">
                                    <span id="more_sub_question"></span>
                                    <div class="btn btn-primary btn-sm mt-2" id="sub_question">add more sub question</div>
                                </div>

                             <div id="pm_vit">
                                <div class="form-group">
                                    <label>Option Type</label><br>
                                    <label for="opt_text_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_text_field" value="1" required @if($item->option_type == 1) checked @endif/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_img_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_img_field" value="2" required @if($item->option_type == 2) checked @endif/> Image Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_sound_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_sound_field" value="3" required @if($item->option_type == 3) checked @endif/> Sound Field
                                    </label><br>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                 <?php $options = explode('||', $item->options) ?>
                                <div id="otp_text_show" hidden>
                                    @if($item->option_type == 1)
                                        @foreach($options as $option)
                                            <div class="form-group">
                                                <label for="option">Option</label>
                                                <input type="text" class="form-control text_options" name="text_options[]" value="{{ $option }}" id="" placeholder="Option" required/>
                                                <div class="invalid-feedback">This field is required.</div>
                                            </div>
                                        @endforeach
                                    @else
                                    <div class="form-group">
                                        <label for="option">Option</label>
                                        <input type="text" class="form-control text_options" name="text_options[]" id="" placeholder="Option" required/>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    @endif
                                    <span id="more_text_opt"></span>
                                    <div class="btn btn-info btn-sm" id="text_opt">add more</div>
                                </div>

                                <div id="opt_img_show" hidden>
                                    <div class="row">
                                        @if($item->option_type == 2)
                                            @foreach($options as $option)
                                              <div class="col-md-2">
                                            <label for="down_text">Option</label>
                                            <div class="form-group">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="{{ asset('assets/uploads/options/images/'.$option) }}" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>
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
                                            @endforeach
                                        @else
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
                                        @endif
                                        <span id="more_img_option"></span>
                                    </div>
                                    <div class="btn btn-info btn-sm" id="img_option">add more</div>
                                </div>

                                <div id="otp_sound_show" hidden>
                                    @if($item->option_type == 2)
                                        @foreach($options as $option)
                                        <div class="form-group">
                                            <label for="option">Option</label>
                                            <input type="file" class="form-control sound_options" name="sound_options[]" id="" accept="audio/*"/>
                                            <div class="invalid-feedback">This field is required.</div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="form-group">
                                            <label for="option">Option</label>
                                            <input type="file" class="form-control sound_options" name="sound_options[]" id="" accept="audio/*"/>
                                            <div class="invalid-feedback">This field is required.</div>
                                        </div>
                                    @endif
                                    <span id="more_sound_opt"></span>
                                    <div class="btn btn-info btn-sm" id="sound_opt">add more</div>
                                </div>

                                <div class="form-group">
                                    <label for="right_answer">Correct Answer</label>
                                    <select name="right_answer" id="right_answer" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($options as $key => $option)
                                            <option value="{{ ++$key }}" @if($item->correct_answer == $key++) selected @endif>Option {{ --$key }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>
                             </div>

                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1" @if($item->item_status == 1) selected @endif>Active</option>
                                        <option value="2" @if($item->item_status == 2) selected @endif>Inactive</option>
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
    <script src="{{ asset('js/update-item.js') }}"></script>
    {{--<script src="{{ asset('js/update-item-validation.js') }}"></script>--}}


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

    </script>

@stop