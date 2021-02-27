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
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
      

    <script src="../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#navbar").load("../utils/navbar.html"); 
          $("#footer").load("../utils/footer.html"); 
        });
    </script>
  </head>
    
    <header></header>
    <body>
        
        <?php
            require '../../../connectionDB/connection.php';
        
            $isbn = $_GET['Isbn'];
        
            try{
                
                    $sql = "UPDATE Ebook SET NumeroAccessi = NumeroAccessi + 1 WHERE codiceISBN = $isbn";
                    $res = $pdo -> query($sql);
                
                    $sql = "SELECT * FROM Ebook WHERE codiceISBN = $isbn";
                    $res = $pdo -> query($sql);
                
                    ob_end_clean();
                
                    header("Content-Type: application/pdf");
                     
                    while($row = $res -> fetch()){
                        $contenuto = $row['pdf'];
                    }
                    echo $contenuto;
            }catch(PDOException $e){echo $e->getMessage();}	
        ?>
        <div class="topnav">
            <a href="../home/home.php" >Home</a>
            <a href="../../openStreetMap/map.html">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php" >Tutte le biblioteche</a>
            <a href="visualizzazioneLibri.php" class="active">Tutti i libri</a>
            
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>   
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 800px;">
                    
                    <button class="backHomePage"> <a style="color:black;" href="visualizzazioneLibri.php"> Torna alla lista </a></button>

                    <h4 class="card-title mt-3 text-center">Dettagli libro - <?php echo $titolo; ?></h4>

                    <div class="imgcontainer" style="margin-bottom: 50px;">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-4 col-form-label">Titolo:</label>
                        <div class="col-7">
                            <input type=”text” class="form-control" name="nome" id="nome" value = "<?php echo $titolo ?>"readonly> 
                        </div>
                    </div>
                    
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>