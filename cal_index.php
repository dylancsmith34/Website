<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Calendar</title>
    <link rel="stylesheet" href="cal_style.css">

</head>

<body>
    <div><?php require('header.php');?></div>
    <div id="container" style="margin: auto">
        <div id="header">
            <div id="monthDisplay"></div>
            <div>
                <button id="backButton">Back</button>
                <button id="nextButton">Next</button>
            </div>
        </div>

        <div id="weekdays">
            <div>&nbsp; Sunday</div>
            <div>&nbsp; Monday</div>
            <div>&nbsp; Tuesday</div>
            <div>Wednesday</div>
            <div>&nbsp; Thursday</div>
            <div>&nbsp; &nbsp; Friday</div>
            <div>&nbsp; Saturday</div>
        </div>

        <div id="calendar"></div>
    </div>

    <div id="newEventModal">
        <h2>New Event</h2>

        <input id="eventTitleInput" placeholder="Event Title" />

        <button id="saveButton">Save</button>
        <button id="cancelButton">Cancel</button>
    </div>

    <div id="deleteEventModal">
        <h2>Event</h2>

        <p id="eventText"></p>

        <button id="deleteButton">Delete</button>
        <button id="closeButton">Close</button>
    </div>

    <div id="modalBackDrop"></div>

    <?php
        require_once 'config.php';

        $dsn = "mysql:host=$host;dbname=$db"; 
        $pdo = new PDO($dsn, $username, $password);
        $stmt = $pdo->query("SELECT * FROM events");
        foreach ($stmt as $row){
            $events[] = [$row['eid'], $row['event'], $row['artist'], $row['path'], $row['date']];
        }
    ?>
    <script>
    /*eslint-env browser*/

let nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function openModal(date) {
    clicked = date;

    const eventForDay = events.find(e => e.date === clicked);

    if (eventForDay) {
        document.getElementById('eventText').innerText = eventForDay.title;
        deleteEventModal.style.display = 'block';
    } else {
        newEventModal.style.display = 'block';
    }

    backDrop.style.display = 'block';
}

function load() {
    const dt = new Date();

    if (nav !== 0) {
        dt.setMonth(new Date().getMonth() + nav);
    }

    const day = dt.getDate();
    const month = dt.getMonth();
    const year = dt.getFullYear();

    const firstDayOfMonth = new Date(year, month, 1);
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
        weekday: 'long',
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
    });
    const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

    document.getElementById('monthDisplay').innerText =
        `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

    calendar.innerHTML = '';

    for (let i = 1; i <= paddingDays + daysInMonth; i++) {
        const daySquare = document.createElement('div');
        daySquare.classList.add('day');

        const dayString = `${month + 1}/${i - paddingDays}/${year}`;

        if (i > paddingDays) {

            daySquare.innerText = i - paddingDays;
            const eventForDay = events.find(e => e.date === dayString);

            if (i - paddingDays === day && nav === 0) {
                daySquare.id = 'currentDay';
            }

            if (eventForDay) {
                const eventDiv = document.createElement('div');
                eventDiv.classList.add('event');
                eventDiv.innerText = eventForDay.title;
                daySquare.appendChild(eventDiv);
            }
        } else {
            daySquare.classList.add('padding');
        }

        calendar.appendChild(daySquare);
    }
    const daySquares = document.getElementsByClassName("day");
    var xhttp = new XMLHttpRequest();
    var calendarEvents = (<?php echo json_encode($events) ?>);
    for (daySquare of daySquares) {
        for (calendarEvent of calendarEvents) {
            var eventYear = calendarEvent[4].slice(0, 4);
            var eventMonth = calendarEvent[4].slice(5, 7);
            switch (eventMonth) {
                case '01':
                    eventMonth = 'January';
                    break;
                case '02':
                    eventMonth = 'February';
                    break;
                case '03':
                    eventMonth = 'March';
                    break;
                case '04':
                    eventMonth = 'April';
                    break;
                case '05':
                    eventMonth = 'May';
                    break;
                case '06':
                    eventMonth = 'June';
                    break;
                case '07':
                    eventMonth = 'July';
                    break;
                case '08':
                    eventMonth = 'August';
                    break;
                case '09':
                    eventMonth = 'September';
                    break;
                case '10':
                    eventMonth = 'October';
                    break;
                case '11':
                    eventMonth = 'November';
                    break;
                case '12':
                    eventMonth = 'December';
                    break;
                default:
                    //do nothing
            }
            if (document.getElementById('monthDisplay').innerHTML == eventMonth + " " + eventYear) {
                var eventDay = calendarEvent[4].slice(8, 11);
                if (eventDay.slice(0, 1) == 0) {
                    eventDay = eventDay.slice(1, 2);
                }
                if (eventDay == daySquare.innerHTML) {

                    daySquare.innerHTML = daySquare.innerHTML + "<center><img src='" + calendarEvent[3] + "' style='width:73%;'><br>" + calendarEvent[1] + "<br>" + calendarEvent[2] + "</center>";
                }
            }

        }
    }

}

function closeModal() {
    eventTitleInput.classList.remove('error');
    newEventModal.style.display = 'none';
    deleteEventModal.style.display = 'none';
    backDrop.style.display = 'none';
    eventTitleInput.value = '';
    clicked = null;
    load();
}

function saveEvent() {
    if (eventTitleInput.value) {
        eventTitleInput.classList.remove('error');

        events.push({
            date: clicked,
            title: eventTitleInput.value,
        });

        localStorage.setItem('events', JSON.stringify(events));
        closeModal();
    } else {
        eventTitleInput.classList.add('error');
    }
}

function deleteEvent() {
    events = events.filter(e => e.date !== clicked);
    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
}

function initButtons() {
    document.getElementById('nextButton').addEventListener('click', () => {
        nav++;
        load();
    });

    document.getElementById('backButton').addEventListener('click', () => {
        nav--;
        load();
    });

    document.getElementById('saveButton').addEventListener('click', saveEvent);
    document.getElementById('cancelButton').addEventListener('click', closeModal);
    document.getElementById('deleteButton').addEventListener('click', deleteEvent);
    document.getElementById('closeButton').addEventListener('click', closeModal);
}

initButtons();
load();

    
    </script>
    <div>
        <?php require('footer.php');?>
    </div>
</body>

</html>
