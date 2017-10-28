@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    <p>
                        secondhandshop.ktm.com is FREE online classified which enables individuals as well as companies to list wide variety of new or used product online. We at hamrobazar.com believe that Internet is a great promotional vehicle as well as communication channel for connecting buyers and sellers. Hamrobazar.com is perfect solution which helps to list your products for free.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div style="margin-top: -20px">
                    @include('layouts.categories')
                </div>
            </div>
            <div class="col-md-9" style="margin-left: -1.6em">
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
            </div>
        </div>
    </div>
@endsection