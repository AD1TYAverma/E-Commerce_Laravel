@extends('admin.maindesign')

<base href="/public">

@section('edit_product')

@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif

<div class="container-fluid">
    <form action="{{ route('admin.updateproduct', $prod->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    {{-- <input type="file" name="product_img" value="{{ $prod->product_img }}" class="form-control mt-3" > --}}
    <!-- Old Image Show -->
    <img src="{{ asset('products/'.$prod->product_img) }}" width="80">

    <!-- New Image Upload -->
    <input type="file" name="product_img" class="form-control mt-3">

    <input type="text" name="product_title" value="{{ $prod->product_title }}" class="form-control mt-3">
    <textarea name="product_description" class="form-control mt-3">{{ $prod->product_description }}</textarea>
    <input type="text" name="product_quantity" value="{{ $prod->product_quantity }}" class="form-control mt-3">
    <input type="text" name="product_prices" value="{{ $prod->product_prices }}" class="form-control mt-3">
    <select name="product_category" class="form-control mt-3">
        <option selected>Open this select menu</option>
        @foreach ($product as $pro)
           <option value="{{ $pro->category }}">
          {{ $pro->category }}
        </option> 
        @endforeach
        
    </select>
    {{-- <select class="form-control  mt-3" aria-label="Default select example" name="product_category">
            <option selected>Open this select menu</option>
            @foreach ($category as $cat)
                
            <option value="{{$cat->category}}">{{$cat->category}}</option>
        
            @endforeach
        </select> --}}
    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
</div>

@endsection