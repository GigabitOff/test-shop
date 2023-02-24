<p>@lang('custom::admin.settings.reCAPTCHA_site_key')</p>
<input class="form-control" type="text"
       placeholder="@lang('custom::admin.settings.reCAPTCHA_site_key')"
       wire:model.lazy="data.global_settings.reCAPTCHA_site_key">

<p>@lang('custom::admin.settings.reCAPTCHA_site_private_key')</p>
<input class="form-control" type="text"
       placeholder="@lang('custom::admin.settings.reCAPTCHA_site_private_key')"
       wire:model.lazy="data.global_settings.reCAPTCHA_private_key">

<p>@lang('custom::admin.Main email')</p>
<input class="form-control" type="text"
       placeholder="@lang('custom::admin.settings.Global Add Email')"
       wire:model.lazy="data.global_settings.main_email_for_send">
