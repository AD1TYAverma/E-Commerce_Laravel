<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
    .form-control:focus {
    border-color: rgb(219, 70, 102);
    box-shadow: 0 0 0 rgb(219, 70, 102);
}
</style>
</head>

<body>
    @if (session('msg'))

<div class="mb-4 alert alert-success alert-dismissible fade show px-4 py-3">
    {{ session('msg') }}
</div>
    
@endif
    
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6">

        <div class="card shadow-lg p-4">

            <h4 class="text-center mb-4">Enter Details</h4>

            <form action="{{ route('payment.success') }}" method="POST">
                @csrf

                
                <input type="text" name="receiver_phone" 
                       class="form-control mb-3" 
                       placeholder="Phone Number" required>

                <textarea name="receiver_address" 
                          class="form-control mb-3" 
                          placeholder="Address" required></textarea>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h5>Total: ₹ {{$total}}</h5>
                    <button id="rzp-button" type="button" class="btn btn-primary">
                        Pay Now
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>





    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    {{-- <script>
        //  let form = document.querySelector("form");

      // 🔴 VALIDATION CHECK
    //  if (!form.checkValidity()) {
    //      form.reportValidity(); // required fields show karega
    //      return;
    //  }
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "{{ $total * 100 }}", // paisa me
            "currency": "INR",
            "name": "Giftor",
            "description": "Order Payment",
            "handler": function (response) {
                window.location.href = "/payment-success?payment_id=" + response.razorpay_payment_id;
            }
        };

        var rzp = new Razorpay(options);

        document.getElementById('rzp-button').onclick = function (e) {
            rzp.open();
            e.preventDefault();
        }
    </script> --}}

<script>
document.getElementById('rzp-button').onclick = function (e) {

    let form = document.querySelector("form");

    // validation
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": "{{ $total * 100 }}",
        "currency": "INR",
        "name": "Giftor",
        "description": "Order Payment",

        "handler": function (response) {

            // hidden input add
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = "payment_id";
            input.value = response.razorpay_payment_id;

            form.appendChild(input);

            form.submit(); // 🔥 IMPORTANT
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();

    e.preventDefault();
}
</script>


</body>

</html>