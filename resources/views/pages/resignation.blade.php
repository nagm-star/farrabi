@extends('layouts.frontend.app')

@section('content')

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
            <h2>
                      {{ __('translate.header.resignation') }} </h2>
            <ol>
              <li><a href="/">{{ __('translate.header.home') }}</a></li>
              <li>   {{ __('translate.header.resignation') }}</li>
            </ol>
          </div>
  
        </div>
      </section><!-- End Breadcrumbs -->
  
     <!-- ======= Contact Section ======= -->
     <section id="contact" class="contact">

        <div class="row justify-content-md-center">
            <div class="col-md-8">
               {!! __('about.Resignation') !!}
            </div>
        </div>

      </section><!-- End Contact Section -->
  



@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>

@stop