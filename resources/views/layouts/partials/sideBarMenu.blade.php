<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') == 'home' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        @if (auth()->user()->can('manajemen produk') || auth()->user()->can('manajemen kategori'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'product' || request()->segment(1) == 'kategori' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'product' || request()->segment(1) == 'kategori' ) ? 'active' : '' }}">
                <i class="fas fa-cubes nav-icon    "></i>
                <p>
                    Management Product
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('manajemen produk')
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}"
                            class="nav-link {{ request()->routeIs('product.index') == 'product.index' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-biking   "></i>
                            <p>Product</p>
                        </a>
                    </li>   
                @endcan

                @can('manajemen kategori')
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                            class="nav-link {{ request()->routeIs('category.index') == 'category.index' ? 'active' : '' }}">
                            <i class="fas fa-puzzle-piece nav-icon   "></i>
                            <p>Category</p>
                        </a>
                    </li>   
                @endcan
            </ul>
        </li>
        @endif

        <li class="nav-item">
            <a href="{{ asset('transaction') }}" class="nav-link">
                <i class="nav-icon fas fa-retweet"></i>
                <p>Transaction</p>
            </a>
        </li>

        @if (auth()->user()->can('manajemen users'))
        <li class="nav-item has-treeview {{ (request()->segment(1) == 'users' || request()->segment(1) == 'roles' ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->segment(1) == 'users' || request()->segment(1) == 'roles' ) ? 'active' : '' }}">
                <i class="fas fa-user-astronaut nav-icon   "></i>
                <p>
                    User Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @can('manajemen users')
                    <li class="nav-item">
                        <a href="{{ route('users.create') }}"
                            class="nav-link {{ request()->routeIs('users.create') == 'users.create' ? 'active' : '' }}">
                            <i class="fas fa-user-plus nav-icon"></i>
                            <p>Add User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.index') == 'users.index' ? 'active' : '' }}">
                            <i class="fas fa-users nav-icon   "></i>
                            <p>User List</p>
                        </a>
                    </li> 
                @endcan

                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.index') == 'roles.index' ? 'active' : '' }}">
                        <i class="fas fa-users-cog nav-icon   "></i>
                        <p>Role & Permission</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @role('admin') 
        <li class="nav-item">
            <a href="{{ route('setting.index') }}" class="nav-link {{ request()->routeIs('setting.index') == 'setting.index' ? 'active' : '' }}">
                <i class="fas fa-cog nav-icon   "></i>
                <p>
                    Settings
                </p>
            </a>
        </li>
        @endrole

        <!-- <li class="nav-item">
            <a href="{{ route('profile.show', Auth::user()->id) }}" class="nav-link {{ request()->routeIs('profile.show') == 'profile.show' ? 'active' : '' }}">
                <i class="fas fa-user-ninja nav-icon   "></i>
                <p>
                    Profile
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt text-cyan   "></i>
                <p>
                    Logout
                </p>
                {{-- {{ __('Logout') }} --}}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                style="display: none;">
                @csrf
            </form>
        </li> -->
    </ul>
</nav>