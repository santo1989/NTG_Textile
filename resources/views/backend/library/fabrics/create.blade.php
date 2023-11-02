<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Fabric Information Board
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Fabric Information Board </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fabrics.index') }}">Trims & Accessories Store  Information</a></li>
            <li class="breadcrumb-item active">Create Trims & Accessories Store  Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('fabrics.store') }}" method="post" enctype="multipart/form-data">
        <div class="container-fluid">
            @csrf
            <br>
            <div class="row pb-3">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ date('Y-m-d') }}" class="form-control">
                </div> 
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
                    <label for="received_qty">Order Qty Pcs</label>
                    <input type="text" name="order_qty" id="order_qty" class="form-control" placeholder="Order Qty"
                        required>

                </div>
                <div class="col-sm-4">
                    <label for="fabric_type">Fabric Type</label>
                    <input type="text" name="fabric_type" id="fabric_type" class="form-control" placeholder="Fabric Type"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="color_name">Color Name </label>
                    <input type="text" name="color_name" id="color_name" class="form-control"
                        placeholder="Color Name " required>
                </div>
                <div class="col-sm-4">
                    <label for="lot">Lot</label>
                    <input type="text" name="lot" id="lot" class="form-control" placeholder="Lot"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="dia">Dia</label>
                    <input type="text" name="dia" id="dia" class="form-control" placeholder="Dia"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="gsm">GSM</label>
                    <input type="text" name="gsm" id="gsm" class="form-control" placeholder="Lot"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="parts">Parts</label>
                    <input type="text" name="parts" id="parts" class="form-control" placeholder="Parts"
                        required>
                </div>
                <div class="col-sm-4">
                    <label for="cons_dz">Cons/DZ</label>
                    <input type="text" name="cons_dz" id="cons_dz" class="form-control" placeholder="Cons/DZ"
                        required>
                </div>

                <!-- Booking Qty (kgs)-->
                <div class="col-sm-4">
                    <label for="booking_qty">Booking Qty (kgs)</label>
                    <input type="text" name="booking_qty" id="booking_qty" class="form-control"
                        placeholder="Booking Qty" required>
                </div>

                <!-- Receive Qty (kgs)-->
                <div class="col-sm-4">
                    <label for="receive_qty">Receive Qty (kgs)</label>
                    <input type="text" name="receive_qty" id="receive_qty" class="form-control"
                        placeholder="Receive Qty" required>
                </div>

                <!-- Received Balance Qty (kgs) -->
                <div class="col-sm-4">
                    <label for="rcv_bal_qty">Received Balance Qty (kgs)</label>
                    <input type="text" name="rcv_bal_qty" id="rcv_bal_qty" class="form-control"
                        placeholder="Received Balance Qty" required readonly>

                </div>

                <!--  Dlv Cutting(kgs) -->
                <div class="col-sm-4">
                    <label for="dlv_cutting"> Dlv Cutting(kgs)</label>
                    <input type="text" name="dlv_cutting" id="dlv_cutting" class="form-control" placeholder=" Dlv Cutting(kgs)"
                        required>
                </div>

                <!-- In Hand Qty -->
                <div class="col-sm-4">
                    <label for="closing_stock">In Hand Qty</label>
                    <input type="text" name="closing_stock" id="closing_stock" class="form-control"
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


                <!-- <script>
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
                </script> -->

              

                <br>
                <br>
            </div>


            <div class="pb-3">

                <a href="{{ route('fabrics.index') }}"
                    class="btn btn-sm btn-outline-info">Back</a><x-backend.form.saveButton>Save</x-backend.form.saveButton>
            </div>

        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $('#booking_qty, #receive_qty').on('input', function() {
            var booking_qty = parseFloat($('#booking_qty').val()) || 0;
            var receive_qty = parseFloat($('#receive_qty').val()) || 0;
            

            // Check if the result is negative
            if (booking_qty < receive_qty) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'You cannot input higher than Booking'
                });
                $('#receive_qty').val(''); // Clear the booking_qty field
            }
var rcv_bal_qty = booking_qty - receive_qty;
            $('#rcv_bal_qty').val(rcv_bal_qty.toFixed(2));
        });

        $('#receive_qty, #dlv_cutting').on('input', function() {
            var receive_qty = parseFloat($('#receive_qty').val()) || 0;
            var dlv_cutting = parseFloat($('#dlv_cutting').val()) || 0;
           

            // Check if the result is negative
            if (receive_qty < dlv_cutting) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'You cannot input higher than Received'
                });
                $('#dlv_cutting').val(''); // Clear the dlv_cutting field
            }
 var closing_stock = receive_qty - dlv_cutting;
            $('#closing_stock').val(closing_stock.toFixed(2));
        });
    });
</script>

</x-backend.layouts.master>
