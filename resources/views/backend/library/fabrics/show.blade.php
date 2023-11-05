<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Fabric Information Board Inforomation
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
                                    <td>{{ $fabrics->date }}</td>
                                </tr>
                                <tr>
                                    <th>Opening Qty</th>
                                    <td>{{ $fabrics->opening_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Qty</th>
                                    <td>{{ $fabrics->received_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Cumulative Qty</th>
                                    <td>{{ $fabrics->received_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Issue Qty</th>
                                    <td>{{ $fabrics->issue_qty }}</td>
                                </tr>

                                <tr>
                                    <th>Issue Cumulative Qty</th>
                                    <td>{{ $fabrics->issue_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Stock In Hand</th>
                                    <td>{{ $fabrics->stock_in_hand }}</td>
                                </tr>


                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $fabrics->remarks }}</td>
                                </tr>


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
</x-backend.layouts.master>
