<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Leave Calendar</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <style>
        .fc-daygrid-day { cursor: pointer; transition: background 0.2s; }
        .fc-daygrid-day:hover { background-color: #f3f4f6; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('homepage') }}" class="font-bold text-xl text-gray-800">My App</a>
            <div>
                <a href="{{ route('leaves.index') }}" class="mr-4 text-gray-600 hover:text-blue-600">Leaves</a>
                <a href="{{ route('calendar.index') }}" class="mr-4 text-blue-600 font-bold border-b-2 border-blue-600">Calendar</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 pb-10">
        
        <div class="flex gap-4 mb-4 text-sm font-medium bg-white p-3 rounded shadow-sm inline-block">
            <div class="flex items-center"><span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span> Approved</div>
            <div class="flex items-center"><span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span> Pending</div>
            <div class="flex items-center"><span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span> Rejected</div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div id='calendar'></div>
        </div>
    </div>

    <div id="leaveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative p-5 border w-96 shadow-lg rounded-md bg-white">
            
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Leaves on Date</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-900 font-bold text-xl">&times;</button>
            </div>

            <div id="modalContent" class="mt-2 space-y-3">
                </div>

            <div class="mt-4 text-right">
                <button onclick="closeModal()" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        // Store all events globally to filter them later
        let allEvents = [];

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                selectable: true,
                editable: false,

                // Load events from Controller
                events: function(info, successCallback, failureCallback) {
                    fetch("{{ route('calendar.events') }}")
                        .then(response => response.json())
                        .then(data => {
                            allEvents = data; // Save to global variable
                            successCallback(data); // Render on calendar
                        });
                },

                // CLICK LOGIC: When user clicks a Date Box
                dateClick: function(info) {
                    showLeavesForDate(info.dateStr);
                },

                // CLICK LOGIC: When user clicks a specific Green Bar
                eventClick: function(info) {
                    // Treat it the same as clicking the date
                    var dateStr = info.event.startStr.split('T')[0];
                    showLeavesForDate(dateStr);
                }
            });

            calendar.render();
        });

        // Function to filter events and show Modal
        function showLeavesForDate(clickedDate) {
            // Filter: Find events where ClickedDate is inside [Start, End)
            var eventsOnDay = allEvents.filter(event => {
                return clickedDate >= event.start && clickedDate < event.end;
            });

            var contentHtml = "";

            if (eventsOnDay.length > 0) {
                eventsOnDay.forEach(event => {
                    var props = event.extendedProps;
                    
                    // Determine badge color for status
                    var statusColor = props.status === 'approved' ? 'text-green-600 bg-green-100' : 'text-yellow-600 bg-yellow-100';

                    contentHtml += `
                        <div class="border-b pb-2">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-lg">${props.name}</span>
                                <span class="text-xs px-2 py-1 rounded-full ${statusColor}">${props.status.toUpperCase()}</span>
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                <p><strong>Type:</strong> ${props.type}</p>
                                <p><strong>Reason:</strong> ${props.reason}</p>
                            </div>
                        </div>
                    `;
                });
            } else {
                contentHtml = `<p class="text-gray-500 italic text-center">No one is on leave today.</p>`;
            }

            // Update DOM
            document.getElementById('modalTitle').innerText = "Leaves on " + clickedDate;
            document.getElementById('modalContent').innerHTML = contentHtml;
            
            // Show Modal
            document.getElementById('leaveModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('leaveModal').classList.add('hidden');
        }
    </script>

</body>
</html>