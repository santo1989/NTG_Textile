<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Knitting QC Data List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Knitting QC Data </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('qcs.index') }}">Knitting QC Data</a></li> --}}
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            @if (is_null($qcs) || empty($qcs))
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

                                <x-backend.form.anchor :href="route('qcs.create')" type="create" />
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{-- qc Table goes here --}}

                                <table id="datatablesSimple" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Date</th>
                                            <th>Shift</th>
                                            <th>Grade A</th>
                                            <th>Grade B</th>
                                            <th>Grade C</th>
                                            <th>Rejection</th>
                                            <th>Rejection %</th>
                                            <th>Total Check</th>
                                            <th>Qc Pass Qty</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($qcs as $qc)
                                            <tr>
                                                <td>{{ ++$sl }}</td>
                                                <td>{{ $qc->date }}</td>
                                                <td>{{ $qc->shift }}</td>
                                                <td>{{ $qc->grade_a }}</td>
                                                <td>{{ $qc->grade_b }}</td>
                                                <td>{{ $qc->grade_c }}</td>
                                                <td>{{ $qc->rejection }}</td>
                                                <td>{{ $qc->precentage_rejection }}</td>
                                                <td>{{ $qc->total_check }}</td>
                                                <td>{{ $qc->qc_pass_qty }}</td>
                                                <td>

                                                    @if (Auth::user()->role_id == 1)
                                                        <x-backend.form.anchor :href="route('qcs.edit', ['qc' => $qc->id])" type="edit" />
                                                    @endif
                                                    <x-backend.form.anchor :href="route('qcs.show', ['qc' => $qc->id])" type="show" />

                                                    @if (Auth::user()->role_id == 1)
                                                        <form style="display:inline"
                                                            action="{{ route('qcs.destroy', ['qc' => $qc->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')

                                                            <button
                                                                onclick="return confirm('Are you sure want to delete ?')"
                                                                class="btn btn-outline-danger my-1 mx-1 inline btn-sm"
                                                                type="submit"><i class="bi bi-trash"></i>
                                                                Delete</button>
                                                        </form>
                                                    @endif
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
