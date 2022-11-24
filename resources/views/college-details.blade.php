@extends('layouts.frontend.app')

@section('content')

<?php $lang = Config::get('app.locale'); ?>
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{  $lang =='ar' ? $college->title : $college->title_en  }}</h2>
          <ol>
            <li><a href="/">{{ __('translate.header.home') }}</a></li>
            <li><a href="">{{ __('translate.header.program') }}</a></li>
          </ol>
        </div>

      </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">

                <div class="swiper-slide">
                  <img src="{{ $college->image }}" alt="">
                </div> 

              </div>
              <div class="swiper-pagination"></div>
              <p>
                {!! $lang == 'ar' ? $college->body : $college->body_en !!}
                </p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>{{ __('translate.related-college') }}</h3>
              <ul>
                @foreach ($AllColleges as $college_header)
                <li>
                    <a class="nav-link scrollto" href="{{ route('college.show', $college_header->slug )}}">
                        {{ $lang == 'ar' ? $college_header->title : $college_header->title_en }}
                    </a>
                </li>
                @endforeach    
              </ul>
            </div>

          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->

@endsection