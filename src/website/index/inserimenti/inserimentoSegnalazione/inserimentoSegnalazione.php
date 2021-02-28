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
    
    <?php
    
        require '../../../../connectionDB/connection.php';
        /*if ($_SESSION['TipoUtente']!="Amministratore"){
            echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>"; 
        }*/
    
        if(isset($_POST['segnalazione'])){
            $emailAmministratore = $_SESSION['EmailUtente'];
            $emailUtilizzatore = $_POST['emailUtilizzatore'];
            $nota = $_POST['note'];
            $data = date("Y/m/d");
            $id = 0;
            
            $sql = $pdo->prepare("INSERT INTO Segnalazione VALUES (?, ?, ?, ?, ?)");
            
            $sql->bindParam(1, $id, PDO::PARAM_INT);
            $sql->bindParam(2, $emailAmministratore, PDO::PARAM_STR);
            $sql->bindParam(3, $emailUtilizzatore, PDO::PARAM_STR);
            $sql->bindParam(4, $data, PDO::PARAM_STR);
            $sql->bindParam(5, $nota, PDO::PARAM_STR);
            $res = $sql->execute();
            
            if($res > 0)
               echo "<script> alert('Segnalazione inserita correttamente!'); window.location.href='../../home/home.php'; </script>";
            else
                echo "<script> alert('La segnalazione non è stata inserita correttamente, riprova!'); window.location.href='inserimentoSegnalazione.php'; </script>";
        }
        
    ?>
    <body>
        <div class="topnav">
            <a href="../../home/home.php">Home</a>
            <a href="../inserimentoAmministratore/inserimentoAmministratore.html">Inserisci utente</a>
            <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
            <a href="inserimentoBiblioteca.php" >Inserisci biblioteca</a>
            <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
            <a href="../inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="inserimentoSegnalazione.php class="active"">Nuova segnalazione</a>  
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
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