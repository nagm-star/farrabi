@extends('layouts.frontend.app')

@section('content')
<?php $lang = Config::get('app.locale'); ?>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
  
          <div class="d-flex justify-content-between align-items-center">
              <ol>
                  <li><a href="/">{{ __('translate.content.mediagallery' )}}</a></li>
                  <li>   {{ __('translate.content.mediagallery' )}} </li>
                </ol>
                <h2>
                          {{ $lang == 'ar' ? $portfolio->name : $portfolio->name_en}} 
                </h2>
          </div>
  
        </div>
      </section><!-- End Breadcrumbs -->
  
  
 
      <section id="portfolio-details" class="portfolio-details">
        <div class="container">
  
          <div class="row gy-4">
  
            <div class="col-lg-8">
              <div class="portfolio-details-slider swiper">
                <div class="swiper-wrapper align-items-center">
  
                    
                    @foreach(json_decode($portfolio->image) as $image)
                    <div class="swiper-slide">
                      <img src="{{ asset('/uploads/gallery/'.$image ) }}" height="100px" class="img-fluid" alt="{{ $portfolio->title }}">
                    </div>
                  @endforeach 
  
                </div>
                <h5> {{ $lang == 'ar' ?  $portfolio->name :  $portfolio->name_en }} </h5>
                <div class="swiper-pagination"></div>
              </div>
            </div>
  
            <div class="col-lg-4">
              <div class="portfolio-info">
                <h3>  {{ __('translate.content.mediagallery' )}}  </h3>
                <ul>
                    @foreach ($latestPhoto as $photo)
                    <li>
                        <a class="nav-link scrollto" href="{{ route('portfolio.show', $lang == 'ar' ? $photo->slug : $photo->slug_en) }}">
                            {{ $lang == 'ar' ? $photo->name : $photo->name_en }}
                        </a>
                        <hr>
                    </li>
                    @endforeach   
                </ul>
              </div>

            </div>
  
          </div>
  
        </div>
      </section><!-- End Portfolio Details Section -->
  



@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js"></script>

@stop