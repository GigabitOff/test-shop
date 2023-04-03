
<div class="col-md-6 col-12">
                  <div class="upload-instruction">
                    @if(isset($data_it['file']) OR isset($data_it['url']))
                    <div class="upload-instruction__item">
                      <img src="/admin/assets/img/pdf.svg" alt="pdf">
                      <span class="upload-instruction__item-del ico_close" onclick="@this.deleteInstructionFileTmp('{{$index}}')"
                      ></span>
                    </div>
                    @else
                    <div class="add-img upload-instruction__add-img">
                        <div class="dropify-wrapper">
                        <div class="dropify-message">
                            <span class="file-icon"> <p></p>
                            </span>
                            <p class="dropify-error">Недопустимый формат</p>
                        </div>
                        <div class="dropify-loader"></div>
                        <div class="dropify-errors-container">
                            <ul></ul>
                        </div>
                        <input class="dropify" type="file" wire:model="data.item_instr.{{ $index }}.file" accept="application/pdf">
                        <button type="button" class="dropify-clear"></button>
                        <div class="dropify-preview">
                            <span class="dropify-render"></span>
                            <div class="dropify-infos">
                                <div class="dropify-infos-inner">
                                    <p class="dropify-filename">
                                        <span class="file-icon"></span> <span class="dropify-filename-inner"></span>
                                    </p>
                                    <p class="dropify-infos-message">Заменить</p>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                    <div class="upload-instruction__name">
                      <textarea class="upload-instruction__textarea" onclick="this.select()" @if(isset($data_it['data']['file_description'])) onchange="@this.set('data.item_instr.{{$index}}.data.file_description',this.value);" @else onchange="@this.set('data.item_instr.{{$index}}.file_description',this.value);" @endif>{{ isset($data_it['file_description']) ? $data_it['file_description'] : (isset($data_it['data']['file_description']) ? $data_it['data']['file_description'] : '')}}</textarea>
                      <span class="upload-instruction__del" onclick="@this.deleteInstructionItemTmp('{{$index}}');"></span>
                    </div>
                  </div>
                </div>

{{--
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
--}}
