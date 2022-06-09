var map = L.map('map').setView([47.65565, 1.67307], 7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

async function add_markers(){
    const reponse = await fetch("/API/lycee.php");
    const lycees = await reponse.json();
    console.log(lycees);

    lycees.forEach(mark);

    function mark(m){
        L.marker([m["latitude"], m["longitude"]]).addTo(map)
        .bindPopup('<a href="get_formations.php?id='+m["id"]+'" target="blank">Lycée '+m["nom"]+'</a><br>Adresse : '+m["adresse"]+', '+m["ville"]); 
    }

}

add_markers();
