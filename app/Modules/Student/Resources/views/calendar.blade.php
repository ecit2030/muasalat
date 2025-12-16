<script>
    /******/
    (() => { // webpackBootstrap
        var __webpack_exports__ = {};
        /*!*********************************************!*\
        !*** ./resources/assets/js/app-calendar.js ***!
        \*********************************************/
        function _defineProperty(obj, key, value) {
            if (key in obj) {
                Object.defineProperty(obj, key, {
                    value: value,
                    enumerable: true,
                    configurable: true,
                    writable: true
                });
            } else {
                obj[key] = value;
            }
            return obj;
        }

        //________ FullCalendar
        document.addEventListener('DOMContentLoaded', function() {
            var _FullCalendar$Calenda;

            var containerEl = document.getElementById('external-events-list');
            new FullCalendar.Draggable(containerEl, {
                itemSelector: '.fc-event',
                eventData: function eventData(eventEl) {
                    var _ref;

                    return _ref = {
                        title: eventEl.innerText.trim()
                    }, _defineProperty(_ref, "title", eventEl.innerText), _defineProperty(
                        _ref, "className", eventEl.className + ' overflow-hidden '), _ref;
                }
            }); // sample calendar events data

            'use strict';

            var curYear = moment().format('YYYY');
            var curMonth = moment().format('MM'); // Calendar Event Source
            var sptCoursesEvents = {
                id: 1,
                events: [
                    @foreach ($client->courseTimes() as $key => $time)
                        {
                            id: "{{ $key + 1 }}",
                            start: "{{ $time->starts_at->format('Y-m-d H:i:s') }}",
                            end: "{{ $time->ends_at->format('Y-m-d H:i:s') }}",
                            title: "{{ $time->title() }}",
                            description: 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary',
                            className: "bg-primary-transparent"
                        },
                    @endforeach
                ]
            }; // Birthday Events Source

            var sptLessonsEvents = {
                id: 2,
                events: [
                    @foreach ($client->lessonTimes() as $key => $time)
                        {
                            id: "{{ $key + 1 }}",
                            start: "{{ $time->starts_at->format('Y-m-d H:i:s') }}",
                            end: "{{ $time->ends_at->format('Y-m-d H:i:s') }}",
                            title: "{{ $time->title() }}",
                            description: '{{ $time->description() }}',
                            className: "bg-success-transparent"
                        },
                    @endforeach
                ]
            };

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, (_FullCalendar$Calenda = {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                navLinks: true,
                // can click day/week names to navigate views
                businessHours: true,
                // display business hours
                editable: false,
                selectable: false,
                selectMirror: false,
                droppable: false,
                // this allows things to be dropped onto the calendar
                select: function select(arg) {
                    var title = prompt('Event Title:');

                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        });
                    }

                    calendar.unselect();
                },
                eventClick: function eventClick(arg) {
                    // $('#modaldemo3').show();
                    $('#modaldemo3').modal('show');
                    //TODO:: show sunscripations in this modal
                    // if (confirm('Are you sure you want to delete this event?')) {
                    //     // arg.event.remove();
                    //     $('#modaldemo3').show();
                    // }
                }
            }, _defineProperty(_FullCalendar$Calenda, "editable", true), _defineProperty(
                _FullCalendar$Calenda, "eventSources", [sptCoursesEvents, sptLessonsEvents]), _FullCalendar$Calenda));
            calendar.render();
        });
        /******/
    })();
</script>
