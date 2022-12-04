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

                <div class="col-md-12 bg-white m-3 p-5 rounded shadow-sm">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1 text-primary">Order List</h2>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-3 text-center border-opacity-20">
                                <h6 class="text-primary">Result for : <span
                                        class="d-block text-primary">{{ request('search') }}</span> </h6>
                            </div>
                            <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-4 text-center border-opacity-20">
                                <h6 class="text-primary "><i class="fa-solid fa-database mr-1 "></i> Total : <span
                                        class="d-block text-primary">{{ count($order) }}</span> </h6>
                            </div>

                        </div>
                    </div>
                    <div class="mb-2"><span class="ms-3 ">Order Status </span></div>
                    <form action="{{ route('admin#orderChangeStatus') }}" method="get" class="col-4">
                        @csrf

                        <div class="input-group mb-3 ">
                            <div class="input-group-append col-4 ">
                                <span class="input-group-text bg-white">
                                    Total : {{ count($order) }}
                                </span>
                            </div>
                            <select class="form-select" id="" name="orderStatus">
                                <option class="text-center" value="">All</option>
                                <option class="text-center" @if (request('orderStatus') == '0') selected @endif
                                    value="0">Pending</option>
                                <option class="text-center" @if (request('orderStatus') == '1') selected @endif
                                    value="1">Accept</option>
                                <option class="text-center" @if (request('orderStatus') == '2') selected @endif
                                    value="2">Reject</option>
                            </select>
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn btn-sm ms-3 bg-success text-white input-group-text ">Search</button>
                            </div>

                        </div>

                    </form>




                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead class="">
                                <tr class="col">
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id='dataList'>
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" name="" value="{{ $o->id }}">
                                        <td class="col-1 ">{{ $o->user_id }}</td>
                                        <td class="fw-bold">{{ $o->user_name }}</td>
                                        <td class="">
                                            <a href="{{ route('admin#listInfo', $o->order_code) }}"
                                                class="text-decoration-none">{{ $o->order_code }}</a>
                                        </td>
                                        <td class="">{{ $o->total_price }} Kyats</td>
                                        <td class="">{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td class="">
                                            <select class="form-control statusChange" name="status" id="">
                                                <option class="text-center " value="0"
                                                    @if ($o->status == 0) selected @endif>Pending</option>
                                                <option class="text-center " value="1"
                                                    @if ($o->status == 1) selected @endif>Accept</option>
                                                <option class="text-center " value="2"
                                                    @if ($o->status == 2) selected @endif>Reject</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //     type: 'get',
            //     url: '/order/ajax/status',
            //     data: { 'status': $status },
            //     dataType: 'json',

            //     success : function(response){

            //         $list = '';
            //         for ($i=0;$i<response.length;$i++) {

            //         // append
            //         $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];


            //         $dbDate = new Date(response[$i].created_at);
            //         $finalDate= $months[$dbDate.getMonth()]+'-'+$dbDate.getDate()+'-'+$dbDate.getFullYear();

            //         if(response[$i].status == 0){
            //             $statusMessage = `
        //             <select class="form-control statusChange" name="status" id="">
        //                 <option class="text-center" value="0" selected>Pending</option>
        //                 <option class="text-center" value="1">Accept</option>
        //                 <option class="text-center" value="2">Reject</option>
        //             </select>
        //             `;
            //         }else if(response[$i].status == 1){
            //             $statusMessage = `
        //             <select class="form-control statusChange" name="status" id="">
        //                 <option class="text-center" value="0" >Pending</option>
        //                 <option class="text-center" value="1" selected>Accept</option>
        //                 <option class="text-center" value="2">Reject</option>
        //             </select>
        //             `;
            //         }else if(response[$i].status == 2){
            //             $statusMessage = `
        //             <select class="form-control statusChange" name="status" id="">
        //                 <option class="text-center" value="0" >Pending</option>
        //                 <option class="text-center" value="1" >Accept</option>
        //                 <option class="text-center" value="2" selected >Reject</option>
        //             </select>
        //             `;
            //         }

            //             $list += `
        //             <tr class="tr-shadow">
        //                 <input type="hidden" class="orderId" name="" value="${response[$i].id}">
        //                 <td class="col-1 ">${response[$i].user_id}</td>
        //                 <td class="fw-bold">${response[$i].user_name}|| ${response[$i].id}</td>
        //                 <td class="">${response[$i].order_code}</td>
        //                 <td class="">${response[$i].total_price} Kyats</td>
        //                 <td class="fw-bold">${$finalDate}</td>
        //                 <td class="">${$statusMessage}</td>
        //             </tr>
        //             `
            //         }
            //         $('#dataList').html($list);
            //     }
            // })
            // )}
            // change status
            $('.statusChange').change(function() {
                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'orderId': $orderId,
                    'status': $currentStatus
                };


                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })

            })
        })
    </script>
@endsection
