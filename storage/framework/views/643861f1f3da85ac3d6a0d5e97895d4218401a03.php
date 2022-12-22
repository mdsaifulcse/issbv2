<?php $__env->startSection('title'); ?>
    Test Preview
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
    <style>
        .answer-section .single-answer{
            display: table-cell !important;
        }
    </style>
    <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Test Preview</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Preview</li>
        </ol>
    </section>


    <!-- Content area -->
    <div class="content">
        <div class="panel panel-body">
            <?php
                $sl = 1;
            ?>
            <?php $__currentLoopData = $examQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($question->sub_question_status=='' || $question->sub_question_status==NULL): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="question-section">
                                    <label>
                                        <b style="font-size: 18px">
                                            Q<?php echo e($sl); ?>.
                                            <?php if($question->item_type == 1): ?>
                                                <?php echo $question->question_title; ?>

                                            <?php elseif($question->item_type == 2): ?>
                                                <img src="<?php echo e(asset('assets/uploads/questions/images/'.$question->question_title)); ?>" alt="Question Image"  class="img-responsive img-thumbnail">
                                            <?php else: ?>
                                                <?php
                                                    $audio_name_arr = explode('.', $question->question_title, 2);
                                                    $audio_ogg = $audio_name_arr[0].'.ogg';
                                                ?>
                                                <audio controls>
                                                    <source src="<?php echo e($audio_ogg); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$question->question_title)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            <?php endif; ?>
                                        </b>
                                    </label>
                                </div>
                                
                                <?php
                                    $labelClass = 'radio';
                                    $labelType = 'radio';
                                ?>
                                <div class="answer-section">
                                    <?php $__currentLoopData = $question->answerSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ansKey => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="<?php echo e($labelClass); ?> single-answer">
                                            <label class="<?php if($question->true_answer == $ansKey): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?>" for="ans-<?php echo e($ansKey); ?>">
                                                <input type="<?php echo e($labelType); ?>" name="answer_<?php echo e($question->id); ?>" id="ans-<?php echo e($ansKey); ?>" class="styled">
                                                <span class="text-danger">
                                            <?php if($question->option_type == 1): ?>
                                                        <?php echo e($answer); ?>

                                                    <?php elseif($question->option_type == 2): ?>
                                                        <img src="<?php echo e(asset('assets/uploads/options/images/'.$answer)); ?>" alt="Question Image"  class="img-responsive img-thumbnail">
                                                    <?php else: ?>
                                                        <?php
                                                            $audio_name_arr = explode('.', $answer, 2);
                                                            $audio_ogg = $audio_name_arr[0].'.ogg';
                                                        ?>
                                                        <audio controls>
                                                    <source src="<?php echo e($audio_ogg); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset('assets/uploads/options/sounds/'.$answer)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                                    <?php endif; ?>
                                        </span>
                                                
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <legend class="text-bold"></legend>
                        </div>
                    </div>
                    <?php
                        ++$sl;
                    ?>
                <?php else: ?>
                    <?php $__currentLoopData = $question->sub_questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subKey => $sub_q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label>
                                        <b style="font-size: 18px">
                                            Q<?php echo e($sl); ?>.
                                            <?php if($question->sub_question_type == 1): ?>
                                                <?php echo $sub_q; ?>

                                            <?php elseif($question->sub_question_type == 2): ?>
                                                <img src="<?php echo e(asset('assets/uploads/sub_questions/images/'.$sub_q)); ?>" alt="Question Image"  class="img-responsive img-thumbnail">
                                            <?php else: ?>
                                                <?php
                                                    $audio_name_arr = explode($sub_q, 2);
                                                    $audio_ogg = $audio_name_arr[0].'.ogg';
                                                ?>
                                                <audio controls>
                                                    <source src="<?php echo e($audio_ogg); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset('assets/uploads/sub_questions/sounds/'.$sub_q)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            <?php endif; ?>
                                            
                                        </b>
                                    </label>

                                    <?php
                                        $labelClass = 'radio';
                                        $labelType = 'radio';
                                        $subOptions = explode('~~', $question->sub_options);
                                        $answerSet = explode('||', $subOptions[$subKey]);
                                        $sub_correct_answers = explode('||', $question->sub_correct_answer);
                                    ?>
                                    <?php $__currentLoopData = $answerSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAnsKey => $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        ++$subAnsKey;
                                    ?>
                                    <div class="<?php echo e($labelClass); ?>">
                                        <label class="<?php if($sub_correct_answers[$subKey] == $subAnsKey): ?><?php echo e('text-success'); ?><?php else: ?><?php echo e('text-danger'); ?><?php endif; ?>" for="ans-<?php echo e($subAnsKey); ?>">
                                            <input type="<?php echo e($labelType); ?>" name="answer_<?php echo e($sub_q); ?>" id="ans-<?php echo e($subAnsKey); ?>" class="styled">
                                            <span class="text-danger"><?php echo e($answer); ?></span>
                                            
                                        </label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <legend class="text-bold"></legend>
                            </div>
                        </div>
                        <?php
                            ++$sl;
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <div class="pull-right">
                
                <a href="<?php echo e(url('examScheduleList')); ?>" class="btn btn-info">Back To List <i class="icon-backward2 position-right"></i></a>
            </div>

        </div>
    </div>
    <!-- /content area -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script>
        $(document).ready(function(){

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/previewExamQ.blade.php ENDPATH**/ ?>