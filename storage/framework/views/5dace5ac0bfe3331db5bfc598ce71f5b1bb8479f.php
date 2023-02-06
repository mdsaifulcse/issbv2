<?php $__env->startSection('title'); ?>
    Create
    <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($test->id == $item_set_for): ?>
            <?php echo e($test->name); ?>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    Question Set
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
                <a href="#">Admin</a>
            </li>
            <li class="active">Create
                <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($test->id == $item_set_for): ?>
                        <?php echo e($test->name); ?>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                Question Set
            </li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create
                            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($test->id == $item_set_for): ?>
                                    <?php echo e($test->name); ?>

                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            Question Set
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="POST" id="create_qusetion_set">

                                <input type="hidden" name="item_set_for" id="item_set_for" value="<?php echo e($item_set_for); ?>">
                                <input type="hidden" name="set_configuration_type" id="set_configuration_type" value="1">
                                <div class="form-group">
                                    <label for="total_question">Item Set Name</label>
                                    <input type="text" name="item_set_name" id="item_set_name" value="<?php echo e($item_set_name); ?>" class="form-control" placeholder="Item Set Name" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Total Item</label>
                                    <input type="number" name="total_item" id="total_question" value="<?php echo e($total_item); ?>" class="form-control" placeholder="Total Item" required/>
                                </div>

                                <div class="form-group">
                                    <label for="total_question">Number of Selected Item</label>
                                    <input type="number" name="number_of_selected_item_item" id="number_of_selected_item_item" class="form-control" readonly placeholder="Number of Selected Item" min="1" onkeydown="return false" onmousedown="return false" required/>
                                </div>

                                <div class="form-group">
                                    <label for="candidate_type">Select Candidate Type</label>
                                    <select name="candidate_type" id="candidate_type" class="form-control" required>
                                        <option value=""> Choose one </option>
                                        <?php $__currentLoopData = $candidate_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <label for="">Item Level</label>
                                <div class="row">
                                <?php $__currentLoopData = $counts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="<?php echo e($key); ?>_level"><?php echo e($key); ?></label> (<?php echo e($count); ?>)
                                            <input type="text" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>_level" class="form-control item_type" min="1" max="<?php echo e($count); ?>" placeholder="<?php echo e($key); ?> level"  onkeydown="if(event.key==='.'){event.preventDefault();}" oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="form-group">
                                    <label for="set_type">Set Type</label>
                                    <select name="set_type" id="set_type" class="form-control numeric_question" required>
                                        <option value="">Choose Type</option>
                                        <option value="Active">Active</option>
                                        <option value="Practice">Practice</option>
                                    </select>
                                    
                                </div>

                                <button class="btn btn-success create_set">Submit</button>
                                <a class="btn btn-danger" href="<?php echo e(URL::to('/create-set')); ?>">Back</a>
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
    <script src="<?php echo e(asset('js/create-random-item-set-validation.js')); ?>"></script>
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/create_random_item_set.blade.php ENDPATH**/ ?>