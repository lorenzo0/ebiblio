<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> 
      
    <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
   </script>
  </head>
    <header></header>
    <body>
        <?php
            require '../../../../connectionDB/connection.php';
        
            if(isset($_POST['submit'])){
                $nomeUtente= $_POST['nomeUtente'];
                $cognomeUtente = $_POST['cognomeUtente'];
                $emailUtente = $_POST['emailUtente'];
                $password = $_POST['password'];
                $password = md5($password);
                $dataNascita= $_POST['dataNascita'];
                $luogoNascita = $_POST['luogoNascita'];
                $recapito = $_POST['recapito'];
                $qualifica = $_POST['qualifica'];

                $sql = "INSERT INTO Utente (Email, Nome, Cognome, PasswordUtente, DataNascita, LuogoNascita, RecapitoTelefonico, TipoUtente) VALUES ('$emailUtente','$nomeUtente','$cognomeUtente','$password','$dataNascita','$luogoNascita', '$recapito', 'Amministratore')";

                $res= $pdo->query($sql);

                if($res->rowCount() > 0){
                    try{
                         $sql1 = "INSERT INTO Amministratore (EmailUtente, Qualifica) VALUES ('$emailUtente', '$qualifica')";
                         $res = $pdo->query($sql1);    
                    } catch(PDOException $e) {
                        echo($e->getMesssage());	
                        exit();	
                    } 

                    if($res>0)
                        echo "<script> alert('Amministratore inserito correttamente'); window.location.href='../../login/login.html'; </script>";
                    else
                        echo "<script> alert('L'amministratore NON è stato inserito correttamente'); window.location.href='inserimentoAmministratore.html'; </script>";
                }
            }

        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserirsci Utente</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/users.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                    
                       <div class="form-group input-group">
                          <input type="text" placeholder="nome" class="form-control" name="nomeUtente" id="nomeUtente" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="cognome" class="form-control" name="cognomeUtente" id="cognomeUtente" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="email" class="form-control" name="emailUtente" id="emailUtente" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="password" placeholder="password (6 caratteri minimo)" class="form-control" name="password" id="password" minlength="6" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="date" placeholder="data nascita" class="form-control" name="dataNascita" id="dataNascita" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="luogo nascita" class="form-control" name="luogoNascita" id="luogoNascita" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="Recapito" class="form-control" name="recapito" id="recapito" required>
                       </div> 
                       
                       <div class="form-group input-group">
                          <input type="text" placeholder="Qualifica" class="form-control" name="qualifica" id="qualifica" required>
                       </div> 

                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Crea Utente </button>
                    </div>           
               </form>
                </article>
            </div>
        </div>
        <div id="footer"></div>
        
    </body>
</html>