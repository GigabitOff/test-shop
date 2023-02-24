<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);"
                   aria-label="Previous"
                   wire:click="previousPage('{{ $paginator->getPageName() }}')">
                    <span class="ico_angle-left"></span>
                </a>
            </li>

            @for($i = pageRange($paginator->currentpage(),$paginator->lastPage())['start']; $i <= pageRange($paginator->currentpage(),$paginator->lastPage())['end']; $i++)
                <li class="page-item @if($paginator->currentpage() == $i) active @endif">
                    <a class="page-link" href="javascript:void(0);"
                       wire:click="setPage('{{$i}}')">{{$i}}</a>
                </li>
            @endfor
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);" aria-label="Next"
                       wire:click="nextPage('{{ $paginator->getPageName() }}')">
                        <span class="ico_angle-right"></span></a>
                </li>
            @endif
        </ul>
    @endif
</div>
