<div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side">
      <ul class="nav-main">
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.home') }}">
            <i class="nav-main-link-icon si si-speedometer"></i>
            <span class="nav-main-link-name">Dashboard</span>
          </a>
        </li>

        @can('user-admin')
        <li class="nav-main-heading">Blog</li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{ route('admin.posts.index') }}">
            <i class="nav-main-link-icon si si-note"></i>
            <span class="nav-main-link-name">News</span>
          </a>
        </li>
        @endcan
        @can('is_admin')
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{ route('admin.posts.trashed') }}">
            <i class="nav-main-link-icon si si-trash"></i>
            <span class="nav-main-link-name">Trashed Post</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.slides.index') }}">
            <i class="nav-main-link-icon si si-film"></i>
            <span class="nav-main-link-name">Slider</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.contacts.index') }}">
            <i class="nav-main-link-icon si si-note"></i>
            <span class="nav-main-link-name">Inbox</span>
          </a>
        </li>
        <li class="nav-main-heading">Website Settings</li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.users.index') }}">
            <i class="nav-main-link-icon si si-people"></i>
            <span class="nav-main-link-name">Users</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.trashed') }}">
            <i class="nav-main-link-icon si si-trash"></i>
            <span class="nav-main-link-name">Deleted Users</span>
          </a>
        </li>
        <li class="nav-main-item">
          <a class="nav-main-link active" href="{{  route('admin.settings.index') }}">
            <i class="nav-main-link-icon si si-settings"></i>
            <span class="nav-main-link-name">Settings</span>
          </a>
        </li>
        @endcan
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>