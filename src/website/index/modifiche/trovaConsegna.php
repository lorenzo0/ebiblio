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
        
            if(isset($_POST['ricerca'])){
                    
                try{
                    $sql = "SELECT * FROM Consegna WHERE IdConsegna = " . $_POST['codiceConsegna'];
                    $res = $pdo -> query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	
                
                while ($row = $res->fetch()) {
                    $idConsegna = $row['IdConsegna'];
                    $idPrenotazione = $row['IdPrenotazioneCartaceo'];
                    $emailV = $row['EmailVolontario'];
                    $emailU = $row['EmailUtilizzatore'];
                    $note = $row['Note'];
                    $tipo = $row['Tipo'];
                    $data = $row['DataConsegna'];
                }   
                
                if(isset($idConsegna))
                    header("Location: modificaConsegna.php?IdConsegna=$idConsegna&IdPrenotazione=$idPrenotazione&EmailV=$emailV&EmailU=$emailU&Note=$note&Tipo=$tipo&Data=$data");
                else
                    echo "<script> alert('Questa consegna non esiste!'); window.location.href='trovaConsegna.php'; </script>";
                
            }
        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci il codice di consegna che vuoi modificare</h4>
                    <div class="imgcontainer">
                        <img src="../../images/delivery.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <div class="form-group input-group">
                            <input type="number" placeholder="codice isbn" class="form-control" name="codiceConsegna" id="codiceConsegna">
                       </div> 
                    
                       <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" id='ricerca' name='ricerca'> Modifica la consegna! </button>
                       </div>
                    </form>
                </article>
            </div>
        </div>
        <div id="footer"></div>
    </body>
</html>