    <!--============================
        BANNER PART 2 START
    ==============================-->
    <section id="wsus__banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__banner_content">
                        <div class="row banner_slider">
                            @foreach($sliders as $slider)
                            <div class="col-xl-12">
                                <div class="wsus__single_slider" style="background: url('{{ asset($slider->banner ? 'storage/banner/' . $slider->banner : 'default/image.jpg') }}') no-repeat center center/cover;"
                                    >
                                    <div class="wsus__single_slider_text">
                                        <h3>{!! $slider -> type !!}</h3>
                                        <h1>{!! $slider -> title !!}</h1>
                                        <h6>Desde S/.{{$slider->starting_price}}</h6>
                                        <a class="common_btn" href="{{$slider->btn_url}}">Comprar ahora</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BANNER PART 2 END
    ==============================-->