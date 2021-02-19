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
        <div id="navbar"></div>        
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">Inserimento Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/desk.png" alt="Avatar" class="avatar">
                    </div>
                   <form action="inserimentoPostoLettura.php" method="post"> 
                       
                       
                     <div class="form-group">
                       <label for="utilizzatore">Scegli Biblioteca:</label> 
                          <select class="form-control" id="nomeBiblioteca" name="nomeBiblioteca">
                                  <?php    
                                        require '../../../../connectionDB/connection.php';
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
                        <input type="checkbox" class="form-control" id="presaCorrente" name="presaCorrente" value="true">
                    </div> 
                       
                
                  <div class="form-group input-group">
                    <label for="presaEthernet">Presa Ethernet</label>  
                        <input type="checkbox" class="form-control" id="presaEthernet" name="presaEthernet" value="true">
                    </div>

                       
                    <div class="form-group">
                        <button type="submit" name='inserisci' id='inserisci' class="btn btn-primary btn-block"> Inserisci Posto Lettura! </button>
                    </div>  
               </form>
                </article>
            </div> 
      
            
            <?php
            
            if(isset($_POST['inserisci'])){
            
                $presaCorrente = isset($_POST['presaCorrente']) ? $_POST['presaCorrente'] : 'false';
                $presaEthernet = isset($_POST['presaEthernet']) ? $_POST['presaEthernet'] : 'false';

                $nomeBiblioteca= $_POST['nomeBiblioteca'];

                $sql = "INSERT INTO PostoLettura (Id, NomeBiblioteca, Ethernet, Corrente) VALUES (0,'$nomeBiblioteca',$presaEthernet,$presaCorrente)"; 
                $res=$pdo->query($sql);
                
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