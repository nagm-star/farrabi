@extends('layouts.frontend.app')


@section('content')
    
<?php $lang = Config::get('app.locale'); ?>

<main id="main" class="body-dir">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="/">{{ __('translate.header.home' )}}</a></li>
          <li>{{ __('translate.content.mediagallery' )}}</li>
        </ol>
        <h2>{{ __('translate.content.mediagallery' )}}</h2>

      </div>
    </section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Section ======= -->
            <section id="portfolio" class="portfolio">
              <div class="container" data-aos="fade-up">
  
                  <div class="section-title">
                      <h2>{{ __('translate.content.mediagallery' )}}</h2>
                  </div>
  
                  <div class="row" data-aos="fade-up" data-aos-delay="100">
                      <div class="col-lg-12 d-flex justify-content-center">
                          <ul id="portfolio-flters">
                              <li data-filter="*" class="filter-active">
                                {{ $lang=='ar' ? 'الكل' : 'ALL' }}
                              </li>
                             @foreach ($portfolios as $portfolio)                
                             <li data-filter=".{{$portfolio->name_en}}">{{ $lang=='ar' ? $portfolio->name : $portfolio->name_en }}</li>
                             @endforeach
                          </ul>
                      </div>
                  </div>
  
                  <div class="row portfolio-container justify-content-md-center" data-aos="fade-up" data-aos-delay="200">
  
            @foreach ($portfolios as $portfolio)                

                      <div class="col-lg-4 col-md-6 portfolio-item {{ $portfolio->name_en}}">
                          <img src="{{ asset('/uploads/gallery/'.json_decode($portfolio->image)[0]) }}" class="img-fluid" alt="">
                          <div class="portfolio-info">
                              <h4 class="float-left">{{ $lang=='ar' ? $portfolio->name : $portfolio->name_en}}</h4>
                              <a href="{{ asset('/uploads/gallery/'.json_decode($portfolio->image)[0]) }}" 
                                data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{ $lang=='ar' ? $portfolio->name : $portfolio->name_en}}">
                                <i class="bx bx-plus"></i>
                              </a>
                              <a href="{{ route('portfolio.show', $lang == 'ar' ? $portfolio->slug : $portfolio->slug_en) }}" 
                                 class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                          </div>
                      </div>
             @endforeach
  
                  </div>
  
              </div>
          </section>
          <!-- End Portfolio Section -->
 
 
  </main><!-- End #main -->


@endsection