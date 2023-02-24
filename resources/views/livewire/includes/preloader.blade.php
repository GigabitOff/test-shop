<script>
    window.addEventListener('showPreloader', () => {

setTimeout(() => {
    jQuery('.preloader').show();
    jQuery('body').addClass('loaded_hiding');
}, 100);
        setTimeout(() => {
            jQuery('.preloader').hide();
            jQuery('body').removeClass('loaded_hiding');
        }, 1000);
});
</script>
