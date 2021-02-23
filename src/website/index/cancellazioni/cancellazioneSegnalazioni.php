<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Cancella Segnalazione</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
    
    <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../utils/footer.html"); 
        });
   </script>
      
  </head>
    <header></header>
    <body>
        <?php
        
            require '../../../connectionDB/connection.php';
            if ($_SESSION['TipoUtente']!="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
            }
            if(isset($_POST['submit'])){
                $emailUtilizzatore = $_POST['emailUtilizzatore'];
                try{
                    $sql = "DELETE FROM segnalazione WHERE EmailUtilizzatore='$emailUtilizzatore';";
                    $res = $pdo -> query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	
                
                if($res->rowCount() > 0){
                    try{
                        $sql = "UPDATE Utilizzatore SET StatoAccount='Attivo' WHERE EmailUtente='$emailUtilizzatore';";
                        $res = $pdo -> query($sql);
                    }catch(PDOException $e){echo $e->getMessage();}
                    
                    if($res->rowCount() > 0)
                        echo "<script> alert('Stato dell'utente tornato ad Attivo!'); window.location.href='../../home/home.php'; </script>";
                    else
                        echo "<script> alert('Si è verificato un problema, riprova!'); window.location.href='cancellazioneSegnalazioni.php'; </script>";
                }
            }
        
        ?>
        <h1>DA SISTEMARE NAVBAR</h1>
        <div class="topnav">
            <a href="../../home/home.php" class="active">Home</a>
            <a href="../inserimenti/inserimentoAmministratore/inserimentoAmministratore.html">Inserisci utente</a>
            <a href="../inserimenti/inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
            <a href="../inserimenti/inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci biblioteca</a>
            <a href="../inserimenti/inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimenti/inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="../inserimenti/inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Riattiva il profilo di un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../images/bottle.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <button class="backHomePage"> <a style="color:black;" href="../home/home.php"> Torna alla lista </a></button>

                       
                       <div class="form-group input-group" id="email">
                            <select name="emailUtilizzatore" id="emailUtilizzatore" class="form-control">
                                <?php
                                    $cont = 0;
                                
                                    require '../../../connectionDB/connection.php';

                                    try{
                                        $sql = "SELECT Email, Nome, Cognome 
                                                FROM Utente 
                                                JOIN Utilizzatore on(Email = EmailUtente)
                                                WHERE StatoAccount='Sospeso'";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        $cont++;
                                        echo '<option value=' . $row['Email'] . '>' . $row['Nome'] . ' ' . $row['Cognome'] . '</option>';
                                    }

                                ?>
                            </select>
                       </div> 
                       
                       <div class="form-group">
                            <?php 
                                if($cont == 0){
                                    echo '<p style="color:red;">Nessun utente utilizzatore ha più di 3 segnalazioni!</p>';
                                    echo '<style type="text/css">
                                            #bottone { display: none; }
                                            #email { display: none; }
                                        </style>';
                                }
                            ?>
                        </div>
                       
                        <div class="form-group" id="bottone">
                            <button type="submit" class="btn btn-primary btn-block" id='submit' name='submit'> Riattiva il suo profilo! </button>
                        </div>
                    </form>
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
</html>