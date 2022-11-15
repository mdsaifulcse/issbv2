<?php $__env->startSection('title'); ?>
    Create Test
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


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5>Test Configuration</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Test Configuration</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Test Configuration
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form action="<?php echo e(route('examConfig.store')); ?>" method="post" class="needs-validation form-horizontal" novalidate>
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="test_config_id">Select Test</label>
                                        <div class="col-lg-6">
                                            <select name="test_config_id" id="test_config_id" class="form-control" required>
                                                <option value="">Select Test</option>
                                                <?php $__currentLoopData = $testConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($test->id); ?>"><?php echo e($test->test_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Assessment Date</label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" name="exam_date" required="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row text-right">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-primary">Generate Question <i class="icon-arrow-right14 position-right"></i></button>
                                        <a href="<?php echo e(route('examConfig.index')); ?>" class="btn btn-default">Back To List <i class="icon-backward2 position-right"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            In-Active And Force Stop Test List
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th width="10%">Sl No</th>
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
                            <tr <?php if($config->exam_status == 1): ?> class="color-full" <?php endif; ?>>
                                <td <?php if($config->exam_status == 1): ?> class="color-full" <?php endif; ?>><?php echo e(++$key); ?></td>
                                <td><?php echo e($config->test_name); ?></td>
                                <td><?php echo e($config->board_name); ?></td>
                                <td><?php echo e($config->exam_date); ?></td>
                                <td><?php echo e($config->exam_duration); ?></td>
                                <td><?php echo e($config->total_candidate); ?></td>
                                <td>
                                    <?php if($config->status == 0): ?> 
                                    In-Active 
                                    <?php else: ?> 
                                    Force Stop 
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($config->exam_status == 1): ?>
                                    <a href="<?php echo e(route('runningExamTimeRemain', ['examId'=>$config->id])); ?>">
                                        <i class="livicon" data-name="clock" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Remaining Time"></i>
                                    </a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('examPreview', ['examId'=>$config->id])); ?>" target="_blank">
                                        <i class="livicon" data-name="eye" data-size="20" data-loop="true" data-c="#EF6F61" data-hc="#EF6F61" title="Preview"></i>
                                    </a>
                                    <a href="#"><i data="<?php echo e($config->id); ?>" class="livicon ass_conf_status_update" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14"></i></a>
                                    
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php if(!empty($examConfig)): ?>
                            <?php echo e($examConfigs->links()); ?>

                            <?php endif; ?>
                        </table>
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

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $(document).ready(function(){

            
            <?php if(session('msgType') == 'success'): ?>
                toastr.success('<?php echo e(session("messege")); ?>', 'Success', {timeOut: 5000});
            <?php endif; ?>

            <?php if(session('msgType') == 'danger'): ?>
                toastr.warning('<?php echo e(session("messege")); ?>', 'Warning', {timeOut: 5000});
            <?php endif; ?>

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
                    url: "/assessment-status-update",
                    data: {assignment_id:assignment_id},
                    dataType: 'json',
                    success: function(data) {
                        if (data.msgType == 'success') {
                            $("#ass_conf_status").modal('hide');
                            toastr.success(data.messege, 'Success', {timeOut: 5000});
                        } else {
                            $("#ass_conf_status").modal('hide');
                            toastr.warning(data.messege, 'Warning', {timeOut: 5000});
                        }
                        
                    }
                });
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/examConfig/create.blade.php ENDPATH**/ ?>