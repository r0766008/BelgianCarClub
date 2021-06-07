<div id="event" class="modal">

  <div class="blog-header">
    <div class="blog-author--no-cover">
        <h5></h5>
    </div>
  </div>

  <div class="blog-body">
    <div class="blog-title">
      <h3></h3>
      <h6></h6>
    </div>
    <div class="blog-summary">
      <p style="line-height: 1.5rem"></p>
    </div>
    <div class="blog-tags"></div>
  </div>

  <div class="blog-footer">
    <ul>
      <li id="more-info"><a target="_blank" style="background-color:#333C42; padding: 10px; color: white; border-radius: 7px;"></a></li>
      <li><a href="#!" class="modal-close btn-flat" style="margin-top: -7px;">Close</a></li>
    </ul>
  </div>
</div>
<div class="container z-depth-5" style="margin: 50px auto;">
    <div><h4 class="col s12 center" style="padding-top: 20px;"><?= $this->lang->line('header_calendar')?></h4></div>
    <div id='calendar' style="padding: 0 50px 50px 50px;"></div>
</div>
<script src='<?= base_url('assets/js/fullcalendar/core/main.min.js'); ?>'></script>
<script src='<?= base_url('assets/js/fullcalendar/daygrid/main.min.js'); ?>'></script>
<script src='<?= base_url('assets/js/fullcalendar/google-calendar/main.min.js'); ?>'></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid', 'googleCalendar' ],
        googleCalendarApiKey: 'AIzaSyDOoGCsWyUbRnu9q-wJGoYvc_aQKkVSD1w',
        events: {
            googleCalendarId: 'vb4reajn86i7et4f4mq6rov660@group.calendar.google.com'
        },
        eventLimit: 6,
        eventClick: function(calEvent, jsEvent, view) {
            calEvent.jsEvent.preventDefault();
            $('.blog-header h5').html(calEvent.event.start.toString().match(/(.*?\s){4}/g)[0]);
            $('.blog-title h3').html(calEvent.event.title);
            $('.blog-title h6').html(calEvent.event.extendedProps.location);
            $('.blog-summary p').html(calEvent.event.extendedProps.description.split(';')[0]);
            var tags = "";
            if (calEvent.event.extendedProps.description.split(';')[1].length > 1) {
                for (var i = 0; i < calEvent.event.extendedProps.description.split(';')[1].split(',').length; i++) {
                    tags += "<li><a>" + calEvent.event.extendedProps.description.split(';')[1].split(',')[i] + "</a></li>";
                }
            }
            if (tags != "") $('.blog-tags').html("<ul>" + tags + "</ul>");
            if (calEvent.event.extendedProps.description.split(';')[2].length > 1) {
                $('#more-info a').attr("href", calEvent.event.extendedProps.description.split(';')[2].split('href="')[1].split('"')[0]);
                $('#more-info a').html(calEvent.event.extendedProps.description.split(';')[2].split('>')[1].split('<')[0]);
            }
            $('#event').modal('open');
        }
      });

      calendar.render();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('#event').modal();
    });
</script>
