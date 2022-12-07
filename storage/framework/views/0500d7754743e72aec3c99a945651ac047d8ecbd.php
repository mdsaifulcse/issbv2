<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header"><?php echo e(__('Login')); ?></div> -->

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="board_no" class="col-md-4 col-form-label text-md-right">Board No.</label>

                            <div class="col-md-6">
                                <input id="board_no" disabled data-id="board_no" type="text" class="form-control" name="board_no" value="<?php echo e($boardInfo->board_name); ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="c_chest_no" class="col-md-4 col-form-label text-md-right">Chest No.</label>

                            <div class="col-md-5">
                                <input id="c_chest_no" data-id="c_chest_no" type="text" class="form-control <?php if ($errors->has('c_chest_no')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('c_chest_no'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="c_chest_no" value="<?php echo e(old('c_chest_no')); ?>" required autocomplete="c_chest_no" autofocus>
                            </div>
                            <div class="col-md-3 pl-0">
                                <button type="button" onclick="verifyCandidates()" class="btn btn-primary btn-lg">
                                    Verify
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="card jumbotron">

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('candidate.candidateVerify')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">

                            <div class="col-md-6 offset-4 can_image_div">
                                <img src="<?php echo e(asset('assets/images/avater.jpg')); ?>" class="img-thumbnail" width="200">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="name" required >

                                <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roll_no" class="col-md-4 col-form-label text-md-right">Roll No.</label>

                            <div class="col-md-6">
                                <input id="roll_no" type="text" class="form-control <?php if ($errors->has('roll_no')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('roll_no'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="roll_no" value="<?php echo e(old('roll_no')); ?>" required autocomplete="roll_no" autofocus>

                                <?php if ($errors->has('roll_no')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('roll_no'); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>
                        </div>

                        <input type="hidden" id="chest_no" name="chest_no">

                        <div class="form-group row">
                            <div class="col-md-6 offset-4">
                                <button type="submit" class="btn btn-lg btn-primary btn-block login_btn">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
##parent-placeholder-c55a01b0a8ef1d7b211584e96d51bdf8930d1005##
<script>
//     var elem = document.documentElement;
//    function openFullscreen() {
//     if (elem.requestFullscreen) {
//       elem.requestFullscreen();
//     } else if (elem.webkitRequestFullscreen) {
//       elem.webkitRequestFullscreen();
//     } else if (elem.msRequestFullscreen) {
//       elem.msRequestFullscreen();
//     }
    $(document).ready(function(){
        window.localStorage.clear();
    });




    function verifyCandidates() {
        let c_chest_no = $('input[name=c_chest_no]').val();

        $.ajax({
            url : '<?php echo e(route("candidate.verifyUser")); ?>',
            data: {c_chest_no:c_chest_no},
            type: 'GET',
            dataType: "json",
            success: function(response)
            {
                if (response.status == 1) {
                    $('#name').val(response.userInfo.name);
                    $('#roll_no').val(response.userInfo.roll_no);
                    $('#chest_no').val(response.userInfo.chest_no);
                    if (response.userInfo.image) {
                        var img = '<img src="<?php echo e(asset('192.168.10.45/photo')); ?>/'+response.userInfo.image+'" width="200">';
                        $(".can_image_div").html(img);
                    } else {
                        var img = '<img src="<?php echo e(asset('assets/images/avater.jpg')); ?>" class="img-thumbnail" width="200">';
                        $(".can_image_div").html(img);
                    }
                } else {
                    toastr.warning(response.message, 'Match Error', {timeOut: 5000});
                }
            }
        });





    }
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/login.blade.php ENDPATH**/ ?>