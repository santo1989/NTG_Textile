<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Wearhouse Stock Grey Fabrics Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Wearhouse Stock Grey Fabrics Information </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grey_fabrics.index') }}">Wearhouse Stock Grey Fabrics Information</a></li>
            <li class="breadcrumb-item active">Create Wearhouse Stock Grey Fabrics Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('grey_fabrics.store') }}" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            @csrf
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ date('Y-m-d') }}" class="form-control" >
                </div>
                @php
                    //last record

                    $last_record = App\Models\GreyDashboard::latest()->first();
                    // dd( $last_record);
                    $last_record_id = $last_record->id ?? null;
                    // dd($last_record_id);
                    if ($last_record_id == !null) {
                        $last_record_id = $last_record->id;
                        $last_record_opening_qty = $last_record->stock_in_hand;
                        $last_record_received_qumilative_qty = $last_record->received_qumilative_qty;
                        $last_record_issue_qumilative_qty = $last_record->issue_qumilative_qty;
                    }

                @endphp
                @if ($last_record_id == null)
                    <div class="col-sm-4">
                        <label for="opening_qty">Opening Qty</label>
                        <input type="text" name="opening_qty" id="opening_qty" class="form-control"
                            placeholder="opening qty" required>

                    </div>
                @else
                    <div class="col-sm-4">
                        <label for="opening_qty">Opening Qty</label>
                        <input type="text" name="opening_qty" id="opening_qty" class="form-control"
                            value="{{ $last_record_opening_qty }}" placeholder="opening qty" required readonly>
                    </div>
                @endif
                <div class="col-sm-4">
                    <label for="received_qty">Received Qty</label>
                    <input type="text" name="received_qty" id="received_qty" class="form-control"
                        placeholder="opening qty" required>

                </div>
                @if ($last_record_id == null)
                    <div class="col-sm-4">
                        <label for="received_qumilative_qty">Received Qumilative Qty</label>
                        <input type="text" name="received_qumilative_qty" id="received_qumilative_qty"
                            class="form-control" placeholder="Received Qumilative Qty" required>
                    </div>
                @else
                    <div class="col-sm-4">
                        <label for="received_qumilative_qty">Received Qumilative Qty</label>
                        <input type="text" name="received_qumilative_qty" id="received_qumilative_qty"
                            class="form-control" value="" placeholder="Received Qumilative Qty" required readonly>
                        <input type="hidden" name="last_record_closing_qumilative_qty"
                            id="last_record_closing_qumilative_qty" class="form-control"
                            value="{{ $last_record_received_qumilative_qty }}" placeholder="Received Qumilative Qty"
                            required readonly>

                    </div>
                @endif
                <div class="col-sm-4">
                    <label for="issue_qty">Issue Qty</label>
                    <input type="text" name="issue_qty" id="issue_qty" class="form-control" placeholder="Issue Qty"
                        required>
                </div>
                @if ($last_record_id == null)
                    <div class="col-sm-4">
                        <label for="issue_qumilative_qty">Issue Qumilative Qty</label>
                        <input type="text" name="issue_qumilative_qty" id="issue_qumilative_qty" class="form-control"
                            placeholder="Issue Qumilative Qty" required>


                    </div>
                @else
                    <div class="col-sm-4">
                        <label for="issue_qumilative_qty">Issue Qumilative Qty</label>
                        <input type="text" name="issue_qumilative_qty" id="issue_qumilative_qty" class="form-control"
                            value="" placeholder="Issue Qumilative Qty" required readonly>
                        <input type="hidden" name="last_record_issue_qumilative_qty"
                            id="last_record_issue_qumilative_qty" class="form-control"
                            value="{{ $last_record_issue_qumilative_qty }}" placeholder="Issue Qumilative Qty" required
                            readonly>

                    </div>
                @endif
                @if ($last_record_id == null)
                    <div class="col-sm-4">
                        <label for="stock_in_hand">Stock in Hand</label>
                        <input type="text" name="stock_in_hand" id="stock_in_hand_normal" class="form-control"
                            placeholder="Stock in Hand" required readonly>

                    </div>
                @else

                <div class="col-sm-4">
                    <label for="stock_in_hand">Stock in Hand</label>
                    <input type="text" name="stock_in_hand" id="stock_in_hand_with_old" class="form-control"
                        placeholder="Stock in Hand" required readonly>

                </div>
                @endif
                <div class="col-sm-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea>
                </div>

            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('#received_qty').on('input', function() {
                        var received_qty = parseFloat($('#received_qty').val());
                        // console.log(received_qty);
                        var last_record_closing_qumilative_qty = parseFloat($('#last_record_closing_qumilative_qty')
                            .val());
                        // console.log(last_record_closing_qumilative_qty);
                        if (!isNaN(received_qty) && !isNaN(last_record_closing_qumilative_qty)) {
                            var result = received_qty + last_record_closing_qumilative_qty;
                            $('#received_qumilative_qty').val(result.toFixed(2));
                        } else {
                            $('#received_qumilative_qty').val('');
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#issue_qty').on('input', function() {
                        var issue_qty = parseFloat($('#issue_qty').val());
                        var last_record_closing_qumilative_qty = parseFloat($('#last_record_issue_qumilative_qty')
                            .val());
                        if (!isNaN(issue_qty) && !isNaN(last_record_closing_qumilative_qty)) {
                            var result = issue_qty + last_record_closing_qumilative_qty;
                            $('#issue_qumilative_qty').val(result.toFixed(2));
                        } else {
                            $('#issue_qumilative_qty').val('');
                        }
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#received_qumilative_qty, #issue_qumilative_qty').on('input', function() {
                        var received_qumilative_qty = parseFloat($('#received_qumilative_qty').val());
                        var issue_qumilative_qty = parseFloat($('#issue_qumilative_qty').val());
                        if (!isNaN(received_qumilative_qty) && !isNaN(issue_qumilative_qty)) {
                            var result = received_qumilative_qty - issue_qumilative_qty;
                            $('#stock_in_hand_normal').val(result.toFixed(2));
                        } else {
                            $('#stock_in_hand_normal').val('');
                        }
                    });
                });
            </script> 
            
<script>
    $(document).ready(function() {
        $('#received_qty, #issue_qty').on('input', function() {
            var received_qty = parseFloat($('#received_qty').val()) || 0;
            var last_record_closing_qumilative_qty = parseFloat($('#last_record_closing_qumilative_qty').val()) || 0;
            var issue_qty = parseFloat($('#issue_qty').val()) || 0;
            var last_record_issue_qumilative_qty = parseFloat($('#last_record_issue_qumilative_qty').val()) || 0;

            var received_qumilative_qty = received_qty + last_record_closing_qumilative_qty;
            var issue_qumilative_qty = issue_qty + last_record_issue_qumilative_qty;
            var stock_in_hand_with_old = received_qumilative_qty - issue_qumilative_qty;

            $('#received_qumilative_qty').val(received_qumilative_qty.toFixed(2));
            $('#issue_qumilative_qty').val(issue_qumilative_qty.toFixed(2));
            $('#stock_in_hand_with_old').val(stock_in_hand_with_old.toFixed(2));
        });
    });
</script>




            <br>
            <br>

            <x-backend.form.saveButton>Save</x-backend.form.saveButton>



        </div>
    </form>
</x-backend.layouts.master>
