<?php
                
    require '../../../connectionDB/connection.php';
    unset($_SESSION['tipoLibro']);

    $codiceISBN = $_POST['codice'];
    $titolo = $_POST['titolo'];
    $anno = $_POST['anno'];
    $genere = $_POST['genere'];
    $nomeEdizione = $_POST['nomeEdizione'];
    $tipoLibro = $_POST['tipoLibro'];

try{	
	 $sql = "INSERT INTO Libro VALUES ('$codiceISBN','$titolo','$anno','$genere','$nomeEdizione', '$tipoLibro')";		
     $res = $pdo->exec($sql);
     echo $res;
}	
catch(PDOException $e)	{	
	 echo($e->getMesssage());	
	 exit();	
}	


if($res>0){

    switch($tipoLibro){
        case 'cartaceo':
            $conservazione = $_POST['statoConservazione'];
            $pagine = $_POST['numeroPagine'];
            $scaffale = $_POST['numeroScaffale'];
            
            try{	
                 $sql = "INSERT INTO cartaceo VALUES ('$codiceISBN','$conservazione','Disponibile','$pagine','$scaffale', 1)";	
                 $res = $pdo->exec($sql);
                
                if($res>0)
                    echo "great!";
                else
                    echo "not great!";
            }	
            catch(PDOException $e)	{	
                 echo($e->getMesssage());	
                 exit();	
            }	
            
            break;
            
        case 'ebook':
            //$directory = realpath($_POST['pdf']);
            //$dimensione = filesize($directory);
            
            /*$nomePDF = $_FILES['pdf']['name'];
            $pdf = file_get_contents($_FILES['pdf']['tmp_name']);*/
            $pdf = $_POST['pdf'];
            
            try{	
                 $sql1 = "INSERT INTO Ebook (CodiceISBN, PDF, Dimensione, NumeroAccessi) VALUES ('$codiceISBN', '$pdf', 80, 0)";
                 $pdo->exec($sql);
            }	
            catch(PDOException $e)	{	
                 echo($e->getMesssage());
                 exit();	
            }	
            
            //$sql = "INSERT INTO ebook VALUES ('$codiceISBN','$nomePDF', '$pdf',0, 0)";
            break;
            
        case 'entrambi':
            $conservazione = $_POST['statoConservazione'];
            $pagine = $_POST['numeroPagine'];
            $scaffale = $_POST['numeroScaffale'];
            $pdf = $_POST['pdf'];
            
            try{	
                 $sql = "INSERT INTO cartaceo VALUES ('$codiceISBN','$conservazione','Disponibile','$pagine','$scaffale')";	
                 $res = $pdo->exec($sql);
                 echo $res;
            }	
            catch(PDOException $e)	{	
                 echo($e->getMesssage());	
                 exit();	
            }
            
            try{	
                 $sql1 = "INSERT INTO ebook VALUES ('$codiceISBN','$pdf')";
                 $res1 = $pdo->exec($sql);
                 echo $res1;
            }	
            catch(PDOException $e)	{	
                 echo($e->getMesssage());	
                 exit();	
            }
            break;
    }

}else
    echo "<script type='text/javascript'>alert('Il record non è stato inserito correttamente - 1.');</script>";
    

?>