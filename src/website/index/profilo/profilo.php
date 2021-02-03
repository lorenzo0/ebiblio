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
        <nav class="navbar navbar-expand-lg navbar-dark bg-verde">
          <a class="navbar-brand" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
              <a class="nav-link metalink" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>

          </div>
        </nav>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">

                    <h4 class="card-title mt-3 text-center">Your profile</h4>

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
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Base di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>