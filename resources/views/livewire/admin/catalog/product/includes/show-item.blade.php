<div>

    <div class="table-before-btn --catalog-table">
        <div>
            <div class="action-group" style="margin-right: -14px; margin-top: -12%">
                <div class="action-group-btn"><span class="ico_submenu"></span></div>
                <div class="action-group-drop">
                    <ul class="action-group-list">
                        <li><a class="ico_plus" href="{{ route('admin.product.create') }}"></a></li>
                        @if(isset($selectedData) AND count($selectedData)>0)
                            <li>
                                <button class="ico_eye-slash" type="button"
                                        onclick="@this.changeStatusDataMany()"></button>
                            </li>
                            <li>
                                <button class="ico_trash" type="button" data-bs-target="#dellModeAll"
                                        data-bs-toggle="modal"></button>
                            </li>
                        @endif
                        <li>
                            <button class="js-hide-drop ico_close" onclick="close_ico_close();" type="button"></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="footable-content"
         class="footable-content @if($this->isNeedFootableRevalidate()) footable-revalidate @endif"
         style="display: none">
        @include('livewire.admin.catalog.product.includes.show-item-footable-render')
    </div>
    <table wire:ignore id="footable-holder"
           data-empty="@lang('custom::admin.No data available')"
           data-show-toggle="true" data-toggle-column="last">


    </table>

 @include('livewire.admin.includes.per-page-table')


    @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

</div>

@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            //document.FooTableEx.init('#footable-content', '#footable-holder');

            // window.addEventListener('updateFooExData', () => {
            //     document.FooTableEx.redraw('#footable-content');
            //     updateFooExItems();
            // });

            // window.addEventListener('updateFooExItems', () => {
            //     updateFooExItems();
            // });
            //
            // function updateFooExItems() {
            //     const table = $('#footable-content').html();
            //     $(table).find('input[type=checkbox]')
            //         .each((i, el) => {
            //             const id = $(el).attr('id');
            //             const checked = $(el).prop('checked');
            //
            //             $(`#footable-holder #${id}`).prop('checked', checked);
            //         })
            // }

            function close_ico_close() {
                $('.able-before-btn').closest('.action-group').toggleClass('is-show');
            }

            document.pageHandlers = {
                selectDataItem: (id, all = false) => {
                @this.selectDataItem(id, all);
                },
                changeStatusData: (id, type) => {
                @this.changeStatusData(id, type);
                }
            }
        })

        //# sourceURL=catalog_product.js
    </script>
@endpush

