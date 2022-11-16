<?php $__env->startSection('title'); ?>
    Create Test
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5>Assessment Configuration</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Assessment Configuration</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Assessment Configuration
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="<?php echo e(route('examConfig.update', [$examConfig->id])); ?>" method="post" class="needs-validation form-horizontal" novalidate>
                                <?php echo method_field('PUT'); ?>
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Test</label>
                                        <div class="col-lg-6">
                                            <select name="test_config_id" id="test_config_id" class="form-control" required>
                                                <option value="">Select Test</option>
                                                <?php $__currentLoopData = $testConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($test->id); ?>" <?php if($test->id == $examConfig->test_config_id): ?> selected <?php endif; ?>><?php echo e($test->test_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Assessment Date</label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" name="exam_date" value="<?php echo e($examConfig->exam_date); ?>" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Status</label>
                                        <div class="col-lg-6">
                                            <select name="status" id="status" class="form-control" required>
                                                <option value=0 <?php if($examConfig->status==0): ?> selected <?php endif; ?>>In-Active</option>
                                                <option value=1 <?php if($examConfig->status==1): ?> selected <?php endif; ?>>Active</option>
                                                <option value=2 <?php if($examConfig->status==2): ?> selected <?php endif; ?>>Force Stop</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Update Question<i class="icon-arrow-right14 position-right"></i></button>
                                        <a href="<?php echo e(route('examConfig.index')); ?>" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            <?php if(session('msgType') == 'success'): ?>
                toastr.success('<?php echo e(session("messege")); ?>', 'Success', {timeOut: 5000});
            <?php endif; ?>

            <?php if(session('msgType') == 'danger'): ?>
                toastr.warning('<?php echo e(session("messege")); ?>', 'Warning', {timeOut: 5000});
            <?php endif; ?>
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\issb_psychometric\resources\views/testingOfficer/examConfig/update.blade.php ENDPATH**/ ?>