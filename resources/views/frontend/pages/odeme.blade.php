@extends('frontend.layout.layout')

@section('content')

@include('frontend.inc.breadcrumb')

<div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
          <div class="icon mr-4 align-self-start">

          </div>
          <div class="text">
<h1>Ödeme Sayfası</h1>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
          <div class="icon mr-4 align-self-start">
            
          </div>
          <div class="text">


          </div>
        </div>
        <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
          <div class="icon mr-4 align-self-start">
            
          </div>
          <div class="text">
            
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="site-section" data-aos="fade">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-6">
          <div class="block-16">
            <?php echo $paymentContent; ?>
            <?php echo $paymentStatus; ?>
            <div id="iyzipay-checkout-form" class="responsive"></div>
          </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">





        </div>
      </div>
    </div>
  </div>


  

@endsection
