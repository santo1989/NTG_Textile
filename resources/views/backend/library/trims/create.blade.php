<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Trims & Accessories Store Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Trims & Accessories Store Information </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('trims.index') }}">Trims & Accessories Store  Information</a></li>
            <li class="breadcrumb-item active">Create Trims & Accessories Store  Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('trims.store') }}" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            @csrf
            <br>
            <div class="row pb-3">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ date('Y-m-d') }}" class="form-control">
                </div>

                {{-- @php
                    //last record

                    $last_record = App\Models\TrimsAccessoriesStore::latest()->first();
                    // dd( $last_record);
                    $last_record_id = $last_record->id ?? null;
                    // dd($last_record_id);
                    if ($last_record_id == !null) {
                        $last_record_id = $last_record->id;
                        $last_record_opening_qty = $last_record->stock_in_hand;
                        $last_record_received_qumilative_qty = $last_record->received_qumilative_qty;
                        $last_record_issue_qumilative_qty = $last_record->issue_qumilative_qty;
                    }

                @endphp --}}

                <div class="col-sm-4">
                    <label for="buyer_name">Buyer Name</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control"
                        placeholder="Buyer Name" required>

                </div>
                <div class="col-sm-4">
                    <label for="style_or_no">Style / Or No</label>
                    <input type="text" name="style_or_no" id="style_or_no" class="form-control"
                        placeholder="Style / Or No" required>
                </div>
                <div class="col-sm-4">
                    <label for="received_qty">Order Qty</label>
                    <input type="number" name="order_qty" id="order_qty" class="form-control" placeholder="Order Qty"
                        required>

                </div>
                <div class="col-sm-4">
                    <label for="item_no">Item No</label>
                    <input type="text" name="item_no" id="item_no" class="form-control" placeholder="Item No"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="color_name">Color Name </label>
                    <input type="text" name="color_name" id="color_name" class="form-control"
                        placeholder="Color Name " required>
                </div>
                <div class="col-sm-4">
                    <label for="unit">Unit</label>
                    <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit"
                        required>
                </div>


                <!-- Booking Qty -->
                <div class="col-sm-4">
                    <label for="booking_qty">Booking Qty</label>
                    <input type="text" name="booking_qty" id="booking_qty" class="form-control"
                        placeholder="Booking Qty" required>
                </div>

                <!-- Receive Qty -->
                <div class="col-sm-4">
                    <label for="receive_qty">Receive Qty</label>
                    <input type="text" name="receive_qty" id="receive_qty" class="form-control"
                        placeholder="Receive Qty" required>
                </div>

                <!-- Received Balance Qty -->
                <div class="col-sm-4">
                    <label for="rcv_bal_qty">Received Balance Qty</label>
                    <input type="text" name="rcv_bal_qty" id="rcv_bal_qty" class="form-control"
                        placeholder="Received Balance Qty" required readonly>

                </div>

                <!-- Issue Qty -->
                <div class="col-sm-4">
                    <label for="issue_qty">Issue Qty</label>
                    <input type="text" name="issue_qty" id="issue_qty" class="form-control" placeholder="Issue Qty"
                        required>
                </div>

                <!-- In Hand Qty -->
                <div class="col-sm-4">
                    <label for="in_hand_qty">In Hand Qty</label>
                    <input type="text" name="in_hand_qty" id="in_hand_qty" class="form-control"
                        placeholder="In Hand Qty" required readonly>

                </div>

                <!-- Rack No -->
                <div class="col-sm-4">
                    <label for="rack_no">Rack No</label>
                    <input type="text" name="rack_no" id="rack_no" class="form-control" placeholder="Rack No"
                        required>
                </div>

                <!-- Self Bin No -->
                <div class="col-sm-4">
                    <label for="self_bin_no">Self Bin No</label>
                    <input type="text" name="self_bin_no" id="self_bin_no" class="form-control"
                        placeholder="Self Bin No" required>
                </div>

                <!-- Remarks --> 
                <div class="col-sm-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea>
                </div>



                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                <script>
                    $(document).ready(function() {
                        $('#booking_qty, #receive_qty').on('input', function() {
                            var booking_qty = parseFloat($('#booking_qty').val()) || 0;
                            var receive_qty = parseFloat($('#receive_qty').val()) || 0;
                            var rcv_bal_qty = booking_qty - receive_qty;
                            $('#rcv_bal_qty').val(rcv_bal_qty.toFixed(2));
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        $('#receive_qty, #issue_qty').on('input', function() {
                            var receive_qty = parseFloat($('#receive_qty').val()) || 0;
                            var issue_qty = parseFloat($('#issue_qty').val()) || 0;
                            var in_hand_qty = receive_qty - issue_qty;
                            $('#in_hand_qty').val(in_hand_qty.toFixed(2));
                        });
                    });
                </script>
                <br>
                <br>
            </div>


            <div class="pb-3">
                 
                <a href="{{ route('trims.index') }}" class="btn btn-sm btn-outline-info">Back</a><x-backend.form.saveButton>Save</x-backend.form.saveButton>
            </div>

        </div>
    </form>
</x-backend.layouts.master>
