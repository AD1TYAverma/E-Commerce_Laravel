@extends('admin.maindesign')

@section('vieworders')

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            
            <th scope="col">Product Image</th>
            <th scope="col">Customer Name</th>
            <th scope="col"> Address</th>
            <th scope="col"> Phone</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Status</th>
            <th scope="col">PDF</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)

        <tr>
            
            <td>
                <img src="{{ asset('products/'.$order->product->product_img) }}" width="80" height="80">
            </td>
            <td>{{$order->user->name}}</td>
            <td>{{$order->receiver_address}}</td>
            <td>{{$order->receiver_phone}}</td>
            <td>{{$order->product->product_title}}</td>
            <td>{{$order->product->product_prices}}</td>
            <td class="d-flex gap-2">
              <form action="{{route('admin.change_status', $order->id)}}" method="POST">
                @csrf
                <select name="status" class="form-select form-control mt-2" aria-label="Default select example">
                    <option value="{{$order->status}}">{{$order->status}}</option>
                    <option value="confirm">Confirm</option>
                    <option value="Delivered">Delivered</option>
                </select>
                <input type="submit" name="submit" value="submit" class="btn btn-danger mt-2" onclick="return confirm('Are You Sure?')">
              </form>  
            </td>
            <td>
                <a href="{{route('admin.downloadpdf',$order->id)}}" class="btn btn-success btn-sm">Download PDF</a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

@endsection