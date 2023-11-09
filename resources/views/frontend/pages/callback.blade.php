@extends('frontend.layout.layout')


@section('content')
    @include('frontend.inc.breadcrumb')

    <div class="site-section site-section-sm site-blocks-1 border-0" data-aos="fade">
        <div class="container text-center"> <!-- text-center sınıfı içeriği ortalar -->
            <div class="row justify-content-center"> <!-- içeriği yatayda ortalar -->
                <div class="col-md-6 col-lg-8 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="">
                    <div class="text" style="width: 800px">
                        <?php if($paymentStatus == 'SUCCESS'){ ?>
                        <h1>Ödeme Başarılı! Yılmaz Karadavut</h1>
                        <?php }else{ ?>
                        <h1>Bir Hata Oluştu!</h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = '/'; // Yönlendirilecek sayfanın URL'sini buraya ekleyin
        }, 3000);
    </script>
@endsection
