<div class="alert alert-primary" style="margin: 5px;">
  <strong>MONITORING PANEL</strong><br />
  Berikut merupakan map monitoring, untuk melihat titik letak setiap pendaki</strong>
</div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDs7DDghtxpe7kOIwtCcgkIPNSr5pVgYA4&sensor=false"></script>
<script type="text/javascript">
      var map;
      var mac;
      var result;
      var mapOptions = { center: new google.maps.LatLng(0.808419, 127.333481),
                           zoom: 13,
                           mapTypeId: google.maps.MapTypeId.ROADMAP,
                           mapTypeId: 'satellite' };

      var userCoor;
      
      function loaderx(){
          var ajaxRequest; 
          try {
              ajaxRequest = new XMLHttpRequest();
           }catch (e) {
              try {
                 ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
              }catch (e) {
                 try{
                    ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                 }catch (e){
                    alert("Your browser broke!");
                    return false;
                 }
              }
           }
          
           ajaxRequest.onreadystatechange = function(){
              if(ajaxRequest.readyState == 4){
                 var part = ajaxRequest.responseText.split('|');
                 var userCoor = JSON.parse(part[0]);
                 mac = userCoor;
                 return mac;
                 //var userCoorPath = part[1];
                 var userCoordinate = new google.maps.Polyline({
                  });
              }
           }
     
          ajaxRequest.open("GET", "../android/ajax-notif.php?id=<?php echo $_GET['id']; ?>", false);
          ajaxRequest.send(null); 
          return mac;
       }

      function initialize() {
          map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
          google.maps.event.addListener(map, 'click',
            function(event) {
                document.frm.bujur.value=event.latLng.lng();
                document.frm.lintang.value=event.latLng.lat();
            }
           );

           loaderx();
           var userCoor = mac;
            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < userCoor.length; i++) {  

              marker = new google.maps.Marker({
                position: new google.maps.LatLng(userCoor[i][1], userCoor[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(userCoor[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
            }
            window.setTimeout(initialize, 10000);
      }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map_canvas"  style="width: 98.5%; height: 500px; border-radius: 10px; margin: 10px;"></div>
<div id="ss"></div>