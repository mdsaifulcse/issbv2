@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Create Set
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
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Set</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="post" action="{{ URL::to('/setRedirect') }}" id="create_set">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="question_for">Item Set For</label>
                                    <select name="item_set_for" id="item_set_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        @foreach($test_list as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="item_set_name">Item Set Name</label>
                                    <input type="text" class="form-control" name="item_set_name" placeholder="Item Set Name" required>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Total Item</label>
                                    <input type="number" name="total_item" id="total_question" value="" class="form-control" placeholder="Total Item" min="1" required/>
                                </div>

                                <div class="form-group">
                                    <label>Set Configuration Type</label><br>
                                    <label for="random_item">
                                        <input type="radio" name="set_configuration_type" class="set_configuration_type" id="random_item" value="1" required/> Random Item
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="static_item">
                                        <input type="radio" name="set_configuration_type" class="set_configuration_type" id="static_item" value="2" required/> Static Item
                                        &nbsp;&nbsp;&nbsp;
                                    </label><br>
                                    <label id="set_configuration_type-error" class="error" for="set_configuration_type" hidden></label>
                                </div>

                                <button type="submit" class="btn btn-success create_set">Submit</button>
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
    {{-- <script>
        $('.set_configuration_type').on('change',function(){
            var item_set_for=$('#item_set_for').val()
    
            if(item_set_for===''){
                $('.item_set_for_error').css('display','block')
                return false;
            }else{
                $('.item_set_for_error').css('display','none')
            }
    
            var set_configuration_type=$(this).val()
            if(set_configuration_type==1){
                $('form').attr('id','create_qusetion_set')
            }else{
                $('form').attr('id','create_numeric_question_set')
                 $('form').attr('action','storeItemSet')
            }

            $('#questionSetDetails').html('<center><img src=" {{asset('images/default/loading.gif')}}"/></center>').load('{{URL::to("create-question-set")}}/'+item_set_for+'/'+set_configuration_type); 
        })
        </script> --}}
    <script>
        $(document).ready(function(){
            @if ($message = session()->get('choose'))
                toastr.error('{{ $message }}', 'You Got Error', {timeOut: 5000});
            @endif
        });
            // form validation
        $("#create_set").validate( { ignore: [], debug: false, rules: {}, messages: {} })
    </script>
@stop
{{ session()->forget('item_set_for') }}
{{ session()->forget('item_set_name') }}
{{ session()->forget('item_configuration_type') }}
{{ session()->forget('total_item') }}
{{ session()->forget('choose') }}
