<?php $__env->startSection('title'); ?>
    Test Group
    ##parent-placeholder-3c6de1b7dd91465d437ef415f94f36afc1fbc8a8##
<?php $__env->stopSection(); ?>


<?php $__env->startSection('header_styles'); ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" />
    <style>
        .pagination {
            float: right;
        }
         .lowercase {
             text-transform: lowercase;
         }
    </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <!--section starts-->
        <h1>Test Group</h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Test Group</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                            Test Group
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <form id="create_test_group">
                                    <?php $__currentLoopData = $test_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groups): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($groups->groups == 1): ?>
                                            <?php $intelligence_test = 1;?>
                                        <?php endif; ?>
                                        <?php if($groups->groups == 2): ?>
                                            <?php $personality_test = 1;?>
                                        <?php endif; ?>
                                        <?php if($groups->groups == 3): ?>
                                            <?php $psym_test = 1;?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                        <label for="test_group">Test Group</label>
                                        <select name="test_group"  id="test_group" class="form-control" required>
                                            <option value="">Choose one</option>
                                            <?php if(!isset($intelligence_test)): ?>
                                                <option value="1">Intelligence Test</option>
                                            <?php endif; ?>
                                            <?php if(!isset($personality_test)): ?>
                                                <option value="2">Personality Test</option>
                                            <?php endif; ?>
                                            <?php if(!isset($psym_test)): ?>
                                                <option value="3">PSYM Test</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="test_config">Select Test </label>
                                        <select name="test_config[]" id="test_config1" class="form-control select23" multiple="multiple" required>
                                            <option value="">Choose one </option>
                                            <?php if(isset($test_list)): ?>
                                                <?php $__currentLoopData = $test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($value[0])): ?>
                                                        <option value="<?php echo e($value[0]->id); ?>"><?php echo e($value[0]->name); ?></option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <label id="test_config-error" class="error" for="test_config" hidden></label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php if($count >=1): ?>
                            <br>
                            <table id="example" class="display nowrap" style="width:100%;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Test Group Name</th>
                                    <th>Grouping</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $test_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(++$key); ?></td>
                                        <td>
                                            <?php if($value->groups == 1): ?>
                                                Intelligence Test
                                            <?php elseif($value->groups == 2): ?>
                                                Personality Test
                                            <?php elseif($value->groups == 3): ?>
                                                PSYM Test
                                            <?php endif; ?>
                                        </td>
                                        <?php $explode_test_list = explode('||', $value->test_config_id);?>
                                        <td>
                                            <?php $__currentLoopData = $explode_test_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $explode_test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php $__currentLoopData = $test_list_show; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($config->id == $explode_test): ?>
                                                        <span class="badge badge-info"><?php echo e($config->name); ?></span>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td class="text-center">
                                            <a><i class="livicon" data-name="trash" data-size="20" data-loop="true"  data-c="#EF6F61" data-hc="#EF6F61" title="Delete data" onclick=TestGroupDelete('<?php echo $value->id ?>');></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content -->

    <?php $__env->stopSection(); ?>

    
    <?php $__env->startSection('footer_scripts'); ?>

            <!-- For Editors -->


    <script language="javascript" type="text/javascript" src="<?php echo e(asset('DataTables/jquery.dataTables.min.js')); ?>"></script>
    <script language="javascript" type="text/javascript" src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
    <script>
        $(document).ready(function() {
            $(".select2").select2({
                theme:"bootstrap",
                placeholder:"Choose one",
                dropdownAutoWidth : true,
                width: 'auto'

            });
            if (sessionStorage.getItem('new_success') == 'success') {

                toastr.success('Test group has been successfully created', 'Success Alert', {timeOut: 5000});
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
            });

            $("#create_test_group").validate(
                    {
                        ignore: [],
                        debug: false,
                        rules: {},
                        messages: {},
                        submitHandler: function(form) {
                            $('.submit').text('Sending...');
                            $('.submit').prop('disabled', true);
                            var formData = new FormData($(form)[0]);
                            $.ajax({
                                type: "POST",
                                url: "<?php echo e(url('/')); ?>"+'/storeTestGroup',
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
                                        window.location.reload();
                                    }
                                },
                                error: function (e) {
                                    toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000})

                                }
                            });

                            return false;
                        }
                    });


         } );

        function TestGroupDelete(id)
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
                            url: "<?php echo e(url('/')); ?>"+'/destroyTestGroup/' + id,
                            method: 'DELETE',
                            headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                setTimeout(function () {
                                    swal({
                                                title: "Deleted!",
                                                text: "Test group has been deleted.",
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

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\issbv2\resources\views/test_group.blade.php ENDPATH**/ ?>