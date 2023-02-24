<div class="add-img @if(!isset($grow) AND !isset($class)  OR isset($grow) AND $grow !== false)--grow @endif @if(isset($class)) {{$class}} @endif">
    @if(isset($data[$index]) AND is_object($data[$index]))
    @php
        $extension = \File::extension($data[$index]->path());

        if(in_array($extension, ['png', 'svg', 'jpg', 'jpeg', 'gif', 'webp']) AND !isset($type))
        {

        }elseif(!isset($type)){
            $error = 'Файл має бути формату .jpeg (jpg), .png, .webp, .svg, .gif';
            unset($data[$index]);
        }

    @endphp
    @endif
    @include('livewire.admin.includes.add-file-data')
        <div class="add-img__info">
            @if($title AND $title != '')
            <div class="add-img__title">{{ $title }}</div>
            @endif
            @if(isset($title_size))
            <div class="add-img__size">{{ $title_size }}</div>
            @endif

            @if(isset($error))
            <div class="is-invalid">
                {{$error}}
            </div>
            @endif
    </div>
</div>
