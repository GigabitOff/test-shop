<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">@lang('custom::site.result_of_bulk_uploading')<span>@lang('custom::site.on_project_domain')</span></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span class="ico_close"></span>
        </button>
    </div>
    <div class="modal-body">
{{--        <p>В замовленні виявлені помилки</p>--}}
        <div id="footable-content-bulk" class="footable-content-bulk" style="display: none" data-table="{{ $table }}"></div>
        <table wire:ignore id="footable-holder-bulk"
               class="js-table footable footable-3 breakpoint-lg"
               data-empty="@lang('custom::site.data_is_absent')"
               data-show-toggle="true" data-toggle-column="last">
        </table>

{{--        <table class="js-table footable footable-3 breakpoint-lg" data-paging="false" data-show-toggle="true"--}}
{{--               data-toggle-column="last" style="">--}}
{{--            <thead>--}}
{{--            <tr class="footable-header">--}}


{{--                <th class="text-center footable-first-visible" style="display: table-cell;">№</th>--}}
{{--                <th class="text-center" style="display: table-cell;">@lang('custom::site.article')</th>--}}
{{--                <th style="display: table-cell;">@lang('custom::site.status')</th>--}}
{{--                <th data-breakpoints="xs" style="display: table-cell;">@lang('custom::site.product_name')</th>--}}
{{--                <th data-breakpoints="xs" class="footable-last-visible" style="display: table-cell;">@lang('custom::site.quantity')</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}

{{--            @foreach($list as $item)--}}
{{--            <tr @if($item['notFounded']) class="no-result" @elseif($item['outOfStock']) class="deleted" @endif>--}}
{{--                <td class="text-center footable-first-visible" style="display: table-cell;">{{$loop->iteration}}</td>--}}
{{--                <td class="text-center" style="display: table-cell;">№ {{$item['sku']}}</td>--}}
{{--                <td style="display: table-cell;">{{$item['status']}}</td>--}}
{{--                <td style="display: table-cell;">{{$item['name']}}</td>--}}
{{--                <td class="footable-last-visible" style="display: table-cell;">{{$item['qty']}}</td>--}}
{{--            </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
        <div class="row mt-4">
            <div class="col-sm-6 mb-2">
                <button class="button button-secondary button-block button-lg"
                        wire:click="dataCorrect"
                        type="button">
                    @lang('custom::site.set_right')
                </button>
            </div>
            <div class="col-sm-6 mb-2">
                <button class="button button-secondary button-block button-lg"
                        wire:click="addProductsToCart"
                        type="button">
                    @lang('custom::site.do_continue')
                </button>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        jQuery(document).ready(function ($) {
            document.FooTableEx.init('#footable-content-bulk', '#footable-holder-bulk');
            window.addEventListener('updateBulkFooData', () => {
                document.FooTableEx.redraw('#footable-content-bulk');
            });
        })

        document.addEventListener('bulkUploaderViewerShow', function () {
            $('#modal-bulk-upload-products').modal('hide')
            $('#modal-result-upload-file').modal('show')
        })
    </script>
@endpush
