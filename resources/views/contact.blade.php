@extends('layouts.frontend.app')

@section('content')
<?php $lang = Config::get('app.locale'); ?>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>
                      {{  __('translate.contact') }}  </h2>
            <ol>
              <li><a href="/">{{  __('translate.header.home') }}</a></li>
              <li>   {{  __('translate.contact') }} </li>
            </ol>
          </div>
  
        </div>
      </section><!-- End Breadcrumbs -->
  
     <!-- ======= Contact Section ======= -->
     <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2> {{  __('translate.contact') }} </h2>
          </div>
  
          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-6">
              <div class="info-box mb-4">
                <i class="bx bx-map"></i>
                <h3>{{ __('translate.content.address') }} </h3>
                <p>{{ $lang =='ar' ? $settings->address : $settings->address_en }}</p>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6">
              <div class="info-box  mb-4">
                <i class="bx bx-envelope"></i>
                <h3> {{  __('translate.content.email') }}</h3>
                <p>{{ $settings->email }}</p>
              </div>
            </div>
  
            <div class="col-lg-3 col-md-6">
              <div class="info-box  mb-4">
                <i class="bx bx-phone-call"></i>
                <h3>{{ __('translate.contact') }} </h3>
                <p>{{ $settings->contact_number }}</p>
              </div>
            </div>
  
          </div>
  
          <div class="row" data-aos="fade-up" data-aos-delay="100">
  
            <div class="col-lg-6 ">
              <iframe class="mb-4 mb-lg-0" src="{{ $settings->map }}" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
            </div>
  
            <div class="col-lg-6">
              
            @error('g-recaptcha-response')
           <div class="alert alert-danger">
              <ul>
                       <li>{{ $errors->first('g-recaptcha-response') }}</li>
              </ul>
          </div><br />
           @enderror
                <form action="{{ route('send.email') }}" method="post" role="form" class="php-email-form2">
                    {{ csrf_field() }}
          
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            {{session('success')}}
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
   </div>
    @endif
                <div class="row">
                  <div class="col form-group">
                    <input type="text" name="name" class="form-control @if ($errors->has('name'))  value="{{ old('name') }}"   is-invalid @endif" id="name" placeholder="الإسم" required>
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                    @endif
                  </div>
                  <div class="col form-group">
                    <input type="email" class="form-control @if ($errors->has('email'))   value="{{ old('email') }}" is-invalid @endif" name="email" id="email" placeholder=" البريد الالكتروني" required>
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control @if ($errors->has('subject'))  value="{{ old('subject') }}"  is-invalid @endif" name="subject" id="subject" placeholder="الموضوع" required>
                  @if ($errors->has('subject'))
                  <div class="invalid-feedback">
                      {{ $errors->first('subject') }}
                  </div>
                  @endif
                </div>
                <div class="form-group">
                  <textarea class="form-control @if ($errors->has('message'))   value="{{ old('message') }}" is-invalid @endif" name="message" rows="5" placeholder="الرسالة" required></textarea>
                  @if ($errors->has('message'))
                  <div class="invalid-feedback">
                      {{ $errors->first('message') }}
                  </div>
                  @endif
                </div>
                <div class="form-group">
                    <div  class="g-recaptcha" data-sitekey="6LdRAx0cAAAAAHrYeUBVtxRq-X3d1Azge-axWAJC"> </div>
    
                 </div>
                <div class="text-center"><button type="submit">{{ __('translate.content.message') }}   </button></div>
              </form>
            </div>
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
  



@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>

@stop