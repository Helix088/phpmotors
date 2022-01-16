let d = new Date(document.lastModified);
const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
let day = d.getDate();
let year = d.getFullYear();
let update = document.writeln(
    "Last updated: " + day + " " + monthNames[d.getMonth()] + ", " + year
);
document.querySelector("#lastmod").innerHTML = update;