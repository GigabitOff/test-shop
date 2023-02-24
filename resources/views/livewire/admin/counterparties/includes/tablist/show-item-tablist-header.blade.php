<div class="row g-4">
            <div class="col-xl-3 col-md-6 ">
                <div class="drop">
                    <spacn class="drop-clear @if(isset($search_name) AND $search_name != '') _active @endif" onclick="@this.set('search_name',null)"></spacn>
              <input class="form-control drop-input" type="text" wire:model="search_name" placeholder="@lang('custom::admin.Name company')">
                </div>

            </div>
            <div class="col-xl-3 col-md-6">
              <div class="drop">
                    <spacn class="drop-clear @if(isset($search_fio) AND $search_fio != '') _active @endif" onclick="@this.set('search_fio',null)"></spacn>
              <input class="form-control drop-input" type="text" wire:model="search_fio" placeholder="@lang('custom::admin.clients.FIO')">
            </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="drop">
                    <spacn class="drop-clear @if(isset($search_phone) AND $search_phone != '') _active @endif" onclick="@this.set('search_phone',null)"></spacn>
              <input class="form-control drop-input" wire:model="search_phone" type="text" placeholder="@lang('custom::admin.clients.Phone')">
            </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="drop">
                    <spacn class="drop-clear @if(isset($search_okpo) AND $search_okpo != '') _active @endif" onclick="@this.set('search_okpo',null)"></spacn>
              <input class="form-control drop-input" wire:model="search_okpo" type="text" placeholder="@lang('custom::admin.clients.EDRPOU')">
            </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="drop --arrow" @if(isset($search_form))_selected @endif" wire:ignore.self>
                <span class="drop-clear @if(isset($search_form)) _active @endif" onclick="@this.set('search_form',{{ null }})" ></span>
                <input wire:model.debounce.60ms="search_form" class="form-control drop-input" @if(isset($search_form) AND $search_form != "") value="{{$search_form}}" @endif type="text" autocomplete="off" placeholder="@lang('custom::admin.Type company')">
                <div class="drop-box" @if(!isset($search_form) OR $search_form !='' AND $counterparty_forms[0] == $search_form) style="display: none;" @else style="display: block;" @endif>
                  <div class="drop-overflow">
                    <ul class="drop-list">
                      @foreach ($counterparty_forms as $item_form)
                          <li class="drop-list-item" onclick="@this.set('search_form','{{ $item_form }}')">{{ $item_form }}</li>
                        @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
