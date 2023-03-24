<a href="javascript:void(0)" wire:click.prevent="$emit('eventFollowPrice', {'product_id' : {{$product_id}}, 'price': {{$price}} })" id="followPriceLink">@lang('custom::site.watch_price')</a>
{{-- All scripts were moved to parent template show-purchase-section-livewire--}}
{{-- b/c after user is logged in the page is fully reloaded.--}}
