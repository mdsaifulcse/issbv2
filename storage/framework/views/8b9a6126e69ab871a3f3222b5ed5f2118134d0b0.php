<?php $__env->startSection('title'); ?>
    Dashboard
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
        min-height: 120px;
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
</style>
<link href="<?php echo e(asset('assets/vendors/modal-popup-ybox/dist/css/yBox.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <!--section starts-->
    <h4>Welcome to Psychometric Dimension</h4>
    <ol class="breadcrumb">
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<?php if(Auth::user()->hasRole('admin')): ?>
<section class="content">
    <h1 class="text-center" style="color: #515763;">Welcome to Admin</h1>
</section>
<?php endif; ?>

<?php if(Auth::user()->hasRole('testing')): ?>
<section class="content">
    <div class="row">
        <div class="col-md-3 animated fadeInLeftBig">

            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <a class="view-details" href="#">
                        <b>Current Board Number</b>
                    </a>
                </div>
                <div class="panel-body">
                    <b><?php echo e($activeBoard?$activeBoard->board_name:'N/A'); ?></b>
                </div>
            </div>

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <a class="view-details" href="#"><b>Total Number of Candidate</b></a>
                </div>
                <div class="panel-body">
                    <b><?php echo e($activeBoard?$activeBoard->total_candidate:'N/A'); ?></b>
                </div>
            </div>

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            <a class="view-details" href="<?php echo e(url('/examConfig?all_active=1')); ?>">
            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <b>Active Tests</b>
                </div>
                <div class="panel-body">
                    <b><?php echo e($activeTest); ?></b>
                </div>
            </div>
            </a>

        </div>
        <div class="col-md-3 animated fadeInLeftBig">

            <a class="view-details" href="<?php echo e(url('/stdSeatPlan')); ?>">
            <div class="panel panel-primary lightbluebg text-center">
                <div class="panel-heading">
                    <b>Seat plan</b>
                </div>
                <div class="panel-body panel-primary">
                    <b><?php echo e($data['total_live']); ?>/<?php echo e($activeBoard?$activeBoard->total_candidate:'N/A'); ?></b>
                </div>
            </div>
            </a>

        </div>

    </div>
    <!--/row-->
</section>
<?php endif; ?>

<?php if(Auth::user()->hasRole('user')): ?>
<section class="content">
    <!-- <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div>Welcome: <?php echo e(Auth::user()->name); ?></div>
                <div style="padding: 10px; text-align:center">
                    <h4>On Going Board Info</h4>
                    <p>Board Number: 2209</p>
                    <p>Total Candidate: 105</p>
                    <p>Ongoing: Personality Test</p>
                </div>
                <div style="padding: 10px">
                    <h4>Share Here / Drop Box</h4>
                    <form class="form-inline" enctype="multipart/form-data" action="<?php echo e(url('sharedoc-store')); ?>" method="POST" novalidate>
                        <?php echo e(csrf_field()); ?>

                        <input class="form-group" type="file" name="item_img" accept="image/*" id="">
                        <button type="submit" class="btn btn-primary mb-2">Upload</button>
                    </form>
                    <p style="padding: 10px;">Shared Docs:</p>
                    <?php
                        $sharedocs = DB::table('psy_modules')->where('type', 'share_doc')->orderBy('id','DESC')->take(5)->get();
                    ?>
                    <ul>
                        <?php if($sharedocs): ?>
                        <?php $__currentLoopData = $sharedocs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sdoc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li style="padding-bottom: 7px"><?php echo e($sdoc->file); ?> <a href="<?php echo e(asset('assets/uploads/psy_module/'.$sdoc->file)); ?>" target="_blank"><i class="fa fa-download"></i></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="border-left:1px solid #CCC;border-right:1px solid #CCC">
            <div class="row">
                <div>Today: <?php echo e(date('j F Y, ')); ?><span id="MyTime"></span></div>
                <div style="padding: 10px">
                    <?php
                        $sescal = DB::table('psy_modules')->where('type', 'session_calender')->orderBy('order','DESC')->first();
                    ?>
                    <?php if($sescal): ?>
                    <h4>Calender</h4>
                       <a href="<?php echo e(asset('assets/uploads/psy_module/'.$sescal->file)); ?>" target="_blank"><img src="<?php echo e(asset('assets/uploads/psy_module/'.$sescal->file)); ?>" width="90%" alt="<?php echo e($sescal->title); ?>"></a>
                    <?php endif; ?>
                </div>
                <div style="padding: 10px">
                    <?php
                        $events = DB::table('psy_modules')->where('type', 'upcoming_events')->orderBy('order','ASC')->take(2)->get();
                        $cnt=1;
                    ?>
                    <?php if($events): ?>
                    <h4>Upcoming Events</h4>
                    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href=""><?php echo $cnt.'. '.$event->title.'<br>'; ?></a>
                        <?php $cnt++; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <div style="padding: 10px">
                    <?php
                        $notice = DB::table('psy_modules')->where('type', 'announcement')->orderBy('order','DESC')->first();
                        $cnt=1;
                    ?>
                    <?php if($notice): ?>
                    <h4>Notice</h4>
                    <div class="col-md-6">
                        <a href=""><img src="<?php echo e(asset('assets/uploads/psy_module/'.$notice->file)); ?>" width="40%" alt="<?php echo e($notice->title); ?>"></a>
                    </div>
                    <div class="col-md-6" style="font-weight:500">
                        <?php echo '<b>'.$notice->title.'</b><br>'.$notice->details; ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div></div>
                <div><?php echo e(Auth::user()->name); ?></div>
                <div>
                    <h4>History</h4>
                </div>
            </div>
        </div>
    </div> -->
    <div style="height: 5em">&nbsp;</div>
    <!--/row-->
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>

<script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/modal-popup-ybox/dist/js/directive.min.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/modal-popup-ybox/dist/js/yBox.min.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>


<script>
    setInterval(myTimer, 1000);
    function myTimer() {
    const d = new Date();
    document.getElementById("MyTime").innerHTML = d.toLocaleTimeString();
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/welcome.blade.php ENDPATH**/ ?>