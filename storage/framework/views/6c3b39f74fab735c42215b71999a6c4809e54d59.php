<?php $__env->startSection('title'); ?>
    Edit
    <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($test->id == $test_for): ?>
            <?php echo e($test->name); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    Test Config
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <style>
        .lowercase {
           text-transform: lowercase;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(URL::to('/')); ?>">Admin</a>
            </li>
            <li>
                <a href="<?php echo e(URL::to('/test-configuration-list')); ?>">Test Config</a>
            </li>
            <li><a href="<?php echo e(URL::to('/test-configuration-list/'.$test_for)); ?>">
                    <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($test->id == $test_for): ?>
                            <?php echo e($test->name); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    Test Config List</a>
            </li>
            <li class="active">Edit
                <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($test->id == $test_for): ?>
                        <?php echo e($test->name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                Test Config
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Edit
                            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($test->id == $test_for): ?>
                                    <?php echo e($test->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            Test Config 
                            <?php if($test_config->test_configuration_type==1): ?>
                            <b class="text-success">(Random Item)</b>
                            <?php else: ?>
                            <b class="text-success">(Static Item)</b>
                             <?php endif; ?>
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_random_test">
                                <input type="hidden" id="id" value="<?php echo e($test_config->id); ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Test Name</label>
                                            <input type="text" name="test_name" id="item_set_name" value="<?php echo e($test_config->test_name); ?>" class="form-control" placeholder="Item Set Name" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Total Item</label>
                                            <input type="number" name="total_item" id="total_question" value="<?php echo e($test_config->total_item); ?>" class="form-control" placeholder="Total Item" required/>
                                            <label id="invalid_total_question" class="error" hidden></label>
                                            <span class="text-danger" id="totalItemError"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_question">Number of Selected Item</label>
                                            <input type="number" name="number_of_selected_item_item" id="number_of_selected_item_item" value="<?php echo e($test_config->total_item); ?>" class="form-control" readonly placeholder="Number of Selected Item" min="1" onkeydown="return false" onmousedown="return false" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="candidate_type">Select Candidate Type</label>
                                            <select name="candidate_type" id="candidate_type" class="form-control" required>
                                                <option value=""> Choose one </option>
                                                <?php $__currentLoopData = $candidate_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>" <?php if($test_config->candidate_type == $value->id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                </div> <!-- end row -->

                                

                                <label for="">Item Level</label>
                                <div class="row">
                                    <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="<?php echo e($key); ?>_level"><?php echo e($count[$key.'_name']); ?> </label> (<?php echo e($count[$key.'_count']); ?>)
                                                <input type="number" name="<?php echo e($count[$key.'_name']); ?>" value="<?php echo e($count[$key.'_item_data']); ?>" id="<?php echo e($key); ?>_level" class="form-control item_type" min="1" max="<?php echo e($count[$key.'_count']); ?>" placeholder="<?php echo e($key); ?> level"  onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div> <!-- end row -->



                                <div class="row">
                                    <?php if($noAnswerExist==0): ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="total_time">Total Time</label>
                                                <input type="number" step="any" name="total_time" value="<?php echo e($test_config->total_time); ?>" id="total_time" class="form-control" min="1" placeholder="Total Time" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                                
                                            </div>
                                        </div>
                                    <?php else: ?>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="total_time_no_ans">Total Time In Second</label>
                                                <input type="number" step="any" name="total_time_no_ans" value="<?php echo e($test_config->total_time_no_ans); ?>" id="total_time_no_ans" class="form-control" placeholder="Total Time In Second"  required/>
                                                <input type="hidden" name="noAnswerExist" value="<?php echo e($noAnswerExist); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="break_time">Break Time</label>
                                                <input type="number" name="break_time" value="<?php echo e($test_config->break_time); ?>" id="break_time" class="form-control" placeholder="Break Time in minute"  required/>
                                            </div>
                                        </div>

                                    <?php endif; ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total_time">Pass Mark</label>
                                            <input type="number" name="pass_mark" id="pass_mark" class="form-control" min="1" value="<?php echo e($test_config->pass_mark); ?>" placeholder="Candidate's pass mark" onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');" required/>
                                        </div>
                                    </div>

                                </div> <!--end row -->

                                <button class="btn btn-success create_set">Submit</button> | 
                                <a class="btn btn-danger" href="<?php echo e(URL::to('/new-test-configuration')); ?>">Back</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('js/edit_random_test_validation.js')); ?>"></script>

    <script>
        $('.result_config').on('change',function(){

            var total_question=$('#total_question').val()

            // Total Item / question Validation ------------
            if(total_question==''){
                $('#totalItemError').html('Total item is required')
                $('#totalItemError').css('displey','block')
                return false;
            }else{
                $('#totalItemError').html('')
                $('#totalItemError').css('displey','none')
            }

            var item_set_for=$('#item_set_for').val()
            var result_config=$(this).val()
            
            if(result_config==0){
                $('#testConfigDetails').empty();
            }else{
                $('#testConfigDetails').html('<center><img src=" <?php echo e(asset('images/default/loading.gif')); ?>"/></center>').load('<?php echo e(URL::to("load-test-result-config")); ?>/'+total_question); 
            }

            
        })
    </script>

    <script>
        $(document).ready(function(){
            $('.item_type').on('keyup', function(){
                var sum = 0;
                $(".item_type").each(function(){
                    sum += +$(this).val();
                });
                $("#number_of_selected_item_item").val(sum);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/edit_random_test.blade.php ENDPATH**/ ?>