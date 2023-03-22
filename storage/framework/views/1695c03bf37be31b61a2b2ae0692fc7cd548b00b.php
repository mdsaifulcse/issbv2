<?php $__env->startSection('title'); ?>
    Create Result Config
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
            <li class="active">Create Result Config</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-9 col-lg-offset-">
                
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Result Config
                        </h3>
                    </div>
                    <div class="panel-body">

                        <div class="form">
                            <form method="post" action="<?php echo e(route('result-config')); ?>" id="create_set">
                                <?php echo e(csrf_field()); ?>


                                <div class="form-group">
                                    <label for="test_for">Test For</label>
                                    <select name="test_id" id="test_for" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div id="testConfigDetails">
                                
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
    $('#test_for').on('change',function(){

        var testId=$(this).val()
        $('#testConfigDetails').html('<center><img src=" <?php echo e(asset('images/default/loading.gif')); ?>"/></center>').load('<?php echo e(URL::to("load_test_config_data")); ?>/'+testId); 
    })
    </script>

    <script>
        $(document).ready(function(){
            <?php if($message = session()->get('choose')): ?>
                toastr.error('<?php echo e($message); ?>', 'You Got Error', {timeOut: 5000});
            <?php endif; ?>
        });
            // form validation
        $("#create_set").validate( { ignore: [], debug: false, rules: {}, messages: {} })

         <?php if($message = Session::get('errors')): ?>
                toastr.error('<?php echo e($message); ?>', 'Success Alert', {timeOut: 5000});
        <?php endif; ?>

         <?php if($message = Session::get('success')): ?>
                toastr.success('<?php echo e($message); ?>', 'Success Alert', {timeOut: 5000});
        <?php endif; ?>
    </script>

    
<?php $__env->stopSection(); ?>
<?php echo e(session()->forget('item_set_for')); ?>

<?php echo e(session()->forget('item_set_name')); ?>

<?php echo e(session()->forget('item_configuration_type')); ?>

<?php echo e(session()->forget('total_item')); ?>

<?php echo e(session()->forget('choose')); ?>


<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/create_result_config.blade.php ENDPATH**/ ?>