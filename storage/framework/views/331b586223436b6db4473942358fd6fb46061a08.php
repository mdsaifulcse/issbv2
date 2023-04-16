<?php $__env->startSection('title'); ?>
    Create
    <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($test->id == $test_for): ?>
            <?php echo e($test->name); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    Test Config
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
                <?php if($test->id == $test_for): ?>
                    <?php echo e($test->name); ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            Test Config</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create
                <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($test->id == $test_for): ?>
                        <?php echo e($test->name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                Test Config</li>
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
                                <?php if($test->id == $test_for): ?>
                                    <?php echo e($test->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            Test Config - (<b class="text-success">Static Item</b>)
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form id="create_numeric_question_set">

                            <input type="hidden" name="item_set_for" id="item_set_for" value="<?php echo e($test_for); ?>">
                            <input type="hidden" name="set_configuration_type" id="set_configuration_type" value="2">

                          <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="total_question">Test Name</label>
                                    <input type="text" name="item_set_name" id="item_set_name" value="<?php echo e($test_name); ?>" class="form-control" placeholder="Test Name" required/>
                                </div>
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
                               <label for="total_time">Total Time</label>
                               <input type="number" id="total_time" name="total_time" placeholder="Total Time" min="1" onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" class="form-control numeric_question" required>
                            </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="total_time">Pass Mark</label>
                                      <input type="number" name="pass_mark" id="pass_mark" class="form-control numeric_question" min="1" placeholder="Candidate's pass mark" required/>
                                  </div>
                              </div>
                          </div>
                          <div class="row" style="margin-bottom: 25px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Test Configuration Type :</label>
                                         
                                        
                                     <label for="random_set">
                                        <input type="radio" name="set_type" class="set_type" id="random_set" value="1" required/> Random Set
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label for="static_set">
                                        <input type="radio" name="set_type" class="set_type" id="static_set" value="2" checked required/> Static Set
                                        &nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label id="set_type-error" class="error" for="set_type" hidden></label>
                                </div>
                            </div>
                          </div>

                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="100">Selection</th>
                                <th>Set Name</th>
                                <th>Total Items</th>
                                <th>Set For</th>
                                <th>Set Type</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $question_set; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="checkbox-container">
                                                <input type="checkbox" class="check" value="<?php echo e($value->id); ?>" id="check_<?php echo e($value->id); ?>"  name="checkbox[]"/>
                                            </div>
                                        </td>
                                        <td><?php echo e($value->item_set_name); ?></td>
                                        <td><?php echo e($value->total_items); ?></td>
                                        <td>
                                            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($test->id == $value->item_set_for): ?>
                                                    <?php echo e($test->name); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td><?php echo e($value->set_type); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                        <br>
                        <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                        <a class="btn btn-danger btn-sm" id="back" href="<?php echo e(URL::to('/new-test-configuration')); ?>">Back</a>
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
    

            

            
            
                
                
                
            
                
                
            

            
            

            
                
            
                
            
        
    </script>
    <script>
        $(document).ready(function() {
            $('.set_type').on('change', function () {
                var this_val = $(this).val();
                if(this_val == 1){
                    $('.check').prop('disabled', true);
                }
                else if(this_val == 2)
                {
                    $('.check').prop('disabled', false);
                }
            });

            $('.check').on('change', function () {
                var checked = $(this).prop('checked') == true;

                if(checked){
                    $('.check').prop('checked', false);
                    $(this).prop('checked', true);

                    var resultConfigVal=$('.result_config').val()
                    console.log(resultConfigVal)
                }
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

            $('.numeric_question').on("change",function() {
                var item_set_name = $('#item_set_name').val();
                var item_numbers = $('#item_numbers').val();
                var total_time = $('#total_time').val();
                var pass_mark = $('#pass_mark').val();

                localStorage.setItem("item_set_name", item_set_name);
                localStorage.setItem("item_numbers", item_numbers);
                localStorage.setItem("total_time", total_time);
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
                            var x = $('.check:checked').val();
                            var random = $('.set_type:checked').val();

                            if(x || random == 1){

                                var item_set_for = $('#item_set_for').val();
                                var set_configuration_type = $('#set_configuration_type').val();
                                var set_level = $('#set_level').val();
                                var set_category = $('#set_category').val();
                                var set_type = $('#set_type').val();
                                var pass_mark = $('#pass_mark').val();

                                var candidate_type = $('#candidate_type').val();
                                var item_set_name = $('#item_set_name').val();
                                var total_time = $('#total_time').val();
                                var flag = $('.set_type:checked').val();

                                if(random == 1){
                                    var data = 'random';
                                }else{
                                    var data = x;
                                }

                                $.ajax({
                                    url:"<?php echo e(url('/storeTestConfig')); ?>",
                                    method:"POST",
                                    data: {'data': data, 'test_for': item_set_for, 'test_type': set_configuration_type, 'pass_mark': pass_mark, 'candidate_type': candidate_type, 'test_name': item_set_name, 'total_time': total_time, 'flag': flag},
                                    success:function(data)
                                    {
                                        if(data[0] == 'exists'){
                                            toastr.error('You Got Error', data[1]+' test already exists!', {timeOut: 5000});

                                            $('.submit').text('Submit');
                                            $('.submit').prop('disabled', false);
                                        }
                                        else {
                                            localStorage.clear();
                                            sessionStorage.setItem("new_success", "success");
                                            window.location.href = "<?php echo e(url('/test-configuration-list')); ?>";
                                            //window.location.href = "/test-configuration-list/"+data;
                                        }
                                    },
                                    error: function (e) {
                                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});

                                        $('.submit').text('Submit');
                                        $('.submit').prop('disabled', false);
                                    }
                                });
                            }else {
                                toastr.error('You Got Error', 'Please choose an set', {timeOut: 5000})
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/create_static_test.blade.php ENDPATH**/ ?>