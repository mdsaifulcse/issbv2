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