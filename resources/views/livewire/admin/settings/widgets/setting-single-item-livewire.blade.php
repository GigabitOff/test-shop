<div>
    {{-- Settings single Item. --}}
    @switch($type)
        @case('image')
       
        @include('livewire.admin.includes.image-data-grow',['index'=>'value','grow'=>$grow,'title'=>isset($title) ? $title : __('custom::admin.Banner single')])
        @break
        @case('file')
        @include('livewire.admin.includes.image-data-grow',['index'=>'value','title'=>isset($title) ? $title : __('custom::admin.Banner single')]) {{-- ,'title_size'=>(isset($title_size_image) ? $title_size_image : null) --}}
        @break
        @case('textarea')
        <div class="textareEditor" @if(isset($ckeditor) AND $ckeditor === true) wire:ignore @endif >
            <textarea  placeholder="{{$placeholder ? $placeholder : ''}}" class="form-control" id="id_{{session('lang')}}_{{$key}}" cols="30" rows="10" wire:model.lazy='data.{{session('lang')}}.value_lang'>
                {{ isset($data[session('lang')]['value_lang']) ? $data[session('lang')]['value_lang'] : $data['value']}}
            </textarea>

             @if(isset($ckeditor) AND $ckeditor === true)
        @include('livewire.admin.includes.ckeditor-form', ['formId'=>'id_'.session('lang').'_'.$key, 'nameForm'=>'data.'.session('lang').'.value_lang'])

            @endif
        </div>


            @break
        @default
    <input class="form-control" type="text" placeholder="{{$placeholder ? $placeholder : ''}}" wire:model.lazy='data.{{session('lang')}}.value_lang'>
    @endswitch
    @if($type == 'image')

    @else
    @endif
    @if(session('success_'.$key))<div>{{session('success_'.$key)}}</div>@endif
</div>
