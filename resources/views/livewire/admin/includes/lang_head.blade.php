<div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link @if('main'=== $show_lang) active @endif" id="nav-main-tab" data-toggle="tab" href="#nav-main" wire:click="changeLangTab('main')" role="tab" aria-controls="nav-main" aria-selected="false" style="color: black;">
        <span class="nav-item-text">Загальні дані</span>
    </a> 
    @foreach($languages as $key=>$lang)
    <a class="nav-item nav-link @if($key===$show_lang) active @endif" id="nav-{{$lang->lang}}-tab" data-toggle="tab" href="#nav-{{$lang->lang}}" wire:click="changeLangTab({{$key}},'{{ $lang->lang}}')" role="tab" aria-controls="nav-{{$lang->lang}}" aria-selected="false" style="color: black;">
        <span class="nav-item-text"> {{ $lang->name }}</span>
    </a>
    @endforeach
</div>
