@extends('frontend.layout.layout')

@section('content')

@include('frontend.inc.breadcrumb')
    <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
        <div class="container text-center"> <!-- text-center sınıfı içeriği ortalar -->
            <div class="row justify-content-center"> <!-- içeriği yatayda ortalar -->
                <div class="col-md-6 col-lg-8 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="">
                    <div class="text" style="width: 800px">
                        <h1>Ödeme Sayfası</h1>
                        <?php echo $paymentContent; ?>
                        <?php echo $paymentStatus; ?>

                        <div id="iyzipay-checkout-form" class="responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
