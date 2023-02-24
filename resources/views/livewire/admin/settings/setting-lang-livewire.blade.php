<div>
    {{-- Setting Lang and Files. --}}
    <h4>@lang('custom::admin.Multilingual')</h4>
    <ul class="lang-list">
    </ul>
    <div class="table-before-btn --custome --setting-lang" >
        <div>
            <div class="action-group">
                <div class="action-group-btn button-accent"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                    <ul class="action-group-list">
                        <li>
                            <button class="ico_plus" type="button" onclick="@this.resetLang(); @this.set('data',null); @this.set('dataItem',null);"
                                    data-bs-target="#m-add-lang" data-bs-toggle="modal"></button>
                        </li>
                        <li style="display:none;" wire:ignore>
                            <button class="ico_trash" id="trash-btn" type="button"
                                    data-bs-target="#dellModeall" data-bs-toggle="modal"></button>
                        </li>
                        <li>
                            <button class="js-hide-drop ico_close" type="button"></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <table class="js-table_new js-table --setting-lang footable footable-1 footable-paging footable-paging-right breakpoint-lg" >
        <thead>
        <tr class="footable-header">
            <th class="footable-first-visible" style="display: table-cell;">
                <div class="d-flex align-items-center">
                    <label class="check js-check-all">
                        <input class="check__input" type="checkbox" wire:ignore.self
                               onclick="document.checkboxTable.checkAll(event,this)">
                        <span class="check__box"></span>
                    </label>
                    <span>@lang('custom::admin.Available languages')</span>
                </div>

            </th>
            <th class="text-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Activity')</th>
            <th class="text-center" data-breakpoints="xs" style="display: table-cell;">@lang('custom::admin.Default')</th>
            <th class="text-md-start footable-last-visible" data-breakpoints="xs"
                style="display: table-cell;">@lang('custom::admin.Translation files')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($showLanguages as $key=>$item)
            <tr>
                <td class="w-100 footable-first-visible" style="display: table-cell;">
                    <div class="d-flex align-items-center">
                        <label class="check js-check-item">
                            <input class="check__input" wire:ignore.self
                                   onclick="document.checkboxTable.checkItem('{{ $item->id }}', this); @this.checkDataItem({{ $item->id }}, this.checked);"
                                   type="checkbox">
                            <span class="check__box"></span>
                        </label>
                        <a href="javascript:void(0);" onclick="@this.StatrEditLang({{$item->id}})" data-bs-target="#m-add-lang" data-bs-toggle="modal">
                        <span class="nowrap">@lang('custom::admin.'.$item->lang.'_short') ({{ $item['name'] }})</span>
                        </a>
                        <span class="flag @if($item->default == 1)is-active @endif mb-3">
                        </span>
                    </div>
                </td>
                <td class="text-center" data-breakpoints="xs" style="display: table-cell;">
                    <label class="check eye">
                        <input class="check__input" @if($key!=$lang) onclick="changeStatus({{$item['id']}},'status');"
                               @endif type="checkbox" @if(app()->currentLocale()==$item->lang) disabled
                               @endif @if($item->status == 0)  checked="checked" @endif />
                        <span class="check__box"></span>
                    </label>
                </td>
                <td class="text-center" data-breakpoints="xs" style="display: table-cell;">
                    <label class="radio ms-2">
                        <input class="radio__input" onclick="changeStatus({{$item['id']}},'default');" type="radio"
                               name="default" @if($item->default == 1)  checked="checked" @endif />
                        <span class="radio__box"></span>
                    </label>
                </td>
                <td class="text-md-center footable-last-visible" data-breakpoints="xs" style="display: table-cell;">
                    <div class="button-group">
                        <span>@lang('custom::admin.Admin')</span>
                        <button class="button button-accent button-small button-icon ico_download"
                                onclick="@this.downloadFile('{{ $item->lang }}','admin');" type="button">
                            <span>@lang('custom::admin.Downlooad')</span>
                        </button>
                        <button class="button button-accent button-small button-icon ico_upload" type="button"
                                onclick="document.langFileUpload.notifyFileType(event, '{{$item->lang}}', 'admin');">
                            <span>
                        @if(isset($file_data[$item->lang]['admin']) AND is_object($file_data[$item->lang]['admin']))
                                    {{ $file_data[$item->lang]['admin']->getClientOriginalName() }}
                                @else
                                    @lang('custom::admin.Upload')
                                @endif
                            </span>
                        </button>
                    </div>
                    <div class="button-group">
                        <span>@lang('custom::admin.Site')</span>
                        <button class="button button-accent button-small button-icon ico_download" type="button"
                                onclick="@this.downloadFile('{{ $item->lang }}','site')">
                            <span>@lang('custom::admin.Downlooad')</span>
                        </button>
                        <button class="button button-accent button-small button-icon ico_upload" type="button"
                                onclick="document.langFileUpload.notifyFileType(event, '{{$item->lang}}', 'site')">
                            <span>
                        @if(isset($file_data[$item->lang]['site']) AND is_object($file_data[$item->lang]['site']))
                                    {{ $file_data[$item->lang]['site']->getClientOriginalName() }}
                                @else
                                    @lang('custom::admin.Upload')
                                @endif
                            </span>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($file_data)
        @include('livewire.admin.includes.save-data-include',['on_click'=>'sendLangFileSingle("")','title_button'=>__('custom::admin.Save')])
    @endif

    @include('livewire.admin.includes.scripts_data',['wire_click'=>'destroyAllData()','key'=>'all', 'title'=>''])

    <div class="modal fade" id="m-filetype-notify" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom::admin.Translation files')</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>@lang('custom::admin.notify_upload_zip_only')</p>
{{--                        <p wire:loading>@lang('custom::admin.upload_in_process')</p>--}}
                    </div>
                    @foreach ($showLanguages as $key=>$item)

                    <div class="language-upload-action action-{{$item->lang}}-admin w-100" style="display: none">
                        <label class="custom-file-input w-100"
                               onclick="document.langFileUpload.closeNotify()"
                            >
                            <input type="file"
                                   accept=".zip"
                                   wire:model="file_data.{{ $item->lang }}.admin">
                            <button class="button button-accent button-small button-icon ico_upload w-100" type="button">
                                <span data-multiple-caption="{count} files selected" multiple style="max-width:none">
                                <div class="loading-marker" wire:loading wire:target="file_data.{{ $item->lang }}.admin">
                                    <div class="dropify-loader" style="display: block;"></div>
                                </div>
                                @lang('custom::admin.Upload')
                                </span>
                            </button>
                        </label>
                    </div>
                    <div class="language-upload-action action-{{$item->lang}}-site w-100" style="display: none">
                        <label class="custom-file-input w-100"
                               onclick="document.langFileUpload.closeNotify()"
                            >
                            <input type="file"
                                   accept=".zip"
                                   wire:model="file_data.{{ $item->lang }}.site">
                            <button class="button button-accent button-small button-icon ico_upload w-100" type="button">
                                <span data-multiple-caption="{count} files selected" multiple style="max-width:none">
                                <div class="loading-marker" wire:loading wire:target="file_data.{{ $item->lang }}.site">
                                    <div class="dropify-loader" style="display: block;"></div>
                                </div>
                                @lang('custom::admin.Upload')
                                </span>
                            </button>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade m-add-lang" id="m-add-lang" wire:ignore.self>

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom::admin.Adding a language')</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        @if(!isset($data['id']))
                        <div class="drop --arrow" wire:ignore.self>
                            <span onclick="document.newLanguage.clickDrop(event, this);"
                                  class="drop-clear" wire:ignore.self></span>
                            <input id="tags" class="form-control drop-input js-filterable" type="text"
                                   autocomplete="off"
                                   placeholder="@lang('custom::admin.Language selection')"/>
                            <div class="drop-box"
                                 wire:ignore.self>
                                <div class="drop-overflow">
                                    <ul class="drop-list">
                                        @foreach($newLocales as $key => $locale)
                                            <li class="drop-list-item"
                                                onclick="@this.changeDataItem('lang','{{$key}}');
                                                    @this.changeDataItem('name','{{$locale}}');
                                                    $(this).closest('.drop').find('input').val('{{$locale}}')">{{$locale}}</li>
                                        @endforeach
                                        <li class="drop-list-item fallback"
                                            onclick="document.newLanguage.clickFallback(event, this)"
                                            @if($newLocales) style="display:none;" @endif>@lang('custom::admin.No data available')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                    <span class="nowrap">@lang('custom::admin.'.$data['lang'].'_short') ({{ $data['name'] }})</span>
                    @endif
                    </div>
                    <div class="form-group">
                        @include('livewire.admin.includes.image-data-grow',['index'=>'image','title'=>__('custom::admin.Lang ico'),'title_size'=>'svg'])
                        @error('data.image')
                        <div>
                            @lang('custom::admin.Type file')
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="check eye --small">
                            <input class="check__input" type="checkbox"
                                   onclick="@this.changeDataItem('status',{{(isset($data['status']) AND $data['status']==0 )? 1 : 0}})"
                                   @if(isset($data['status']) AND $data['status'] == 0)  checked="checked" @endif />
                            <span class="check__box"></span>
                            <span class="check__txt"
                                  onclick="@this.changeDataItem('status',{{(isset($data['status']) AND $data['status']==0) ? 1 : 0 }})">@lang('custom::admin.Activity')</span>
                        </label>

                    </div>
                    <div class="form-group">
                        <label class="check"
                            {{--                               onclick="@this.changeDataItem('default',{{!isset($data['default']) OR $data['default']==0 ? 1 : 0}})"--}}
                        >
                            <input class="check__input" type="checkbox"
                                   @if(!empty($data['default'])) checked @endif
                                   wire:model='data.default'/>
                            <span class="check__box"></span>
                            <span class="check__txt">@lang('custom::admin.Default')</span>
                        </label></div>
                    @if(isset($data['lang']))
                        <div>
                            <button class="button w-100" type="button" onclick="@this.saveData()"{{--
                                    data-bs-dismiss="modal"--}}>@if(isset($data['id'])){{ __('custom::admin.Update')}}@else{{__('custom::admin.Add')}}@endif</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeStatus(id, type) {

            if (type == 'status') {
            @this.changeStatusLang(id);
            } else {
            @this.changeDefaultLang(id);

            }

        }

        document.langFileUpload = {
            lang: '',
            section: '', // site or admin
            notifyFileType: function (e, lang, section) {
                this.lang = lang;
                this.section = section;
                const $modal = $('#m-filetype-notify');
                $modal.find('.language-upload-action').hide()
                $modal.find(`.language-upload-action.action-${lang}-${section}`).show()
                $('.modal').modal('hide');
                $modal.modal('show');
            },
            closeNotify: function(){
                setTimeout(()=>{$('#m-filetype-notify').modal('hide')},500);
            }
        }

        document.addEventListener('resetModalLanguagesDrop', () => {
            const $drop = $('#m-add-lang').find('.drop');
            $drop.removeClass('_active');
            $drop.find('.drop-box').hide();
            $drop.find('input').val('');
            $drop.find('.drop-clear').removeClass('_active');

            $('#m-add-lang').modal('hide');
        });

        document.addEventListener('clearCheckedState', () => {
            const $table = $('table.--setting-lang');
            $table.find('.js-check-item .check__input').prop('checked', false);
            $table.find('.js-check-all .check__input').prop('checked', false);
            $('#trash-btn').parent().hide();
        });

        document.addEventListener('updateCheckedState', () => {
            document.checkboxTable.correctMain();
        });

        document.checkboxTable = {
            checkItem: function (id, target) {
                changeJsTable();

                this.correctMain();
            //@this.checkDataItem(id, target.checked);
            },
            checkAll: function (e, target) {
                const $table = $(target).closest('table');

                $table.find('td .js-check-item .check__input').prop("checked", target.checked);
                this.showTrashBtn(target.checked);
            @this.checkAllDataItems(target.checked);
            },
            correctMain: function () {
                const $table = $('table.--setting-lang');
                const count = $table.find('.js-check-item .check__input').length;
                const checked = $table.find('.js-check-item .check__input:checked').length;
                $table.find('.js-check-all .check__input').prop('checked', (count === checked));

                this.showTrashBtn(checked);
            },
            showTrashBtn: function (show) {
                if (Boolean(show)) {
                    $('#trash-btn').parent().show();
                } else {
                    $('#trash-btn').parent().hide();
                }
            }
        }

        document.newLanguage = {
            clickFallback: function (e, el) {
                $(el).closest('.drop').find('input').focus();
            },
            clickDrop: function (e, el) {
            @this.changeDataItem('lang');
                const $drop = $(el).closest('.drop');
                $drop.find('input').focus().val('').trigger('input');
                setTimeout(() => {
                    $drop.addClass('_active').show();
                    $drop.find('.drop-box').show();
                }, 100);
                e.preventDefault();
                e.stopPropagation();
            }
        }

    </script>
    <style>
        .custom-file-input:hover .button {
            color: white !important;
        }
    </style>

</div>

