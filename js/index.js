/* var title = document.title;
var coordinates = [];

if(title = "Météo" && navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(callback, erreur);
} 

function erreur(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      console.log('L\'utilisateur a refusé la demande');
      break;
    case error.POSITION_UNAVAILABLE:
      console.log('Position introuvable');
      break;
    case error.TIMEOUT:
      console.log('Réponse trop lente');
      break;
  }
}

function callback(position) {
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  coordinates = JSON.stringify([lat, lng]);
  meteo.reload(lat, lng);
} */