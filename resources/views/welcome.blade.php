@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title text-uppercase">YOU SELL WE BUY
         YOU BUY WE SELL</h3>
                </div>
                <div class="panel-body">
                    <p>
                        <a href="http://ktmsecondhand.com/">http://ktmsecondhand.com/</a> is FREE online classified which enables individuals as well as companies to list wide variety of new or used product online. We at <a href="http://ktmsecondhand.com/">ktmsecondhand.com</a> believe that Internet is a great promotional vehicle as well as communication channel for connecting buyers and sellers. <a href="http://ktmsecondhand.com/">Ktmsecondhand.com</a> is perfect solution which helps to list your products for free.
                    </p>
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