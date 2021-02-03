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
	<link href="../../css/stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#header").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
      
  </head>
    
    <body>
        
        <?php 
        
            require '../../../connectionDB/connection.php';
        
            if(isset($_POST['inserisci'])){
                $sql = "UPDATE utente SET RecapitoTelefonico = '". $_POST['recapito'] ."' WHERE Email = '".$_SESSION['email-accesso']."'";
                $res = $pdo->exec($sql);
                if($res=0)
                    echo "<script> alert('Non è stato aggiornato correttamente il valore!'); window.location.href='profilo.php'; </script>";
                else
                    echo "<script> alert('Valore aggiornato correttamente!'); window.location.href='profilo.php'; </script>";
                
            }
        ?>
        
        <div id="header"></div>
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
        <div id="footer"></div>
    </body>
</html>