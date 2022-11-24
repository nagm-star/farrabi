@extends('layouts.backend.app')


@section('content')


@section('content')
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('admin.home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              Trashed Posts
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <!-- END Hero -->

  <!-- Page Content -->
  <div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">Trashed Post </h3>
      </div>
      <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
          <thead>
            <tr>
              <th>Title</th>
              <th class="d-none d-sm-table-cell" style="width: 30%;">Body</th>
              <th class="d-none d-sm-table-cell" style="width: 15%;">Status</th>
              <th style="width: 15%;">Action</th>
            </tr>
          </thead>
          <tbody>

            @if($posts->count() > 0)
            @foreach ($posts as $post)
            <tr>
              <td class="fw-semibold fs-sm">{!!  substr(strip_tags($post->title), 0, 50) !!}</td>
              <td class="d-none d-sm-table-cell fs-sm">
                {!!  substr(strip_tags($post->body), 0, 50) !!} 
              </td>
             <td><img src="{{ $post->image }}" alt="{{ $post->title }}" width="60px" height="40px"></td>
              <td class="text-left fs-sm">

                <a class="btn btn-sm btn-alt-success" onclick="handleRestore({{ $post->id }})" data-bs-toggle="tooltip" title="Restore">
                  <i class="fa fa-fw fa-undo text-back"></i>
                </a>

                <a class="btn btn-sm btn-alt-danger" onclick="handleDelete({{ $post->id }})" data-bs-toggle="tooltip" title="Delete">
                  <i class="fa fa-fw fa-times text-danger"></i>
                </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4" class="d-none d-sm-table-cell fs-sm text-center">
                  <p>No trashed posts</p>
                </td>
                
                </td>
              </tr>
            @endif
           
          </tbody>
        </table>
      </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->

  </div>

         
<!-- Delete Modal -->
<div class="modal fade modal-danger" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="text-left" style="float: left !important;" aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" id="deleteCategoryForm">
          @csrf
          @method('DELETE')
          <div class="modal-body">
            <p class="text-center">
              Do you want to delete?
            </p>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-danger">Yes Delete</button> &nbsp;
          </div>
        </form>
  
      </div>
    </div>
  </div>
         
<!-- Restore Modal -->
<div class="modal fade modal-danger" id="RestoreModel" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span class="text-left" style="float: left !important;" aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="POST" id="restoreUserForm">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <p class="text-center">
              Do you want to restore this post?
            </p>
            <input type="hidden" name="prod_id" id="product_id" value="">
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button> 
              <button type="submit" class="btn btn-warning">Yes Restore</button> &nbsp;
          </div>
        </form>
  
      </div>
    </div>
  </div>


@endsection



@section('scripts')

<script>

function handleDelete(id) {
      //console.log('star.', id)
     var form = document.getElementById('deleteCategoryForm')
     form.action = '/admin/posts/delete/' + id
     $('#deleteModel').modal('show')
  }
  
  
  function handleRestore(id) {
      //console.log('star.', id)
     var form = document.getElementById('restoreUserForm')
     form.action = '/admin/trashed/restore/' + id
     $('#RestoreModel').modal('show')
  }

</script>


@endsection
