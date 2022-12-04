@extends('admin.layouts.master')


@section('title', 'User List')


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
                        <h4 class="text-primary"><i class="fa-solid fa-users mr-1"></i> Total : <span class=" text-primary">{{ $users->total() }}</span> </h4>
                    </div>
                </div>

                <div class="col-md-12 bg-white rounded shadow-sm">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2 ">

                        <table class="table table-data2 text-center ">
                            <thead >
                                <tr >
                                    <th class="col-2 px-1">Image</th>
                                    <th class="col-2 px-1">User Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id='dataList' class="">
                                @foreach ($users as $user)
                                <tr class="tr-shadow col " >
                                    <td class="col-2 px-1">
                                        @if ($user->image == null)
                                        @if ($user->gender ==  'male')
                                        <img src="{{asset ('image/male-default-user.jpg')}}" class="shadow-sm img-thumbnail" style="width:95px; height:105px; object-fit: cover;"  />
                                        @else
                                        <img src="{{asset ('image/female-default-user.jpg')}}" class="shadow-sm img-thumbnail" style="width:95px; height:105px; object-fit: cover;"  />
                                        @endif
                                    @else
                                    <img src="{{asset ('storage/'.$user->image)}}" class="shadow-sm img-thumbnail" style="width:95px; height:105px; object-fit: cover;" alt="HAW" />
                                    @endif </td>
                                    <input type="hidden" name="" class="userId" value="{{ $user->id }}">

                                    <td class="col-2 px-1">{{ $user->name }}</td>
                                    <td class="col-1">{{ $user->email }}</td>
                                    <td class="col-1">{{ $user->gender }}</td>
                                    <td class="col-1">{{ $user->phone }}</td>
                                    <td class="col-1">{{ $user->address }}</td>
                                    <td class="col-2" >
                                        <select class="form-control text-center statusChange" name="" id="">
                                            <option value="user" @if ($user->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if ($user->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">{{ $users->links() }}</div>
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
        // change status
        $('.statusChange').change(function(){
        $currentStatus = $(this).val();

        $parentNode = $(this).parents('tr');
        $userId = $parentNode.find('.userId').val();

        $data = {
            'userId' : $userId,
            'role' : $currentStatus,
        };


            $.ajax({
            type: 'get',
            url: '/user/change/role',
            data: $data,
            dataType: 'json'
        })
        location.reload();

        })
    })

</script>
@endsection
