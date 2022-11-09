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
        <h5>Board & Candidates</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Update Board & Candidates</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="{{route('boardCandidate.update', [$boardCandidate->id])}}" method="post" class="needs-validation form-horizontal" novalidate>
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Board No</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" name="board_name" value="{{$boardCandidate->board_name}}" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Total Candidate</label>
                                        <div class="col-lg-6">
                                            <input type="number" class="form-control" name="total_candidate" value="{{$boardCandidate->total_candidate}}" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="status">Select Status</label>
                                        <div class="col-lg-6">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="">Select Test</option>
                                                <option value="1" @if($boardCandidate->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($boardCandidate->status == 0) selected @endif>In Active</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update <i class="icon-arrow-right14 position-right"></i></button>
                                        <a href="{{route('boardCandidate.index')}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
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
