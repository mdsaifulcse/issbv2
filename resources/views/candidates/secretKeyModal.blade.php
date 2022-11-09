<style>
    .modal-header .bootbox-close-button.close {
        display: none !important;
    }
    .modal-footer .btn-default {
        display: none !important;
    }
</style>
<div class="panel panel-flat">
    <div class="panel-body" id="modal-container">
        <form class="form-horizontal form-validate-jquery" action="{{route('candidate.secretKeyCheck')}}" method="POST">
        @csrf
            <fieldset class="content-group">
                <!-- Basic text input -->
                <div class="form-group">
                    <label class="control-label col-lg-3">Secret Key <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" name="secret_key" class="form-control" required="required">
                    </div>
                </div>
                <!-- Basic text input -->

            </fieldset>
        </form>
    </div>
</div>

