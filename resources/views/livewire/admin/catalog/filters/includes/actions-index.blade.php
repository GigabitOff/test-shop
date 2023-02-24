@if(isset($action_type))
<button type="button"  style="z-index: 1000" class="btn btn-sm btn-outline-dark mr-2" onclick="@this.editBanner('{{ $item_action->id }}')">
    @lang('custom::admin.Edit')
</button>
@else
<div class="button-group">
    <a class="button button-small button-icon ico_edit" href="{{ route('admin.'. $nameLive .'.edit', [$item_action->id]) }}"></a>
    </div>
    @endif
