<?php $__env->startSection('content'); ?>
    

    <!-- Content area -->
    <div class="content" style="max-width: 1600px; margin: auto;">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    
                        
                            
                        
                    
                    <div class="panel-body">
                        <div class="load_content">
                            <div class="page_loader">
                                <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                            </div>
                            <div class="inst_content">
                                <p class="instruction-text"><?php echo e($configInstruction->text?$configInstruction->text:''); ?></p>
                                <hr>
                                <img src="<?php echo e(asset('uploads/instruction/'.$configInstruction->image)); ?>" alt="" class="instruction-image img-fluid img-thumbnail" height="auto" width="50%">
                                <input type="hidden" name="" id="instrucId" value="<?php echo e($configInstruction->id); ?>">
                            </div>
                        </div>
                        <div class="action-btn">
                            <?php if($instructionEndStatus == 0): ?>
                                <a class="btn btn-lg btn-primary pull-right" href="<?php echo e(route('candidate.examDemoQOne', ['examId'=>$examId])); ?>" role="button">Next</a>
                            <?php else: ?>
                                <button class="btn btn-lg btn-primary pull-right" id="nextInst" examId="<?php echo e($examId); ?>" role="button">Next</button>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
                <br>
            </div>
        </div>
    </div>
    <!-- /content area -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.page_loader').hide();

        // sub menu
        $('#nextInst').on('click', function(e) {
            e.preventDefault();
            let instrucId = $('#instrucId').val();
            let examId = $(this).attr('examId');


//            $('.load_content').html(`<div class="page_loader">
//                                <div class="text-center"><h4>Loading...0</h4><div class="loader"></div></div>
//                            </div>`);

            $.ajax({
                mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                url: "<?php echo e(route('candidate.getInstruction')); ?>",
                data: {'examId': examId, 'instrucId': instrucId},
                type: "GET",
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (parseInt(response) === 0) {
                        $('.page_loader').show();
                    } else {
                        $('.page_loader').hide();
                        $('.inst_content').remove();
                        let html =
                        `<div class="inst_content">
                            <p class="instruction-text">${response.text}</p><hr>
                            <img src="<?php echo e(asset('uploads/instruction/${response.image}')); ?>" alt="" class="center-block instruction-image img-fluid img-thumbnail">
                            <input type="hidden" id="instrucId" value="${response.instrucId}">
                        </div>`;
                        $('.load_content').html(html);
                        if (response.instructionEndStatus == 0) {
                            $('#nextInst').remove();
                            $('.action-btn').html(`<a class="btn btn-lg btn-primary pull-right" href="<?php echo e(route('candidate.examDemoItemPreview', ['examId'=>$examId])); ?>" role="button">Next</a>`);
                        }
                    }
                }
            });
        })
        // end sub
    })

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('candidates.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/intructionDemoExam/instruction.blade.php ENDPATH**/ ?>