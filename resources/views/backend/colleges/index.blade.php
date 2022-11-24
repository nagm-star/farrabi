@extends('layouts.backend.app')

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
        <div class="flex-grow-1">
          <h1 class="h3 fw-bold mb-2">
            colleges
          </h1>
            <div class="">
                <a class="btn btn-success mt-2 mb-0" href="{{ route('admin.colleges.create') }}">
                  Add New college  <i class="nav-main-link-icon si si-plus"></i>
                </a>
              </div>          
        </div>
        <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">
              <a class="link-fx" href="{{ route('admin.home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
              colleges
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
        <h3 class="block-title">colleges </h3>
      </div>
      <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
          <thead>
            <tr>
              <th>Title</th>
              <th class="d-none d-sm-table-cell" style="width: 30%;">Body</th>
              <th style="width: 15%;">Type</th>
              <th style="width: 15%;">Action</th>
            </tr>
          </thead>
          <tbody>

            @if($colleges->count() > 0)
            @foreach ($colleges as $college)
            <tr>
              <td class="fw-semibold fs-sm">{!!  substr(strip_tags($college->title), 0, 50) !!}</td>
              <td class="d-none d-sm-table-cell fs-sm">
                {!!  substr(strip_tags($college->body), 0, 50) !!} 
              </td>
              @if ($college->category)
              <td class="d-none d-sm-table-cell fs-sm">
                    Sudanese colleges
              </td>
              @else
              <td class="d-none d-sm-table-cell fs-sm">
                Foreigner college
              </td>

              @endif
              <td class="text-left fs-sm">
                <a class="btn btn-sm btn-alt-secondary" href="{{ route('admin.colleges.show', $college->id) }}" data-bs-toggle="tooltip" title="View">
                  <i class="fa fa-fw fa-eye"></i>
                </a>
                <a class="btn btn-sm btn-alt-warning" href="{{ route('admin.colleges.edit', $college->id) }}" data-bs-toggle="tooltip" title="Edit">
                  <i class="fa fa-fw fa-pen text-warning"></i>
                </a>
                <a class="btn btn-sm btn-alt-danger" onclick="handleDelete({{ $college->id }})" data-bs-toggle="tooltip" title="Delete">
                  <i class="fa fa-fw fa-times text-danger"></i>
                </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4" class="d-none d-sm-table-cell fs-sm text-center">
                  <p calss="text-center">No colleges</p>
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
@endsection

@section('scripts')
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}

<script>

  function handleDelete(id) {
      //console.log('star.', id)
     var form = document.getElementById('deleteCategoryForm')
     form.action = '/admin/colleges/' + id
     $('#deleteModel').modal('show')
  }
 

</script>


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

@stop