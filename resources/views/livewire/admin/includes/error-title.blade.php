@php
$error_data_title_lang = "";
    if(!isset($index))
    $index = 'title';

    $this->error_data_title = null;
@endphp

@foreach ($languages as $lang_it)
            @error('data.'.$lang_it->lang.'.'.$index)

{{--            // Т.к. мы не можем выделить ошибки от разных правил,--}}
{{--            // то показываем всегда сообщение от первой ошибки--}}

            @php($title_error = $title_error ?? $message)
            @php($error_data_title_lang .= "[$lang_it->lang]")
            @php($this->error_data_title = true)
            @enderror
            @endforeach

            @if(isset($this->error_data_title))
            <div class="is-invalid ">
                {{ $title_error }}

                @if(isset($title_error) AND isset($data[session('lang')]) AND isset($data[session('lang')][$index]))
                {{ $error_data_title_lang }}
                @endif
            </div>
            @endif
            @if(isset($message_error))
            <div class="is-invalid ">
                {{ $message_error }}
            </div>
            @endif
