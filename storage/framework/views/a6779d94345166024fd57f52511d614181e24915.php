<?php $__env->startSection('title'); ?>
    Create Test
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
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
                    <h3 class="text-center" style="font-size: 20px">On Going Assessment</h3>
                    <h2 class="text-center" style="font-size: 25px"><?php echo e($exam_name); ?></h2>
                    <hr>

                    <h2 class="text-center" style="font-size: 20px; color: red;">Time Remaining</h2>
                    <h2 class="text-center">
                        <div id="examTimeCountDown" style="font-size: 72px;"></div>
                        <input type="hidden" id="current_time" name="current_time" value="" />
                        <input type="hidden" class="exam_id" name="exam_id" value="<?php echo e($examId); ?>">

                    </h2>
                    <hr>
                    <div class="text-center">
                        <a href="<?php echo e(route('examConfig.index')); ?>" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            // Start Countdown
            String.prototype.toHHMMSS = function () {
                var sec_num = parseInt(this, 10); // don't forget the second parm
                var hours = Math.floor(sec_num / 3600);
                var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
                var seconds = sec_num - (hours * 3600) - (minutes * 60);

                if (hours < 10) {
                    hours = "0" + hours;
                }
                if (minutes < 10) {
                    minutes = "0" + minutes;
                }
                if (seconds < 10) {
                    seconds = "0" + seconds;
                }
                var time = hours + ':' + minutes + ':' + seconds;
                return time;
            }

            var count = "<?php echo e($exam_duration); ?>"; // it's 00:01:02
            var counter = setInterval(examTimeCountDown, 1000);

            function examTimeCountDown() {
                if (parseInt(count) <= 0) {
                    clearInterval(counter);
                    swal({
                        title: "Assessment time is over!",
                        // text: "Your Assessment Time has finished",
                        confirmButtonColor: "#66BB6A",
                        type: 'error'
                    });
                    // $('#qustion-form').submit();
                    // swal({
                    //     title: "Oops!!",
                    //     text: "Your Exam Time has finished",
                    //     type: "error",
                    //     showCancelButton: false,
                    //     confirmButtonClass: "btn-success",
                    //     confirmButtonText: "Submit & Get Exam Result!",
                    //     closeOnConfirm: true
                    // },
                    // function(){
                    //     $('#qustion-form').submit();
                    // });
                    return;
                }
                var temp = count.toHHMMSS();
                count = (parseInt(count) - 1).toString();
                $('#examTimeCountDown').html(temp);
                $('#current_time').val(temp);
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/examConfig/runningExamTime.blade.php ENDPATH**/ ?>