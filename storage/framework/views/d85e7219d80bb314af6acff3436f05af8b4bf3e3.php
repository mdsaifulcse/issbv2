<?php $__env->startSection('title'); ?>
Permissions
##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" /> -->

<link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" />




<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<section class="content-header">
    <!--section starts-->
    <h1>View Permission</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">View Permission</li>
    </ol>
</section>
<section class="content">

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        View Roles
                    </h3>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Create Permission</button>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($permission->name); ?></td>
                                <td><?php echo e($permission->display_name); ?></td>
                                <td><?php echo e($permission->description); ?></td>
                                <td>
                                    <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" data-toggle="modal" data-target="#edit_modal" onclick=PopulateModal('<?php echo $permission->id ?>');></i></a>
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=PermissionDelete('<?php echo $permission->id ?>');></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close resetModal" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Add Permission</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add_permission">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-md" placeholder="Enter Name" tabindex="1" required="required" data-msg="Please enter name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="display_name" id="display_name" class="form-control input-md" placeholder="Enter Display Name" tabindex="2" required="required" data-msg="Please enter display name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="description" id="description" class="form-control input-md" placeholder="Enter Basic Brief" tabindex="2" required="required" data-msg="Please enter basic brief">
                                </div>
                            </div>
                        </div>

                        <div class="row marginTop">
                            <div class="col-xs-6 col-md-6">
                                <input type="submit" id="new_permission" value="Register" class="btn btn-primary btn-block btn-md btn-responsive" tabindex="7">
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="reset" id="reset" value="Reset" class="btn btn-danger btn-block btn-md btn-responsive" tabindex="7">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close resetModal" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Permission</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="edit_permission">
                        <input type="hidden" name="edit_id" value="" id="edit_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control input-md" placeholder="Enter Name" tabindex="1" required="required" data-msg="Please enter name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="edit_display_name" id="edit_display_name" class="form-control input-md" placeholder="Enter Display Name" tabindex="2" required="required" data-msg="Please enter display name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="edit_description" id="edit_description" class="form-control input-md" placeholder="Enter Basic Brief" tabindex="2" required="required" data-msg="Please enter basic brief">
                                </div>
                            </div>
                        </div>

                        <div class="row marginTop">
                            <div class="col-xs-6 col-md-6">
                                <input type="submit" id="edit_submit" value="Update" class="btn btn-warning btn-block btn-md btn-responsive" tabindex="7">
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="reset" id="edit_reset" value="Reset" class="btn btn-danger btn-block btn-md btn-responsive" tabindex="7">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
<script src="<?php echo e(asset('validations/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(asset('validations/new_permission_validation.js')); ?>"></script>
<script src="<?php echo e(asset('validations/edit_permission_validation.js')); ?>"></script>


<script>
    $(document).ready(function() {

        if (sessionStorage.getItem('update_success') == 'success') {

            toastr.success('Permission been successfully updated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("update_success");
        } else if (sessionStorage.getItem('new_success') == 'success') {
            toastr.success('Permission has been successfully created', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("new_success");
        }
        $('#example').DataTable({
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": 3
            }]
        });

    });

    function PopulateModal(id) {
        $.ajax({
            url: '/permissions/' + id + '/edit',
            method: 'GET',
            success: function(data) {
                var selected_array = [];
                $("#edit_id").val(id);
                $('#edit_name').val((data['permission']['name']));
                $('#edit_display_name').val((data['permission']['display_name']));
                $('#edit_description').val((data['permission']['description']));
            }
        })
    }

    function PermissionDelete(id) {

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
                    url: '/permissions/delete/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Permission has been deleted.",
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
<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issb_psychometric\resources\views/admin/permissions.blade.php ENDPATH**/ ?>