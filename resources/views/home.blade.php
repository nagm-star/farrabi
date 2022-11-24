@extends('layouts.backend.app')

@section('content')
        <!-- Hero -->
        <div class="content">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
              <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                  Dashboard
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                  Welcome <a class="fw-semibold" href="be_pages_generic_profile.html">John</a>, everything looks great.
                </h2>
              </div>
              <div class="mt-3 mt-md-0 ms-md-3 space-x-1">
                <a class="btn btn-sm btn-alt-secondary space-x-1" href="be_pages_generic_profile_edit.html">
                  <i class="fa fa-cogs opacity-50"></i>
                  <span>Settings</span>
                </a>
                <div class="dropdown d-inline-block">
                  <button type="button" class="btn btn-sm btn-alt-secondary space-x-1" id="dropdown-analytics-overview" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-calendar-alt opacity-50"></i>
                    <span>All time</span>
                    <i class="fa fa-fw fa-angle-down"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end fs-sm" aria-labelledby="dropdown-analytics-overview">
                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 30 days</a>
                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last month</a>
                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last 3 months</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item fw-medium" href="javascript:void(0)">This year</a>
                    <a class="dropdown-item fw-medium" href="javascript:void(0)">Last Year</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item fw-medium d-flex align-items-center justify-content-between" href="javascript:void(0)">
                      <span>All time</span>
                      <i class="fa fa-check"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END Hero -->
  
          <!-- Page Content -->
          <div class="content">
            <!-- Overview -->
            <div class="row items-push">
              <div class="col-sm-6 col-xxl-3">
                <!-- Pending Orders -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                      <dt class="fs-3 fw-bold">{{ $allPosts->count() }}</dt>
                      <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">All Post</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                      <i class="far fa-edit fs-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" 
                    href="{{ route('admin.posts.index') }}">
                      <span>View all orders</span>
                      <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                  </div>
                </div>
                <!-- END Pending Orders -->
              </div>
              <div class="col-sm-6 col-xxl-3">
                <!-- New Customers -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                      <dt class="fs-3 fw-bold">{{ $allusers->count() }}</dt>
                      <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">All Users</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                      <i class="far fa-user-circle fs-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" 
                       href="{{ route('admin.users.index') }}">
                      <span>View all customers</span>
                      <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                  </div>
                </div>
                <!-- END New Customers -->
              </div>
              <div class="col-sm-6 col-xxl-3">
                <!-- Messages -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                      <dt class="fs-3 fw-bold">{{ $allcontacts->count() }}</dt>
                      <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Messages</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                      <i class="far fa-paper-plane fs-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" 
                       href="{{ route('admin.contacts.index') }}">
                      <span>View all messages</span>
                      <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                  </div>
                </div>
                <!-- END Messages -->
              </div>
              <div class="col-sm-6 col-xxl-3">
                <!-- Conversion Rate -->
                <div class="block block-rounded d-flex flex-column h-100 mb-0">
                  <div class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                      <dt class="fs-3 fw-bold">55</dt>
                      <dd class="fs-sm fw-medium fs-sm fw-medium text-muted mb-0">Services</dd>
                    </dl>
                    <div class="item item-rounded-lg bg-body-light">
                      <i class="fa fa-chart-bar fs-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="bg-body-light rounded-bottom">
                    <a class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between" 
                       href="">
                      <span>View all services</span>
                      <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                    </a>
                  </div>
                </div>
                <!-- END Conversion Rate-->
              </div>
            </div>
            <!-- END Overview -->
  
  
            <!-- Recent Orders -->
            <div class="block block-rounded">
              <div class="block-header block-header-default">
                <h3 class="block-title">Recent Posts</h3>
                <div class="block-options space-x-1">
                  <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle" data-target="#one-dashboard-search-orders" data-class="d-none">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
              <div id="one-dashboard-search-orders" class="block-content border-bottom d-none">
                <!-- Search Form -->
                <form action="be_pages_dashboard.html" method="POST" onsubmit="return false;">
                  <div class="push">
                    <div class="input-group">
                      <input type="text" class="form-control form-control-alt" id="one-ecom-orders-search" name="one-ecom-orders-search" placeholder="Search all orders..">
                      <span class="input-group-text bg-body border-0">
                        <i class="fa fa-search"></i>
                      </span>
                    </div>
                  </div>
                </form>
                <!-- END Search Form -->
              </div>
              <div class="block-content block-content-full">
                <!-- Recent Orders Table -->
                <div class="table-responsive">
                  <table class="table table-hover table-vcenter">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th class="d-none d-xl-table-cell">Description</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell">Image</th>

                      </tr>
                    </thead>
                    <tbody class="fs-sm">
                      @foreach($latest as $late)
                      <tr>
                        
                        <td class="d-none d-sm-table-cell">
                          <p class="fs-xs fw-semibold mb-0">{{ $late->title }}</p>
                        </td>
                        <td class="d-none d-sm-table-cell fw-semibold text-muted">
                          {!!  substr(strip_tags($late->body), 0, 50) !!} 
                        </td>
                        @if ($late->status)
                        <td class="d-none d-sm-table-cell">
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success text-success" style="color:white !important;">
                              Active</span>
                        </td>
                        @else
                        <td class="d-none d-sm-table-cell">
                          <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning text-warning" style="color:white !important;">
                              Inactive</span>
                        </td>
          
                        @endif
                        <td>
                          <img src="{{ $late->image }}" alt="{{ $late->title }}" width="60px" height="40px">
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- END Recent Orders Table -->
              </div>
              <div class="block-content block-content-full bg-body-light">
                <!-- Pagination -->
                <nav aria-label="Photos Search Navigation">
                  <ul class="pagination pagination-sm justify-content-end mb-0">
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" tabindex="-1" aria-label="Previous">
                        Prev
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="javascript:void(0)">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)">4</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="javascript:void(0)" aria-label="Next">
                        Next
                      </a>
                    </li>
                  </ul>
                </nav>
                <!-- END Pagination -->
              </div>
            </div>
            <!-- END Recent Orders -->
          </div>
          <!-- END Page Content -->
@endsection
