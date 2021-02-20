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
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 1200px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="../profilo/profilo.php"> Torna al profilo </a></button>

                    <h4 class="card-title mt-3 text-center">Tutte le tue conversazioni</h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <a href="visualizzazioneBiblioteca.php"><img src="../../images/library.png" alt="Avatar" class="avatar"></a>
                    </div>
                    
                    <?php
                    
                        require '../../../connectionDB/connection.php';

                        try{                            
                            $sql = "SELECT Distinct(EmailAmministratore), MAX(DataMessaggio) As DataMessaggio, Nome
                                    FROM Messaggio Join Utente on(EmailAmministratore = Email)
                                    WHERE EmailUtilizzatore = '" . $_SESSION['email-accesso'] . "'";
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
        <div id="footer"></div>
    </body>
</html>