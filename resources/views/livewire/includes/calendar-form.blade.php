<script>
    document.addEventListener('DOMContentLoaded', function () {

        setTimeout(() => {
            $('#{{$formId}}').datepicker({
                autoClose: true,
                @if(!isset($single))
                range: true,
                @endif
                multipleDatesSeparator: ' - ',
                @if(isset($models))
                onSelect: function (selectedDate) {
                    var dateSelect = selectedDate.split(' - ');
                    @this.set('{{$models['start']}}', dateSelect[0]);
                    @if(isset($models['end']))
                        if(dateSelect[1] !== undefined) {
                            @this.set('{{$models['end']}}', dateSelect[1]);
                        }
                    @endif
                },
                @endif
            });
        });
    });
    //# sourceURL=includes-calendar-form.js
</script>
