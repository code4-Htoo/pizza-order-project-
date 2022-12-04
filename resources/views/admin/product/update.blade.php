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
                            <a class="text-dark" href="{{route('product#list') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2 text-dark font-weight-bold"><i class="text-dark fa-regular fa-address-card me-2 "></i>Update Pizza</h3>
                        </div>

                        <hr>
                        <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4 offset-1 me-3">
                                    <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                    <img src="{{asset ('storage/'.$pizza->image)}}" alt="HAW" class="" />


                                    <div class="mt-3">
                                        <input type="file" name="pizzaImage" id="" class="form-control mt-3 @error ('pizzaImage') is-invalid @enderror">

                                    @error('pizzaImage')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                    @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="control-label ">View Count</label>
                                           <input type="text" value="{{ old('viewCount',$pizza->view_count) }}" name="viewCount" id="" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="control-label ">Created At</label>
                                           <input type="text" value="{{ old('createdAt',$pizza->created_at) }}" name="craetedAt" id="" class="form-control" aria-required="true" aria-invalid="false" disabled>
                                    </div>

                                    <div class="my-5 col-6 offset-3">
                                        <button class="btn btn-primary col-12" type="submit">
                                            Update
                                            <i class="fa-solid fa-square-check ms-2"></i>
                                        </button>

                                    </div>
                                </div>

                                <div class="row col-6">
                                    <div class="form-group">
                                       <label class="control-label mb-1">Name</label>
                                       <input type="text" value="{{ old('pizzaName',$pizza->name) }}" name="pizzaName" id="" class="form-control  @error ('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Name...">
                                       @error('pizzaName')
                                       <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" id="" cols="50" rows="3" class="form-control  @error ('pizzaDescription') is-invalid @enderror" placeholder="Enter Description...">{{ old('pizzaDescription',$pizza->description) }}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1  @error ('pizzaCategory') is-invalid @enderror">Category</label>
                                           <select name="pizzaCategory" class="form-control" id="">
                                            <option value="">Choose Category</option>

                                            @foreach ($category as $categ)
                                                <option value="{{ $categ->id }}" @if ($pizza->category_id == $categ->id) selected @endif>{{ $categ->name }}</option>
                                            @endforeach

                                           </select>
                                           @error('pizzaCategory')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Price</label>
                                           <input type="number" value="{{ old('pizzaPrice',$pizza->price) }}" name="pizzaPrice" id="" class="form-control  @error ('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                           @error('pizzaPrice')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
                                        </div>

                                    <div class="form-group">
                                        <label class="control-label mb-1  @error ('pizzaWaitingTime') is-invalid @enderror">Waiting Time</label>
                                            <input type="tel" value="{{ old('pizzaWaitingTime',$pizza->waiting_time) }}" name="pizzaWaitingTime" id="" class="form-control  @error ('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                           @error('pizzaWaitingTime')
                                           <div class="invalid-feedback">
                                               {{ $message }}
                                           </div>
                                       @enderror
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
