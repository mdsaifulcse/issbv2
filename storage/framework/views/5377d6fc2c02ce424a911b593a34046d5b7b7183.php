<?php $__env->startSection('title'); ?>
<?php if($status == 1): ?>
Active
<?php elseif($status == 2): ?>
Inactive
<?php else: ?>
Test
<?php endif; ?>

##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
<style>
    .single-question-answer{
        border: 1px dashed #c4b9d5;
        margin-bottom: 10px;
    }
    .question{
        margin: 5px;
        /*border-bottom: 1px solid #d9d0d09e;*/
    }
    .pagination {
        float: right;
    }
    .question-heading, .answer-option{
        display: inline-flex;
    }
    .question-answer{
        text-indent: 20px;
        margin: 10px;
        /*border-bottom: 1px dashed #c4b9d5;*/
    }
    .answer-option{
        border: 2px dashed #04aceb;
        margin: 10px;
        padding: 8px;
    }
    .answer-option img{
        width: 90px;
        height: 56px;
    }

</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
   <!--  <section class="content-header">
        
        <h5>Assessment</h5>
        <ol class="breadcrumb">
            <li>
                <div id="examTimeCountDown"></div>
            </li>
            <li>
                Running Question: <span class="runningQuestionsShow">1</span>|
            </li>
            <li>
                Total Questions: <span class="totalQuestionsShow">3</span>
            </li>
        </ol>
    </section> -->
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                
                <div class="panel-body">

                    <?php
                        if ($itemDetails->sub_question_status==1){
                            $itemType   = $itemDetails->sub_question_type;
                            $items      = explode('||', $itemDetails->sub_question);
                            $optionType = $itemDetails->sub_option_type;
                            $imagePath  = 'assets/uploads/sub_options/images/';
                            $soundPath  = 'assets/uploads/sub_options/sounds/';
                        } else{
                            $itemType   = $itemDetails->item_type;
                            $item       = $itemDetails->item;
                            $optionType = $itemDetails->option_type;
                            $imagePath  = 'assets/uploads/options/images/';
                            $soundPath  = 'assets/uploads/options/sounds/';
                        }
                    ?>

                    <?php if($itemDetails->sub_question_status !=1): ?>

                    <div class="single-question-answer">

                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question">
                                    <?php if($itemType == 1): ?>
                                        <h3 class="question-heading text-dark">Question: &nbsp; <?php echo $item?></h3>
                                    <?php elseif($itemType == 2): ?>
                                        <strong>Question: </strong> <img src="<?php echo e(asset('assets/uploads/questions/images/'.$item)); ?>" alt="..." style="width: 180px; height: 113px;" title="This image is the question">
                                    <?php elseif($itemType == 3): ?>
                                    <h3>Question : </h3>
                                    <audio controls>
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/ogg">
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                      
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question-answer">
                                    <?php
                                        $options = $itemDetails->options;
                                        $itemCorAns = $itemDetails->correct_answer;

                                        $questionOptions = explode('||', $options);
                                    ?>


                                    <?php if(count($questionOptions)>0): ?>
                                        <?php $__currentLoopData = $questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$questionOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if($optionType == 1): ?>

                                            <input type="radio" id="<?php echo e($key); ?>o" name="options">
                                                
                                            <label for="<?php echo e($key); ?>o" class="btn btn-info"> <?php echo e($questionOption); ?> </label>
                                               

                                            <?php elseif($optionType == 2): ?>
                                                
                                                <div class="answer-option">
                                                    <input type="radio" id="<?php echo e($key); ?>i" name="imgOption">
                                                    <label for="<?php echo e($key); ?>i">
                                                        <img src="<?php echo e(asset($imagePath.$questionOption)); ?>" alt="...">
                                                    </label>
                                                </div>
                                              
                                                
                                            <?php elseif($optionType == 3): ?>
                                                Option <?php echo e($key+1); ?>: <audio controls>
                                                    <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            <?php endif; ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>




                    <?php else: ?>
                         <!-- ------------------ For Sub Question and Option --------------------- -->
                        <?php
                            $optionsAll    = explode('~~', $itemDetails->sub_options);
                            $corAnswers     = explode('||', $itemDetails->sub_correct_answer);
                        ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="single-question-answer">
                        <div class="row">
                            <div class="col-md-12 col-xl-12 col-xs-12">
                                <div class="question">
                                    <?php if($itemType == 1): ?>
                                        <h3 class="question-heading text-dark"><?php echo e($key+1); ?>. &nbsp; <?php echo $item?> </h3>
                                    <?php elseif($itemType == 2): ?>

                                    <strong> Question <?php echo e($key+1); ?>: &nbsp; &nbsp;</strong> <img src="<?php echo e(asset('assets/uploads/sub_questions/images/'.$item)); ?>" alt="..." style="width: 180px; height: 113px;" title="This image is the question">

                                    <?php elseif($itemType == 3): ?>
                                    <h3><?php echo e($key+1); ?>. Question : </h3>
                                        <audio controls>
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/ogg">
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    <?php endif; ?>

                                </div>
                            </div>

                        </div>



                    <div class="row">
                        <div class="col-md-12 col-xl-12 col-xs-12">
                            <div class="question-answer">
                                <?php
                                    $questionOptions    = explode('||', $optionsAll[$key]);
                                    $corAns             = $corAnswers[$key];
                                ?>

                                <?php if(count($questionOptions)>0): ?>
                                    <?php $__currentLoopData = $questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$questionOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if($optionType == 1): ?>
                                           
                                           <input type="radio" id="<?php echo e($key); ?>o" name="options">
                                           <label for="<?php echo e($key); ?>o" class="btn btn-info"><?php echo e($questionOption); ?> </label>
                                        


                                        <?php elseif($optionType == 2): ?>

                                            
                                                <div class="answer-option">
                                                   
                                                    <input type="radio" id="<?php echo e($j); ?>o" name="imgOption">

                                                    <label for="">
                                                    <img src="<?php echo e(asset($imagePath.$questionOption)); ?>" alt="...">
                                                </label>
                                                </div>
                                            
                                    

                                        <?php elseif($optionType == 3): ?>
                                        Option <?php echo e($j+1); ?>:
                                            <audio controls>
                                                <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/ogg">
                                                <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        <?php endif; ?>


                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <br>
                    <div class="">
                    <button class="btn btn-success btn-sm pull-left" onclick="history.go(-1)">Previous</button>
                     
                        
                    
                    <?php if($next_demo_question_id==0): ?>

                        <a href="<?php echo e(url('/examDemoFinish'."?examId=$examId")); ?>">
                            <button class="btn btn-success btn-sm pull-right">Next</button>
                        </a>
                    <?php else: ?>
                    <a href="<?php echo e(url('/examDemoItemPreview'."?examId=$examId"."&next_demo_question_id=$next_demo_question_id"."&skip=$skip")); ?>">
                        <button class="btn btn-success btn-sm pull-right">Next</button>
                    </a>
                <?php endif; ?>
                </div>
                </div>


            </div>
        </div>
    </div>

</section>
<!-- content -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
<!-- For Editors -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->
<script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>
<?php if($status == 2): ?>
<script src="<?php echo e(asset('js/activate.js')); ?>"></script>
<?php endif; ?>

<script>
    $(document).ready(function(){
        <?php if(session('msgType')): ?>
        toastr.success('<?php echo e(session("messege")); ?>', 'You Got Error', {timeOut: 5000});
        <?php endif; ?>
    });
</script>

<script>

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

    function QuestionDelete(id) {

        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: '/destroyItem/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Item has been successfully deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function(e) {
                        toastr.error('You Got Error', 'Inconceivable!', {
                            timeOut: 5000
                        })
                    }
                })


            });
    }
</script>
<?php echo e(session()->forget('success')); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/demo_item_preview.blade.php ENDPATH**/ ?>