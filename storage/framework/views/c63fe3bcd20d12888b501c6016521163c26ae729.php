<?php $__env->startSection('title'); ?>
Test Config
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<style>
    a.view-details {
        color: #ffffff;
    }

    .wr-content::before {
        content: '';
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        background: url(assets/images/issb-logo.png);
        background-repeat: no-repeat;
        background-position: center;
        background-size: 350px;
        opacity: 0.1;
    }

    .lightbluebg {
        background: #272467;
    }

    .palebluecolorbg {
        background: #01AEF0;
    }

    .goldbg {
        background: #912125;
    }

    .panel {
        border-radius: 0;
    }

    .panel-body {
        height: 85px;
    }

    .col-md-12.view {
        padding: 10px 32px;
        margin-top: -13px;
        border-bottom: 2px solid #0e0a22;
        border-radius: 5px;
    }

    .col-md-12.palebluecolorbg.view {
        border-bottom: 2px solid #277fa1;
    }

    .col-md-12.goldbg.view {
        border-bottom: 2px solid #321919;
    }



*,*:before,*:after {
  box-sizing: border-box;
}
html {
  font-size: 16px;
}

.plane {
  margin: 20px auto;
  /* max-width: 300px; */
}


.fuselage {
  border: 5px solid #d8d8d8;
}

ol {
  list-style :none;
  padding: 0;
  margin: 0;
}

.seats {
  display: flex;
  flex-direction: row;
  flex-wrap: nowrap;
  justify-content: center;
  align-items: center;
}

.seat {
  display: flex;
  flex: 10 0 14.28571428571429%;
  padding: 5px;
  position: relative;
  &:nth-child(3) {
    margin-right: 14.28571428571429%;
  }
}
.seats .seat span {
    /* background: #bada55;  */
    display: block;
    position: relative;
    width: 100%;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    line-height: 1.5rem;
    padding: 4px 0;
    background: #F42536;
    border-radius: 5px;
}
.bg-green { background: green!important; color: white !important; }
.bg-red { background: red!important; }
.mr-20 { margin-right: 20px; }

    .live-div-right {
        float: right;
        font-size: 18px;
        margin-right: 40px;
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <!--section starts-->
    <h5>Welcome to Psychometrics Test</h5>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin</a>
        </li>
        <li><a href="<?php echo e(URL::to('/')); ?>">Dashboard</a></li>
        <li class="active">
            Test Config
        </li>
    </ol>
</section>

<section class="content">
    <div class="row text-center">
        <h3><span>Initial Login Status</span>   <span class="live-div-right"><?php echo e(@$total_live); ?>/<?php echo e($total_candidate); ?> [ Till logged in <?php echo e(@$total_live); ?> out of <?php echo e($total_candidate); ?> ]</span></h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">
                    <?php
                        $left_arr = [
                            [191, 171, 147, 120],
                            [192, 172, 148, 121],
                            [193, 173, 149, 122],
                            [194, 174, 150, 123],
                            [195, 175, 151, 124],
                            [196, 176, 152, 125],
                            [197, 177, 153, 126],
                            [198, 178, 154, 127],
                            [199, 179, 155, 128],
                            [200, 180, 156, 129],
                            ['', 181, 157, 130],
                            ['', '', 158, 131],
                            ['', '', 159, 132],
                            ['', '', '', 133],
                        ]
                    ?>
                    <?php $__currentLoopData = $left_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="row row--1">
                            <ol class="seats" type="A">
                                <?php $__currentLoopData = $lRow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lCol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $candidate = 'candidate_'.$lCol;
                                    ?>
                                    <li class="seat">
                                        <?php if($lCol != ''): ?><span class="bg-<?php if(@$$candidate == 1): ?>green <?php else: ?> red <?php endif; ?>"><?php echo e($lCol); ?></span><?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">

                    <?php
                        $middle_arr = [
                            [91, 76, 61, 46, 31, 16,  1],
                            [92, 77, 62, 47, 32, 17,  2],
                            [93, 78, 63, 48, 33, 18,  3],
                            [94, 79, 64, 49, 34, 19,  4],
                            [95, 80, 65, 50, 35, 20,  5],
                            [96, 81, 66, 51, 36, 21,  6],
                            [97, 82, 67, 52, 37, 22,  7],
                            [98, 83, 68, 53, 38, 23,  8],
                            [99, 84, 69, 54, 39, 24,  9],
                            [100, 85, 70, 55, 40, 25, 10],
                            [101, 86, 71, 56, 41, 26, 11],
                            [102, 87, 72, 57, 42, 27, 12],
                            [103, 88, 73, 58, 43, 28, 13],
                            [104, 89, 74, 59, 44, 29, 14],
                            [105, 90, 75, 60, 45, 30, 15],
                        ]
                    ?>

                    <?php $__currentLoopData = $middle_arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="row row--6">
                            <ol class="seats" type="A">
                                <?php $__currentLoopData = $mRow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mCol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $candidate = 'candidate_'.$mCol;
                                    ?>
                                    <li class="seat">
                                        <span class="bg-<?php if(@$$candidate == 1): ?>green <?php else: ?> red <?php endif; ?>"><?php echo e($mCol); ?></span>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="plane">
                <ol class="cabin fuselage">
                    <?php
                        $right_array = [
                            [106, 134, 160, 182],
                            [107, 135, 161, 183],
                            [108, 136, 162, 184],
                            [109, 137, 163, 185],
                            [110, 138, 164, 186],
                            [111, 139, 165, 187],
                            [112, 140, 166, 188],
                            [113, 141, 167, 189],
                            [114, 142, 168, 190],
                            [115, 143, 169, ''],
                            [116, 144, 170, ''],
                            [117, 145, '', ''],
                            [118, 146, '', ''],
                            [119, '', '', ''],
                        ]
                    ?>

                    <?php $__currentLoopData = $right_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="row row--1">
                            <ol class="seats" type="A">
                                <?php $__currentLoopData = $rRow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rCol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $candidate = 'candidate_'.$rCol;
                                    ?>
                                    <li class="seat">
                                        <?php if($rCol != ''): ?><span class="bg-<?php if(@$$candidate == 1): ?>green <?php else: ?> red <?php endif; ?>"><?php echo e($rCol); ?></span><?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
            </div>
        </div>
    </div>
    
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/seatPlan/list.blade.php ENDPATH**/ ?>