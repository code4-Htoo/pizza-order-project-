@extends('admin.layouts.master')


@section('title', 'Order List')

@section('admin_dashboard')
    <div class="form-header  px-5 py-1 rounded shadow-sm">
        <h4 class="text-dark">ADMIN DASHBOARD PANNEL <i class="fa fa-dashboard" aria-hidden="true"></i></h4>
    </div>
@endsection

@section('content')


    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">

                <div class="col-md-12 bg-white m-3 px-5 pb-5 rounded shadow-sm">
                    <div class="table-responsive table-responsive-data2">
                        <a class="text-dark mt-3 text-decoration-none" href="{{ route('admin#orderList') }}"><i
                                class="me-2 fa-solid fa-arrow-left"></i>Back</a>

                        <div class="row col-4 mt-1">

                            <div class="card mt-4 bg-light">
                                <div class="card-body ">
                                    <h3><i class="fa-solid fa-clipboard-list "></i> Order Info</h3>
                                </div>
                                <div class="card-body pt-1">
                                    <div class="row mb-1">
                                        <div class="col"><i class="fa-solid fa-user me-1"></i> Customer Name</div>
                                        <div class="col font-weight-bold text-success"> {{strtoupper( $orderList[0]->user_name) }}</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col"><i class="fa-solid fa-barcode me-1"></i> Order Code</div>
                                    <div class="col text-primary">{{ $orderList[0]->order_code}}</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col"><i class="fa-solid fa-calendar-days me-1"></i> Order Date</div>
                                        <div class="col text-primary"> {{  $orderList[0]->created_at->format('F-j-Y') }}</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col"><i class="fa-solid fa-comment-dollar me-1"></i></i> Total</div>
                                    <div class="col text-primary">{{ $order->total_price}} Kyats <small class="d-block text-danger">(include delivery charges)</small></div>
                                </div>
                            </div>
                            </div>
                        </div>

                            <table class="table table-data2 text-center">
                                <thead class="">
                                    <tr class="col">
                                        <th>Order Id</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>


                                    </tr>
                                </thead>
                                <tbody id='dataList'>
                                    @foreach ($orderList as $o)
                                        <tr class="tr-shadow">

                                            <td class="col-1 align-middle">{{ $o->id }}</td>
                                            <td class="col-1 align-middle">
                                                <img src="{{ asset('storage/' . $o->product_image) }}" class=""></td>
                                            <td class="align-middle">{{ $o->product_name }}</td>
                                            <td class="align-middle">{{ $o->qty }}</td>
                                            <td class="align-middle">{{ $o->total }} Kyats</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
@endsection
