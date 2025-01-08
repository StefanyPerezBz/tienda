<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link has-dropdown"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory', 'admin.childcategory']) }}"
                style="cursor: pointer">
                <a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wrench"></i>
                    <span>Gestionar Categoría</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}">Categoría</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subcategory.index') }}">Subcategoría</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.childcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.childcategory.index') }}">Sub SubCategoría</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.vendor-profile.*']) }}" style="cursor: pointer">
                <a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cash-register"></i>
                    <span>Ecommerce</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}">Vendedor</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive(['admin.slider.*']) }}" style="cursor: pointer">
                <a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-pager"></i>
                    <span>Gestionar Página</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}">Slider</a></li>
                </ul>
            </li>

            <li class="dropdown {{ setActive([
            'admin.brand.*',
            'admin.products.*',
            ]) }}" style="cursor: pointer">
                <a class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-product-hunt"></i>
                    <span>Gestionar Productos</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}">Marcas</a></li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.products.index') }}">Productos</a></li>
            </li>
            

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}
        </ul>

    </aside>
</div>
