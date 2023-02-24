    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <div class="footable-pagination-wrapper">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                <li class="footable-page-nav" data-page="prev">
                    <a class="footable-page-link" href="javascript:void(0);"
                       dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                       wire:click="previousPage('{{ $paginator->getPageName() }}')"
                       wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"></a>
                </li>


                {{-- Next Page Link --}}
                <li class="footable-page-nav visible" data-page="next">
                    <a class="footable-page-link" href="javascript:void(0);"
                       dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                       wire:click="nextPage('{{ $paginator->getPageName() }}')"
                       wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')"></a>
                </li>
            </ul>

            <span class="label label-default">{{$paginator->currentPage()}} / {{$paginator->lastPage()}}</span>
        </div>
    @endif
