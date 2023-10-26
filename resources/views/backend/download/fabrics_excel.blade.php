<table id="cashesTable" style="border: 1px solid #000; padding: 4px; border-collapse: collapse; padding-top: 1em;">
    <thead style="border: 1px solid #000; padding: 4px;">
        <tr>
            <th colspan="19" style="text-align: center; border: none; ">

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
            <th style="border: 1px solid #000; padding: 4px;">Order Qty in Pcs</th>
            <th style="border: 1px solid #000; padding: 4px;">Fabric Type</th>
            <th style="border: 1px solid #000; padding: 4px;">Color Name</th> 
            <th style="border: 1px solid #000; padding: 4px;">Lot</th>
            <th style="border: 1px solid #000; padding: 4px;">Dia</th>
            <th style="border: 1px solid #000; padding: 4px;">GSM</th>
            <th style="border: 1px solid #000; padding: 4px;">Parts</th>
            <th style="border: 1px solid #000; padding: 4px;">Cons/DZ</th>   
            <th style="border: 1px solid #000; padding: 4px;">Booking (Kgs)</th>
            <th style="border: 1px solid #000; padding: 4px;">Rcv Qty(Kgs)</th>
            <th style="border: 1px solid #000; padding: 4px;">Rcv Bal (Kgs)</th>
            <th style="border: 1px solid #000; padding: 4px;">Dlv Cutting(kgs)</th>
            <th style="border: 1px solid #000; padding: 4px;">Closing Stock (Kgs)</th>
            <th style="border: 1px solid #000; padding: 4px;">Rack No</th>
            <th style="border: 1px solid #000; padding: 4px;">Self/Bin N0</th>
            <th style="border: 1px solid #000; padding: 4px;">Remarks</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #000; padding: 4px;">
        @foreach ($search_fabrics as $fabric)
            <tr>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ Carbon\Carbon::parse($fabric->date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->buyer_name }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->style_or_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->order_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->fabric_type }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->color_name }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->lot }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->dia }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->gsm }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->parts }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->cons_dz }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->booking_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->receive_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->rcv_bal_qty }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->dlv_cutting }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->closing_stock }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->rack_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->self_bin_no }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $fabric->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
