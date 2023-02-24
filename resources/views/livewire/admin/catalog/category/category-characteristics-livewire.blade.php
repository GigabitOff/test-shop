<div>
    <div class="row g-4">
        <div class="col-xl-4 col-md-6">
            <x-livewire.admin.input-drop
                model="searchName"
                :placeholder="__('custom::admin.Search')"
            />
        </div>
    </div>

    <div id="footable-content-characteristics"
         class="footable-content d-none {{$this->getFooClasses()}}">
        @include('livewire.admin.catalog.category.includes.characteristics-footable-render')
    </div>

    {{--    // Блок кнопок должен быть непосредственно перед таблицей--}}
    <div class="table-before-btn --small">
        <div>
            <div class="action-group">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                    <ul class="action-group-list">
                        <li>
                            <button class="ico_plus"
                                    data-bs-target="#m-add-characteristic"
                                    data-bs-toggle="modal"></button>
                        </li>
                        @if(!empty($selectedData))
                            <li>
                                <button class="button button-small button-icon ico_trash mt-3"
                                        onclick="document.categoryChars.confirmDelete()"
                                        type="button"></button>
                            </li>
                        @endif
                        <li>
                            <button class="js-hide-drop ico_close" onclick="close_ico_close();" type="button"></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="table-before-btn --small">
        @if(!empty($selectedData))
            <button class="button button-small button-icon ico_trash mt-3"
                    onclick="document.categoryChars.confirmDelete()"
                    {{--                    wire:click="confirmDelete"--}}
                    type="button"></button>
        @endif
    </div>

    <table wire:ignore id="footable-holder-characteristics"
           data-empty="@lang('custom::admin.No data available')"
           data-show-toggle="true" data-toggle-column="last">
    </table>

    <div class="page-bottom-group">
        <div></div>
        <div class="page-nav-box">
            <x-admin.page-selector
                :paginator="$data_paginate"
                :list="[10,20,30,40]"
            />

            {{ $data_paginate->links($this->paginationView())}}

        </div>
    </div>

    <div class="modal fade" id="m-add-characteristic" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('custom::admin.characteristic_add')</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <x-livewire.admin.drop-search
                            type="arrow"
                            model="filterableAdd"
                            :list="$filterableAddList"
                            :placeholder="__('custom::admin.Search')"
                        />
                    </div>
                    <div class="mt-4 @if(empty($filterableAddId)) d-none @endif">
                        <button class="button w-100" type="button"
                                wire:click="addCharacteristic"
                                onclick="$(this).closest('.modal').find('input').val('').trigger('input')"
                                data-bs-dismiss="modal" >@lang('custom::admin.Add')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

@push('custom-scripts')
    <script>
        document.categoryChars = {
            confirmDelete: function () {
                Livewire.emit('eventShowDialogMessage', {
                    'title': '@lang('custom::admin.characteristic_removing')',
                    'message': '@lang('custom::admin.do_delete_selected')' + ' ' +
                        '@lang('custom::admin.characteristics')' + ' ?',
                    'buttons': [
                        {
                            'text': '@lang('custom::admin.Confirm')',
                            'type': 'primary',
                            'actions': [
                                {
                                    'type': 'sendEvent',
                                    'target': 'eventDeleteSelected'
                                }
                            ]
                        },
                        {
                            'text': '@lang('custom::admin.Cansel')',
                            'type': 'secondary'
                        }
                    ]
                })
            }
        }
    </script>
@endpush
