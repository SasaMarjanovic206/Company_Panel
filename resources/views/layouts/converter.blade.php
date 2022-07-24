<div class="d-flex flex-row mb-5 currency-div">
    <div class="currency-converter-div">
        <button type="button" class="btn btn-primary" id="currency-converter-btn">{{ __('Currency Converter') }}</button>
    </div>
    @if(session('convertedCurrency'))
        <form action="/currencyconverter" method="GET" class="d-flex" id="currency-form">
    @else
        <form action="/currencyconverter" method="GET" class="d-none" id="currency-form">
    @endif
        <div class="currency-form-member">
            <select class="form-select" name="currency-from" id="currency-from">
                <option value="RSD" @if (old('currency-from') == "RSD") {{ 'selected' }} @endif>RSD</option>
                <option value="EUR" @if (old('currency-from') == "EUR") {{ 'selected' }} @endif>EUR</option>
                <option value="USD" @if (old('currency-from') == "USD") {{ 'selected' }} @endif>USD</option>
                <option value="CHF" @if (old('currency-from') == "CHF") {{ 'selected' }} @endif>CHF</option>
                <option value="AUD" @if (old('currency-from') == "AUD") {{ 'selected' }} @endif>AUD</option>
                <option value="CAD" @if (old('currency-from') == "CAD") {{ 'selected' }} @endif>CAD</option>
                <option value="GBP" @if (old('currency-from') == "GBP") {{ 'selected' }} @endif>GBP</option>
            </select>
        </div>
        <div class="currency-form-member">
            <select class="form-select" name="currency-to" id="currency-to">
                <option value="EUR" @if (old('currency-to') == "EUR") {{ 'selected' }} @endif>EUR</option>
                <option value="RSD" @if (old('currency-to') == "RSD") {{ 'selected' }} @endif>RSD</option>
                <option value="USD" @if (old('currency-to') == "USD") {{ 'selected' }} @endif>USD</option>
                <option value="CHF" @if (old('currency-to') == "CHF") {{ 'selected' }} @endif>CHF</option>
                <option value="AUD" @if (old('currency-to') == "AUD") {{ 'selected' }} @endif>AUD</option>
                <option value="CAD" @if (old('currency-to') == "CAD") {{ 'selected' }} @endif>CAD</option>
                <option value="GBP" @if (old('currency-to') == "GBP") {{ 'selected' }} @endif>GBP</option>
            </select>
        </div>

        <div class="currency-form-member">
            <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}">
        </div>
        <div class="currency-form-member">
            @if(session('convertedCurrency'))
                <p class="text-muted lead currency" id="converted-currency-p">{{ session('convertedCurrency') }}</p>
            @endif
        </div>

        <div class="currency-form-member d-flex justify-content-around">
            <button type="submit" class="btn btn-primary w-40" id="submit-amount-btn">{{__('Submit')}}</button>
            <button type="button" class="btn btn-danger w-40" id="cancel-amount-btn">{{__('Close')}}</button>
        </div>
    </form>
</div>