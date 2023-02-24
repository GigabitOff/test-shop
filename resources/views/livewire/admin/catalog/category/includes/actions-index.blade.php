@if(isset($action_type))
<button type="button"  style="z-index: 1000" class="btn btn-sm btn-outline-dark mr-2" onclick="@this.editBanner('{{ $item_action->id }}')">
    @lang('custom::admin.Edit')
</button>
@else
    <a class="button button-small button-icon ico_edit" href="{{ route('admin.'. $nameLive .'.edit', [$item_action->id]) }}"></a>
@endif
{{--<div class="action-group">
    <div class="action-group-btn"><span class="ico_submenu"></span></div>
        <div class="action-group-drop">
            <ul class="action-group-list">
                <li>
                    @if(isset($action_type))
                    <button type="button"  style="z-index: 1000" class="btn btn-sm btn-outline-dark mr-2" onclick="@this.editBanner('{{ $item->id }}')">
                                @lang('custom::admin.Edit')
                    </button>
                    @else
                    <a class="button button-small button-icon ico_edit" href="{{ route('admin.'. $nameLive .'.edit', [$item->id]) }}"></a>

                    @endif
                </li>
                <li><button class="ico_trash" type="button" onclick="@this.destroyData('{{ $item_action->id }}')"></button></li>
                <li><button class="js-hide-drop ico_close" type="button"></button></li>
            </ul>
    </div>
</div>--}}
