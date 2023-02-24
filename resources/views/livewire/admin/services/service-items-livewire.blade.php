<div>
    <div id="footable-content"
         class="footable-content d-none {{$this->getFooClasses()}}">
        @include('livewire.admin.services.includes.items-footable-render')
    </div>

{{--    // Блок кнопок должен быть непосредственно перед таблицей--}}
    <div class="table-before-btn --small">
        <div>
            <div class="action-group">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                    <ul class="action-group-list">
                        <li>
                            <a class="ico_plus" href="{{ route('admin.services.create') }}"></a>
                        </li>
                        @if(isset($selectedData) AND count($selectedData)>0)
                            <li>
                                <button class="ico_eye-slash" type="button"
                                        onclick="@this.changeStatusDataMany()"></button>
                            </li>
                            <li>
                                <button class="ico_trash" type="button" data-bs-target="#dellModeAll"
                                        data-bs-toggle="modal"></button>
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

    <table wire:ignore id="footable-holder"
           data-empty="@lang('custom::admin.No data available')"
           data-show-toggle="true" data-toggle-column="last">
    </table>

    <div class="page-save">
        <div></div>
        <div class="page-nav-box">
            <x-admin.page-selector
                :paginator="$data_paginate"
                :list="[10,20,30,40]"
            />

            {{ $data_paginate->links($this->paginationView())}}

        </div>
    </div>
    @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])
</div>
