
function initMap() {
    const latitud= parseFloat(jQuery('#latitud-centro').val());
    const longitud= parseFloat(jQuery('#longitud-centro').val());
    map = new google.maps.Map(document.getElementById("map"), {
      center: {lat:latitud,lng:longitud},
      zoom: 14,
    });
    const markerCenter= new google.maps.Marker({
    position: {lat:latitud,lng:longitud},
    map: map
    });

    let markerLocations=[];
    let infoWindows=[];
    const arrayLocationsInfo=jQuery('.location-info');
    for(let i=0;i<arrayLocationsInfo.length;i++){
        const dir=arrayLocationsInfo[i].children[0].value;
        const img=arrayLocationsInfo[i].children[1].value;
        const lat=parseFloat(arrayLocationsInfo[i].children[2].value);
        const lng=parseFloat(arrayLocationsInfo[i].children[3].value);
        const idButton=arrayLocationsInfo[i].children[4].value;
        
        markerLocations[i]=new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map
            })

        let html=`<div class="map-card">
            <img src="${img}">
            <p>${dir}</p>
        </div>`;

        infoWindows[i]=new google.maps.InfoWindow({
                content:html
            })

        jQuery(`#${idButton}`).click(()=>{
            const btn=jQuery(`#${idButton}`);
            if(btn.hasClass('click')){
                infoWindows[i].close();
            }
            else{
            infoWindows[i].open({
                anchor: markerLocations[i],
                map,
                shouldFocus: false,
            })
        }
        btn.toggleClass('click');
        })

        markerLocations[i].addListener('click',()=>{
            const btn=jQuery(`#${idButton}`);
            if(btn.hasClass('click')){
                infoWindows[i].close();
            }else{
                infoWindows[i].open({
                    anchor: markerLocations[i],
                    map,
                    shouldFocus: false,
            });
            }
            btn.toggleClass('click');
        })
}   
}
window.initMap = initMap;


