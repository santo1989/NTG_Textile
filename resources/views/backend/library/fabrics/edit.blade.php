<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Fabric Information Board Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Fabric Information Board </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fabrics.index') }}">Trims & Accessories Store  Information</a></li>
            <li class="breadcrumb-item active">Edit Trims & Accessories Store  Information Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('fabrics.update', ['fabric' => $fabric->id]) }}" method="post" enctype="multipart/form-data">


        <div class="container-fluid">
            @csrf
            @method('put')
            <br>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ $fabric->date }}" class="form-control">
                </div>

                <div class="col-sm-4">
                    <label for="buyer_name">Buyer Name</label>
                    <input type="text" name="buyer_name" id="buyer_name" class="form-control"
                        placeholder="Buyer Name" required value="{{ $fabric->buyer_name }}">

                </div>
                <div class="col-sm-4">
                    <label for="style_or_no">Style / Or No</label>
                    <input type="text" name="style_or_no" id="style_or_no" class="form-control"
                        placeholder="Style / Or No" required value="{{ $fabric->style_or_no }}">
                </div>
                <div class="col-sm-4">
                    <label for="received_qty">Order Qty</label>
                    <input type="text" name="order_qty" id="order_qty" class="form-control" placeholder="Order Qty"
                        required value="{{ $fabric->order_qty }}">

                </div>
                <div class="col-sm-4">
                    <label for="fabric_type">Fabric Type</label>
                    <input type="text" name="fabric_type" id="fabric_type" class="form-control"
                        placeholder="Fabric Type" required value="{{ $fabric->fabric_type }}">
                </div>
                <div class="col-sm-4">
                    <label for="color_name">Color Name </label>
                    <input type="text" name="color_name" id="color_name" class="form-control"
                        placeholder="Color Name " required value="{{ $fabric->color_name }}">
                </div>
                <div class="col-sm-4">
                    <label for="lot">Lot</label>
                    <input type="text" name="lot" id="lot" class="form-control" placeholder="Lot" required
                        value="{{ $fabric->lot }}">
                </div>
                <div class="col-sm-4">
                    <label for="dia">Dia</label>
                    <input type="text" name="dia" id="dia" class="form-control" placeholder="Dia" required
                        value="{{ $fabric->dia }}">
                </div>
                <div class="col-sm-4">
                    <label for="gsm">GSM</label>
                    <input type="text" name="gsm" id="gsm" class="form-control" placeholder="Lot" required
                        value="{{ $fabric->gsm }}">
                </div>
                <div class="col-sm-4">
                    <label for="parts">Parts</label>
                    <input type="text" name="parts" id="parts" class="form-control" placeholder="Parts"
                        required value="{{ $fabric->parts }}">
                </div>
                <div class="col-sm-4">
                    <label for="cons_dz">Cons/DZ</label>
                    <input type="text" name="cons_dz" id="cons_dz" class="form-control" placeholder="Cons/DZ"
                        required value="{{ $fabric->cons_dz }}">
                </div>



                <!-- Booking Qty -->
                <div class="col-sm-4">
                    <label for="booking_qty">Booking Qty</label>
                    <input type="text" name="booking_qty" id="booking_qty" class="form-control"
                        placeholder="Booking Qty" required value="{{ $fabric->booking_qty }}">
                </div>

                <!-- Receive Qty -->
                <div class="col-sm-4">
                    <label for="receive_qty">Receive Qty</label>
                    <input type="text" name="receive_qty" id="receive_qty" class="form-control"
                        placeholder="Receive Qty" required value="{{ $fabric->receive_qty }}">
                </div>

                <!-- Received Balance Qty -->
                <div class="col-sm-4">
                    <label for="rcv_bal_qty">Received Balance Qty</label>
                    <input type="text" name="rcv_bal_qty" id="rcv_bal_qty" class="form-control"
                        placeholder="Received Balance Qty" required readonly value="{{ $fabric->rcv_bal_qty }}">

                </div>

                <!--  Dlv Cutting(kgs) -->
                <div class="col-sm-4">
                    <label for="dlv_cutting"> Dlv Cutting(kgs)</label>
                    <input type="text" name="dlv_cutting" id="dlv_cutting" class="form-control"
                        placeholder=" Dlv Cutting(kgs)" required value="{{ $fabric->dlv_cutting }}">
                </div>

                <!-- In Hand Qty -->
                <div class="col-sm-4">
                    <label for="closing_stock">In Hand Qty</label>
                    <input type="text" name="closing_stock" id="closing_stock" class="form-control"
                        placeholder="In Hand Qty" required readonly value="{{ $fabric->closing_stock }}">

                </div>

                <!-- Rack No -->
                <div class="col-sm-4">
                    <label for="rack_no">Rack No</label>
                    <input type="text" name="rack_no" id="rack_no" class="form-control" placeholder="Rack No"
                        required value="{{ $fabric->rack_no }}">
                </div>

                <!-- Self Bin No -->
                <div class="col-sm-4">
                    <label for="self_bin_no">Self Bin No</label>
                    <input type="text" name="self_bin_no" id="self_bin_no" class="form-control"
                        placeholder="Self Bin No" required value="{{ $fabric->self_bin_no }}">
                </div>

                <!-- Remarks -->

                <div class="col-sm-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks">
                        {{ $fabric->remarks }}
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
                        $('#receive_qty, #dlv_cutting').on('input', function() {
                            var receive_qty = parseFloat($('#receive_qty').val()) || 0;
                            var dlv_cutting = parseFloat($('#dlv_cutting').val()) || 0;
                            var closing_stock = receive_qty - dlv_cutting;
                            $('#closing_stock').val(closing_stock.toFixed(2));
                        });
                    });
                </script>
                <br>
                <br>
            </div>


            <div class="p-3">
                <x-backend.form.saveButton>Update</x-backend.form.saveButton>
                <a href="{{ route('fabrics.index') }}" class="btn btn-sm btn-outline-info">Back</a>
            </div>

        </div>
    </form>
</x-backend.layouts.master>
