<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Warehouse Stock Yarns Information
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Warehouse Stock Yarns Information </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('yarns.index') }}">Warehouse Stock Yarns Information</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($yarns) || empty($yarns))
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
                            <div class="card-header" style="background: rgba(0, 0, 0, 0.4); color: #f1f1f1; ">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <form method="GET" action="{{ route('yarns.download') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <table
                                                        class="table table-borderless table-responsive text-center text-light font-weight-bold">
                                                        <tr>
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
                                                                    onclick="validateForm()"><i
                                                                        class="fa fa-search"></i>
                                                                    Search</button>

                                                            </td>

                                                            <td>
                                                                <a href="{{ route('yarns.download') }}"
                                                                    class="btn btn-outline-danger btn-sm"><i
                                                                        class="fa fa-refresh"></i> Reset</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-md-end">
                                        @if ($search_yarn == !null)
                                            <form method="GET" action="{{ route('yarns.download') }}">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
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
                                                    </div>
                                                </div>

                                            </form>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- yarn Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>Opening Qty</th>
                                            <th>Received Qty</th>
                                            <th>Received Cumulative Qty</th>
                                            <th>Issue Qty</th>
                                            <th>Issue Cumulative Qty</th>
                                            <th>Stock in Hand</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($yarns as $yarn)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $yarn->date }}</td>
                                                <td>
                                                    @if (date('d', strtotime($yarn->date)) === '01')
                                                        {{ $yarn->opening_qty }}
                                                    @endif
                                                </td>
                                                <td>{{ $yarn->received_qty }}</td>
                                                <td>{{ $yarn->received_qumilative_qty }}</td>
                                                <td>{{ $yarn->issue_qty }}</td>
                                                <td>{{ $yarn->issue_qumilative_qty }}</td>
                                                <td>{{ $yarn->stock_in_hand }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="d-flex justify-content-center">
                                            {!! $yarns->links() !!}
                                        </div>
                                    </div>
                                </div>
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
