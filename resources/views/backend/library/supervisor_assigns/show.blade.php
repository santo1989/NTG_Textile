<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Supervisor Inforomation
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Supervisor </x-slot>

            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supervisor_assigns.index') }}">Supervisor </a></li>
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
                            {{-- supervisor_assign Table goes here --}}
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Supervisor Assign Date</th>
                                        <th>Supervisor Name</th>
                                        <th>Employee Information</th>
                                        <th>Supervisor Status</th>
                                        <th>Supervisor Updated Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr> 
                                        <td>{{ $supervisor_assign->supervisor->created_at }}</td>
                                        <td>{{ $supervisor_assign->supervisor->name }}</td>
                                        <td>
                                            @foreach ($users as $employee)
                                                        @if ($employee->id == $supervisor_assign->user_id)
                                                            {{ $employee->name }}
                                                        @endif
                                                    @endforeach
                                        </td>
                                        <td>{{ $supervisor_assign->supervisor->status }}</td>
                                    
                                       
                                        <td>{{ $supervisor_assign->supervisor->updated_at }}</td>
                                    </tr>
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
</x-backend.layouts.master>
