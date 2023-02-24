<div>
    <div id="footable-content-chars-products"
         class="footable-content d-none {{$this->getFooClasses()}}">
        @include('livewire.admin.characteristics.includes.products-footable-render')
    </div>

    <table wire:ignore id="footable-holder-chars-products"
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

</div>
