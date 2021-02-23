<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ Request::is('cabinet') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    {{ trans('admin.dashboard') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pages.index') }}" class="nav-link {{ Request::is('cabinet/pages') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    {{ trans('admin.pages') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.blocks.index') }}" class="nav-link {{ Request::is('blocks') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                    {{ trans('admin.blocks') }}
                </p>
            </a>
        </li>

        <li class="nav-item has-treeview ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    {{ trans('admin.article_management') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('admin.articles') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.rubrics.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ trans('admin.rubrics') }}</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('cabinet/catalog') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    {{ trans('admin.catalog') }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.catalog.index') }}" class="nav-link {{ Request::is('cabinet/catalog') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{ trans('admin.categories') }}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.catalog.items.index') }}" class="nav-link {{ Request::is('cabinet/catalog-items') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>
                            {{ trans('admin.works') }}
                        </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.media.index') }}" class="nav-link {{ Request::is('cabinet/media') ? 'active' : '' }}">
                <i class="nav-icon fas fa-photo-video"></i>
                <p>
                    {{ trans('admin.media') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.albums.index') }}" class="nav-link {{ Request::is('cabinet/albums') ? 'active' : '' }}">
                <i class="nav-icon fas fa-image"></i>
                <p>
                    {{ trans('admin.photos') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ Request::is('cabinet/slider') ? 'active' : '' }}">
                <i class="nav-icon fas fa-images"></i>
                <p>
                    {{ trans('admin.sliders') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.menu.index') }}" class="nav-link {{ Request::is('cabinet/menu') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bars"></i>
                <p>
                    {{ trans('admin.menu') }}
                </p>
            </a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('cabinet/users') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    {{ trans('admin.users') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('settings') }}" class="nav-link {{ Request::is('cabinet/settings') ? 'active' : '' }}">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                    {{ trans('admin.settings') }}
                </p>
            </a>
        </li>
        @endif
        <!-- Add icons to the links using the .nav-icon class Article manager
             with font-awesome or any other icon font library -->
        <!--<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashbo
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li>-->
    </ul>
</nav>
<!-- /.sidebar-menu -->
