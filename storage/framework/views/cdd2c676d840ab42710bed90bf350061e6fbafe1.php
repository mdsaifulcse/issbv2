<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'ISSB')); ?></title>

    <!-- Favicon -->
    <link href="<?php echo e(asset('assets/images/issb-logo.png')); ?>" rel="shortcut icon" type="image/x-icon"/>


	<!-- Global stylesheets -->
	
	<link href="<?php echo e(asset('backend/assets/css/icons/icomoon/styles.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/core.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/components.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('backend/assets/css/minified/colors.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <link href="<?php echo e(asset('web/css/custom.css')); ?>" rel="stylesheet" type="text/css"/>

    <style>
        .add-new {
            color: #fff!important;
        }
        .add-new:hover {
            opacity: 1 !important;
        }
        .panel>.dataTables_wrapper .table-bordered, .panel-body>.dataTables_wrapper .table-bordered {
            border: 1px solid #ddd;
        }
        .dataTables_length {
            margin: 20px 0 20px 20px;
        }
        .dataTables_filter {
            margin: 20px 0 20px 20px;
        }
        .dataTables_info {
            margin-bottom: 20px;
        }
        .dataTables_paginate {
            margin: 20px 0 20px 20px;
        }
        .action-icon {
            padding: 0px 10px 0 0;
        }

        .kv-fileinput-upload {
            display: none;
        }


        .navbar-nav > .user-menu > .dropdown-menu > li.user-header {
            padding: 6% 30% 6% 25%;
        }
        .navbar-nav > .user-menu > .dropdown-menu > li.user-header {
            height: auto;
            width: 200px;
            overflow-x: hidden;
            padding: 6%;
            background: #3c8dbc;
            text-align: center;
        }
        .navbar-nav > .user-menu > .dropdown-menu > li.user-header > img {
            z-index: 5;
            height: 90px;
            width: 90px;
            border: 8px solid;
            border-color: rgba(255, 255, 255, 0.2);
        }
        .navbar-nav > .user-menu > .dropdown-menu > li.user-header > p {
            z-index: 5;
            color: #f9f9f9;
            color: rgba(255, 255, 255, 0.8);
            font-size: 17px;
            margin-top: 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar-nav>.dropdown-user img {
            max-height: none;
            margin-top: none;
            border-radius: none;
        }


    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="navbar-top-md-xs sidebar-xs has-detached-left" id="full-screen-area">
    <div id="app">
        <!-- Main navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-header" style="margin-left: 0;">
                <a class="navbar-brand" href="<?php echo e(route('candidate.dashboard')); ?>" style="height: 50px; padding: 6px 20px;"><img src="<?php echo e(asset('assets/images/issb-logo.png')); ?>" alt="" style="height: 35px;"></a>

                <ul class="nav navbar-nav pull-right visible-xs-block">
                    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                </ul>
            </div>

            <?php if(Auth::guard('candAuth')->check()): ?>
            <div class="navbar-collapse collapse" id="navbar-mobile" style="width: 50%; height: auto; margin: 0 auto; text-align: center; padding-top: 15px;">
                <span style="font-size: 14px; font-weight: bold">Name: <?php echo e(@$userInfo->name); ?> Chest: <?php echo e($userInfo->chest_no); ?></span>
                
            </div>
            <?php endif; ?>
        </div>
        <!-- /main navbar -->

        <!-- Page container -->
        <div class="page-container">

            <!-- Page content -->
            <div class="page-content">

                <!-- Main content -->
                <div class="content-wrapper">

                    <?php echo $__env->yieldContent('content'); ?>
                    <!-- <button class="btn btn-lg btn-success full-screen-btn">Full Screen</button> -->

                </div>
                <!-- /main content -->

            </div>
            <!-- /page content -->
        </div>
        <!-- /page container -->
    </div>

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/loaders/pace.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/popper.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/bootstrap.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/bootbox.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/bootbox.locales.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/loaders/blockui.min.js')); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/tables/datatables/datatables.min.js')); ?>"></script>

    <!-- Horizontal Navbar JS files -->
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/ui/drilldown.js')); ?>"></script>


    <!-- Sweet Alert JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/notifications/sweet_alert.min.js')); ?>"></script>

    <!-- Form JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/validation/validate.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/selects/bootstrap_multiselect.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/inputs/touchspin.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/libraries/jquery_ui/interactions.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/switch.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/switchery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
    <!-- Form JS files -->

    <!-- Uploader JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/plugins/uploaders/fileinput.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/core/app.js')); ?>"></script>

    <!-- Form Validation JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/form_validation.js')); ?>"></script>

    <!-- Select2 JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/form_select2.js')); ?>"></script>

    <!-- Uploader JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/pages/uploader_bootstrap.js')); ?>"></script>

    <!-- /Custom JS files -->
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/js/custom_frame.js')); ?>"></script>

    <!-- Per Page JS files -->
    <?php echo $__env->yieldPushContent('javascript'); ?>
    <!-- /Per Page JS files -->

    <!-- <script type="text/javascript">
        var elem = document.getElementById("full-screen-area");
        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen(); 
            } else if (elem.webkitRequestFullscreen) { /* Safari */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE11 */
                elem.msRequestFullscreen();
            }
        }
        

        $('.full-screen-btn').on('click', function(){
            openFullscreen();
        });         
    </script> -->

</body>
</html>
<?php /**PATH D:\xampp74\htdocs\issbv2\resources\views/candidates/layouts/default.blade.php ENDPATH**/ ?>