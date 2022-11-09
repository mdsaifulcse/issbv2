@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create IQ Question Set
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
            <li class="active">Create IQ Question Set</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create IQ Question Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_iq_qusetion_set">

                                <div class="form-group">
                                    <label for="question_set_for">Select Question Set For</label>
                                    <select name="question_set_for" id="question_set_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="pm_question_set">PM Question Set</option>
                                        <option value="vit_question_set">VIT Question Set</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="bord_number">Select Board</label>
                                    <select name="bord_number" id="bord_number" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="bord_number">Select Candidate Type</label>
                                    <select name="candidate_type" id="candidate_type" class="form-control" required>
                                        <option value="">Choose Candidate Type</option>
                                        <option value="H.S.C">H.S.C</option>
                                        <option value="Graduate">Graduate</option>
                                        <option value="Masters">Masters</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="board_number">Easy</label>
                                    <select name="easy_level" id="easy_level" class="form-control question_type" required>
                                        <option value="">Choose Easy Level</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="board_number">Medium</label>
                                    <select name="medium_level" id="medium_level" class="form-control question_type" required>
                                        <option value="">Choose Medium Level</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="board_number">Hard:</label>
                                    <select name="hard_level" id="hard_level" class="form-control question_type" required>
                                        <option value="">Choose Hard Level</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="total_question">Total Question</label>
                                    <input type="number" name="total_question" id="total_question" value="" class="form-control" disabled placeholder="Total Question"/>
                                </div>

                                <div class="form-group">
                                    <label for="total_time">Total Time</label>
                                    <input type="number" name="total_time" id="total_time" class="form-control" placeholder="Total Time" min="1" required/>
                                </div>
                                
                                <div class="form-group">
                                    <label for="total_time">Pass Mark</label>
                                    <input type="number" name="pass_mark" id="pass_mark" class="form-control" placeholder="Candidate's Pass Mark" min="1" required/>
                                </div>

                                <button class="btn btn-success create_set">Submit</button>
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
    <script src="{{ asset('js/create-iq-question-set-validation.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.question_type').on('change', function(){
                var sum = 0;
                $(".question_type").each(function(){
                    sum += +$(this).val();
                });
                $("#total_question").val(sum);
            });

            $('#question_set_for').on('change', function(){
               var question_set_for = $(this).val();

                if(question_set_for){
                    $.ajax({
                        url: '/getQusetionType/' + question_set_for,
                        method: 'GET',
                        success:function(data){
                            if(data){
                                $("#easy_level").empty();
                                $("#medium_level").empty();
                                $("#hard_level").empty();
                                $("#easy_level").append('<option value="">Choose Easy Level</option>');
                                $("#medium_level").append('<option value="">Choose Medium Level</option>');
                                $("#hard_level").append('<option value="">Choose Hard Level</option>');
                                var easy = data['easy'].length;
                                var medium = data['medium'].length;
                                var hard = data['hard'].length;

                                for (var i=1; i<=easy; i++)
                                {
                                    $("#easy_level").append("<option value="+[i]+">"+[i]+"</option>")
                                }
                                for (var i=1; i<=medium; i++)
                                {
                                    $("#medium_level").append("<option value="+[i]+">"+[i]+"</option>")
                                }
                                for (var i=1; i<=hard; i++)
                                {
                                    $("#hard_level").append("<option value="+[i]+">"+[i]+"</option>")
                                }

                            }else{
                                $("#easy_level").empty();
                                $("#medium_level").empty();
                                $("#hard_level").empty();
                                $("#easy_level").append('<option value="">Choose Easy Level</option>');
                                $("#medium_level").append('<option value="">Choose Easy Level</option>');
                                $("#hard_level").append('<option value="">Choose Hard Level</option>');
                            }
                        }
                    });
                }else{
                    $("#easy_level").empty();
                    $("#medium_level").empty();
                    $("#hard_level").empty();
                    $("#easy_level").append('<option value="">Choose Easy Level</option>');
                    $("#medium_level").append('<option value="">Choose Medium Level</option>');
                    $("#hard_level").append('<option value="">Choose Hard Level</option>');
                }

            });
        });
    </script>
@stop