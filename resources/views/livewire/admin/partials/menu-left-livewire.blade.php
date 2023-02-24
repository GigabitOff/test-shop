<div>


    <ul class="sidebar-menu">
        <li class="sidebar-menu__item">
            @php
                $subPages = ['settings.show', 'settings.index', 'menu.index'];
                $onSubpage = collect($subPages)
                    ->reduce(fn($carry, $item) => $carry || $this->route === "admin.{$item}", false);
            @endphp
            <x-admin.menu-link
                class="sidebar-menu__link"
                link="javascript: void(0);"
                :active="$onSubpage"
                :confirm="false"
            >
                <i class="ico_menu1"></i>
                <span>@lang('custom::admin.Settings')</span>
            </x-admin.menu-link>

            <div class="sidebar-menu__dropdown">
                <ul>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.settings.show','lang')"
                            :active="$this->route === 'admin.settings.show'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Multilingual')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.menu.index')"
                            :active="$this->route === 'admin.menu.index'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Menu')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.settings.index')"
                            :active="($this->route === 'admin.settings.index')"
                            :confirm="(isset($canselSaveButton))"
                        >
                            <span>@lang('custom::admin.general')</span>
                        </x-admin.menu-link>
                    </li>
                </ul>
            </div>
        </li>

        <li class="sidebar-menu__item">
            @php
                $subPages = ['pages.*', 'services.*', 'jobs.*', 'vacancies.*', 'actions.*', 'news.*', 'brands.*', 'reviews.*'];
                $onSubpage = collect($subPages)
                    ->reduce(fn($carry, $item) => $carry || $this->route === "admin.{$item}", false);
            @endphp
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.pages.index')"
                :active="$onSubpage"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu2"></i>
                <span>@lang('custom::admin.Pages')</span>
            </x-admin.menu-link>
        </li>
        <li class="sidebar-menu__item">
            <a class="sidebar-menu__link @if($this->route == 'admin.shop_cities.*' OR $this->route === 'admin.shops.*' OR $this->route === 'admin.contucts.*')is-active @endif" href="#!"><i class="ico_menu15"></i><span>@lang('custom::admin.Company structure')</span></a>
                  <div class="sidebar-menu__dropdown">
                    <ul>
                     <li>
                        <a {{$this->route === 'admin.shop_cities.*' ? 'class=is-active' : ''}} @if(isset($canselSaveButton)) href="javascript: void(0);" onclick="document.menuLeft.showConfirmPopup('{{route('admin.shop_cities.index')}}');" @else  href="{{ route('admin.shop_cities.index')}}" @endif>
                                <span>@lang('custom::admin.shop_cities')</span>
                            </a>
                      </li>
                      <li><a {{$this->route === 'admin.shops.*' ? 'class=is-active' : ''}} @if(isset($canselSaveButton)) href="javascript: void(0);" onclick="document.menuLeft.showConfirmPopup('{{route('admin.shops.index')}}')" @else  href="{{ route('admin.shops.index')}}" @endif>@lang('custom::admin.Filials')</a></li>
                      <li>
                        <a {{$this->route === 'admin.contucts.*' ? 'class=is-active' : ''}} @if(isset($canselSaveButton)) href="javascript: void(0);" onclick="document.menuLeft.showConfirmPopup('{{route('admin.contucts.index')}}')" @else  href="{{ route('admin.contucts.index')}}" @endif>@lang('custom::admin.Units')</a>
                        </li>

                    </ul>
                  </div>
                </li>
        <li class="sidebar-menu__item">
            @php
                $subPages = ['filters.index', 'filters.seo_filters'];
                $onSubpage = collect($subPages)
                    ->reduce(fn($carry, $item) => $carry || $this->route === "admin.{$item}", false);
            @endphp
            <x-admin.menu-link
                class="sidebar-menu__link"
                link="javascript: void(0);"
                :active="$onSubpage"
                :confirm="false"
            >
                <i class="ico_menu3"></i>
                <span>@lang('custom::admin.Filter')</span>
            </x-admin.menu-link>

            <div class="sidebar-menu__dropdown">
                <ul>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.filters.index')"
                            :active="$this->route === 'admin.filters.index'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Filters')
                        </x-admin.menu-link>
                    </li>
                    {{--<li><a href="{{ route('admin.filters.basic_attributes')}}" {{$this->route === 'admin.filters.basic_attributes' ? 'class=is-active' : ''}}>@lang('custom::admin.Basic attributes')</a></li>
                    <li><a href="{{ route('admin.filters.additional_attributes')}}" {{$this->route === 'admin.filters.additional_attributes' ? 'class=is-active' : ''}}>@lang('custom::admin.Additional attributes')</a></li>--}}
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.filters.seo_filters')"
                            :active="$this->route === 'admin.filters.seo_filters'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Seo data')
                        </x-admin.menu-link>
                    </li>
                </ul>
            </div>
        </li>
        <li class="sidebar-menu__item">
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.banners.index')"
                :active="$this->route === 'admin.banners.*'"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu4"></i>
                <span>@lang('custom::admin.Banners')</span>
            </x-admin.menu-link>
        </li>
        <li class="sidebar-menu__item">
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.category.index')"
                :active="$this->route === 'admin.category.*'"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu5"></i>
                <span>@lang('custom::admin.Category')</span>
            </x-admin.menu-link>
        </li>

        <li class="sidebar-menu__item">
            @php
                $subPages = ['product.*', 'catalog.services.*', 'product-imports.*'];
                $onSubpage = collect($subPages)
                    ->reduce(fn($carry, $item) => $carry || $this->route === "admin.{$item}", false);
            @endphp
            <x-admin.menu-link
                class="sidebar-menu__link"
                link="javascript: void(0);"
                :active="$onSubpage"
                :confirm="false"
            >
                <i class="ico_menu1"></i>
                <span>@lang('custom::admin.Catalog products')</span>
            </x-admin.menu-link>

            <div class="sidebar-menu__dropdown">
                <ul>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.product.index','lang')"
                            :active="$this->route === 'admin.product.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Catalog products')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.catalog.services.index','lang')"
                            :active="$this->route === 'admin.catalog.services.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.Services')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.product-imports.index','lang')"
                            :active="$this->route === 'admin.product-imports.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.upload_products')
                        </x-admin.menu-link>
                    </li>
                </ul>
            </div>
        </li>

        <li class="sidebar-menu__item">
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.characteristics.index')"
                :active="$this->route === 'admin.characteristics.*'"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu10"></i>
                <span>@lang('custom::admin.characteristics')</span>
            </x-admin.menu-link>
        </li>

        <li class="sidebar-menu__item">
            @php
                $subPages = ['bonus.marketing.*', 'bonus.personal.*', 'bonus.bonus.*', 'bonus.discount.*', 'bonus.cashback.*'];
                $onSubpage = collect($subPages)
                    ->reduce(fn($carry, $item) => $carry || $this->route === "admin.{$item}", false);
            @endphp
            <x-admin.menu-link
                class="sidebar-menu__link"
                link="javascript: void(0);"
                :active="$onSubpage"
                :confirm="false"
            >
                <i class="ico_menu11"></i>
                <span>@lang('custom::admin.Bonus')</span>
            </x-admin.menu-link>

            <div class="sidebar-menu__dropdown">
                <ul>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.bonus.discount.index')"
                            :active="$this->route === 'admin.bonus.discount.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.bonus.discount')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.bonus.cashback.index')"
                            :active="$this->route === 'admin.bonus.cashback.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.bonus.cashback')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.bonus.index')"
                            :active="$this->route === 'admin.bonus.bonus.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.bonus.bonuses')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.bonus.personal.index')"
                            :active="$this->route === 'admin.bonus.personal.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.bonus.personal_offers')
                        </x-admin.menu-link>
                    </li>
                    <li>
                        <x-admin.menu-link
                            :link="route('admin.bonus.marketing.index')"
                            :active="$this->route === 'admin.bonus.marketing.*'"
                            :confirm="(isset($canselSaveButton))"
                        >
                            @lang('custom::admin.bonus.marketing_offers')
                        </x-admin.menu-link>
                    </li>
                </ul>
            </div>
        </li>
        {{-- <li class="sidebar-menu__item"><a class="sidebar-menu__link {{ $this->route === 'admin.options.*' ? 'is-active' : ''}}" href="{{ route('admin.options.index') }}"><i class="ico_menu8"></i><span>@lang('custom::admin.Options')</span></a></li>--}}
        <li class="sidebar-menu__item">
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.users.index')"
                :active="$this->route === 'admin.users.*'"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu9"></i>
                <span>@lang('custom::admin.Users')</span>
            </x-admin.menu-link>
        </li>

        <li class="sidebar-menu__item">
            <x-admin.menu-link
                class="sidebar-menu__link"
                :link="route('admin.counterparties.index')"
                :active="$this->route === 'admin.counterparties.*'"
                :confirm="(isset($canselSaveButton))"
            >
                <i class="ico_menu14"></i>
                <span>@lang('custom::admin.Counterparties')</span>
            </x-admin.menu-link>
        </li>

        @if($instruction)
            <li class="sidebar-menu__item">
                <x-admin.menu-link
                    class="sidebar-menu__link"
                    :link="route('admin.instructions')"
                    :active="$this->route === 'admin.instructions'"
                    :confirm="(isset($canselSaveButton))"
                >
                    <i class="ico_menu5"></i>
                    <span>@lang('custom::admin.Instructions')</span>
                </x-admin.menu-link>
            </li>
        @endif

        <li class="sidebar-menu__item">
            <a target="_blank" class="sidebar-menu__link" href="/swagger">
                <i class="ico_menu14"></i>
                <span>@lang('custom::admin.Documentation API')</span>
            </a>
        </li>
    </ul>

    <script>
        window.addEventListener('stopChangeStartSet', () => {
            @this.
            stopChangeStartSet();

        });

        document.addEventListener('DOMContentLoaded', function () {
            $(".form-control").change(function () {

                // действия, которые будут выполнены при наступлении события...
                @if(!$canselSaveButton)
                @this.
                startEmmitForPopup();
                @endif

            });

        });

        document.menuLeft = {
            showConfirmPopup: function (url) {
                window.Livewire.emit('eventShowDialogMessage', {
                    'title': '@lang('custom::admin.Confirm return')',
                    'message': '@lang('custom::admin.The not saved changes will not be recoverable.')',
                    'buttons': [
                        {
                            'type': 'primary',
                            'text': '@lang('custom::admin.Confirm')',
                            'width': 'half',
                            'actions': [
                                {
                                    'type': 'redirect',
                                    'target': `${url}`
                                }
                            ]
                        },
                        {
                            'type': 'secondary',
                            'text': '@lang('custom::admin.Cansel')',
                            'width': 'half',
                        }
                    ]
                })
            }
        }

    </script>

</div>
