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
    <title>MAPS</title>
      <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
      <link href="../../css/foglioStile.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">

  </head>
    <header></header>
  <body>
      <div class="topnav">
      <a href="../home/home.php" >Home</a>
            <a href="map.php" class="active">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../visualizzazione/visualizzazionePostiLettura.php">Tutti i posti lettura</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Statistiche
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../statistiche/ebookPiuAcceduti.php">EBook più acceduti</a>
                    <a href="../statistiche/numCartaceiPrenotati.php">Numero Cartacei Prenotati</a>
                    <a href="../statistiche/numConsegneVolontario.php">Consegne Volontario</a>
                    <a href="../statistiche/postoLetturaMenoUtilizzati.php">Posti lettura meno utilizzati</a>
                </div>
            </div>
          <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
      </div>
    <div id="mapid" style = "width:100%; height:580px;"  >
      
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
    </div>
  </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>