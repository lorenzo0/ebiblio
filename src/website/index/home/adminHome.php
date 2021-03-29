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
          $("#footer").load("../utils/footer.html"); 
        });
      </script>
      
  </head>
    <?php
            require '../../../connectionDB/connection.php';
            
            $tipoUtente= $_SESSION['TipoUtente'];
            $emailUtente = $_SESSION['EmailUtente'];
            if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }
    
            try{
                $sql = "SELECT NomeBibliotecaAmministrata FROM amministratore WHERE EmailUtente = '$emailUtente'";
                $res = $pdo->query($sql); 
                $row = $res->fetch();
                $nomeBiblio = $row['NomeBibliotecaAmministrata'];
            }catch(PDOException $e){ echo("Query SQL Failed: ".$e->getMessage());
                                            exit();}
    ?>
    <header></header>
    <body>
        <div class="topnav">
            <a href="adminHome.php" class="active">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimenti/inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="../inserimenti/inserimentoPostoLettura/inserimentoPostoLettura.php">Inserisci Posto lettura</a>
                    <a href="../inserimenti/inserimentoLibro/inserimentoISBN.php">Inserisci libro</a>      
                </div>
            </div>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a> 
            <a href="../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimenti/inserimentoMessaggio/inserimentoMessaggio.php">Messaggio</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
        </div>
        <div>
            <div class="card" style="border: 0; width:100%">
                <article class="card-body mx-auto" style="width: 90%; background-color:#fff; color:#002a4f">
                    <h2 class="card-title mt-3 text-center">BENVENUTO IN E-BIBLIO <?php echo $emailUtente;?></h2>
                    <h4 class="card-title mt-2 text-center">Come Utente Amministratore di <?php echo $nomeBiblio;?>, puoi svolgere le seguenti azioni:</h4>
                </article>
            </div>
        </div>
        <div class="card-deck" style="border: 10px; width:100%">
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/writer.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoAutore/inserimentoAutore.php"style="color:#bb2e29">Inserisci Autore</a></h5>
              <p class="card-text">Puoi inserire gli autori che non risultano presenti nel data base prima di inserire un libro.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/book.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoLibro/inserimentoISBN.php" style="color:#bb2e29">Inserisci Libro</a></h5>
              <p class="card-text">Puoi inserire un libro sia in formato cartaceo che in formato E-Book con lo stesso codice ISBN, oppure aggiungere una copia cartacea.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/desk.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoPostoLettura/inserimentoPostoLettura.php" style="color:#bb2e29">Inserisci Posto Lettura</a></h5>
              <p class="card-text">Puoi inserire un posto lettura disponibile all'interno della tua biblioteca, specificando se sono presenti le prese corrente o quelle ethernet.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/logoEBiblio.png" style="width: 160px">
            <div class="card-body">
              <h5 class="card-title"><a href="../visualizzazione/visualizzazioneLibri.php" style="color:#bb2e29">Visualizza Libri</a></h5>
              <p class="card-text">Puoi visualizzare tutti i libri presenti all'interno della tua biblioteca, visualizzarne i dettagli e cancellarli. </p>
            </div>
          </div>
        </div>
        <div class="card-deck" style="border: 10px; width:100%">
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/warning.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php" style="color:#bb2e29">Inserisci Segnalazione</a></h5>
              <p class="card-text">Se noti un comportamento errato puoi segnalare l'utente che lo ha commesso, dopo tre segnalazioni l'utente viene bloccato.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/users.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../cancellazioni/cancellazioneSegnalazioni.php" style="color:#bb2e29">Cancella Segnalazioni</a></h5>
              <p class="card-text">Hai la possibilità di rimuovere le segnalazioni ricevute da un utente e quindi di riattivare il suo profilo.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/chat.png" style="width: 180px" >
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoMessaggio/inserimentoMessaggio.php" style="color:#bb2e29">Inserisci Messaggio</a></h5>
              <p class="card-text">Puoi inserire un messaggio da inviare ad un utente utilizzatore della piattaforma.</p>
            </div>
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