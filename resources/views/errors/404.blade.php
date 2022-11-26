@extends('layouts.frontend.app')
<?php $lang = Config::get('app.locale'); ?>

@section('content')


            <!-- About Start -->
            <div class="about wow fadeInUp" data-wow-delay="0.1s">
                <div class="container">
                    <div class="row align-items-center text-center mb-5">
                        <div class="col-lg-12 col-md-12 mb-5">
                            <h1 class="display-1 mt-5 mb-5">404</h1>
                            <h4 >{{ $lang== 'ar' ?' عفواً لم يتم العثور ': 'Sorry Not Found'
                            }}</h4>
                            <a href="/" class="mb-5" > {{ $lang == 'ar' ? 'الرجوع للصفحة الرئيسية ':  'Back to home'}} </a>
                        </div> <br> <br>
                    </div>
                </div>
            </div>

 
@stop