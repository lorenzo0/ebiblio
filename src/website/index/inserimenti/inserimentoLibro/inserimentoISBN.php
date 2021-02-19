<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Ebook</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
    
    <script src="../../js/script.js"></script>
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

                $isbn = $_POST['codiceIsbn'];

                try{
                    $sql = "SELECT *
                        FROM libro
                        WHERE CodiceISBN = '$isbn'";
                    $res = $pdo -> query($sql);
                }catch(PDOException $e){echo $e->getMessage();}	

                while ($row = $res->fetch()) {
                    $tipoLibro = $row['TipoLibro'];
                }

                if($tipoLibro != ''){
                    header("location: libroPresente.php?isbn='$isbn'&tipo=$tipoLibro");
                }else
                    header("location: inserimentoLibro.php?isbn='$isbn'");
            }

        ?>
        <div id="navbar"></div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserisci il codice ISBN del Libro che vuoi aggiungere</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/ebook.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                       <div class="form-group input-group">
                                <input type="number" placeholder="codice isbn" class="form-control" name="codiceIsbn" id="codiceIsbn">
                           </div> 
                    
                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Ricerca Libro </button>
                    </div>
               </form>
                </article>
            </div>
             

        </div>
        <div id="footer"></div>
    </body>
</html>