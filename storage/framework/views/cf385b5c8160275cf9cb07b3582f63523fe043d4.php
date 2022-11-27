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
        <h1>Assessment</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Assessment</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Assessment
                        </h3>
                    </div>
                </div>
                <div class="panel-body">
                    <h2 class="text-center">Ready to launch Assessment</h2>
                    <hr>
                    <div class="text-center" style="margin-top: 20px; margin-bottom: 100px;">
                        <a class="btn btn-lg btn-primary" href="<?php echo e(route('startMainExam', ['examId' => $examId])); ?>" role="button">Start Assessment</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            <?php if(session('msgType')): ?>
                toastr.success('<?php echo e(session("messege")); ?>', 'You Got Error', {timeOut: 5000});
            <?php endif; ?>
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/examDemoFinish.blade.php ENDPATH**/ ?>