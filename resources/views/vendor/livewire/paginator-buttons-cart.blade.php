<div>
    @if ($paginator->hasPages())
    <div class="footable-paging-external footable-paging-right">
        <div class="footable-pagination-wrapper">
            <ul class="pagination">

                <li class="footable-page-nav disabled" data-page="first">
                    <a wire:click="previousPage('{{ $paginator->getPageName() }}')"
                       class="footable-page-link" href="#">«</a></li>

                <li class="footable-page-nav disabled" data-page="prev">
                    <a wire:click="previousPage('{{ $paginator->getPageName() }}')"
                       class="footable-page-link" href="#">‹</a></li>


                    <li class="footable-page-nav" data-page="next"><a
                        @if ($paginator->hasMorePages())
                                wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        @endif
                                class="footable-page-link" href="#">›</a></li>

                    <li class="footable-page-nav" data-page="last"><a
                        @if ($paginator->hasMorePages())
                                wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        @endif
                                class="footable-page-link" href="#">»</a></li>
            </ul>

            <div class="divider"></div>
            <span class="label label-default">{{$paginator->currentPage()}} / {{$paginator->lastPage()}}</span>

        </div>
     </div>
    @endif
</div>
