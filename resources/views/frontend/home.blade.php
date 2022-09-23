@extends('frontend.layouts.app')
@section('content')
  <div class="container">
    <h1 class="tw-text-3xl tw-text-red-500 tw-font-bold tw-underline">
      Hello world!
    </h1>
    <p>{{ __('lang.home') }}</p>
    <div class="row">
      <div class="col-md-8 col-sm-12">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg" class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg" class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="https://res.klook.com/images/fl_lossy.progressive,q_65/c_fill,w_1295,h_971/w_80,x_15,y_15,g_south_west,l_Klook_water_br_trans_yhcmh3/activities/njzpudmx1xer0r6edynk/BicycleRentalatPulauUbin.jpg" class="d-block w-100" alt="..." style="height: 400px !important; object-fit:cover">
              <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="col-md-4">

        <div class="row">
          <div class="col-md-12">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://cdn.dribbble.com/users/8066256/screenshots/15918044/cycle-sell-post-design_4x.jpg" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
                <div class="carousel-item">
                  <img src="https://cdn.dribbble.com/users/3488450/screenshots/14969137/media/b41bfb478d26a25643d46b98a2604afa.png?compress=1&resize=400x300" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
                <div class="carousel-item">
                  <img src="https://www.promaticsindia.com/blog/wp-content/uploads/2018/07/World%E2%80%99s-top-bike-sharing-Programs-and-Apps.jpg" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQT-d8cgqC44RIS83OmHNugQwMc7b7MGAk7MGas2SWg7332ZprpvhyQMwtpqL8L-XxWPOs&usqp=CAU" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
                <div class="carousel-item">
                  <img src="https://e7.pngegg.com/pngimages/647/843/png-clipart-trek-bicycle-corporation-bicycle-shop-logo-electra-bicycle-company-giant-bike-text-trademark.png" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
                <div class="carousel-item">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQl_Y1lToB3urd0a0ri1F3oCHylN6KM17vvJQ&usqp=CAU" class="d-block w-100" alt="..." style="height: 200px !important; object-fit:cover">
                </div>
              </div>
              <!--
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            -->
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
