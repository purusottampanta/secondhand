@extends('layouts.app')

@section('stylesheet')
@parent
<link rel="stylesheet" href="{{ asset('lib/jcarousel/jcarousel.responsive.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
           {{--  <div class="panel panel-info">
                <div class="panel-heading"> --}}
                    {{-- <h3 class="mar-0 text-center" style="padding:30px; font-size: 30px; color: #1565C0">{{ ucwords('you sell we buy you buy we sell') }}</h3> --}}
                {{-- </div>
                <div class="panel-body"> --}}
                    <div class="jcarousel-wrapper pad-t-20">
                        <div class="jcarousel">
                            <ul>
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
                {{-- </div>
            </div> --}}
        </div>
        <div class="row">
            {{-- <div class="col-md-3"  style="margin: 0px !important; padding: 0px !important">
                <div style="margin-top: -20px">
                    @include('layouts.categories')
                </div>
            </div> --}}
                
            {{-- <div class="col-md-9" style="margin: 0px !important; padding: 0px !important">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">Featured Ads</div>
                        <div class="panel-body pad-0">
                            <div class="col-md-12">
                                @forelse($featured->chunk(4) as $index => $chunked_featured)
                                    <div class="row" style="border-bottom: 1px solid #bce8f1;">
                                        @foreach($chunked_featured as $key => $featured_ad)
                                            <div class="col-lg-3 col-md-3 col-sm-3 pad-b-20 col-xs-6 welcome_page_images" style="border-right: 1px solid #bce8f1;">
                                                    <a href="{{ route('general.products.show', ['category' => $featured_ad->category, 'slug'=> $featured_ad->product_slug]) }}">
                                                        <div class="pad-b-20">
                                                            <div class="pad-10">
                                                                <img src="{{ $featured_ad->images->first() ? $featured_ad->images->first()->smallThumbnail() : '' }}" height="100%" width="100%" alt="{{ $featured_ad->product_name }}">
                                                            </div>
                                                            <div class="text-sm pad-5 text-center hidden-xs">
                                                                {{ str_limit($featured_ad->product_name, 40) }}
                                                                <br>
                                                                Rs. {{ $featured_ad->price }}
                                                                <br>
                                                                ({{ ucfirst(implode(' ', explode('_', $featured_ad->condition))) }})
                                                            </div>
                                                            <div class="text-md pad-b-20 text-center hidden-sm hidden-md hidden-lg">
                                                                {{ str_limit($featured_ad->product_name, 20) }}
                                                                <br>
                                                                Rs. {{ $featured_ad->price }}
                                                                
                                                            </div>
                                                            @if($featured_ad->status == 'sold' || $featured_ad->status == 'booked')
                                                                <div style="position: absolute; top: 0px; left: 0px">
                                                                    <span class="btn btn-xs {{ $featured_ad->status == 'sold' ? 'btn-warning' : 'btn-info' }}">
                                                                        {{ $featured_ad->status == 'sold' ? 'sold' : 'booked' }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </a>
                                                    @if($index == 2 && $key == 11)
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
                                    @forelse($products->chunk(4) as $index => $chunked_products)
                                        <div class="row" style="border-bottom: 1px solid #bce8f1;">
                                            @foreach($chunked_products as $key => $product)
                                                <div class="col-lg-3 col-md-3 col-sm-3 pad-b-20 col-xs-6 welcome_page_images" style="border-right: 1px solid #bce8f1;">
                                                    <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                                        <div class="pad-b-20">
                                                            <div class="pad-10">
                                                                <img src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" height="100%" width="100%" alt="{{ $product->product_name }}">
                                                            </div>
                                                            <div class="text-sm pad-5 text-center hidden-xs">
                                                                {{ str_limit($product->product_name, 40) }}
                                                                <br>
                                                                Rs. {{ $product->price }}
                                                                <br>
                                                                ({{ ucfirst(implode(' ', explode('_', $product->condition))) }})
                                                            </div>
                                                            <div class="text-md pad-b-20 text-center hidden-sm hidden-md hidden-lg">
                                                                {{ str_limit($product->product_name, 20) }}
                                                                <br>
                                                                Rs. {{ $product->price }}
                                                                
                                                            </div>
                                                            @if($product->status == 'sold' || $product->status == 'booked')
                                                                <div style="position: absolute; top: 0px; left: 0px">
                                                                    <span class="btn btn-xs {{ $product->status == 'sold' ? 'btn-warning' : 'btn-info' }}">
                                                                        {{ $product->status == 'sold' ? 'sold' : 'booked' }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </a>
                                                    @if($index == 2 && $key == 11)
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
            </div> --}}
        </div>
    </div>
            <div class="content">
                <div class="new-arrivals-w3agile pad-20">
                    <div class="container">
                        <h3 class="tittle1">Featured</h3>
                        <div class="arrivals-grids">

                            @forelse($featured as $key => $featured_ad)
                                <div class="col-md-3 col-xs-6 arrival-grid simpleCart_shelfItem">
                                    <div class="grid-arr">
                                        <div  class="grid-arrival">
                                            <figure>        
                                                <a href="{{ route('general.products.show', ['category' => $featured_ad->category, 'slug'=> $featured_ad->product_slug]) }}">
                                                    <div class="grid-img">
                                                        <img  src="{{ $featured_ad->images->first() ? $featured_ad->images->first()->smallThumbnail() : '' }}" class="img-responsive" alt="">
                                                    </div>
                                                    <div class="grid-img">
                                                        <img  src="{{ $featured_ad->images->first() ? $featured_ad->images->first()->smallThumbnail() : '' }}" class="img-responsive"  alt="">
                                                    </div>          
                                                </a>        
                                            </figure>   
                                        </div>
                                        @if($featured_ad->status == 'sold')
                                            <div class="ribben1">
                                                <p>sold</p>
                                            </div>
                                        @elseif($featured_ad->status == 'booked')
                                            <div class="ribben">
                                                <p>booked</p>
                                            </div>
                                        @endif
                                        
                                        {{-- <div class="ribben1">
                                            <p>SALE</p>
                                        </div> --}}
                                        <div class="block">
                                            <div class="starbox small ghosting"> </div>
                                        </div>
                                        <div class="women">
                                            <h6>
                                                <a href="{{ route('general.products.show', ['category' => $featured_ad->category, 'slug'=> $featured_ad->product_slug]) }}">
                                                    {{ $featured_ad->product_name }}
                                                </a>
                                            </h6>
                                            {{-- <span class="size">XL / XXL / S </span> --}}
                                            <p >
                                                {{-- <del>$100.00</del> --}}
                                                <em class="item_price">Rs. {{ $featured_ad->price }}</em>
                                            </p>
                                            {{-- <a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                            
                            <div class="clearfix"></div>
                        </div>
                            {{-- @if(count($featured) == 4)
                                <div class="pull-right pad-10">
                                    <a href="{{ route('featured') }}"><i class="fa fa-chevron-circle-right pad-r-5"></i>view more</a>
                                </div>
                            @endif --}}
                    </div>
                </div>
                <div class="product-agile pad-20">
                    <div class="container">
                        <h3 class="tittle1">New Arrivals</h3>
                        <div class="arrivals-grids">
                            @forelse($products as $key => $product)
                                <div class="col-md-3 col-sm-6 arrival-grid simpleCart_shelfItem">
                                    <div class="grid-arr">
                                        <div  class="grid-arrival">
                                            <figure>        
                                                <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                                    <div class="grid-img">
                                                        <img  src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" class="img-responsive" alt="">
                                                    </div>
                                                    <div class="grid-img">
                                                        <img  src="{{ $product->images->first() ? $product->images->first()->smallThumbnail() : '' }}" class="img-responsive"  alt="">
                                                    </div>          
                                                </a>        
                                            </figure>   
                                        </div>
                                        @if($product->status == 'sold')
                                            <div class="ribben1">
                                                <p>sold</p>
                                            </div>
                                        @elseif($product->status == 'booked')
                                            <div class="ribben">
                                                <p>booked</p>
                                            </div>
                                        @endif
                                        
                                        {{-- <div class="ribben1">
                                            <p>SALE</p>
                                        </div> --}}
                                        <div class="block">
                                            <div class="starbox small ghosting"> </div>
                                        </div>
                                        <div class="women">
                                            <h6>
                                                <a href="{{ route('general.products.show', ['category' => $product->category, 'slug'=> $product->product_slug]) }}">
                                                    {{ str_limit($product->product_name, 44) }}
                                                </a>
                                            </h6>
                                            {{-- <span class="size">XL / XXL / S </span> --}}
                                            <p >
                                                {{-- <del>$100.00</del> --}}
                                                <em class="item_price">Rs. {{ $product->price }}</em>
                                            </p>
                                            {{-- <a href="#" data-text="Add To Cart" class="my-cart-b item_add">Add To Cart</a> --}}
                                        </div>
                                    </div>
                                </div>
                            @empty

                            @endforelse
                            <div class="clearfix"></div>
                        </div>
                        {{-- @if(count($products) == 4)
                            <div class="pull-right pad-10">
                                <a href="{{ route('recent') }}"><i class="fa fa-chevron-circle-right pad-r-5"></i>view more</a>
                            </div>
                        @endif --}}
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection

@section('javascript')
@parent
    <script src="{{ asset('lib/jcarousel/jquery.jcarousel.min.js') }}"></script>
    <script src="{{ asset('lib/jcarousel/jcarousel.responsive.js') }}"></script>

@endsection