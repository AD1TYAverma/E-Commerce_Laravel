@extends('maindesign')
@section('index')

@if(session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
    
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        @foreach ($products as $prod)
            <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            <a href="{{route('product_detalis', $prod->id)}}">
              <div class="img-box">
                <img src="{{asset('products/'.$prod->product_img)}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{$prod->product_title}}
                </h6>
                <h6>
                  Price
                  <span>
                    &#8377;{{$prod->product_prices}}
                  </span>
                </h6>
                <br>
                
              </div>
              <div class="new">
                <span>
                  New
                </span>
              </div>
              
            </a>
          </div>
        </div>
        @endforeach
        
      </div>
      <div class="btn-box">
        <a href="{{route('viewallproducts')}}">
          View All Products
        </a>
      </div>
    </div>
  
@endsection