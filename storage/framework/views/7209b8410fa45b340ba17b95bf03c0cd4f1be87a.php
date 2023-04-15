
<form method="post" action="<?php echo e(route('result-config')); ?>" id="create_set"><div class="modal-header">
        <?php echo e(csrf_field()); ?>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Test name : <?php echo e($testConfig->test_name); ?>, Text for: <?php echo e($testConfig->testFor->name); ?>,  Total Item: <?php echo e($testConfig->total_item); ?></h4>
    </div>
    <div class="modal-body">

        <input type="hidden" name="test_id" value="<?php echo e($testConfig->testFor->id); ?>"/>
        <input type="hidden" name="test_config_id" value="<?php echo e($testConfig->id); ?>"/>
        <table class="table table-border table-hover table-striped">
            <thead>
            <tr>
                <th>SL </th>
                <th>Raw Score</th>
                <th>Estimated Score</th>
            </tr>
            </thead>

            <tbody>
            <?php if($totalItems>0): ?>
                <?php for($i = 0; $i < $totalItems; $i++): ?>
                    <tr>
                        <td><?php echo e($i+1); ?></td>
                        <td><input type='number' name='raw_score[]' value="<?php echo e($i); ?>" min='0' max='999' placeholder='Raw Score' class='raw-score' style="width:120px;" required /> </td>
                        <td><input type='number' name='estimated_score[]' min='0' max='999999' placeholder='Estimated Score'   style="width:130px;" required/> </td>
                    </tr>
                <?php endfor; ?>
            <?php else: ?>
                <tr>
                    <td colspan='3' style="text-align:center">No Test Config Data Found</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form><?php /**PATH C:\laragon\www\issbv2\resources\views/load_test_result_config.blade.php ENDPATH**/ ?>