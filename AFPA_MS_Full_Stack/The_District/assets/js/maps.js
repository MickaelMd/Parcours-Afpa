let map;
let marker = [];
let mapOptions = {
  scrollWheelZoom: false,
};

const id = "OSM-map";

const centerLatLng = [49.928640638465176, 2.273311614990235];
map = L.map(id, mapOptions).setView(centerLatLng, 20);

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "",
}).addTo(map);

marker = L.marker(L.latLng(49.928640638465176, 2.273311614990235), {
  title: "The District",
});

// marker = L.circleMarker(centerLatLng, {
//   radius: 8,
//   color: "blue",
//   fillColor: "blue",
//   fillOpacity: 0.5,
// }).addTo(map);

marker.addTo(map);
marker.bindPopup(
  "<h5> The District</h5> </br> <p>30 Rue de Poulainville, 80000 Amiens</p>"
);
