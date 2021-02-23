<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
      
      <script>
        $(function loadNavFoo(){
          $("#navbar").load("../../utils/navbar.html"); 
          $("#footer").load("../../utils/footer.html"); 
        });
    </script>
      
  </head>
    <header></header>
    <body>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Prenotazione Libro Cartaceo</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="mostraSceltaCartaceo.php" method="post"> 
                       
                       <div class="form-group input-group">
                            <input type="number" placeholder="Codice ISBN libro" class="form-control" name="Isbn" id="Isbn">
                       </div> 
                       
                       <div class="form-group input-group">
                            <input type="text" placeholder="Titolo libro" class="form-control" name="Titolo" id="Titolo" required>
                       </div> 
                       
                       
                       <label> Seleziona il genere del libro </label>
                       <div class="form-group input-group">
                            <select name="Genere" id="Genere" class="form-control" required>
                                <?php
                                
                                    require '../../../../connectionDB/connection.php';   

                                    try{
                                        $sql = "SELECT Distinct(Genere) FROM Libro";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Genere'] . '>' . $row['Genere'] . '</option>';
                                    }

                                ?>
                            </select>
                       </div> 
                       
                        <div class="form-group input-group">
                            <label> Hai una biblioteca in particolare dove vorresti cercare il libro?</label>
                            <select name="Biblioteca" id="Biblioteca" class="form-control" >
                                <option value='none'> ----- </option>
                                <?php

                                    try{
                                        $sql = "SELECT Nome FROM Biblioteca";
                                        $res = $pdo -> query($sql);
                                    }catch(PDOException $e){echo $e->getMessage();}	

                                    while ($row = $res->fetch()) {
                                        echo '<option value=' . $row['Nome'] . '>' . $row['Nome'] . '</option>';
                                    }

                                ?>
                            </select>
                        </div>
                       
                       <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Vedi la disponibilità! </button>
                       </div>  
                   </form>   
                   
                </article>
            </div>
        </div>
        <div id="footer"></div>
    </body>
</html>
