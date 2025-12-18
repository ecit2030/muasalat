<!DOCTYPE html>
<html>
<?php
$nonice_id = mt_rand(111111, 999999);

// Detect if this is a test payment
$isTestPayment = str_starts_with($invoice->pay_id, 'TEST-');

// Set URLs for real payments
if (!$isTestPayment) {
    $url = "https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId";
    $baseUrl = "https://eu-prod.oppwa.com";
} else {
    $url = "";
    $baseUrl = "";
}

// CSP safe variable
$baseUrlCsp = $baseUrl ? $baseUrl : '';
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy"
          content="
        style-src 'self' {{ $baseUrlCsp }} 'unsafe-inline';
        frame-src 'self' {{ $baseUrlCsp }};
        script-src 'self' {{ $baseUrlCsp }} 'nonce-{{$nonice_id}}';
        connect-src 'self' {{ $baseUrlCsp }};
        img-src 'self' {{ $baseUrlCsp }};
      ">
    <title>Checkout</title>

    @if($paymentMethod->payment =='APPLEPAY')
        <style>
            .wpwl-form {
                height: 500px !important;
            }

            .wpwl-apple-pay-button {
                font-size: 24px !important;
                width: 100% !important;
                height: 100% !important;
                -webkit-appearance: -apple-pay-button;
                -apple-pay-button-type: buy;
                margin-top: 75% !important;
                background: #eee;
                text-align: center;
                padding: 6rem;
            }
        </style>
    @endif
</head>
<body>

@if(!$isTestPayment)
    <!-- Real payment form -->
    <form class="paymentWidgets" data-brands="{{$paymentMethod->payment}}">
    </form>

    <script src="{{$url}}={{ $invoice->pay_id}}" integrity="{{$integrity}}" crossorigin="anonymous"></script>

    <script type="text/javascript" nonce="{{$nonice_id}}">
        var wpwlOptions = {
            style: '{{$paymentMethod->payment=='APPLEPAY'?"plain":"card"}}',
            @if($paymentMethod->payment=='APPLEPAY')
            iframeStyles: {
                'wpwl-group-submit': {
                    'color': '#000000',
                    'font-size': '16px',
                },
                'wpwl-button-pay': {
                    'color': '#000000',
                    'font-size': '16px',
                }
            }
            @endif
            paymentTarget: "_top",
            browser: { threeDChallengeWindow: 5 }
        }
    </script>

@else
    <!-- Test payment: auto redirect -->
    <p style="text-align:center; font-size:18px; margin-top:50px;">
        Test payment successful, redirecting…
    </p>
    <script>
        setTimeout(() => {
            window.location.href = "{{ url('admin/hyperPay/success/'.$invoice->id) }}";
        }, 1000);
    </script>
@endif

</body>
</html>

<!-- original file --
<!DOCTYPE html>
<html>
<?php
//if (env('APP_ENV') == 'local') {
//    $url = "https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId";
//    $baseUrl = "https://eu-test.oppwa.com";
//} else {
    $url = "https://eu-prod.oppwa.com/v1/paymentWidgets.js?checkoutId";
    $baseUrl = "https://eu-prod.oppwa.com";
//}
$nonice_id = mt_rand(111111, 999999);
?>
<head>
    <meta http-equiv="Content-Security-Policy"
          content="
        style-src 'self' {{ $baseUrl }} 'unsafe-inline' ;
        frame-src 'self' {{ $baseUrl }};
        script-src 'self' {{ $baseUrl }} 'nonce-{{$nonice_id}}' ;
        connect-src 'self' {{ $baseUrl }};
        img-src 'self' {{ $baseUrl }};
      ">
</head>
<body>
@if($paymentMethod->payment =='APPLEPAY')
    <style>
        .wpwl-form {
            height: 500px !important;
        }

        .wpwl-apple-pay-button {
            font-size: 24px !important;
            width: 100% !important;
            height: 100% !important;
            -webkit-appearance: -apple-pay-button;
            -apple-pay-button-type: buy;
            margin-top: 75% !important;
            background: #eee;
            text-align: center;
            padding: 6rem;
        }

    </style>
@endif

<form
      class="paymentWidgets"
      data-brands="{{$paymentMethod->payment}}">
</form>

<script src=" {{$url}}={{ $invoice->pay_id}}"
        integrity="{{$integrity}}" crossorigin="anonymous"
></script>

<script type="text/javascript" nonce="{{$nonice_id}}">

    var wpwlOptions = {
        style: '{{$paymentMethod->payment=='APPLEPAY'?"plain":"card"}}',
        @if($paymentMethod->payment=='APPLEPAY')
        iframeStyles: {
            'wpwl-group-submit': {
                'color': '#000000',
                'font-size': '16px',
            },
            'wpwl-button-pay': {
                'color': '#000000',
                'font-size': '16px',
            }
        }
        @endif
        paymentTarget: "_top",
        browser: {
            threeDChallengeWindow: 5
        }
    }
</script>

-->