<?php $__env->startSection('content'); ?>

 
    
        
            
        

        
            
                
                    
                
            
        

        
            
                
            
        
        
    

    



<!-- Content area -->
<div class="content" style="margin: auto;" width="100%">
    <div class="panel panel-white">

        <div class="panel-body text-center">
            <div class="">
                <!-- <a class="btn btn-lg btn-success" id="refresh" href="#" role="button">Refresh</a> -->
                <button class="btn btn-lg btn-success full-screen-btn" id="refresh">Refresh</button>
            </div>

            <?php if(!empty($configuredExam)): ?>
                <?php if(!empty($candidateExamInfo)): ?>
                    <?php if($candidateExamInfo->exam_status==2): ?>
                        <h2 class="text-danger">
                            Your Test time is over <br>
                            Or You have attempted this test, Please wait for next Instruction
                        </h2>
                    <?php else: ?>
                        <?php if($candidateExamInfo->instruction_seen_status == 0): ?>
                            <a class="btn btn-default btn-sm mt-10" href="<?php echo e(route('candidate.examInstruction', ['examId'=>$configuredExam->id,'step_id'=>''])); ?>" style="padding: 5%;">Instruction & Demo <i class="icon-play3 position-right"></i></a>
                        <?php elseif($candidateExamInfo->instruction_seen_status == 1 && $candidateExamInfo->demo_exam_status == 0): ?>
                            <a class="btn btn-default btn-sm mt-10" href="<?php echo e(route('candidate.examDemoItemPreview', ['examId'=>$configuredExam->id])); ?>" style="padding: 5%;">Demo Assessment<i class="icon-play3 position-right"></i></a>
                        <?php elseif($configuredExam->exam_status == 1): ?>
                            <a class="btn btn-default btn-sm mt-10" href="<?php echo e(route('candidate.candidateExamStart', ['examId'=>$configuredExam->id])); ?>" style="padding: 5%;">Start Final Assessment<i class="icon-play3 position-right"></i></a>
                        <?php else: ?>
                            <a class="btn btn-danger btn-sm mt-10" href="#" style="padding: 5%;" disabled>Assessment Not Start<i class="icon-play3 position-right"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if($upcomingExamStatus==1): ?>
                        <a class="btn btn-default btn-sm mt-10" href="<?php echo e(route('candidate.examInstruction', ['examId'=>$configuredExam->id, 'step_id'=>''])); ?>" style="padding: 5%;">Instruction & Demo <i class="icon-play3 position-right"></i></a>
                    <?php else: ?>
                        <h2 class="text-danger">Assessment Not Available! </h2>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-muted modal-anywhere">
        &copy; <?php echo e(date('Y')); ?>. <a href="#">Developed</a> by <a href="#" target="_blank">Silvereagle </a>
        <a href="#" class="open-modal secret_key" modal-title="Secret Key Check" modal-type="create" modal-size="medium" modal-class="" selector="viewResource" modal-link="<?php echo e(route('candidate.secretKeyModal')); ?>"></a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>
    <script type="text/javascript">
        $('#refresh').on('click', function() {
            location.reload();            
        });
        
    </script>
    <script>
        $(document).ready(function(){
            <?php if(session('msgType')): ?>
            toastr.success('<?php echo e(session("messege")); ?>', 'You Got Error', {timeOut: 5000});
            <?php endif; ?>
        });

        $(document).ready(function() {
            if (sessionStorage.getItem('activation') == 'success') {
                toastr.success('Item has been successfully activated', 'Success Alert', {
                    timeOut: 5000
                });
                sessionStorage.removeItem("activation");
            }


            <?php if($message = Session::get('success')): ?>
            toastr.success('<?php echo e($message); ?>', 'Success Alert', {
                timeOut: 5000
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('candidates.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/welcome.blade.php ENDPATH**/ ?>