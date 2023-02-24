<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.counterparty_add')<small>@lang('custom::site.on_project_domain')</small></h5><button class="btn-close" type="button" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit" id="addLkCustomerCounterpartyForm">
            <div class="form-group _hide" wire:ignore.self>
                <label class="check">
                    <input class="check__input" id="checkbox-pdv-1" type="checkbox"
                           wire:model.defer="with_vat" checked>
                    <span class="check__box"></span>
                    <span class="check__txt">@lang('custom::site.with_vat')</span>
                </label>
            </div>
            <div class="form-group" wire:ignore.self>
                <input class="form-control @error('company_name') is-invalid @enderror"
                       type="text"
                       wire:model.defer="company_name"
                       placeholder="@lang('custom::site.company_name')"
                       name="company">
                <div class="invalid-feedback">@error('company_name'){{$message}}@enderror</div>
            </div>
            <div class="form-group" wire:ignore.self>
                @include('livewire.includes.drop-filterable-front', [
                    'class' => '--arrow',
                    'model' => 'filterableCompanyType',
                    'placeholder' => __('custom::site.company_type'),
                ])
                @error('filterableCompanyTypeId')
                <div class="invalid-feedback" style="display:block;">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group" wire:ignore.self>
                <input class="form-control js-okpo @error('okpo') is-invalid @enderror"
                       id="fr_okpo"
                       onchange="@this.set('okpoRaw', this.value)"
                       placeholder="@lang('custom::site.edrpou')"
                       type="text" value="{{$okpoRaw}}" name="okpo">
                <div class="invalid-feedback">@error('okpo'){{$message}}@enderror</div>
            </div>

            <div  class="form-group">

                @if(isset($data['users_name']) AND $data['users_name'] != '')
                    <div class="tagger">
                        <input class="form-control" type="hidden" placeholder="Додати хештег" value="sdfsdf,dfsdfsdf" hidden="hidden">
                        <ul>
                            @foreach ($data['users_name'] as $item_user)
                                <li>
                                    <a href="javascript: void(0);" class="--yellow">
                                        <span class="label">{{$item_user['name']}}</span>
                                        <span href="#" class="close" onclick="@this.unSetDataUSER('{{$item_user['id']}}')">×</span>
                                    </a>
                                </li>
                            @endforeach
                            @if(isset($this->data['no_users_name']) AND count($this->data['no_users_name'])>0)
                                @foreach ($data['no_users_name'] as $item_no_user)
                                    <li>
                                        <a href="javascript: void(0);">
                                            <span class="label">{{$item_no_user }}</span>
                                            <span href="#" class="close" onclick="@this.unSetDataUSER('{{$item_no_user}}')">×</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                            <li class="tagger-new">
                                <input class="js-tags-next-create" onkeypress="return addNewTagsCreate(event)" placeholder="@lang('custom::site.Related users')" >
                                <div class="tagger-completion"></div>
                            </li>
                        </ul>
                    </div>
                @else
                    <input class="js-tags-create form-control" onkeypress="return addNewTagsFirstCreate(event,this.value)" type="text" placeholder="@lang('custom::site.Related users')" value = "">
                @endif

                {{-- <div class="form-group mt-4"><button class="button" type="button">Добавить</button></div>--}}

            </div>

            <div class="form-group">
                <div class="upload-file-block --small">
                    <div class="upload-file-block__btn"><label class="upload-file-block__label"><input class="upload-file-block__input @error('file') is-invalid @enderror" type="file" name="upload-file" wire:model="file"  />
                            <div class="upload-file-block__label-content"><span class="ico_upload"></span><span>@lang('custom::site.upload_statut')</span></div>
                        </label>
                        <div class="invalid-feedback">@error('file'){{$message}}@enderror</div>
                    </div>
                    <div class="upload-file-block__box"></div>
                </div>
            </div>
            <div class="form-group">
                <button class="button-accent w-100"
                        onclick="document.addLkCustomerCounterpartyForm.submitClick()"
                        type="submit">@lang('custom::site.add')</button>
            </div>
        </form>
    </div>
</div>
@push('custom-scripts')
    <script>

        $('form#addLkCustomerCounterpartyForm').keypress(function (e) {
            var keyCode = e.keyCode ? e.keyCode : e.which;
            if (keyCode == 13)
            {
                e.preventDefault();
                //$('form#login').submit();
                return false;
            }
        });

        function addNewTagsCreate(e) {
            if(e.which == 13) {
            @this.setDataUSER($('.js-tags-next-create').val())
                $('.js-tags-next-create').val('');
            }
        }
        function addNewTagsFirstCreate(e,value) {
            if(e.which == 13) {
            @this.setDataUSER(value)
                $('.js-tags-create').val('');
            }
        }

        document.addLkCustomerCounterpartyForm = {
            submitClick: () => {
                const form = document.getElementById('addLkCustomerCounterpartyForm');
                if (form.checkValidity()) {
                    @this.set('okpoRaw', $(form).find('input[name=okpo]').val());
                }
            }
        }

    </script>
@endpush
