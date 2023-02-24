<label for="exampleInputFile">
    @if(isset($title))
    {{$title}}
    @else
    Додаткове завантаження фото в галерею
    @endif
    Глобально
</label>
<div class="input-group row">
    @if(isset($tmpGalleryAdd) AND count($tmpGalleryAdd))
    @foreach ($tmpGalleryAdd as $key=>$item)
    <div class="col-4">
        <div class="row">
            <div class="col-5">

                <img src="{{ $item ? $item :  '' }}" alt="">

            </div>
            <div class="col-5">
                <button class="input-group-text float-left" type="button"
                    wire:click="delTmpGallery({{$key}})">Видалити</button>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="pageImageGalleryTmp" wire:model="data.galery_add" multiple>
        <label class="custom-file-label" for="pageImage">@lang('custom::admin.Choose a photo')</label>
    </div>
    @endif

</div>
