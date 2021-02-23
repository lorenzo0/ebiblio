<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Ebiblio - Home Page</title>
      <script src="https://kit.fontawesome.com/188e218822.js"></script>

      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link href="../../css/bootstrap-4.0.0.css" rel="stylesheet">
      <link href="../../css/foglioStile.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
      <script src="../../js/script.js"></script>
      <script>
        $(function loadNavFoo(){
          $("#footer").load("../utils/footer.html"); 
        });
      </script>
      
  </head>
    <header></header>
    <body style="background-color:#002a4f; color:#fff">
        <?php
        
            require '../../../connectionDB/connection.php';
            
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
                                    FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                                    WHERE l.Titolo='$titoloLibro' AND l.CodiceISBN='$ISBN' AND l.Genere='$genereLibro'";
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                            }else{
                                $sql = "SELECT *
                                    FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                                    WHERE l.Titolo='$titoloLibro' AND l.CodiceISBN='$ISBN'";
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                            }
                        }else{
                            $sql = "SELECT *
                                    FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                                    WHERE l.Titolo='$titoloLibro'";
                                $res = $pdo->query($sql); 
                                $rowCount = $res->rowCount();
                        }
                    }else if($ISBN != null){
                        $sql = "SELECT *
                                FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                                WHERE l.CodiceISBN='$ISBN'";
                        $res = $pdo->query($sql); 
                        $rowCount = $res->rowCount();
                    }else if($genereLibro != null){
                        $sql = "SELECT *
                                FROM libriDisponibili as ld Join libro as l On ld.CodiceISBN = l.CodiceISBN
                                WHERE l.Genere='$genereLibro'";
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
                            <th style="color:#fff; background-color: #bb2e29">Biblioteca</th>
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
                        $biblioteca = $row['NomeBiblioteca'];
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
                        echo "<td>" . $biblioteca . "</td>";
                        echo "<td>" . $anno . "</td>";
                        echo "<td>" . $genere . "</td>";
                        echo "<td>" . $nomeEdizione . "</td>";
                        if($_SESSION['TipoUtente']!='Utilizzatore'){
                        echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../prenotazioni/prenotazioneLibroCartaceo/mostraSceltaCartaceo.php?Isbn=" .
                            "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> IF </button></td>"; 
                        }elseif($_SESSION['TipoUtente']=='Utilizzatore'){echo "<td>" . "<button class=" . "btn btn-primary btn-block" . " onclick=" . "location.href='../prenotazioni/prenotazioneLibroCartaceo/mostraSceltaCartaceo.php?Isbn=" .
                            "$isbn" . "&Tipo=" . urlencode($tipoLibro) . "&Titolo=" . urlencode($titolo) . "&Anno=" . "$anno" . "&Genere=" . urlencode($genere) . "&NomeEdizione=" . urlencode($nomeEdizione) . "'" . "> ELSE </button></td>"; }
                    }        
                    echo "</table></tbody>";
                    }else{
                        echo "<br/>NONE";
                    }
            }
            
        
        ?>
        <div class="topnav">
            <a href="home.php" style=" background-color:#fff "class="active2">Home</a>
            <a href="../../openStreetMap/map.html">MAP</a>
            <a href="../visualizzazione/visualizzazioneBiblioteca.php">Tutte le biblioteche</a>
            <a href="../visualizzazione/visualizzazioneLibri.php">Tutti i libri</a>
            
            <div class="login-container">
                <button onClick="location='../login/login.php'">Accedi</button>
                <button onClick="location='../registrazione/registrazione.php'">Registrati</button>
            </div>
        </div>
        <div>
            <div class="card" style="border: 0; width:100%">
                <article class="card-body mx-auto" style="width: 100%; background-color:#fff; color:#002a4f">
                    <h2 class="card-title mt-3 text-center">BENVENUTO IN E-BIBLIO</h2>
                    <h6 class="card-title mt-2 text-center">E-biblio e' una piattaforma on-line per la prenotazione di..</h6>
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
                        <span class="input-group-text" id="inputGroup-sizing-default">Autore</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default" placeholder="..." id="Autore" name="Autore">
                    
                        
                    
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
        
        
        
    <div id="footer"></div>
    </body>
</html>