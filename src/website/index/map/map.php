<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
      integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>
    <script>
        
        biblios = new Array();
        
        function createMap(){
            const test = document.getElementById('test');
            const test1 = document.getElementById('test1');

            var mymap = L.map('mapid').setView([44.4990968,11.2616454], 13);

            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoicGlzbm8xMiIsImEiOiJja2xrdWdkbWQzZnp6MnZzOHRnenJzcWlwIn0.EhR2itT7MomFJ-3UN_DXwg'
            }).addTo(mymap);
            
            for(var i=0; i<biblios.length; i++){
                L.marker([biblios[i].lat, biblios[i].long]).addTo(mymap);
            }
        }
    
        function populateArray(lat, long){
            biblios.push({'lat': lat, 'long': long});
        }
      
    </script>
    <title>Ebiblio</title>
  </head>
  <body>
    <div id="mapid" style = "width:80%; height:580px;"></div>
      
      <?php
        require '../../../connectionDB/connection.php'; 
      
        try{
            $sql = "SELECT Nome, Latitudine, Longitudine FROM Biblioteca";
            $res = $pdo -> query($sql);
        }catch(PDOException $e){echo $e->getMessage();}	

        while ($row = $res->fetch()) {
            $nome = $row['Nome'];
            echo '<script>',
                    'populateArray(' . $row['Latitudine'] . ',' . $row['Longitudine'] . ');',
                 '</script>'
            ;
        }
      
    ?>
      
      <script>createMap();</script>
    
  </body>
</html>