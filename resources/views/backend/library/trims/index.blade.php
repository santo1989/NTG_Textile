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
                                <div class="row">
                                    <div class="col-sm-1 col-md-1 text-left">
                                        <table
                                            class="table table-borderless table-responsive text-center text-light font-weight-bold">
                                            <tr>
                                                <div class="form-group">
                                                    <td>
                                                        @can('Creator_trims')
                                                            {{-- <x-backend.form.anchor :href="route('trims.create')" type="create" /> --}}
                                                            <a href="{{ route('trims.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                        @endcan
                                                        @can('Editor_garments')
                                                            <a href="{{ route('trims.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                            {{-- <x-backend.form.anchor :href="route('trims.create')" type="create" /> --}}
                                                        @endcan
                                                        @can('Admin')
                                                            <a href="{{ route('trims.create') }}"
                                                                class="btn btn-outline-success float-right"> <i
                                                                    class="fa fa-plus-circle" style="font-size:10px"></i>
                                                                Create</a>
                                                            {{-- <x-backend.form.anchor :href="route('trims.create')" type="create" /> --}}
                                                        @endcan
                                                        {{-- <a href="{{ route('trims.index') }}" class="btn btn-success float-right"> <i
                                        class="fas fa-file-excel"></i> Excel Download</a> --}}
                                                    </td>
                                                </div>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-11 col-sm-11">
                                        <form method="GET" action="{{ route('trims.index') }}">
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
                                                                $buyers = DB::table('trims_accessories_stores')
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
                                                                $style_or_nos = DB::table('trims_accessories_stores')
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
                                                        <td> Item Name:</td>
                                                        <td>
                                                            @php
                                                                $item_no = DB::table('trims_accessories_stores')
                                                                    ->select('item_no')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="item_no" id="item_no" class="form-control">
                                                                <option value="">Select Item Name</option>
                                                                @foreach ($item_no as $buyer)
                                                                    <option value="{{ $buyer->item_no }}">
                                                                        {{ $buyer->item_no }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td> Color Name:</td>
                                                        <td>
                                                            @php
                                                                $color_name = DB::table('trims_accessories_stores')
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
                                                    {{-- <div class="form-group">
                                                        <td> Unit:</td>
                                                        <td>
                                                            @php
                                                                $unit = DB::table('trims_accessories_stores')
                                                                    ->select('unit')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp
                                                            <select name="unit" id="unit"
                                                                class="form-control">
                                                                <option value="">Select Color Name</option>
                                                                @foreach ($unit as $buyer)
                                                                    <option value="{{ $buyer->unit }}">
                                                                        {{ $buyer->unit }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </div> --}}

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
                                                        <a href="{{ route('trims.index') }}"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fas fa-refresh"></i> Reset</a>
                                                    </td>
                                                </tr>
                                            </table>

                                        </form>
                                    </div>
                                    <div class="col-md-12 col-sm-12 text-md-end">
                                        @if ($search_trims == !null)
                                            <form method="GET" action="{{ route('trims.index') }}">
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
                                {{--
                                @can('Creator_trims')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                @can('Editor_garments')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                @can('Admin')
                                    <x-backend.form.anchor :href="route('trims.create')" type="create" />
                                @endcan
                                 <x-backend.form.anchor :href="route('trims.create')" type="create" /> --}}
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
                                            <th>Booking Qty</th>
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
