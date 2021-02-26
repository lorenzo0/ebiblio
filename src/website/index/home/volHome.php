<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ebiblio - Home Page Volontario</title>
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
    <body>
        <div class="topnav">
            <a href="myHome.php" class="active">Home</a>
            <a href="../inserimenti/inserimentoConsegna/consegna.php">Consegne</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
            
        </div>
        
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">BENVENUTO VOLONTARIO!</h4>
                </article>
            </div>
        </div>
        
    <div id="footer"></div>
    </body>
</html>