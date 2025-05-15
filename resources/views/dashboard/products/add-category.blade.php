@extends('dashboard.layouts.app')

@section('main-content')

<div class="main-content">
    <div class="container-fluid"></div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Category</h1>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>

        @endif




        {{-- Form  --}}
        <form action="{{route('category.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Category Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Image/Media</label>
          <input type="file" class="form-control" id="Image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br/>

      {{-- Table  --}}

      <div class="card shadow mb-4">
        <div class="card-body">
            {{-- {{ $categories}} //to check data --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                </div>
                            </th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>


                    <tbody>
                    @foreach ($categories as $category)


                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input product-select" type="checkbox">
                            </div>
                        </td>
                        <td>{{$category->title}}</td>
                        <td>{{$category->image}} </td>
                        <td>
                            @if ($category->status)
                            <button type="button" class="btn btn-info">Active</button>
                            @else
                            <button type="button" class="btn btn-warning">InActive</button>

                            @endif


                        </td>
                        <td class="table-actions">
                            <a href="{{route('category.edit',$category->id)}}"><button class="btn btn-sm btn-outline-secondary me-1"><i class="fas fa-edit"></i></button></a>
                            <form action="{{route('category.delete',$category->id)}}" method="POST">
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


@endsection
