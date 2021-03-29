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
            
            if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="SuperUser"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }else if ($_SESSION['TipoUtente']=="Amministratore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
            }
            $tipoUtente= $_SESSION['TipoUtente'];
            $emailUtente = $_SESSION['EmailUtente'];
        
    ?>
    <header></header>
    <body>
        <div class="topnav">
            <a href="myHome.php" class="active">Home</a>
            <a href="../inserimenti/inserimentoConsegna/consegna.php">Consegne</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
            
        </div>
        
        <div>
            <div class="card" style="border: 0; width:100%">
                <article class="card-body mx-auto" style="width: 90%; background-color:#fff; color:#002a4f">
                    <h2 class="card-title mt-3 text-center">BENVENUTO IN E-BIBLIO <?php echo $_SESSION['EmailUtente']?></h2>
                    <h4 class="card-title mt-2 text-center">Come Utente Volontario, puoi svolgere le seguenti azioni:</h4>
                </article>
            </div>
        </div>
        <div class="card-deck" style="border: 10px; width:100%">
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/logoEBiblio.png" style="width: 160px">
            <div class="card-body">
              <h5 class="card-title"><a href="../visualizzazione/visualizzazioneLibri.php" style="color:#bb2e29">Visualizza Libri</a></h5>
              <p class="card-text">Puoi visualizzare tutti i libri presenti all'interno della tua biblioteca e visualizzarne i dettagli.</p>
            </div>
          </div>
          <div class="card mb-3 text-right" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/delivery.png" style="width: 180px" >
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoConsegna/consegna.php" style="color:#bb2e29">Inserisci Consegna</a></h5>
              <p class="card-text">Puoi inserire la consegna che vuoi effettuare, in base all'utilizzatore e al tipo di consegna.</p>
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