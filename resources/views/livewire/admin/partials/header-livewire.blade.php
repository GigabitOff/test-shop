<div class="container-large">
    <ul class="lang-list @if(!$title) mb-2 @endif">
    @foreach($languages as $key=>$lang)
        <li ><a href="#!" @if(session('lang') and $lang->lang==session('lang')) class="is-active" @endif onclick="removeWireIgnore();" wire:click="changeHeaderLang('{{ $lang->lang}}')" >
            @if(isset($lang->image))
            <img src="{{Storage::disk('public')->url($lang->image)}}" alt="@lang('custom::admin.'.$lang->lang.'_short')">
            @else
            <img src="/admin/assets/img/flag-{{ $lang->lang}}.svg" alt="@lang('custom::admin.'.$lang->lang.'_short')">
            @endif
            <span>@lang('custom::admin.'.$lang->lang.'_short')
            </span></a></li>
    @endforeach
    </ul>
    <script>
    function removeWireIgnore() {
        setTimeout(() => {
            $( ".textareEditor" ).removeAttr('wire:ignore');
        }, 100);
    }
</script>
</div>
