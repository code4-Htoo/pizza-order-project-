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
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="ms-1 mb-2 ">
                            <a class="text-dark" href="{{route('category#list') }}"><i class="fa-solid fa-arrow-left" ></i></a>
                        </div>
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Your Category</h3>
                        </div>
                        <hr>
                        <form action="{{ route('category#update',$category->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input type="hidden" name="categoryId" value="{{ $category->id }}">
                                <input id="cc-pament" name="categoryName" type="text" class="form-control @error ('categoryName')is-invalid @enderror" value="{{old ('categoryName', $category->name)}}"

                                aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid mx-auto">
                                <button id="payment-button" type="submit" class="col-3 offset-9 bg-success btn btn-block shadow">
                                    <span class="text-white" id="payment-button-amount ">Update </span>
                                    <span id="payment-button-sending" style="display:none;">Sending…</span>
                                    <i class="text-white fa-solid fa-square-arrow-up-right"></i>
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
