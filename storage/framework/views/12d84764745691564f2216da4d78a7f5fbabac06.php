<?php $__env->startSection('title'); ?>
    Test List
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
        .color-full {
            background-color: #a0ffff!important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Test List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test List</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12" style="">
                <div class="panel panel-primary " style="border: 1px solid red; margin-bottom: 50px;">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            All Active Test List
                        </h3>
                        <div class="pull-right">
                            
                        </div>
                    </div>

                    <div class="panel-body">
                        <table id="activeTest" class="display nowrap" style="width:100%">
                            <thead>
                            <tr class="color-full">
                                <th width="10%">Sl No</th>
                                <th width="10%">Test For</th>
                                <th width="10%">Test Name</th>
                                <th width="10%">Board Name</th>
                                <th width="15%">Test Date</th>
                                <th width="15%">Duration</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $examConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($config->status == 1 && $config->preview_status == 1): ?>
                                <tr <?php if($config->exam_status == 1): ?> class="bg" <?php endif; ?>>
                                    <td <?php if($config->exam_status == 1): ?> class="color-full1" <?php endif; ?>><?php echo e(++$key); ?></td>
                                    <td><?php echo e($config->testConfig?$config->testConfig->testFor->name:'N/A'); ?></td>
                                    <td><?php echo e($config->testConfig?$config->testConfig->test_name:'N/A'); ?></td>
                                    <td><?php echo e($config->boardCandidate->board_name); ?></td>
                                    <td><?php echo e($config->exam_date); ?></td>
                                    <td><?php echo e($config->exam_duration); ?></td>
                                    <td><?php echo e($config->boardCandidate->total_candidate); ?></td>
                                    <td> <a href="<?php echo e(route('examConfig.show', [$config->id]).'?status=0'); ?>"><b>Activate</b> </a>   </td>
                                    <td class="text-center">
                                        <?php if($config->exam_status == 1): ?>
                                            <a href="<?php echo e(route('runningExamTimeRemain', ['examId'=>$config->id])); ?>">
                                                <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('examPreview', ['examId'=>$config->id])); ?>" target="_blank">
                                            <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                        </a>
                                        <a href="<?php echo e(route('examConfig.edit', [$config->id])."?test_for=$request->test_for"); ?>"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                        <a href="javascript:void(0)"><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete(<?php echo e($config->id); ?>);></i></a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>



                        </table>
                        <?php if(count($examConfigs)>0): ?>
                            <?php echo e($examConfigs->links()); ?>

                        <?php endif; ?>
                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                          All  Test List
                        </h3>
                        <div class="pull-right">
                            
                        </div>
                    </div>

                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr class="color-full">
                                <th width="10%">Sl No</th>
                                <th width="10%">Test For</th>
                                <th width="10%">Test Name</th>
                                <th width="10%">Board Name</th>
                                <th width="15%">Test Date</th>
                                <th width="15%">Duration</th>
                                <th width="10%">Total Candidate</th>
                                <th width="10%">Status</th>
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $examConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->status != 1 && $data->preview_status != 1): ?>
                                <tr <?php if($data->exam_status == 1): ?> class="color-full1" <?php endif; ?>>
                                    <td <?php if($data->exam_status == 1): ?> class="color-full1" <?php endif; ?>><?php echo e(++$key); ?></td>
                                    <td><?php echo e($data->testConfig?$data->testConfig->testFor->name:'N/A'); ?></td>
                                    <td><?php echo e($data->testConfig->test_name); ?></td>
                                    <td><?php echo e($data->boardCandidate->board_name); ?></td>
                                    <td><?php echo e($data->exam_date); ?></td>
                                    <td><?php echo e($data->exam_duration); ?></td>
                                    <td><?php echo e($data->boardCandidate->total_candidate); ?></td>
                                    <td>
                                        <?php if($data->status == 1 && $data->preview_status == 1): ?>
                                            <a href="<?php echo e(route('examConfig.show', [$data->id]).'?status=0'); ?>"><b>Activate</b> </a>
                                        <?php else: ?>
                                            <a href="<?php echo e(route('examConfig.show', [$data->id]).'?status=1'); ?>"><b class="text-danger">In-Active</b></a>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($data->exam_status == 1): ?>
                                        <a href="<?php echo e(route('runningExamTimeRemain', ['examId'=>$data->id])); ?>">
                                            <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                        </a>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('examPreview', ['examId'=>$data->id])); ?>" target="_blank">
                                            <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                        </a>
                                        <a href="<?php echo e(route('examConfig.edit', [$data->id])."?test_for=$request->test_for"); ?>"><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>

                                        <a href="javascript:void(0)"><i class="livicon" data-name="trash" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete(<?php echo e($data->id); ?>);></i></a>

                                        <a href="javascript:void(0)"><i data="<?php echo e($data->id); ?>" class="livicon ass_conf_status_update" data-name="info" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                    </td>
                                </tr>
                                <?php endif; ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>



                        </table>
                        <?php if(count($examConfigs)>0): ?>
                        <?php echo e($examConfigs->links()); ?>

                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>

    </section>

    
    <div class="modal fade" id="ass_conf_status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="assessmentStatusUpdate" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-group text-center">
                            <h3>Are You Sure!</h3>
                            <h4>Publish this Test!</h4>
                            <input type="hidden" class="assignment_id" name="assignment_id">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-center" style="text-align: center !important;">
                    <button type="button" class="btn btn-secondary text-center" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-center status_update_btn">Publish</button>
                </div>
            </div>
        </div>
    </div>
    <!-- content -->
    <?php $__env->stopSection(); ?>

    
<?php $__env->startSection('footer_scripts'); ?>

    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            console.log('sdf')

            $('.ass_conf_status_update').on('click', function(){
                var id = $(this).attr('data');
                $("#ass_conf_status").modal('show');
                $('.assignment_id').val(id);
            });

            $(".status_update_btn").on('click', function(e) {
                e.preventDefault();
                var assignment_id = $('.assignment_id').val();

                $.ajax({
                    type: "get",
                    url: "<?php echo e(url('/assessment-status-update')); ?>",
                    data: {assignment_id:assignment_id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.msgType == 'success') {
                            $("#ass_conf_status").modal('hide');
                            toastr.success(data.messege, 'Success', {timeOut: 5000});
                            window.location="<?php echo e(Request::path()); ?>"+"?test_config_id=<?php echo e($request->test_config_id); ?>";
                        } else {
                            $("#ass_conf_status").modal('hide');
                            toastr.warning(data.messege, 'Warning', {timeOut: 5000});
                        }

                    }
                });
            });
        });
    </script>

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

            $('#activeTest').DataTable( {
                "searching": true,
                "paging": false,
                "info": false,
                "lengthChange":false,
                responsive: true,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ]
            } );


            $('#example').DataTable( {
                "searching": true,
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
                    url: '/examConfig/' + id,
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/examConfig/listData.blade.php ENDPATH**/ ?>