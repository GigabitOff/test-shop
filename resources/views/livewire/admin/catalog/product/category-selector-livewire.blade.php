<div>
    <div id="footable-content-categories"
         class="footable-content d-none {{$this->getFooClasses()}}">
        @include('livewire.admin.catalog.product.includes.categories-footable-render',['setCheckedMainCat'=>$setCheckedMainCat])
    </div>

    <table wire:ignore id="footable-holder-categories"
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

    <div class="form-group">
        <div class="input-group --medium">
            <div class="input-group-text">
                <span>@lang('custom::admin.category_root')</span>
            </div>
            @include('livewire.admin.includes.drop-filterable', [
                'id' => 'filterable-cat-root',
                'type' => 'arrow',
                'model' => 'filterableCat0',
                'placeholder' => __('custom::admin.category_root'),
            ])
        </div>
    </div>

    @foreach($catsLine as $parent => $prop)
        @continue($loop->iteration !== 2)
        <div class="form-group">
            <div class="input-group --medium">
                <div class="input-group-text">
                    <span>@lang('custom::admin.Subcategory')</span>
                </div>
                @include('livewire.admin.includes.drop-filterable', [
                    'id' => "filterable-cat-of-{$parent}",
                    'type' => 'arrow',
                    'model' => 'filterableCat1',
                    'placeholder' => __('custom::admin.Subcategory'),
                ])

            </div>
        </div>
    @endforeach
    @if(count($catsLine) > 2)
        <div class="form-group">
            <div class="input-group input-group--4">
                <div class="input-group-text"><span>@lang('custom::admin.Subcategory')</span></div>
                @foreach($catsLine as $parent => $prop)
                    @continue($loop->iteration <= 2)
                    @include('livewire.admin.includes.drop-filterable', [
                        'id' => "filterable-cat-of-{$parent}",
                        'type' => 'arrow',
                        'model' => $prop,
                        'placeholder' => __('custom::admin.Subcategory'),
                    ])
                @endforeach
            </div>
        </div>
    @endif
    <div class="page-save --specifications">
        <div></div>
        @if($selectedCat)
            <button class="button"
                    wire:click="addSelectedCat"
                    type="button" >
                @lang('custom::admin.category_add')
            </button>
        @endif
    </div>

</div>

@push('custom-scripts')
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            $(document).on('click', '.icon-status.ico_checkmark', function () {
              //  $(this).closest('tbody').find('.icon-status.ico_checkmark').removeClass('is-active');
               // $(this).addClass('is-active');
            });
        })


    </script>
@endpush
