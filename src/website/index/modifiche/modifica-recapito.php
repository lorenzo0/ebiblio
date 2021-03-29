<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Ebook</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    

      
  </head>
    <header></header>
    <body>
        
        <?php 
        
            require '../../../connectionDB/connection.php';
        
            if($_SESSION['TipoUtente']=="Amministratore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }else if ($_SESSION['TipoUtente']=="SuperUser"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
            }
        
            if(isset($_POST['inserisci'])){
                $sql = "UPDATE utente SET RecapitoTelefonico = '". $_POST['recapito'] ."' WHERE Email = '".$_SESSION['EmailUtente']."'";
                $res = $pdo->query($sql);
                if($res->rowCount() > 0)
                    echo "<script> alert('Valore aggiornato correttamente!'); window.location.href='../profilo/profilo.php'; </script>";
                else
                    echo "<script> alert('Non è stato aggiornato correttamente il valore!'); window.location.href='modifica-recapito.php'; </script>";
                
            }
        ?>
        <div class="topnav">
            <a href="myHome.php">Home</a>
            <a href="../prenotazioni/prenotazionePostoLettura/controllaDisponibilitaPostoLettura.php">Prenota posto lettura</a>
            <a href="../prenotazioni/prenotazioneLibroCartaceo/controllaDisponibilitaCartaceo.php">Prenota Libro</a>            
            <a href="../visualizzazione/visualizzazioneLibri.php" >Visualizza EBook</a>
            <a href="../profilo/conversazioni.php">Conversazioni</a>
             <a href="../profilo/prenotazioniEffettuate.php">Prenotazioni</a>
            <a href="../profilo/visualizzazioneSegnalazioni.php" >Segnalazioni</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
            
        </div>
        
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Aggiorna i dati del tuo profilo</h4>
                    <div class="imgcontainer">
                        <img src="../../images/phone-call.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       <div class="form-group input-group">
                        <input type="text" placeholder="Inserisci il tuo numero di telefono" class="form-control" name="recapito" id="recapito" required>
                    </div> 
                       
                       <div class="form-group input-group">
                            <button type="submit" class="btn btn-primary btn-block" name="inserisci"> Aggiorna il tuo recapito! </button>
                       </div>
                   </form>
                </article>
            </div>
        </div>
        
    <footer class="text-center text-white fixed-bottom" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
    </body>
</html>