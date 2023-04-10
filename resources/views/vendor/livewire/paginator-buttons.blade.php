<div  class="footable-paging-external footable-paging-right">
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <div class="footable-pagination-wrapper">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="footable-page-nav visible disabled" aria-disabled="true" data-page="prev" aria-label="@lang('pagination.previous')">
                        <span class="footable-page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="footable-page-nav visible" data-page="prev">
                        <a class="footable-page-link" href="javascript:void(0);"
                           dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                           wire:click="previousPage('{{ $paginator->getPageName() }}')"
                           wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">‹</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="footable-page-nav visible disabled" aria-disabled="true">
                            <span class="footable-page-link">{{ $element }}</span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="footable-page active visible"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                    aria-current="page">
                                    <span class="footable-page-link">{{ $page }}</span>
                                </li>
                            @else
                               <li class="footable-page visible"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                    <a class="footable-page-link" href="javascript:void(0);"
                                       wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="footable-page-nav visible" data-page="next">
                        <a class="footable-page-link" href="javascript:void(0);"
                           dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                           wire:click="nextPage('{{ $paginator->getPageName() }}')"
                           wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="footable-page-nav visible disabled" aria-disabled="true" data-page="next" aria-label="@lang('pagination.next')">
                        <span class="footable-page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
            <div class="divider"></div><span class="label label-default">{{ $paginator->currentPage() }} / {{ is_array($element) ? count($element) : '' }}</span>
        </div>
    @endif
</div>
