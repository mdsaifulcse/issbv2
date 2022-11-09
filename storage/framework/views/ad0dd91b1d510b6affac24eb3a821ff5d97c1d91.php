<?php $__env->startSection('title'); ?>
    Map Item Tag Names
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5>Welcome to Psychometrics Test</h5>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Item Tag Names</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Item Tag Names
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_data" class="needs-validation" novalidate>

                                <div class="form-group">
                                    <label for="name">Tag</label>
                                    <select class="form-control" name="tag" required>
                                        <option value="">Select One</option>
                                        <option value="tag0">Tag0</option>
                                        <option value="tag1">Tag1</option>
                                        <option value="tag2">Tag2</option>
                                        <option value="tag3">Tag3</option>
                                        <option value="tag4">Tag4</option>
                                        <option value="tag5">Tag5</option>
                                        <option value="tag6">Tag6</option>
                                        <option value="tag7">Tag7</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name to Use</label>
                                    <input type="text" class="form-control" name="name" placeholder="Tag Name" required/>
                                </div>

                                <button class="btn btn-success create">Submit</button>
                            </form>
                        </div>
                        <div style="padding:10px 0"></div>
                        <div class="row">
                            <div class="h4">List of Tags</div>
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php $i=0; ?>
                                <?php if(count($TagMaps)>0): ?>
                                    <?php $__currentLoopData = $TagMaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $TagMap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th scope="row"><?php echo e(++$i); ?></th>
                                        <td><?php echo e($TagMap->tag); ?></td>
                                        <td><?php echo e($TagMap->name); ?></td>
                                        <td class="text-center">
                                            <a><i class="livicon" data-name="edit" data-size="20" data-loop="true" data-c="#F89A14" data-hc="#F89A14" title="Update data" onclick=QuestionEdit(<?php echo e($TagMap->id); ?>)></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
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
        $("#create_data").validate(
                {
                    ignore: [],
                    debug: false,
                    rules: {
                        name: {
                            required: true
                        }
                    },
                    messages: {
                        name: "This field is required",
                    },

                    submitHandler: function(form) {
                        $('.create').text('Sending');
                        $('.create').prop('disabled', true);
                        var formData = new FormData($(form)[0]);
                        $.ajax({
                            type: "POST",
                            url: 'storemapname',
                            data:formData,
                            processData: false,
                            contentType: false,
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            async: true,
                            success: function(response) {
                                if (response == 'success')
                                {
                                    sessionStorage.setItem("new_success", "success");
                                    window.location.href = '/item-mapping';
                                }
                            },
                            error: function (e) {
                                toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                                $('.create').text('Submit');
                                $('.create').prop('disabled', false);
                            }
                        });

                        return false;

                    }


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
                window.location.href = '/edit-tagmap/'+id;
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issb_psychometric\resources\views/item_tag_map.blade.php ENDPATH**/ ?>