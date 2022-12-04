@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="ms-5 mb-2 ">
            <a class="text-dark text-decoration-none" href="{{ route('user#home') }}"><i
                    class="fa-solid fa-angles-left me-2"></i>Back</a>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30 bg-white shadow-sm text-center pt-5">
                <div id="product-carousel" class="carousel slide col" data-ride="carousel">
                    <div class="carousel-inner col">
                        <div class="carousel-item active ">
                            <img class="col" src="{{ asset('storage/' . $pizza->image) }}" alt="Image" style="width:300px; height:320px;">
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $pizza->name }}</h3>
                    <div class="d-flex mb-3">
                        <p class="pt-1"><i class="text-primary fa-solid fa-eye me-2"></i>{{ $pizza->view_count +1 }}</p>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{ $pizza->price }} Kyats</h3>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">

                        <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">
                        <input type="hidden" name="" value="{{ $pizza->id }}" id="pizzaId">


                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn mr-1">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text"
                                class="form-control text-primary bg-light rounded btn-secondary text-center" value="1"
                                id="orderCount">


                            <div class="input-group-btn ms-1">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus "></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addCartBtn" class="btn btn-warning px-3"><i
                                class="text-dark fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5 bg-white">
            <div class="col">
                <div class="bg-light p-30 shadow-sm">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-white active bg-secondary" data-toggle="tab"
                            href="#tab-pane-1">Description</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{{ $pizza->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span
                class="bg-secondary pr-3 text-white">You May Also Like</span></h2>
        <div class="row px-xl-5">

            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pl)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid  " src="{{ asset('storage/' . $pl->image) }}" alt=""
                                    style="width:300px; height: 290px;/>
                            <a class=""
                                    href="{{ route('user#pizzaDetails', $pl->id) }}">
                                <div class="product-action">
                                </div>
                                </a>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pl->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pl->price }} Kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small> <i class="fa fa-eye text-primary me-2"></i>
                                    </small>{{ $pl->view_count }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            // increase view count
            $.ajax({
                type: 'get',
                url: '/user/ajax/increase/viewCount',
                data: { 'productId' : $('#pizzaId').val() },
                dataType: 'json',

            })



        // click add to cart btn
        $('#addCartBtn').click(function() {
        $source = {
            'userId': $('#userId').val(),
            'pizzaId': $('#pizzaId').val(),
            'count': $('#orderCount').val()
        };
        $.ajax({
            type: 'get',
            url: '/user/ajax/addToCart',
            data: $source,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    window.location.href = "/user/homePage"
                }
            }
        })

        })
        })
    </script>
@endsection
