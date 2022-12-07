<?php $__env->startSection('title'); ?>
    Exam Configuration
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
        <h1>Assessment Schedules</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Assessment Schedules</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Assessment Schedules
                        </h3>
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
                                <th width="20%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $examConfigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($config->status == 1 && $config->preview_status == 1): ?>
                                    <tr <?php if($config->exam_status == 1): ?> class="bg" <?php endif; ?>>
                                        <td <?php if($config->exam_status == 1): ?> class="color-full1" <?php endif; ?>><?php echo e(++$key); ?></td>
                                        <td><?php echo e($config->testConfig?$config->testConfig->testFor->name:"N/A"); ?></td>
                                        <td><?php echo e($config->testConfig?$config->testConfig->test_name:'N/A'); ?></td>
                                        <td><?php echo e($config->boardCandidate->board_name); ?></td>
                                        <td><?php echo e($config->exam_date); ?></td>
                                        <td><?php echo e($config->exam_duration); ?></td>
                                        <td><?php echo e($config->boardCandidate->total_candidate); ?></td>

                                        <td class="text-center">
                                        <a href="<?php echo e(url('examPreview?examId='.$config->id)); ?>" target="_blank" class="btn btn-sm btn-primary">Preview Exam</a>

                                        <?php if($config->preview_status == 1 && $config->exam_status==0): ?>

                                            <a href="<?php echo e(route('examInstruction', ['examId'=>$config->id])); ?>" class="btn btn-sm btn-primary">Show Introduction</a>

                                        <?php elseif($config->preview_status == 1 && $config->exam_status==1): ?>

                                            <a href="<?php echo e(url('startMainExam'."?examId=$config->id")); ?>" class="btn btn-sm btn-success">Running</a>

                                        <?php elseif($config->preview_status == 1 && $config->exam_status==2): ?>

                                                <a href="javascript:void(0)" class="btn btn-sm btn-success" disabled>Competed</a>

                                        <?php elseif($config->preview_status == 1 && $config->exam_status==3): ?>

                                            <a href="javascript:void(0)" class="btn btn-sm btn-success" disabled>Cancel</a>

                                        <?php elseif($config->preview_status == 1 && $config->exam_status==4): ?>

                                            <a href="<?php echo e(url('examDemoFinish'."?examId=$config->id")); ?>" class="btn btn-sm btn-success">Prestart</a>

                                        <?php else: ?>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success" disabled>Upcoming</a>
                                        <?php endif; ?>

                                        
                                            
                                        

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
    <!-- content -->
    <?php $__env->stopSection(); ?>

    
    <?php $__env->startSection('footer_scripts'); ?>

    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>

    <script>
        $(document).ready(function() {

            if (sessionStorage.getItem('new_success') == 'success')
            {
                toastr.success('Exam has been successfully created', 'Success Alert', {timeOut: 5000});
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
         } );

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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/conductOfficer/examSchedule/listData.blade.php ENDPATH**/ ?>