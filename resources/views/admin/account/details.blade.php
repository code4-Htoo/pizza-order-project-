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
            <div class="col-lg-6 offset-3 ">
                <div class="card border shadow-lg bg-white" >
                    <div class="card-body" >
                        <div class="ms-1 mb-2 ">
                            <a class="text-dark" href="{{route('admin#list') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 text-dark font-weight-bold"><i class="text-dark fa-regular fa-address-card me-2 "></i>Account Info</h3>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-4 offset-1">
                                @if (Auth::user()->image == null)
                                    @if (Auth::user()->gender ==  'male')
                                    <img src="{{asset ('image/male-default-user.jpg')}}" class="shadow-sm img-thumbnail" style="width:150px; height:185px; object-fit: cover;"  />
                                    @else
                                    <img src="{{asset ('image/female-default-user.jpg')}}" class="shadow-sm img-thumbnail" style="width:150px; height:185px; object-fit: cover;"  />
                                    @endif
                                @else
                                <img src="{{asset ('storage/'.Auth::user()->image)}}" class="shadow-sm img-thumbnail" style="width:150px; height:185px; object-fit: cover;" alt="HAW" />
                                @endif

                                <div class="form-group mt-3">
                                   <h5 class="my-2 text-dark mt-1 " name="role"> <i class="fa-solid fa-user-check me-2"></i>Role</h5><hr style="margin:6px"><h6 class="text-secondary mb-4">{{Auth::user()->role }}</h6>
                                </div>
                            </div>


                        <div class="col-5 offset-1 bg-transparent shadow-sm ">

                                    <h5 class="my-2 text-dark mt-1 "> <i class="fa-solid fa-user me-3 "></i>Name</h5><hr style="margin:6px"><h6 class="text-secondary mb-4">{{Auth::user()->name }}</h6>
                                    <h5 class="my-2 text-dark  mt-1"> <i class="fa-solid fa-envelope me-3 "></i>Email</h5><hr style="margin:6px"><h6 class=" text-secondary mb-4">{{Auth::user()->email }}</h6>
                                    <h5 class="my-2 text-dark  mt-1"> <i class="fa-solid fa-phone me-3" ></i>Phone</h5><hr style="margin:6px"><h6 class=" text-secondary mb-4">{{Auth::user()->phone }}</h6>
                                    <h5 class="my-2 text-dark mt-1 "> <i class="fa-sharp fa-solid fa-venus-mars me-3"></i>Gender</h5><hr style="margin:6px"><h6 class="text-secondary mb-4">{{Auth::user()->gender }}</h6>
                                    <h5 class="my-2 text-dark mt-1 "> <i class="fa-solid fa-address-card me-3"></i>Address</h5><hr style="margin:6px"><h6 class="text-secondary mb-4">{{Auth::user()->address }}</h6>
                                    <h5 class="my-2 text-dark  mt-1"> <i class="fa-solid fa-user-clock me-3"></i>Joined at</h5><hr style="margin:6px"><h6 class="text-secondary mb-4">{{Auth::user()->created_at->format('j/F/Y') }}</h6>
                            </div>
                        </div>
                        <div class="row me-5">
                            <div class="col-2 offset-8 mt-3  ">
                                <a href="{{route('admin#edit')}}">
                                    <button class="btn text-dark fw-bold px-2 btn-outline-primary">
                                        <i class=" fa-solid fa-pen-to-square mx-2"></i> Edit Profile
                                    </button>
                                </a>
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
