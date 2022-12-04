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
                        <a href="{{ route('category#list')}}" class="text-decoration-none text-dark">
                            <div class="ms-1 mb-2">
                            <i class="fa-solid fa-arrow-left me-2"></i>list
                            </div>
                            </a>

                        <div class="card-title">
                            <h3 class="text-center title-2">New Category Creation</h3>
                        </div>
                        <hr>
                        <form action="{{ route('category#create') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label  class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="categoryName" type="text" class="form-control @error ('categoryName')is-invalid @enderror" value="{{old ('categoryName')}}"

                                aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                @error('categoryName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
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
