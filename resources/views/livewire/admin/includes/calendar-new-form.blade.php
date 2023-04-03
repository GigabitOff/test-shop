
<script>
    function showCalendar{{$formId}}(variable) {

        setTimeout(() => {


        $('#{{$formId}}').daterangepicker({
            "parentEl": ".daterange-parent",
            opens: 'left',
           // minDate: new Date(),

           // startDate: variable.date_start,


          //  endDate: variable.date_end,

            @if(isset($timePicker))
                timePicker: true,
                timePicker24Hour: true,
            @endif

            locale: {
                @if(isset($timePicker))
                format: 'DD.MM.YYYY H:mm',
                @else
                format: 'DD.MM.YYYY',
                @endif
               // cancel: 'Відмінити'
                },
            singleDatePicker: true,

            //singleDatePicker: true,

        }, function(start, end, label) {
            setTimeout(() => {

            @if(isset($date_start))
                @this.set('{{$date_start}}', start.format('DD.MM.YYYY'));

            @endif

        @if(isset($search_date_end))
            @this.checkDateFilter();

            @endif

            }, 500);

        });
    }, 400);



        setTimeout(() => {
            $('.cancelBtn').text("{{__('custom::admin.Cansel')}}");
            $('.applyBtn').text("{{__('custom::admin.Applay')}}");

            @if($clear === true)
            $('#{{$formId}}').val('');
            @endif

        }, 500);
    }

    document.addEventListener('DOMContentLoaded', function () {
        showCalendar{{$formId}}();

    });

    document.addEventListener('reloadCalendar', event => {

        const variable = event.detail.variable;

        showCalendar{{$formId}}(variable);

    });
</script>

