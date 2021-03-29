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
    unset($_SESSION['tipoLibro']);

    $codiceISBN = $_POST['codice'];
    $titolo = $_POST['titolo'];
    $anno = $_POST['anno'];
    $genere = $_POST['genere'];
    $nomeEdizione = $_POST['nomeEdizione'];
    $tipoLibro = $_POST['tipoLibro'];
    $disponilita = 'Disponibile';
    $autori=$_POST['autore'];

    try {
        $sql = "SELECT NomeBibliotecaAmministrata
                FROM Amministratore 
                WHERE EmailUtente = '" . $_SESSION['EmailUtente'] . "'";
        $res=$pdo->query($sql);
    }catch(PDOException $e) {
        echo("Query SQL Failed: ".$e->getMessage());
        exit();
    }

    while($row=$res->fetch()) {
        $nomeBiblioteca = $row['NomeBibliotecaAmministrata'];
    }


    try{	
         $sql = $pdo -> prepare("INSERT INTO Libro VALUES(?,?,?,?,?,?)");
         $sql->bindParam(1, $codiceISBN, PDO::PARAM_STR);
         $sql->bindParam(2, $titolo, PDO::PARAM_STR);
         $sql->bindParam(3, $anno, PDO::PARAM_STR);
         $sql->bindParam(4, $genere, PDO::PARAM_STR);
         $sql->bindParam(5, $nomeEdizione, PDO::PARAM_STR);
         $sql->bindParam(6, $tipoLibro, PDO::PARAM_STR);
         $res = $sql->execute();
        
         $sql = $pdo -> prepare("INSERT INTO Scrittori VALUES(?,?)");
        
         for($i=0; $i<count($autori); $i++){
            for($y=$i+1; $y<(count($autori)-$i); $y++){
                if($autori[$i] == $autori[$y])
                    unset($autori[$y]);
            }
          }
        
         for($i=0; $i<count($autori); $i++){
            $sql->bindValue(1, $autori[$i], PDO::PARAM_INT);
            $sql->bindValue(2, $codiceISBN, PDO::PARAM_INT);
            $sql->execute();
         }
        
    }	
    catch(PDOException $e)	{	
         echo($e->getMesssage());	
         exit();
    }	


    if($res > 0){

        switch($tipoLibro){
            case 'Cartaceo':
                $conservazione = $_POST['statoConservazione'];
                $pagine = $_POST['numeroPagine'];
                $scaffale = $_POST['numeroScaffale'];
                $numeroCopie = $_POST['numeroCopie'];

                try{	
                     $sql = $pdo -> prepare("INSERT INTO cartaceo VALUES(?,?,?,?,?)");
                     $sql->bindParam(1, $codiceISBN, PDO::PARAM_INT);
                     $sql->bindParam(2, $conservazione, PDO::PARAM_STR);
                     $sql->bindParam(3, $disponilita, PDO::PARAM_STR);
                     $sql->bindParam(4, $pagine, PDO::PARAM_INT);
                     $sql->bindParam(5, $scaffale, PDO::PARAM_INT);
                     $res = $sql->execute();
                    
                     $sql = $pdo -> prepare("INSERT INTO LibriDisponibili VALUES(?,?,?)");
                     $sql->bindParam(1, $nomeBiblioteca, PDO::PARAM_STR);
                     $sql->bindParam(2, $codiceISBN, PDO::PARAM_INT);
                     $sql->bindParam(3, $numeroCopie, PDO::PARAM_INT);
                     $res = $sql->execute();
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());	
                     exit();	
                }	

                break;

            case 'Ebook':
                
                $target_dir = '../../../../../pdf/';
                $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                $acc = 0;
                $dim = filesize($target_file);

                /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);*/

                if($imageFileType != "pdf") {
                    echo $imageFileType;
                    echo "<script> alert('Formato documento non accetttato'); </script>";
                }else{
                    try{
                        $nomePDF=$_FILES["pdf"]["name"];
                        $sql = $pdo -> prepare("INSERT INTO Ebook (CodiceISBN,PDF,Dimensione,NumeroAccessi) VALUES(?, ?, ?, ?)");

                        $sql->bindParam(1, $codiceISBN, PDO::PARAM_INT);
                        $sql->bindParam(2, $nomePDF, PDO::PARAM_STR);
                        $sql->bindParam(3, $dim, PDO::PARAM_STR); //DOUBLE
                        $sql->bindParam(4, $acc, PDO::PARAM_INT); 

                        $res = $sql->execute();
                    }catch(PDOException $e)	{	
                     echo($e->getMesssage());
                     exit();
                    }	
                }

                break;
                
            case 'Entrambi':
                $conservazione = $_POST['statoConservazione'];
                $pagine = $_POST['numeroPagine'];
                $scaffale = $_POST['numeroScaffale'];
                $pdf = $_POST['pdf'];
                $numeroCopie = $_POST['numeroCopie'];

                try{	
                     $sql = $pdo -> prepare("INSERT INTO cartaceo VALUES(?,?,?,?,?)");
                     $sql->bindParam(1, $codiceISBN, PDO::PARAM_INT);
                     $sql->bindParam(2, $conservazione, PDO::PARAM_STR);
                     $sql->bindParam(3, $disponilita, PDO::PARAM_STR);
                     $sql->bindParam(4, $pagine, PDO::PARAM_INT);
                     $sql->bindParam(5, $scaffale, PDO::PARAM_INT);
                     $res = $sql->execute();
                    
                     $sql = $pdo -> prepare("INSERT INTO LibriDisponibili VALUES(?,?,?)");
                     $sql->bindParam(1, $nomeBiblioteca, PDO::PARAM_STR);
                     $sql->bindParam(2, $codiceISBN, PDO::PARAM_INT);
                     $sql->bindParam(3, $numeroCopie, PDO::PARAM_INT);
                     $res = $sql->execute();
                    
                     
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());	
                     exit();	
                }

                $target_dir = '../../../../../pdf/';
                $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                $acc = 0;
                $dim = filesize($target_file);

                /*$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);*/

                if($imageFileType != "pdf") {
                    echo $imageFileType;
                    echo "<script> alert('Formato documento non accetttato'); </script>";
                }else{
                    try{
                        $nomePDF=$_FILES["pdf"]["name"];
                        $sql = $pdo -> prepare("INSERT INTO Ebook (CodiceISBN,PDF,Dimensione,NumeroAccessi) VALUES(?, ?, ?, ?)");

                        $sql->bindParam(1, $codiceISBN, PDO::PARAM_INT);
                        $sql->bindParam(2, $nomePDF, PDO::PARAM_STR);
                        $sql->bindParam(3, $dim, PDO::PARAM_STR); //DOUBLE
                        $sql->bindParam(4, $acc, PDO::PARAM_INT); 

                        $res = $sql->execute();
                    }catch(PDOException $e)	{	
                     echo($e->getMesssage());
                     exit();
                    }	
                }
                break;
        }

        if($res > 0){
            $bulk = new MongoDB\Driver\BulkWrite();
            $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'Libro', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
            $bulk -> insert($doc);
            $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
            
            echo "<script> alert('Il libro è stato inserito correttamente'); window.location.href='../../home/adminHome.php'; </script>";
        }else
            echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.php'; </script>";
    }else
        echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.php'; </script>";


    ?>
