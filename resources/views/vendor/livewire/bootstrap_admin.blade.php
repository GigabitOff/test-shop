@if ($paginator->hasPages())
<div class="footable-paging-external footable-paging-right">
    <div class="footable-pagination-wrapper">
        <ul class="pagination">
            @if (!$paginator->onFirstPage())
            <li class="footable-page-nav" data-page="first">
                <a class="footable-page-link"  href="#!" wire:click="gotoPage(1)">«</a>
            </li>
            <li class="footable-page-nav" data-page="prev">
                <button type="button" class="footable-page-link" wire:click="gotoPage({{$paginator->currentPage()-1}})">‹</button>
            </li>
            @endif
            <li class="footable-page visible active" data-page="{{$paginator->currentPage()}}">
                <a class="footable-page-link" href="#">{{$paginator->currentPage()}}</a>
            </li>
            <li class="footable-page visible" data-page="{{$paginator->currentPage()}}">
                <a class="footable-page-link" href="#">{{$paginator->lastPage()}}</a>
            </li>
            @if ($paginator->hasMorePages())
            <li class="footable-page-nav" data-page="next">
                <button class="footable-page-link" type="button" wire:click="gotoPage({{$paginator->currentPage()+1}})" >›</button>
            </li>
            <li class="footable-page-nav" data-page="last">
                <a class="footable-page-link" href="#!" wire:click="gotoPage({{ $paginator->lastPage() }})">»</a>
            </li>
            @endif
        </ul>
        <div class="divider"></div>
        <span class="label label-default paginate-pages">{{$paginator->currentPage()}} / {{$paginator->lastPage()}}</span></div>
</div>
@endif
