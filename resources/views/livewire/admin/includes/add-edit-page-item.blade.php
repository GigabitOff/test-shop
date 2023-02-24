<!-- /.card-dataItem -->
@if($dataItemCount>0)
@for ($i = 0; $i < $dataItemCount; $i++) <div class="card-body">

    <div class="form-group">
        <label for="dataItemTitle{{$i}}{{$lang}}">
            @lang('custom::admin.Title')
        </label>
        <input type="text" class="form-control @error('dataItem.{{$i}}.{{$lang}}.title') is-invalid @enderror"
            id="dataItemTitle{{$i}}{{$lang}}" placeholder="@lang('custom::admin.Title')"
            wire:model="dataItem.{{$i}}.{{$lang}}.title">
    </div>
    <div class="form-group" wire:ignore>
        <label>@lang('custom::admin.Description')</label>
        <textarea class="form-control" rows="3" cols="30" data-description="@this"
            placeholder="@lang('custom::admin.Description')" wire:model="dataItem.{{$i}}.{{$lang}}.description"
            id="dataItem{{$i}}{{$lang}}description">
                @if(isset($dataItem[$i][$lang]['description']))
                {{ $dataItem[$i][$lang]['description'] }}

                @endif
        </textarea>

    </div>
    <div class="form-group">
        @include('livewire.admin.includes.add-image-data-item',
        ['index'=>$lang.'.img','i'=>$i, 'itleImage'=>"Зображення сторінки глобально."])
    </div>
    </div>
    @endfor


    @endif

    <div class="form-group">
        <button type="button" class="btn btn-primary" wire:click="addDataItem">@lang('custom::admin.Add page')</button>
    </div>

    <!-- /.card dataItem-->
