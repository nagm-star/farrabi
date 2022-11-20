@extends('layouts.backend.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">

         <div class="card card-header">
             <div class="row">
                 
                 <div class="col-md-6 float-left">
                    <a href="{{ route('admin.posts.index') }}" style="margin-right:10px;" class="btn btn-info btn-sm float-left" type="submit"><i class="fa fa-reply">&nbsp;</i>Back</a>
                    @if ($post->status)
                    <button class="btn btn-danger btn-sm float-left"  onclick="handleUnPublish({{ $post->id }})"><span class="fa fa-send"></span> Inactive</button>
                    @else
                    <button class="btn btn-success btn-sm float-left" onclick="handlePublish({{ $post->id }})"><span class="fa fa-send"></span> Active</button>
                    @endif
                    <a href="{{ route('admin.posts.edit', $post->id) }}" style="margin-left:10px;" class="btn btn-primary btn-sm float-left" type="submit"><i class="fa fa-pen">&nbsp;</i>Edit</a>

                 </div>
             </div>
         </div>

                <div class="card-body">
                    <div class="row">

                           <div class="col-md-8 float-right">
                               <div class="col-md-12 text-right">
                                   <h6  dir="rtl"><b class="color">Title:</b> <br>{!! $post->title !!}</h6>
                                   <h6  dir="rtl"><b class="color">Description:</b><p class="text-right">{!! $post->body !!}</p></h6>
                                   <hr>
                                   <h6  dir="rtl"><b class="color">English Title:</b> <br>{!! $post->title_en !!}</h6>
                                   <h6  dir="rtl"><b class="color">English Description:</b><p class="text-right">{!! $post->body_en !!}</p></h6>
                                   <hr>
                               </div>
      
                           </div>
                           <div class="col-md-4 float-left">
                       
                            <img src="{{ $post->image }}" class="img-fluid" alt="{{ $post->title }}">
                          
                           </div>
                    </div>
                 </div>
             </div>

         </div>

        </div>
    </div>

    <!-- Delete Modal -->
<div class="modal fade modal-danger" id="publish" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-left" id="exampleModalLabel"> Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span class="text-left" style="float: left !important;" aria-hidden="true">&times;</span>
                </button>
              </div>
            <form action="" method="POST" id="publishPost">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <p class="text-left">
                    Do you want to publish?
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success">Yes, Publish</button> 
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                </div>
              </form>

          </div>
        </div>
      </div>


       <!-- Delete Modal -->
<div class="modal fade modal-danger" id="unpublish" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-left" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="" method="POST" id="unpublishPost">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <p class="text-left">
                    Do you want to unpublish post?
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Yes, Unpublish</button> 
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button> 
                </div>
              </form>
  
          </div>
        </div>
      </div>

@endsection


@section('scripts')


<script>

function handlePublish(id) {
    //console.log('star.', id)
    var form = document.getElementById('publishPost')
    form.action = '/admin/posts/Publish/' + id
    $('#publish').modal('show')
}


function handleUnPublish(id) {
    //console.log('star.', id)
    var form = document.getElementById('unpublishPost')
    form.action = '/admin/posts/unPublish/' + id
    $('#unpublish').modal('show')
}

</script>

@stop
