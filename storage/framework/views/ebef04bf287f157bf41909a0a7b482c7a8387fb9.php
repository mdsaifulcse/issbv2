<?php
    $menu = DB::table('item_tag_maps')->where('tag', 'tag0')->count();
    if($menu>0)
    { $mnu = DB::table('item_tag_maps')->where('tag', 'tag0')->value('name'); }
    else{ $mnu ='Tag 0'; }
?>

<?php $__env->startSection('title'); ?>
Item <?php echo e($mnu); ?>

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
    <h1><?php echo e($mnu); ?></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active"><?php echo e($mnu); ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        <?php echo e($mnu); ?>

                    </h3>
                    <div class="pull-right">
                        <a href="<?php echo e(URL::to('/create-item-category')); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add New</a>
                    </div>
                </div>
                <div class="panel-body">

                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($value->name); ?></td>
                                <td class="text-center">
                                    <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" onclick=QuestionEdit('<?php echo $value->id ?>');></i></a>
                                    
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php echo e($categories->links()); ?>

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

<script>
    $(document).ready(function() {
        if (sessionStorage.getItem('update_success') == 'success') {

            toastr.success('Item category has been successfully updated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("update_success");
        } else if (sessionStorage.getItem('new_success') == 'success') {
            toastr.success('Item category has been successfully created', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("new_success");
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

    });

    function QuestionEdit(id) {

        swal({
                title: "Are you sure?",
                text: "Some data will be change in other pages!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Edit it!",
                closeOnConfirm: false
            },
            function() {
                window.location.href = '/update-item-category/' + id;
            });
    }

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
                    url: '/destroyItemCategory/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/item_category_list.blade.php ENDPATH**/ ?>