<a href="javascript:void(0)" wire:click.prevent="$emit('eventFollowPrice', {'product_id' : {{$product_id}} })">@lang('custom::site.watch_price')</a>
<script>
    window.addEventListener('loginBeforeSubscribeToFollowPrice', product_id => $('#m-login').modal('show'));
    window.addEventListener('subscribeToFollowPrice', () => $('#m-email').modal('show'));
    window.addEventListener('successToFollowPrice', () => $('#m-price2').modal('show'));
</script>
