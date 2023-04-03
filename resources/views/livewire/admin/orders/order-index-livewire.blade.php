<div >
    {{-- orders livewire -- Бренди управління admin.orders.create--}}
    @include('livewire.admin.includes.head_button',['type'=>'return', 'route'=>'admin.pages.index','title_lang'=>__('custom::admin.Return to list page')])
    <h4>@if(isset($data[session('lang')]['title'])){{$data[session('lang')]['title']}}@else{{ __('custom::admin.Orders')}}@endif</h4>
    <div wire:ignore>
@livewire('admin.partials.header-livewire', key(time().'header-livewire'))
</div>
    <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link @if(isset($collapse_show)  AND $collapse_show==='all-info')active @endif" type="button" role="tab"  onclick="@this.selectTab('all-info')">
            <span @if($error_data_title) style=" color: red;" @endif>
            @lang('custom::admin.General information')
            </span>
        </button>
    </li>

    </ul>
    <div class="product-info tab-content mt-4">
        <div class="tab-pane fade @if(isset($collapse_show) AND $collapse_show==='all-info')show active @endif" id="all-info" role="tabpanel">
        <div class="container-large">
            @include('livewire.admin.orders.includes.tablist.general-tab')
        </div>
        </div>

    </div>

    {{-- <div class="container">
        @include('livewire.admin.includes.search')
    </div>--}}

</div>
