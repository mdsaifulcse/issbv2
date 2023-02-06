<?php $__env->startSection('title'); ?>
<?php if($status == 1): ?>
Active
<?php elseif($status == 2): ?>
Inactive
<?php endif; ?>
<?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($test->id == $item_for): ?>
<?php echo e($test->name); ?>

<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
Item Bank
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
            Active
            <?php elseif($status == 2): ?>
            Inactive
        <?php endif; ?>

        <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($test->id == $item_for): ?>
                <?php echo e($test->name); ?>

            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        Item Bank
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="<?php echo e(URL::to('/')); ?>">Dashboard</a>
        </li>
        <li>
            <?php if($status == 1): ?>
            <a href="<?php echo e(URL::to('/item-bank/active')); ?>"> Active
                <?php elseif($status == 2): ?>
                <a href="<?php echo e(URL::to('/item-bank/inactive')); ?>"> Inactive
                    <?php endif; ?>
                    Item Bank
                </a>
        </li>
        <li class="active">
            <?php if($status == 1): ?>
            Active
            <?php elseif($status == 2): ?>
            Inactive
            <?php endif; ?>
            <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($test->id == $item_for): ?>
            <?php echo e($test->name); ?>

            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            Item Bank
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        <?php if($status == 1): ?>
                        Active
                        <?php elseif($status == 2): ?>
                        Inactive
                        <?php endif; ?>
                        <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($test->id == $item_for): ?>
                        <?php echo e($test->name); ?>

                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        Item Bank
                    </h3>
                    <?php if($status == 1): ?>
                    <div class="pull-right">
                        <a href="<?php echo e(URL::to('/items/'.$item_for.'/2')); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add Item</a>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="panel-body">

                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <?php if($status == 1): ?>
                                <th>Sl No</th>
                                <?php elseif($status == 2): ?>
                                <th>Selection</th>
                                <?php endif; ?>
                                <th>Name</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($status == 1): ?>
                                <td><?php echo e(++$key); ?></td>
                                <?php elseif($status == 2): ?>
                                <td class="text-center">
                                    <div class="checkbox-container">
                                        <input type="checkbox" class="check" value="<?php echo e($value->id); ?>" id="check_<?php echo e($value->id); ?>" name="checkbox[]" />
                                    </div>
                                </td>
                                <?php endif; ?>
                                <td><?php echo e($value->name); ?></td>
                                <td>
                                    <?php if($value->item_type == 1): ?>
                                     <?php echo $value->item; ?> 
                                    <?php elseif($value->item_type == 2): ?>
                                    <img src="<?php echo e(asset('assets/uploads/questions/images/'.$value->item)); ?>" alt="..." style="width: 150px; height: 95px">
                                    <?php elseif($value->item_type == 3): ?>
                                    <audio controls>
                                        <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$value->item)); ?>" type="audio/ogg">
                                        <source src="<?php echo e(asset('assets/uploads/questions/sounds/'.$value->item)); ?>" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($value->item_status == 1): ?>
                                    <span class="label label-success">Active</span>
                                    <?php elseif($value->item_status == 2): ?>
                                        <span class="label label-danger">Inactive</span>
                                    <?php elseif($value->item_status == 3): ?>
                                            <span class="label label-danger">Test</span>
                                    <?php elseif($value->item_status == 4): ?>
                                        <span class="label label-danger">No-Answer</span>
                                    <?php else: ?>
                                    <span class="label label-primary">Demo Question
                                    <?php endif; ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(URL::to('/edit-items/'.$value->id)); ?>"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data"></i></a>
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=QuestionDelete('<?php echo $value->id ?>');></i></a>

                                    <br>
                                    <a href="<?php echo e(URL::to('/item-preview/'.$value->id)); ?>">
                                        <button class="btn btn-primary btn-sm">Preview</button>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($items->links()); ?>

                    <?php if($status == 2 || $status == 3): ?>
                    <label for="checkall" style="margin:20px 15px;">
                        <div class="checkbox-container">
                            <input type="checkbox" id="checkall" data="<?php echo e($item_for); ?>" name="checkall" value="1" /> Check all
                        </div>
                    </label>
                    <br>
                    <button type="submit" class="btn btn-success btn-sm submit">Activate</button>
                    <?php endif; ?>
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/item_list.blade.php ENDPATH**/ ?>