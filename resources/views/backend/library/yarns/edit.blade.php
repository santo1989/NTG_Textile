<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Warehouse Stock Yarns Information Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Warehouse Stock Yarns Information </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('yarns.index') }}">Warehouse Stock Yarns Information</a></li>
            <li class="breadcrumb-item active">Edit Warehouse Stock Yarns Information Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('yarns.update', ['yarn' => $yarn->id]) }}" method="post" enctype="multipart/form-data">


        <div class="container-fluid">
            @csrf
            @method('put')
            <br>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ $yarn->date }}" class="form-control">
                </div>
                <div class="col-sm-4">
                    <label for="opening_qty">Opening Qty</label>
                    <input type="text" name="opening_qty" id="opening_qty" class="form-control"
                        value="{{ $yarn->opening_qty }}" placeholder="Opening Qty" required readonly>
                </div>
                <div class="col-sm-4">
                    <label for="received_qty">Received Qty</label>
                    <input type="text" name="received_qty" id="received_qty" class="form-control"
                        value="{{ $yarn->received_qty }}" placeholder="Received Qty" required>
                    <input type="hidden" name="old_received_qty" id="old_received_qty" class="form-control"
                        value="{{ $yarn->received_qty }}" placeholder="Received Qty" required readonly>
                </div>
                <div class="col-sm-4">
                    <label for="received_qumilative_qty">Received Cumulative Qty</label>
                    <input type="text" name="received_qumilative_qty" id="received_qumilative_qty"
                        class="form-control" value="{{ $yarn->received_qumilative_qty }}"
                        placeholder="Received Cumulative Qty" required readonly>

                    <input type="hidden" name="last_record_closing_qumilative_qty"
                        id="last_record_closing_qumilative_qty" class="form-control"
                        value="{{ $yarn->received_qumilative_qty }}" placeholder="Received Cumulative Qty" required
                        readonly>
                </div>
                <div class="col-sm-4">
                    <label for="issue_qty">Issue Qty</label>
                    <input type="text" name="issue_qty" id="issue_qty" class="form-control"
                        value="{{ $yarn->issue_qty }}" placeholder="Issue Qty" required>

                    <input type="hidden" name="old_issue_qty" id="old_issue_qty" class="form-control"
                        value="{{ $yarn->issue_qty }}" placeholder="Issue Qty" required readonly>
                </div>
                <div class="col-sm-4">
                    <label for="issue_qumilative_qty">Issue Cumulative Qty</label>
                    <input type="text" name="issue_qumilative_qty" id="issue_qumilative_qty" class="form-control"
                        value="{{ $yarn->issue_qumilative_qty }}" placeholder="Issue Cumulative Qty" required readonly>

                    <input type="hidden" name="last_record_issue_qumilative_qty" id="last_record_issue_qumilative_qty"
                        class="form-control" value="{{ $yarn->issue_qumilative_qty }}"
                        placeholder="Issue Cumulative Qty" required readonly>
                </div>
                <div class="col-sm-4">
                    <label for="stock_in_hand">Stock in Hand</label>
                    <input type="text" name="stock_in_hand" id="stock_in_hand_with_old" class="form-control"
                        value="{{ $yarn->stock_in_hand }}" placeholder="Stock in Hand" required readonly>
                </div>
                <div class="col-sm-4">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks">{{ $yarn->remarks }}</textarea>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#received_qty, #issue_qty').on('input', function() {
                        var received_qty = parseFloat($('#received_qty').val()) || 0;
                        var last_record_closing_qumilative_qty = parseFloat($('#last_record_closing_qumilative_qty')
                            .val()) || 0;
                        var issue_qty = parseFloat($('#issue_qty').val()) || 0;
                        var last_record_issue_qumilative_qty = parseFloat($('#last_record_issue_qumilative_qty')
                            .val()) || 0;

                        var old_received_qty = parseFloat($('#old_received_qty').val()) || 0;
                        var old_issue_qty = parseFloat($('#old_issue_qty').val()) || 0;

                        var received_qty = received_qty - old_received_qty;
                        var issue_qty = issue_qty - old_issue_qty;

                        var received_qumilative_qty = received_qty + last_record_closing_qumilative_qty;
                        var issue_qumilative_qty = issue_qty + last_record_issue_qumilative_qty;
                        var stock_in_hand_with_old = received_qumilative_qty - issue_qumilative_qty;
                        $('#received_qumilative_qty').val(received_qumilative_qty);
                        $('#issue_qumilative_qty').val(issue_qumilative_qty);
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
