<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ebiblio</title>
      <script src="https://kit.fontawesome.com/188e218822.js"></script>

      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
      <link href="../../css/foglioStile.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
      <script src="../../js/script.js"></script>
  </head>
    <header></header>
    <body style="background-color:#002a4f; color:#fff">
        <?php
        
            require '../../../connectionDB/connection.php';            
        
            $_SESSION['TipoUtente']="";
            $_SESSION['EmailUtente']="";
            
        
        ?>
        <div class="topnav">
            <a href="home.php" class="active">Home</a>
            <a href="../map/map.php">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            <a href="../visualizzazione/visualizzazionePostiLettura.php">Tutti i posti lettura</a>
            <div class="top-dropdown">
                <button class="top-dropbtn">Statistiche
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="top-dropdown-content">
                    <a href="../statistiche/ebookPiuAcceduti.php">EBook più acceduti</a>
                    <a href="../statistiche/numCartaceiPrenotati.php">Numero Cartacei Prenotati</a>
                    <a href="../statistiche/numConsegneVolontario.php">Consegne Volontario</a>
                    <a href="../statistiche/postoLetturaMenoUtilizzati.php">Posti lettura meno utilizzati</a>
                </div>
            </div>
            
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>
        <div>
            <div class="card" style="border: 0; width:100%">
                <article class="card-body mx-auto" style="width: 90%; background-color:#fff; color:#002a4f">
                    <h2 class="card-title mt-3 text-center">BENVENUTO IN E-BIBLIO</h2>
                    <h6 class="card-title mt-2 text-center">EBIBLIO è una piattaforma multiutente che permette la gestione delle biblioteche dell’Università di Bologna.<br>Gli studenti Unibo hanno la possibilità di registrarsi e fruire di un servizio completo. Possono, infatti, prenotare i libri di cui necessitano e, grazie all'aiuto di volontari, riceverli comodamente a casa.<br><br>Ebiblio elimina il disagio di sale studio eccessivamente affollate e posti lettura introvabili, poiché uno studente, grazie al servizio di prenotazione, può garantirsi un postazione in cui studiare nella biblioteca che preferisce.<br><br>Se viene fatto un uso improprio della piattaforma e dei servizi che essa offre, lo studente utilizzatore può essere segnalato dal amministratore della biblioteca, dopo 3 segnalazioni, lo studente fruitore viene sospeso dal servizio.<br><br></h6> 
                    <h4 class="card-title mt-2 text-center">Credendo nell’utilità del servizio e nel suo corretto uso da parte degli studenti,<br>auguriamo a tutti una buona permanenza in ebiblio!</h4>
                </article>
            </div>
        </div>
        <div class="container" style="background-color:#002a4f; color:#fff">
            <div class="card mt-4" style="border: 0; background-color:#002a4f; color:#fff">
                <article class="card-body mx-auto" style="max-width: 400px;">
                    <h4 class="card-title mt-3 text-center">CERCA UN LIBRO!</h4>
                    <div class="imgcontainer">
                        <img src="../../images/book.png" alt="Avatar" class="avatar">
                        <img src="../../images/ebook.png" alt="Avatar" class="avatar">
                    </div>
                    <form action="home.php" method="post">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default"><b>Titolo</b></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Titolo..." id="Titolo" name="Titolo">
                    </div>
                    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">ISBN</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="000-00-000000-0-0" id="Isbn" name="Isbn">
                    </div>
                    
                    <div class="input-group input-group-sm mb-3">                    
                      <div class="input-group-prepend" >
                        <span class="input-group-text" id="inputGroup-sizing-default">Genere</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="Genere" name="Genere">
                    </div>

                    <div class="form-group">
                        <button type="search" name="search" id="search" class="btn btn-block cerca">Cerca</button> 
                    </div>
                    </form>
                </article>
            </div>
        </div>
        <?php
            if(isset($_POST['search'])){
                $titoloLibro = $_POST['Titolo'];
                $ISBN = $_POST['Isbn'];
                //$autoreLibro = $_POST['Autore'];
                $genereLibro = $_POST['Genere'];

                try{
                    if($titoloLibro != null){
                        if($ISBN != null){
                            if($genereLibro != null){
                                $sql = "SELECT *
                                    FROM libro
                                    WHERE Titolo='$titoloLibro' AND CodiceISBN='$ISBN' AND Genere='$genereLibro'";
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                            }else{
                                $sql = "SELECT *
                                    FROM libro
                                    WHERE Titolo='$titoloLibro' AND CodiceISBN='$ISBN'";
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                            }
                        }else{
                            $sql = "SELECT *
                                    FROM libro
                                    WHERE Titolo='$titoloLibro' ";;
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                        }
                    }else if($ISBN != null){
                        $sql = "SELECT *
                                FROM libro
                                WHERE CodiceISBN='$ISBN'";;
                        $res = $pdo->query($sql); 
                        $rowCount = $res->rowCount();
                    }else if($genereLibro != null){
                        $sql = "SELECT *
                                    FROM libro
                                    WHERE Genere='$genereLibro'";
                        $res = $pdo->query($sql); 
                        $rowCount = $res->rowCount();
                    }
                }catch(PDOException $e){ echo("Query SQL Failed: ".$e->getMessage());
                                            exit();}
            
            if($rowCount > 0){
            echo '
                <div>
                    <div class="card" style="border: 0; width:100%">
                        <article class="card-body mx-auto" style="width: 100%; background-color:#002a4f; color:#fff">
                            <h2 class="card-title mt-1 text-center">Risultati ricerca:</h2>
                        </article>
                    </div>
                </div>
                  <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th style="color:#fff; background-color: #bb2e29">Codice ISBN</th> 
                            <th style="color:#fff; background-color: #bb2e29">Titolo</th>
                            <th style="color:#fff; background-color: #bb2e29">Anno</th>
                            <th style="color:#fff; background-color: #bb2e29">Genere</th>
                            <th style="color:#fff; background-color: #bb2e29">Nome Edizione</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';


                    while ($row = $res->fetch()) {
                        $isbn = $row['CodiceISBN'];
                        $tipoLibro = $row['TipoLibro'];
                        $titolo = $row['Titolo'];
                        $anno = $row['Anno'];
                        $genere = $row['Genere'];
                        $nomeEdizione = $row['NomeEdizione'];
                        echo("<tr>");
                        echo("<td></td>");
                        echo "<td>";
                        if($tipoLibro == 'Cartaceo')
                            echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        else if($tipoLibro == 'Ebook')
                            echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        else if($tipoLibro == 'Entrambi'){
                            echo "<img src=" . "../../images/ebook.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                            echo "<img src=" . "../../images/book.png" . " alt=" . "Cartaceo" . " class=" . "avatarTableLibro" . ">";
                        }
                        echo "</td>";
                        echo "<td>" . $isbn . "</td>";
                        echo "<td>" . $titolo . "</td>";
                        echo "<td>" . $anno . "</td>";
                        echo "<td>" . $genere . "</td>";
                        echo "<td>" . $nomeEdizione . "</td>";
                    }        
                    echo "</table></tbody>";
                    }else{
                        echo "<br/>NONE";
                    }
            }
        ?>
    </body>
    <footer class="text-center text-white" style="background-color: #bb2e29;">
      <div class="container p-2"> EBIBLIO</div>
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: Progetto Basi di Dati 2020/21
      </div>
    </footer>
</html>