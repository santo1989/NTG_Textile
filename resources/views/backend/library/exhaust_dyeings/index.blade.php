<x-backend.layouts.master>
    <x-slot name="pageTitle">
        EXHAUST DYEING Production Data List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> EXHAUST DYEING Production Data </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('exhaust_dyeings.index') }}">EXHAUST DYEING Production Data</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($exhaust_dyeings) || empty($exhaust_dyeings))
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

                                @can('Creator_eds')
                                    <x-backend.form.anchor :href="route('exhaust_dyeings.create')" type="create" />
                                @endcan
                                @can('Editor')
                                    <x-backend.form.anchor :href="route('exhaust_dyeings.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('exhaust_dyeings.create')" type="create" />
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- exhaust_dyeing Table goes here --}}

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
                                        @foreach ($exhaust_dyeings as $exhaust_dyeing)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $exhaust_dyeing->date }}</td>
                                                <td>{{ $exhaust_dyeing->mc_no }}</td>
                                                <td>{{ $exhaust_dyeing->target_kg }}</td>
                                                <td>{{ $exhaust_dyeing->actual_production_kg }}</td>
                                                <td>{{ $exhaust_dyeing->acheivement }}</td>
                                                <td>{{ $exhaust_dyeing->remarks }}</td>
                                                <td>

                                                    @can('Admin')
                                                        <x-backend.form.anchor :href="route('exhaust_dyeings.edit', [
                                                            'exhaust_dyeing' => $exhaust_dyeing->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    @can('Editor')
                                                        <x-backend.form.anchor :href="route('exhaust_dyeings.edit', [
                                                            'exhaust_dyeing' => $exhaust_dyeing->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    {{-- <x-backend.form.anchor :href="route('exhaust_dyeings.show', ['exhaust_dyeing' => $exhaust_dyeing->id])" type="show" /> --}}

                                                    @can('Admin')
                                                        <form style="display:inline"
                                                            action="{{ route('exhaust_dyeings.destroy', ['exhaust_dyeing' => $exhaust_dyeing->id]) }}"
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
                                                            action="{{ route('exhaust_dyeings.destroy', ['exhaust_dyeing' => $exhaust_dyeing->id]) }}"
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
