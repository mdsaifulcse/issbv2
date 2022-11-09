@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Update Numeric Item Set
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
    </style>
@stop

{{-- Page content --}}
@section('content')
    <section class="content-header">
        <!--section starts-->
        <h1>Update Numeric Item Set</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Update Numeric Item Set</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                           Update Numeric Item Set
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form id="update_numeric_question_set">
                            <input type="hidden" id="id" value="{{ $numeric_set->id }}">

                        <div class="row" style="margin-bottom: 25px;">
                            <div class="col-md-3">
                                <select name="candidate_type" id="candidate_type" class="form-control numeric_question" required>
                                    <option value="">Choose Candidate Type</option>
                                    @foreach($candidate_type as $value)
                                        <option value="{{ $value->id }}" @if($numeric_set->candidate_type == $value->id) selected @endif>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" id="item_set_name" placeholder="Item Set Name" value="{{ $numeric_set->item_set_name }}" name="item_set_name" class="form-control numeric_question" required>
                            </div>

                            <div class="col-md-3">
                                <input type="number" id="item_numbers" name="item_numbers" placeholder="Total Item" value="{{ $numeric_set->total_items }}" min="1" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" class="form-control numeric_question" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="total_time" name="total_time" placeholder="Total Time" value="{{ $numeric_set->total_time }}" min="1" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" class="form-control numeric_question" required>
                            </div>
                        </div>

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="100">Assigned To</th>
                                <th>Name</th>
                                <th>Question View</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($numeric_questions as $key => $value)
                                    <?php $numeric_question_id = explode('||', $numeric_set->numeric_question_id );?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="checkbox-container">
                                                <input type="checkbox" class="check" value="{{ $value->id }}" id="check_{{$value->id}}" @foreach($numeric_question_id as $numeric_id) @if($numeric_id == $value->id) checked @endif @endforeach name="checkbox[]"/>
                                            </div>
                                        </td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <iframe src="{{ URL::to('/view-numeric-question/'.$value->id) }}" style="height:200px; width:450px" title="Iframe Example"></iframe>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/update-numeric-question/'.$value->id) }}"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" ></i></a>
                                            <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $numeric_questions->links() }}
                        <label for="checkall" style="margin:20px 15px;">
                            <div class="checkbox-container">
                                <input type="checkbox" id="checkall" name="checkall" value="1"/> Check all
                            </div>
                        </label>
                        <br>
                        <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                        <button type="reset" class="btn btn-danger btn-sm reset">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->

    @stop

    {{-- page level scripts --}}
    @section('footer_scripts')

            <!-- For Editors -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
    <script language="javascript" type="text/javascript" src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script src="{{ asset('jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('update_success') == 'success') {

                toastr.success('Numeric Item set has been successfully updated', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("update_success");
            } else if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Numeric Item set has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }

            $('.reset').on('click', function(){
                localStorage.clear();
                window.location.reload();
            });

            $('#total_time,#item_numbers').on("cut copy paste",function(e) {
                e.preventDefault();
            });

            var checkboxValue = JSON.parse(localStorage.getItem('checkboxValue')) || {}
            var $checkbox = $(".checkbox-container :checkbox");
            $checkbox.on("change", function() {
                $checkbox.each(function() {
                    checkboxValue[this.id] = this.checked;
                });
                localStorage.setItem("checkboxValue", JSON.stringify(checkboxValue));
            });
            $.each(checkboxValue, function(key, value) {
                $("#" + key).prop('checked', value);
            });

            $('#checkall').on('click', function(){
                var checkall = $('input[id="checkall"]:checked').val();

                if(checkall >= 1){
                    $('.check').prop('checked', true);
                    $('#item_numbers').val('all');
                    $('#item_numbers').attr('disabled', 'disabled')
                }else{
                    $('input[class="check"]:checked').prop('checked', false);
                    $('#item_numbers').val('');
                    $('#item_numbers').removeAttr('disabled')
                }

                var checkbox = [];
                $('input[name^=checkbox]:checked').each(function(){
                    checkbox.push($(this).val());
                });
                var prev = localStorage.getItem('myData');
                var current = [];
                if(prev != null){
                    var prevVal = prev.split(/,/);
                    var merge =  $.merge( $.merge( [], checkbox ), prevVal );
                    current.push(merge);
                }else{
                    current.push(checkbox);
                }
                localStorage.setItem("myData", current);
            });

            var checkall = $('input[id="checkall"]:checked').val();
            if(checkall >= 1){
                $('input[class="check"]').prop('checked', true);
                $('#item_numbers').val('all');
                $('#item_numbers').attr('disabled', 'disabled');

                var checkbox = [];
                $('input[name^=checkbox]:checked').each(function(){
                    checkbox.push($(this).val());
                });
                var prev = localStorage.getItem('myData');
                var current = [];
                if(prev != null){
                    var prevVal = prev.split(/,/);
                    var merge =  $.merge( $.merge( [], checkbox ), prevVal );
                    current.push(merge);
                }else{
                    current.push(checkbox);
                }
                localStorage.setItem("myData", current);
            }

            $('.check').on('change', function(){
                $('input[id="checkall"]:checked').prop('checked', false);
                localStorage.setItem("clicked", 'clicked');

                if($(this).prop('checked')){

                    var checkbox = [];
                    $('input[name^=checkbox]:checked').each(function(){
                        checkbox.push($(this).val());
                    });
                    var prev = localStorage.getItem('myData');
                    var current = [];
                    if(prev != null){
                        var prevVal = prev.split(/,/);
                        var merge =  $.merge( $.merge( [], checkbox ), prevVal );

                        current.push(merge);
                    }else{
                        var db_value = '{{ $numeric_set->numeric_question_id }}';
                        var prev_value_db = db_value.split('||');
                        var merge =  $.merge( $.merge( [], checkbox ), prev_value_db );

                        current.push(merge);
                    }
                    localStorage.setItem("myData", current);
                }else{

                    var prev = localStorage.getItem('myData');
                    var current = [];
                    if(prev != null){
                        var prevVal = prev.split(/,/);
                        var removeItem = $(this).val();
                        prevVal = jQuery.grep(prevVal, function(value) {
                            return value != removeItem;
                        });

                        current.push(prevVal);
                    }else{
                        var db_value = '{{ $numeric_set->numeric_question_id }}';
                        var prev_value_db = db_value.split('||');

                        var removeItem = $(this).val();
                        prev_value_db = jQuery.grep(prev_value_db, function(value) {
                            return value != removeItem;
                        });

                        current.push(prev_value_db);
                    }
                    localStorage.setItem("myData", current);
                }
            });

            $('.numeric_question').on("change",function() {
                var item_set_name = $('#item_set_name').val();
                var item_numbers = $('#item_numbers').val();
                var total_time = $('#total_time').val();

                localStorage.setItem("item_set_name", item_set_name);
                localStorage.setItem("item_numbers", item_numbers);
                localStorage.setItem("total_time", total_time);
            });

            if(localStorage.getItem("item_set_name")){
                $('#item_set_name').val(localStorage.getItem("item_set_name"));
            }
            if(localStorage.getItem("item_numbers")){
                $('#item_numbers').val(localStorage.getItem("item_numbers"));
            }
            if(localStorage.getItem("total_time")){
                $('#total_time').val(localStorage.getItem("total_time"));
            }

            $("#update_numeric_question_set").validate(
                    {
                        ignore: [],
                        debug: false,
                        rules: {},
                        messages: {},
                        submitHandler: function(form) {
                            $('.submit').text('Sending...');
                            $('.submit').prop('disabled', true);
                            var clicked = localStorage.getItem("clicked");

                            if(clicked) {
                                var x = localStorage.getItem('myData');
                            }else {
                                var db_value = '{{ $numeric_set->numeric_question_id }}';
                                var x = db_value.split('||');
                                var x = x.join(',');
                            }

                            if(x){
                                var res = x.split(/,/);

                                var data = [];
                                $.each(res, function(i, el){
                                    if($.inArray(el, data) === -1) data.push(el);
                                });

                                var candidate_type = $('#candidate_type').val();
                                var item_set_name = $('#item_set_name').val();
                                var total_time = $('#total_time').val();
                                var checkall = $("#checkall").prop('checked');

                                if(checkall){
                                    var data = ['all'];
                                    var item_numbers = 1;
                                }else{
                                    var data = data.filter(function(v){return v!==''});
                                    var item_numbers = $('#item_numbers').val();
                                }

                                if(data.length == item_numbers ){
                                    var id = $('#id').val();
                                    $.ajax({
                                        url:"/editNumericQuestionSet/"+ id,
                                        method:"POST",
                                        data: {'data': data, 'candidate_type': candidate_type, 'item_set_name': item_set_name, 'item_numbers': item_numbers, 'total_time': total_time},
                                        success:function(data)
                                        {
                                            localStorage.clear();
                                            if (data == 'success')
                                            {
                                                sessionStorage.setItem("update_success", "success");
                                                window.location.href = '/numeric-set-list';
                                            }
                                        },
                                        error : function (request, status, error)
                                        {
                                            if(request.responseJSON['candidate_type'])
                                            {
                                                toastr.error('You Got Error', request.responseJSON['candidate_type'][0], {timeOut: 5000})
                                            }
                                            if(request.responseJSON['item_set_name'])
                                            {
                                                toastr.error('You Got Error', request.responseJSON['item_set_name'][0], {timeOut: 5000})
                                            }
                                            if(request.responseJSON['item_numbers'])
                                            {
                                                toastr.error('You Got Error', request.responseJSON['item_numbers'][0], {timeOut: 5000})
                                            }
                                            if(request.responseJSON['total_time'])
                                            {
                                                toastr.error('You Got Error', request.responseJSON['total_time'][0], {timeOut: 5000})
                                            }

                                            $('.submit').text('Submit');
                                            $('.submit').prop('disabled', false);
                                        }
                                    });

                                }else {
                                    toastr.error('You Got Error', 'Please choose valid question number', {timeOut: 5000});
                                    $('.submit').text('Submit');
                                    $('.submit').prop('disabled', false);
                                }

                            }else {
                                toastr.error('You Got Error', 'Please choose an question', {timeOut: 5000})
                                $('.submit').text('Submit');
                                $('.submit').prop('disabled', false);
                            }
                            return false;
                        }
                    });

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

            @if ($message = Session::get('success'))
                toastr.success('{{ $message }}', 'Success Alert', {timeOut: 5000});
            @endif
         } );

        function QuestionDelete(id)
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
                            url: '/deleteNumericQuestion/' + id,
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Question has been deleted.",
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
