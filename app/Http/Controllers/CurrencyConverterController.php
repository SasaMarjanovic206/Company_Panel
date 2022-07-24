<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CurrencyConverterInterface;

class CurrencyConverterController extends Controller
{
    private $converter;

    public function __construct(CurrencyConverterInterface $currencyConverter)
    {
        $this->middleware('auth');
        $this->converter = $currencyConverter;
    }

    public function converter(Request $request)
    {
        $from = $request->input('currency-from');
        $to = $request->input('currency-to');
        $amount = $request->input('amount');

        $convertedCurrency = $this->converter->convert($from, $to, $amount);

        return redirect()->back()->with('convertedCurrency', $convertedCurrency)->withInput($request->all());
    }
}
