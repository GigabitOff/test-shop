   @if(isset($data_paginate) AND $data_paginate->total()>$perPage) {{--  OR isset($data_paginate) AND isset($no_total) --}}
<div class="table-nav mt-3" @if(!isset($no_style))style="margin-bottom: 70px;" @endif>
    <div class="drop --arrow js-page-size" >
        <button class="form-control drop-button dropFoot" type="button">
            {{ $perPage }}
        </button>
        <div class="drop-box"  wire:ignore.parent>
            <div class="drop-overflow">
                <ul class="drop-list ">
                    <li class="drop-list-item " wire:click="changePerPage(10)">10</li>
                    @for ($i = 1; $i < 3; $i++)
                    <li class="drop-list-item " wire:click="changePerPage({{$count = $i*50}})">{{$count}}</li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
    {{ $data_paginate->links()}}

</div>
    @endif

