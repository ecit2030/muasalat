<!DOCTYPE html>
<html>
<head>
    <title>Moyasar Payment</title>
    <meta charset="UTF-8" />

    <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.7.3/moyasar.css" />
    <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script>
    <script src="https://cdn.moyasar.com/mpf/1.7.3/moyasar.js"></script>
</head>

<body>
<section style="display:flex;height:100vh;width:100%;justify-content:center;align-items:center;">
    <div class="mysr-form" style="width:360px;"></div>
</section>

<script>
    Moyasar.init({
        element: '.mysr-form',
        amount: "{{ $number }}",
        currency: "SAR",
        description: "{{ $description }}",
        publishable_api_key: "{{ config('services.moyasar.publishable_key') }}",
        callback_url: "{{ route('api.payment.moyasar.callback', ['transaction_id' => $transaction->id]) }}",
        methods: ['creditcard', 'applepay'],
        language: "{{ $lang }}",
        metadata: {
            transaction_id: "{{ $transaction->id }}",
            trip_id: "{{ $transaction->pay_data['trip_id'] ?? '' }}"
        },
        apple_pay: {
            country: 'SA',
            label: "{{ $description }}",
            validate_merchant_url: 'https://api.moyasar.com/v1/applepay/initiate',
        }
    });
</script>
</body>
</html>