<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Supervisor Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Supervisor </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor_assigns.index') }}">Supervisor </a></li>
            <li class="breadcrumb-item active">Edit Supervisor Information</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('supervisor_assigns.update', ['supervisor_assign' => $supervisor_assign->id]) }}"
        method="post" enctype="multipart/form-data">
        @csrf
            @method('put')
        <div class="pb-3">
            

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $divisions = App\Models\Division::all();
                            @endphp
                            <label for="division_id">Division</label>
                            <select name="division_id" id="division_id" class="form-control">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ $division->id == $supervisor_assign->division_id ? 'selected' : '' }}>
                                        {{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="company_id">Company Name</label>
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $supervisor_assign->company_id ? 'selected' : '' }}>
                                        {{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="department_id">Department Name</label>
                            <select name="department_id" id="department_id" class="form-control">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ $department->id == $supervisor_assign->department_id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            {{-- <div class="form-group">
                <label for="company_id">Company Name</label>
                <select name="company_id" id="company_id" class="form-control">
                    <option value="">Select Company</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ $company->id == $supervisor_assign->company_id ? 'selected' : '' }}>
                            {{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="department_id">Department Name</label>
                <select name="department_id" id="department_id" class="form-control">
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ $department->id == $supervisor_assign->department_id ? 'selected' : '' }}>
                            {{ $department->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            <br>
            @php
                $users = App\Models\User::where('company_id', $supervisor_assign->company_id)
                    ->where('department_id', $supervisor_assign->department_id)
                    ->get();
            @endphp
            <div class="form-group">
                <label for="supervisor_id">Supervisor Name</label>
                <select name="supervisor_id" id="supervisor_id" class="form-control">
                    <option value="">Select Supervisor</option>
                    @foreach ($users as $supervisor)
                        <option value="{{ $supervisor->id }}"
                            {{ $supervisor->id == $supervisor_assign->supervisor_id ? 'selected' : '' }}>
                            {{ $supervisor->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <div class="form-group">
                <label for="user_id">Employee Name</label>
                <select name="user_id" id="user_id" class="form-control">
                    <option value="">Select Employee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $user->id == $supervisor_assign->user_id ? 'selected' : '' }}>
                            {{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>


            <x-backend.form.saveButton>Save</x-backend.form.saveButton>
        </div>
    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#division_id').on('change', function() {
                var divisionId = $(this).val();

                if (divisionId) {
                    $.ajax({
                        url: '/get-company-designation/' + divisionId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            const companySelect = $('#company_id');
                            const designationSelect = $('#designation_id');

                            companySelect.empty();
                            companySelect.append('<option value="">Select Company</option>');
                            $.each(data.company, function(index, company) {
                                companySelect.append(
                                    `<option value="${company.id}">${company.name}</option>`
                                );
                            });

                            designationSelect.empty();
                            designationSelect.append(
                                '<option value="">Select Designation</option>');
                            $.each(data.designations, function(index, designation) {
                                designationSelect.append(
                                    `<option value="${designation.id}">${designation.name}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Select a division first for company and designation name.');
                }
            });
        });

        $(document).ready(function() {
            $('#company_id').on('change', function() {
                var company_id = $(this).val();

                if (company_id) {
                    $.ajax({
                        url: '/get-department/' + company_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            const companySelect = $('#department_id');

                            companySelect.empty();
                            companySelect.append('<option value="">Select Department</option>');
                            $.each(data.departments, function(index, departments) {
                                companySelect.append(
                                    `<option value="${departments.id}">${departments.name}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Select a Company first for Department name.');
                }
            });
        }); 
        

         $(document).ready(function() {
            $('#department_id').on('change', function() {
                var company_id = $('#company_id').val();
                var department_id = $(this).val();
                console.log(company_id, department_id); {
                    $.ajax({
                        url: "{{ route('getSupervisor') }}",
                        type: "GET",
                        data: {
                            company_id: company_id,
                            department_id: department_id,
                        },
                        success: function(data) {
                            console.log(data);
                            $('#supervisor_id').empty();
                            $('#supervisor_id').append(
                                '<option value="">Select Supervisor</option>');
                            // $.each(data, function (key, value) {
                            //     $('#supervisor_id').append('<option value="' + key + '">' + value + '</option>');
                            // });
                            data.map((item) => {
                                $('#supervisor_id').append('<option value="' + item
                                    .id + '">' + item.name + ' ( ID: ' + item
                                    .emp_id + ' ) </option>');
                            })
                        }
                    });
                }
            });
        });

        
        $(document).ready(function() {
            $('#supervisor_id').on('change', function() {
                var company_id = $('#company_id').val();
                var department_id = $('#department_id').val();
                var supervisor_id = $(this).val();
                if (company_id && department_id) {
                    $.ajax({
                        url: "{{ route('getEmployee') }}",
                        type: "GET",
                        data: {
                            company_id: company_id,
                            department_id: department_id,
                            supervisor_id: supervisor_id,
                        },
                        success: function(data) {
                            console.log(data);
                            $('#user_id').empty();
                            $('#user_id').append('<option value="">Select Employee</option>');
                            data.map((item) => {
                                $('#user_id').append('<option value="' + item.id +
                                    '">' + item.name + ' ( ID: ' + item.emp_id +
                                    ' ) </option>');
                            })
                        }
                    });
                } else {
                    $('#user_id').empty();
                }
            });
        });
    </script>
</x-backend.layouts.master>
