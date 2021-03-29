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
        
            if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }else if ($_SESSION['TipoUtente']=="SuperUser"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
                 
            }
        
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
        <div class="topnav">
            <a href="../../home/adminHome.php">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php" >Inserisci Posto lettura</a>
                    <a href="nserimentoISBN.php" class="active">Inserisci libro</a>      
                </div>
            </div>
            <a href="../../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a> 
            <a href="../../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggio</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
        </div>
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
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>