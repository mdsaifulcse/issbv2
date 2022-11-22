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
                                                <option value="<?php echo e($test->id); ?>" <?php echo e($request->test_config_id==$test->id?"selected":""); ?>><?php echo e($test->test_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-lg-3">Test Date</label>
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

        

            
                
                    
                        
                            
                        
                    
                    
                        
                            
                            
                                
                                
                                
                                
                                
                                
                                
                                
                            
                            
                            
                            
                            
                                
                                
                                
                                
                                
                                
                                
                                    
                                    
                                    
                                    
                                    
                                
                                
                                    
                                    
                                        
                                    
                                    
                                    
                                        
                                    
                                    
                                    
                                
                            
                            
                            
                            
                            
                            
                        
                    
                
            
   
        

    </section>

    

    
        
          
            
              
                
                
                    
                    
                    
                
              
            
            
              
              
            
          
        
      

<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jequery-validation.js')); ?>"></script>

    
        
        
            
                
            
        
        
        

            
            
                
            

            
                
            

            
                
                
                
                
                
                
                    
                
            

            
                
                
                
            

            
                
                
                
                
                    
                    
                    
                    
                    
                        
                            
                            
                        
                            
                            
                        
                        
                    
                
            
        
    

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin/layouts/default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/testingOfficer/examConfig/create.blade.php ENDPATH**/ ?>