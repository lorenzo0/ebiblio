<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Segnalazione</title>
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
    
    <?php
    
    require '../../../../connectionDB/connection.php';
    
        if(isset($_POST['segnalazione'])){
            $emailAmministratore = $_SESSION['email-accesso'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $nota = $_POST['note'];
            $data = date("Y/m/d");
            
            $sql = "INSERT INTO Segnalazione VALUES(0, '$emailAmministratore', '$emailUtilizzatore', '$data', '$nota')";
            $res = $pdo -> query($sql);
            
            if($res=0)
                echo "<script> alert('La segnalazione non è stata inserita correttamente, riprova!'); window.location.href='inserimentoSegnalazione.php'; </script>";
            else
               echo "<script> alert('Segnalazione inserita correttamente!'); window.location.href='../../home/homePage.php'; </script>";
        }
        
    ?>
    <header></header>
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Segnala un utente utilizzatore</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/warning.png" alt="Avatar" width="50">
                    </div>
                   <form method="post"> 
                       
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
                            <textarea class="form-control" name="note" id="note" placeholder="Inserisci qui una nota" rows="4" cols="50"></textarea>
                       </div> 
                    
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="segnalazione"> Invia Segnalazione! </button>
                        </div>
                    </form>
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
</html>