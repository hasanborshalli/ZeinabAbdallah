<x-admin.alayout title="My Schedule">

    <main class="col-md-9 col-lg-10 admin-main">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
            <div>
                <h1 class="admin-page-title h4">My Schedule</h1>
                <p class="text-muted mb-0 small">Your sessions at their booked time.</p>
            </div>
            <div class="d-flex align-items-center gap-3 small text-muted">
                <span><span class="sched-dot" style="background:#4b8b6f;"></span>Confirmed</span>
                <span><span class="sched-dot" style="background:#c58a3d;"></span>Pending</span>
            </div>
        </div>

        <div class="admin-panel schedule-panel">
            <div id="scheduleCalendar"></div>
        </div>
    </main>

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var el = document.getElementById('scheduleCalendar');

                if (!el || typeof FullCalendar === 'undefined') {
                    return;
                }

                var mobileQuery = window.matchMedia('(max-width: 767.98px)');

                var optionsFor = function (isMobile) {
                    return {
                        view: isMobile ? 'listMonth' : 'dayGridMonth',
                        header: isMobile
                            ? { left: 'prev,next', center: 'title', right: 'today' }
                            : { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,listMonth' },
                        footer: isMobile
                            ? { center: 'dayGridMonth,listMonth' }
                            : false,
                    };
                };

                var initial = optionsFor(mobileQuery.matches);

                var calendar = new FullCalendar.Calendar(el, {
                    initialView: initial.view,
                    headerToolbar: initial.header,
                    footerToolbar: initial.footer,
                    height: 'auto',
                    firstDay: 1,
                    nowIndicator: true,
                    dayMaxEvents: true,
                    displayEventEnd: true,
                    buttonText: { today: 'Today' },
                    slotMinTime: '07:00:00',
                    slotMaxTime: '22:00:00',
                    eventTimeFormat: { hour: 'numeric', minute: '2-digit', meridiem: 'short' },
                    views: {
                        dayGridMonth: { buttonText: 'Month' },
                        timeGridWeek: { buttonText: 'Week' },
                        listMonth: {
                            buttonText: 'List',
                            listDayFormat: { weekday: 'long', month: 'short', day: 'numeric' },
                            listDaySideFormat: false,
                        },
                    },
                    noEventsContent: 'No sessions this month.',
                    events: @json($events),
                });

                calendar.render();

                mobileQuery.addEventListener('change', function (e) {
                    var next = optionsFor(e.matches);
                    calendar.setOption('headerToolbar', next.header);
                    calendar.setOption('footerToolbar', next.footer);
                    calendar.changeView(next.view);
                });
            });
        </script>
    </x-slot:scripts>

</x-admin.alayout>