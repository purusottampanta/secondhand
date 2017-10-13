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
                        <div class="panel-heading">Panel Heading</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection