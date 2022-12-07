<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="breadcrumb-line"></div>
</div>


<!-- Content area -->
<div class="content" style="max-width: 1600px; margin: auto;">
    <div class="panel panel-white">

        <div class="panel-body text-center">
            <div class="">
                <form method="POST" action="<?php echo e(route('candidate.postLogin')); ?>">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="candidate_id" value="<?php echo e($userInfo->id); ?>">
                        <h1>Please verify the secret key</h1>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <input id="secret_key" type="text" class="form-control" name="secret_key" required autofocus placeholder="Secret Kay">

                                <span class="invalid-feedback text-danger" role="alert" <?php if($status==1): ?> style="display: none;" <?php endif; ?>>
                                    <strong><?php echo e('Please enter the correct secret key!'); ?></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6 offset-3">
                                <button type="submit" class="btn btn-lg btn-success btn-block" onClick="toggleFullScreen();">
                                    Secret-Key Verify
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-muted modal-anywhere">
        &copy; <?php echo e(date('Y')); ?>. <a href="#">Developed</a> by <a href="#" target="_blank">Silver Eagle</a>
        <a href="#" class="open-modal secret_key" modal-title="Secret Key Check" modal-type="create" modal-size="medium" modal-class="" selector="viewResource" modal-link="<?php echo e(route('candidate.secretKeyModal')); ?>"></a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
<?php $__env->stopSection(); ?>


<?php $__env->startPush('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function() {
                $('.invalid-feedback').hide();
            }, 5000);
        });

        
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('candidates.layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/candidate_verify.blade.php ENDPATH**/ ?>