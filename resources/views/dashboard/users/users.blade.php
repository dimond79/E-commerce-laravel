@extends('dashboard.layouts.app')

@section('main-content')
<div class="main-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <a href="{{route('create.product')}}"><button class="btn btn-sm btn-primary">
                <i class="fas fa-plus fa-sm"></i> Add User
            </button></a>
        </div>



        {{-- Table  --}}
        <div class="card shadow mb-4">
            {{-- {{$users}} --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>

                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach($users as $user)
                           <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}} </td>
                            <td>{{$user->role}} </td>
                            <td>{{$user->status == 1 ? 'Active' : 'InActive' }}</td>
                            <td class="table-actions">
                                <a href="#"><button class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-eye"></i></button></a>
                                <a href="#"><button class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></button></a>
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                            </tr>




                           @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
