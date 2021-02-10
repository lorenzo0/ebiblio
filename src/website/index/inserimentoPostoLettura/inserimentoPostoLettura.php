<!DOCTYPE html>

<?php
             
    session_start();

    $dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $user, $password);  

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

?>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ebiblio - Posto Lettura</title>
	<script src="https://kit.fontawesome.com/188e218822.js"></script>
      
    <!-- Bootstrap -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
	<link href="../../css/foglioStile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">    
  </head>
    
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-verde">
          <a class="navbar-brand" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
              <a class="nav-link metalink" href="#"><img src="../../images/bookcase.png" alt="brand"/></a>

          </div>
        </nav>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserimento Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../images/postoLettura.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="inserimentoPostoLettura.php" method="post"> 
                       
                       
                     <div class="form-group">
                       <label for="utilizzatore">Scegli Biblioteca:</label> 
                          <select class="form-control" id="emailBiblioteca" name="emailBiblioteca">
                                  <?php    
                                        try {
                                        $sql = "SELECT Email FROM Biblioteca"; 
                                        $res=$pdo->query($sql);
    
                                            } catch(PDOException $e) {
                                                echo("Query SQL Failed: ".$e->getMessage());
                                                exit();
                                            }

                                             while($row = $res->fetch()) {
                                                echo "<option value=" . $row['Email'] . ">". $row['Email'] . "</option>";                                 
                                             }
                                    ?> 
                          </select>
                        </div>
                      
                    
                    <div class="form-group input-group">
                        <label for="presaCorrente">Presa Corrente</label>  
                        <input type="checkbox" class="form-control" id="presaCorrente" name="presaCorrente" value="true">
                    </div> 
                       
                
                  <div class="form-group input-group">
                    <label for="presaEthernet">Presa Ethernet</label>  
                        <input type="checkbox" class="form-control" id="presaEthernet" name="presaEthernet" value="true">
                    </div>

                       
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Inserisci Posto Lettura! </button>
                    </div>  
               </form>
                </article>
            </div> 
      
            
            <?php
            
            $presaCorrente = isset($_POST['presaCorrente']) ? $_POST['presaCorrente'] : 'false';
            $presaEthernet = isset($_POST['presaEthernet']) ? $_POST['presaEthernet'] : 'false';
    
            $emailBiblioteca= $_POST['emailBiblioteca'];

            $sql = "INSERT INTO PostoLettura (Id, EmailBiblioteca, Ethernet, Corrente) VALUES (0,'$emailBiblioteca',$presaEthernet,$presaCorrente)"; 
            
            echo $emailBiblioteca;
            echo $presaEthernet;
            echo $presaCorrente;
           
            $pdo->exec($sql); 

          ?>  
            
        </div>
        <footer class="text-center">
          <div class="container">
            <div class="row">
              <div class="col-12 pt-3">
                <p> Progetto di Basi di dati - 2020 </p>
              </div>
            </div>
          </div>
        </footer>
    </body>
</html>