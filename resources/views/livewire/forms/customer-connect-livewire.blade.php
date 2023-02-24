<div class="modal-content">
    @if($isUploadLazyContent)
        <div class="modal-header">
            <h5 class="modal-title">@lang('custom::site.connect_customer')<span>@lang('custom::site.on_project_domain')</span></h5>
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
                @if(session()->has('fail_upload'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail_upload') }}
                    </div>
                    {{-- Не отображаем содержимое окна при ошибке загрузки--}}
                @else

                        <div class="form-group js-hide-form-group select2-group">
                            <div style="display: none">
                                <select name="customer-hidden"
                                        multiple="multiple">
                                    @foreach($customers as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $customer_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div wire:ignore>
                                <select name="customer" multiple="multiple"
                                        data-params="{{ json_encode(['placeholder'=> __('custom::site.customer')]) }}">
                                    @foreach($customers as $id => $name)
                                        <option value="{{$id}}"
                                                @if(in_array($id, $customer_ids)) selected @endif>{{$name}}</option>
                                    @endforeach
                                </select>
                                <script>
                                    $('#modal-customer-connect select[name="customer"]')
                                        .select2({placeholder: "@lang('custom::site.customer')"})
                                        .on('change', function (e) { @this.set('customer_ids', $(e.target).val())
                                        });
                                    //# sourceURL=modal-customer-connect-livewire.js
                                </script>
                            </div>
                            @error('customer_ids')
                            <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                            @enderror
                        </div>

                    <div class="mt-5">
                        <button class="button button-secondary button-block button-lg"
                                onclick="$('#modal-customer-connect').modal('hide')"
                                type="submit">@lang('custom::site.connect')
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @endif
</div>
