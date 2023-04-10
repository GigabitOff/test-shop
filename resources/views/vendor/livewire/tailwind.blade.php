<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <ul class="pagination">
            <li class="page-item">
                @if (!$paginator->onFirstPage())
                    <span class="page-link" aria-label="Previous" wire:click="previousPage('{{ $paginator->getPageName() }}')">
                        <span class="ico_angle-left"></span>
                    </span>
                @endif
            </li>
            @foreach ($elements as $key=>$element)
                @if (is_string($element))
                    <li><span>...</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @if($page<= $paginator->currentPage()+2 AND $page>= $paginator->currentPage() OR $page == $paginator->lastPage())
                        @if ($page == $paginator->currentPage())
                                <li class="page-item active" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                    <span class="page-link" href="#">{{ $page }}</span>
                                </li>
                        @else
                                <li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                                    <span class="page-link" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">
                                        {{ $page }}
                                    </span>
                                </li>
                        @endif
                        @endif
                    @endforeach
                @endif
            @endforeach
            <li class="page-item">
                @if ($paginator->hasMorePages())
                    <span class="page-link" href="#" aria-label="Next" wire:click="nextPage('{{ $paginator->getPageName() }}')">
                        <span class="ico_angle-right"></span>
                    </span>
                @endif
            </li>
        </ul>
    @endif
</div>

<style>
    li.page-item {
        cursor:pointer;
    }
</style>
