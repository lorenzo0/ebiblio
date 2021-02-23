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
      
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
         <div class="topnav">
            <a href="myHome.php" style=" background-color:#002a4f" class="active">Home</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
            
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="../profilo/profilo.php"> Torna al profilo </a></button>

                    <h4 class="card-title mt-3 text-center">Tutte le tue prenotazioni</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{                            
                            $sql = "SELECT * 
                                    FROM PrenotazioneCartaceo AS P JOIN Libro ON(P.CodiceISBNCartaceo = Libro.CodiceISBN)
                                    WHERE P.EmailUtilizzatore = '" . $_SESSION['EmailUtente'] . "'";
                            $res = $pdo -> query($sql);
                            
                            $sql1 = "SELECT IdPostoLettura, DataPrenotazione as dataPL, OraInizio
                                    FROM PrenotazionePostoLettura
                                    WHERE PrenotazionePostoLettura.EmailUtilizzatore = '" . $_SESSION['EmailUtente'] . "'";
                            $res1 = $pdo -> query($sql1);
                            
                        }catch(PDOException $e){echo $e->getMessage();}
                    

                        echo " 
                              <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Id prenotazione</th> 
                                        <th>Data di fine prenotazione</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>";
                    

                            while ($row = $res1->fetch()) {
                                $idprenotazionePL = $row['IdPostoLettura'];
                                $dataPrenotazionePL = $row['dataPL'];
                                $oraInizio = $row['OraInizio'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/desk.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $idprenotazionePL . "</td>";
                                echo "<td>" . $dataPrenotazionePL . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../visualizzazione/dettagliPostoLettura.php?Id=" . "$idprenotazionePL" . "&Data=" . $dataPrenotazionePL . "&OraInizio=" . $oraInizio . "'" . "> Dettagli </button></td>";
                                echo "</tr>"; 
                            }     
                    
                            while ($row = $res->fetch()) {
                                $idprenotazioneC = $row['IdPrenotazioneCartaceo'];
                                $dataPrenotazioneC = $row['FinePrenotazione'];
                                
                                $isbn = $row['CodiceISBN'];
                                $tipoLibro = $row['TipoLibro'];
                                $titolo = $row['Titolo'];
                                $anno = $row['Anno'];
                                $genere = $row['Genere'];
                                $nomeEdizione = $row['NomeEdizione'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/book.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $idprenotazioneC . "</td>";
                                echo "<td>" . $dataPrenotazioneC . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../visualizzazione/dettagliLibro.php?Isbn=" . "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> Dettagli </button></td>";
                                echo "</tr>"; 
                            }     
                    echo "</table></tbody>";
                    ?>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>