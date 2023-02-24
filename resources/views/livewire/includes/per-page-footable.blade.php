<div class="{{$classes ?? 'table-nav'}}" @if($paginator->total() <= $perPageListItems[0]) style="display:none;" @endif>
    <div class="drop --arrow js-page-size">
        <button class="form-control drop-button" type="button">{{$paginator->perPage()}}</button>
        <div class="drop-box">
            <div class="drop-overflow">
                <ul class="drop-list">
                    @foreach($perPageListItems as $perPageValue)
                        <li class="drop-list-item"
                            onclick="@this.setPerPage({{$perPageValue}})"
                            data-page-size="{{$perPageValue}}">{{$perPageValue}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div id="table-nav" class="footable-paging-external footable-paging-right">
        @if($paginator->hasPages())
            {{$paginator->links()}}
        @endif
    </div>
</div>
