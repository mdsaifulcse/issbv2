@extends('admin/layouts/default')
<?php
    $menu = DB::table('item_tag_maps')->where('tag', 'tag7')->count();
    if($menu>0)
        { $mnu = DB::table('item_tag_maps')->where('tag', 'tag7')->value('name'); }
    else{ $mnu ='Tag 7'; }
?>
{{-- Page title --}}
@section('title')
    Create {{$mnu}}
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('assets/css/toastr.css') }}" rel="stylesheet">
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create New {{$mnu}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create {{$mnu}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>

                                <div class="form-group">
                                    <label for="name">{{$mnu}} Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Tag Name" required/>
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
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{asset('js/jequery-validation.js')}}"></script>
    <script>
        $("#create_data").validate(
                {
                    ignore: [],
                    debug: false,
                    rules: {
                        name: {
                            required: true
                        }
                    },
                    messages: {
                        name: "This field is required",
                    },

                    submitHandler: function(form) {
                        $('.create').text('Sending');
                        $('.create').prop('disabled', true);
                        var formData = new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: 'storeItemTag7',
                            data:formData,
                            processData: false,
                            contentType: false,
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            async: true,
                            success: function(response) {
                                if (response == 'success')
                                {
                                    sessionStorage.setItem("new_success", "success");
                                    window.location.href = '/item-tag7';
                                }
                            },
                            error: function (e) {
                                toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                                $('.create').text('Submit');
                                $('.create').prop('disabled', false);
                            }
                        });

                        return false;

                    }


                });
    </script>
@stop
