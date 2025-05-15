<x-backend.layouts.master>

            <x-slot name="pageTitle">
                Admin Dashboard
            </x-slot>

            <x-slot name='breadCrumb'>
                <x-backend.layouts.elements.breadcrumb>
                    <x-slot name="pageHeader"> Dashboard </x-slot>
                    <li class="breadcrumb-item active">Dashboard</li>
                </x-backend.layouts.elements.breadcrumb>
            </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex flex-wrap gap-2">
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('cpbs.dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> CPB Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('qcs.dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> QC Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('ed.dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Exhaust Dyeing Management
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('trims_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Trims Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('fabrics_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Fabrics Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('grey_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Grey Fabrics Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('yarn_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Yarns Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('common_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> Grey Fabrics and Yarns Dashboard
                    </a>
                    <a class="btn btn-outline-primary d-flex align-items-center" href="{{ route('cpbs_ed_dashboard') }}" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-tachometer-alt me-2"></i> CPB and Exhaust Dyeing Dashboard
                    </a>
                </div>
                
                           
                       
            </div>
        </div>
    </div>
<script>
//     const iconPath = '{{ asset('logo.PNG') }}';
//  Push.create("Hello Shailesh!",{
//        body: "Welcome to the Dashboard.",
//        timeout: 5000,
//        icon: iconPath
// });
</script>
        </x-backend.layouts.master>