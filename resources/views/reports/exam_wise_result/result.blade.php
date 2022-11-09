@php
    use App\Http\Controllers\ExamWiseResultController;
@endphp
<style>
    .main_table .table_data_tbody tr>td {
        border: 1px solid #000000;
        text-align: center;
    }
</style>
<table class="main_table">
    <thead>
        <tr>
            <th style="text-align: center; border:1px solid #000;">Board</th>
            <th style="text-align: center; border:1px solid #000;">Chest</th>
            <th style="text-align: center; border:1px solid #000;">Exam</th>
            <th style="text-align: center; border:1px solid #000;">Date</th>
            <th style="text-align: center; border:1px solid #000;">Total Ques</th>
            <th style="text-align: center; border:1px solid #000;">Correct</th>
            <th style="text-align: center; border:1px solid #000;">Wrong</th>
            @foreach ($candidates as $key=>$candidate)
            @php
                $questions = ExamWiseResultController::examResult($candidate->id, $candidate->candidate_id)['results'];
            @endphp
            @foreach ($questions as $key=>$question)
                <th style="text-align: center; border:1px solid #000;">Q{{ $key+1 }}</th>
            @endforeach
            @endforeach
        </tr>
    </thead>
    <tbody class="table_data_tbody">
        @foreach ($candidates as $key=>$candidate)
        @php
            $totalQues = ExamWiseResultController::examResult($candidate->id, $candidate->candidate_id)['totalQues'];
            $totalCorrectQues = ExamWiseResultController::examResult($candidate->id, $candidate->candidate_id)['totalCorrectQues'];
            $totalWorongQues = $totalQues-$totalCorrectQues;
            $canResults = ExamWiseResultController::examResult($candidate->id, $candidate->candidate_id)['results'];
            $a ='0';
        @endphp
            <tr>
                <td style="text-align: center; border:1px solid #000;">{{ $candidate->board_no }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ $candidate->chest_no }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ $candidate->exam_name }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ ExamWiseResultController::dateFormatDmy($candidate->exam_date) }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ $totalQues }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ $totalCorrectQues }}</td>
                <td style="text-align: center; border:1px solid #000;">{{ $totalQues-$totalCorrectQues }}</td>

                @foreach ($canResults as $result)
                    <td style="text-align: center; border:1px solid #000;">{{ $result->answer_status==1? 1:'0.00'}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
