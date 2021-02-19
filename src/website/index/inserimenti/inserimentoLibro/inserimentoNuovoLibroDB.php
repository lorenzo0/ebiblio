<?php
                
    require '../../../../connectionDB/connection.php';
    unset($_SESSION['tipoLibro']);

    $codiceISBN = $_POST['codice'];
    $titolo = $_POST['titolo'];
    $anno = $_POST['anno'];
    $genere = $_POST['genere'];
    $nomeEdizione = $_POST['nomeEdizione'];
    $tipoLibro = $_POST['tipoLibro'];

$_SESSION['email-accesso'] = 'emailAMM2@gmail.it';

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
	 $sql = "INSERT INTO Libro VALUES ('$codiceISBN','$titolo','$anno','$genere','$nomeEdizione', '$tipoLibro')";		
     $res = $pdo->query($sql);
}	
catch(PDOException $e)	{	
	 echo($e->getMesssage());	
	 exit();	
}	


if($res>0){

    switch($tipoLibro){
        case 'Cartaceo':
            $conservazione = $_POST['statoConservazione'];
            $pagine = $_POST['numeroPagine'];
            $scaffale = $_POST['numeroScaffale'];
            $numeroCopie = $_POST['numeroCopie'];

            
            try{	
                 $sql = "INSERT INTO cartaceo VALUES ($codiceISBN,'$conservazione','Disponibile','$pagine','$scaffale')";	
                 $res = $pdo->query($sql);
                 
                 $sql_dispCartaceo = "INSERT INTO LibriDisponibili VALUES ('$nomeBiblioteca',$codiceISBN, $numeroCopie )";
                 $pdo -> query($sql_dispCartaceo);
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
                 $sql = "INSERT INTO cartaceo VALUES ($codiceISBN,'$conservazione','Disponibile','$pagine','$scaffale')";	
                 $res = $pdo->query($sql);
                
                 $sql_dispCartaceo = "INSERT INTO LibriDisponibili VALUES ('$nomeBiblioteca',$codiceISBN, $numeroCopie )";
                 $pdo -> query($sql_dispCartaceo);
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
    
    if($res>0)
        echo "<script> alert('Il libro è stato inserito correttamente'); window.location.href='../../visualizzazione/visualizzazioneLibri.php'; </script>";
    else
        echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.php'; </script>";

}else
    echo "<script> alert('Il libro non è stato inserito correttamente'); window.location.href='inserimentoISBN.html'; </script>";
    

?>