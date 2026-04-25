<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Details</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: #f5f7fa;
    }
    .card {
      border-radius: 15px;
    }
    .title {
      font-weight: 600;
      color: #333;
    }
    .value {
      font-weight: 500;
      color: #555;
    }
  </style>
</head>

<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-lg p-4">
        
        <!-- Heading -->
        <div class="text-center mb-4">
          <h3 class="fw-bold">🧾 Order Details</h3>
          <hr>
        </div>

        <!-- Customer Info -->
        <h5 class="mb-3 text-primary">Customer Information</h5>
        <div class="row mb-3">
          <div class="col-6 title">Name:</div>
          <div class="col-6 value">{{ $data->user->name }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-6 title">Address:</div>
          <div class="col-6 value">{{ $data->receiver_address }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-6 title">Phone:</div>
          <div class="col-6 value">{{ $data->receiver_phone }}</div>
        </div>

        <hr>

        <!-- Product Info -->
        <h5 class="mb-3 text-success">Product Information</h5>

        {{-- <div class="text-center mb-3">
          <img src="{{ asset('products/'.$data->product->product_img) }}" 
               class="img-fluid rounded shadow"
               style="max-height:200px;">
        </div> --}}

        <div class="row mb-3">
          <div class="col-6 title">Product Name:</div>
          <div class="col-6 value">{{ $data->product->product_title }}</div>
        </div>

        <div class="row mb-3">
          <div class="col-6 title">Price:</div>
          <div class="col-6 value text-success fw-bold">
            ₹{{ $data->product->product_prices }}
          </div>
        </div>

        <hr>

        <!-- Button -->
        {{-- <div class="text-center">
          <a href="{{ url()->previous() }}" class="btn btn-outline-primary px-4">
            ← Back
          </a>
        </div> --}}

      </div>

    </div>
  </div>
</div>

</body>
</html>