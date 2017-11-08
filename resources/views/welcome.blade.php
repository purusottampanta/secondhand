@extends('layouts.app')

@section('stylesheet')
@parent
<link rel="stylesheet" href="{{ asset('lib/jcarousel/jcarousel.responsive.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-uppercase">YOU SELL WE BUY
         YOU BUY WE SELL</h3>
                </div>
                <div class="panel-body">
                    <div class="jcarousel-wrapper">
                        <div class="jcarousel">
                            <ul>
                                {{-- <li><a href="https://sorgalla.com/jcarousel/examples/_shared/img/img1.jpg"><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img1.jpg" alt="Image 1"></a></li>
                                <li><a href="https://sorgalla.com/jcarousel/examples/_shared/img/img2.jpg"><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img2.jpg" alt="Image 2"></a></li>
                                <li><a href="https://sorgalla.com/jcarousel/examples/_shared/img/img3.jpg"><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img3.jpg" alt="Image 3"></a></li>
                                <li><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img4.jpg" alt="Image 4"></li> --}}
                                {{-- <li><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img5.jpg" alt="Image 5"></li>
                                <li><img src="https://sorgalla.com/jcarousel/examples/_shared/img/img6.jpg" alt="Image 6"></li> --}}
                                <?php $count_slider = $sliders->count();?>
                                @forelse($sliders as $index => $slider)
                                   <li>
                                        <a href="{{ asset($slider->image_path) }}" target="_blank"> 
                                            <img src="{{ $slider->thumbnail() }}" alt="{{ $slider->image_name }}">
                                        </a>
                                    </li>
                                    @if($count_slider == 1)
                                        <li>
                                            <a href="{{ asset('img/sliders/slide2.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide2.jpg') }}" alt="slide2">
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="{{ asset('img/sliders/slide3.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide3.jpg') }}" alt="slide3">
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="{{ asset('img/sliders/slide4.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide4.jpg') }}" alt="slide4">
                                            </a>
                                        </li>
                                    @elseif($count_slider == 2)
                                        <li>
                                            <a href="{{ asset('img/sliders/slide3.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide3.jpg') }}" alt="slide3">
                                            </a>
                                        </li> 
                                        <li>
                                            <a href="{{ asset('img/sliders/slide4.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide4.jpg') }}" alt="slide4">
                                            </a>
                                        </li>
                                    @elseif($count_slider == 3)
                                        <li>
                                            <a href="{{ asset('img/sliders/slide4.jpg') }}" target="_blank">
                                                <img src="{{ asset('img/sliders/slide4.jpg') }}" alt="slide4">
                                            </a>
                                        </li>
                                    @endif
                              @empty
                                <li>
                                    <a href="{{ asset('img/sliders/slide1.jpg') }}" target="_blank">
                                        <img src="{{ asset('img/sliders/slide1.jpg') }}" alt="slide1">
                                    </a>
                                </li> 
                                <li>
                                    <a href="{{ asset('img/sliders/slide2.jpg') }}" target="_blank">
                                        <img src="{{ asset('img/sliders/slide2.jpg') }}" alt="slide2">
                                    </a>
                                </li> 
                                <li>
                                    <a href="{{ asset('img/sliders/slide3.jpg') }}" target="_blank">
                                        <img src="{{ asset('img/sliders/slide3.jpg') }}" alt="slide3">
                                    </a>
                                </li> 
                                <li>
                                    <a href="{{ asset('img/sliders/slide4.jpg') }}" target="_blank">
                                        <img src="{{ asset('img/sliders/slide4.jpg') }}" alt="slide4">
                                    </a>
                                </li>
                              @endforelse
                            </ul>
                        </div>

                        <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="jcarousel-control-next">&rsaquo;</a>

                        {{-- <p class="jcarousel-pagination"></p> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3"  style="margin: 0px !important; padding: 0px !important">
                <div style="margin-top: -20px">
                    @include('layouts.categories')
                </div>
            </div>
                
            <div class="col-md-9" style="margin: 0px !important; padding: 0px !important">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">Featured Ads</div>
                        <div class="panel-body pad-0">
                            <div class="col-md-12">
                                @forelse($featured->chunk(3) as $index => $chunked_featured)
                                    <div class="row" style="border-bottom: 1px solid #bce8f1;">
                                        @foreach($chunked_featured as $key => $featured_ad)
                                            <div class="col-md-4 pad-b-20" style="border-right: 1px solid #bce8f1; min-height: 21.7em">
                                                <a href="{{ route('general.products.show', ['category' => $featured_ad->category, 'slug'=> $featured_ad->product_slug]) }}">
                                                    <div class="row pad-b-20">
                                                        <div class="pad-10">
                                                            <img src="{{ $featured_ad->images->first() ? $featured_ad->images->first()->smallThumbnail() : '' }}" height="100%" width="100%" alt="{{ $featured_ad->product_name }}">
                                                        </div>
                                                        <div class="pad-10 text-center">
                                                            {{ str_limit($featured_ad->product_name, 40) }}
                                                            <br>
                                                            Rs. {{ $featured_ad->price }}
                                                            <br>
                                                            ({{ ucfirst(implode(' ', explode('_', $featured_ad->condition))) }})
                                                        </div>
                                                    </div>
                                                </a>
                                                @if($index == 2 && $key == 8)
                                                    <div class="pull-right" style="position: absolute; bottom: .5em; right: 0.5em">
                                                        <a href="{{ route('featured') }}"><i class="fa fa-chevron-circle-right pad-r-5"></i>view more</a>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="padding-bottom: -10px !important">
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading">New Arrivals</div>
                            <div class="panel-body pad-0">
                                <div class="col-md-12">
                                    @forelse($products->chunk(3) as $index => $chunked_products)
                                        <div class="row" style="border-bottom: 1px solid #bce8f1;">
                                            @foreach($chunked_products as $key => $product)
                                                <div class="col-md-4 pad-b-20" style="border-right: 1px solid #bce8f1; min-height: 21.7em">
                                                    <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                                        <div class="row pad-b-20">
                                                            <div class="pad-10">
                                                                <img src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" height="100%" width="100%" alt="{{ $product->product_name }}">
                                                            </div>
                                                            <div class="pad-5 text-center">
                                                                {{ str_limit($product->product_name, 40) }}
                                                                <br>
                                                                Rs. {{ $product->price }}
                                                                <br>
                                                                ({{ ucfirst(implode(' ', explode('_', $product->condition))) }})
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @if($index == 2 && $key == 8)
                                                        <div class="pull-right" style="position: absolute; bottom: .5em; right: 0.5em">
                                                            <a href="{{ route('recent') }}"><i class="fa fa-chevron-circle-right pad-r-5"></i>view more</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-md-9" style="margin-left: -1.6em">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                        <div class="panel-heading">Featured Ads</div>
                        <div class="panel-body pad-0" style="padding-left: 15px">
                            <div class="row">
                                <div class="col-md-12 pad-l-0">
                                    @forelse($featured as $index => $featured_ad)
                                        <div class="col-md-3" style="border-right: 1px solid #bce8f1;">
                                            <a href="{{ route('general.products.show', ['category' => $featured_ad->category, 'slug'=> $featured_ad->product_slug]) }}">
                                                <div class="row">
                                                    <div class="pad-10">
                                                        <img src="{{ $featured_ad->images->first()->smallThumbnail() }}" height="100%" width="100%">
                                                    </div>
                                                    <div class="pad-10 text-center">
                                                        {{ $featured_ad->product_name }}
                                                        <br>
                                                        Rs. {{ $featured_ad->price }}
                                                        <br>
                                                        ({{ ucfirst(implode(' ', explode('_', $featured_ad->condition))) }})
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty

                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                        <div class="panel-heading">Recently added</div>
                        <div class="panel-body pad-0" style="padding-left: 15px">
                            @forelse($products->chunk(4) as $chunked_products)
                                <div class="row">
                                    <div class="col-md-12 pad-l-0">
                                        @foreach($chunked_products as $product)
                                            <div class="col-md-3" style="border-right: 1px solid #bce8f1;">
                                                <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                                    <div class="row">
                                                        <div class="pad-10">
                                                            <img src="{{ $product->images->first()->smallThumbnail() }}" height="100%" width="100%">
                                                        </div>
                                                        <div class="pad-10 text-center">
                                                            {{ $product->product_name}}
                                                            <br>
                                                            Rs. {{ $product->price }}
                                                            <br>
                                                            ({{ ucfirst(implode(' ', explode('_', $product->condition))) }})
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach                                      
                                    </div>
                                </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('javascript')
@parent
    <script src="{{ asset('lib/jcarousel/jquery.jcarousel.min.js') }}"></script>
    <script src="{{ asset('lib/jcarousel/jcarousel.responsive.js') }}"></script>

@endsection