<?php
    require '../../../../connectionDB/connection.php';

     /*if ($_SESSION['TipoUtente']!="Amministratore"){
        echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
    }*/

    if(isset($_POST['submit'])){
        $mod = $_POST['mod'];        
        $emailUtente = $_SESSION['EmailUtente'];
        
        $sql = "SELECT NomeBibliotecaAmministrata FROM Amministratore WHERE EmailUtente = '$emailUtente' ";
        $res = $pdo -> query($sql);
        
        while ($row = $res->fetch()) {
            $nomeBiblioteca = $row['NomeBibliotecaAmministrata'];
        }  

        if($mod == 'foto')
            header("Location: inserimentoFotoBiblioteca.php?nome=$nomeBiblioteca");
        else
            header("Location: inserimentoRecapitiBiblioteca.php?nome=$nomeBiblioteca");
        
    }

?>



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
          $("#footer").load("../../utils/footer.html"); 
        });
   </script>
  </head>
    <header></header>
    <body>
        <div class="topnav">
            <a href="../../home/home.php">Home</a>
            <a href="inserimentoAmministratore.html" class="active">Inserisci utente</a>
            <a href="../inserimentoAutore/inserimentoAmministratore.html">Inserisci autore</a>
            <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php">Inserisci biblioteca</a>
            <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Cosa vuoi modificare?</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/users.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post">
                       
                       <label> Che tipo di aggiunta vuoi fare? </label>
                        <div class="form-group input-group">
                            <select name="mod" id="mod" class="form-control" required>
                                <option value="foto" selected> Foto </option>
                                <option value="recapiti"> Recapiti </option>
                            </select>
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