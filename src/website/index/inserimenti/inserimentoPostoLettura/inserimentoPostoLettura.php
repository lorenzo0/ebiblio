<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Posto Lettura</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
    
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
         <?php 
            require '../../../../connectionDB/connection.php'
            /*if ($_SESSION['TipoUtente']!="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>"; 
            }*/
        ;?>
         <div class="topnav">
            <a href="../../home/home.php">Home</a>
            <a href="../inserimentoAmministratore/inserimentoAmministratore.html">Inserisci utente</a>
            <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
            <a href="../inserimentoBiblioteca/inserimentoBiblioteca.php" >Inserisci biblioteca</a>
            <a href="inserimentoPostoLettura.php" class="active">Posto lettura</a>
            <a href="../inserimentoLibro/inserimentoLibro.php">Inserisci libro</a>            
            <a href="../inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a>  
            <a href="inserimentoMessaggio.php" >Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserimento Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/desk.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                     <div class="form-group">
                       <label for="utilizzatore">Scegli Biblioteca:</label> 
                          <select class="form-control" id="nomeBiblioteca" name="nomeBiblioteca">
                                  <?php    
                                        try {
                                            $sql = "SELECT Nome FROM Biblioteca"; 
                                            $res=$pdo->query($sql);
    
                                        } catch(PDOException $e) {
                                            echo("Query SQL Failed: ".$e->getMessage());
                                            exit();
                                        }

                                         while($row = $res->fetch()) {
                                            echo "<option value=" . $row['Nome'] . ">". $row['Nome'] . "</option>";                                 
                                         }
                                    ?> 
                          </select>
                        </div>
                      
                    
                    <div class="form-group input-group">
                        <label for="presaCorrente">Presa Corrente</label>  
                        <input type="checkbox" class="form-control" id="presaCorrente" name="presaCorrente" value=1>
                    </div> 
                       
                
                  <div class="form-group input-group">
                    <label for="presaEthernet">Presa Ethernet</label>  
                        <input type="checkbox" class="form-control" id="presaEthernet" name="presaEthernet" value=1>
                    </div>

                       
                    <div class="form-group">
                        <button type="submit" name='inserisci' id='inserisci' class="btn btn-primary btn-block"> Inserisci Posto Lettura! </button>
                    </div>  
               </form>
                </article>
            </div> 
      
            
            <?php
            
            
            
            if(isset($_POST['inserisci'])){
            
                $presaCorrente = isset($_POST['presaCorrente']) ? $_POST['presaCorrente'] : 0;
                $presaEthernet = isset($_POST['presaEthernet']) ? $_POST['presaEthernet'] : 0;

                $nomeBiblioteca= $_POST['nomeBiblioteca'];
                $id = 0;

                $sql = $pdo->prepare("INSERT INTO PostoLettura VALUES(?, ?, ?, ?)");
                $sql->bindParam(1, $id, PDO::PARAM_INT);
                $sql->bindParam(2, $nomeBiblioteca, PDO::PARAM_STR);
                $sql->bindParam(3, $presaEthernet, PDO::PARAM_INT);
                $sql->bindParam(4, $presaCorrente, PDO::PARAM_INT);
                $res = $sql->execute();
                
                if($res>0)
                    echo "<script> alert('Posto lettura inserito correttamente!'); window.location.href='../../visualizzazione/visualizzazionePostiLettura.php'; </script>";
                else
                    echo "<script> alert('Posto lettura NON è stato inserito!'); window.location.href='inserimentoPostoLettura.php'; </script>";
            }

          ?>  
            
        </div>
        
        <div id="footer"></div>
    </body>
</html>