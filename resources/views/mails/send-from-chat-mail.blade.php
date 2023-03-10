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
    @if(isset($data['url']))
    <tr>
        <td>
           URL: <a href="{{ $data['url'] }}">{{ $data['url'] }}</a>
        </td>
    </tr>
    @endif
</table>
<br>
<h3>Текст повідомлення</h3>
<table class="head_data" width="100%">
    @if(isset($data['id']))
    <tr>
        <td width="200px">
            @lang('custom::site.Chat id')
        </td>
        <td width="600px">
            {{ $data['id'] }}
        </td>
    </tr>
    @endif
    @if(isset($data['popup']))
    <tr>
        <td width="200px">
            @lang('custom::site.Popup')
        </td>
        <td width="600px">
            {{ $data['popup'] }}
        </td>
    </tr>
    @endif
    <tr>
        <td width="200px">
            @lang('custom::site.Fio')
        </td>
        <td width="600px">
            {{ $data['name'] }}
        </td>
    </tr>
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
