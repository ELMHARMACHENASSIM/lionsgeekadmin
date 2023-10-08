let clock = document.querySelector(".clock");
let date = document.querySelector(".date");
let tour = 1;
let lapseconds = 0;
let lapminuts = 0;
let lapHours = 0;
console.log(clock,date);

function currentTime() {

    let now = new Date();
    // Get the current hour and minute
    let hours = now.getHours();
    let minutes = now.getMinutes();
    // Format the hours and minutes to have leading zeros if needed
    let formattedHours = hours < 10 ? '0' + hours : hours;
    let formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
    // Create the final time string
    let currentTime = formattedHours + ':' + formattedMinutes;
    clock.innerHTML = currentTime

    let dayNames = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    let dayName = dayNames[now.getDay()];

    // Get day of the month
    let dayOfMonth = now.getDate();

    // Get month name
    let monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    let monthName = monthNames[now.getMonth()];

    // Get year
    let year = now.getFullYear();

    // Format the date string
    let formattedDate = `${dayOfMonth} ${monthName}  ${year}`;
    // ${dayName} 
    date.innerHTML = formattedDate



}
setInterval(() => {
    currentTime()
}, 1000);