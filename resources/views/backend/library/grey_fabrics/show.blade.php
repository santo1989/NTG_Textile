<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Warehouse Stock Grey Fabrics Information Inforomation
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Warehouse Stock Grey Fabrics Information </x-slot>

            {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('grey_fabrics.index') }}">Warehouse Stock Grey Fabrics Information</a></li> --}}
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
                                        <td>{{ $grey_fabrics->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Opening Qty</th>
                                        <td>{{ $grey_fabrics->opening_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Received Qty</th>
                                        <td>{{ $grey_fabrics->received_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Received Qumulative Qty</th>
                                        <td>{{ $grey_fabrics->received_qumilative_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Issue Qty</th>
                                        <td>{{ $grey_fabrics->issue_qty }}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Issue Qumulative Qty</th>
                                        <td>{{ $grey_fabrics->issue_qumilative_qty }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock In Hand</th>
                                        <td>{{ $grey_fabrics->stock_in_hand }}</td>
                                    </tr>


                                    <tr>
                                        <th>Remarks</th>
                                        <td>{{ $grey_fabrics->remarks }}</td>
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
