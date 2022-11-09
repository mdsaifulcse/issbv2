@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Test
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5>Assessment Configuration</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Assessment Configuration</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Assessment Configuration
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="{{route('examConfig.update', [$examConfig->id])}}" method="post" class="needs-validation form-horizontal" novalidate>
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Test</label>
                                        <div class="col-lg-6">
                                            <select name="test_config_id" id="test_config_id" class="form-control" required>
                                                <option value="">Select Test</option>
                                                @foreach ($testConfigs as $test)
                                                <option value="{{$test->id}}" @if($test->id == $examConfig->test_config_id) selected @endif>{{$test->test_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Assessment Date</label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" name="exam_date" value="{{$examConfig->exam_date}}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Status</label>
                                        <div class="col-lg-6">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value=0 @if($examConfig->status==0) selected @endif>In-Active</option>
                                                <option value=1 @if($examConfig->status==1) selected @endif>Active</option>
                                                <option value=2 @if($examConfig->status==2) selected @endif>Force Stop</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update Question<i class="icon-arrow-right14 position-right"></i></button>
                                        <a href="{{route('examConfig.index')}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                                    </div>
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
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{asset('js/jequery-validation.js')}}"></script>

    <script>
        $(document).ready(function(){
            @if (session('msgType') == 'success')
                toastr.success('{{ session("messege") }}', 'Success', {timeOut: 5000});
            @endif

            @if (session('msgType') == 'danger')
                toastr.warning('{{ session("messege") }}', 'Warning', {timeOut: 5000});
            @endif
        });
    </script>

@stop
