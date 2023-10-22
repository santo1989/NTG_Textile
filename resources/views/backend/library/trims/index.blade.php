<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Trims & Accessories Store Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Trims & Accessories Store Information </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('trims.index') }}">Trims & Accessories Store  Information</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($trims) || empty($trims))
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

                                @can('Creator_trims')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                @can('Editor_garments')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                {{-- <x-backend.form.anchor :href="route('trims.create')" type="create" /> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- trim Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>Buyer Name</th>
                                            <th>Style/Or No</th>
                                            <th>Order Qty</th>
                                            <th>Booking  Qty</th>
                                            <th>Received Qty</th>
                                            <th>Received Balance Qty</th>
                                            <th>Issue Qty</th> 
                                            <th>In Hand Qty</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($trims as $trim)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $trim->date }}</td>
                                                <td>{{ $trim->buyer_name }}</td>
                                                <td>{{ $trim->style_or_no }}</td>
                                                <td>{{ $trim->order_qty }}</td>
                                                <td>{{ $trim->booking_qty }}</td>
                                                <td>{{ $trim->receive_qty }}</td>
                                                <td>{{ $trim->rcv_bal_qty }}</td>
                                                <td>{{ $trim->issue_qty }}</td>
                                                <td>{{ $trim->in_hand_qty }}</td> 
                                                <td>

                                                    @can('Admin')
                                                        <x-backend.form.anchor :href="route('trims.edit', [
                                                            'trim' => $trim->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    @can('Editor_garments')
                                                        <x-backend.form.anchor :href="route('trims.edit', [
                                                            'trim' => $trim->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    {{-- <x-backend.form.anchor :href="route('trims.show', [
                                                        'trim' => $trim->id,
                                                    ])" type="show" /> --}}

                                                    @can('Admin')
                                                        <form style="display:inline"
                                                            action="{{ route('trims.destroy', ['trim' => $trim->id]) }}"
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

                                                    @can('Editor_garments')
                                                        <form style="display:inline"
                                                            action="{{ route('trims.destroy', ['trim' => $trim->id]) }}"
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
