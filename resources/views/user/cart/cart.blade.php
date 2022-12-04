@extends('user.layouts.master')

@section('content')

<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0" id='dataTable'>
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($cartList as $c)

                    <tr class="align-middle">

                        <td class="align-middle bg-light d-inline">
                            <div class="align-middle d-inline ms-4"><img src="{{ asset('storage/'.$c->pizza_image) }}" class='img-thumbnail shadow-sm' alt="" style="width: 65px;height:60px;">
                        </div></td>
                        <td>
                        <div class="align-middle  fs-5 font-weight-bold text-secondary ps-2 ms-4">{{ $c->pizza_name }}

                            <input type="hidden" value="{{ $c->id }}" class="orderId">
                            <input type="hidden" value="{{ $c->product_id }}" class="productId">
                            <input type="hidden" value="{{ $c->user_id }}" class="userId">
                        </div></td>

                        <td class="align-middle" id="price">{{$c->pizza_price}} Kyats</td>
                        <td class="align-middle">

                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                                <input type="text" class="form-control form-control-sm bg-light border-0 text-center" value="{{ $c->qty }}" id="qty" disabled>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle col-3" id="total">{{$c->pizza_price * $c->qty}} Kyats</td>
                        <td class="align-middle" ><button class="btn btn-sm btn-danger btnRemove" ><i class="fa fa-times"></i></button></td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <button class="col-2 offset-10 btn btn-sm btn-danger font-weight-bold my-4 py-2" id="clearBtn">Clear Cart</button>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-light pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotalPrice">{{ $totalPrice }}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 Kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{ $totalPrice+3000 }} Kyats</h5>
                    </div>
                    <button class="btn btn-block btn-success font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection


@section('scriptSource')

<script src="{{ asset('js/cart.js') }}"></script>
<script>
    $('#orderBtn').click(function() {
    $orderList = [];
    $random = Math.floor(Math.random() *10000000001);

    $('#dataTable tbody tr').each(function(index, row) {
        $orderList.push({
            'user_id' : $(row).find('.userId').val(),
            'product_id' : $(row).find('.productId').val(),
            'qty' : $(row).find('#qty').val(),
            'total' : Number($(row).find('#total').text().replace('Kyats' , '')),
            'order_code' : '0100'+$(row).find('.userId').val()+$random
        });
    });

    $.ajax({
        type: 'get',
        url : '/user/ajax/order',
        data : Object.assign({} , $orderList) ,
        dataType : 'json',
        success: function(response){
            if(response.status == 'true'){
                    window.location.href = "http://127.0.0.1:8000/user/homePage"
               }
        }
    })

    });

    // when clear button click .Remove cart
    $('#clearBtn').click(function(){

        $.ajax({
            type: 'get',
            url : '/user/ajax/clear/cart',
            dataType : 'json',
        })

        $('#dataTable tbody tr').remove();
        $('#subTotalPrice').html('0 Kyats');
        $('#finalPrice').html('3000 Kyats');
    })
    // remove current product
    // when x button click
    $('.btnRemove').click(function() {
        $parentNode = $(this).parents('tr');
        $productId = $parentNode.find('.productId').val();
        $orderId = $parentNode.find('.orderId').val();

        $.ajax({
            type: 'get',
            url : '/user/ajax/clear/current/product',
            data : {'productId' : $productId ,'orderId': $orderId},
            dataType : 'json',
        })
        $parentNode.remove();

        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += Number($(row).find('#total').text().replace('Kyats', ''));
        });
        $('#subTotalPrice').html(`${$totalPrice} Kyats`);
        $('#finalPrice').html(`${$totalPrice +3000} Kyats`);
})

</script>

@endsection
