<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<h2>Pay with Razorpay</h2>
<button id="payBtn">Pay Now</button>

<script>
    document.getElementById("payBtn").addEventListener("click", function() {
        fetch('/create-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ amount: 500 }) // Amount in INR
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("Error: " + data.error);
                return;
            }

            var options = {
                "key": "{{ env('RAZORPAY_KEY_ID') }}",
                "amount": data.amount,
                "currency": "INR",
                "name": "Your Company Name",
                "description": "Test Transaction",
                "order_id": data.id,
                "handler": function (response){
                    alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
                },
                "prefill": {
                    "name": "Test User",
                    "email": "test@example.com",
                    "contact": "9999999999"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
        })
        .catch(error => console.log(error));
    });
</script>

</body>
</html>
