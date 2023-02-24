
 @php
    $file_url = '';
    $file_name = '';
    $extension = '';
    $data_index = null;
    if(isset($lang_img))
    {
        if(isset($data[$index]['lang'][$lang_img])){
        $data_index = $data[$index]['lang'][$lang_img];
        }

    }else{
        if(isset($data[$index]))
        $data_index = $data[$index];
    }

@endphp

@if(isset($data_index) AND \Storage::disk('public')->exists($data_index) OR isset($data_index) AND is_object($data_index))
                @if(\Storage::disk('public')->exists($data_index))
                @php
                    $extension = \File::extension(\Storage::disk('public')->url($data_index));
                    $url_file = \Storage::disk('public')->url($data_index);
                    $file_name = '';
                @endphp
                @elseif(is_object($data_index))
                    @php
                    $extension = \File::extension($data_index->path());
                    //$extension = explode('?',$extension)[0];
                    $file_name = $data_index->getClientOriginalName();

                    if(isset($type) AND $type == 'file'){
                        $url_file = $data_index->getClientOriginalName();
                        //$url_file = $data_index->temporaryUrl();

                    }elseif(!empty($ext_check)){

                        if(in_array($extension, $ext_check))
                        {
                        $url_file = $data_index->temporaryUrl();

                        }else{
                        $error = 'Файл має бути формату '.implode($ext_check);
                            if(isset($lang_img)){
                             unset($data[$index]['lang'][$lang_img]);
                            }else{
                            unset($this->data[$index]);

                            }
                        }
                    }else{
                    if(in_array($extension, ['png', 'svg', 'jpg', 'jpeg', 'gif', 'webp']))
                        {
                        $url_file = $data_index->temporaryUrl();

                        }else{
                        $error = 'Файл має бути формату .jpeg (jpg), .png, .webp, .svg, .gif';

                            if(isset($lang_img)){
                             unset($data[$index]['lang'][$lang_img]);
                            }else{
                            unset($this->data[$index]);

                            }

                        }
                    }


                    @endphp
                @endif


@endif
   <div class="dropify-wrapper @if(!isset($error)) @if(isset($data_index) AND \Storage::disk('public')->exists($data_index) OR isset($data_index) AND is_object($data_index))has-preview @endif @else has-error @endif">


        <div class="dropify-message ">
            @if(!isset($data_index) OR !\Storage::disk('public')->exists($data_index) AND !is_object($data_index))
            <span class="file-icon"><p></p></span>
            @endif


            @if(isset($error))

            <p class="dropify-error">{{ $error }}</p>
            @endif
        </div>
        <div wire:loading wire:target="photo">
            <div class="dropify-loader" style="display: block;"></div>
        </div>
        <div class="dropify-errors-container"><ul></ul></div>


        @if(isset($data_index) AND \Storage::disk('public')->exists($data_index) OR isset($data_index) AND is_object($data_index))
            <button type="button" class="dropify-clear" @if(isset($input_dell_wire)){{ $input_dell_wire }}@else wire:click="deleteFileData(null,'{{str_replace('\\','/',$data_index)}}','{{$index}}')" @endif></button>
        <div class="dropify-preview" style="display: block;">
            <span class="dropify-render">

            @if(!isset($error))
                @if(!isset($type) AND $extension  == '')
                    @php($extension='jpg')
                @endif
                @if(in_array($extension, ['png', 'svg', 'jpg', 'jpeg', 'gif', 'webp']))
                    @if(is_object($data_index))
                    @php($url_file = $data_index->temporaryUrl())
                    @endif
                <img src="{{ isset($url_file) ? $url_file : '' }}">


                @else
                <i class="dropify-font-file"></i>
                <span class="dropify-extension">{{ $extension }}</span>
                @endif
            @endif
            </span>
            @if(!isset($error))
            <div class="dropify-infos">
                <div class="dropify-infos-inner">
                    <p class="dropify-filename">
                        <span class="file-icon"></span>
                        <span class="dropify-filename-inner">{{basename($url_file)}}</span>
                    </p>
                    <p class="dropify-infos-message">Заменить</p>
                </div>
            </div>
            @endif
        </div>
            <input class="dropify2" type="file" onchange="@this.emit('changesStart')" id="pageImage-{{$index}}" wire:model="data.{{isset($lang_img) ? $index.'.lang.'.$lang_img : $index }}" @if(isset($multiple)) multiple @endif>

        @else
            <input class="dropify2" type="file"  onchange="@this.emit('changesStart')" id="pageImage-{{$index}}" wire:model="data.{{ isset($lang_img) ? $index.'.lang.'.$lang_img : $index }}" @if(isset($multiple)) multiple @endif>
        @endif


    </div>

