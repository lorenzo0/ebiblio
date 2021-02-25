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
    ?>
    <header></header>
    <body style="background-color:#002a4f; color:#fff">
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
        <div class="container" style="background-color:#002a4f; color:#fff">
            <div class="card mt-4" style="border: 0; background-color:#002a4f; color:#fff">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">CERCA UN LIBRO!</h4>
                    <div class="imgcontainer">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                        <img src="../../images/ebook.png" alt="Avatar" class="avatar">
                    </div>
                    <form action="myHome.php" method="post">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default"><b>Titolo</b></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Titolo..." id="Titolo" name="Titolo">
                    </div>
                    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">ISBN</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="000-00-000000-0-0" id="Isbn" name="Isbn">
                    </div>
                    
                    <div class="input-group input-group-sm mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Autore</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="Autore" name="Autore">
                    
                        
                    
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Genere</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="Genere" name="Genere">
                    </div>

                    <div class="form-group">
                        <button type="search" name="search" id="search" class="btn btn-block cerca">Cerca</button> 
                    </div>
                    </form>
                </article>
            </div>
        </div>
        
        
        
    <div id="footer"></div>
    </body>
</html>