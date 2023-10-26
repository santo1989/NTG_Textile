<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Fabric Information Board
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Fabric Information Board </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('fabrics.index') }}">Trims & Accessories Store  Information</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($fabrics) || empty($fabrics))
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
<div class="row">
                                    <div class="col-sm-1 col-md-1 text-left">
                                        <table
                                            class="table table-borderless table-responsive text-center text-light font-weight-bold">
                                            <tr>
                                                <div class="form-group">
                                                    <td>
                                                        @can('Creator_fabrics')
                                                            {{-- <x-backend.form.anchor :href="route('fabrics.create')" type="create" /> --}}
                                                            <a href="{{ route('fabrics.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                        @endcan
                                                        @can('Editor_garments')
                                                            <a href="{{ route('fabrics.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                            {{-- <x-backend.form.anchor :href="route('fabrics.create')" type="create" /> --}}
                                                        @endcan
                                                        @can('Admin')
                                                            <a href="{{ route('fabrics.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                            {{-- <x-backend.form.anchor :href="route('fabrics.create')" type="create" /> --}}
                                                        @endcan
                                                        {{-- <a href="{{ route('fabrics.index') }}" class="btn btn-success float-right"> <i
                                        class="fas fa-file-excel"></i> Excel Download</a> --}}
                                                    </td>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-11 col-sm-11">
                                        <form method="GET" action="{{ route('fabrics.index') }}">
                                            @csrf
                                            <table class="table table-borderless table-responsive  font-weight-bold">
                                                <tr>
                                                    {{--  
                                                    <div class="form-group">
                                                        <td> :</td>
                                                        <td>
                                                            <input type="date" name="entry_date_start"
                                                                id="entry_date_start" class="form-control">
                                                        </td>
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <td> Buyer Name:</td>
                                                        <td>
                                                            @php
                                                                $buyers = DB::table('fabric_information_boards')
                                                                    ->select('buyer_name')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="buyer_name" id="buyer_name"
                                                                class="form-control">
                                                                <option value="">Select Buyer Name</option>
                                                                @foreach ($buyers as $buyer)
                                                                    <option value="{{ $buyer->buyer_name }}">
                                                                        {{ $buyer->buyer_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td> Style/ Order:</td>
                                                        <td>
                                                            @php
                                                                $style_or_nos = DB::table('fabric_information_boards')
                                                                    ->select('style_or_no')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="style_or_no" id="style_or_no"
                                                                class="form-control">
                                                                <option value="">Select Style / Order</option>
                                                                @foreach ($style_or_nos as $style_or_no)
                                                                    <option value="{{ $style_or_no->style_or_no }}">
                                                                        {{ $style_or_no->style_or_no }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td> Fabrics Type:</td>
                                                        <td>
                                                            @php
                                                                $fabric_type = DB::table('fabric_information_boards')
                                                                    ->select('fabric_type')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="fabric_type" id="fabric_type" class="form-control">
                                                                <option value="">Select Item Name</option>
                                                                @foreach ($fabric_type as $buyer)
                                                                    <option value="{{ $buyer->fabric_type }}">
                                                                        {{ $buyer->fabric_type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td> Color Name:</td>
                                                        <td>
                                                            @php
                                                                $color_name = DB::table('fabric_information_boards')
                                                                    ->select('color_name')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="color_name" id="color_name"
                                                                class="form-control">
                                                                <option value="">Select Color Name</option>
                                                                @foreach ($color_name as $buyer)
                                                                    <option value="{{ $buyer->color_name }}">
                                                                        {{ $buyer->color_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td> Parts:</td>
                                                        <td>
                                                            @php
                                                                $parts = DB::table('fabric_information_boards')
                                                                    ->select('parts')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="parts" id="parts"
                                                                class="form-control">
                                                                <option value="">Select Color Name</option>
                                                                @foreach ($parts as $buyer)
                                                                    <option value="{{ $buyer->parts }}">
                                                                        {{ $buyer->parts }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>

                                                    <div class="form-group">
                                                        <td>Date:</td>
                                                        <td>
                                                            <input type="date" name="entry_date_start"
                                                                id="entry_date_start" class="form-control">
                                                        </td>
                                                        <td>-</td>
                                                        <td>
                                                            <input type="date" name="entry_date_end"
                                                                id="entry_date_end" class="form-control">
                                                        </td>
                                                    </div>
                                                    <td>
                                                        <button class="btn btn-outline-info btn-sm"
                                                            onclick="validateForm()"><i class="fa fa-search"></i>
                                                            Search</button>



                                                    </td>

                                                    <td>
                                                        <a href="{{ route('fabrics.index') }}"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fas fa-refresh"></i> Reset</a>
                                                    </td>
                                                </tr>
                                            </table>

                                        </form>
                                    </div>
                                    <div class="col-md-12 col-sm-12 text-md-end">
                                        @if ($search_fabrics == !null)
                                            <form method="GET" action="{{ route('fabrics.index') }}">
                                                @csrf

                                                <div class="form-group" id="hide_div">
                                                    <label for="export_format">Export Format:</label>
                                                    <select name="export_format" id="export_format"
                                                        class="form-control">
                                                        <option value="xlsx">Excel (XLS)</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-outline-info">
                                                    <i class="fa fa-file-excel" aria-hidden="true"></i> Export
                                                </button>

                                            </form>
                                        @endif
                                    </div>
                                </div>
                              {{--   @can('Creator_fabrics')
                                    <x-backend.form.anchor :href="route('fabrics.create')" type="create" />
                                @endcan
                                @can('Editor_garments')
                                    <x-backend.form.anchor :href="route('fabrics.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('fabrics.create')" type="create" />
                                @endcan
                                <x-backend.form.anchor :href="route('fabrics.create')" type="create" /> --}}
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- fabric Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>Buyer Name</th>
                                            <th>Style/Or No</th>
                                            <th>Order Qty Pcs</th>
                                            <th>Fabric Type</th>
                                            <th>Booking Qty (Kg)</th>
                                            <th>Received Qty (Kg)</th>
                                            <th>Received Balance Qty (Kg)</th>
                                            <th>Dlv Cutting(kgs)</th>
                                            <th>Closing Stock (Kgs)</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($fabrics as $fabric)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $fabric->date }}</td>
                                                <td>{{ $fabric->buyer_name }}</td>
                                                <td>{{ $fabric->style_or_no }}</td>
                                                <td>{{ $fabric->order_qty }}</td>
                                                <td>{{ $fabric->fabric_type }}</td>
                                                <td>{{ $fabric->booking_qty }}</td>
                                                <td>{{ $fabric->receive_qty }}</td>
                                                <td>{{ $fabric->rcv_bal_qty }}</td>
                                                <td>{{ $fabric->dlv_cutting }}</td>
                                                <td>{{ $fabric->closing_stock }}</td>
                                                <td>

                                                    @can('Admin')
                                                        <x-backend.form.anchor :href="route('fabrics.edit', [
                                                            'fabric' => $fabric->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    @can('Editor_garments')
                                                        <x-backend.form.anchor :href="route('fabrics.edit', [
                                                            'fabric' => $fabric->id,
                                                        ])" type="edit" />
                                                    @endcan
                                                    {{-- <x-backend.form.anchor :href="route('fabrics.show', [
                                                        'fabric' => $fabric->id,
                                                    ])" type="show" /> --}}

                                                    @can('Admin')
                                                        <form style="display:inline"
                                                            action="{{ route('fabrics.destroy', ['fabric' => $fabric->id]) }}"
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
                                                            action="{{ route('fabrics.destroy', ['fabric' => $fabric->id]) }}"
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
