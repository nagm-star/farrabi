@extends('layouts.frontend.app')

@section('content')
<?php $lang = Config::get('app.locale'); ?>

<div class="home-slider owl-carousel js-fullheight" dir="ltr">
  @if($slides->count() > 0)
  @foreach($slides as $slide)
  <div class="slider-item js-fullheight" style="background-image:url({{ $slide->image }});">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-12 ftco-animate">
                <div class="text w-100 text-center">
                    <p> {{ $lang == 'ar' ? $slide->title  : $slide->title_en }}  </p>
                    <h1 class="mb-3">  {{ $lang == 'ar' ? $slide->body  : $slide->body_en }}  </h1>
                </div>
            </div>
        </div>
    </div>
</div>
  @endforeach
  @else
  <div class="slider-item js-fullheight" style="background-image:url(frontend/carousel/images/slider-1.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
            <div class="col-md-12 ftco-animate">
                <div class="text w-100 text-center">
                    <p>     </p>
                    <h1 class="mb-3">{{ __('translate.header.farabi')}}     </h1>
                </div>
            </div>
        </div>
    </div>
</div>
  @endif
</div>

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-title">
            <h2>{{  __('translate.content.elearn') }}</h2>
            {{-- <h3>   <span></span></h3> --}}
            {{-- <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p> --}}
          </div>
  
          <div class="row">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
              <img src="{{ asset('img/about.png') }}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
              <h3> {{ __('translate.content.big') }}</h3>
              <p class="fst-italic">
                {{ __('translate.content.big-about') }}
              </p>
              <ul>
                <li>
                  <i class="bx bx-store-alt"></i>
                  <div class="mr-3">
                    <h5></h5>
                    <p>{{ __('translate.content.big1') }}</p>
                  </div>
                </li>
                <li>
                  <i class="bx bx-images"></i>
                  <div class="mr-3">
                    <p>{{ __('translate.content.big2') }}</p>
                  </div>
                </li>
              </ul>
              <div class="text-center">
                  <a href="https://biggoaledu.com/" target="_blank" class="btn btn-primary btn-lg">{{ __('translate.content.getstart') }}</a>
              </div>
            </div>
          </div>
  
        </div>
      </section><!-- End About Section -->
  

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">

        <div class="section-title">
            <h2>{{ __('translate.header.program')}} </h2>
        </div>

        <div class="container" data-aos="fade-up">
  
          <div class="row justify-content-md-center">
            @foreach($AllColleges as $college)
            <div class="col-md-6 col-lg-4 d-flex align-items-center mb-5 mb-lg-0" style="margin-bottom: 10px !important;">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                <h4 class="title"><a href="">{{ $lang=='ar' ? $college->title : $college->title_en}}</a></h4>
                <p class="description">{!!  substr(strip_tags($lang =='ar' ? $college->body : $college->body_en), 0, 200) !!}
                     .. <a href="{{ route('college.show', $lang == 'ar' ? $college->slug : $college->slug_en  )}}"> 
                        {{  __('translate.content.details') }} 
                    </a>  
                </p>
            </div>
            </div> 
            @endforeach
          </div>
  
        </div>
      </section><!-- End Featured Services Section -->


<!-- ======= Team Section ======= -->
<section id="news" class="services sedction-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>{{ __('translate.content.news')}} </h2>
        </div>

        <div class="row">
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box">
                  <img src="{{ $post->image }}" style="" class="img-fluid" alt="{{ $lang =='ar' ? $post->title : $post->title_en }}">
                  <h5><a href="{{ route('post.show', $lang =='ar' ? $post->slug : $post->slug_en) }}"  class="url-color">{{ $lang=='ar' ? $post->title : $post->title_en}}</a></h5>
                      <p>{!!  substr(strip_tags($lang =='ar' ? $post->body : $post->body_en), 0, 350) !!} ...
                        <a href="{{ route('post.show', $lang =='ar' ? $post->slug : $post->slug_en) }}" class="url-color">
                          <b>   {{ __('translate.readmore')}} </b>
                        </a>
                      </p>
                </div>
              </div>
            @endforeach
        </div>

    </div>
</section>
<!-- End Team Section -->



</main>
<!-- End #main -->


@endsection