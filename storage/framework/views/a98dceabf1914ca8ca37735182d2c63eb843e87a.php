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
    .pagination {
        float: right;
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <!--section starts-->
    <h1>
        <?php if($status == 1): ?>
        Active Item
        <?php elseif($status == 2): ?>
        Inactive Item
        <?php else: ?>
        Test Item
        <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(URL::to('/')); ?>">Dashboard</a>
        </li>
        <li>
            <?php if($status == 1): ?>
            <a href="<?php echo e(URL::to('/item-bank/active')); ?>"> Active </a>
            <?php elseif($status == 2): ?>
            <a href="<?php echo e(URL::to('/item-bank/inactive')); ?>"> Inactive Item Bank </a>
            <?php else: ?>
            <a href="<?php echo e(URL::to('/item-bank/test')); ?>"> Test Item Bank </a>
            <?php endif; ?>
        </li>
        <li class="active">
            <?php if($status == 1): ?>
            Active Item
            <?php elseif($status == 2): ?>
            Inactive Item
            <?php else: ?>
            Test Item
            <?php endif; ?>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        <?php echo e($itemDetails->item); ?>

                       <!--  <?php // saif
                            if ($itemDetails->sub_question_status==1) {
                                echo $itemDetails->item;
                            }else {
                                echo $itemDetails->sub_question;
                            }
                        ?> -->
                        <!-- <?php echo e(($itemDetails->sub_question_status==1)? $itemDetails->sub_question:$itemDetails->item); ?> -->
                    </h3>
                </div>
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
                    <table id="" class="" style="width:100%">
                        <tbody>
                            <tr>
                                <th width="30%">Question</th>
                                <th width="70%">:
                                    <?php if($itemType == 1): ?>
                                    <?php echo e($item); ?>

                                    <?php elseif($itemType == 2): ?>
                                    <img src="<?php echo e(asset('assets/uploads/questions/images/'.$item)); ?>" alt="..." style="width: 250px; height: 150px;">
                                    <?php elseif($itemType == 3): ?>
                                    <audio controls>
                                        <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/ogg">
                                        <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <?php endif; ?>
                            </tr>
                            <?php
                                $options = $itemDetails->options;
                                $corAns = $itemDetails->correct_answer;

                                $questionOptions = explode('||', $options);
                            ?>

                            <?php if(count($questionOptions)>0): ?>
                                <tr>
                                    <th width="30%">Options</th>
                                    <th width="70%">:</th>
                                </tr>
                                <?php $__currentLoopData = $questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$questionOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th width="30%"></th>
                                        <th width="70%"> <?php echo e($key+1 .') '); ?>

                                            <?php if($optionType == 1): ?>
                                                <?php echo e($item); ?>

                                            <?php elseif($optionType == 2): ?>
                                            <img src="<?php echo e(asset($imagePath.$questionOption)); ?>" alt="..." style="width: 250px; height: 150px; margin-top:5px;">
                                            <?php elseif($optionType == 3): ?>
                                            <audio controls>
                                                <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/ogg">
                                                <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <?php
                            $optionsAll    = explode('~~', $itemDetails->sub_options);
                            $corAnswers     = explode('||', $itemDetails->sub_correct_answer);
                        ?>
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>





                        <table id="" class="" style="width:100%;" >
                            <tbody>
                                <tr>
                                    <th width="30%">Question</th>
                                    <th width="70%">:
                                        <?php if($itemType == 1): ?>
                                        <?php echo e($item); ?>

                                        <?php elseif($itemType == 2): ?>
                                        <img src="<?php echo e(asset('assets/uploads/questions/images/'.$item)); ?>" alt="..." style="width: 250px; height: 150px;">
                                        <?php elseif($itemType == 3): ?>
                                        <audio controls>
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/ogg">
                                            <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$item)); ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <?php endif; ?>
                                    </th>
                                </tr>
                                <?php
                                    $questionOptions    = explode('||', $optionsAll[$key]);
                                    $corAns             = $corAnswers[$key];
                                ?>

                                <?php if(count($questionOptions)>0): ?>
                                    <tr>
                                        <th width="30%">Options</th>
                                        <th width="70%">:</th>
                                    </tr>
                                    <?php $__currentLoopData = $questionOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$questionOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th width="30%"></th>
                                            <th width="70%"> <?php echo e($key+1 .') '); ?>

                                                <?php if($optionType == 1): ?>
                                                    <?php echo e($questionOption); ?> dd
                                                <?php elseif($optionType == 2): ?>
                                                <img src="<?php echo e(asset($imagePath.$questionOption)); ?>" alt="..." style="width: 250px; height: 150px; margin-top:5px;">
                                                <?php elseif($optionType == 3): ?>
                                                <audio controls>
                                                    <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/ogg">
                                                    <source src="<?php echo e(asset($soundPath.$questionOption)); ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                                <?php endif; ?>
                                            </th>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
                <div class="panel-footer">
                    <button onclick="history.go(-1)">Back to List</button>
                    
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
    $(document).ready(function() {
        if (sessionStorage.getItem('activation') == 'success') {
            toastr.success('Item has been successfully activated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("activation");
        }

        $('#example').DataTable({
            "searching": false,
            "paging": false,
            "info": false,
            "lengthChange": false,
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": 2
            }]
        });

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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\issb_psychometric\resources\views/item_preview1.blade.php ENDPATH**/ ?>