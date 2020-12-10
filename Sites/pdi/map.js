var mymap = L.map('mapid').setView([-22.093103, -70.211854], 13);

L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
    maxZoom: 18,
    tileSize: 512
}).addTo(mymap);