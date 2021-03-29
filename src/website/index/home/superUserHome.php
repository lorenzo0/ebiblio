<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ebiblio - Home Page Amministratore</title>
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
             }else if ($_SESSION['TipoUtente']=="Amministratore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
            }
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
                    <a href="../inserimenti/inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci Biblioteca</a>
                    <a href="../inserimenti/inserimentoAmministratore/inserimentoAmministratore.php">Inserisci Amministratore</a>
                </div>
            </div>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
        </div>
        <div>
            <div class="card" style="border: 0; width:100%">
                <article class="card-body mx-auto" style="width: 90%; background-color:#fff; color:#002a4f">
                    <h2 class="card-title mt-3 text-center">BENVENUTO IN E-BIBLIO <?php echo $_SESSION['EmailUtente']?></h2>
                    <h4 class="card-title mt-2 text-center">Come SuperUser, puoi svolgere le seguenti azioni:</h4>
                </article>
            </div>
        </div>
        <div class="card-deck" style="border: 10px; width:100%">
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/library.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoBiblioteca/inserimentoBiblioteca.php"style="color:#bb2e29">Inserisci Biblioteca</a></h5>
              <p class="card-text">Puoi inserire le biblioteche universitarie di Bologna.</p>
            </div>
          </div>
          <div class="card mb-3" >
              <img class="card-img-top rounded mx-auto d-blockr" src="../../images/users.png" style="width: 180px">
            <div class="card-body">
              <h5 class="card-title"><a href="../inserimenti/inserimentoAmministratore/inserimentoAmministratore.php" style="color:#bb2e29">Inserisci Amministratore</a></h5>
              <p class="card-text">Puoi inserire un Amministratore per una biblioteca.</p>
            </div>
          </div>
        </div>
            
    </body>
    <footer class="text-center text-white fixed-bottom" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer> 
</html>