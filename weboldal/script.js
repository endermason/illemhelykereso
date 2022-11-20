mapboxgl.accessToken = 'pk.eyJ1IjoiZW5kZXJtYXNvbiIsImEiOiJjbDh1c3E2Y20wN2FuM3BvZzhxYW4zNndpIn0.MWkq3OWmG-285QQQ318pfg';

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {enableHighAccuracy:true})

function successLocation(position){
console.log(position)
setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation(){
setupMap([17.63517,47.68329])
}

function setupMap(center){
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: center,
        zoom: 14
    });
}


