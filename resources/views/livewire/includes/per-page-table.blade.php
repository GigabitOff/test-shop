<div class="table-nav" @if($data_paginate->total() <= 3) style="display:none;" @endif>
    <div class="drop --arrow js-page-size"><button class="form-control drop-button" type="button">{{session()->get('perPage', 3)}}</button>
      <div class="drop-box">
        <div class="drop-overflow">
          <ul class="drop-list">
            @for ($i = 3; $i < 30; $i+=3)
            <li class="drop-list-item" onclick="@this.setPerPage({{$i}})" data-page-size="{{$i}}">{{$i}}</li>
            @endfor
          </ul>
        </div>
      </div>
    </div>
    <div id="">
    @if($data_paginate->hasPages())
        {{$data_paginate->links()}}
    @endif
    </div>
</div>
