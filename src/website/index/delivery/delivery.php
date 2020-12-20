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

    $emailUtilizzatore = $_POST['emailUtilizzatore'];
    $note = $_POST['note'];
    $data = $_POST['data'];
    $tipologiaConsenga = $_POST['tipologiaConsegna'];

    /*$sql = "SELECT Email FROM Utenti WHERE TipoUtente = 'Utilizzatore'"; //manca where
    $result = $pdo->exec($sql);
   
    if ($result -> num_rows > 0 ) {
        while(row = mysql_fetch_array($result)) {
            printf( '%d: &quot;%s&quot; by %s<br />', 
                 htmlspecialchars($row['Email']));
                //htmlspecialchars($row['Username']) );
        } 
    }else {
        echo "0 results";
    }*/
        
    
/*
    if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
               $row["Email"] ."Email Utilizzatore". "<br>";
         }
        
    } else {
        echo "0 results";
        }
*/
    
?>