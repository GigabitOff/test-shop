<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.change_founder')<span>@lang('custom::site.on_project_domain')</span>
            </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                    class="ico_close"></span></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="submit" autocomplete="off">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group nice-select-group">
                    <x-livewire.nice-select-revalidated
                        model="customerId"
                        :value="$customerId"
                        :list="$customerList"
                        :placeholder="__('custom::site.select_new_founder')">
                    </x-livewire.nice-select-revalidated>
                    @error('customerId')
                    <div class="invalid-feedback" style="display:block;"> {{$message}} </div>
                    @enderror
                </div>

                <div class="mt-5">
                    <button class="button button-secondary button-block button-lg"
                            onclick="$('#modal-customer-connect').modal('hide')"
                            type="submit">@lang('custom::site.do_change')
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
