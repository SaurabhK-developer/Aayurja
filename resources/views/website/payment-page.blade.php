<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <form action="{{ route('payment.success') }}" method="POST" id="razorpay-form">
        @csrf
    </form>

    <script>
        var options = {
            "key": "{{ $key }}", // Razorpay Key ID
            "amount": "{{ $order['amount'] }}", // Amount in paisa
            "currency": "INR",
            "name": "Aayurja",
            "description": "Payment for Order",
            "image": "https://aayurja.com/public/images/header-logo.webp",
            "order_id": "{{ $order['id'] }}", // Razorpay Order ID
            "handler": function (response) {
                var form = document.getElementById('razorpay-form');

                var razorpay_payment_id = document.createElement("input");
                razorpay_payment_id.type = "hidden";
                razorpay_payment_id.name = "razorpay_payment_id";
                razorpay_payment_id.value = response.razorpay_payment_id;
                form.appendChild(razorpay_payment_id);

                var razorpay_order_id = document.createElement("input");
                razorpay_order_id.type = "hidden";
                razorpay_order_id.name = "razorpay_order_id";
                razorpay_order_id.value = response.razorpay_order_id;
                form.appendChild(razorpay_order_id);

                var razorpay_signature = document.createElement("input");
                razorpay_signature.type = "hidden";
                razorpay_signature.name = "razorpay_signature";
                razorpay_signature.value = response.razorpay_signature;
                form.appendChild(razorpay_signature);

                form.submit();
            },
            "modal": {
                "ondismiss": function(){
                    // If user cancels the Razorpay popup
                    window.location.href = "{{ route('payment.failed') }}";
                }
            },
            "theme": {
                "color": "#F37254"
            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    </script>


</body>
</html>
