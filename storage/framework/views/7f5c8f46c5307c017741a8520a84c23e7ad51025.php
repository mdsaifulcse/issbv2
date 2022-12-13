<?php $__env->startSection('content'); ?>
    <section class="content">
        <div class="panel panel-white">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title">Assessment </h6>
                </div>
            </div>
            <div class="panel-body">
                <h2 class="text-center">Please wait for the Next Instruction!</h2>
                <hr>
                <?php if($examConfigRunningStatus == 1): ?>
                <div class="text-center">
                    <a class="btn btn-lg btn-primary" href="<?php echo e(route('candidate.candidateExamStart', ['examId'=>$examId])); ?>" role="button">Start Assessment</a>
                </div>
                <?php else: ?>
                    <div class="text-center">
                        <a class="btn btn-lg btn-success" id="refresh" href="#" role="button">Refresh</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>
    <script type="text/javascript">
        $('#refresh').click(function() {
            location.reload();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('candidates.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/intructionDemoExam/examDemoFinish.blade.php ENDPATH**/ ?>