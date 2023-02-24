<div class="lk-table">
    <div class="lk-table-header">
        <a class="button button-primary" href="javascript:void(0);"
           data-target="#modal-new-customer-message"
           data-toggle="modal">@lang('custom::site.new_message')</a></div>
    <div class="lk-table-body">
        <div id="footable-content" class="footable-content" style="display: none" data-table="{{ $table }}"></div>
        <table wire:ignore id="footable-holder"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>
    </div>
    <div class="lk-table-footer">
        <div></div>
        @include('livewire.includes.per-page-table', ['data_paginate' => $chats])
    </div>
</div>

@push('show-data')
    <x-modal-form id="modal-new-customer-message">
        <livewire:forms.manager.chat-new-message-livewire/>
    </x-modal-form>
@endpush

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content', '#footable-holder');
            window.addEventListener('updateFooData', () => {
                document.FooTableEx.redraw('#footable-content');
            });
        })
        //# sourceURL=chats.index-table-section.js
    </script>
@endpush
