<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit CPB Production Data Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> CPB Production Data </x-slot>
            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cpbs.index') }}">CPB Production Data</a></li>
            <li class="breadcrumb-item active">Edit CPB Production Data Information</li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('cpbs.update', ['division' => $cpbs->id]) }}" method="post" enctype="multipart/form-data">
        
            
<div class="container-fluid">
    @csrf
    @method('put')
    <br>
    <div class="row">
        <div class="col-md-6">
            <label for="date">Date</label>
            <input name="date" type="date" value="{{ $data->date }}" class="form-control" readonly>
        </div>
        <div class="col-md-6">
            <label for="mc_no">M/c No</label>
            <input type="text" name="mc_no" id="mc_no" class="form-control" value="{{ $data->mc_no }}" placeholder="M/c No" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="target_kg">Target(KG)</label>
            <input name="target_kg" type="number" id="target_kg" class="form-control" placeholder="Target(KG)" value="{{ $data->target_kg }}" required>
        </div>
        <div class="col-md-6">
            <label for="actual_production_kg">Actual production(KG)</label>
            <input type="number" name="actual_production_kg" id="actual_production_kg" class="form-control" placeholder="Actual production(KG)" value="{{ $data->actual_production_kg }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="remarks">Achievement% </label>
            <input id="result" type="text" class="form-control" value="{{ $data->achievement }}" readonly>
        </div>
        <div class="col-md-6">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks">{{ $data->remarks }}</textarea>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#target_kg, #actual_production_kg').on('input', function() {
                var target_kg = parseFloat($('#target_kg').val());
                var actual_production_kg = parseFloat($('#actual_production_kg').val());
                if (!isNaN(target_kg) && !isNaN(actual_production_kg)) {
                    var result = actual_production_kg / target_kg * 100;
                    $('#result').val(result.toFixed(2));
                } else {
                    $('#result').val('');
                }
            });
        });
    </script>

    <br>
    <br>

    <x-backend.form.saveButton>Save</x-backend.form.saveButton>

</div>

    </form>


</x-backend.layouts.master>
