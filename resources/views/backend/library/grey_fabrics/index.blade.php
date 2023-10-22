<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Wearhouse Stock Grey Fabrics Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Wearhouse Stock Grey Fabrics Information </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grey_fabrics.index') }}">Wearhouse Stock Grey Fabrics Information</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($grey_fabrics) || empty($grey_fabrics))
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

                                @can('Creator_grey')
                                    <x-backend.form.anchor :href="route('grey_fabrics.create')" type="create" />
                                @endcan
                                @can('Editor_fabrics')
                                    <x-backend.form.anchor :href="route('grey_fabrics.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('grey_fabrics.create')" type="create" />
                                @endcan
                                {{-- <x-backend.form.anchor :href="route('grey_fabrics.create')" type="create" /> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- grey_fabric Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>Opening Qty</th>
                                            <th>Received Qty</th>
                                            <th>Received Qumilative Qty</th>
                                            <th>Issue Qty</th>
                                            <th>Issue Qumilative Qty</th>
                                            <th>Stock in Hand</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($grey_fabrics as $grey_fabric)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $grey_fabric->date }}</td>
                                                <td>
                                                    @if (date('d', strtotime($grey_fabric->date)) === '01')
                                                        {{ $grey_fabric->opening_qty }}
                                                    @endif
                                                </td>
                                                <td>{{ $grey_fabric->received_qty }}</td>
                                                <td>{{ $grey_fabric->received_qumilative_qty }}</td>
                                                <td>{{ $grey_fabric->issue_qty }}</td>
                                                <td>{{ $grey_fabric->issue_qumilative_qty }}</td>
                                                <td>{{ $grey_fabric->stock_in_hand }}</td>
                                                <td>

                                                    @can('Admin')
                                                        <x-backend.form.anchor :href="route('grey_fabrics.edit', [
                                                            'grey_fabric' => $grey_fabric->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    @can('Editor_fabrics')
                                                        <x-backend.form.anchor :href="route('grey_fabrics.edit', [
                                                            'grey_fabric' => $grey_fabric->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    <x-backend.form.anchor :href="route('grey_fabrics.show', ['grey_fabric' => $grey_fabric->id])" type="show" />

                                                    @can('Admin')
                                                        <form style="display:inline"
                                                            action="{{ route('grey_fabrics.destroy', ['grey_fabric' => $grey_fabric->id]) }}"
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

                                                    @can('Editor_fabrics')
                                                        <form style="display:inline"
                                                            action="{{ route('grey_fabrics.destroy', ['grey_fabric' => $grey_fabric->id]) }}"
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
