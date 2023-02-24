<div class="page-nav">
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)
            @if (!$paginator->onFirstPage())<a class="page-nav__arrow" href="javascript:void(0);"  wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before">
                <span class="ico_arrow-l"></span>
            </a>@endif
            <span class="page-nav__numb"><span class="current">{{$paginator->currentPage()}}</span><span>/ {{$paginator->lastPage()}}</span></span>
            @if ($paginator->hasMorePages())
            <a class="page-nav__arrow" href="javascript:void(0);" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" ><span class="ico_arrow-r"></span></a>
        @endif
    @endif
</div>
