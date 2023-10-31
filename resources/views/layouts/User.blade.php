<x-backend.layouts.master>
    <div class="m-5">
        {{-- <h3>Welcome,
            @php
                echo auth()->user()->name;
            @endphp !
        </h3> --}}
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              @can('Editor_fabrics')
                  <iframe src="{{ route('common_dashboard') }}" width="99%" height="720px" frameborder="0"></iframe>
                  <!-- <iframe src="{{ route('yarn_dashboard') }}" width="90%" height="600px" frameborder="0"></iframe> -->
              @endcan

              @can('Creator_grey')
                  <iframe src="{{ route('grey_dashboard') }}" width="99%" height="720px" frameborder="0"></iframe>
              @endcan

              @can('Creator_yarn')
                   <iframe src="{{ route('yarn_dashboard') }}" width="99%" height="720px" frameborder="0"></iframe>
              @endcan


            </div>
        </div>
    </div>

</x-backend.layouts.master>
