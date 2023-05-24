@if (auth()->user()->role_id == 1)
    @include('layouts.Admin')
@else
    @include('layouts.User')
@endif

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
