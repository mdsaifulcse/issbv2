<?php $__env->startSection('title'); ?>
    Assessment Configuration
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
        .color-full {
            background-color: #c6aa68!important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Board & Candidates</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Board & Candidates</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Board & Candidates
                        </h3>
                        <div class="pull-right">
                            <a href="<?php echo e(route('boardCandidate.create')); ?>" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span>Create</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">Sl No</th>
                                <th width="20%">Board No</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $boardCandidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($candidate->board_name); ?></td>
                                <td><?php echo e($candidate->total_candidate); ?></td>
                                <td><?php if($candidate->status == 0): ?> InActive <?php else: ?> Active <?php endif; ?></td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('boardCandidate.edit', [$candidate->id])); ?>"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete(<?php echo e($candidate->id); ?>);></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php if(!empty($boardCandidates)): ?>
                            <?php echo e($boardCandidates->links()); ?>

                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- content -->
    <?php $__env->stopSection(); ?>

    
<?php $__env->startSection('footer_scripts'); ?>

    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            <?php if(session('msgType') == 'success'): ?>
                toastr.success('<?php echo e(session("messege")); ?>', 'Success', {timeOut: 5000});
            <?php endif; ?>

            <?php if(session('msgType') == 'danger'): ?>
                toastr.warning('<?php echo e(session("messege")); ?>', 'Warning', {timeOut: 5000});
            <?php endif; ?>

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Assessment has been successfully created', 'Success Alert', {timeOut: 5000});
                sessionStorage.removeItem("new_success");
            }

            $('#example').DataTable( {
                "searching": false,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );
        });

        function Delete(id)
        {

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this record!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function () {
                $.ajax({
                    url: '/boardCandidate/' + id,
                    method: 'DELETE',
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        setTimeout(function () {
                            swal({
                                    title: "Deleted!",
                                    text: "Data has been deleted.",
                                    type: "success",
                                    confirmButtonText: "OK"
                                },
                                function (isConfirm) {
                                    if (isConfirm) {
                                        window.location.reload();
                                    }
                                });
                        }, 1000);
                    },
                    error: function (e) {
                        toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})
                    }
                })
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/boardCandidate/listData.blade.php ENDPATH**/ ?>