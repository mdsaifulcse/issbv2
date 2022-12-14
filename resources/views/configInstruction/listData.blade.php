@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Test Instruction
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/image_viewer_css/lc_lightbox.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/image_viewer_css/skins/minimal.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jasny-bootstrap.css')}}">

    <style>
        .pagination {
            float: right;
        }

        .elem, .elem * {
            box-sizing: border-box;
            margin: 0 !important;
        }
        .elem {
            display: inline-block;
            font-size: 0;
            width: 40%;
        }
        .elem > span {
            display: block;
            cursor: pointer;
            height: 0;
            padding-bottom:	70%;
            background-size: cover;
            background-position: center center;
        }

        /*  ------   */
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
        <h1>Test Instruction Slider</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Instruction Slider</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

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
                                <form action="{{route('configInstruction.store',['configId'=>$configId])}}" method="post" enctype="multipart/form-data" class="needs-validation form-horizontal">
                                    @csrf
                                    <div class="row">

                                        <div class="col-lg-5">
                                            <div class="">
                                                <textarea class="form-control" name="text" id="" cols="10" rows="6" placeholder="Type Instruction here"></textarea>
                                            </div>
                                            <label class="control-label">Text</label>
                                        </div>

                                        <div class="col-lg-4">
                                                {{--<label class="control-label">File Input</label>--}}
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="{{ asset('assets/img/authors/no_avatar.jpg') }}" alt="..." class="img-responsive" style="width: 300px; height: 130px;"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 130px;"></div>

                                                    <span class="btn btn-primary btn-file btn-sm">
                                                        <span class="fileinput-new">Choose image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" class="form-control img_questions" name="image" accept="image/*" id=""/>
                                                        <div class="invalid-feedback">This field is required.</div>
                                                    </span>
                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>

                                                <label id="image-error" class="error" for="image" hidden></label>
                                            </div>

                                        </div>
                                        <div class="col-lg-3">
                                            <div class="text-left">
                                                <label class="control-label"></label>
                                                <br>
                                                <br>
                                                <div>
                                                    <button type="submit" class="btn btn-success">Submit  <i class="icon-arrow-right14 position-right"></i></button>
                                                </div>
                                                {{--<a href="{{route('configInstruction.index', ['configId'=>$configId])}}" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end row -->


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test Instructions Slider list
                        </h3>
                        <div class="pull-right">
                            {{--<button class="btn btn-sm btn-default" onclick="history.go(-1)">Back To List</button>--}}
                            {{--<a href="{{ route('configInstruction.create', ['configId'=>$configId]) }}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Slide</a>--}}

                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Text</th>
                                <th>Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($configInstructions as $key => $instruction)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $instruction->text }}</td>
                                <td>
                                    {{-- <img height="44px" width="44px" src="{{ asset('uploads/instruction/'.$instruction->image) }}" alt=""> --}}
                                    <a class="elem" href="{{ asset('uploads/instruction/'.$instruction->image) }}" title="image {{ $key++ }}" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="{{ asset('uploads/instruction/'.$instruction->image) }}">
                                        <span style="background-image: url({{ asset('uploads/instruction/'.$instruction->image) }});"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    {{-- <a href="{{ route('configInstruction.edit', [$instruction->id]) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a> --}}
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete('<?php echo $instruction->id ?>'); ></i></a>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            @if (!empty($configInstructions))
                            {{ $configInstructions->links() }}
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- content -->
    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')

    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

    <script language="javascript" type="text/javascript" src="{{ asset('js/image_viewer_js/lc_lightbox.lite.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/image_viewer_js/lib/AlloyFinger/alloy_finger.min.js') }}"></script>
    <script src="{{asset('assets/js/jasny-bootstrap.js')}}"></script>

    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Assessment has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }

            $('#example').DataTable( {
                "searching": false,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );

            // live handler
            lc_lightbox('.elem', {
                wrap_class: 'lcl_fade_oc',
                gallery : true,
                thumb_attr: 'data-lcl-thumb',

                skin: 'minimal',
                radius: 0,
                padding	: 0,
                border_w: 0,
            });
         } );

        function Delete(id)
        {

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {
                $.ajax({
                    url: '/configInstruction/' + id,
                    method: 'DELETE',
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        setTimeout(function () {
                            swal({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
                    }
                })
            });
        }
    </script>
@stop
