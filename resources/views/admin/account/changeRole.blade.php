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
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-8 offset-2 ">
                <div class="card border shadow-lg bg-white" >
                    <div class="card-body" >
                        <div class="ms-1 mb-2 ">
                            <a class="text-dark" href="{{route('admin#list') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 text-dark font-weight-bold"><i class="text-dark fa-regular fa-address-card me-2 "></i>Change Role</h3>
                        </div>

                        <hr>
                        <form action="{{ route('admin#change',$account->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">


                                <div class=" col-5 offset-1">

                                    <div class="form-group">
                                        <label class="control-label mb-1">Role</label>
                                        <select name="role" id="" class="form-control">
                                            <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                            <option value="user"  @if($account->role == 'user') selected @endif>User</option>
                                        </select>
                                           {{-- <input type="text" value="{{ old('role',$account->role) }}" name="role" id="" class="form-control" aria-required="true" aria-invalid="false" > --}}
                                    </div>

                                    <div class="form-group">
                                       <label class="control-label mb-1">Name</label>
                                       <input type="text" disabled value="{{ old('name',$account->name) }}" name="name" id="" class="form-control  @error ('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                       @error('name')
                                       <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Email</label>
                                           <input type="email" disabled value="{{ old('email',$account->email) }}" name="email" id="" class="form-control  @error ('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                           @error('email')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                           <input type="tel" disabled value="{{ old('phone',$account->phone) }}" name="phone" id="" class="form-control  @error ('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                           @error('phone')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1  @error ('gender') is-invalid @enderror">Gender</label>
                                           <select name="gender" class="form-control" id="" disabled>
                                            <option value="">Choose Your Gender</option>
                                            <option value="male" @if($account->gender == 'male') selected @endif >Male</option>></option>
                                            <option value="female" @if($account->gender == 'female') selected @endif >Female</option>></option>
                                           </select>
                                           @error('gender')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <textarea disabled name="address" id="" cols="50" rows="3" class="form-control  @error ('address') is-invalid @enderror" placeholder="Enter Admin Address...">{{ old('address',$account->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-3 offset-1">
                                    @if ($account->image == null)
                                        @if ($account->gender ==  'male')
                                        <img src="{{asset ('image/male-default-user.jpg')}}" class=" shadow-sm img-thumbnail"  />
                                        @else
                                        <img src="{{asset ('image/female-default-user.jpg')}}" class=" shadow-sm img-thumbnail"  />
                                        @endif
                                    @else
                                    <img src="{{asset ('storage/'.$account->image)}}" class='shadow-sm img-thumbnail' alt="HAW" />
                                    @endif

                                    <div class="col offset-2 mt-5">
                                        <button class="btn btn-primary bg-primary" type="submit">
                                            Save
                                            <i class="fa-solid fa-square-check ms-2"></i>
                                        </button>

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

@endsection
