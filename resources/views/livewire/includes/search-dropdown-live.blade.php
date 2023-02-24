<spav class="drop-clear"></spav>
<input class="form-control drop-input" type="text"
   placeholder="@lang('custom::site.search')"
   wire:model.debounce.700ms="search"
   onkeyup="this.value
   ? $(this).parent().find('.icon-close').addClass('is-active')
   : $(this).parent().find('.icon-close').removeClass('is-active')"
   name="search">
<div class="drop-box">
  <div class="drop-overflow">
    <ul class="drop-list">
      <li class="drop-list-item" onclick="$(this).parent().find('input').focus();
              @this.resetSearch()"
              style="background-color: #e6ebee;"> </li>
    </ul>
  </div>
</div>