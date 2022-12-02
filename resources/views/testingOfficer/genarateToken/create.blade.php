@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Generate Token
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
        <h5>Generate Token</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Generate Token</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Generate Token
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            @if (session('msgType'))
                                <div id="msgDiv" class="msgDiv alert alert-{{session('msgType')}} alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                    <span class="text-semibold">{{ session('msgType') }}!</span> {{ session('messege') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="msgDiv alert alert-danger alert-styled-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                    <span class="text-semibold">Opps!</span> {{ $error }}.
                                </div>
                                @endforeach
                            @endif

                            <form action="{{route('saveGenarateToken')}}" method="GET" class="needs-validation form-horizontal" novalidate enctype="multipart/form-data">
                                @csrf

                                <div id="export_div">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" submitType="0" class="btn btn-primary submitbutton">Genarate Token & Download Users <i class="icon-arrow-right14 position-right"></i></button>
                                        {{-- <button type="submit" submitType="1" class="btn btn-info submitbutton">Download CSV <i class="icon-arrow-right14 position-right"></i></button> --}}
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
            @if (session('msgType'))
                setTimeout(function() {$('.msgDiv').hide()}, 6000);
            @endif

            $('.submitbutton').click(function() {
                let submitType = $(this).attr('submitType');
                $('#submitType').val(submitType);
            })

            $('#action_type').on('change', function() {
                let action_type = $(this).val();
                if (action_type == 1) { //1=export
                    $('#export_div').show();
                    $('#import_div').hide();
                    $('.boardno').val('');
                } else if (action_type == 2) { //2=import
                    $('#import_div').show();
                    $('#export_div').hide();
                    console.log('123')
                    getBoard();
                } else {
                    $('#import_div').hide();
                    $('#export_div').hide();
                }
            })
        });

        function getBoard(){
            $.ajax({
                url: "{{url('/get-candidate-board')}}",
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.board_no').val(data.board_name);
                    $('.no_of_candidate').val(data.total_candidate);
                    $('.boardno').val(data.board_name);
                }
            })
        }
    </script>

@stop
