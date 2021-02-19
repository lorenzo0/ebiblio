<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Biblioteca</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> <script src="../../../js/script.js"></script>
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
                
            if(isset($_POST['submit'])){
                require '../../../connectionDB/connection.php';

                $nomeBiblioteca= $_POST['nomeBiblioteca'];
                $indirizzo = $_POST['indirizzo'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $recapito = $_POST['recapito'];
                $note = $_POST['note'];


                $sql = "INSERT INTO Biblioteca (Nome, Indirizzo, Email, URLSito, Latitudine, Longitudine, Recapito, Note) VALUES ('$nomeBiblioteca','$indirizzo','$email','$sito','$latitudine', '$longitudine','$recapito','$note' )";

                $res=$pdo->query($sql);

                 if ($res>0) {
                   echo "<script> alert('Biblioteca inserita correttamente!'); window.location.href='../home/home.php'; </script>";
                 } else {
                   echo "<script> alert('La biblioteca NON è stata inserita correttamente!'); window.location.href='inserimentoBiblioteca.php'; </script>";
                 }
            }

        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserirsci Biblioteca</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                    
                     
                        
                       <div class="form-group input-group">
                          <input type="text" placeholder="Nome Biblioteca" class="form-control" name="nomeBiblioteca" id="nomeBiblioteca" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="Indirizzo" class="form-control" name="indirizzo" id="indirizzo" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="email biblioteca" class="form-control" name="email" id="email" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="URL Sito" class="form-control" name="sito" id="sito" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="number" placeholder="Latitudine" class="form-control" name="latitudine" id="latitudine" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="number" placeholder="Latitudine" class="form-control" name="longitudine" id="longitudine" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="Recapito" class="form-control" name="recapito" id="recapito" required>
                       </div> 
                       
                       <div class="form-group input-group">
                          <input type="text" placeholder="Note" class="form-control" name="note" id="note" required>
                       </div> 
                       
                    
                    
                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Inserisci Biblioteca </button>
                    </div>           
               </form>
                </article>
            </div>
            

        </div>
        <div id="footer"></div>
    </body>
</html>