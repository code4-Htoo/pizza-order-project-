@extends('admin.layouts.master')


@section('title','Category List')

@section('search_box')
{{-- Search Box --}}
<form class="form-header" action="{{ route('admin#list') }}" method="get">
    @csrf
    <input class="form-control au-input au-input--xl" type="text" name="search"
      value="{{ request('search') }}"  placeholder="Search for admin's account &amp; " />
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
                            <h2 class="title-1 text-primary">Admin List</h2>

                        </div>
                    </div>

                    <div class="row ">
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-4 text-center border-opacity-20">
                            <h6 class="text-dark">Result for : <span class="d-block text-primary">{{ request('search') }}</span> </h6>
                        </div>
                        <div class="col mx-1 bg-light border rounded shadow-sm py-1 px-4 text-center border-opacity-20">
                            <h6 class="text-dark"><i class="fa-solid fa-database mr-1"></i> Total : <span class="d-block text-primary">{{ $admin->total() }}</span> </h6>
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
                {{-- Role change Alert Message --}}
                @if (session('changeSuccess'))
                <div class="col-4 offset-8">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="text-success fa-regular fa-circle-check mr-2"></i>{{session('changeSuccess')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                </div>
                @endif

                {{-- @if(count($categories) == !0) --}}
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead class="">
                            <tr class="">
                                <th class="px-1">Image</th>
                                <th class="px-1">Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody class="">
                           @foreach ($admin as $a)
                           <tr class="tr-shadow">
                            <td class="col-2">
                                @if ($a->image == null)
                                    @if ($a->gender == 'male')
                                    <img src="{{asset ('image/male-default-user.jpg')}}" class="" style="width:95px; height:120px; object-fit: cover;" />
                                    @else
                                    <img src="{{asset ('image/female-default-user.jpg')}}" class="" style="width:95px; height:120px; object-fit: cover;" />
                                    @endif
                                @else
                                <img src="{{ asset('storage/'. $a->image) }}" alt="" class="" style="width:95px; height:120px; object-fit: cover;">
                                @endif
                            </td>
                            <td class="col-2 fw-bold px-1">{{ $a->name }}</td>
                            <td class="col-2 ">
                                {{$a->email }}</td>
                            <td>{{$a->gender }}</td>
                            <td>{{$a->phone }}</td>
                            <td>{{$a->address }}</td>
                             {{-- <td>{{ $a->created_at->format('j F Y') }}</td> --}}
                            <td class="">
                                <div class="table-data-feature text-center">
                                    @if (Auth::user()->id == $a->id)
                                    <i class=" text-success fa-solid fa-circle me-2"></i>
                                    @else
                                        <a href="{{route('admin#changeRole',$a->id)}}" >
                                        <button class="me-2 item" data-toggle="tooltip" data-placement="top"
                                            title="Change Role">
                                            <i class="fa-solid fa-people-arrows text-primary"></i>
                                        </button>
                                        </a>
                                        <a href="{{route('admin#delete',$a->id)}}">
                                        <button class="me-2 item" data-toggle="tooltip" data-placement="top"
                                            title="Delete">
                                            <i class="fa-solid fa-trash-can text-danger"></i>
                                        </button>
                                    </a>
                                    @endif


                                </div>
                            </td>
                        </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{  $admin->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
