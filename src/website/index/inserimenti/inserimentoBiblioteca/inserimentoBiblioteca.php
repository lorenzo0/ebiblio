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
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet"> <script src="../../../js/script.js"></script>
    <script>
        $(function loadNavFoo(){
          $("#footer").load("../../utils/footer.html"); 
        });
        
        $(document).ready(function(){  
              var i=1;  
              $('#aggiungi').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="number" placeholder="Recapito telefonico" class="form-control" name="recapito[]" id="recapito[]"></td>  <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });  
         });
        
        $(document).ready(function(){  
              var i=1;  
              $('#aggiungi_2').click(function(){  
                   i++;  
                   $('#dynamic_field_2').append('<tr id="row'+i+'"><td><input type="file" class="form-control" name="foto[]" id="foto[]"></td>  <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              });  
         });
   </script>  
  </head>
    <header></header>
    <body>
        <?php
             require '../../../../connectionDB/connection.php';
            require '../../../../connectionDB/connectionMongo.php';
            
            if($_SESSION['TipoUtente']=="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/adminHome.php'</script>";
            }else if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
            }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
            }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
            }
        
            if(isset($_POST['submit'])){
    
                $nomeBiblioteca= $_POST['nomeBiblioteca'];
                $indirizzo = $_POST['indirizzo'];
                $email = $_POST['email'];
                $sito = $_POST['sito'];
                $latitudine = $_POST['latitudine'];
                $longitudine = $_POST['longitudine'];
                $recapito = $_POST['recapito'];
                $note = $_POST['note'];
                $foto = $_POST['foto'];
                
                for($i=0; $i<count($foto); $i++){
                    for($y=$i+1; $y<(count($foto)-$i); $y++){
                        if($foto[$i] == $foto[$y])
                            unset($foto[$y]);
                    }
                  }
                
                for($i=0; $i<count($recapito); $i++){
                    for($y=$i+1; $y<(count($recapito)-$i); $y++){
                        if($recapito[$i] == $recapito[$y])
                            unset($recapito[$y]);
                    }
                  }


                try{
                    $sql = $pdo->prepare("INSERT INTO Biblioteca VALUES (?, ?, ?, ?, ?, ?, ?)");

                    $sql->bindParam(1, $nomeBiblioteca, PDO::PARAM_STR);
                    $sql->bindParam(2, $indirizzo, PDO::PARAM_STR);
                    $sql->bindParam(3, $email, PDO::PARAM_STR);
                    $sql->bindParam(4, $sito, PDO::PARAM_STR);
                    $sql->bindParam(5, $latitudine, PDO::PARAM_STR);
                    $sql->bindParam(6, $longitudine, PDO::PARAM_STR);
                    $sql->bindParam(7, $note, PDO::PARAM_STR);
                    $res = $sql->execute();
                    

                    $sql = $pdo -> prepare("INSERT INTO Foto VALUES(?, ?)");

                        for($i=0; $i<count($foto); $i++){
                            
                            $target_dir = '../../../../../foto/';
                            $target_file = $target_dir . $foto[$i];
                            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                            
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                                echo "<script> alert('Formato documento non accetttato'); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
                            }else{
                                $sql->bindValue(1, $foto[$i], PDO::PARAM_STR);
                                $sql->bindValue(2, $nomeBiblioteca, PDO::PARAM_STR);
                                $sql->execute();
                            }
                        }
                    
                    $sql = $pdo -> prepare("INSERT INTO RecapitiBiblioteca VALUES(?, ?)");
                    
                    for($i=0; $i<count($recapito); $i++){
                        $sql->bindValue(1, $nomeBiblioteca, PDO::PARAM_STR);
                        $sql->bindValue(2, $recapito[$i], PDO::PARAM_INT);
                        $sql->execute();
                     }
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());
                     exit();	
                }	

                if($res > 0){
                   $bulk = new MongoDB\Driver\BulkWrite();

                    $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Biblioteca', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
                    $bulk -> insert($doc);
                    $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                    echo "<script> alert('Biblioteca inserita correttamente!'); window.location.href='../../home/superUserHome.php'; </script>";
                }else 
                   echo "<script> alert('La biblioteca NON è stata inserita correttamente!'); window.location.href='inserimentoBiblioteca.php'; </script>";
                 
            }

        ?>
        <div class="topnav">
            <a href="../../home/adminHome.php" >Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="inserimentoBiblioteca.php" class="active">Inserisci Biblioteca</a>
                    <a href="../inserimentoAmministratore/inserimentoAmministratore.php">Inserisci Amministratore</a>
                </div>
            </div>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 500px;">
                    <h4 class="card-title mt-3 text-center">Inserisci Biblioteca</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                        
                       <div class="form-group input-group">
                          <input type="text" placeholder="Nome Biblioteca" class="form-control" name="nomeBiblioteca" id="nomeBiblioteca" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="text" placeholder="Indirizzo" class="form-control" name="indirizzo" id="indirizzo" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="email biblioteca" class="form-control" name="email" id="email" required>
                       </div> 

                        <div class="form-group input-group">
                          <input type="text" placeholder="URL Sito" class="form-control" name="sito" id="sito" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="number" placeholder="Latitudine" class="form-control" name="latitudine" id="latitudine" step="0.00000001" required>
                       </div> 
                       
                        <div class="form-group input-group">
                          <input type="number" placeholder="Longitudine" class="form-control" name="longitudine" id="longitudine" step="0.00000001" required>
                       </div>
                       
                       <label> Recapiti telefonici: </label>
                           <table class="table table-bordered" id="dynamic_field" style="margin-top:0px;">  
                                <tr>  
                                     <td>
                                         <input type="number" placeholder="Recapito" class="form-control" name="recapito[]" id="recapito[]" required>
                                    </td>  
                                     <td><button type="button" name="aggiungi" id="aggiungi" class="btn btn-success">Aggiungi</button></td>  
                                </tr>  
                           </table> 
                       
                       <div class="form-group input-group">
                          <input type="text" placeholder="Note" class="form-control" name="note" id="note" required>
                       </div> 
                       
                       <label> Scegli una o più foto! </label>
                           <table class="table table-bordered" id="dynamic_field_2" style="margin-top:0px;">  
                                <tr>  
                                     <td>
                                         <input type="file" class="form-control" name="foto[]" id="foto[]" required>
                                    </td>  
                                     <td><button type="button" name="aggiungi_2" id="aggiungi_2" class="btn btn-success">Aggiungi</button></td>  
                                </tr>  
                           </table>                     
                    
                    <div class="form-group">
                        <button type="submit" name='submit' id='submit' class="btn btn-primary btn-block"> Inserisci Biblioteca </button>
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