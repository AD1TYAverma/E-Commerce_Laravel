@extends('maindesign')

@section('viewcartproducts')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $price = 0;
                    @endphp
                    @foreach ($cart as $crt)

                    <tr>

                        <td>
                            <img src="{{ asset('products/'.$crt->product->product_img) }}" width="80">
                        </td>

                        <td>{{ $crt->product->product_title }}</td>

                        <td>&#8377; {{ $crt->product->product_prices }}</td>
                        <td class="d-flex gap-2">
                            {{-- <form action="{{ route('admin.productdelete', $crt->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mx-3"
                                    onclick="return confirm('Are you sure to delete this category?')">
                                    Delete
                                </button>
                            </form> --}}

                            <a href="{{ route('removecartproduct', $crt->id) }}" class="btn btn-success">Remove</a>
                        </td>
                    </tr>
                    @php
                    $price = $price+$crt->product->product_prices;
                    @endphp

                    @endforeach


                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-end">
                <h5 class="fw-bold"><span class="mx-3">Total:</span> &#8377; {{$price}}</h5>
            </div>
        </div>
    </div>
    
@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif





    <div class="row my-4">
        <div class="col-sm-8 mx-auto shadow-lg p-4">
            <form action="{{route('confirm_order')}}" method="POST">
                @csrf
                <textarea name="receiver_address" class="form-control mb-3" placeholder="Enter Your Address" required></textarea>
                <input type="text" name="receiver_phone" placeholder="Enter Your Phone Number" class="form-control mb-3"> 
                <input type="submit" name="submit" value="Confirm Order" class="btn my-btn">
                <a href="{{ route('checkout') }}" class="btn btn-success">
                    Proceed To Payment
                </a>
                
        </div>
    </div>
</div>
@endsection