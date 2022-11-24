@extends('layouts.backend.app')

@section('content')


    <div class="card-body">
 
        <form action="{{ isset($colleges) ? route('admin.colleges.update', $colleges->id) : route('admin.colleges.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            @if(isset($colleges))
            @method('PUT')
            @endif

            <div class="modal-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <div class="accordion" id="accordionExample">
                    <a href="{{ route('admin.colleges.index') }}" style="margin-right:10px;" class="btn btn-info btn-sm mb-2 float-left" type="submit"><i class="fa fa-reply">&nbsp;</i>Back</a>
                <div class="card">

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <h5>Arabic Content</h5> <hr>
                            <div class="form-group  row mb-2">

                                <div class="col-md-10">
                                <label for="" class="col-sm-2 col-form-label">Title</label>
                                    <input type="text" class="form-control  @if ($errors->has('title'))   is-invalid @endif" name="title" id="title"  value="{{ isset($colleges) ? $colleges->title : old('title')}}">
                                    @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group  row">

                                <div class="col-md-10">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <textarea name="body" class="form-control @if ($errors->has('body'))   is-invalid @endif" id="js-ckeditor" cols="30"  rows="10"  >{{isset($colleges) ? $colleges->body : old('body')}}</textarea>
                                @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                                @endif

                                </div>
                            </div>
                            <h5 class="mt-3">English Content</h5> <hr>
                            <div class="form-group  row mb-2">

                                <div class="col-md-10">
                                <label for="title_en" class="col-sm-2 col-form-label">Title</label>
                                    <input type="text" class="form-control  @if ($errors->has('title_en'))   is-invalid @endif" name="title_en" id="title_en"  value="{{ isset($colleges) ? $colleges->title_en : old('title_en')}}">
                                    @if ($errors->has('title_en'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title_en') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group  row">

                                <div class="col-md-10">
                                <label for="body_en" class="col-sm-2 col-form-label">Description</label>
                                <textarea name="body_en" class="form-control @if ($errors->has('body_en'))   is-invalid @endif" id="js-ckeditor-en" cols="30"  rows="10"  >{{isset($colleges) ? $colleges->body_en : old('body_en')}}</textarea>
                                @if ($errors->has('body_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body_en') }}
                                </div>
                                @endif

                                </div>
                            </div>
                  <br>
                  @if (isset($post))
                  <div class="form-group row">
                      <div class="col-sm-10">
                    <label  class="col-sm-2 control-label" for=""></label>
                      <img src="{{ asset($post->image) }}" alt="" height="50px" width="150px"  srcset="">
                    </div>
                  </div>
        
                  @endif
        
                    <div class="form-group row">
                        <div class="col-sm-10">
                          <label  class="col-sm-2 control-label" for="image">Image</label>
                          <input type="file" class="form-control" name="image" id="image">
                          <p style="color:red; !important; top:2px;">Recommended size: 600x200 pixles</p>
                          </div>
                          
                    </div>
               
                <div class="form-group row mb-2">
                    <div class="col-sm-10">
                        <label class="form-label">Published?</label> 
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="{{ isset($colleges) ? $colleges->status : 1 }}"
                             id="status" name="status" @if(isset($colleges) && $colleges->status === 1) checked @endif >
                            <label class="form-check-label" for="status"></label>
                        </div>
                    </div>
                </div>

               <div class="form-group row">
                   <div class="col-sm-10">
                    <button class="btn btn-lg btn-success">
                        {{ isset($colleges) ? 'Update' : 'Save'}}
                    </button>
               </div>
            </div>
            </div>

        </div>


            </div>
        </form>

    </div>


@endsection


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@stop

@section('scripts')
<script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

 flatpickr('#published_at', {

enableTime: true,

enableSecond: true

})

 CKEDITOR.replace( 'js-ckeditor' );
 CKEDITOR.replace( 'js-ckeditor-en' );

</script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@stop


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@stop

@section('scripts')
<script src="{{ asset('backend/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('backend/js/plugins/dropzone/min/dropzone.min.js') }}"></script>

<script>
     flatpickr('#published_at', {
    
    enableTime: true,
    
    enableSecond: true
    
    })
    

    </script>

@endsection