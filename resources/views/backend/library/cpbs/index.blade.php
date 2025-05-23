<x-backend.layouts.master>
    <x-slot name="pageTitle">
        CPB Production Data List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> CPB Production Data </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cpbs.index') }}">CPB Production Data</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($cpbs) || empty($cpbs))
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

                <x-backend.layouts.elements.errors />

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">

                                @can('Creator_cpbs')
                                    <x-backend.form.anchor :href="route('cpbs.create')" type="create" />
                                @endcan
                                @can('Editor')
                                    <x-backend.form.anchor :href="route('cpbs.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('cpbs.create')" type="create" />
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- cpb Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>M/c No</th>
                                            <th>Target(KG)</th>
                                            <th>Actual production(KG)</th>
                                            <th>Acheivement% </th>
                                            <th>Remarks</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($cpbs as $cpb)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $cpb->date }}</td>
                                                <td>{{ $cpb->mc_no }}</td>
                                                <td>{{ $cpb->target_kg }}</td>
                                                <td>{{ $cpb->actual_production_kg }}</td>
                                                <td>{{ $cpb->acheivement }}</td>
                                                <td>{{ $cpb->remarks }}</td>
                                                <td>

                                                   @can('Admin')
                                                        <x-backend.form.anchor :href="route('cpbs.edit', ['cpb' => $cpb->id])" type="edit" />
                                                    @endcan
                                                    @can('Editor')
                                                        <x-backend.form.anchor :href="route('cpbs.edit', ['cpb' => $cpb->id])" type="edit" />
                                                    @endcan
                                                    {{-- <x-backend.form.anchor :href="route('cpbs.show', ['cpb' => $cpb->id])" type="show" /> --}}

                                                    @can('Admin')
                                                        <form style="display:inline"
                                                            action="{{ route('cpbs.destroy', ['cpb' => $cpb->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')

                                                            <button
                                                                onclick="return confirm('Are you sure want to delete ?')"
                                                                class="btn btn-outline-danger my-1 mx-1 inline btn-sm"
                                                                type="submit"><i class="bi bi-trash"></i>
                                                                Delete</button>
                                                        </form>
                                                    @endcan

                                                    @can('Editor')
                                                        <form style="display:inline"
                                                            action="{{ route('cpbs.destroy', ['cpb' => $cpb->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')

                                                            <button
                                                                onclick="return confirm('Are you sure want to delete ?')"
                                                                class="btn btn-outline-danger my-1 mx-1 inline btn-sm"
                                                                type="submit"><i class="bi bi-trash"></i>
                                                                Delete</button>
                                                        </form>
                                                    @endcan
                                                </td>
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `@csrf @method('delete')`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

</x-backend.layouts.master>
