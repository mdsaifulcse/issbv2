<?php $__env->startSection('title'); ?>
    Create Test
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
    <style>
        /* body{
            margin-top:40px;
        } */

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5>Assessment</h5>
        <ol class="breadcrumb">
            <li>
                <div id="examTimeCountDown"></div>
            </li>
            <li>
                Running Question: <span class="runningQuestionsShow">3</span>|
            </li>
            <li>
                Total Questions: <span class="totalQuestionsShow">3</span>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row setup-content">
            <div class="stepwizard mb-15">
                <div class="stepwizard-row setup-panel">
                    <?php
                        $examQuestions = [1, 2, 3];
                    ?>
                    <?php $__currentLoopData = $examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="stepwizard-step">
                            <?php if($key == 0): ?>
                                <a stepData="<?php echo e($key+1); ?>" class="stepBtn btn btn-default btn-circle step-<?php echo e($key+1); ?>"><?php echo e($key+1); ?></a>
                                <p>Q-<?php echo e($key+1); ?></p>
                            <?php else: ?>
                                <a stepData="<?php echo e($key+1); ?>" class="stepBtn btn <?php if($question == 3): ?> btn-primary <?php else: ?> btn-default <?php endif; ?> btn-circle step-<?php echo e($key+1); ?>"><?php echo e($key+1); ?></a>
                                <p>Q-<?php echo e($key+1); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b style="font-size: 18px" class="item">Demo Question 3?</b></label>
                        <div class="option_show">
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer One
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Two
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Three
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input option_shownput type="radio" name="answer" class="styled" />
                                    Answer Four
                                </label>
                            </div>
                        </div>
                    </div>
                    <legend class="text-bold"></legend>
                        <span id="submitBtnArea" class="pull-right">
                            <a href="<?php echo e(route('examDemoQTwo', ['examId'=>$examId])); ?>" class="btn btn-primary btn-lg previousBtn" type="button">Previous</a>
                            <a href="<?php echo e(route('examDemoFinish', ['examId'=>$examId])); ?>" class="btn btn-success btn-lg  ml-2" type="submit">Next</a>
                        </span>
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/examDemoQThree.blade.php ENDPATH**/ ?>