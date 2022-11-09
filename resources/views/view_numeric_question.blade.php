
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

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="form">
                                <div id="qt_img_show">
                                    <label for="down_text">Question</label>
                                    @if($numeric_question->question_type == 2)
                                        <img src="{{ asset('assets/uploads/questions/'.$numeric_question->question) }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                    @else
                                        <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                    @endif
                                </div>

                                <?php $sub_questions = explode('||', $numeric_question->sub_questions);
                                      $sub_options = explode('~~', $numeric_question->sub_options);
                                      $sub_right_answers = explode('||', $numeric_question->sub_right_answers);
                                ?>
                                @foreach($sub_options as $key => $sub_option)
                                <div class="sub_question_blog sub_ques">
                                    <div class="form-group">
                                        <label for="sub_question" style="margin: 5px 2px;">Sub Question :</label> {{ $sub_questions[$key++] }}
                                    </div>
                                    <div id="otp_text_show">
                                        <?php $options = explode('||', $sub_option); ?>
                                        @foreach($options as $option)
                                        <div class="form-group extra_field">
                                            <label for="option">Option :</label> {{ $option }}
                                        </div>
                                        @endforeach
                                        <span class="more_text_opt"></span>

                                        <select name="sub_right_answer[]" id="sub_right_answer_{{ $key }}" class="form-control sub_right_answer" disabled>
                                            <option value=""> Choose Sub Right Answer </option>
                                            <?php $options = explode('||', $sub_options[--$key]);
                                                  $sub_right_answers= explode('||', $numeric_question->sub_right_answers);
                                                $option = count($options);

                                            for($i=1; $i<=$option; $i++)
                                            {?>
                                                <option value="{{ $i }}"  @if($sub_right_answers[$key] == $i) selected @endif>Right Option {{ $i }}</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
    </section>

