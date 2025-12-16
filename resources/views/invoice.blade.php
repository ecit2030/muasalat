<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>{{ $appname }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ public_path('favicon.ico') }}" type="image/x-icon">

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Amiri', 'Lateef', 'Scheherazade', Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        @if($locale == 'ar')
        .invoice-box table tr.heading {
            text-align: right;
        }
        @else
            .invoice-box table tr.heading {
                text-align: left;
            }
        @endif

    </style>
</head>

<body dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">
<div class="invoice-box{{ $locale == 'ar' ? ' rtl' : ''}}">
    <div style="margin-bottom: 20px;text-align: center">
        <img src="{{ asset('logo.png') }}" alt="Company logo"
             style="margin-bottom: 10px;width: 150px; height: 150px;display: block;margin: auto">

            <img src="{{ $report?->qr }}" alt="qr"
                 style="margin-bottom: 10px;width: 150px; height: 150px;display: block;margin: auto">

        <div style="margin-bottom: 10px;">
            @lang('Invoice Number') #: {{ $report->id }}<br>
            @lang('Created At'): {{ $report->created_at->format('M , d Y') }}<br>
        </div>

        <div style="margin-bottom: 10px;">
            {{ $appname }}, @lang('Inc').<br>
            {{ $address }}<br>
        </div>

        <div style="margin-bottom: 10px;">
            {{ $user->name }}<br>
            {{ $user->email }}<br>
        </div>
    </div>
    <table>
        <tbody>

        <tr class="heading">
            <td>@lang('messages.Payment Method') :</td>
            <td>{{ __('messages.'.$report->payment_method) }}</td>
        </tr>

        <tr class="details">
            <td>@lang('messages.trip total') :</td>
            <td>{{ number_format($report->total,2) }}</td>
        </tr>

        <tr class="heading">
            <td colspan="2">{{$report->reservation_type == 'other' ? __('messages.the trip') : __('messages.trips')}}</td>
        </tr>

        @foreach($report->trips as $trip)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td style="border-bottom: 1px solid #888">@lang('messages.trip') {{ $loop->index + 1 }}</td>
                <td style="border-bottom: 1px solid #888">
                    {{ __('Driver Name', [], $locale) }} : {{ $trip?->driver?->name ?? '--' }} <br>
                    {{ __('Sequence Number', [], $locale) }}
                    : {{ '# ' . !$trip->parent_id ? $trip->id : $trip->parent?->id }} <br>
                    {{ __('messages.from', [], $locale) }} :
                    {{ array_key_exists('location',$trip?->origin) ? $trip->origin['location'] : __('Source', [], $locale) }}
                    <br>
                    {{ __('messages.to', [], $locale) }} :
                    {{ array_key_exists('location',$trip?->destination) ? $trip->destination['location'] : __('Destination', [], $locale) }}
                    <br>
                    {{ __('messages.trip date', [], $locale) }} : {{ $trip?->date  }} <br>
                    {{ __('Start Time', [], $locale) }} : {{ $trip?->time  }} <br>
                    {{ __('Created At', [], $locale) }} : {{ $trip?->created_at?->translatedFormat('l j/n/Y') }} <br>
                    @if($report->reservation_type != 'other')
                        {{ __('messages.trip type', [], $locale) }} : {{ __('messages.'.$trip?->trip_type) }} <br>
                    @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td>@lang('Kilometer Price',[],$locale): {{ $report->km_price }}</td>
        </tr>
        <tr>
            <td></td>
            <td>@lang('Tax',[],$locale): {{ number_format($report->tax_value,2) }}</td>
        </tr>
        <tr>
            <td></td>
            <td>@lang('Total',[],$locale): {{ number_format($report->sub_total,2) }}</td>
        </tr>
        <tr class="total">
            <td></td>
            <td>@lang('Grand Total',[],$locale): {{ number_format($report->total,2) }}</td>
        </tr>

        </tbody>
    </table>
</div>


</body>
</html>