<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Trims & Accessories Store Information Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Trims & Accessories Store Information </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('trims.index') }}">Trims & Accessories Store  Information</a></li>
            <li class="breadcrumb-item active">Edit Trims & Accessories Store  Information Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('trims.update', ['trim' => $trim->id]) }}" method="post" enctype="multipart/form-data">


        <div class="container-fluid">
            @csrf
            @method('put')
            <br>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ $trim->date }}" class="form-control">
                </div>
                
                <div class="col-sm-4">
                    <label for="buyer_name">Buyer Name</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control"
                        placeholder="Buyer Name" required value="{{ $trim->buyer_name }}">

                </div>
                <div class="col-sm-4">
                    <label for="style_or_no">Style / Or No</label>
                    <input type="text" name="style_or_no" id="style_or_no" class="form-control"
                        placeholder="Style / Or No" required value="{{ $trim->style_or_no }}">
                </div>
                <div class="col-sm-4">
                    <label for="received_qty">Order Qty</label>
                    <input type="text" name="order_qty" id="order_qty" class="form-control" placeholder="Order Qty"
                        required value="{{ $trim->order_qty }}">

                </div>
                <div class="col-sm-4">
                    <label for="item_no">Item No</label>
                    <input type="text" name="item_no" id="item_no" class="form-control" placeholder="Item No"
                        required value="{{ $trim->item_no }}">
                </div>
                <div class="col-sm-4">
                    <label for="color_name">Color Name </label>
                    <input type="text" name="color_name" id="color_name" class="form-control"
                        placeholder="Color Name " required value="{{ $trim->color_name }}">
                </div>
                <div class="col-sm-4">
                    <label for="unit">Unit</label>
                    <input type="text" name="unit" id="unit" class="form-control" placeholder="Unit"
                        required value="{{ $trim->unit }}">
                </div>


                <!-- Booking Qty -->
                <div class="col-sm-4">
                    <label for="booking_qty">Booking Qty</label>
                    <input type="text" name="booking_qty" id="booking_qty" class="form-control"
                        placeholder="Booking Qty" required value="{{ $trim->booking_qty }}">
                </div>

                <!-- Receive Qty -->
                <div class="col-sm-4">
                    <label for="receive_qty">Receive Qty</label>
                    <input type="text" name="receive_qty" id="receive_qty" class="form-control"
                        placeholder="Receive Qty" required value="{{ $trim->receive_qty }}">
                </div>

                <!-- Received Balance Qty -->
                <div class="col-sm-4">
                    <label for="rcv_bal_qty">Received Balance Qty</label>
                    <input type="text" name="rcv_bal_qty" id="rcv_bal_qty" class="form-control"
                        placeholder="Received Balance Qty" required readonly value="{{ $trim->rcv_bal_qty }}">

                </div>

                <!-- Issue Qty -->
                <div class="col-sm-4">
                    <label for="issue_qty">Issue Qty</label>
                    <input type="text" name="issue_qty" id="issue_qty" class="form-control" placeholder="Issue Qty"
                        required value="{{ $trim->issue_qty }}">
                </div>

                <!-- In Hand Qty -->
                <div class="col-sm-4">
                    <label for="in_hand_qty">In Hand Qty</label>
                    <input type="text" name="in_hand_qty" id="in_hand_qty" class="form-control"
                        placeholder="In Hand Qty" required readonly value="{{ $trim->in_hand_qty }}">

                </div>

                <!-- Rack No -->
                <div class="col-sm-4">
                    <label for="rack_no">Rack No</label>
                    <input type="text" name="rack_no" id="rack_no" class="form-control" placeholder="Rack No"
                        required value="{{ $trim->rack_no }}">
                </div>

                <!-- Self Bin No -->
                <div class="col-sm-4">
                    <label for="self_bin_no">Self Bin No</label>
                    <input type="text" name="self_bin_no" id="self_bin_no" class="form-control"
                        placeholder="Self Bin No" required value="{{ $trim->self_bin_no }}">
                </div>

                <!-- Remarks -->
                 
                <div class="col-sm-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks">
                        {{ $trim->remarks }}
                    </textarea>
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
                <x-backend.form.saveButton>Save</x-backend.form.saveButton>
                <a href="{{ route('trims.index') }}" class="btn btn-sm btn-outline-info">Back</a>
            </div>

        </div>
    </form>
</x-backend.layouts.master>
