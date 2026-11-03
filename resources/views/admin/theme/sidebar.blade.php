<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a @class(['nav-link', 'active' => request()->routeIs('admin.home')]) href="{{ route('admin.home') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    الإحصائيات
                </a>
                <a @class(['nav-link', 'active' => request()->routeIs('category.index')]) href="{{ route('category.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    التصنيفات
                </a>
                <a @class(['nav-link', 'active' => request()->routeIs('admin.post.index')]) href="{{ route('admin.post.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    المنشورات
                </a> 
                <a @class(['nav-link', 'active' => request()->routeIs('role.*')]) href="{{ route('role.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div>
                    الأدوار
                </a>
                <a @class(['nav-link', 'active' => request()->routeIs('user.*')]) href="{{ route('user.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    المستخدمون
                </a> 
                <a @class(['nav-link', 'active' => request()->routeIs('page.*')]) href="{{ route('page.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-lines"></i></div>
                    الصفحات
                </a> 
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">مٌسجل كـ</div>
            {{ auth()->user()->name }}
        </div>
    </nav>
</div>