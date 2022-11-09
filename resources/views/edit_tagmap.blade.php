@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Tag-Map
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
        <h5>Welcome to Psychometrics Test</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Update Tag-Map</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Update Tag-Map
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>
                                <input type="hidden" id="id" value="{{$itemtag->id}}">
                                <div class="form-group">
                                    <label for="name">Tag</label>
                                    <select class="form-control" name="tag" required>
                                        <option value="">Select One</option>
                                        <option value="tag0" {{ 'tag0' == $itemtag->tag ?  'selected' : '' }}>Tag0</option>
                                        <option value="tag1" {{ 'tag1' == $itemtag->tag ?  'selected' : '' }}>Tag1</option>
                                        <option value="tag2" {{ 'tag2' == $itemtag->tag ?  'selected' : '' }}>Tag2</option>
                                        <option value="tag3" {{ 'tag3' == $itemtag->tag ?  'selected' : '' }}>Tag3</option>
                                        <option value="tag4" {{ 'tag4' == $itemtag->tag ?  'selected' : '' }}>Tag4</option>
                                        <option value="tag5" {{ 'tag5' == $itemtag->tag ?  'selected' : '' }}>Tag5</option>
                                        <option value="tag6" {{ 'tag6' == $itemtag->tag ?  'selected' : '' }}>Tag6</option>
                                        <option value="tag7" {{ 'tag7' == $itemtag->tag ?  'selected' : '' }}>Tag7</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name to Use</label>
                                    <input type="text" class="form-control" name="name" value="{{$itemtag->name}}" placeholder="Tag Name" required/>
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
                        var id = $('#id').val();
                        var formData = new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: '/updateTagMap/'+id,
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
                                    window.location.href = '/item-mapping';
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
