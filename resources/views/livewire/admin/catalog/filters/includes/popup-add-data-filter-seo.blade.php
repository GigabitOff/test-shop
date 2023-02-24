<div class="modal fade" id="m-add-data-filter-seo" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title mb-0 pb-0">@lang('custom::admin.Creating an SEO Link')</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            @if(!isset($item_id))
              <div id="message_banner" style="display: none; font-size: 18pt; color: red">
                @lang('custom::admin.Data download in progress')
              </div>
              @endif

            <form action="#!">
                <div wire:ignore>
                @livewire('admin.partials.header-livewire', key(time().'header-livewire'))
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.URL link from website')"
                    wire:model.lazy="data.{{session('lang')}}.url">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.Meta title')"
                    wire:model.lazy="data.{{session('lang')}}.meta_title">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.Meta Description')"
                    wire:model.lazy="data.{{session('lang')}}.meta_description">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.Meta keywords')"
                    wire:model.lazy="data.{{session('lang')}}.meta_keywords">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.Description (for categories)')"
                    wire:model.lazy="data.{{session('lang')}}.description">
                </div>
                <div class="form-group">
                    <input class="form-control @error('seo_url')error @enderror" type="text" placeholder="@lang('custom::admin.SEO Url')"
                    wire:model.lazy="data.{{session('lang')}}.seo_url">
                @error('seo_url')
                @php($error_show=$message)
                <div class="error" name="error">{{ $message}}</div>
                @enderror
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="@lang('custom::admin.H1 for category')"
                    wire:model.lazy="data.{{session('lang')}}.h1">
                </div>
                <div class="text-center">
                    <button class="button" type="button" @if($item_id) wire:click="updateDataFilterSeo" @else wire:click="createDataFilterSeo" @endif>@lang('custom::admin.Save')</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{--@if(isset($error_show))
        <script>
            @this.emit('showAlert', 'error', '{!! str_replace("&#039;","\'",$error_show) !!}');
        </script>
    @endif--}}
</div>
