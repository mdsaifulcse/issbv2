<?php $__env->startSection('title'); ?>
    Create
    <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($test->id == $item_set_for): ?>
            <?php echo e($test->name); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    Question Set -Static Item
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
         .lowercase {
             text-transform: lowercase;
         }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Create
            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($test->id == $item_set_for): ?>
                    <?php echo e($test->name); ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            Question Set</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create
                <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($test->id == $item_set_for): ?>
                        <?php echo e($test->name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                Question Set</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                           Create
                            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($test->id == $item_set_for): ?>
                                    <?php echo e($test->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            Question Set <b class="text-success">(Static Item)</b>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form id="create_numeric_question_set">

                            <input type="hidden" name="item_set_for" id="item_set_for" value="<?php echo e($item_set_for); ?>">
                            <input type="hidden" name="set_configuration_type" id="set_configuration_type" value="2">                    
                            <div class="row" style="margin-bottom: 25px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total_question">Item Set Name</label>
                                    <input type="text" name="item_set_name" id="item_set_name" value="<?php echo e($item_set_name); ?>" class="form-control" placeholder="Item Set Name" required/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="item_numbers">Total Item</label>
                                <input type="number" id="item_numbers" name="total_item" placeholder="Total Item" value="<?php echo e($total_item); ?>" min="1" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" class="form-control numeric_question" required>
                                <label id="total_question_invalid" class="error" hidden></label>
                            </div>
                            <div class="col-md-3">
                                <label for="candidate_type">Candidate Type</label>
                                <select name="candidate_type" id="candidate_type" class="form-control numeric_question" required>
                                    <option value="">Choose Candidate Type</option>
                                    <?php $__currentLoopData = $candidate_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            <div class="col-md-3">
                              <div class="form-group">
                                <label for="set_type">Set Type</label>
                                <select name="set_type" id="set_type" class="form-control numeric_question" required>
                                    <option value="">Choose Type</option>
                                    <option value="Active">Active</option>
                                    <option value="Practice">Practice</option>
                                </select>
                                </div>
                            </div>
                          </div>

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="100">Selection</th>
                                <th>Name</th>
                                <th>Item</th>
                                <th>Item level</th>
                                <th>Item Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $item_bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="checkbox-container">
                                                <input type="checkbox" class="check" value="<?php echo e($value->id); ?>||<?php echo e($value->level); ?>" id="check_<?php echo e($value->id); ?>"  name="checkbox[]"/>
                                            </div>
                                        </td>
                                        <td> <?php echo $value->name;?> </td>
                                        <td>
                                            <?php if($value->item_type == 1): ?>
                                                <?php echo $value->item;?>
                                            <?php elseif($value->item_type == 2): ?>
                                                <img src="<?php echo e(asset('assets/uploads/questions/images/'.$value->item)); ?>" alt="..." style="width: 250px; height: 150px;">
                                            <?php elseif($value->item_type == 3): ?>
                                                <audio controls>
                                                    <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$value->item)); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$value->item)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $item_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $levels): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($levels->id == $value->level): ?>
                                                    <?php echo e($levels->name); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <?php if($value->item_status == 1): ?>
                                                <span class="badge badge-success">Active</span>
                                            <?php elseif($value->item_status ==2): ?>
                                                <span class="badge badge-danger">Inactive</span>
                                            <?php else: ?>
                                                <span class="badge badge-primary">Test</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($item_bank->links()); ?>

                        <label for="checkall" style="margin:20px 15px;">
                            <div class="checkbox-container">
                                <input type="checkbox" id="checkall" name="checkall" value="1"/> Check all
                            </div>
                        </label>
                        <br>
                        <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                        <a class="btn btn-danger btn-sm" id="back" href="<?php echo e(URL::to('/create-set')); ?>">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->

    <?php $__env->stopSection(); ?>

    
    <?php $__env->startSection('footer_scripts'); ?>

            <!-- For Editors -->

    <!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>
    <script src="<?php echo e(asset('jquery.validate.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {

            /*
            // clear local storage

            $('.single_url').on('click', function () {
                localStorage.clear();
            });
            $('#menu>.active>.sub-menu .collapse .in>li>a').on('click', function () {
                localStorage.clear();
            });*/

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
                        current.push(checkbox);
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
                    }
                    localStorage.setItem("myData", current);
                }
            });

            $('.numeric_question').on("change",function() {
                var item_set_name = $('#item_set_name').val();
                var item_numbers = $('#item_numbers').val();
                var total_time = $('#total_time').val();
                var set_level = $('#set_level').val();
                var set_category = $('#set_category').val();
                var set_type = $('#set_type').val();
                var pass_mark = $('#pass_mark').val();

                localStorage.setItem("item_set_name", item_set_name);
                localStorage.setItem("item_numbers", item_numbers);
                localStorage.setItem("total_time", total_time);
                localStorage.setItem("set_level", set_level);
                localStorage.setItem("set_category", set_category);
                localStorage.setItem("set_type", set_type);
                localStorage.setItem("pass_mark", pass_mark);
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
            if(localStorage.getItem("set_level")){
                $('#set_level').val(localStorage.getItem("set_level"));
            }
            if(localStorage.getItem("set_category")){
                $('#set_category').val(localStorage.getItem("set_category"));
            }
            if(localStorage.getItem("set_type")){
                $('#set_type').val(localStorage.getItem("set_type"));
            }
            if(localStorage.getItem("pass_mark")){
                $('#pass_mark').val(localStorage.getItem("pass_mark"));
            }

            $("#create_numeric_question_set").validate(
                    {
                        ignore: [],
                        debug: false,
                        rules: {},
                        messages: {},
                        submitHandler: function(form) {

                            $('.submit').text('Sending...');
                            $('.submit').prop('disabled', true);
                            var x = localStorage.getItem('myData');

                            if(x){
                                var res = x.split(/,/);

                                var data = [];
                                $.each(res, function(i, el){
                                    if($.inArray(el, data) === -1) data.push(el);
                                });

                                var item_set_for = $('#item_set_for').val();
                                var set_configuration_type = $('#set_configuration_type').val();
                                var set_level = $('#set_level').val();
                                var set_category = $('#set_category').val();
                                var set_type = $('#set_type').val();
                                var pass_mark = $('#pass_mark').val();

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
                                    $('#total_question_invalid').hide();

                                    $.ajax({
                                        url:"<?php echo e(url('/')); ?>"+"/storeItemSet",
                                        method:"POST",
                                        data: {'data': data, 'item_set_for': item_set_for, 'set_configuration_type': set_configuration_type, 'set_level': set_level, 'set_category': set_category, 'set_type': set_type, 'pass_mark': pass_mark, 'candidate_type': candidate_type, 'item_set_name': item_set_name, 'total_item': item_numbers, 'total_time': total_time},
                                        success:function(data)
                                        {
                                            localStorage.clear();
                                            if (data)
                                            {
                                                sessionStorage.setItem("new_success", "success");
                                                window.location.href = "<?php echo e(url('/')); ?>"+"/question-set/"+data;
                                            }
                                        },
                                        error: function (e) {
                                            toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                                            $('.submit').text('Submit');
                                            $('.submit').prop('disabled', false);
                                        }
                                    });

                                }else {
                                    toastr.error('You Got Error', 'Invalid total item!', {timeOut: 5000});
                                    $('#total_question_invalid').html('Invalid total item');
                                    $('#total_question_invalid').show();
                                    $('#item_numbers').focus();
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

            <?php if($message = Session::get('success')): ?>
                toastr.success('<?php echo e($message); ?>', 'Success Alert', {timeOut: 5000});
            <?php endif; ?>

            $('#back').on('click', function(){
                 localStorage.clear();
            });
         } );

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/create_static_item_set.blade.php ENDPATH**/ ?>