<?php $__env->startSection('title'); ?>
    Create Memory Item
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('css/form-check.css')); ?>" rel="stylesheet">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jasny-bootstrap.css')); ?>">
    <link href="<?php echo e(asset('assets/css/toastr.css')); ?>" rel="stylesheet">
    <style>
        .preview_question {
            background: url(/assets/images/background.png);
            max-width: 466px;
            height: 100%;
            margin: 35px 5px;
            padding: 0px;
            display: none;
        }
        img.icons {
            width: 25px;
            padding: 2px;
            border: 2px solid #00000000;
            margin: 20px;
        }
        .checked {
            border: 2px solid #030303 !important;
        }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h5></h5>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(URL::to('/')); ?>">Admin</a>
            </li>
            <li class="active">Create Memory Item</li>
        </ol>
    </section>

    <section class="content" onbeforeunload="return myFunction()">

        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Create Memory Item
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="form">
                            <form id="create_memory_item" method="post" enctype="multipart/form-data"  class="needs-validation" novalidate>
                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" class="total_question" name="total_question"/>
                                <div class="form-group">
                                    <label for="question_name">Item Name</label>
                                    <input type="text" class="form-control" name="question_name" id="question_name" placeholder="Item Name" required/>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_level">Item Level</label>
                                    <select name="question_level" id="question_level" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <?php $__currentLoopData = $item_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($level->id); ?>"><?php echo e($level->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="question_category">Item Category</label>
                                    <select name="question_category" id="question_category" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <?php $__currentLoopData = $item_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <div class="form-group">
                                    <label for="top_text">Top Text</label>
                                    <input type="text" class="form-control" name="top_text" id="top_text" placeholder="Top Text"/>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Down Text</label>
                                    <input type="text" class="form-control" name="down_text" id="down_text" placeholder="Down Text"/>
                                </div>

                                <label for="down_text">Bacground Image</label>
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img src="<?php echo e(asset('assets/images/background.png')); ?>" alt="..." class="img-responsive" style="width: 400px; height: 175px;"/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 175px;"></div>
                                        <div>
                                            <span class="btn btn-primary btn-file btn-sm">
                                                <span class="fileinput-new">Choose image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" class="form-control img_questions" name="item_img" accept="image/*" id=""/>
                                            </span>
                                            <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>
                                        </div><label id="item_img-error" class="error" for="item_img" hidden></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="down_text">Sub Question Images</label>
                                    <input type="file" class="form-control" name="sub_question_images_0[]" id="sub_question_images_0" multiple required/>
                                </div>

                                <div class="form-group">
                                    <span class="btn btn-info btn-sm preview" id="preview_0">Preview</span>
                                </div>

                                <input type="hidden" id="sub_question_data_0" name="sub_question_data_0">
                                <input type="hidden" id="sub_correct_answer_0" class="empty" name="sub_correct_answer_0">
                                <div class="preview_question" id="preview_question_0"></div>

                                <span class="more_sub_question_blog"></span>

                                <div class="form-group">
                                    <span class="btn btn-primary btn-sm more_sub_question">Add more sub question</span>
                                </div>

                                <div class="form-group">
                                    <label for="publish_test">Item Status</label>
                                    <select name="publish_test" id="publish_test" class="form-control" required>
                                        <option value="">Choose one</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">This field is required.</div>
                                </div>

                                <button class="btn btn-success create">Submit</button>
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
    <script src="<?php echo e(asset('assets/js/jasny-bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('js/create_memory_item_validation.js')); ?>"></script>
    <script src="<?php echo e(asset('js/create_memory_item.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/create_memory_item.blade.php ENDPATH**/ ?>