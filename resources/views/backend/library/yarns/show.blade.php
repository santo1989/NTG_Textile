<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Warehouse Stock Yarns Information Inforomation
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
                                    <td>{{ $yarns->date }}</td>
                                </tr>
                                <tr>
                                    <th>Opening Qty</th>
                                    <td>{{ $yarns->opening_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Qty</th>
                                    <td>{{ $yarns->received_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Received Cumulative Qty</th>
                                    <td>{{ $yarns->received_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Issue Qty</th>
                                    <td>{{ $yarns->issue_qty }}</td>
                                </tr>

                                <tr>
                                    <th>Issue Cumulative Qty</th>
                                    <td>{{ $yarns->issue_qumilative_qty }}</td>
                                </tr>
                                <tr>
                                    <th>Stock In Hand</th>
                                    <td>{{ $yarns->stock_in_hand }}</td>
                                </tr>


                                <tr>
                                    <th>Remarks</th>
                                    <td>{{ $yarns->remarks }}</td>
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
