@extends('user.layouts.master')

@section('content')

<!-- Cart Start -->
<div class="container-fluid" style="height:490px">
    <div class="row px-xl-5">
        <div class="col-lg-8 offset-2 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-4" id='dataTable'>
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Orders</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                    <tr>
                        <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                        <td class="align-middle">{{ $o->order_code }}</td>
                        <td class="align-middle">{{ $o->total_price }}</td>
                        <td class="align-middle">
                            @if ($o->status == 0)
                                <span class=" text-secondary"><i class="text-primary me-2 fa-solid fa-hourglass-start"></i>Pending State.......</span>
                            @elseif ($o->status == 1)
                               <span class="  text-success"><i class="me-2 fa-regular fa-circle-check"></i>Success ......</span>
                            @elseif ($o->status == 2)
                                <span class="  text-danger"><i class="me-2 fa-solid fa-ban"></i>Rejected ......</span>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <span>{{ $order->links() }}</span>
        </div>
    </div>
</div>
<!-- Cart End -->

@endsection


@section('scriptSource')


@endsection
