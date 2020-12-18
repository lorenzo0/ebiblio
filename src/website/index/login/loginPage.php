<?php
    session_start();

    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $emailUtente = $_POST['email'];
    $passwordUtente = $_POST['password'];

    try {
        $sql = "SELECT * FROM Utente WHERE Email = '$emailUtente' and PasswordUtente = '$passwordUtente'";
        $res=$pdo->query($sql);
        $row=$res->fetch();
    }catch(PDOException $e) {
        echo("Query SQL Failed: ".$e->getMessage());
        exit();
    }


    if ($row>0) {
       echo("<b> Benvenuto nel sistema, ".$row['Nome']."</b>");
        $_SESSION["TipoDiUTente"] = $row['TipoUtente'];
        $_SESSION["EmailUtente"] = $row['Email'];

        /*
         *  Quando disponibile, sarà necessario fare il redirect alla pagina homepage
         *  header("location: ../homepage/home.html");
        */

      } else {
       header("Refresh: 2; url= loginPage.html");
       echo "<script type='text/javascript'>alert(\"I dati non risultano corretti, sicuro di esserti registrato?\")</script>";
    }

?>


