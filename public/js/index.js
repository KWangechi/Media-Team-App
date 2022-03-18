var latitude;
var longitude;
// var church_location;
const church_location = {
  latitude: -1.1900906789,
  longitude: 36.9413564549
};

var latitude_id = document.getElementById("latitude");
var longitude_id = document.getElementById("longitude");

function getLocation() {
    // church_location = new google.maps.LatLng({lat: -1.1900906789, lng: 36.9413564549});
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getPosition, failed);
    } else {
        console.log("Geolocation is not supported for this browser");
    }
}

function getPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;

    let currentLocation = {
        latitude: latitude,
        longitude: longitude,
    };

    // check is current location is equal to the set allowed location
if(currentLocation == church_location){
  console.log('They are the same!!!!')
  
  latitude_id.value = latitude;
    longitude_id.value = longitude;

    console.log("Current Location: ");
    console.log(currentLocation);

    console.log("Church Location: ");
    console.log(church_location);

    console.log("Latitude ID: " + latitude_id.value);
    console.log("Longitude ID: " + longitude_id.value);

}

else{
  console.log('Error! Not the same');
}

    
}

function getConsole() {
    console.log("This is working!!!");
}

function failed() {
    console.log("Error!! Something went wrong");
}
// getLocation();

// -1.1900906789, 36.9413564549
