@extends('dashboard.layouts.app')

@section('main-content')

<div class="main-content">
    <div class="container-fluid"></div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
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


        {{-- {{$categories}} --}}

        {{-- Form  --}}
        <form action="{{route('category.update',$categories->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="category_id" value="{{$categories->id}}">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label" >Category Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$categories->title}}">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Image/Media</label>
          <input type="file" class="form-control" id="Image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br/>
</div>
</div>
