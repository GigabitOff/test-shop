<div class="lk-table-header">
    <div class="submenu">
        <div class="submenu__title">@lang('custom::site.show'):</div>
        <div class="submenu__btn">
            <button type="button">
                <span class="submenu__current">
                    @if($this->isFilterOrders())
                        @lang('custom::site.orders')
                    @elseif($this->isFilterComplaints())
                        @lang('custom::site.complaint_acts')
                    @elseif($this->isFilterReverses())
                        @lang('custom::site.invoices_reverse')
                    @elseif($this->isFilterReconciliations())
                        @lang('custom::site.reconciliation_acts')
                    @endif
                </span>
                <span class="ico_angel-b"></span>
            </button>
        </div>
        <div class="submenu__drop">
            <div class="submenu__box">
                <ul class="lk-submenu">
                    <li class="lk-submenu__item @if($this->isFilterOrders()) active @endif">
                        <a class="lk-submenu__link"
                           onclick="@this.set('filter', {{$this::FILTER_ORDERS}})"
                           href="javascript:void(0);">@lang('custom::site.orders')</a>
                    </li>
                    <li class="lk-submenu__item @if($this->isFilterComplaints())) active @endif">
                        <a class="lk-submenu__link"
                           onclick="@this.set('filter', {{$this::FILTER_COMPLAINTS}})"
                           href="javascript:void(0);">@lang('custom::site.complaint_acts')</a>
                    </li>
                    <li class="lk-submenu__item @if($this->isFilterReverses()) active @endif">
                        <a class="lk-submenu__link"
                           onclick="@this.set('filter', {{$this::FILTER_REVERSES}})"
                           href="javascript:void(0);">@lang('custom::site.return_invoices')</a>
                    </li>
                    <li class="lk-submenu__item @if($this->isFilterReconciliations('')) active @endif">
                        <a class="lk-submenu__link"
                           onclick="@this.set('filter', {{$this::FILTER_RECONCILIATION}})"
                           href="javascript:void(0);">@lang('custom::site.reconciliation_acts')</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
