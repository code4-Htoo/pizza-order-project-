@extends('admin.layouts.master')


@section('title','Category List')

@section('search_box')
{{-- Search Box --}}
<form class="form-header" action="{{ route('category#list') }}" method="get">
    @csrf
    <input class="form-control au-input au-input--xl" type="text" name="search"
      value="{{ request('search') }}"  placeholder="Search for datas &amp; reports..." />
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
                            <h2 class="title-1 text-primary">Category List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('category#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add category
                            </button>
                        </a>

                    </div>

                    <div class="row ">
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-3 text-center border-opacity-20">
                            <h6 class="text-dark">Result for : <span class="text-primary">{{ request('search') }}</span> </h6>
                        </div>
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-4 text-center border-opacity-20">
                            <h6 class="text-dark"><i class="fa-solid fa-database mr-1"></i> Total : <span class="text-primary"> {{ $categories->total() }}</span> </h6>
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


                @if(count($categories) == !0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="">
                            <tr class="">
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Create Date</th>
                                <th>CRUD</th>
                            </tr>
                        </thead>
                        <tbody >
                           @foreach ($categories as $category)
                           <tr class="tr-shadow">
                            <td>{{ $category->id }}</td>
                            <td class="col-6 fw-bold">
                                {{ $category->name }}</td>
                            <td>{{ $category->created_at->format('j F Y') }}</td>
                            <td >
                                <div class=" table-data-feature">
                                    {{-- <button class="item" data-toggle="tooltip" data-placement="top"
                                        title="Send">
                                        <i class="zmdi zmdi-mail-send"></i>
                                    </button> --}}
                                    <a href="{{ route('category#edit' , $category->id) }}">
                                        <button class="item mx-1" data-toggle="tooltip" data-placement="top"
                                            title="Edit">
                                            <i class=" text-primary zmdi zmdi-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('category#delete',$category->id) }}">
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
                        {{ $categories->links() }}
                        {{-- {{ $categories->appends(request()->query()) }} --}}
                    </div>
                </div>
                @else
                <h2 class="text-center text-bold text-dark mt-5">No Category Avaliable!</h2>
                @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
