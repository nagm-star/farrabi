@extends('layouts.backend.app')

@section('content')

    <div class="card-body">
 
            <form action="{{ route('admin.setting.update', $settings->id ) }}" method="post" enctype="multipart/form-data">
                @csrf
      
                @method('PUT')

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
                <div class="card">

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">

                            <div class="form-group  row mb-2">
                                <div class="col-md-10">
                                <label for="" class="col-sm-2 col-form-label">Title</label>
                                    <input type="text" class="form-control  @if ($errors->has('name'))   is-invalid @endif" name="name" id="name"  value="{{ $settings->name }} ">
                                    @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row mb-2">
                                <div class="col-md-10">
                                <label for="name_en" class="col-sm-2 col-form-label">English Title</label>
                                    <input type="text" class="form-control  @if ($errors->has('name_en'))   is-invalid @endif" name="name_en" id="name_en"  value="{{ $settings->name_en }} ">
                                    @if ($errors->has('name_en'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name_en') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group  row mb-2">

                                <div class="col-md-10">
                                <label for="" class="col-sm-2 col-form-label">Key Words</label>
                                    <input type="text" class="form-control  @if ($errors->has('key'))   is-invalid @endif" name="key" id="key"  value="{{ $settings->key }} ">
                                    @if ($errors->has('key'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('key') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group  row mb-2">

                                <div class="col-md-10">
                                <label for="key_en" class="col-sm-2 col-form-label">English Key Words</label>
                                    <input type="text" class="form-control  @if ($errors->has('key_en'))   is-invalid @endif" name="key_en" id="key_en"  value="{{ $settings->key_en }} ">
                                    @if ($errors->has('key_en'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('key_en') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group  row">
                                <div class="col-md-10">
                                <label for="" class="col-sm-2 col-form-label">Description</label>
                                <textarea row="2" name="description" class="form-control @if ($errors->has('description'))   is-invalid @endif" id="js-ckeditor" cols="30"  rows="10"  >
                                    {{isset($settings) ? $settings->description : old('description')}} 
                                </textarea>
                                @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                                @endif
                            </div>
        
                            <div class="form-group  row">
                                <div class="col-md-10">
                                <label for="description_en" class="col-sm-2 col-form-label">Description</label>
                                <textarea row="2" name="description_en" class="form-control @if ($errors->has('description_en'))   is-invalid @endif" id="js-ckeditor-en" cols="30"  rows="10"  >
                                    {{isset($settings) ? $settings->description_en : old('description_en')}} 
                                </textarea>
                                @if ($errors->has('description_en'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description_en') }}
                                </div>
                                @endif
                            </div>
                            </div>

                  @if (isset($settings))
                  <div class="form-group row">
                      <div class="col-sm-10">
                    <label  class="col-sm-2 control-label" for=""></label>
                      <img src="{{ asset($settings->image) }}" alt="{{ $settings->name}}" height="50px" width="150px"  srcset="">
                    </div>
                  </div>
        
                  @endif
        
                    <div class="form-group row mt-2">
                        <div class="col-sm-10">
                          <label  class="col-sm-2 control-label" for="image">Fav Icon</label>
                          <input type="file" class="form-control" name="image" id="image">
                          <p style="color:red; !important; top:2px;">Recommended size: 16x16 pixles</p>
                          </div>
                          
                    </div>

                  <div class="form-group row"> 
                      <div class="col-md-10">
                          <label for="" class="col-sm-2 col-form-label">Address</label>
                              <input type="text" class="form-control  @if ($errors->has('address'))   is-invalid @endif" name="address" id="address"  value="{{ $settings->address }} ">
                              @if ($errors->has('address'))
                              <div class="invalid-feedback">
                                  {{ $errors->first('address') }}
                              </div>
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="form-group  row mb-2">
                    <div class="col-md-10">
                    <label for="" class="col-sm-2 col-form-label">Email</label>
                        <input type="email" class="form-control  @if ($errors->has('email'))   is-invalid @endif" name="email" id="email"  value="{{ $settings->email }} ">
                        @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                    </div>
                </div>

                  
                  <div class="form-group row mb-3">

                    <div class="col-md-10">
                        <label for="" class="col-sm-2 col-form-label">Contact Number</label>
                            <input type="text" class="form-control  @if ($errors->has('contact_number'))   is-invalid @endif" name="contact_number" id="contact_number"  value="{{ $settings->contact_number }} ">
                            @if ($errors->has('contact_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('contact_number') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <b> Social Media </b>
                    <hr />
               
                    <div class="form-group  row mb-2">

                        <div class="col-md-10">
                        <label for="" class="col-sm-2 col-form-label">Facebook Page Link</label>
                            <input type="text" class="form-control  @if ($errors->has('facebook'))   is-invalid @endif" name="facebook" id="facebook"  value="{{ $settings->facebook }} ">
                            @if ($errors->has('facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('facebook') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group  row mb-2">

                        <div class="col-md-10">
                        <label for="" class="col-sm-2 col-form-label">Twitter Link</label>
                            <input type="text" class="form-control  @if ($errors->has('twitter'))   is-invalid @endif" name="twitter" id="twitter"  value="{{ $settings->twitter }} ">
                            @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group  row mb-2">

                        <div class="col-md-10">
                        <label for="" class="col-sm-3 col-form-label">Youtube Channel Link</label>
                            <input type="text" class="form-control  @if ($errors->has('youtube'))   is-invalid @endif" name="youtube" id="youtube"  value="{{ $settings->youtube }} ">
                            @if ($errors->has('youtube'))
                            <div class="invalid-feedback">
                                {{ $errors->first('youtube') }}
                            </div>
                            @endif
                        </div>
                    </div>

               <div class="form-group row">
                   <div class="col-sm-10">
                    <button class="btn btn-lg btn-success">
                        Update
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
    
     CKEDITOR.replace( 'js-ckeditor' );
     CKEDITOR.replace( 'js-ckeditor-en' );
    
    </script>

@endsection
