@extends('admin.maindesign')

@section('add_category')

@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif
<div class="continer-fluid">
    <form action="{{route('admin.postaddcategoty')}}" method="POST">
        @csrf
        <input type="text" name="category" placeholder="Enter Category Name" class="form-control w-50">
        <input type="submit" name="submit" class="btn btn-primary mt-2 " value="Add Category">
    </form>
</div>
    
@endsection