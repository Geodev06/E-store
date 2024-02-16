<nav aria-label="breadcrumb">
    @if(request()->route()->getName() === 'admin.dashboard')
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bold mb-0">Dashboard</h6>
    @endif

    @if(request()->route()->getName() === 'admin.settings')
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Settings</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Settings</li>
    </ol>
    <h6 class="font-weight-bold mb-0">Settings</h6>
    @endif

    @if(request()->route()->getName() === 'category')
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Products</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Category</li>
    </ol>
    <h6 class="font-weight-bold mb-0">Product Category</h6>
    @endif

    @if(request()->route()->getName() === 'product')
    <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Products</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Items</li>
    </ol>
    <h6 class="font-weight-bold mb-0">Product Items</h6>
    @endif
</nav>