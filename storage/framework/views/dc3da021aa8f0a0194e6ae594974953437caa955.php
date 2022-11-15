<?php $__env->startSection('title'); ?>
    Create Generate Token
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5>Generate Token</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Create Generate Token</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Generate Token
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <?php if(session('msgType')): ?>
                                <div id="msgDiv" class="msgDiv alert alert-<?php echo e(session('msgType')); ?> alert-styled-left alert-arrow-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                    <span class="text-semibold"><?php echo e(session('msgType')); ?>!</span> <?php echo e(session('messege')); ?>

                                </div>
                            <?php endif; ?>
                            <?php if($errors->any()): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="msgDiv alert alert-danger alert-styled-left alert-bordered">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                    <span class="text-semibold">Opps!</span> <?php echo e($error); ?>.
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <form action="<?php echo e(route('saveGenarateToken')); ?>" method="post" class="needs-validation form-horizontal" novalidate enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3" for="action_type">Select Action</label>
                                        <div class="col-lg-6">
                                            <select name="action_type" id="action_type" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="1">Export</option>
                                                <option value="2">Import</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Board No</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control boardno" name="boardno" required="">
                                        </div>
                                    </div>
                                </div>
                                <div id="export_div">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" submitType="0" class="btn btn-primary submitbutton">Genarate Token & Download Users <i class="icon-arrow-right14 position-right"></i></button>
                                        
                                    </div>
                                </div>

                                <div class="form-group" id="import_div" style="display: none;">
                                    <input type="hidden" class="form-control board_no" name="board_no">
                                    <input type="hidden" class="form-control no_of_candidate" name="no_of_candidate">
                                    <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" submitType="2" class="btn btn-primary submitbutton">Download Users <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" id="submitType" name="submitType" value="">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
    </section>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            <?php if(session('msgType')): ?>
                setTimeout(function() {$('.msgDiv').hide()}, 6000);
            <?php endif; ?>

            $('.submitbutton').click(function() {
                let submitType = $(this).attr('submitType');
                $('#submitType').val(submitType);
            })

            $('#action_type').on('change', function() {
                let action_type = $(this).val();
                if (action_type == 1) { //1=export
                    $('#export_div').show();
                    $('#import_div').hide();
                    $('.boardno').val('');
                } else if (action_type == 2) { //2=import
                    $('#import_div').show();
                    $('#export_div').hide();
                    console.log('123')
                    getBoard();
                } else {
                    $('#import_div').hide();
                    $('#export_div').hide();
                }
            })
        });

        function getBoard(){
            console.log('sdf')
            $.ajax({
                url: "<?php echo e(url('/get-candidate-board')); ?>",
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    $('.board_no').val(data.board_name);
                    $('.no_of_candidate').val(data.total_candidate);
                    $('.boardno').val(data.board_name);
                }
            })
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/genarateToken/create.blade.php ENDPATH**/ ?>