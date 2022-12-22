<?php $__env->startSection('title'); ?>
    Create Test
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <style>
        .instruction-image{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }
    </style>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>


    <section class="content">
        <div class="row">
            <br>

            <div class="col-lg-12">
                
                
                    
                        
                            
                        
                    
                    
                        <div class="load_content">
                            <div class="page_loader">
                                <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                            </div>
                            <?php if(!empty($configInstruction)): ?>
                                <div class="inst_content">
                                    <p class="instruction-text">
                                        <?php if($configInstruction->text != NULL || $configInstruction->text != ''): ?>
                                        <?php echo e($configInstruction->text); ?>

                                        <?php endif; ?></p>
                                    <img src="<?php echo e(asset('uploads/instruction/'.$configInstruction->image)); ?>" alt="" class="instruction-image center-block">
                                    <input type="hidden" name="" id="instrucId" value="<?php echo e($configInstruction->id); ?>">
                                </div>
                            <?php else: ?>
                                <div class="inst_content text-center">
                                    <h3>No Instruction Found</h3>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if(!empty($configInstruction)): ?>
                        <div class="action-btn" style="margin-top: 15px;">
                            <?php if($instructionEndStatus == 0): ?>
                                <a class="btn btn-lg btn-primary pull-right" href="<?php echo e(route('examDemoQOne', ['examId'=>$examId])); ?>" role="button">Next</a>
                            <?php else: ?>
                                <a class="btn btn-lg btn-primary pull-left" href="<?php echo e(route('examScheduleList')); ?>" role="button">Back</a>
                                <button class="btn btn-lg btn-primary pull-right" id="nextInst" examId="<?php echo e($examId); ?>" role="button">Next</button>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                    
                
                
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
            <?php if(session('msgType')): ?>
                toastr.success('<?php echo e(session("messege")); ?>', 'You Got Error', {timeOut: 5000});
            <?php endif; ?>

            $('.page_loader').hide();
            $('#nextInst').on('click', function(e) {
                e.preventDefault();
                let instrucId = $('#instrucId').val();
                let examId = $(this).attr('examId');


                $('.load_content').html(`<div class="page_loader">
                                    <div class="text-center"><h4>Loading...</h4><div class="loader"></div></div>
                                </div>`);

                $.ajax({
                    mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                    url: "<?php echo e(route('nextInstruction')); ?>",
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
                            if(response.text !=null){
                                var title = response.text;
                            } else {
                                var title = '';
                            }
                            let html =
                            `<div class="inst_content">
                                <p class="instruction-text">${title}</p>
                                <img src="<?php echo e(asset('uploads/instruction/${response.image}')); ?>" alt="" class="instruction-image center-block">
                                <input type="hidden" id="instrucId" value="${response.instrucId}">
                            </div>`;
                            $('.load_content').html(html);
                            if (response.instructionEndStatus == 0) {
                                $('#nextInst').remove();
                                $('.action-btn').html(`<a class="btn btn-lg btn-primary pull-right" href="<?php echo e(route('examDemoItemPreview', ['examId'=>$examId])); ?>" role="button">Next</a>`);
                                
                            }
                            console.log(response.instructionEndStatus);

                        }
                    },

                });
            })
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/instruction.blade.php ENDPATH**/ ?>