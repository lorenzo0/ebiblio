<?php
    
    /*istanzia una sessione che crea come se fosse un file di cookie, questo non viene gestito sul pc dell'utente ma viene gestito dalla sessione di php, è una variabile di ambiente che mi tiene molti attributi, inserisco una corrispondenza chiave-valore all'interno della sessione, 
    ogni volta che faccio session start, recupero tutti chiave-valore inseriti all'intenro della sessione*/
                
    session_start();

    $dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $user, $password);  

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $nomeUtente= $_POST['nomeUtente'];
    $cognomeUtente = $_POST['cognomeUtente'];
    $emailUtente = $_POST['emailUtente'];
    $password = $_POST['password'];
    $dataNascita= $_POST['dataNascita'];
    $luogoNascita = $_POST['luogoNascita'];
    $recapito = $_POST['recapito'];
    $qualifica = $_POST['qualifica'];

    $sql = "INSERT INTO Utente (Email, Nome, Cognome, PasswordUtente, DataNascita, LuogoNascita, RecapitoTelefonico) VALUES ('$emailUtente','$nomeUtente','$cognomeUtente','$password','$dataNascita','$luogoNascita', '$recapito')";
    
    $pdo->exec($sql);

    $sql1 = "INSERT INTO Amministratore (EmailUtente, Qualifica) VALUES ('$emailUtente', '$qualifica')";
    
    $pdo->exec($sql1);

 

    
    /*
    $sql1='SELECT COUNT(*) AS Conteggio FROM Biblioteca  WHERE (Nome="'.$nomeBiblioteca.'")';
    $res1=$pdo->query($sql1);
    $row=$res1->fetch();

     if ($row['Conteggio']>0) {
       echo 'biblioteca già presente nel DB';
     } else {
       echo "biblioteca inserita con successo" ;
     }*/

?>