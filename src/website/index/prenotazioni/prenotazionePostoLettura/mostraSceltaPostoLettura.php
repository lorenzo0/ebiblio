<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
      
    <script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">  
      
    <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>

  </head>
    <header></header>
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="controllaDisponibilitaPostoLettura.php"> Torna alla ricerca </a></button>

                    <h4 class="card-title mt-3 text-center">Posti lettura a disposizione</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../../connectionDB/connection.php';
                    
                        if(isset($_POST['Ethernet']) &&($_POST['Ethernet']=='yes')) $ethernet = 1; else $ethernet = 0;
                        if(isset($_POST['Power']) && ($_POST['Power']=='yes')) $corrente = 1; else $corrente = 0;
                    
                        $data = $_POST['Data'];
                        $oraInizio = intval($_POST['OraInizio']);
                        $durata = intval($_POST['Durata']);
                        $oraFine = $oraInizio + $durata;
                    

                        try{
                            
                            if($_POST['Biblioteca'] != 'none'){ 
                                $nome = $_POST['Biblioteca'];
                                $sql = "SELECT NomeBiblioteca, Id, Ethernet, Corrente
                                        FROM PostoLettura 
                                        WHERE Ethernet=$ethernet AND Corrente=$corrente
                                        AND Id NOT IN (SELECT IdPostoLettura 
                                                         FROM PrenotazionePostoLettura 
                                                         JOIN PostoLettura ON (IdPostoLettura = Id) 
                                                         WHERE OraFine BETWEEN '" . $oraInizio . ":00:00' and '" . $oraFine . ":00:00'
                                                         AND DataPrenotazione = '$data' AND NomeBiblioteca = '$nome')";
                             }else{
                                $sql = "SELECT NomeBiblioteca, Id, Ethernet, Corrente
                                        FROM PostoLettura 
                                        WHERE Ethernet=$ethernet AND Corrente=$corrente
                                        AND Id NOT IN (SELECT IdPostoLettura 
                                                         FROM PrenotazionePostoLettura 
                                                         JOIN PostoLettura ON (IdPostoLettura = Id) 
                                                         WHERE OraFine BETWEEN '" . $oraInizio . ":00:00' and '" . $oraFine . ":00:00'
                                                         AND DataPrenotazione = '$data');";
                            }
                            
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}

                    echo " 
                          <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome Biblioteca</th> 
                                    <th>Ora inizio</th> 
                                    <th>Ora fine</th>
                                    <th>Ethernet</th>
                                    <th>Corrente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>";
                    

                            while ($row = $res->fetch()) {
                                $nomeBiblioteca = $row['NomeBiblioteca'];
                                $idPL = $row['Id'];
                                $ethernetTrovato = $row['Ethernet'];
                                $correnteTrovato = $row['Corrente'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../../images/desk.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $nomeBiblioteca . "</td>";
                                echo "<td>" . $oraInizio . "</td>";
                                echo "<td>" . $oraFine . "</td>";
                                echo "<td>";
                                    if($ethernet=1) echo 'Disponibile'; else echo 'Non disponibile';
                                echo "</td>";
                                echo "<td>";
                                    if($corrente=1) echo 'Disponibile'; else echo 'Non disponibile';
                                echo "</td>";
                                echo "<td>" . "<button style='background-color: #7ABB3B;'class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='prenotaPostoLettura.php?Id=" . "$idPL" . "&Inizio=" . $oraInizio . "&Fine=" . $oraFine . "&Data=" . $data . "'" . "> Prenota! </button></td>";
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