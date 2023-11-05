<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Trims & Accessories Store Information Inforomation
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
                                    <td>{{ $trims->date }}</td>
                                </tr>
                                <tr>
                                    <th>Opening Qty</th>
                                    <td>{{ $trims->opening_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Qty</th>
                                    <td>{{ $trims->received_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Cumulative Qty</th>
                                    <td>{{ $trims->received_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Issue Qty</th>
                                    <td>{{ $trims->issue_qty }}</td>
                                </tr>

                                <tr>
                                    <th>Issue Cumulative Qty</th>
                                    <td>{{ $trims->issue_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Stock In Hand</th>
                                    <td>{{ $trims->stock_in_hand }}</td>
                                </tr>


                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $trims->remarks }}</td>
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
