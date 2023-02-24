<div class="container-medium mb-3" >
    <div class="row mb-3" >
    <div class="col-12">
        <input class="form-control" type="text" placeholder="@lang('custom::admin.Url YouTube')" wire:model.lazy="data.link_youtube">

    </div>
    </div>
    <div class="uploads-widjet row g-3">
        <div class="col-md-8">
            <div class="uploads-widjet row g-3">
                <div class="col-md-3 col-6">
                    <div class="uploads-box">
                        <label><input type="file" id="pageImage-gallery" wire:model="data.gallery" multiple><span class="ico_add"></span></label>
                    </div>
                </div>
                @if(isset($product_image) AND count($product_image)>0)
                    @foreach ($product_image as $key_ph => $photo)
                    @if(!isset($image_dell_tmp[$photo->id]))
                        @include('livewire.admin.includes.add-gallery',[
                            'index'=>'gallery_'.$photo->id,
                            'data'=>['gallery_'.$photo->id=>$photo->url],
                            'input_dell_wire'=>'wire:click=deleteGalleryItemTmp('.$photo->id.')'])
                    @endif
                    @endforeach
                @endif

                @if(isset($data['item_g']))
                    @foreach ($data['item_g'] as $key_tmp => $item_tmp)
                    @include('livewire.admin.includes.add-gallery',[
                            'index'=>'gallery_tmp_'.$key_tmp,

                            'data_tmp'=>$item_tmp,
                            'input_dell_wire'=>'wire:click=deleteGalleryItemTmp('.$key_tmp.',"key_tmp")'])
                    @endforeach
                @endif

            </div>
        </div>
        <div class="col-4" wire:ignore>
        @if(isset($product_main_image['url']) AND !$tmpImageMain)
        <div class="uploads-main-img" style="display: block;">
            <div class="uploads-item" style="background-image: url({{\Storage::disk('public')->url($product_main_image->url)}})"></div>
                <div class="uploads-item__title">@lang('custom::admin.Main image')</div>
            </div>
        @else
        <div class="uploads-main-img" style="display: block;">
            <div class="uploads-item" style="background-image: url()"></div>
                <div class="uploads-item__title">@lang('custom::admin.Main image')</div>
            </div>
        @endif
        </div>
    </div>

</div>
