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
        
            try{
                $email = $_SESSION['email-accesso'];
                
                $sql = "SELECT * FROM Utente WHERE Email = '$email'";
                $res = $pdo -> query($sql);
            }catch(PDOException $e){echo $e->getMessage();}	

                while ($row = $res->fetch()) {
                    $nome = $row['Nome'];
                    $cognome = $row['Cognome'];
                    $dataNascita = $row['DataNascita'];
                    $luogoNascita = $row['LuogoNascita'];
                    $recapitoTelefonico = $row['RecapitoTelefonico'];
                }        
        ?>
        <div id="header"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">

                    <h4 class="card-title mt-3 text-center">Dettagli libro <?php echo $_GET['isbn']; ?></h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/img_avatar2.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Nome:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="nome" id="nome" value = "<?php echo $nome ?>"readonly> 
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Cognome:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="cognome" id="cognome" value = "<?php echo $cognome ?>"readonly> 
                        </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Data di nascita:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="dataNascita" value = "<?php echo $dataNascita ?>" readonly>
                            </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Luogo di nascita:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="luogoNascita" value = "<?php echo $luogoNascita ?>" readonly>
                            </div>
                    </div>
                    
                    
                    <div class="form-group row">
                       <label class="col-4 col-form-label">Recapito telefonico:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="RecapitoTelefonico" value = "<?php echo $recapitoTelefonico ?>" readonly>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-primary" href="modifica-recapito.php">Edit</a>
                            </div>
                    </div>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>