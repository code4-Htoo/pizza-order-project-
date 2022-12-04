@extends('admin.layouts.master')


@section('title','Category List')

@section('admin_dashboard')
<div class="form-header  px-5 py-1 rounded shadow-sm">
    <h4 class="text-dark">ADMIN DASHBOARD PANNEL <i class="fa fa-dashboard" aria-hidden="true"></i></h4>
</div>
@endsection

@section('content')


<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

            </div>

            <div class="col-6 offset-3 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-1 mb-2 ">
                            <a class="text-dark" href="{{route('product#list') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>

                        <div class="card-title">
                            <h3 class="text-center title-2">New Category Creation</h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#create') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" class="form-control @error ('pizzaName')is-invalid @enderror" value="{{old ('pizzaName')}}"
                                aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Category</label>
                                <select class="form-control @error ('pizzaCategory')is-invalid @enderror" name="pizzaCategory" id="">
                                    <option value="">Choose your category</option>
                                    @foreach ($categories as $categ)
                                        <option value="{{ $categ->id }}">{{ $categ->name }}</option>
                                    @endforeach
                                </select>
                                @error('pizzaCategory')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Image</label>
                                <input type="file" class="form-control @error ('pizzaImage')is-invalid @enderror" name="pizzaImage" id="">
                                @error('pizzaImage')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Wating Time</label>
                                <input type="number" class="form-control @error ('pizzaWaitingTime')is-invalid @enderror" name="pizzaWaitingTime" id="" placeholder="Enter Waiting Time">
                                @error('pizzaWaitingTime')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Description</label>
                                <textarea  name="pizzaDescription"  class="form-control @error ('pizzaDescription')is-invalid @enderror" id="" cols="30" rows="3" placeholder="Enter Pizza Description" value="">{{ old('pizzaDescription') }}</textarea>
                                @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label  class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="pizzaPrice" type="number" class="form-control @error ('pizzaPrice')is-invalid @enderror" value="{{old ('pizzaPrice')}}" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                                @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-primary btn-block mb-3">
                                    <span id="payment-button-amount">Create</span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
