<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Knitting QC Data Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Knitting QC Data </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('qcs.index') }}">Knitting QC Data</a></li>
            <li class="breadcrumb-item active">Edit Knitting QC Data Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('qcs.update', ['qc' => $qcs->id]) }}" method="post" enctype="multipart/form-qcs">


        <div class="container-fluid">
            @csrf
            @method('put')
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Date</label>
                    <input name="date" type="date" value="{{ date('Y-m-d') }}" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="shift">Shift</label>
                    <select name="shift" id="shift" class="form-control" required>
                        <option value="">Select Shift</option>
                        <option value="A" {{ $qcs->shift == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $qcs->shift == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ $qcs->shift == 'C' ? 'selected' : '' }}>C</option>
                    </select>

                </div>
            </div>
            <br>
            <div class="row">

                <div class="col-md-4">
                    <label for="grade_a">Grade A</label>
                    <input name="grade_a" id="grade_a" type="number" class="form-control"
                        value="{{ $qcs->grade_a }}">
                </div>
                <div class="col-md-4">
                    <label for="grade_b">Grade B</label>
                    <input name="grade_b" id="grade_b" type="number" class="form-control"
                        value="{{ $qcs->grade_b }}">
                </div>
                <div class="col-md-4">
                    <label for="grade_c">Grade C</label>
                    <input name="grade_c" id="grade_c" type="number" class="form-control"
                        value="{{ $qcs->grade_c }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="rejection">Rejection</label>
                    <input name="rejection" type="number" id="rejection" class="form-control" placeholder="Rejection"
                        required value="{{ $qcs->rejection }}">
                </div>
                <div class="col-md-6">
                    <label for="precentage_rejection">Rejection %</label>
                    <input type="number" name="precentage_rejection" id="precentage_rejection" class="form-control"
                        placeholder="Rejection %" readonly value="{{ $qcs->precentage_rejection }}">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label for="total_check">Total Check</label>
                    <input type="number" name="total_check" id="total_check" class="form-control"
                        placeholder="Total Check" readonly value="{{ $qcs->total_check }}">
                </div>

                <div class="col-md-6">
                    <label for="qc_pass_qty">QC Pass Qty</label>
                    <input type="number" name="qc_pass_qty" id="qc_pass_qty" class="form-control"
                        placeholder="QC Pass Qty" readonly value="{{ $qcs->qc_pass_qty }}">
                </div>
            </div>

            

            <br>
            <br>

            <x-backend.form.saveButton>Save</x-backend.form.saveButton>



        </div>

    </form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#grade_a, #grade_b, #grade_c, #rejection').on('input', function() {
                        var grade_a = parseFloat($('#grade_a').val());
                        var grade_b = parseFloat($('#grade_b').val());
                        var grade_c = parseFloat($('#grade_c').val());
                        var rejection = parseFloat($('#rejection').val());

                        if (!isNaN(grade_a) && !isNaN(grade_b) && !isNaN(grade_c) && !isNaN(rejection)) {
                            var total_check = grade_a + grade_b + grade_c + rejection;
                            var precentage_rejection = (rejection * 100 / total_check).toFixed(2);
                            var qc_pass_qty = total_check - rejection;

                            $('#total_check').val(total_check.toFixed(2));
                            $('#precentage_rejection').val(precentage_rejection);
                            $('#qc_pass_qty').val(qc_pass_qty.toFixed(2));
                        } else {
                            $('#total_check').val('');
                            $('#precentage_rejection').val('');
                            $('#qc_pass_qty').val('');
                        }
                    });
                });
            </script>
</x-backend.layouts.master>
