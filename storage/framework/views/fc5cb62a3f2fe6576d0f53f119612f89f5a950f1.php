<?php $__env->startSection('title'); ?>
Users
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
    <h1>View Users</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="#">Admin</a>
        </li>
        <li class="active">View Users</li>
    </ol>
</section>
<section class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-info">
                <div class="panel-heading clearfix">
                    <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        View Users
                    </h3>
                    <div class="pull-right">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Create User</button>
                    </div>
                </div>
                <div class="panel-body">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <?php if(!empty($user->roles)): ?>
                                    <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="badge badge-pill badge-gradient-success"><?php echo e($v->display_name); ?></span></label>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" data-toggle="modal" data-target="#edit_modal" onclick=PopulateModal('<?php echo $user->id ?>');></i></a>
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=PermissionDelete('<?php echo $user->id ?>');></i></a>
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
                    <h4 class="modal-title" id="myModalLabel">Add User</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="add_user" enctype="multipart/form-data" method="post" action="/users/create">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-md" placeholder="Enter Name" tabindex="1" required="required" data-msg="Please enter name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-md" placeholder="Enter Email Address" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-md" placeholder="Password" tabindex="5">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control input-md" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="roles" class="form-control select2" multiple name="roles[]" required="required" data-msg="Please assign role" autofocus>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->display_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row marginTop">
                            <div class="col-xs-6 col-md-6">
                                <input type="submit" id="new_participant" value="Register" class="btn btn-primary btn-block btn-md btn-responsive" tabindex="7">
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
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close resetModal" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title" id="myModalLabel">Edit Users</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="edit_user" enctype="multipart/form-data" method="post" action="/edit_user">
                        <input type="hidden" name="edit_id" value="" id="edit_id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control input-md" placeholder="Enter Name" tabindex="1" required="required" data-msg="Please enter name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="email" name="edit_email" id="edit_email" class="form-control input-md" placeholder="Enter Email Address" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="edit_password" id="edit_password" class="form-control input-md password" placeholder="Password" tabindex="5">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="edit_confirm_password" id="edit_confirm_password" class="form-control input-md password" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select id="edit_roles" class="form-control select2" multiple="multiple" name="edit_roles[]" required="required" data-msg="Please assign role" autofocus>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->display_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row marginTop">
                            <div class="col-xs-6 col-md-6">
                                <input type="submit" value="Update" class="btn btn-warning btn-block btn-md btn-responsive" tabindex="7">
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <input type="reset" value="Reset" class="btn btn-danger btn-block btn-md btn-responsive" tabindex="7">
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
<script src="<?php echo e(asset('validations/edit_user_validation.js')); ?>"></script>
<script src="<?php echo e(asset('validations/new_user_validation.js')); ?>"></script>


<script>
    $(document).ready(function() {
        $(".select2").select2({
            theme: "bootstrap",
            placeholder: "select Role",
            dropdownAutoWidth: true,
            width: 'auto'

        });

        if (sessionStorage.getItem('update_success') == 'success') {

            toastr.success('User been successfully updated', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("update_success");
        } else if (sessionStorage.getItem('new_success') == 'success') {
            toastr.success('User has been successfully created', 'Success Alert', {
                timeOut: 5000
            });
            sessionStorage.removeItem("new_success");
        }

        $('#example').DataTable({
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": 2
            }]
        });

    });

    function PopulateModal(id) {
        $('.password').val('');
        $.ajax({
            url: '/users/' + id + '/edit',
            method: 'GET',
            success: function(data) {

                var selected_array = [];
                $("#edit_id").val(id);
                $('#edit_name').val((data['user']['name']));
                $('#edit_designation').val((data['user']['designation']));
                $('select[name="edit_organization"] option[value="' + data['user']['organization'] + '"]').attr('selected', 'selected');
                $('#edit_address').val((data['user']['address']));
                $('#edit_phone').val((data['user']['phone']));
                $('#edit_dob').val((data['user']['dob']));
                $('select[name="edit_status"] option[value="' + data['user']['status'] + '"]').attr('selected', 'selected');
                $('#edit_email').val((data['user']['email']));
                $.each(data['userRole'], function(index, selectedRoles) {
                    selected_array.push(selectedRoles['id']);
                });
                $('#edit_roles').val(selected_array).trigger('change');

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
                    url: '/users/' + id,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        setTimeout(function() {
                            swal({
                                    title: "Deleted!",
                                    text: "Course has been deleted.",
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
<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/admin/users.blade.php ENDPATH**/ ?>