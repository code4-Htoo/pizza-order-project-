@extends('admin.layouts.master')


@section('title', 'Contact List')

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
                <div class="col-2 offset-10 mb-3">
                    <div class="text-center ">
                        <h4 class="text-primary"><i class="fa-solid fa-users mr-1"></i> Total : <span class=" text-primary">{{ count($contactmessageList) }}</span> </h4>
                    </div>
                </div>

                <div class="col-md-12 bg-white rounded shadow-sm">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2 ">

                        <table class="table table-data2 text-center ">
                            <thead >
                                <tr class="col" >
                                    <th class="col-1 px-1">Account</th>
                                    <th class="col-2 px-1">name</th>
                                    <th>email</th>
                                    <th>message</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody id='dataList' class="">
                                    @foreach ($contactmessageList as $c)
                                    <tr class="tr-shadow col " >
                                        <td class="col-1 px-1">{{ $c->user_name }}</td>
                                        <td class="col-2 px-1">{{ $c->name }}</td>
                                        <td class="col-1">{{ $c->email }}</td>
                                        <td class="col-3">{{ $c->message }}</td>
                                        <td class="col-1">{{ $c->created_at->format('F-j-Y') }}</td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-3">{{ $contactmessageList->links() }}</div> --}}
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection


