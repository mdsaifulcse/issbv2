@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Test
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
            <li class="active">Update Test</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update Test
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>

                                <input type="hidden" id="id" value="{{ $test->id }}">
                                <div class="form-group">
                                    <label for="category_name">Test Name</label>
                                    <input type="text" class="form-control" name="test_name" value="{{ $test->name }}" id="teset_name" placeholder="Test Name" required/>
                                </div>
                                <div class="form-group">
                                    <label for="category_name">Status</label>
                                    <select name="status" id="" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1" @if($test->status == 1) selected @endif>Active</option>
                                        <option value="2" @if($test->status == 2) selected @endif>Inactive</option>
                                    </select>
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
                        test_name: {
                            required: true
                        },
                        status: {
                            required: true
                        }
                    },
                    messages: {
                        test_name: "This field is required",
                        status: "This field is required",
                    },

                    submitHandler: function(form) {
                        $('.create').text('Sending');
                        $('.create').prop('disabled', true);
                        var id = $('#id').val();
                        var formData = new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: "{{url('/')}}"+'/updateTest/' + id,
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
                                    sessionStorage.setItem("update_success", "success");
                                    window.location.href = "{{url('/')}}"+'/test-list';

                                    // $('.create').text('Submit');
                                    // $('.create').prop('disabled', false);
                                    // toastr.success('Test has been successfully updated', 'Success Alert', {timeOut: 5000});
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
