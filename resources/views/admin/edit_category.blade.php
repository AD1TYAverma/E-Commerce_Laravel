@extends('admin.maindesign')

<base href="/public">

@section('edit_category')

@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif

<div class="container-fluid">
    <form action="{{ route('admin.updatecategory', $cat->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <input type="text" name="category" value="{{ $cat->category }}" class="form-control" >

    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
</div>
    
@endsection


    
