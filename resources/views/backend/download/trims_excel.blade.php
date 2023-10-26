<table id="cashesTable" style="border: 1px solid #000; padding: 4px; border-collapse: collapse; padding-top: 1em;">
    <thead style="border: 1px solid #000; padding: 4px;">
        <tr>
            <th colspan="15" style="text-align: center; border: none; ">

                <span style="font-size: 24px; float: left;">Tosrifa Industries Ltd.</span><br>
                <span style="float: right; font-size: 14px">121/1, Beraierchala, Sreepur, Gazipur.</span><br>
                <span style="float: right; font-size: 10px">Download Date:
                    {{ Carbon\Carbon::now()->format('d-M-Y') }}</span>
            </th>
        </tr>
        <tr>
            <th style="border: 1px solid #000; padding: 4px;">Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Buyer Name</th>
            <th style="border: 1px solid #000; padding: 4px;">Style / Or No</th>
            <th style="border: 1px solid #000; padding: 4px;">Order Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Item No</th>
            <th style="border: 1px solid #000; padding: 4px;">Color Name</th>
            <th style="border: 1px solid #000; padding: 4px;">Unit</th>
            <th style="border: 1px solid #000; padding: 4px;">Booking Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Received Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Rcv Bal Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Issue Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">In hand Qty</th>
            <th style="border: 1px solid #000; padding: 4px;">Rack No</th>
            <th style="border: 1px solid #000; padding: 4px;">Self/Bin N0</th>
            <th style="border: 1px solid #000; padding: 4px;">Remarks</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #000; padding: 4px;">
        @foreach ($search_trims as $yarn)
            <tr>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ Carbon\Carbon::parse($yarn->date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->buyer_name }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->style_or_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->order_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->item_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->color_name }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->unit }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->booking_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->receive_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->rcv_bal_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->issue_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->in_hand_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->rack_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->self_bin_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $yarn->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
