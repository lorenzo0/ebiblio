<?php

require '../../../connectionDB/connection.php';

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
    echo "<script> alert('Record eliminato!'); window.location.href='../visualizzazione/visualizzazioneLibri.php'; </script>";
}else
    echo "<script> alert('Il record NON è stato eliminato!'); window.location.href='../visualizzazione/visualizzazioneLibri.php'; </script>";


?>