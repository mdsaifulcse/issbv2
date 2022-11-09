@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update IQ Item
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
            font-size: 80%;
            color: #dc3545;
            background: #fff;
            font-size: 12px;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Update IQ Item</h1>
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
            @if($db=='pm')
            <li>
                <a href="{{ URL::to('/pm-question-bank/'.$status) }}">PM @if($status==1) Active  @else Inactive @endif Item List</a>
                
            </li>
            @else
             <li>
                <a href="{{ URL::to('vit-question-bank/'.$status) }}">VIT @if($status==1) Active  @else Inactive @endif Item List</a>
                
            </li>
            @endif
            <li>
               Update IQ Item
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update IQ Item
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="update_qusetion" enctype="multipart/form-data"  class="needs-validation" novalidate>

                                <input type="hidden" id="id" value="{{ $question->id }}">
                                <input type="hidden" id="db" name="db" value="{{ $db }}">
                                <input type="hidden" name="preveous_option_type" value="{{ $question->option_type }}">
                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" id="question_name" value="{{ $question->name }}" placeholder="Item Name" required/>
                                    <label class="invalid-feedback">This field is required.</label>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_levels as $level)
                                            <option value="{{ $level->id }}" @if($question->level == $level->id) selected @endif>{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="invalid-feedback">This field is required.</label>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($item_categories as $category)
                                            <option value="{{ $category->id }}" @if($question->category == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <label class="invalid-feedback">This field is required.</label>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" value="{{ $question->top_text }}" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" value="{{ $question->down_text }}" placeholder="Down Text" required/>
                                </div>

                                <div class="form-group">
                                    <label>Item Type</label><br>
                                    <label for="qt_text_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_text_field" value="1" @if($question->question_type == 1) checked @endif /> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="qt_img_field">
                                        <input type="radio" name="question_type" class="question_type" id="qt_img_field" value="2" @if($question->question_type == 2) checked @endif/> Image Field
                                        <label class="invalid-feedback">This field is required.</label>
                                    </label>

                                </div>

                                <div id="qt_text_show" hidden>
                                    <div class="form-group">
                                        <label for="option">Item</label>
                                        <input type="text" class="form-control text_questions" @if($question->question_type == 1) value="{{ $question->question }}" @endif name="text_questions" id="" placeholder="Item"/>
                                        <label class="invalid-feedback">This field is required.</label>
                                    </div>
                                </div>

                                <div id="qt_img_show" hidden>
                                    <label for="down_text">Item</label>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                @if($question->question_type == 2)
                                                    <img src="{{ asset('assets/uploads/questions/'.$question->question) }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
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

                                <div class="form-group">
                                    <label>Option Type</label><br>
                                    <label for="opt_text_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_text_field" value="1" @if($question->option_type == 1) checked @endif required/> Text Field
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="opt_img_field">
                                        <input type="radio" name="option_type" class="option_type" id="opt_img_field" value="2" @if($question->option_type == 2) checked @endif required/> Image Field
                                        <label class="invalid-feedback">This field is required.</label>
                                    </label>
                                </div>
                                <label id="option_type-error" class="error" for="option_type" hidden></label>

                                <div id="otp_text_show" hidden>
                                    @if($question->option_type == 1)
                                       @foreach(explode('||', $question->options) as $options)
                                        <div class="form-group extra_field">
                                            <label for="option">Option</label>
                                            <span class="btn btn-danger btn-sm remove" style="float: right;margin-bottom: 2px;">&times;</span>
                                            <input type="text" class="form-control text_options" value="{{ $options }}" name="text_options[]" id="" placeholder="Option" required/>
                                            <label class="invalid-feedback">This field is required.</label>
                                        </div>
                                       @endforeach
                                    @else
                                        <div class="form-group">
                                            <label for="option">Option</label>
                                            <input type="text" class="form-control text_options" name="text_options[]" id="" placeholder="Option" required/>
                                            <label class="invalid-feedback">This field is required.</label>
                                        </div>
                                    @endif
                                    <span id="more_text_opt"></span>
                                    <div class="btn btn-info btn-sm" id="text_opt">add more</div>
                                </div>

                                <div id="opt_img_show" hidden>
                                    <div class="row">
                                        @if($question->option_type == 2)
                                            <input type="hidden" id="previous_options" name="previous_options" value="{{  $question->options }}">

                                            @foreach(explode('||', $question->options) as $options)
                                                <div class="col-md-2 option_status">
                                                    <label for="down_text">Option</label>
                                                    <span class="btn btn-danger btn-sm remove-img" style="margin-left: 18px;">&times;</span>
                                                    <input type="hidden" value="{{ $options }}">
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail">
                                                                @if(strlen($options) > 0)
                                                                <img src="{{ asset('assets/uploads/options/'.$options) }}" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>
                                                                @else
                                                                    <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 80px; height: 80px;"/>
                                                                @endif
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="width: 80px; height: 80px;"></div>
                                                            <div class="img_options"></div>
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
                                            </span>
                                                        <label id="img_options[]-error" class="error" for="img_options[]" style="display: none !important;"></label>
                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <span id="more_img_opt"></span>
                                    </div>
                                    <div class="btn btn-info btn-sm" id="img_opt">add more</div>
                                </div>
                                <div class="form-group">
                                    <label for="right_answer">Correct Answer</label>
                                    <select name="right_answer" id="right_answer" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <?php $options = count(explode('||', $question->options));
                                        for($i=1; $i<=$options; $i++)
                                        {
                                            echo '<option value="'.$i.'"'.(($question->correct_answer == $i)?'selected="selected"':"").'>Option '.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                    <label class="invalid-feedback">This field is required.</label>
                                </div>
                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1" @if($question->publish_status == 1) selected @endif>Active</option>
                                        <option value="2" @if($question->publish_status == 2) selected @endif>Inactive</option>
                                    </select>
                                    <label class="invalid-feedback">This field is required.</label>
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
    <script src="{{ asset('js/update-question.js') }}"></script>


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
            var img_options = $('.img_options').length;

            if(img_options > 1){
                $('.remove-img').show();
            }else{
                $('.remove-img').hide();
            }

            var text_options = $('.text_options').length;

            if(text_options >= 3){
                $('.remove').show();
            }else{
                $('.remove').hide();
            }

            var question_type  = $('.question_type:checked').val();
            var option_type  = $('.option_type:checked').val();
            if(question_type == 1){
                $('#qt_text_show').show();
            }else{
                $('#qt_img_show').show();
            }
            if(option_type == 1){
                $('#otp_text_show').show();
            }else{
                $('#opt_img_show').show();
            }

            $('#update_qusetion').on('submit', function(event){
                $('.update').prop('disabled', true);
                $('.update').text('Sending...');

                var id = $('#id').val();
                var publish_test=$('#publish_test :selected').val();
                console.log(publish_test);
                event.preventDefault();
                $.ajax({
                    url:"/edit-question/" + id,
                    method:"POST",
                    data:new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(data)
                    {
                        if (data == 'pm_success' && publish_test)
                        {
                            sessionStorage.setItem("update_success", "success");
                            window.location.href = "/pm-question-bank/"+publish_test;
                        }
                        else if(data == 'vit_success')
                        {
                            sessionStorage.setItem("update_success", "success");
                            window.location.href = "/vit-question-bank/"+publish_test;
                        }
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});
                        $('.update').prop('disabled', false);
                        $('.update').text('Submit');
                    }
                })
            });

            $('.remove-img').on('click', function () {

                var db = $('#db').val();
                var id = $('#id').val();
                var prev_val = $('#previous_options').val();
                var file_name = $(this).next('input').val();

                $.ajax({
                    url:"/singleOptionRemove",
                    method:"POST",
                    data:{'id': id,'db': db,'prev_val':prev_val,'file_name':file_name},
                    success:function(data)
                    {
                        $(this).parent('.option_status').remove();
                    }
                });
                $(this).parent('.option_status').remove();


                var numimg_options = $('.img_options').length;

                if(numimg_options > 1){
                    $('.remove-img').show();
                }else{
                    $('.remove-img').hide();
                }
            });
        });
    </script>

@stop