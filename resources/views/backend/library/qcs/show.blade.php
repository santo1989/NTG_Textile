<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Knitting QC Data Inforomation
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

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- division Table goes here --}}
                            <table class="table table-bordered">
                               
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $qcs->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shift</th>
                                        <td>{{ $qcs->shift }}</td>
                                    </tr>
                                    <tr>
                                        <th>Grade A</th>
                                        <td>{{ $qcs->grade_a }}</td>
                                    </tr>
                                    <tr>
                                        <th>Grade B</th> 
                                        <td>{{ $qcs->grade_b }}</td>
                                    </tr>
                                    <tr>
                                        <th>Grade C</th>
                                        <td>{{ $qcs->grade_c }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rejection</th>
                                        <td>{{ $qcs->rejection }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rejection %</th>
                                        <td>{{ $qcs->precentage_rejection }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Check</th> 
                                        <td>{{ $qcs->total_check }}</td>
                                    </tr>
                                    <tr>
                                        <th>Qc Pass Qty</th>
                                        <td>{{ $qcs->qc_pass_qty }}</td>
                                    </tr>
                                                

                            </table>
                            <div class="form-group">
                                <a href="{{ route('qcs.index') }}" class="btn btn-outline-secondary">Back</a>
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
</x-backend.layouts.master>
