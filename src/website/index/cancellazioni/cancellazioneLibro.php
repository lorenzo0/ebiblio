<?php

require '../../../connectionDB/connection.php';
require '../../../connectionDB/connectionMongo.php';

    if($_SESSION['TipoUtente']=="Utilizzatore"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/myHome.php'</script>";
     }else if($_SESSION['TipoUtente']=="Volontario"){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/volHome.php'</script>";
     }else if($_SESSION['TipoUtente']==""){
         echo "<script> alert('Non possiedi le credenziali per accedere a questa pagina'); window.location.href='../../home/home.php'</script>";
     }

$isbn = $_GET['Isbn'];
$tipo = $_GET['Tipo'];

try{
    $sql = "DELETE
            FROM libro
            WHERE CodiceISBN = '$isbn'";
    $res = $pdo -> query($sql);
    
    switch($tipo){
        case 'Cartaceo': 
            $sql = "DELETE
                    FROM Cartaceo
                    WHERE CodiceISBN = '$isbn'";
            
            $res = $pdo -> query($sql);
            break;
        
        case 'Ebook': 
            $sql = "DELETE
                    FROM Ebook
                    WHERE CodiceISBN = '$isbn'";
            
            $res = $pdo -> query($sql);
            break;
        
        case 'Entrambi': 
            $sql = "DELETE
                    FROM Cartaceo
                    WHERE CodiceISBN = '$isbn'";
            $sql1 = "DELETE
                    FROM Ebook
                    WHERE CodiceISBN = '$isbn'";
            
            $res = $pdo -> query($sql);
            $res1 = $pdo -> query($sql);
            break;
    }
    
    
}catch(PDOException $e){echo $e->getMessage();}	

if($res != 0){
    $bulk = new MongoDB\Driver\BulkWrite();
    $doc = ['_id' => new MongoDB\BSON\ObjectID(), 'titolo' => 'EliminaLibro', 'tipoUtente'=>$_SESSION['TipoUtente'], 'emailUtente'=>$_SESSION['EmailUtente'], 'timeStamp'=>date('Y-m-d H:i:s')];
    $bulk -> insert($doc);
    $connessioneMongo -> executeBulkWrite('ebiblio.log',$bulk);
    echo "<script> alert('Record eliminato!'); window.location.href='../visualizzazione/visualizzazioneLibri.php'; </script>";
}else
    echo "<script> alert('Il record NON è stato eliminato!'); window.location.href='../visualizzazione/visualizzazioneLibri.php'; </script>";


?>