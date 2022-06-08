var map = L.map('map').setView([47.65565, 1.67307], 7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

/*L.marker([47.7515686, 1.6750631]).addTo(map)
    .bindPopup('Nom lycée<br> Adresse')
    .openPopup();*/

async function add_markers(){
    const reponse = await fetch("/API/lycee.php");
    const lycees = await reponse.json();
    console.log(lycees);

    lycees.forEach(mark);

    function mark(m){
        L.marker([m["latitude"], m["longitude"]]).addTo(map)
        .bindPopup('<a href="get_formations.php?id='+m["id"]+'">Lycée '+m["nom"]+'</a><br>Adresse : '+m["adresse"]); 
    }

}

add_markers();


/*
//async function add_markers()
const reponse = await  fetch("/API/lycee.php");
console.log(reponse);

//}


const array = [];

for(var id in reponse) {
array.push([id,reponse[id]]);
}

array.forEach(mark);

function mark(){
L.marker([47.65565, 1.67307]).addTo(map)
.bindPopup('Nom lycée<br> Adresse')
.openPopup(); 
}
*/