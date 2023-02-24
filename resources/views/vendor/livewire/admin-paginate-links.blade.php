@if ($paginator->hasPages())
    <div class="page-nav">
        <div class="page-nav__arrow --left @if($paginator->onFirstPage()) pe-none @endif"
             onclick="@this.gotoPage({{$paginator->currentPage()-1}}, '{{$paginator->getPageName()}}')"
        ></div>

        <div class="page-nav__numbers">
            <span class="page-nav__current" data-page="{{$paginator->currentPage()}}"
            >{{$paginator->currentPage()}}</span>

            <span>/ {{$paginator->lastPage()}}</span>
        </div>

        <div class="page-nav__arrow --right @if($paginator->onLastPage()) pe-none @endif"
             onclick="@this.gotoPage({{$paginator->currentPage()+1}}, '{{$paginator->getPageName()}}')"
        ></div>
    </div>
@endif
