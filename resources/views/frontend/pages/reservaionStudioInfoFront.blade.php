@extends("frontend.index")

@section('content')
    <section class="content">
        <div class="containerme p-5">
            @foreach ($allStudios as $studio)
                @if ($studio->id === $chosenStudio->id)
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="fw-semibold mb-5">{{ $studio->name }} <span class="text-yellow">*</span></h1>

                        <a href={{ route('reservationStudioFront.create', $studio) }}>
                            <button class="btn btn-noir calen">
                                + &nbsp; Ajouter Reservation
                            </button>
                        </a>
                    </div>

                    <div class="mt-4" id="reservationStudio">
                    </div>


                    <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog"
                        aria-labelledby="eventDetailModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="eventDetailModalLabel">Event Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">

                                    <div class="p-2">
                                        <div class="d-flex flex-column mt-4">
                                            <label for="inputTitle">Reservation Title: </label>
                                            <input class="form-control" type="text" name="inputTitle" id="inputTitle"
                                                required>
                                        </div>


                                        <div class="d-flex flex-column mt-4">
                                            <label for="inputDesc">Description: </label>
                                            <textarea class="form-control" name="inputDesc" id="inputDesc" cols="30" rows="3"></textarea>
                                        </div>

                                        <p class="mt-4">Reservation By : <span class="fw-bold" id="inputUser"></span></p>


                                        <button id="deleteEvent" class="btn btn-danger">Cancel Reservation</button>
                                        <button class="btn btn-success" id="updateEvent">Update event</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        var selectedEvent;
                        var reservations = @json($reservationStudios);

                        $("#deleteEvent").click(function() {
                            if (selectedEvent) {
                                var id = selectedEvent.id;

                                $("#eventDetailModal").modal("hide");
                                $.ajax({
                                    url: "/reservationStudio/update/cancel/" + id,
                                    type: "PUT",
                                    dataType: "json",
                                    success: function(response) {
                                        location.reload();
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    },
                                });
                            }
                        });

                        $("#updateEvent").click(function() {
                            if (selectedEvent) {
                                var id = selectedEvent.id;

                                var data = {
                                    id: id,
                                    title: $("#inputTitle").val(),
                                    description: $("#$inputDesc").val(),
                                };

                                $("#eventDetailModal").modal("hide");

                                $.ajax({
                                    url: "/reservationStudio/update/" + id,
                                    type: "PUT",
                                    dataType: "json",
                                    data: data,
                                    success: function(response) {
                                        location.reload();
                                    },
                                    error: function(error) {
                                        alert("-_- Try Again -_-");
                                        console.log(error);
                                    },
                                });
                            }
                        });

                        $(document).ready(function() {

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            var classCalendar = $("#reservationStudio").fullCalendar({
                                header: {
                                    left: 'prev,next today,month,agendaWeek,agendaDay,',
                                    center: 'title',
                                    right: ' listDay, listWeek, listMonth, myCustomButton'
                                },


                                firstDay: 1,

                                views: {
                                    listDay: { // Customize the name for listDay
                                        buttonText: 'Day Events'
                                    },
                                    listWeek: { // Customize the name for listWeek
                                        buttonText: 'Week Events'
                                    },
                                    listMonth: { // Customize the name for listMonth
                                        buttonText: 'Month Events'
                                    },
                                    agendaWeek: {
                                        type: 'agenda',
                                        buttonText: 'Week', // Customize the button text
                                        columnFormat: 'dddd, D', // Format for column headers
                                    },
                                    agendaDay: {
                                        type: "agenda",
                                        buttonText: "Day"
                                    },
                                    month: {
                                        type: "agenda",
                                        buttonText: "Month",
                                    },
                                },

                                // Automatically show calendar in week view
                                defaultView: "agendaWeek",

                                events: @json($events),

                                eventRender: function(event, element) {
                                    // Customize the event's HTML content
                                    element.find('.fc-time').html(event.start.format(
                                        'h:mm A')); // Customize the time display
                                },

                                eventClick: function(event, jsEvent, view) {
                                    selectedEvent = event;
                                    id = selectedEvent.id;

                                    window.location.href = "/reservationStudio/event/" + id;

                                },

                                selectable: true,
                                // selectHelper: true,

                                dayClick: function(date, jsEvent, view) {
                                    $('#reservationStudio').fullCalendar('gotoDate', date);
                                    $('#reservationStudio').fullCalendar('changeView', 'agendaDay');
                                },

                                //24 hour format
                                slotLabelFormat: "HH:mm",
                                // Time Format when viewing in Month View
                                timeFormat: 'HH:mm',


                                slotDuration: '00:20:00', // Set the slot duration to 15 minutes
                                slotLabelInterval: '01:00:00', // Display labels every 1 hour

                                // Setting a starting and ending time for the calendar
                                minTime: '09:00:00',
                                maxTime: '17:40:00',

                                // BUSINESS Hours gha katbeyen gray everthing that's not included in here
                                businessHours: {
                                    // Days of the week when business hours apply (0 = Sunday, 1 = Monday, etc.)
                                    dow: [1, 2, 3, 4, 5], // Monday to Friday

                                    // Start and end times for business hours
                                    start: '09:00',
                                    end: '17:40'
                                },

                                allDaySlot: false,

                                // a RedLine that shows where you currently are in the calendar in the day view
                                nowIndicator: true,

                            })
                        });
                    </script>
                @endif
            @endforeach
        </div>
    </section>
@endsection
