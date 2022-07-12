@component('mail::message')
# {{ __('Created Company Information') }}

{{ __('Kreirali ste kompaniju') }} {{ $company->name }}.


{{ __('Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
