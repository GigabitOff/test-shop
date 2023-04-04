@php

    if(!isset($single)){

    $from_date =@$data[explode('.',$date_start)[1]];
    $to_date =@$data[explode('.',$date_end)[1]];
    }

@endphp
<script>
    var setSelectDate = null;
    function getLocale{{$formId}}(){
            return {
                @if(isset($timePicker))
                format: 'DD.MM.YYYY H:mm',
                @else
                format: 'DD.MM.YYYY',
                @endif
                    daysOfWeek: [
                    "{{__('custom::admin.calendar.days_short.sun')}}",
                    "{{__('custom::admin.calendar.days_short.mon')}}",
                    "{{__('custom::admin.calendar.days_short.tue')}}",
                    "{{__('custom::admin.calendar.days_short.wed')}}",
                    "{{__('custom::admin.calendar.days_short.thu')}}",
                    "{{__('custom::admin.calendar.days_short.fri')}}",
                    "{{__('custom::admin.calendar.days_short.sat')}}"
                ],
                    monthNames: [
                    "{{__('custom::admin.calendar.month_full.jan')}}",
                    "{{__('custom::admin.calendar.month_full.feb')}}",
                    "{{__('custom::admin.calendar.month_full.mar')}}",
                    "{{__('custom::admin.calendar.month_full.apr')}}",
                    "{{__('custom::admin.calendar.month_full.may')}}",
                    "{{__('custom::admin.calendar.month_full.jun')}}",
                    "{{__('custom::admin.calendar.month_full.jul')}}",
                    "{{__('custom::admin.calendar.month_full.aug')}}",
                    "{{__('custom::admin.calendar.month_full.sep')}}",
                    "{{__('custom::admin.calendar.month_full.oct')}}",
                    "{{__('custom::admin.calendar.month_full.nov')}}",
                    "{{__('custom::admin.calendar.month_full.dec')}}"
                ],
                buttonLabels: {
                cancel: "{{__('custom::admin.Cansel')}}",
                apply: "{{__('custom::admin.Applay')}}"
            }

            };
        }

        function showCalendar{{$formId}}(variable) {

        setTimeout(() => {
            @if(isset($date_start))
            var from_date = '{{$date_start}}';
        @endif



@if(!isset($single))

var to_date ='{{$date_end}}';
        //alert(split('.'));
        setTimeout(() => {
        $('#{{$formId}}').daterangepicker({
            opens: 'left',
            isInvalidDate: function(date) {
                var today = new Date();
                return date.isSame(today, 'day');
            },
            @if(isset($calendar_drop))
            drops: '{{ $calendar_drop }}',
            @endif

             @if(!isset($hide_min_date))
            minDate: new Date(),
            @endif

            @if(isset($from_date))

            startDate: '{{$from_date}}',
            @elseif($clear !== true)
            //startDate: new Date(),
            @endif
            @if(isset($to_date))
            endDate: '{{$to_date}}',
            @else
            //endDate: new Date(),

            @endif
            locale: getLocale{{$formId}}(),

            //singleDatePicker: true,

        }, function(start, end, label) {
            var setSelectDate = true;
            setTimeout(() => {

            @if(isset($date_start))
            @this.set('{{$date_start}}', start.format('DD.MM.YYYY'));
        @endif
        @if(isset($date_end))
            @this.set('{{$date_end}}', end.format('DD.MM.YYYY'));
        @endif


            }, 500);
          //  console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

        setTimeout(() => {
            $('#{{$formId}}').val(`{{$from_date ? $from_date.'-' : ''}}{{$to_date}}`);
        }, 400)

    }, 400);
    @elseif($single == 'single')
setTimeout(() => {
        $('#{{$formId}}').daterangepicker({

            @if(isset($maxDate))
            maxDate: new Date(),
            @endif
            @if(isset($minDate) AND $minDate == '')
            minDate: new Date(),
            @elseif(isset($minDate))
            minDate: '{{\Carbon\Carbon::parse($minDate)->format('d-m-Y')}}',

            @endif
            @if(isset($from_date))
            startDate: '{{\Carbon\Carbon::parse($from_date)->format('d-m-Y')}}',
            @else
            startDate: new Date(),
            @endif
            @if(isset($timePicker))
            timePicker: true,
            timePicker24Hour: true,
            @endif
            locale: getLocale{{$formId}}(),
            singleDatePicker: true,

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

        @endif

    }, 400);


            @if($clear === true)
            $('#{{$formId}}').val('');
            @endif


        setTimeout(() => {
            $('.cancelBtn').html("{{__('custom::admin.Cansel')}}");
            $('.applyBtn').html("{{__('custom::admin.Applay')}}");
            @if($clear === true)
            document.querySelector('.drp-selected').html = '';
            @endif

        }, 1200);
    }

    document.addEventListener('DOMContentLoaded', function () {
        showCalendar{{$formId}}();

        $('#{{$formId}}').on('hide.daterangepicker', function() {
    // Викликати вашу функцію тут
            if(setSelectDate == null ){
                $('#{{$formId}}').val('');
            document.querySelector('.drp-selected').html = '';
            }
        });
    });

    document.addEventListener('clearCalendar', event => {

        $('#{{$formId}}').data('daterangepicker').remove();
    // re-initialize the daterangepicker
        $('#{{$formId}}').daterangepicker({
        opens: 'left',
        @if(isset($calendar_drop))
        drops: '{{ $calendar_drop }}',
        @endif
        @if(!isset($hide_min_date))
        minDate: new Date(),
        @endif
        startDate: new Date(),
        endDate: new Date(),
        locale: getLocale{{$formId}}(),
    }, function(start, end, label) {
            setTimeout(() => {

            @if(isset($date_start))
            @this.set('{{$date_start}}', start.format('DD.MM.YYYY'));
        @endif
        @if(isset($date_end))

            @this.set('{{$date_end}}', end.format('DD.MM.YYYY'));
        @endif


            }, 500);
          //  console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });



    });



</script>
