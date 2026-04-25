@extends('maindesign')
<base href="/public">

@if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif

@section('product_details')

<div class="container mt-4">

    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('viewallproducts') }}" class="text-decoration-none">
            ← Back To Products
        </a>
    </div>

    <!-- Product Card -->
    <div class="row ">
        <div class="col-lg-12 col-md-12 mx-auto">
            <div class="card shadow-lg p-3">
                
                <div class="row align-items-center">
                    
                    <!-- Image -->
                    <div class="col-12 col-md-5 text-center mb-3 mb-md-0">
                        <img src="{{ asset('products/'.$product->product_img) }}" 
                             class="img-fluid rounded"
                             style="max-height: 300px;">
                    </div>

                    <!-- Details -->
                    <div class="col-12 col-md-7">
                        <h3>{{ $product->product_title }}</h3>

                        <h5 class="text-primary mt-2">
                            ₹{{ $product->product_prices }}
                        </h5>

                        <div class="mt-3">
                            <h6>Description</h6>
                            <p>
                                {{ $product->product_description ?? 'No description available' }}
                            </p>
                        </div>

                        <p>
                            <strong>Quantity:</strong> {{ $product->product_quantity }}
                        </p>

                        <a class="btn btn-danger my-btn mt-2 px-4 " href="{{ route('add_to_cart', $product->id) }}">
                            Add to Cart
                        </a>
                        {{-- <a class="btn btn-success my-btnn mt-2 px-4 " href="">
                            Buy Now
                        </a> --}}
                        {{-- <a href="{{ route('checkout',$product->product_prices) }}" class="btn btn-success">
                            Proceed To Payment
                        </a> --}}
                    </div>

                </div>

            </div>
        </div>
    </div>


<div class="modal fade" id="checkoutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('payment.success') }}" method="Post">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title">Enter Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <input type="text" name="name" class="form-control mb-3" placeholder="Your Name" required>

          <input type="text" name="phone" class="form-control mb-3" placeholder="Phone Number" required>

          <textarea name="address" class="form-control mb-3" placeholder="Address" required></textarea>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Proceed to Pay</button>
        </div>

      </form>

    </div>
  </div>
</div>

    <!-- Review Section -->
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-12 col-md-10 col-12">
            <div class="card shadow-lg p-4">
                
                <h4 class="mb-3">Customer Reviews</h4>

                <label class="mb-1">Add Your Review</label>

                <input type="text" name="name" 
                       class="form-control mb-3" 
                       placeholder="Your Name">

                <textarea name="review" 
                          class="form-control mb-3" 
                          rows="4"
                          placeholder="Your Review"></textarea>

                <button class="btn btn-danger my-btn" style="max-width: 180px">
                    Submit Review
                </button>

                <div class="p-2">
                    <h3 class="mt-5">John D.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, accusamus.</p>
                <span>Posted on January 1, 2023</span>
                </div>
                <hr>
                <div class="p-2">
                    <h3 class="">John D.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, accusamus.</p>
                <span>Posted on January 1, 2023</span>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection