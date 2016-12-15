      var lat;
      var lng;
      var map;
      var markers = Array();
var infos = Array();
var dir = Array();

      var customLabel = {
        restaurant: {
          label: 'Restaurant'
        },
        bar: {
          label: 'Bar'
        },
        atm: {
          label: 'ATM'
        },
        lodging: 'Hotel'
      }
      };

function myLocation() {
navigator.geolocation.getCurrentPosition(onSuccess, onError);
}


var onSuccess = function(position) {
      lat = position.coords.latitude;
      lng = position.coords.longitude;

      console.log(lat);
      console.log(lng)

      initMap();
    };

    // onError Callback receives a PositionError object
    //
    function onError(error) {
        alert('code: '    + error.code    + '\n' +
              'message: ' + error.message + '\n');
    }



      function initMap() {
        //  map = new google.maps.Map(document.getElementById('map'), {
        //   center: {lat,lng},
        //   zoom: 16,
        //   scrollwheel: false
        // });
        // var infoWindow = new google.maps.InfoWindow({map: map});



// prepare Geocoder
geocoder = new google.maps.Geocoder();
// set initial position (New York)
var myLatlng = new google.maps.LatLng(5.760073,-0.221880);
var myOptions = { // default map options
zoom: 12,
center: myLatlng,
scrollwheel: false,
mapTypeId: google.maps.MapTypeId.ROADMAP

};


map = new google.maps.Map(document.getElementById('map'), myOptions);

var marker = new google.maps.Marker({
  position: myLatlng,
  map: map,
  // animation: google.maps.Animation.BOUNCE
 });
 marker.setMap(map);

    }

    function clearOverlays() {
if (markers) {
for (i in markers) {
markers[i].setMap(null);
}
markers = [];
infos = [];
}
}
// clear infos function
function clearInfos() {
if (infos) {
for (i in infos) {
if (infos[i].getMap()) {
infos[i].close();
}
}
}
}
