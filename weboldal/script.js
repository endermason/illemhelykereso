mapboxgl.accessToken = 'pk.eyJ1IjoiZW5kZXJtYXNvbiIsImEiOiJjbDh1c3E2Y20wN2FuM3BvZzhxYW4zNndpIn0.MWkq3OWmG-285QQQ318pfg';

//lokalizáció

navigator.geolocation.getCurrentPosition(successLocation, errorLocation, {enableHighAccuracy:true})

function successLocation(position){
console.log(position)
setupMap([position.coords.longitude, position.coords.latitude])
}

function errorLocation(){
setupMap([17.63517,47.68329])
}

function setupMap(center){
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/endermason/claresga1000814mf84f8qxzv',
        center: center,
        zoom: 14
    });
}
//kattintható ikonok a helyeken

map.on('click', (event) => {
    // If the user clicked on one of your markers, get its information.
    const features = map.queryRenderedFeatures(event.point, {
      layers: ['illemhelykereso'] // replace with your layer name
    });
    if (!features.length) {
      return;
    }
    const feature = features[0];
    const popup = new mapboxgl.Popup({ offset: [0, -15] })
    .setLngLat(feature.geometry.coordinates)
    .setHTML(
      `<h3>${feature.properties.title}</h3><p>${feature.properties.description}</p>`
    )
    .addTo(map);
    });
