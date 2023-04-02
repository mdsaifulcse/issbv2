
<form method="post" action="{{ route('result-config') }}" id="create_set"><div class="modal-header">
        {{ csrf_field() }}
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Test name : {{$testConfig->test_name}}, Text for: {{$testConfig->testFor->name}},  Total Item: {{$testConfig->total_item}}</h4>
    </div>
    <div class="modal-body">

        <input type="hidden" name="test_id" value="{{$testConfig->testFor->id}}"/>
        <input type="hidden" name="test_config_id" value="{{$testConfig->id}}"/>
        <table class="table table-border table-hover table-striped">
            <thead>
            <tr>
                <th>SL </th>
                <th>Raw Score</th>
                <th>Estimated Score</th>
            </tr>
            </thead>

            <tbody>
            @if($totalItems>0)
                @for($i = 0; $i < $totalItems; $i++)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td><input type='number' name='raw_score[]' value="{{ $i}}" min='0' max='999' placeholder='Raw Score' class='raw-score' style="width:120px;" required /> </td>
                        <td><input type='number' name='estimated_score[]' min='0' max='999999' placeholder='Estimated Score'   style="width:130px;" required/> </td>
                    </tr>
                @endfor
            @else
                <tr>
                    <td colspan='3' style="text-align:center">No Test Config Data Found</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>