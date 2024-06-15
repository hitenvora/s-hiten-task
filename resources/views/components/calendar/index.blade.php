<div
    id='calendar'
    data-tw-merge
    {{ $attributes->class(['full-calendar_1'])->merge($attributes->whereDoesntStartWith('class')->getAttributes()) }}
></div>

@once
    @push('vendors')
        @vite('resources/js/vendor/calendar/index.js')
        @vite('resources/js/vendor/calendar/plugins/interaction.js')
        @vite('resources/js/vendor/calendar/plugins/day-grid.js')
        @vite('resources/js/vendor/calendar/plugins/time-grid.js')
        @vite('resources/js/vendor/calendar/plugins/list.js')
    @endpush
@endonce


@push('script')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          center: 'dayGridMonth,timeGridFourDay'
        },
        initialView: 'dayGridMonth',
        views: {
          timeGridFourDay: {
            type: 'timeGrid',
            duration: { days: 4 },
            buttonText: 'Time Wise'
          }
        },
        eventTimeFormat: {
      hour: '2-digit',
      minute: '2-digit',
      hour12: false,
    },
        events: async function (fetchInfo, successCallback, failureCallback) {
          try {
            const response = await fetch('{{ route('get.calendar') }}'); // Replace with your API endpoint
            const eventData = await response.json();
            successCallback(eventData);
          } catch (error) {
            failureCallback(error);
          }
        },
      });
      calendar.render();
    });
  </script>
@endpush
