@extends('admin.layouts.master')


@section('title','Category List')

@section('admin_dashboard')
<div class="form-header  px-5 py-1 rounded shadow-sm">
    <h4 class="text-dark">ADMIN DASHBOARD PANNEL <i class="fa fa-dashboard" aria-hidden="true"></i></h4>
</div>
@endsection

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content" >
    <div class="row">
        <div class="col-2 offset-9 mb-2">

            {{-- Create Success Alert Message --}}
            @if(session('updateSuccess'))
            <div class="">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('updateSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2 ">
                <div class="card border shadow-lg bg-white" >
                    <div class="card-body" >
                        <div class="ms-1 mb-2">
                            <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 text-dark font-weight-bold"><i class="text-dark fa-regular fa-address-card me-2 "></i>Porduct info</h3>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="row">
                            <div class="col-12 offset-0 my-3 bg-white text-dark d-block fw-bold fs-5 text-capitalize ms-2"><i class="fa-solid fa-pizza-slice me-3"></i>{{$pizza->name}}</div></div>
                            <div class="col-4 offset-4">

                                <img src="{{asset ('storage/'.$pizza->image)}}" class=" my-3"  />

                            </div>
                            <div class="col-12 shadow-sm mt-3 mb-5">

                                    <p class=" my-2 btn text-dark  mt-1" style="background-color: rgb(236, 231, 229) ; font-size :0.8rem
                                    "> <i class="fa-solid fa-money-bill-1-wave me-3"></i>{{ $pizza->price}}  Kyats</p>
                                    <p class=" my-2 btn text-dark  mt-1" style="background-color:rgb(236, 231, 229) ; font-size :0.8rem
                                    "> <i class="fa-solid fa-list-ol me-3"></i>{{ $pizza->category_name}}</p>
                                    <p class=" my-2 btn text-dark  mt-1" style="background-color:rgb(236, 231, 229) ; font-size :0.8rem
                                    "> <i class="fa-solid fa-hourglass-end me-3"></i>{{ $pizza->waiting_time }} Minutes</p>
                                    <p class=" my-2 btn text-dark  mt-1" style="background-color:rgb(236, 231, 229) ; font-size :0.8rem
                                    "> <i class="fa-solid fa-user-clock me-3"></i>{{ $pizza->created_at->format('j-F-Y')}}</p>
                                    <p class=" my-2 btn text-dark  mt-1" style="background-color:rgb(236, 231, 229); font-size :0.8rem
                                    "> <i class="fa-solid fa-eye me-3"></i>{{ $pizza->view_count }}</p>

                                <div class="my-3"><i class="fa-regular fa-comment-dots me-3"></i>Details</div>
                                <div class="">{{ $pizza->description }}</div>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
