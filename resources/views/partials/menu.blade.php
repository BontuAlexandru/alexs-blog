<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none">
        {{ config('app.name', 'Alex&#10076;s Blog') }}
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="/">
                <i class="cil-speedometer mr-3"></i> Dashboard
            </a>
        </li>

        <li class="c-sidebar-nav-title">Admin</li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('users.index') }}">
                <i class="cil-user mr-3"></i> Users
            </a>
        </li>

        <li class="c-sidebar-nav-title">Pages</li>


        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('posts.index') }}">
                <i class="cil-library mr-3"></i> Posts
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('categories.index') }}">
                <i class="cil-inbox mr-3"></i> Categories
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('tags.index') }}">
                <i class="cil-tag mr-3"></i> Tags
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('trashed-post') }}">
                <i class="cil-trash mr-3"></i> Trashed Posts
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                <i class="cil-account-logout mr-3"></i>  {{ __('Logout') }}

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </a>
        </li>
    </ul>
</div>



