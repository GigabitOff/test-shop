@php
    $item_p = null;
    $key_p = null;
@endphp
@if(isset($parentData) AND count($parentData)>0)

@foreach ($parentData as $key_p=>$item_p)
<tr>
    <td style="display: table-cell;" class="footable-first-visible">
        <div class="d-flex align-items-center"><label class="check">
            <input class="check__input" type="checkbox"  wire:model="check_dell.{{ $item_p->id }}" value="{{ $item_p->id }}" />
            <span class="check__box"></span></label>
            <a class="flag ms-2" href="{{ route('admin.'. $nameLive .'.edit', [$item_p->id]) }}">{{ isset($item_p->name) ? $item_p->name: '' }}</a></div>
    </td >
    <td style="display: table-cell;"><span>{{  $item_p->selfCategory->name }}</span></td>
    <td style="display: table-cell;" class="text-md-center">
        <input class="form-control form-xs" type="number" placeholder="1" value="{{ $item_p->sort_order }}" onchange="changeOrderCustom({{$item_p->id}},this.value, {{$item_p->parent_id}}, this)"></td>
    <td  class="text-md-center" style="display: table-cell;"  wire:ignore>
        <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item_p->id}},'status')" @if($item_p->status == 0) checked="checked" @endif/>
            <span class="check__box"></span>
        </label>
    </td>
    <td style="display: table-cell;" class="text-center w-1 footable-last-visible">
        @include('livewire.admin.catalog.category.includes.actions-index',['item_action'=>$item_p])
    </td>
</tr>
@php
    $key_p2 = null;
    $item_p2 = null;
@endphp
@if($item_p->parentData)
@foreach ($item_p->parentData as $key_p2=>$item_p2)
<tr>
    <td style="display: table-cell;"  class="footable-first-visible">
        <div class="d-flex align-items-center">
            <label class="check">
                <input class="check__input" type="checkbox"  wire:model="check_dell.{{ $item_p2->id }}" value="{{ $item_p2->id }}" />
                <span class="check__box"></span>
            </label>
            <a class="flag ms-2" href="{{ route('admin.'. $nameLive .'.edit', [$item_p2->id]) }}">{{ isset($item_p2->name) ? $item_p2->name: '' }}</a></div>
    </td>
    <td style="display: table-cell;"><span>{{  $item_p2->selfCategory->name }}</span></td>
    <td style="display: table-cell;" class="text-md-center">
        <input class="form-control form-xs" type="number"  wire:ignore placeholder="1" value="{{ $item_p2->sort_order }}" onchange="changeOrderCustom({{$item_p2->id}},this.value, {{$item_p2->parent_id}}, this)"></td>
    <td  class="text-md-center" style="display: table-cell;">
        <label class="check eye"><input class="check__input" type="checkbox"  onclick="@this.changeStatusData({{$item_p2->id}},'status')" @if($item_p2->status == 0) checked="checked" @endif/>
            <span class="check__box"></span>
        </label>
    </td>
    <td style="display: table-cell;" class="text-center w-1 footable-last-visible">
        @include('livewire.admin.catalog.category.includes.actions-index',['item_action'=>$item_p2])
    </td>
</tr>

@endforeach
@endif

@endforeach
@endif
