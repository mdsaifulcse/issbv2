@extends('candidates.layouts.default')


@section('content')

<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            <h4><span class="text-semibold">Selection Board</h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Photo</span></a>
            </div>
        </div>

        <div class="text-center">
            <div style="border-bottom: 1px solid #dddddd;">
                <span style="font-size: 18px;">Welcome! <strong style="font-size: 24px; letter-spacing: 2px;">{{$userInfo->name}} Chest no: 101</strong></span>
            </div>
        </div>
        <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
    </div>

    <div class="breadcrumb-line"></div>
</div>


<!-- Content area -->
<div class="content" style="max-width: 1600px; margin: auto;">

    <div class="text-right">
        <a class="btn btn-lg btn-success mb-10" id="refresh" href="#" role="button">Refresh</a>
    </div>

    <div class="panel panel-body border-top-primary">
        <h4 class="media-heading text-semibold text-center">Introduction</h4>
        <h6 class="no-margin text-semibold mb-5">Total Question: 65 And Duration: 60 </h6>
        <p class="content-group-sm text-muted">Basic modal dialog with header, body and footer areas. Default examples displays: header - contains a title and a close button; footer - contains buttons and body contains static or dynamic content</p>
        <a href="#"><button type="button" class="btn btn-primary btn-sm pull-right" id="h-fill-basic-start">Start Assessment</button></a>
    </div>


    <!-- Footer -->
    <div class="footer text-muted">
        &copy; {{date('Y')}}. <a href="#">Developed</a> by <a href="#" target="_blank">Silvereagle</a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
@endsection


@push('javascript')
    <script type="text/javascript">
        $('#refresh').click(function() {
            location.reload();
        });
    </script>
@endpush
