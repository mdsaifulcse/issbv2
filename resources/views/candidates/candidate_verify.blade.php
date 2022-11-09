@extends('candidates.layouts.default')

@section('content')
<div class="page-header">
    <div class="breadcrumb-line"></div>
</div>


<!-- Content area -->
<div class="content" style="max-width: 1600px; margin: auto;">
    <div class="panel panel-white">

        <div class="panel-body text-center">
            <div class="">
                <form method="POST" action="{{ route('candidate.postLogin') }}">
                        @csrf

                        <input type="hidden" name="candidate_id" value="{{ $userInfo->id }}">
                        <h1>Please verify the secret key</h1>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <input id="secret_key" type="text" class="form-control" name="secret_key" required autofocus placeholder="Secret Kay">

                                <span class="invalid-feedback text-danger" role="alert" @if($status==1) style="display: none;" @endif>
                                    <strong>{{ 'Please enter the correct secret key!' }}</strong>
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
        &copy; {{date('Y')}}. <a href="#">Developed</a> by <a href="#" target="_blank">Silver Eagle</a>
        <a href="#" class="open-modal secret_key" modal-title="Secret Key Check" modal-type="create" modal-size="medium" modal-class="" selector="viewResource" modal-link="{{route('candidate.secretKeyModal')}}"></a>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->
@endsection


@push('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            setInterval(function() {
                $('.invalid-feedback').hide();
            }, 5000);
        });

        
    </script>
@endpush
