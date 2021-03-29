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
  </head>
    <header></header>
    <body>
         <?php 
            require '../../../../connectionDB/connection.php';
            require '../../../../connectionDB/connectionMongo.php';
            if($_SESSION['TipoUtente']=="Utilizzatore"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
             }else if($_SESSION['TipoUtente']=="Volontario"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
             }else if($_SESSION['TipoUtente']==""){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
             }else if ($_SESSION['TipoUtente']=="SuperUser"){
                 echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/superUserHome.php'</script>";
            }
            $emailUtente=$_SESSION['EmailUtente'];
            $sql = "SELECT Nome FROM Biblioteca B join Amministratore A ON (B.Nome=A.NomeBibliotecaAmministrata)
                                            WHERE (A.EmailUtente='$emailUtente')"; 
            $res=$pdo->query($sql);
            $row = $res->fetch();
            $nomeBiblioteca = $row['Nome'];

            if(isset($_POST['inserisci'])){
                
                
                $presaCorrente = isset($_POST['presaCorrente']) ? $_POST['presaCorrente'] : 0;
                $presaEthernet = isset($_POST['presaEthernet']) ? $_POST['presaEthernet'] : 0;
                $nomeBiblio = $row['Nome'];
                
                $sql = $pdo->prepare("INSERT INTO PostoLettura (NomeBiblioteca, Ethernet, Corrente) VALUES(?,?,?)");
                $sql->bindParam(1, $nomeBiblio, PDO::PARAM_STR);
                $sql->bindParam(2, $presaEthernet, PDO::PARAM_INT);
                $sql->bindParam(3, $presaCorrente, PDO::PARAM_INT);
                
                if($sql->execute()) {
                    $bulk = new MongoDB\Driver\BulkWrite();
                    $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'PostoLettura', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
                    $bulk -> insert($doc);
                    $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
                    echo "<script> alert('Posto Lettura inserito correttamente!'); window.location.href='../../home/adminHome.php'; </script>";
                }else
                    echo "<script> alert('Il posto lettura non è stato inserito correttamente, riprova!'); window.location.href='inserimentoPostoLettura.php'; </script>";
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
                    <a href="inserimentoPostoLettura.php" class="active">Inserisci Posto lettura</a>
                    <a href="../inserimentoLibro/inserimentoISBN.php">Inserisci libro</a>      
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
                    <h4 class="card-title mt-3 text-center">Inserimento Posto Lettura</h4>
                    <div class="imgcontainer">
                        <img src="../../../images/desk.png" alt="Avatar" class="avatar">
                    </div>
                   <form method="post"> 
                       
                     <div class="form-group text-center">
                         <h5><?php echo $nomeBiblioteca; ?></h5> 
                        
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
            
        </div>
    </body>
    <footer class="text-center text-white fixed-bottom" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer> 
</html>