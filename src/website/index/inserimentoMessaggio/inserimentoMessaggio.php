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
      
    <!-- Script JS -->
    <script src="../../js/script.js"></script>
      
  </head>
    
    <?php
    
    require '../../../connectionDB/connection.php';
    
        if(isset($_POST['messaggioButton'])){
            $emailAmministratore = $_SESSION['email-accesso'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $titolo = $_POST['titolo'];
            $messaggio = $_POST['messaggio'];
            $nota = $_POST['note'];
            $data = date("Y-m-d");
            
            $sql = "INSERT INTO Messaggio VALUES(0, '$emailAmministratore', '$emailUtilizzatore', '$data', '$titolo', '$messaggio')";
            $res = $pdo -> exec($sql);
            
            if($res==0)
                echo "<script> alert('Il messaggio non è stato inserito correttamente, riprova!'); window.location.href='inserimentoMessaggio.php'; </script>";
            else
               echo "<script> alert('Messaggio inserito correttamente!'); window.location.href='../home/homePage.php'; </script>";
        }
        
    ?>
    
    <body>
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
                    <h4 class="card-title mt-3 text-center">Invia un messaggio ad un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../images/bottle.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <div class="form-group input-group">
                            <input type=”text” class="form-control" name="titolo" id="titolo" placeholder='Inserisci il titolo del tuo messaggio' required> 
                       </div> 
                       
                       <div class="form-group input-group">
                            <select name="emailUtilizzatore" id="emailUtilizzatore" class="form-control">
                                <?php

                                    try{
                                        $sql = "SELECT Email, Nome, Cognome FROM Utente WHERE tipoUtente = 'Utilizzatore'";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Email'] . '>' . $row['Nome'] . ' ' . $row['Cognome'] . '</option>';
                                    }

                                ?>
                            </select>

                       </div> 
                       
                       <div class="form-group input-group">
                            <textarea class="form-control" name="messaggio" id="messaggio" placeholder="Inserisci qui il tuo messaggio" rows="4" cols="50" required></textarea>
                       </div> 
                       
                       <div class="form-group input-group">
                            <input type=”text” class="form-control" name="note" id="note" placeholder='Inserisci una nota'> 
                       </div> 
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="messaggioButton"> Invia il messaggio! </button>
                        </div>
                    </form>
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