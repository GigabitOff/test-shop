@if(isset($data[$index]) AND \Storage::disk('public')->exists($data[$index]) OR isset($data[$index]) AND is_object($data[$index]))
<div class="col-md-3 col-6"><div class="uploads-item" style="background-image: url(/admin/assets/img/pdf.svg)">
    <span class="uploads-item__del ico_close" @if(isset($input_dell_wire)) {{$input_dell_wire}} @else onclick="@this.deleteFileData(null,'{{str_replace('\\','/',$data[$index])}}','{{$index}}')" @endif></span>
    </div>
</div>
@elseif(isset($data_tmp))

<div class="col-md-3 col-6"><div class="uploads-item" style="background-image: url(/admin/assets/img/pdf.svg)">
    <span class="uploads-item__del ico_close"   @if(isset($input_dell_wire)) {{$input_dell_wire}} @endif></span>
        <span class="uploads-item__cover" @if(isset($tmpImageMain) AND $tmpImageMain == $key_tmp) style=" opacity: 1;" @endif>
            <span class="uploads-item__btn" @if(isset($tmpImageMain) AND $tmpImageMain == $key_tmp) style=" border-color: #FFDE3F;" @endif onclick="@this.setMainPhoto({{$key_tmp }},'')">@lang('custom::admin.Main image short')</span>
        </span>
    </div>
</div>

@endif
