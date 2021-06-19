@component('mail::message')
# {{ $details['title'] }}

<div style="text-align: center">
    <br>{{ $details['body'] }}<br><br>
    <img src="data:image/png;base64,{{ $details['qrcode'] }}" alt="" width="200">
</div>


@component('mail::button', ['url' => $details['url']])
View Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
