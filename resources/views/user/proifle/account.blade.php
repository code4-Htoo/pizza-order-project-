
@extends('user.layouts.master')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content" >

    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3 ">
                <div class="card border shadow-lg bg-white" >
                    {{-- Profile change Alert Message --}}

                    <div class="card-body" >
                        @if (session('updateSuccess'))
                <div class="col-6 offset-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
                </div>
                 @endif
                        <div class="ms-1 mb-2 ">
                            <a class="text-dark" href="{{route('user#home') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 text-dark font-weight-bold"><i class="text-dark fa-regular fa-address-card me-2 "></i>Account Edit</h3>
                        </div>

                        <hr>
                        <form action="{{ route('user#accountEdit',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1 me-3">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender ==  'male')
                                        <img src="{{asset ('image/male-default-user.jpg')}}" class=" shadow-sm img-thumbnail"  />
                                        @else
                                        <img src="{{asset ('image/female-default-user.jpg')}}" class=" shadow-sm img-thumbnail"  />
                                        @endif
                                    @else
                                    <img src="{{asset ('storage/'.Auth::user()->image)}}" class='shadow-sm img-thumbnail' alt="HAW" />
                                    @endif

                                    <div class="mt-3">
                                        <input type="file" name="image" id="" class="form-control mt-3 @error ('image') is-invalid @enderror">

                                    @error('image')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                    @enderror
                                    </div>

                                    <div class="mt-3 ">
                                        <button class="btn bg-primary col-12 text-white" type="submit">
                                            Update
                                            <i class="fa-solid fa-square-check ms-2"></i>
                                        </button>

                                    </div>
                                </div>

                                <div class="row col-6">
                                    <div class="form-group">
                                       <label class="control-label mb-1">Name</label>
                                       <input type="text" value="{{ old('name',Auth::user()->name) }}" name="name" id="" class="form-control  @error ('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                       @error('name')
                                       <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                           <input type="email" value="{{ old('email',Auth::user()->email) }}" name="email" id="" class="form-control  @error ('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                           @error('email')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                           <input type="tel" value="{{ old('phone',Auth::user()->phone) }}" name="phone" id="" class="form-control  @error ('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                           @error('phone')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1  @error ('gender') is-invalid @enderror">Gender</label>
                                           <select name="gender" class="form-control" id="">
                                            <option value="">Choose Your Gender</option>
                                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif >Male</option>></option>
                                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif >Female</option>></option>
                                           </select>
                                           @error('gender')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea name="address" id="" cols="50" rows="3" class="form-control  @error ('address') is-invalid @enderror" placeholder="Enter Admin Address...">{{ old('address',Auth::user()->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                           <input type="text" value="{{ old('role',Auth::user()->role) }}" name="role" id="" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="row">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
{{--  --}}
@endsection
