@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Test Instruction
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jasny-bootstrap.css')}}">

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
        <h5>Test Instruction</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Test Instruction</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Test Instruction
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="{{route('configInstruction.store',['configId'=>$configId])}}" method="post" enctype="multipart/form-data" class="needs-validation form-horizontal" novalidate>
                                @csrf
                                <div class="row">
                                        <div class="form-group">
                                            <label class="control-label col-lg-3">Text</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" name="text" id="" cols="10" rows="1"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-lg-3">File Input</label>
                                            <div class="col-lg-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail">
                                                        <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                                    <div>
                                                        <span class="btn btn-primary btn-file btn-sm">
                                                            <span class="fileinput-new">Choose image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" class="form-control img_questions" name="image" accept="image/*" id=""/>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </span>
                                                        <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                                    </div><label id="image-error" class="error" for="image" hidden></label>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Create <i class="icon-arrow-right14 position-right"></i></button>
                                    <a href="{{route('configInstruction.index', ['configId'=>$configId])}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
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
<script src="{{asset('assets/js/jasny-bootstrap.js')}}"></script>
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
