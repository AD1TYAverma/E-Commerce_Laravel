@extends('admin.maindesign')

@section('add_product')

@if (session('msg'))
<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
  {{ session('msg') }}
</div>
@endif

<form class="d-flex mb-4" method="POST" action="{{route('admin.searchproduct')}}">
  @csrf
  <input class="form-control me-2  w-25" type="search" name="search" placeholder="Search product...">
  <button class="btn btn-danger  mx-2" type="submit">Search</button>
</form>



<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Product ID</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product Description</th>
      <th scope="col">Product Quantity</th>
      <th scope="col">Product Price</th>
      <th scope="col">Product Category</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($product as $prod)

    <tr>
      <th scope="row">{{$prod->id}}</th>
      <td>
        <img src="{{ asset('products/'.$prod->product_img) }}" width="80" height="80">
      </td>
      <td>{{$prod->product_title}}</td>
      <td>{{$prod->product_description}}</td>
      <td>{{$prod->product_quantity}}</td>
      <td>{{$prod->product_prices}}</td>
      <td>{{$prod->product_category}}</td>
      <td class="d-flex gap-2">
        <form action="{{ route('admin.productdelete', $prod->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-danger mx-3" onclick="return confirm('Are you sure to delete this category?')">
            Delete
          </button>
        </form>

        <a href="{{ route('admin.editproduct', $prod->id) }}" class="btn btn-success">Edit</a>
      </td>
    </tr>

    @endforeach
  </tbody>
</table>
<div class="mt-3">
  {{ $product->links() }}
</div>
@endsection