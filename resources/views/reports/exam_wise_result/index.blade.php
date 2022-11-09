@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Exam Wise Result
    @parent
@stop


{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Exam Wise Result</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Result
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>
                                <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                                    <div class="form-group">
                                        <label for="exam_id">Select Exam</label>
                                        <select name="exam_id" id="" class="form-control select2 exam_id" required>
                                            <option value="">Choose one</option>
                                            @foreach ($exams as $exam)
                                            <option value="{{ $exam->id}}">{{ $exam->exam_name.' ['.$exam->exam_date.']' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
                                    <button class="btn btn-success create">Result</button>
                                </div>
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
    <script>
        $(document).ready(function(){
            //FORM SUBMIT
            $('#create_data').submit(function(e){
                e.preventDefault();
                var exam_id = $('.exam_id').find(':selected').val();
                var url = "{{route('examWiseResultExport')}}"+'?exam_id='+exam_id;
                var myWindow = window.open(url, "");
            });
        });
    </script>
@stop
