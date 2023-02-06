<?php $__env->startSection('title'); ?>
    Item Bank No-Answer
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
            background: #b10974;
        }
        .palebluecolorbg {
            background: #01AEF0;
        }
        .goldbg {
            background: #b10974;
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
            border-bottom: 2px solid #ccc;
        }

    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li><a href="<?php echo e(URL::to('/')); ?>">Dashboard</a></li>
            <li class="active">
                <a href="#">Item Bank</a>
            </li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3 animated fadeInLeftBig" style="padding:5px">
                    <a class="view-details" href="<?php echo e(URL::to('/items/'.$test->id.'/4')); ?>">
                        <div class="row">
                            <div class="col-md-12 lightbluebg view">
                                <?php echo e($test->name); ?> Bank
                        <span class="widget_circle3 pull-right">
                            <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-203<?php echo e($test->id); ?>" style="width: 20px; height: 20px;"></i>
                        </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($memory_bank > 0): ?>
                <div class="col-md-3 animated fadeInLeftBig" style="padding:5px">
                <a class="view-details" href="<?php echo e(URL::to('memory-items/1')); ?>">
                    <div class="row">
                        <div class="col-md-12 lightbluebg view">
                            Memory Bank
                        <span class="widget_circle3 pull-right">
                            <i class="livicon" data-name="arrow-circle-right" data-size="20" data-c="#fff" data-hc="#fff" data-loop="true" id="livicon-20300" style="width: 20px; height: 20px;"></i>
                        </span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endif; ?>

        </div>
        <!--/row-->
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/item_bank_no_answer.blade.php ENDPATH**/ ?>