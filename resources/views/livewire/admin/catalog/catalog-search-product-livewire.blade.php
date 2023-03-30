<div>

    <div class="search search_{{ $table_name}}  @if($result_search)is-active @endif">
        <div class="search__body">
            {{-- Action Search Product Livewire. --}}
            {{-- <div class="search__label"><span class="ico_plus"></span></div>--}}
            <div class="search__controls w-100 search__controls_{{ $table_name}}">
                <input type="text" placeholder="@lang('custom::admin.Enter the name or article number of the product')"
                       wire:model.debounce.700ms="search">
                {{--@if($select_products AND count($select_products)>0 AND $result_search AND count($result_search)>0)
                <div class="search__result search__result_{{ $table_name}}">
                <ul class="result-list">
                    @foreach ($select_products as $key_pr=>$item_pr)
                    <li>
                        <div class="result-item">
                            <div class="result-item__title">{{ $item_pr['id_1c'] }}</div>
                            <div class="result-item__del"><span class="ico_close" onclick="@this.removeProductFromTable({{$key_pr}})"></span></div>
                              </div>
                    </li>
                    @endforeach
                </ul>
                <div class="result-clear is-show">@lang('custom::admin.Cancel all')</div>
                </div>
                @endif--}}
            </div>
            <div class="search__drop search__drop_{{ $table_name}} @if($search != '')is-show @endif"
                 @if($search == '') style="display: none;"
                 @endif @if(!$search__drop_show AND isset($selected_products) AND count($selected_products)<5) style="display: none;" @endif>
                <div class="search__result">
                    <div class="search__result-box">
                        <div class="tagger">
                            <input class="js-tags" type="hidden" placeholder="Артикул товара" hidden="hidden"
                                   value="sfdsf">
                            <ul>

                                @if($select_products AND count($select_products)>0 AND $result_search AND count($result_search)>0)
                                    @foreach ($select_products as $key_pr=>$item_pr)
                                        <li>
                                            <a href="/tag/{{ $item_pr['articul'] }}" class="--yellow" target="_black">
                                                <span
                                                    class="label">{{ $item_pr['articul'] != "" ? $item_pr['articul'] : 'no articul' }}</span>
                                                <span href="#!" class="close --yellow"
                                                      onclick="@this.removeDataProducts({{ $key_pr }})">×</span>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif

                                @if(isset($select_products_no_articul) AND count($select_products_no_articul)>0)
                                    @foreach ($select_products_no_articul as $key_no_art=>$item_no_art)

                                        <li><a href="/tag/{{ $key_no_art }}" target="_black">
                                                <span class="label">{{ $key_no_art }}</span>
                                                <span href="#!" class="close"
                                                      onclick="@this.removeDataProducts('{{ $key_no_art }}');">×</span>
                                            </a></li>
                                    @endforeach
                                @endif

                                <li class="tagger-new">
                                    <input class="js-tags-next" onkeypress="return addNewProducts(event,this.value)"
                                           placeholder="@lang('custom::admin.products.Product artikul')"
                                           list="tagger-completion-1">
                                    <div class="tagger-completion"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="search__result-btns">
                        <div class="result-clear"
                             onclick="@this.setDataProductsToDb('true'); clearNewProducts();">@lang('custom::admin.Cansel')</div>
                        @if($select_products AND count($select_products)>0 AND $result_search AND count($result_search)>0)
                            <div class="result-select"
                                 onclick="@this.setDataProductsToDb();">@lang('custom::admin.Select')</div>
                        @endif
                    </div>
                </div>

                <div class="search__items">
                    @if($result_search AND count($result_search)>0)
                        <table class="js-table js-table_new  footable footable-1 footable-paging footable-paging-right">
                            <thead class="d-none">
                            <tr class="footable-header">
                                <td class="footable-first-visible"
                                    style="display: table-cell;">@lang('custom::admin.products.Product name')</td>
                                <td data-breakpoints="xs"
                                    style="display: table-cell;">@lang('custom::admin.products.Brand')</td>
                                <td data-breakpoints="xs"
                                    style="display: table-cell;">@lang('custom::admin.Status')</td>
                                <td data-breakpoints="xs"
                                    style="display: table-cell;">@lang('custom::admin.products.Articul')</td>
                                <td data-breakpoints="xs"
                                    style="display: table-cell;">@lang('custom::admin.products.Price')</td>
                                <td data-breakpoints="xs" class="footable-last-visible"
                                    style="display: table-cell;"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($result_search as $key=>$item)
                                @if(!isset($result_search[$item->id]))

                                    <tr>
                                        <td style="display: table-cell;">
                                            <span>{{ (!is_array($item) AND $item->translate(session('lang'))) ? $item->translate(session('lang'))->name : (is_array($item) ? $item['name'] : config('app.fallback_locale')) }}</span>
                                        </td>
                                        <td style="display: table-cell;"><span
                                                class="title">@lang('custom::admin.products.Brand')</span><span>{{ $item->brand ? $item->brand->title : config('app.fallback_locale') }}</span>
                                        </td>
                                        <td style="display: table-cell;">
                                            <button class="button-status status-1">
                                                <span
                                                    class="circle"></span><span>{{  __('custom::admin.availability.'.$item->availability) }}</span>
                                            </button>
                                        </td>
                                        <td style="display: table-cell;"><span
                                                class="title">@lang('custom::admin.products.Articul')</span><a
                                                class="accent" href="#!">№ {{$item->articul}}</a></td>
                                        <td style="display: table-cell;">
                                            <strong>{{ $item->getPriceAttribute()}} @lang('custom::admin.products.UAH')</strong>
                                        </td>
                                        <td style="display: table-cell;">
                                            <button
                                                class="button button-accent button-small button-icon ico_plus @if(isset($selected_products[$item->id]) OR isset($selected_products[$item->id]) OR isset($select_products[$item->id])) is-active @endif"
                                                wire:click="addProductToProductTmp({{$item->id}})"></button>
                                        </td>
                                    </tr>

                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    @elseif($search AND $search != '')
                        @lang('custom::admin.No results found for your search results')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="search__overlay search__overlay_{{ $table_name}} @if($search AND $search != '')is-show @endif"></div>

    @if($selected_products AND count($selected_products)>0)

        <div wire:ignore.self>
            <div class="table-before-btn --catalog-table">
                <div>
                    <div class="action-group" style="margin-right: 22px; margin-top: -22%">
                        <div class="button-group flex-row">
                            @if(isset($selectedData) AND count($selectedData)>0)
                                <button class="button button-small button-icon ico_trash" type="button"
                                        onclick="@this.dellAllData()" {{-- data-bs-target="#dellModeAll" data-bs-toggle="modal"--}}></button>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <table class="js-table js-table_new  footable footable-1"
                   data-paging-size="6">
                <thead>
                <tr>
                    <th style="display: table-cell;">
                        <div class="d-flex align-items-center">
                            <label class="check js-select-all">
                                <input class="check__input" type="checkbox" @if(isset($selectedData['all'])) checked
                                       @endif onclick="@this.selectDataItem('all',true)"/><span
                                    class="check__box"></span>
                            </label>
                            <span>@lang('custom::admin.products.Articul')</span>
                        </div>

                    </th>
                    <th style="display: table-cell;">@lang('custom::admin.products.Name')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Code')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Addet')</th>
                    <th style="display: table-cell;" class="text-center">@lang('custom::admin.products.Addet user')</th>
                    <th class="text-end w-1" style="display: table-cell;" data-breakpoints="xs"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($selected_products_paginated as $item)
                    <tr>
                        <td style="display: table-cell;">
                            <div class="d-flex align-items-center">
                                <label class="check">
                                    <input class="check__input" type="checkbox"
                                           @if(isset($selectedData[$item['id']])) checked
                                           @endif onclick="@this.selectDataItem({{$item['id']}})"/>
                                    <span class="check__box"></span>
                                </label>
                                <span class="ms-2">
                                    <a class="accent"
                                       href="{{route('admin.product.edit', $item->id)}}">№ {{ $item['articul'] ?? '' }}</a>
                                </span>
                            </div>

                        </td>
                        <td style="display: table-cell;"><a
                                href="#!">{{ (!is_array($item) AND $item->translate(session('lang'))) ? $item->translate(session('lang'))->name : (isset($item['name']) ? $item['name']: '') }}</a>
                        </td>
                        <td style="display: table-cell;" class="text-center">
                            <span>{{ isset($item['code_1c']) ? $item['code_1c']: '' }}</span></td>
                        <td style="display: table-cell;" class="text-center">
                            <span>{{ (isset($item['created_at']) AND $item['created_at']  !== null) ? \Carbon\Carbon::parse($item['created_at'])->format('d.m.Y') : ''}}</span>
                        </td>
                        <td style="display: table-cell;" class="text-center">
                            <span>{{ Auth::guard('admin')->user()->name}}</span></td>
                        <td style="display: table-cell;" class="text-center">
                            {{--<button class="button button-small button-icon ico_trash" type="button" onclick="@this.removeProductFromTable('{{ $item['id'] }}')"></button>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>

                @if(isset($selected_products) AND count($selected_products)>0)

                    <div class="page-save">
                        <div></div>
                        <div class="page-nav-box">
                            <x-admin.page-selector
                                :paginator="$selected_products_paginated"
                                :list="[5,10,20,30,40]"
                            />

                            {{ $selected_products_paginated->links($this->paginationView())}}

                        </div>
                    </div>

                @endif
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
                  @if($selected_products_paginated AND count($selected_products_paginated)>0)
            setTimeout(() => {
               // dd($selected_products_paginated);
                @this.emit('setShowVariatesValue');
            }, 800);
            @else
            setTimeout(() => {
                @this.emit('setShowVariatesValue','reset');
            }, 800);
            @endif

            $(document).on('input', '.search__controls_{{ $table_name}} > input', function () {
                let textLenght = $(this).val().length;
                if (textLenght >= 1) {
                    $('.search_{{ $table_name}}').addClass('is-active');
                    $('.search__drop_{{ $table_name}}').show();
                    $('.search__overlay_{{ $table_name}}').addClass('is-show');
                    $('.search__result_{{ $table_name}}').addClass('is-show');
                } else {
                    $('.search__drop_{{ $table_name}}').hide();
                    $('.search_{{ $table_name}}').removeClass('is-active');
                    $('.search__overlay_{{ $table_name}}').removeClass('is-show');
                    $('.search__result_{{ $table_name}}').removeClass('is-show');

                }
            });

            $(document).on('click', function (e) {
                const modalEl = $('.search_{{ $table_name}}');
                if ($(modalEl).hasClass('is-active')) {

                    if ($(e.target).closest(".search_{{ $table_name}}").length !== 1) {

                        $('.search__drop_{{ $table_name}}').hide();
                        $('.search__overlay_{{ $table_name}}').removeClass('is-show');
                        $('.search__overlay').removeClass('is-show');
                        $('.search_{{ $table_name}}').removeClass('is-active');
                        $('.search__result_{{ $table_name}}').removeClass('is-show');
                        @this.
                        set('search', '');

                    }
                }


                e.stopPropagation();
            });


        });

        function clearNewProducts() {
            $('.search__drop_{{ $table_name}}').hide();
            $('.search__overlay_{{ $table_name}}').removeClass('is-show');
            $('.search__overlay').removeClass('is-show');
            $('.search_{{ $table_name}}').removeClass('is-active');
            $('.search__result_{{ $table_name}}').removeClass('is-show');
        }

        function addNewProducts(e, val) {
            if (e.which == 13) {

                @this.
                setDataProducts(val);
                $('.js-tags-next').val('');

                $('.search__drop_{{ $table_name}}').hide();
                $('.search__overlay_{{ $table_name}}').removeClass('is-show');
                $('.search__overlay').removeClass('is-show');
                $('.search_{{ $table_name}}').removeClass('is-active');
                $('.search__result_{{ $table_name}}').removeClass('is-show');
            }
        }

        var height = 0;
        window.addEventListener('showSearchResults', () => {
            if ($('.search__drop').height() != height) {
                height = $('.search__drop').height() + 50;
                @if(isset($cur_product_id))
                    height = $('.search__drop').height() + 50 - 15;
                @endif
                $('.search__drop').attr('style', 'top:-' + height + 'px; display:block;');
            }

        });

        window.addEventListener('resetShowValuesProductVariates', function (e) {

            if(e.detail.show == 'true'){
            setTimeout(() => {

                @this.emit('setShowVariatesValue');
            }, 800);
            }else{
                 setTimeout(() => {
                @this.emit('setShowVariatesValue','reset');
            }, 800);
            }

        });

    </script>


    @include('livewire.admin.includes.scripts_data',['hideFoot'=>true,'on_click'=>'dellAllData()','key'=>'All', 'title'=>''])

</div>
