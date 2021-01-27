<?php
    session_start();

    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

/*PDO modo per connettersi al db e instaura la connessione e catch gestisce errore

*/
    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    //non usiamo $REQUEST perchè conosciamo il tipo di richiesta (Post)
    /*si manda il post qualcosa tramite il form, il nome della variabile che c'è in html
	parte tutto da html, un utente inserisce i valori, con post i valori si mandano dall'html al php
	
	qui sto prendendo i valori di email utente e password
    */
    $emailUtente = $_POST['emailUtente'];
    $passwordUtente = $_POST['passwordUtente'];

	/*
	si fa la query per inserirli nel DB, nel login vai a controllare se esistono corrispondenze con email e password
	quindi fai una select
	*/
    $sql = "SELECT * FROM registeredUserEaer WHERE Email = '$emailUtente' and Password = '$passwordUtente'";
    $result = $pdo->exec($sql); //pdo -> exect manda in esecuzione la query e result prende cosa restituisce la query
	
	//result ci sono i valori che restituisce, result è il nome della variabile non è una parola chiave
	
    if($result->num_rows > 0) //se result è > 0, ha trovato la riga e quindi rimanda alla home
    {
        header("location: ../home/home.html");
    }
    else //altrimenti dati o non corretti o si richiede di registrare
    {                  
        header("Refresh: 3; url= loginPage.html");
        echo "<script type='text/javascript'>alert(\"I dati non risultano corretti, sicuro di esserti registrato?\")</script>";
    }
?>