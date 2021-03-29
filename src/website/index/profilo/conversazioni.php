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
            <a href="../home/myHome.php">Home</a>
            <a href="../prenotazioni/prenotazionePostoLettura/controllaDisponibilitaPostoLettura.php">Prenota posto lettura</a>
            <a href="../prenotazioni/prenotazioneLibroCartaceo/controllaDisponibilitaCartaceo.php">Prenota Libro</a>            
            <a href="../visualizzazione/visualizzazioneLibri.php" >Visualizza EBook</a>
            <a href="conversazioni.php"class="active">Conversazioni</a>
             <a href="../profilo/prenotazioniEffettuate.php">Prenotazioni</a>
            <a href="../profilo/visualizzazioneSegnalazioni.php" >Segnalazioni</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:#fff;" href="../profilo/profilo.php"> Torna al profilo </a></button>

                    <h4 class="card-title mt-3 text-center">Tutte le tue conversazioni</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{                            
                            $sql = "SELECT Distinct(EmailAmministratore), MAX(DataMessaggio) As DataMessaggio, Nome
                                    FROM Messaggio Join Utente on(EmailAmministratore = Email)
                                    WHERE EmailUtilizzatore = '" . $_SESSION['EmailUtente'] . "'";
                            $res = $pdo -> query($sql);
                            
                        }catch(PDOException $e){echo $e->getMessage();}
                    

                        echo " 
                              <table>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Amministratore</th> 
                                        <th>Data ultimo messaggio ricevuto</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>";
                    
                            while ($row = $res->fetch()) {
                                $emailAmministratore = $row['EmailAmministratore'];
                                $data = $row['DataMessaggio'];
                                $nomeAmm = $row['Nome'];
                                
                                echo "<tr>"; 
                                echo "<td><img src=" . "../../images/book.png" . " alt=" . "Book" . " class=" . "avatarTableBiblio" . "></td>";
                                echo "<td>" . $emailAmministratore . "</td>";
                                echo "<td>" . $data . "</td>";
                                echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='dettaglioConversazione.php?Amministratore=" . "$emailAmministratore" . "&NomeAmm=" . $nomeAmm . "'" . "> Visualizza la chat </button></td>";
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