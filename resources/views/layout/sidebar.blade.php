<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    <!-- Nav Item - Charts -->
    @if(Auth::user()->role == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{url('users')}}">
        <i class="fa fa-user" aria-hidden="true"></i>
            <span>Users</span></a>
    </li>
    @endif
    @if(Auth::user()->role == 1 || Auth::user()->role == 0)
    <li class="nav-item">
        <a class="nav-link" href="{{url('brand')}}">
        <i class="fa fa-flag" aria-hidden="true"></i>
            <span>Brand</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('category')}}">
        <i class="fa fa-th" aria-hidden="true"></i>
            <span>Category</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('products')}}">
        <i class="fa fa-product-hunt" aria-hidden="true"></i>
            <span>Products</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('orders')}}">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
            <span>Sales</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('customers')}}">
        <i class="fa fa-users" aria-hidden="true"></i>
            <span>Customers</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('supplierproducts')}}">
        <i class="fa fa-history" aria-hidden="true"></i>
            <span>Supplier Products</span></a>
    </li>
    @endif
    @if(Auth::user()->role == 1)
    <li class="nav-item">
        <a class="nav-link" href="{{url('suppliers')}}">
        <i class="fa fa-industry" aria-hidden="true"></i>
            <span>Suppliers</span></a>
    </li>
    @endif
        



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
 

</ul>