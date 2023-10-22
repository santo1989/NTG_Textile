<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Supervisor List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Supervisor </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor_assigns.index') }}">Supervisor </a></li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($supervisor_assigns) || empty($supervisor_assigns))
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <h1 class="text-danger"> <strong>Currently No Information Available!</strong> </h1>
                    </div>
                </div>
            @else
                @if (session('message'))
                    <div class="alert alert-success">
                        <span class="close" data-dismiss="alert">&times;</span>
                        <strong>{{ session('message') }}.</strong>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                {{-- <a class="btn btn-primary" href={{ route('supervisor_assigns.create') }}>Create</a> --}}
                                <x-backend.form.anchor :href="route('supervisor_assigns.create')" type="create" />
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- supervisor_assign Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Company Name</th>
                                            <th>Department Name</th>
                                            {{-- <th>Designation Name</th> --}}
                                            <th>Supervisor Name</th>
                                            <th>Employee Name</th>
                                            <th>Supervisor Status</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($supervisor_assigns as $supervisor_assign)
                                          
                                            <tr>

                                                <td>{{ ++$sl }}</td>
                                                <td>
                                                    @foreach ($companies as $company)
                                                        @if ($company->id == $supervisor_assign->company_id)
                                                            {{ $company->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($departments as $department)
                                                        @if ($department->id == $supervisor_assign->department_id)
                                                            {{ $department->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                {{-- <td>
                                                    @foreach ($designations as $designation)
                                                        @if ($designation->id == $supervisor_assign->designation_id)
                                                            {{ $designation->name }}
                                                        @endif
                                                    @endforeach
                                                </td> --}}
                                                <td>
                                                    @foreach ($users as $supervisor)
                                                        @if ($supervisor->id == $supervisor_assign->supervisor_id)
                                                            {{ $supervisor->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($users as $employee)
                                                        @if ($employee->id == $supervisor_assign->user_id)
                                                            {{ $employee->name }}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                    <td>
                                            <form action="{{ route('supervisor_assigns.status', ['supervisor_assign' => $supervisor_assign->id]) }}" method="POST">
                                                    @csrf
                                                    <button
                                                        onclick="return confirm('Are you sure want to change status ?')"
                                                        class="btn btn-sm {{ $supervisor_assign->status ? 'btn-success' : 'btn-danger' }}"
                                                        type="submit">{{ $supervisor_assign->status ? 'Active' : 'Inactive' }}
                                                        </button>
                                                </form>
                                        </td>
                                                <td>
                                                    {{-- <a class="btn btn-primary my-1 mx-1 btn-sm"
                                                        href={{ route('supervisor_assigns.edit', ['supervisor_assign' => $supervisor_assign->id]) }}>Edit</a>
                                                    <a class="btn btn-primary my-1 mx-1 btn-sm"
                                                        href={{ route('supervisor_assigns.show', ['supervisor_assign' => $supervisor_assign->id]) }}>Show</a> --}}
                                                    <x-backend.form.anchor :href="route('supervisor_assigns.edit', $supervisor_assign->id)" type="edit" />
                                                    <x-backend.form.anchor :href="route('supervisor_assigns.show', $supervisor_assign->id)" type="show" />

                                                    <form style="display: inline"
                                                        action="{{ route('supervisor_assigns.destroy', ['supervisor_assign' => $supervisor_assign->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')

                                                        <button
                                                            onclick="return confirm('Are you sure want to delete ?')"
                                                            class="btn btn-danger my-1 mx-1 btn-sm"
                                                            type="submit">Delete</button>
                                                    </form>

                                                </td>
                                                {{-- <td>
                                                    <a class="btn btn-info my-1 mx-1 btn-sm"
                                                        href={{ route('kra_assigns', ['supervisor_assign' => $supervisor_assign->id]) }}>Set
                                                        KRA</a>
                                                </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    @endif
</x-backend.layouts.master>
