<?php

    /*
        To obtain session variables;
            $_SESSION["Name_variable"]
        Now possible variables are;
            - TipoUtente
            - Email (Utente)
            
            $_SESSION["TipoDiUTente"]
            $_SESSION["EmailUtente"]
    
    */
    
    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $nomeCampoPHP = $_POST['nomeCampoHTML'];

    try {
        //don't forget to use '' in $variable Email = 'nomeCampoPHP'
        $sql = "query";
        $res=$pdo->query($sql);
        $row=$res->fetch();
    }catch(PDOException $e) {
        echo("Query SQL Failed: ".$e->getMessage());
        exit();
    }

    //if exist

    if ($row>0) {
        //todo
      } else {
        //todo
    }

    //if we need to receive all the info (select)
    while($row) {
        echo $row['NomeCampoTabella'];
    }

?>