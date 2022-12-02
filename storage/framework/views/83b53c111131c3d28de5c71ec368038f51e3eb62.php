<?php $__env->startSection('title'); ?>
    Test Instruction
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('DataTables/datatables.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/image_viewer_css/lc_lightbox.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/image_viewer_css/skins/minimal.css')); ?>" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/jasny-bootstrap.css')); ?>">

    <style>
        .pagination {
            float: right;
        }

        .elem, .elem * {
            box-sizing: border-box;
            margin: 0 !important;
        }
        .elem {
            display: inline-block;
            font-size: 0;
            width: 40%;
        }
        .elem > span {
            display: block;
            cursor: pointer;
            height: 0;
            padding-bottom:	70%;
            background-size: cover;
            background-position: center center;
        }

        /*  ------   */
        span.btn.btn-primary.btn-file.btn-sm {
            margin: 0px 2px;
        }
        span.btn.btn-danger.btn-sm.remove-img {
            padding: 2px 7px;
            border-radius: 50%;
            box-shadow: 0px 0px 6px 0px #535353;
            border: 0;
        }
        .mb-4 {
            margin-bottom: 6px;
        }
        div#sub_question {
            margin-top: 5px;
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            color: #ef6f6c;
            background: #fff;
            font-size: 15px;
            font-weight: bold;
        }
        .mt-4{
            margin-top: 4px;
        }
        label#-error {
            display: none;
        }

    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Test Instruction Slider</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Instruction Slider</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="row">

                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left"><i class="livicon" data-name="doc-portrait" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                Create Test Instruction
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="form">
                                <form action="<?php echo e(route('configInstruction.store',['configId'=>$configId])); ?>" method="post" enctype="multipart/form-data" class="needs-validation form-horizontal">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">

                                        <div class="col-lg-5">
                                            <div class="">
                                                <textarea class="form-control" name="text" id="" cols="10" rows="6" placeholder="Type Instruction here"></textarea>
                                            </div>
                                            <label class="control-label">Text</label>
                                        </div>

                                        <div class="col-lg-4">
                                                
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail">
                                                    <img src="<?php echo e(asset('assets/img/authors/no_avatar.jpg')); ?>" alt="..." class="img-responsive" style="width: 300px; height: 130px;"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 130px;"></div>

                                                    <span class="btn btn-primary btn-file btn-sm">
                                                        <span class="fileinput-new">Choose image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" class="form-control img_questions" name="image" accept="image/*" id=""/>
                                                        <div class="invalid-feedback">This field is required.</div>
                                                    </span>
                                                    <span class="btn btn-primary fileinput-exists btn-sm" id="remove" data-dismiss="fileinput">Remove</span>

                                                <label id="image-error" class="error" for="image" hidden></label>
                                            </div>

                                        </div>
                                        <div class="col-lg-3">
                                            <div class="text-left">
                                                <label class="control-label"></label>
                                                <br>
                                                <br>
                                                <div>
                                                    <button type="submit" class="btn btn-success">Submit  <i class="icon-arrow-right14 position-right"></i></button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end row -->


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test Instructions Slider list
                        </h3>
                        <div class="pull-right">
                            
                            

                        </div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Text</th>
                                <th>Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $configInstructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $instruction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$key); ?></td>
                                <td><?php echo e($instruction->text); ?></td>
                                <td>
                                    
                                    <a class="elem" href="<?php echo e(asset('uploads/instruction/'.$instruction->image)); ?>" title="image <?php echo e($key++); ?>" data-lcl-txt="lorem ipsum dolor sit amet" data-lcl-author="someone" data-lcl-thumb="<?php echo e(asset('uploads/instruction/'.$instruction->image)); ?>">
                                        <span style="background-image: url(<?php echo e(asset('uploads/instruction/'.$instruction->image)); ?>);"></span>
                                    </a>
                                </td>
                                <td class="text-center">
                                    
                                    <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=Delete('<?php echo $instruction->id ?>'); ></i></a>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <?php if(!empty($configInstructions)): ?>
                            <?php echo e($configInstructions->links()); ?>

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

    <script language="javascript" type="text/javascript" src="<?php echo e(asset('js/image_viewer_js/lc_lightbox.lite.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('js/image_viewer_js/lib/AlloyFinger/alloy_finger.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jasny-bootstrap.js')); ?>"></script>

    <script>
        $(document).ready(function() {

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

            // live handler
            lc_lightbox('.elem', {
                wrap_class: 'lcl_fade_oc',
                gallery : true,
                thumb_attr: 'data-lcl-thumb',

                skin: 'minimal',
                radius: 0,
                padding	: 0,
                border_w: 0,
            });
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
                    url: '/configInstruction/' + id,
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/configInstruction/listData.blade.php ENDPATH**/ ?>