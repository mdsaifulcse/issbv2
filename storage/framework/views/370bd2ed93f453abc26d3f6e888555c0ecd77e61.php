<?php $__env->startSection('title'); ?>
    Create Set
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
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
                            <form method="post" action="<?php echo e(URL::to('/setRedirect')); ?>" id="create_set">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label for="question_for">Item Set For</label>
                                    <select name="item_set_for" id="item_set_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('js/create-iq-question-set-validation.js')); ?>"></script>
    
    <script>
        $(document).ready(function(){
            <?php if($message = session()->get('choose')): ?>
                toastr.error('<?php echo e($message); ?>', 'You Got Error', {timeOut: 5000});
            <?php endif; ?>
        });
            // form validation
        $("#create_set").validate( { ignore: [], debug: false, rules: {}, messages: {} })
    </script>
<?php $__env->stopSection(); ?>
<?php echo e(session()->forget('item_set_for')); ?>

<?php echo e(session()->forget('item_set_name')); ?>

<?php echo e(session()->forget('item_configuration_type')); ?>

<?php echo e(session()->forget('total_item')); ?>

<?php echo e(session()->forget('choose')); ?>


<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/create_set.blade.php ENDPATH**/ ?>