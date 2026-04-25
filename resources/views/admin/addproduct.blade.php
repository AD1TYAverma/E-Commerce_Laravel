@extends('admin.maindesign')

@section('add_product')

@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif
<div class="continer-fluid">
    <form action="{{route('admin.postaddproduct')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="product_img"  class="form-control  mt-3">
        <input type="text" name="product_title" placeholder="Enter Product Title" class="form-control  mt-3">
        <textarea class="form-control  mt-3" placeholder="Product Description" name="product_description" ></textarea>
        <input type="number" name="product_quantity" placeholder="Enter Product Quantity Here" class="form-control mt-3">
        <input type="number" name="product_prices" placeholder="Enter Product Price Here" class="form-control  mt-3">

        <select class="form-control  mt-3" aria-label="Default select example" name="product_category">
            <option selected>Open this select menu</option>
            @foreach ($category as $cat)
                
            <option value="{{$cat->category}}">{{$cat->category}}</option>
        
            @endforeach
        </select>

        <input type="submit" name="submit" class="btn btn-primary mt-3 " value="Add Product">
    </form>
</div>
    
@endsection