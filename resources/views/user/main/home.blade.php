
@extends('user.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">

        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by Catgories</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class=" d-flex align-items-center justify-content-between mb-3 bg-dark text-white px-3 py-1">

                        <label class="mt-2" >Category</label>
                        <span class="badge text-bg-secondary font-weight-normal">{{ count($category) }}</span>
                    </div>
                    <div class="  d-flex align-items-center justify-content-between mb-3 shadow-sm px-1 py-2">
                        <a href="{{ route('user#home') }}" class="text-decoration-none text-secondary">All</a>
                    </div>
                    @foreach ($category as $c)
                    <div class="  d-flex align-items-center justify-content-between mb-3 shadow-sm px-1 py-2">
                        <a href="{{ route('user#filter',$c->id) }}" class="text-decoration-none text-secondary">{{$c->name }}</a>
                    </div>
                    @endforeach
                </form>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                                <a href="{{ route('user#cartList') }}">
                                    <button type="button" class="btn btn-warning position-relative">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                        </span>
                                        </button>
                                </a>

                                <a href="{{ route('user#history') }}">
                                <button type="button" class="btn btn-warning position-relative ms-3">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        History  {{ count($history) }}
                                    </span>
                                    </button>
                            </a>
                        </div>
                        <div class="ml-2">
                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Sort by</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                        </div>
                    </div>
                </div>

                <span class="row" id="dataList">
                    @if (count($pizza) !=0)
                        @foreach ($pizza as $p)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                            <div class="product-item bg-light m-4" id="myForm">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100 " style="height:280px" src="{{ asset('storage/'.$p->image) }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}}"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate " href="">{{ $p->name }}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>{{ $p->price }} Kyats</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <h4 class=" col-6 offset-3 text-center text-secondary fs-1 py-5 shadow-sm">No Pizza<i class="ms-3 fa-solid fa-pizza-slice"></i></h4>
                    @endif
                </span>


            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@endsection

@section('scriptSource')
<script>
    $(document).ready(function() {
        //    $.ajax({
        //         type : 'get' ,
        //         url : 'http://127.0.0.1:8000/user/ajax/pizza/list',
        //         dataType : 'json' ,
        //         success : function(response){
        //             console.log(response)
        //         }
        //    })

        $('#sortingOption').change(function() {
            $eventOption = $('#sortingOption').val();

            if ($eventOption == 'asc') {
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/pizza/list',
                    data: { 'status': 'ascending' },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i < response.length; $i++) {
                            $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                        <div class="product-item bg-light m-4" id="myForm">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100 " style="height:280px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                <div class="product-action">
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate " href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} Kyats</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                        $('#dataList').html($list);
                    }
                })

            } else if ($eventOption == 'desc') {
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/pizza/list',
                    data: { 'status': 'descending' },
                    dataType: 'json',
                    success: function(response) {
                        $list = '';
                        for ($i = 0; $i<response.length; $i++) {
                            $list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1" >
                                <div class="product-item bg-light m-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100 " style="height:280px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate " href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[$i].price} Kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        }
                        $('#dataList').html($list);
                    }
                })
            }
        })

    });
</script>
@endsection
