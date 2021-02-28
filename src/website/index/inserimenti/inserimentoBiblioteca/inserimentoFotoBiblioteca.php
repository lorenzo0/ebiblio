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
            /*if ($_SESSION['TipoUtente']!="Amministratore"){
                echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>"; 
            }*/
        
            if(isset($_POST['submit'])){
                
                $foto = $_POST['foto'];
                $nomeBiblioteca = $_GET['nome'];
                
                for($i=0; $i<count($foto); $i++){
                    for($y=$i+1; $y<(count($foto)-$i); $y++){
                        if($foto[$i] == $foto[$y])
                            unset($foto[$y]);
                    }
                  }


                try{
                    $sql = $pdo -> prepare("INSERT INTO Foto VALUES(?, ?, ?)");
                    
                    for($i=0; $i<count($foto); $i++){
                        $dir = '../../../../../foto/' . $foto[$i];
                        $blob = fopen($dir, 'rb');
                        
                        $sql->bindValue(1, $foto[$i], PDO::PARAM_STR);
                        $sql->bindValue(2, $nomeBiblioteca, PDO::PARAM_STR);
                        $sql->bindParam(3, $blob, PDO::PARAM_LOB); 
                        $sql->execute();
                     }
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());
                     exit();	
                }	

                if($res > 0) 
                   echo "<script> alert('Foto inserite correttamente!'); window.location.href='../../home/home.php'; </script>";
                else 
                   echo "<script> alert('Non tutte le foto sono state inserite correttamente!'); window.location.href='inserimentoFotoBiblioteca.php'; </script>";
                 
            }

        ?>
        <div class="topnav">
            <a href="../../home/adminHome.php">Home</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Inserimenti
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../inserimentoAmministratore/inserimentoAmministratore.html" >Inserisci utente</a>
                    <a href="../inserimentoAutore/inserimentoAutore.php">Inserisci autore</a>
                    <a href="inserimentoBiblioteca.php" class="active">Inserisci biblioteca</a>
                    <a href="../inserimentoPostoLettura/inserimentoPostoLettura.php">Posto lettura</a>
                    <a href="../inserimentoLibro/inserimentoISBN.php">Inserisci libro</a>      
                </div>
            </div>
                <a href="../inserimenti/inserimentoSegnalazione/inserimentoSegnalazione.php">Nuova segnalazione</a> 
            <a href="../../cancellazioni/cancellazioneSegnalazioni.php">Cancella segnalazione</a> 
            <a href="../inserimentoMessaggio/inserimentoMessaggio.php">Messaggi</a>
            <button class="logout" style="float:right" onClick="location='../../login/logout.php'">Logout</button>
            <button class="logout" style="float:right" onClick="location='../../profilo/profilo.php'">Account</button>
        </div>
        <div class="container">
            <div class="card mt-4" style="border: 0">
                <article class="card-body mx-auto" style="max-width: 500px;">
                    <h4 class="card-title mt-3 text-center">Inserisci nuove foto!</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/library.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
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
        <div id="footer"></div>
    </body>
</html>