@extends('frontend.index')

@section('content')
    <section class="content">
        <div class="containerme p-5">
            @foreach ($allClasses as $classe)
                @if ($classe->id === $chosenClasse->id)
                    {{-- <div class="d-flex justify-content-between align-items-center"> --}}
                    <div class="d-flex flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <h1 class="fw-semibold fs-4">{{ $classe->name }} <span class="text-yellow">*</span></h1>

                            @include('Backend.partials.reservationClasse.reservationClasseCreateModal')
                        </div>
                    </div>


                    <div class="mt-4" id="reservationClasse">
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
                                    <div class="p-3">

                                        <div class="d-flex flex-column mt-4">
                                            <label for="inputTitle">Reservation Name: </label>
                                            <input type="text" class="form-control" name="inputTitle" id="inputTitle"
                                                required>
                                        </div>

                                        <div class="d-flex flex-column mt-4">
                                            <label for="inputDesc">Description: </label>
                                            <textarea class="form-control" name="inputDesc" id="inputDesc" cols="30" rows="3"></textarea>
                                        </div>

                                        <p class="mt-4">Reservation By : <span class="fw-bold" id="inputUser"></span></p>
                                        <div class="d-flex align-items-center justify-content-center">

                                            <button id="deleteEvent" class="btn btn-line">Cancel Reservation</button>
                                            <button class="btn btn-noir ms-4" id="updateEvent">Update event</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        var selectedEvent;
                        var reservations = @json($reservationClasses);

                        $("#deleteEvent").click(function() {
                            if (selectedEvent) {
                                var id = selectedEvent.id;

                                $("#eventDetailModal").modal("hide");
                                $.ajax({
                                    url: "/reservationClasse/update/cancel/" + id,
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
                                    description: $("#inputDesc").val(),
                                };

                                $("#eventDetailModal").modal("hide");

                                $.ajax({
                                    url: "/reservationClasse/update/" + id,
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
                            var classCalendar = $("#reservationClasse").fullCalendar({
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
                                        buttonText: "Day",
                                    },
                                    month: {
                                        type: "agenda",
                                        buttonText: "Month",
                                    },
                                },

                                buttonText: {
                                    today: 'Today', // Change the text for the "today" button
                                },

                                // eventLimit: true, // Enables the "+ more" button
                                // eventLimitText: 'more', // Customize the button text

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


                                    reservations.forEach(reservation => {
                                        if (reservation.id === event.id) {
                                            $("#inputTitle").val(reservation.title);
                                            $('#eventDetailModal').modal('show');
                                        }
                                    });

                                    var inputTitle = $('#inputTitle').val(); // Get the value of #inputTitle

                                    @foreach ($classe->reservationClasses as $reservation)
                                        @php
                                            $reservationTitle = $reservation->title;
                                            $classeName = $reservation->classe->name;
                                            $userName = $reservation->user->name;
                                            $reservationDesc = $reservation->description;
                                            
                                        @endphp

                                        if ("{{ $reservationTitle }}" === inputTitle) {
                                            $("#inputClasse").val("{{ $classeName }}");
                                            $("#inputUser").text("{{ $userName }}");
                                            $("#inputDesc").text("{{ $reservationDesc }}");
                                        }
                                    @endforeach

                                },

                                selectable: true,
                                // selectHelper: true,

                                dayClick: function(date, jsEvent, view) {
                                    $('#reservationClasse').fullCalendar('gotoDate', date);
                                    $('#reservationClasse').fullCalendar('changeView', 'agendaDay');
                                },

                                //24 hour format
                                slotLabelFormat: "HH:mm",
                                // Time Format when viewing in Month View
                                timeFormat: 'HH:mm',

                                // BUSINESS Hours gha katbeyen gray everthing that's not included in here
                                businessHours: {
                                    // Days of the week when business hours apply (0 = Sunday, 1 = Monday, etc.)
                                    dow: [1, 2, 3, 4, 5], // Monday to Friday

                                    // Start and end times for business hours
                                    start: '09:00',
                                    end: '17:40'
                                },


                                slotDuration: '00:20:00', // Set the slot duration to 15 minutes
                                slotLabelInterval: '01:00:00', // Display labels every 1 hour

                                allDaySlot: false,

                                // Setting a starting and ending time for the calendar
                                minTime: '09:00:00',
                                maxTime: '17:40:00',

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
