<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
      
    <script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">  
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>

  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../home/home.php" >Home</a>
            <a href="../map/map.php">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../visualizzazione/visualizzazionePostiLettura.php">Tutti i posti lettura</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Statistiche
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../statistiche/ebookPiuAcceduti.php" class="active">EBook più acceduti</a>
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
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">  

                    <h4 class="card-title mt-3 text-center">Ebook con più accessi</h4>


                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{
                            
                            $sql = "Select Titolo, NumeroAccessi
                                    From Libro, Ebook
                                    where Libro.CodiceISBN = Ebook.CodiceISBN 
                                    group by Titolo, NumeroAccessi
                                    order by NumeroAccessi DESC";
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Ebook</th> 
                                    <th>Numero Accessi</th> 
                                </tr>
                            </thead>
                            <tbody>";
                    
                        
                            while ($row = $res->fetch()) {
                                $titolo = $row['Titolo'];
                                $accessi = $row['NumeroAccessi'];

                                echo "<tr>"; 
                                
                                 echo "<td><img src=" . "../../images/ebook.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                                  
                                echo "<td>" . $titolo . "</td>";
                                echo "<td>" . $accessi . "</td>";
                                echo "</tr>"; 

                            }        
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer> 
</html>