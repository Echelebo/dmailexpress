const svgIcon = L.divIcon({
  html: `
  <svg xmlns="http://www.w3.org/2000/svg" width="46" height="56"><path fill-rule="evenodd" d="M39.263 7.673c8.897 8.812 8.966 23.168.153 32.065l-.153.153L23 56 6.737 39.89C-2.16 31.079-2.23 16.723 6.584 7.826l.153-.152c9.007-8.922 23.52-8.922 32.526 0zM23 14.435c-5.211 0-9.436 4.185-9.436 9.347S17.79 33.128 23 33.128s9.436-4.184 9.436-9.346S28.21 14.435 23 14.435z"/></svg>`,
});
var mymap = L.map('map').setView([34.0614, -118.08162], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1Ijoia2V2ZXRpaDg2MSIsImEiOiJja2h4MzFxaG8wOW5pMzBsdGZ1NXFoeHh5In0.hw5mLyF4KWalDgcxAWrmuw'
}).addTo(mymap);
var marker = L.marker([34.0614, -118.08162],{icon: svgIcon}).addTo(mymap);




function myIPadress(ipAddress) {
    var ip = ipAddress;
    var api_key="at_M6MJOcjeIck4XkW4qTcJmKcezgamn";
    var api_url = 'https://geo.ipify.org/api/v1?';
    var url = api_url + 'apiKey=' + api_key + '&ipAddress=' + ip;
    fetch(url)
    .then((data) => data.json())
        .then((data) => {
            if(!data.code){
              displayInfo(data);
            displayMap(data);
            $(".ErorIP").remove()
            }else{
              $("header").append(
                `<div class="ErorIP"><span>${data.messages}</span></div>`
              )
            }
        })
        .catch(error => {
          console.log("error");
          if(error){
            $("header").append(
              `<div class="ErorIP"><span>your ip Adress is Incorrect !!!</span></div>`
            )
          } 
      })

}
  function displayInfo(data){
   $("#ip-address").html(data.ip)
   $("#location").html(data.location.city + "," + data.location.country + " " + data.location.postalCode)
   $("#timezone").html("UTC " + data.location.timezone)
   $("#isp").html(data.isp) 
  }
  function displayMap(data){
    mymap.setView([data.location.lat, data.location.lng], 13);
    marker.setLatLng([data.location.lat, data.location.lng])
  } 
$("#button-addon2").click(()=>{
  var input = $(".form-control").val()
  if(input==""){
    $("header").append(
      `<div class="Eror"><span>your input is empty !!!</span></div>`
    )
  }else{
    myIPadress(input);
    $(".Eror").remove()
  }
})