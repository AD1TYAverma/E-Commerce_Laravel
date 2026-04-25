@extends('admin.maindesign')

@section('view_category')

@if (session('msg'))
    <div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
        {{ session('msg') }}
    </div>
@endif
<form class="d-flex mb-4" method="POST" action="">
    <input class="form-control me-2  w-25" type="search" name="search"
           placeholder="Search product...">
    <button class="btn btn-danger  mx-2" type="submit">Search</button>
</form>
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Category ID</th>
      <th scope="col">Category Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($category as $cat)
        
    <tr>
      <th scope="row">{{$cat->id}}</th>
      <td>{{$cat->category}}</td>
      <td class="d-flex gap-2">
    <form action="{{ route('admin.categorydelete', $cat->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mx-3"
            onclick="return confirm('Are you sure to delete this category?')">
            Delete
        </button>
    </form>

    <a href="{{route('admin.editcategory', $cat->id)}}" class="btn btn-success">Edit</a>
  </td>
    </tr>

    @endforeach
  </tbody>
</table>
    
@endsection