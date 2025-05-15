<div class="sidebar">
        <div class="sidebar-brand">
            <span>ShopDash</span>
        </div>
        <div class="sidebar-menu">
            <a href="{{route('admin.home')}}" class="menu-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{route('admin.product')}}" class="menu-item">
                <i class="fas fa-shopping-bag"></i>
                <span>Products</span>
            </a>
            <a href="{{route('user.show')}}" class="menu-item">
                <i class="fas fa-user"></i>
                <span>Users</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-users"></i>
                <span>Customers</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-tag"></i>
                <span>Marketing</span>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <form action="{{route('admin.logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark">
                <i class="fas fa-cog"></i>
                <span>Logout</span>
            </button>
        </form>
        </div>
    </div>
