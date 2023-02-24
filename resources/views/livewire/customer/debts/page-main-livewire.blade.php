<div class="lk-page__main">
    <div class="lk-page-header">
        <div class="lk-page-title">@lang('custom::site.receivables')</div>
    </div>
    <div class="lk-table-filter">
        <div class="row">
            <div class="col-xl-3 col-md-5 nice-select-group">
                @include('livewire.includes.dropdown-front-filterable', [
                    'name' => 'filterableContracts',
                    'model' => $filterableContracts,
                    'placeholder' => __('custom::site.choice_contract'),
                ])
            </div>
        </div>
        @if($this->isContractSelected())
        <div class="row">
            <div class="col-12">
                <ul class="receivables-list">
                    <li><span>@lang('custom::site.credit_limit')</span>
                        <strong class="text-lowercase">{{formatMoney($debt->limit_sum)}} @lang('custom::site.uah')</strong></li>
                    <li><span>@lang('custom::site.postponement_days')</span>
                        <strong>{{$debt->limit_days}}</strong></li>
                    <li><span>@lang('custom::site.total_receivables')</span>
                        <strong class="text-lowercase">{{formatMoney($debt->debt_sum)}} @lang('custom::site.uah')</strong></li>
                    <li><span>@lang('custom::site.overdue')</span>
                        <strong class="accent">{{$debt->overdue_days}}</strong></li>
{{--                    <li><span>@lang('custom::site.in_reserve')</span>--}}
{{--                        <strong class="text-lowercase">{{formatMoney($debt->sum_total)}} @lang('custom::site.uah')</strong></li>--}}
                    <li><span>@lang('custom::site.expected')</span>
                        <strong class="text-lowercase">{{formatMoney($debt->overdue_sum)}} @lang('custom::site.uah')</strong></li>
                </ul>
                <button class="button button-secondary"
                        wire:click="uploadReconciliationActs"
                        type="button">@lang('custom::site.reconciliation_act')</button>
            </div>
        </div>
        @endif
    </div>
    @if(!$this->isContractSelected())
        <div class="hide-message">
            <p>@lang('custom::site.select_contract_to_show_debts')</p>
        </div>
    @endif
    <div class="lk-table" style="@if(!$this->isContractSelected()) display:none; @endif">
    <div class="lk-table" style="@if(!$this->isContractSelected() && false) display:none; @endif">
        <div class="lk-table-body">
            <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
            <table wire:ignore id="footable-holder"
                   data-empty="@lang('custom::site.data_is_absent')"
                   data-show-toggle="true" data-toggle-column="last">
            </table>
        </div>

        <div class="lk-table-footer">
            <div>
                <button class="button button-secondary"
                        wire:click="unloadBalance"
                        type="button">@lang('custom::site.unload_balance')</button>
            </div>
            @include('livewire.includes.per-page-table', ['data_paginate' => $orders])
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });

            // document.receivables = {
            //     onPayOrder: function(orderId){
            //         @this.onPayOrder(orderId);
            //     }
            // }
        })
        //# sourceURL=customer.receivables.page-main.js
    </script>
@endpush
