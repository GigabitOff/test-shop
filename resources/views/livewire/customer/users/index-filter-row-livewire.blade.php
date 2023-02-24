<div class="lk-page__filters">
    <div><span class="custome-dropdown-clear icon-close @if($fio_id) is-active @endif"
               wire:click="clearFilteredFio"></span>
        <input class="form-control" type="text"
               placeholder="@lang('custom::site.fio')"
               wire:model.debounce.700ms="fio"
               onfocusout="document.customeDropdown.hideDropdown(this)"
               name="fio"
               autocomplete="off"><span></span>
        @if(!empty($fio_list))
            <div class="custome-dropdown-box"
                 style="display:@if('fio' === $mode)block @else none @endif ;">
                <div class="custome-dropdown-overflow">
                    <ul>
                        @foreach($fio_list as $id => $item)
                            <li wire:click="setFilteredFio({ id:{{$id}},value:'{{$item['name']}}' })"
                                title="{{$item['name']}}">{{$item['name']}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div><input class="form-control" type="text" placeholder="Назва компанії"></div>
    <div>
        <div class="drop --arrow">
            <spav class="drop-clear"></spav><input class="form-control drop-input" type="text" autocomplete="off" placeholder="Роль" />
            <div class="drop-box">
                <div class="drop-overflow">
                    <ul class="drop-list">
                        <li class="drop-list-item">Роль 1</li>
                        <li class="drop-list-item">Роль 2</li>
                        <li class="drop-list-item">Роль 3</li>
                        <li class="drop-list-item">Роль 4</li>
                        <li class="drop-list-item">Роль 5</li>
                        <li class="drop-list-item">Роль 6</li>
                        <li class="drop-list-item">Роль 7</li>
                        <li class="drop-list-item">Роль 8</li>
                        <li class="drop-list-item">Роль 9</li>
                        <li class="drop-list-item">Роль 10</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="form-control-group">
        <input id="data_date_start" class="form-control" type="text" placeholder="@lang('custom::site.from')" value="{{ $date_start}}" autocomplete="off">
        @include('livewire.includes.calendar-form',['formId'=>'data_date_start','models'=>['start'=>'date_start'], 'single'=>true])
        <span>/</span>
        <input id="data_date_end" class="form-control" type="text" placeholder="@lang('custom::site.to')" value="{{ $date_end}}" autocomplete="off">
        @include('livewire.includes.calendar-form',['formId'=>'data_date_end','models'=>['start'=>'date_end'],'single'=>true])
    </div>
</div>

@push('custom-scripts')
    <script>
        $('.lk-user-table-filter select[name="position"]')
            .on('change', function (e) {
            @this.set('position_id', e.target.value)
            });

        $('.lk-user-table-filter select[name="contract"]')
            .on('change', function (e) {
            @this.set('contract_id', e.target.value)
            });

        //# sourceURL=customer-users-filter-row_main.js
    </script>
@endpush
