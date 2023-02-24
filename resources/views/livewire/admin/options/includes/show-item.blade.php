@if($data_paginate)

<table  class="js-table js-table_new"  data-paging-size="{{ session()->has('perPage') ? session('perPage') : 10}} ">
    <thead>
        <tr>
            <th>@lang('custom::admin.Option name')</th>
            <th class="text-end w-1">
            <div class="action-group">
                <div class="action-group-btn button-accent"><span class="ico_submenu"></span></div>
                    <div class="action-group-drop">
                      <ul class="action-group-list">
                        <li><a href="{{ route('admin.options.create')}}" class="ico_plus"></a></li>
                        <li><button class="ico_trash" type="button"></button></li>
                        <li><button class="js-hide-drop ico_close" type="button"></button></li>
                      </ul>
                    </div>
                  </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_paginate as $key=>$item)
        <tr>
            <td>
                <div class="d-flex align-items-center"><label class="check"><input class="check__input" type="checkbox" /><span class="check__box"></span></label>
                    <a href="{{ route('admin.options.edit', $item->id)}}">{{ $item->name }}</a>
                </div>
            </td>
            <td class="text-center w-1">
                  <div class="button-group"><a href="{{ route('admin.options.edit', $item->id)}}" class="button button-small button-icon ico_edit"></a><button class="button button-small button-icon ico_trash" type="button" wire:click="destroyData('{{ $item->id }}')"></button></div>
                </td>

              </tr>
                @endforeach

            </tbody>
          </table>
        @include('livewire.admin.includes.per-page-table')

    @endif
