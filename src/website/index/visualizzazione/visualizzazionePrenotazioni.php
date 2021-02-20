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
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
        <?php 
        
            require '../../../connectionDB/connection.php';
                                    
            $_SESSION['email-accesso'] = 'emailAMM1@gmail.it';

            try {
                $sql = "SELECT NomeBibliotecaAmministrata
                        FROM Amministratore 
                        WHERE EmailUtente = '" . $_SESSION['email-accesso'] . "'";
                $res=$pdo->query($sql);
            }catch(PDOException $e) {
                echo("Query SQL Failed: ".$e->getMessage());
                exit();
            }

            while($row=$res->fetch()) {
                $nomeBiblioteca = $row['NomeBibliotecaAmministrata'];
            }
        
        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="../home/home.php"> Torna alla homepage </a></button>

                    <h4 class="card-title mt-3 text-center">Tutte le prenotazioni</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/book.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <div class="filters">
                        <center>
                        <form method="post">
                            
                                <select id="filterEmailUtilizzatore" name="filterEmailUtilizzatore" style="margin-right: 10px;">
                                    <option value='none' selected>Email utilizzatore</option> 
                                   <?php 
                                        
                                        try {
                                            $sql = "SELECT P.EmailUtilizzatore
                                                    FROM PrenotazioneCartaceo AS P
                                                    JOIN Biblioteca AS B ON (P.NomeBiblioteca = B.Nome)
                                                    WHERE NomeBiblioteca = '$nomeBiblioteca'
                                                    GROUP BY P.EmailUtilizzatore;";
                                            $res=$pdo->query($sql);
                                        }catch(PDOException $e) {
                                            echo("Query SQL Failed: ".$e->getMessage());
                                            exit();
                                        }

                                        while($row=$res->fetch()) {
                                            echo "<option value='" . $row['EmailUtilizzatore'] . "'>" . $row['EmailUtilizzatore'] . "</option>";
                                            //echo "<option value='> --- </option>";
                                        }

                                    ?>
                                </select>
                            
                             <button type="submit" name="filter" style="background-color:#7ABB3B;"> Filtra! </button>
                            
                        </form>
                        </center>
                    </div>
                    
                    <?php

                        try{
                            
                            if(isset($_POST['filter']) && $_POST['filterEmailUtilizzatore'] != 'none'){
                                
                                $emailUtilizzatore = $_POST['filterEmailUtilizzatore'];

                                $sql = "SELECT P.IdPrenotazioneCartaceo, U.Nome, U.Cognome, Count(P.IdPrenotazioneCartaceo) AS Libri
                                        FROM PrenotazioneCartaceo AS P
                                        JOIN Utente AS U ON (P.EmailUtilizzatore = U.Email)
                                        WHERE P.EmailUtilizzatore = '$emailUtilizzatore'
                                        AND NomeBiblioteca = '$nomeBiblioteca'
                                        GROUP BY P.IdPrenotazioneCartaceo;";
                                
                                $res = $pdo -> query($sql);
                            }else{
                            
                                $sql = "SELECT P.IdPrenotazioneCartaceo, U.Nome, U.Cognome, Count(P.IdPrenotazioneCartaceo) AS Libri
                                        FROM PrenotazioneCartaceo AS P
                                        JOIN Utente AS U ON (P.EmailUtilizzatore = U.Email)
                                        WHERE NomeBiblioteca = '$nomeBiblioteca'
                                        GROUP BY P.IdPrenotazioneCartaceo;";
                                $res = $pdo -> query($sql);
                            }
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id prenotazione</th> 
                                    <th>Utente utilizzatore</th> 
                                    <th>Numero Libri</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                    

                            while ($row = $res->fetch()) {
                                $idPrenotazione = $row['IdPrenotazioneCartaceo'];
                                $nome = $row['Nome'];
                                $cognome = $row['Cognome'];
                                $numLibri = $row['Libri'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/inserimentoCartaceo.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $idPrenotazione . "</td>";
                                echo "<td>" . $nome . " " . $cognome . "</td>";
                                echo "<td>" . $numLibri . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='dettagliPrenotazione.php?Id=" . $idPrenotazione . "'" . "> Dettagli </button></td>";
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

