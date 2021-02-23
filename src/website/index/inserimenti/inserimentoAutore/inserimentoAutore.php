<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Autore</title>
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
             if ($_SESSION['TipoUtente']!="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";                
            }
        
            if(isset($_POST['submit'])){

                $nomeAutore = $_POST['nomeAutore'];
                $id = 0;

                $sql = $pdo->prepare("INSERT INTO Autore VALUES (?,?)");
                $sql->bindParam(1, $id, PDO::PARAM_INT);
                $sql->bindParam(2, $nomeAutore, PDO::PARAM_STR);
                
                $res = $sql->execute();

                if($res > 0)
                    echo "<script> alert('Autore inserito correttamente'); window.location.href='../../home/home.php'; </script>";
                else
                    echo "<script> alert('L'amministratore NON è stato inserito correttamente'); window.location.href='inserimentoAmministratore.php'; </script>";
            }

        ?>
        <div class="topnav">
            <a href="../../home/home.php">Home</a>
            <a href="../inserimenti/inserimentoAmministratore/inserimentoAmministratore.html">Inserisci utente</a>
            <a href="inserimentoAutore.php" class="active">Inserisci autore</a>
            <a href="../inserimenti/inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci biblioteca</a>
            <a href="../inserimenti/inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimenti/inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="../inserimenti/inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserirsci Autore</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/writer.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                    
                        <input type="text" placeholder="Nome Autore" class="form-control" name="nomeAutore" id="nomeAutore" required>
                       
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name='submit' id='submit'> Inserisci Autore </button>
                    </div>           
               </form>
                </article>
            </div>
        </div>
        <div id="footer"></div>
    </body>
</html>