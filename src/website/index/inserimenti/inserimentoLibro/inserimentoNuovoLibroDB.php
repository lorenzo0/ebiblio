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

    try {
        $sql = "SELECT NomeBibliotecaAmministrata
                FROM Amministratore 
                WHERE EmailUtente = '" . $_SESSION['email-accesso'] . "'";
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

                $pdf = $_POST['pdf'];

                try{	
                     $sql1 = "INSERT INTO Ebook (CodiceISBN, PDF, Dimensione, NumeroAccessi) VALUES ('$codiceISBN', '$pdf', 80, 0)";
                     $pdo->query($sql);

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
                     $sql1 = "INSERT INTO ebook VALUES ('$codiceISBN','$pdf')";
                     $res1 = $pdo->query($sql);
                }	
                catch(PDOException $e)	{	
                     echo($e->getMesssage());	
                     exit();	
                }
                break;
        }

        if($res > 0)
            echo "<script> alert('Il libro è stato inserito correttamente'); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
        else
            echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.php'; </script>";

    }else
        echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.html'; </script>";


    ?>