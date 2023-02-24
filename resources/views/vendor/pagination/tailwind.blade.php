@if ($paginator->hasPages())
    <ul class="pagination">
        @if (!$paginator->onFirstPage())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span class="ico_angle-left"></span></a>
            </li>
        @endif
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            {{-- Array Of Links --}}
            @if (is_array($element))
                @php
                    $range = pageRange($paginator->currentPage(),count($element));
                @endphp
                @foreach ($element as $page => $url)
                    @if($page>=$range['start'] && $page<=$range['end'])
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                    <span class="ico_angle-right"></span>
                </a>
            </li>
        @endif
    </ul>
@endif
