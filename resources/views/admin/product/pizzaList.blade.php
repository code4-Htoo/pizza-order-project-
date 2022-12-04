@extends('admin.layouts.master')


@section('title','Category List')

@section('search_box')
{{-- Search Box --}}
<form class="form-header" action="{{ route('product#list') }}" method="get">
    @csrf
    <input class="form-control au-input au-input--xl" type="text" name="search"
      value="{{ request('search') }}"  placeholder="Search for pizzas name &amp; reports..." />
    <button class="btn rounded mx-2 bg-white au-btn--submit" type="submit">
        <i class="text-dark zmdi zmdi-search"></i>
    </button>
</form>

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
                            <h2 class="title-1 text-primary">Porduct List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add pizza
                            </button>
                        </a>

                    </div>

                    <div class="row ">
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-3 text-center border-opacity-20">
                            <h6 class="text-dark">Result for : <span class="text-primary">{{ request('search') }}</span> </h6>
                        </div>
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-4 text-center border-opacity-20">
                            <h6 class="text-dark"><i class="fa-solid fa-database mr-1"></i> Total : <span class="text-primary">{{ $pizzas->total() }}</span> </h6>
                        </div>

                    </div>
                </div>
                {{-- Create Success Alert Message --}}
                @if (session('createSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('createSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif
                {{-- Delete Success Alert Message --}}
                @if (session('deleteSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="text-danger fa-solid fa-circle-minus mr-2"></i>{{session('deleteSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif


                @if(count($pizzas) == !0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="">
                            <tr class="">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Waiting Time</th>
                                <th>Category</th>
                                <th>View Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($pizzas as $pizz)
                            <tr class="tr-shadow">

                                <td class="col-3"><img src="{{ asset('storage/'. $pizz->image) }}" alt="" class=" "></td>
                                <td class="col-3 fw-bold">
                                    {{ $pizz->name }}</td>
                                <td class="col-2">{{ $pizz->price}} Kyats</td>
                                <td class="col-2">{{ $pizz->waiting_time}}</td>
                                <td class="col-2">{{ $pizz->category_name}}</td>
                                <td class="col-2"><i class="fa-solid fa-eye me-2"></i>{{ $pizz->view_count }}</td>

                                <td class="col-2">
                                    <div class=" table-data-feature">
                                        <a href="{{route('product#edit',$pizz->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                            title="View">
                                            <i class="text-primary zmdi zmdi-mail-send"></i>
                                        </button>
                                        </a>

                                        <a href="{{route('product#updatePage',$pizz->id)}}">
                                            <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                                title="Edit">
                                                <i class=" text-primary zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('product#delete',$pizz->id)}}">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                title="Delete">
                                                <i class=" text-danger zmdi zmdi-delete"></i>
                                            </button>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <div class="">
                            {{ $pizzas->links() }}
                            {{-- {{ $categories->appends(request()->query()) }} --}}
                        </div>
                </div>
                @else
                <h2 class="text-center text-bold text-dark mt-5">No Pizza Avaliable!</h2>
                @endif



                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
