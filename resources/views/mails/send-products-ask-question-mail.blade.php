@component('mail::message')
<table class="head_data">
    <tr></tr>
    <td width="400px">
        {{ env('APP_NAME') }}
    </td>
    </tr>
    <tr>
        <td>
            <a href="{{ env('APP_URL') }}">{!!$subject!!}</a>
        </td>
    </tr>
    @if(isset($data['product']['name']))
    <tr>
        <td>
           Продукт: id: {{ $data['product']['id'] }}, {{ $data['product']['name'] }}</a>
        </td>
    </tr>
    @endif
</table>
<br>
@if(isset($data['userId']))
<p style="color:red">
    ID: {{$data['userId']}}
    @lang('custom::site.Message for email alert')
</p>
@endif
<h3>Текст повідомлення</h3>
<table class="head_data" width="100%">
    <tr>
        <td width="200px">
            @lang('custom::site.Fio')
        </td>
        <td width="600px">
            {{ $data['name'] }}
        </td>
    </tr>
    @if(isset($data['phone']))
    <tr>
        <td>
           Телефон: <a href="{{ $data['phone'] }}">{{ $data['phone'] }}</a>
        </td>
    </tr>
    @endif
    @if(isset($data['email']))
    <tr>
        <td>
           Телефон: <a href="{{ $data['email'] }}">{{ $data['email'] }}</a>
        </td>
    </tr>
    @endif
    @if(isset($data['message']))
    <tr>
        <td width="200px">
            @lang('custom::site.message')
        </td>
        <td>
            {{ $data['message'] }}
        </td>
    </tr>
    @endif
</table>
@endcomponent
