<?php

namespace App\Support\Actions;

use AmrShawky\LaravelCurrency\Facade\Currency as CurrencyFacade;
use App\Models\Currency;

class CurrencyAction
{
    private ?string $imageUrl = '';

    public static function autoExchangeRate()
    {
        $currencies = Currency::get();
        $defaultCurrency = $currencies->where('default', true)->first();

        $currencies_code = collect(config('currencies'))->transform(function ($code) {
            return $code['code'];
        });

        return collect(CurrencyFacade::rates()
            ->latest()
            ->symbols((array) $currencies_code->keys()->toArray()) //An array of currency codes to limit output currencies
            ->base($defaultCurrency->code) //Changing base currency (default: EUR). Enter the three-letter currency code of your preferred base currency.
            /*->amount(5.66) //Specify the amount to be converted
            ->round(2) //Round numbers to decimal places*/
            //->source('ecb') //Switch data source between forex `default`, bank view or crypto currencies.
            ->get())->each(function ($item, $key) {
                Currency::where('code', $key)->update(['exchange_rate' => $item]);
            });
    }

    public static function updateExchangeRate($code)
    {
        $newDefault = Currency::where('code', $code)->first();
        $newExchangeRate = $newDefault->exchange_rate;

        $oldDefault = Currency::where('default', true)->first();
        $oldDefault->update(['exchange_rate' => 1 / $newExchangeRate, 'default' => false]);
        $newDefault->update(['exchange_rate' => 1, 'default' => true]);

        $allCurrencies = Currency::where('code', '!=', $code)
            ->where('code', '!=', $oldDefault->code)
            ->get();
        foreach ($allCurrencies as $currency) {
            $new = $currency->exchange_rate * $oldDefault->exchange_rate;

            $currency->update(['exchange_rate' => $new]);
        }
    }
}
