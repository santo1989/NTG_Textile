<table id="cashesTable" style="border: 1px solid #000; padding: 4px; border-collapse: collapse; padding-top: 1em;">
    <thead style="border: 1px solid #000; padding: 4px;">
        <tr>
            <th colspan="8" style="text-align: center; border: none; ">

                <span style="font-size: 24px; float: left;">Tosrifa Industries Ltd.</span><br>
                <span style="float: right; font-size: 14px">121/1, Beraierchala, Sreepur, Gazipur.</span><br>
                <span style="float: right; font-size: 10px">Download Date:
                    {{ Carbon\Carbon::now()->format('d-M-Y') }}</span>
            </th>
        </tr>
        <tr>
            <th style="border: 1px solid #000; padding: 4px;">Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Opening Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Received Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Received Qumulative Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Issue Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Issue Qumulative Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Stock in Hand</th>
            <th style="border: 1px solid #000; padding: 4px;">Remarks</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #000; padding: 4px;">
        @foreach ($search_grey as $yarn)
            <tr>
                <td style="border: 1px solid #000; padding: 4px;">{{ Carbon\Carbon::parse($yarn->date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->opening_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->received_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->received_qumilative_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->issue_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->issue_qumilative_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->stock_in_hand }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
