<?php
                
    require '../../../../connectionDB/connection.php';
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
                
                echo $conservazione . ' - ' . $pagine . ' - ' . $scaffale . ' - ' . $numeroCopie;
                echo $nomeBiblioteca . ' - ' . $codiceISBN . ' - ' . $numeroCopie . ' - ';


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
                
                $pdf = $_POST['pdf'];
                $baseDir = "uploads/";
                $fileName= basename($_FILES['pdf']['name']);
                $filePath = $baseDir . SfileName;
                try{	
                     if(move_uploaded_file($_FILES['pdf']['tmp_name'], $filePath)){
                     $sql1 = "INSERT INTO Ebook(CodiceISBN, PDF, Dimensione, NumeroAccessi) VALUES ('$codiceISBN', '$fileName', 120, 0)";
                     $res = $sql->execute();
                     } else{
                         echo "<script> alert('upload  '" . $filePath . " ); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
                     }
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());
                     exit();	
                }	

                break;

            case 'Entrambi':
                $conservazione = $_POST['statoConservazione'];
                $pagine = $_POST['numeroPagine'];
                $scaffale = $_POST['numeroScaffale'];
                $pdf = $_POST['pdf'];
                $numeroCopie = $_POST['numeroCopie'];
                
               $baseDir = "uploads/";
                $fileName= basename($_FILES['pdf']['name']);
                $filePath = $baseDir . SfileName;

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

                try{
                    if(move_uploaded_file($_FILES['pdf']['tmp_name'], $filePath)){
                     $sql1 = "INSERT INTO Ebook(CodiceISBN, PDF, Dimensione, NumeroAccessi) VALUES ('$codiceISBN', '$fileName', 120, 0)";
                     $res = $sql->execute();
                     } else{
                         echo "<script> alert('upload  '" . $filePath . " ); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
                     }
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());	
                     exit();	
                }
                break;
        }

        if($res > 0)
            echo "<script> alert('Il libro è stato inserito correttamente'); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
        //      else
            //echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.php'; </script>";

    }//else
        //echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.html'; </script>";


    ?>