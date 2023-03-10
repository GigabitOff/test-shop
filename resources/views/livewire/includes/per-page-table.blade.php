<div class="table-nav" @if($data_paginate->total() <= 10 && $param != 2 || $data_paginate->total() == 0) style="display:none;" @endif>
    <div class="drop --arrow js-page-size">
        <button class="form-control drop-button" type="button">{{ session()->get('perPage', 3) }}</button>
        <div class="drop-box">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @if ($param == 2)
                        <li class="drop-list-item" onclick="@this.setPerPage(3)" data-page-size="3">3</li>
                    @endif
                    @for($i = 1; $i <= 3; $i++)
                        @php($value = $i == 1 ? 10 : ($i == 2 ? 20 : 50))
                        <li class="drop-list-item" onclick="@this.setPerPage({{ $value }})" data-page-size="{{ $value }}">{{ $value }}</li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    <div id="">
        @if ($data_paginate->hasPages())
            {{ $data_paginate->links() }}
        @endif
    </div>
</div>


