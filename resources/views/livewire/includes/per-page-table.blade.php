@php
    $pageSizes = [10, 20, 50];
@endphp
<div class="table-nav" @if($data_paginate->total() < 10 ) style="display:none;" @endif>
    <div class="drop --arrow js-page-size">
        <button class="form-control drop-button" type="button">{{ session()->get('perPageD', 10) }}</button>
        <div class="drop-box">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach ($pageSizes as $pageSize)
                        <li class="drop-list-item" onclick="@this.setPerPage({{ $pageSize }})" data-page-size="{{ $pageSize }}">{{ $pageSize }}</li>
                    @endforeach
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


