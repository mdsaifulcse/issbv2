<?php $__env->startSection('title'); ?>
    Create Test
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    
        
        
        
            
                
            
            
        
    
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    
                        
                            
                        
                    
                </div>
                <div class="panel-body">
                    <h2 class="text-center">Ready to launch Assessment</h2>
                    <hr>
                    <div class="text-center" style="margin-top: 20px; margin-bottom: 100px;">
                        <?php if($total_candidate==$total_live): ?>
                        <a class="btn btn-lg btn-primary" href="<?php echo e(route('startMainExam', ['examId' => $examId])); ?>" role="button" target="_blank">Start Assessment</a>
                            <?php else: ?>
                            <a class="btn btn-lg btn-warning" href="<?php echo e(route('examDemoFinish', ['examId' => $examId])); ?>" role="button" title="Wait for all candidate login">Wait & Refresh</a>
                        <?php endif; ?>
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