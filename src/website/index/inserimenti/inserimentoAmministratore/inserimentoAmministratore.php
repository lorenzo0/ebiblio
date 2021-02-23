<?php
    require '../../../../connectionDB/connection.php';
     if ($_SESSION['TipoUtente']!="Amministratore"){
        echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
    }
    $nomeUtente= $_POST['nomeUtente'];
    $cognomeUtente = $_POST['cognomeUtente'];
    $emailUtente = $_POST['emailUtente'];
    $password = $_POST['password'];
    $dataNascita= $_POST['dataNascita'];
    $luogoNascita = $_POST['luogoNascita'];
    $recapito = $_POST['recapito'];
    $qualifica = $_POST['qualifica'];

    $sql = "INSERT INTO Utente (Email, Nome, Cognome, PasswordUtente, DataNascita, LuogoNascita, RecapitoTelefonico, TipoUtente) VALUES ('$emailUtente','$nomeUtente','$cognomeUtente','$password','$dataNascita','$luogoNascita', '$recapito', 'Amministratore')";
    
    $res= $pdo->query($sql);
    
    if ($res >0 ) {
        try{
             $sql1 = "INSERT INTO Amministratore (EmailUtente, Qualifica) VALUES ('$emailUtente', '$qualifica')";
             $res = $pdo->query($sql1);    
        } catch(PDOException $e) {
            echo($e->getMesssage());	
            exit();	
        } 
        
        if($res>0)
            echo "<script> alert('Amministratore inserito correttamente'); window.location.href='../../login/login.html'; </script>";
        else
            echo "<script> alert('L'amministratore NON è stato inserito correttamente'); window.location.href='inserimentoAmministratore.html'; </script>";
    }

?>