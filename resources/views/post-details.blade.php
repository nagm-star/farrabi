@extends('layouts.frontend.app')

@section('content')

<?php $lang = Config::get('app.locale'); ?>
  <main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>{{ $lang == 'ar' ? $post->title : $post->title_en }}</h2>
          <ol>
            <li><a href="/">{{__('translate.header.home')}}</a></li>
            <li><a href="">{{__('translate.content.news')}}</a></li>
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

                <div class="swiper-slidee">
                  <img src="{{ $post->image }}" alt="">
                </div> 

              </div>
              <div class="swiper-pagination"></div>
              <p>
                {!! $lang == 'ar' ? $post->body : $post->body_en !!}
                </p>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>{{ __('translate.related-post') }}</h3>
              <ul>
                @foreach ($latest as $latestPost)
                <li>
                    <a class="nav-link scrollto" href="{{ route('post.show', $latestPost->slug )}}">
                        {{ $lang == 'ar' ? $latestPost->title : $latestPost->title_en }}
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

  </main><!-- End #main -->

@endsection