<a href="javascript:void(0)" wire:click.prevent="$emit('eventFollowPrice', {'product_id' : {{$product_id}} })" id="followPriceLink">@lang('custom::site.watch_price')</a>
<script>
    window.addEventListener('loginBeforeSubscribeToFollowPrice', () => $('#m-login').modal('show'));
    window.addEventListener('subscribeToFollowPrice', () => $('#m-email').modal('show'));
    window.addEventListener('successToFollowPrice', () => {
        $('#followPriceLink').hide();
        $('#m-price2').modal('show');
    });
</script>
