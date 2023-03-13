@php
    $pageSizes = [3, 10, 20, 50];
@endphp
<div class="table-nav" @if($data_paginate->total() < 3) style="display:none;" @endif>
    <div class="drop --arrow js-page-size">
        <button class="form-control drop-button" type="button">{{ session()->get('perPage', 3) }}</button>
        <div class="drop-box">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @for($i = 0; $i < count($pageSizes); $i++)
                        <li class="drop-list-item" onclick="@this.setPerPage({{ $pageSizes[$i] }})" data-page-size="{{ $pageSizes[$i] }}">
                            {{ $pageSizes[$i] }}
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    <div id="">
        @if($data_paginate->hasPages())
            {{ $data_paginate->appends(['scroll_position' => session('scroll_position', 0)])->links() }}
        @endif
    </div>

</div>



