<label for="exampleInputFile">
    @if(isset($title))
    {{$title}}
    @else
    Зображення Галереї
    @endif


</label>

<div class="input-group row">
    @if(isset($tmpGallery[$index]) AND count($tmpGallery[$index])>0)
    @foreach ($tmpGallery[$index] as $key=>$item)
    <div class="col-4">
        <div class="row">
            <div class="col-5">
                <a href="{{$item}}">Документ {{ $key+1}}</a>

            </div>
            <div class="col-5">
                <button class="input-group-text float-left" type="button"
                    wire:click="delTmpGallery({{$key}},'{{$index}}')">Видалити</button>
            </div>
        </div>
    </div>

    @endforeach

    @elseif(isset($data[$index]) AND $data[$index] != "[]")

    @foreach ($data[$index] as $key=>$item)
    @if(\Storage::disk('public')->exists($item))
    <div class="col-4">
        <div class="row">
            <div class="col-7">
                <a href="{{ \Storage::disk('public')->url($item) }}" target="_blank">Документ {{ $key+1}}</a>
            </div>
            <div class="col-5">
                <button class="input-group-text float-left" type="button"
                    wire:click="deletePhotoGallery({{$key}},'{{$item}}','files')">Видалити</button>
            </div>
        </div>
    </div>
    @else
    @php
        $nodocs = true;
    @endphp
    @endif
    @endforeach
    @if(isset($nodocs) AND $nodocs == true)

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="imageDocuments{{$index}}" wire:model="data.{{$index}}" multiple>
        <label class="custom-file-label" for="imageDocuments{{$index}}">@lang('custom::admin.Select the document you want to download')</label>
    </div>
    @endif
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="imageDocuments{{$index}}" wire:model="data.{{$index}}" multiple>
        <label class="custom-file-label" for="imageDocuments{{$index}}">@lang('custom::admin.Select the document you want to download')</label>
    </div>
    @endif

</div>
